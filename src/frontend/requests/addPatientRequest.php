<?php
    require_once("HttpRequests.php");
    require_once("../config/config.php");
    require_once("../models/User.php");


    session_start();

    $user = $_SESSION["user"];
    
    $_SESSION["error"] = array();

    if (count($_SESSION["error"]) > 0){
        header("Location:  ../patients/patientsIndex.php");
    }

    else {
        $post_req = array(
            "FECHACIR" =>$_POST['FECHACIR'],
            "EDAD" =>$_POST['EDAD'],
            "ETNIA" =>$_POST['ETNIA'],
            "OBESO" => $_POST['OBESO'],
            "HTA" =>$_POST['HTA'],
            "DM" =>$_POST['DM'],
            "TABACO" =>$_POST['TABACO'],
            "HEREDA" =>$_POST['HEREDA'],
            "TACTOR" =>$_POST['TACTOR'],
            "PSAPRE" =>$_POST['PSAPRE'],
            "PSALT" =>$_POST['PSALT'],
            "TDUPPRE" =>$_POST['TDUPPRE'],
            "ECOTR" =>$_POST['ECOTR'],
            "NBIOPSIA" =>$_POST['NBIOPSIA'],
            "HISTO" =>$_POST['HISTO'],
            "GLEASON1" =>$_POST['GLEASON1'],
            "NCILPOS" =>$_POST['NCILPOS'],
            "BILAT" =>$_POST['BILAT'],
            "PORCENT" =>$_POST['PORCENT'],
            "IPERIN" =>$_POST['IPERIN'],
            "ILINF" =>$_POST['ILINF'],
            "IVASCU" =>$_POST['IVASCU'],
            "TNM1" =>$_POST['TNM1'],
            "HISTO2" =>$_POST['HISTO2'],
            "GLEASON2" =>$_POST['GLEASON2'],
            "BILAT2" =>$_POST['BILAT2'],
            "LOCALIZ" =>$_POST['LOCALIZ'],
            "MULTIFOC" =>$_POST['MULTIFOC'],
            "VOLUMEN" =>$_POST['VOLUMEN'],
            "EXTRACAP" =>$_POST['EXTRACAP'],
            "VVSS" =>$_POST['VVSS'],
            "IPERIN2" =>$_POST['IPERIN2'],
            "ILINF2" =>$_POST['ILINF2'],
            "IVASCU2" =>$_POST['IVASCU2'],
            "PINAG" =>$_POST['PINAG'],
            "MARGEN" =>$_POST['MARGEN'],
            "TNM2" =>$_POST['TNM2'],
            "PSAPOS" =>$_POST['PSAPOS'],
            "RTPADYU" =>$_POST['RTPADYU'],
            "RTPMES" =>$_POST['RTPMES'],
            "RBQ" =>$_POST['RBQ'],
            "TRBQ" =>$_POST['TRBQ'],
            "T1MTX" =>$_POST['T1MTX'],
            "FECHAFIN" =>$_POST['FECHAFIN'],
            "t_seg" =>$_POST['t_seg'],
            "FALLEC" =>$_POST['FALLEC'],
            "TSUPERV" =>$_POST['TSUPERV'],
            "TSEGUI" =>$_POST['TSEGUI'],
            "PSAFIN" =>$_POST['PSAFIN'],
            "CAPRA-S"=>$_POST['CAPRA-S'],
            "RA-NUCLEAR" =>$_POST['RA-NUCLEAR'],
            "RA-ESTROMA" =>$_POST['RA-ESTROMA'],
            "PTEN" =>$_POST['PTEN'],
            "ERG" =>$_POST['ERG'],
            "KI-67" =>$_POST['KI-67'],
            "SPINK1" =>$_POST['SPINK1'],
            "C-MYC" =>$_POST['C-MYC'],
            "NOTAS" =>$_POST['NOTAS'],
            "IMC" =>$_POST['IMC'],
            "ASA" =>$_POST['ASA'],
            "GR" =>$_POST['GR'],
            "PNV" =>$_POST['PNV'],
            "TH" =>$_POST['TH'],
            "PGG" =>$_POST['PGG']
        );

        $http_requests = new HttpRequests();
        $response = $http_requests->getResponse("$BACKEND_URL/patients", "POST", $post_req,  $user->get_token());
        $data = $response["data"];

        $db_errno = $data->errno;

        if($response["status"] == 200){
            header("Location:  ../patients/patientsIndex.php");
        }
        else{
            $_SESSION["error"] = array();

                array_push($_SESSION["error"], "Hay un error desconocido en el servidor. Póngase en contacto con el administrador.");
            
            header("Location: ../patients/patientsIndex.php");
        }
    }

    function append_error_message($is_not_valid, $error_msg){
        if($is_not_valid){
            array_push($_SESSION["error"], $error_msg);
        }
    }
?>