<?php
    require_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    
    $_SESSION["error"] = array();

    if (count($_SESSION["error"]) > 0){
        header("Location:  ../patients/patientsIndex.php");
    }

    else {
        $post_req = array(
            "FECHACIR" =>$POST['FECHACIR'],
            "EDAD" =>$POST['EDAD'],
            "ETNIA" =>$POST['ETNIA'],
            "HTA" =>$POST['HTA'],
            "DM" =>$POST['DM'],
            "TABACO" =>$POST['TABACO'],
            "HEREDA" =>$POST['HEREDA'],
            "TACTOR" =>$POST['TACTOR'],
            "PSAPRE" =>$POST['PSAPRE'],
            "PSALT" =>$POST['PSALT'],
            "TDUPPRE" =>$POST['TDUPPRE'],
            "ECOTR" =>$POST['ECOTR'],
            "NBIOPSIA" =>$POST['NBIOPSIA'],
            "HISTO" =>$POST['HISTO'],
            "GLEASON1" =>$POST['GLEASON1'],
            "NCILPOS" =>$POST['NCILPOS'],
            "BILAT" =>$POST['BILAT'],
            "PORCENT" =>$POST['PORCENT'],
            "IPERIN" =>$POST['IPERIN'],
            "ILINF" =>$POST['ILINF'],
            "IVASCU" =>$POST['IVASCU'],
            "TNM1" =>$POST['TNM1'],
            "HISTO2" =>$POST['HISTO2'],
            "GLEASON2" =>$POST['GLEASON2'],
            "BILAT2" =>$POST['BILAT2'],
            "LOCALIZ" =>$POST['LOCALIZ'],
            "MULTIFOC" =>$POST['MULTIFOC'],
            "VOLUMEN" =>$POST['VOLUMEN'],
            "EXTRACAP" =>$POST['EXTRACAP'],
            "VVSS" =>$POST['VVSS'],
            "IPERIN2" =>$POST['IPERIN2'],
            "ILINF2" =>$POST['ILINF2'],
            "IVASCU2" =>$POST['IVASCU2'],
            "PINAG" =>$POST['PINAG'],
            "MARGEN" =>$POST['MARGEN'],
            "TNM2" =>$POST['TNM2'],
            "PSAPOS" =>$POST['PSAPOS'],
            "RTPADYU" =>$POST['RTPADYU'],
            "RTPMES" =>$POST['RTPMES'],
            "RBQ" =>$POST['RBQ'],
            "TRBQ" =>$POST['TRBQ'],
            "T1MTX" =>$POST['T1MTX'],
            "FECHAFIN" =>$POST['FECHAFIN'],
            "t_seg" =>$POST['t_seg'],
            "FALLEC" =>$POST['FALLEC'],
            "TSUPERV" =>$POST['TSUPERV'],
            "TSEGUI" =>$POST['TSEGUI'],
            "PSAFIN" =>$POST['PSAFIN'],
            "CAPRA-S" =>$POST['CAPRA-S'],
            "RA-NUCLEAR" =>$POST['RA_NUCLEAR'],
            "RA-ESTROMA" =>$POST['RA_ESTROMA'],
            "PTEN" =>$POST['PTEN'],
            "ERG" =>$POST['ERG'],
            "KI_67" =>$POST['KI_67'],
            "SPINK1" =>$POST['SPINK1'],
            "C_MYC" =>$POST['C_MYC'],
            "NOTAS" =>$POST['NOTAS'],
            "IMC" =>$POST['IMC'],
            "ASA" =>$POST['ASA'],
            "GR" =>$POST['GR'],
            "PNV" =>$POST['PNV'],
            "TQ" =>$POST['TQ'],
            "TH" =>$POST['TH'],
            "NGG" =>$POST['NGG'],
            "PGG" =>$POST['PGG']
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