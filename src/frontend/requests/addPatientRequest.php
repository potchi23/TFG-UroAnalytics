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
            "FECHACIR" =>$FECHACIR,
            "EDAD" =>$EDAD,
            "ETNIA" =>$ETNIA,
            "HTA" =>$HTA,
            "DM" =>$DM,
            "TABACO" =>$TABACO,
            "HEREDA" =>$HEREDA,
            "TACTOR" =>$TACTOR,
            "PSAPRE" =>$PSAPRE,
            "PSALT" =>$PSALT,
            "TDUPPRE" =>$TDUPPRE,
            "ECOTR" =>$ECOTR,
            "NBIOPSIA" =>$NBIOPSIA,
            "HISTO" =>$HISTO,
            "GLEASON1" =>$GLEASON1,
            "NCILPOS" =>$NCILPOS,
            "BILAT" =>$BILAT,
            "PORCENT" =>$PORCENT,
            "IPERIN" =>$IPERIN,
            "ILINF" =>$ILINF,
            "IVASCU" =>$IVASCU,
            "TNM1" =>$TNM1,
            "HISTO2" =>$HISTO2,
            "GLEASON2" =>$GLEASON2,
            "BILAT2" =>$BILAT2,
            "LOCALIZ" =>$LOCALIZ,
            "MULTIFOC" =>$MULTIFOC,
            "VOLUMEN" =>$VOLUMEN,
            "EXTRACAP" =>$EXTRACAP,
            "VVSS" =>$VVSS,
            "IPERIN2" =>$IPERIN2,
            "ILINF2" =>$ILINF2,
            "IVASCU2" =>$IVASCU2,
            "PINAG" =>$PINAG,
            "MARGEN" =>$MARGEN,
            "TNM2" =>$TNM2,
            "PSAPOS" =>$PSAPOS,
            "RTPADYU" =>$RTPADYU,
            "RTPMES" =>$RTPMES,
            "RBQ" =>$RBQ,
            "TRBQ" =>$TRBQ,
            "TDUPLI" =>$TDUPLI,
            "T1MTX" =>$T1MTX,
            "FECHAFIN" =>$FECHAFIN,
            "t_seg" =>$t_seg,
            "FALLEC" =>$FALLEC,
            "TSUPERV" =>$TSUPERV,
            "TSEGUI" =>$TSEGUI,
            "PSAFIN" =>$PSAFIN,
            "CAPRA_S" =>$CAPRA_S,
            "RA-NUCLEAR" =>$RA_NUCLEAR,
            "RA-ESTROMA" =>$RA_ESTROMA,
            "PTEN" =>$PTEN,
            "ERG" =>$ERG,
            "KI_67" =>$KI_67,
            "SPINK1" =>$SPINK1,
            "C_MYC" =>$C_MYC,
            "NOTAS" =>$NOTAS,
            "IMC" =>$IMC,
            "ASA" =>$ASA,
            "GR" =>$GR,
            "PNV" =>$PNV,
            "TQ" =>$TQ,
            "TH" =>$TH,
            "NGG" =>$NGG,
            "PGG" =>$PGG
        );

        $http_requests = new HttpRequests();
        $response = $http_requests->getResponse("$BACKEND_URL/patients", "POST", $post_req);
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