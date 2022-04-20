<?php 
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");
    require_once("../models/User.php");

    $user = $_SESSION["user"];

    $NUM_ELEMENTS_BY_PAGE = 20;
    $page = $_SESSION["page"];

    function minormayor($arg){
        $aux = NULL;

        if(isset($_POST[$arg."op"])){
            $aux .= $_POST[$arg."op"];
            if(isset($_POST[$arg."="])){
                $aux .= $_POST[$arg."="];
            }
        }elseif(isset($_POST[$arg."="])){
            $aux .= $_POST[$arg."="];
        }

        return $aux;
    }

    //BIOPSY------------------------
    $GLEASON1 = NULL;
    $NCILPOS = NULL;
    $PORCENT = NULL;
    $TNM1 = NULL;

    if(isset($_POST["boolBiopsy"])){
        if($_POST['biopsy1'] != ''){
            $GLEASON1 = $_POST['biopsy1'];
        }
        if($_POST['biopsy2'] != ''){
            $NCILPOS = $_POST['biopsy2'];
        }
        if(isset($_POST['boolBiopsy3'])){
            if($_POST['biopsy3'] != ''){
                $PORCENTOP = minormayor("biopsy3");
                $PORCENT = $PORCENTOP." ".$_POST['biopsy3'];
            }
        }
        if($_POST['biopsy4'] != ''){
            $TNM1 = $_POST['biopsy4'];
        }
    }

    //CIR----------------------------
    $FECHACIR = NULL;
    if(isset($_POST["boolCIR"])){
        $DIACIR = $_POST["cir1"];
        $MESCIR = $_POST["cir2"];
        $ANYOCIR = $_POST["cir3"];
        $FECHACIR = "'".$ANYOCIR."-".$MESCIR."-".$DIACIR."'";
    }

    //CLINIC-------------------------
    $PSAPRE = NULL;
    if(isset($_POST["boolClinic"])){
        if($_POST['clinic1'] != ''){ 
            switch ($_POST['clinic1']) {
                case 1:
                    $PSAPRE = ">= 0 AND PSAPRE <= 6";
                    break;
                case 2:
                    $PSAPRE = "> 6 AND PSAPRE <= 10";
                    break;
                case 3:
                    $PSAPRE = "> 10 AND PSAPRE <= 20";
                    break;
                case 4:
                    $PSAPRE = "> 20";
                    break;
            }
        }
    }

    //EVOLVE-------------------------
    $PSAPOS = NULL;
    $RTPADYU = NULL;
    $RTPMES = NULL;
    $RBQ = NULL;
    $TRBQ = NULL;
    $T1MTX = NULL;
    $TSEGUI = NULL;
    $PSAFIN = NULL;
    $CAPRA_S = NULL;

    if(isset($_POST["boolEvolve"])){
        if($_POST['evolve1'] != ''){
            $PSAPOSOP = minormayor("evolve1");
            $PSAPOS = $PSAPOSOP." ".$_POST["evolve1"];
        }
        if($_POST['evolve2'] != ''){
            $RTPADYU = $_POST["evolve2"];
        }
        if($_POST['evolve3'] != ''){
            $RTPMESOP = minormayor("evolve3");
            $RTPMES = $RTPMESOP." ".$_POST["evolve3"];
        }
        if($_POST['evolve4'] != ''){
            $RBQ = $_POST["evolve4"];
        }
        if($_POST['evolve5'] != ''){
            switch ($_POST["evolve5"]) {
                case 1:
                    $TRBQ = ">= 18";
                    break;
                case 2:
                    $TRBQ = "< 18";
                    break;
            }
        }
        if($_POST['evolve6'] != ''){
            $T1MTXOP = minormayor("evolve6");
            $T1MTX = $T1MTXOP." ".$_POST["evolve6"];
        }
        if($_POST['evolve7'] != ''){
            $TSEGUIOP = minormayor("evolve7");
            $TSEGUI = $TSEGUIOP." ".$_POST['evolve7'];
        }
        if($_POST['evolve8'] != ''){
            $PSAFINOP = minormayor("evolve8");
            $PSAFIN = $PSAFINOP." ".$_POST['evolve8'];
        }
        if($_POST['evolve9'] != ''){
            switch ($_POST["evolve9"]) {
                case 1:
                    $CAPRA_S = ">= 0 AND CAPRA-S <= 2";
                    break;
                case 2:
                    $CAPRA_S = "> 2 AND CAPRA-S <= 5";
                    break;
                case 3:
                    $CAPRA_S = "> 5";
                    break;
            }
        }
    }
    //MARKERS-------------------------
    $RA1 = NULL;
    $RA2 = NULL;
    $PTEN = NULL;
    $ERG = NULL;
    $KI_67 = NULL;
    $SPINK1 = NULL;
    $C_MYC = NULL;

    if(isset($_POST["boolMarkers"])){
        if($_POST['markers1'] != ''){
            $RA1 = $_POST['markers1'];
        }
        if($_POST['markers2'] != ''){
            $RA2 = $_POST['markers2'];
        }
        if($_POST['markers3'] != ''){
            $PTEN = $_POST['markers3'];
        }
        if($_POST['markers4'] != ''){
            $ERG = $_POST['markers4'];
        }
        if($_POST['markers5'] != ''){
            $KI_67 = $_POST['markers5'];
        }
        if($_POST['markers6'] != ''){
            $SPINK1 = $_POST['markers6'];
        }
        if($_POST['markers7'] != ''){
            $C_MYC = $_POST['markers7'];
        }
    }

    //PROSTATE-------------------------    
    $GLEASON2 = NULL;
    $BILAT2 = NULL;
    $VOLUMEN = NULL;
    $EXTRACAP = NULL;
    $VVSS = NULL;
    $PINAG = NULL;
    $MARGEN = NULL;
    $TNM2 = NULL;

    if(isset($_POST["boolProstate"])){
        if($_POST["prostate1"] != ""){
            $GLEASON2 = $_POST['prostate1'];
        }
        if($_POST["prostate2"] != ""){
            $BILAT2 = $_POST['prostate2'];
        }
        if(isset($_POST["boolProstate3"])){
            if($_POST["prostate3"] != ''){
                $VOLUMENOP = minormayor("prostate3");
                $VOLUMEN = $VOLUMENOP." ".$_POST['prostate3'];
            }
        }
        if($_POST["prostate4"] != ''){
            $EXTRACAP = $_POST['prostate4'];
        }
        if($_POST["prostate5"] != ''){
            $VVSS = $_POST['prostate5'];
        }
        if($_POST["prostate6"] != ''){
            $PINAG = $_POST['prostate6'];
        }
        if($_POST["prostate7"] != ''){
            $MARGEN = $_POST['prostate7'];
        }
        if($_POST["prostate8"] != ''){
            $TNM2 = $_POST['prostate8'];
        }
    }
    
    //SOCIODEMOGRAPHIC--------------------
    $EDAD = NULL;
    
    if(isset($_POST["boolSociodemographic"])){
        if($_POST["sociodemographic1"] != ''){
            $EDADOP = minormayor("sociodemographic1");
            $EDAD = $EDADOP." ".$_POST['sociodemographic1'];
        }
    }
        
    $get_req = array(
        //paging-------------
        "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
        "num_elems" => $NUM_ELEMENTS_BY_PAGE,
        //biopsy-------------
        "GLEASON1" => $GLEASON1,
        "NCILPOS" => $NCILPOS,
        "PORCENT" => $PORCENT,
        "TNM1" => $TNM1,
        //cir------------------
        "FECHACIR" => $FECHACIR,
        //clinic---------------
        "PSAPRE" => $PSAPRE,
        //evolve---------------
        "PSAPOS" => $PSAPOS,
        "RTPADYU" => $RTPADYU,
        "RTPMES" => $RTPMES,
        "RBQ" => $RBQ,
        "TRBQ" => $TRBQ,
        "T1MTX" => $T1MTX,
        "TSEGUI" => $TSEGUI,
        "PSAFIN" => $PSAFIN,
        "CAPRA-S" => $CAPRA_S,
        //markers--------------
        "RA-NUCLEAR" => $RA1,
        "RA-ESTROMA" => $RA2,
        "PTEN" => $PTEN,
        "ERG" => $ERG,
        "KI-67" => $KI_67,
        "SPINK1" => $SPINK1,
        "C-MYC" => $C_MYC,
        //prostate-------------
        "GLEASON2" => $GLEASON2,
        "VOLUMEN" => $VOLUMEN,
        "EXTRACAP" => $EXTRACAP,
        "VVSS" => $VVSS,
        "PINAG" => $PINAG,
        "MARGEN" => $MARGEN,
        "TNM2" => $TNM2,
        //sociodemographic-----
        "EDAD" => $EDAD
    );
    if(!isset($_SESSION["get_req"])){
        $_SESSION["get_req"] = $get_req;
    }
    else{
        $_SESSION["get_req"]["offset"] = ($page - 1) * $NUM_ELEMENTS_BY_PAGE;
        $_SESSION["get_req"]["num_elems"] = $NUM_ELEMENTS_BY_PAGE;
    }

    $http_requests = new HttpRequests();

    $response = $http_requests->getResponse("$BACKEND_URL/getQuery", "GET", http_build_query($_SESSION["get_req"]), $user->get_token());

    $father = "viewQuery.php";
    
    require("../common/viewTable.php");
?>