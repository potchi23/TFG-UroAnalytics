<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();

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
        $NCILPOS = $_POST['biopsy2'];
        $PORCENTOP = minormayor("biopsy3");
        $PORCENT = $PORCENTOP." ".$_POST['biopsy3'];
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
        $PSAPRE = $_POST['clinic1'];
    }

    //EVOLVE-------------------------
    $PSAPOS = NULL;
    $RTPADYU = NULL;
    $RTPMES = NULL;
    $RBQ = NULL;
    $TRBQ = NULL;
    $TDUPLI = NULL;
    $T1MTX = NULL;
    $TSEGUI = NULL;
    $PSAFIN = NULL;
    $CAPRA_S = NULL;

    if(isset($_POST["boolEvolve"])){
        $PSAPOSOP = minormayor("evolve1");
        $PSAPOS = $PSAPOSOP." ".$_POST["evolve1"];
        $RTPADYU = $_POST["evolve2"];
        $RTPMESOP = minormayor("evolve3");
        $RTPMES = $RTPMESOP." ".$_POST["evolve3"];
        $RBQ = $_POST["evolve4"];
        $TRBQ = $_POST["evolve5"];
        $TDUPLI = $_POST["evolve6"];        
        $T1MTXOP = minormayor("evolve7");
        $T1MTX = $T1MTXOP." ".$_POST["evolve7"];
        $TSEGUIOP = minormayor("evolve8");
        $TSEGUI = $TSEGUIOP." ".$_POST['evolve8'];
        $PSAFINOP = minormayor("evolve9");
        $PSAFIN = $PSAFINOP." ".$_POST['evolve9'];
        $CAPRA_S = $_POST['evolve10'];
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
        $RA1 = $_POST['markers1'];
        $RA2 = $_POST['markers2'];
        $PTEN = $_POST['markers3'];
        $ERG = $_POST['markers4'];
        $KI_67 = $_POST['markers5'];
        $SPINK1 = $_POST['markers6'];
        $C_MYC = $_POST['markers7'];
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
        $GLEASON2 = $_POST['prostate1'];
        $BILAT2 = $_POST['prostate2'];
        $VOLUMENOP = minormayor("prostate3");
        $VOLUMEN = $VOLUMENOP." ".$_POST['prostate3'];
        $EXTRACAP = $_POST['prostate4'];
        $VVSS = $_POST['prostate5'];
        $PINAG = $_POST['prostate6'];
        $MARGEN = $_POST['prostate7'];
        $TNM2 = $_POST['prostate8'];
    }
    
    //SOCIODEMOGRAPHIC--------------------
    $EDAD = NULL;
    
    if(isset($_POST["boolSociodemographic"])){
        $EDADOP = minormayor("sociodemographic1");
        $EDAD = $EDADOP." ".$_POST['sociodemographic1'];
    }
        
    $post_req = array(
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
        "TDUPLI" => $TDUPLI,
        "T1MTX" => $T1MTX,
        "TSEGUI" => $TSEGUI,
        "PSAFIN" => $PSAFIN,
        "CAPRA-S" => $CAPRA_S,
        //markers--------------
        "RA-nuclear" => $RA1,
        "RA2-estrom" => $RA2,
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

    print_r($post_req);

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/getQuery", "GET", http_build_query($post_req));

?>