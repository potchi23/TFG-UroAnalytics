<?php
    require_once("HttpRequests.php");
    require_once("../config/config.php");
    require_once("../models/User.php");

    session_start();

    $user = $_SESSION["user"];
    
    $_SESSION["error"] = array();

    function isNull($arg){
        $aux = NULL;
        if($_POST[$arg] != ""){
            $aux = $_POST[$arg];
        }
        return $aux;
    }

    if (count($_SESSION["error"]) > 0){
        header("Location:  ../patients/patientsIndex.php");
    }
    else {
        $post_req = array(
            "FECHACIR" => isNull("FECHACIR"), 
            "EDAD" =>isNull("EDAD"), 
            "ETNIA" =>isNull("ETNIA"),
            "OBESO" =>isNull("OBESO"), 
            "HTA" =>isNull("HTA"),
            "DM" =>isNull("DM"),
            "TABACO" =>isNull("TABACO"),
            "HEREDA" =>isNull("HEREDA"),
            "TACTOR" =>isNull("TACTOR"),
            "PSAPRE" =>isNull("PSAPRE"),
            "PSALT" =>isNull("PSALT"),
            "TDUPPRE" =>isNull("TDUPPRE"),
            "ECOTR" =>isNull("ECOTR"),
            "NBIOPSIA" =>isNull("NBIOPSIA"),
            "HISTO" =>isNull("HISTO"),
            "GLEASON1" =>isNull("GLEASON1"),
            "NCILPOS" =>isNull("NCILPOS"),
            "BILAT" =>isNull("BILAT"),
            "PORCENT" =>isNull("PORCENT"),
            "IPERIN" =>isNull("IPERIN"),
            "ILINF" =>isNull("ILINF"),
            "IVASCU" =>isNull("IVASCU"),
            "TNM1" =>isNull("TNM1"),
            "HISTO2" =>isNull("HISTO2"),
            "GLEASON2" =>isNull("GLEASON2"),
            "BILAT2" =>isNull("BILAT2"),
            "LOCALIZ" =>isNull("LOCALIZ"),
            "MULTIFOC" =>isNull("MULTIFOC"),
            "VOLUMEN" =>isNull("VOLUMEN"),
            "EXTRACAP" =>isNull("EXTRACAP"),
            "VVSS" =>isNull("VVSS"),
            "IPERIN2" =>isNull("IPERIN2"),
            "ILINF2" =>isNull("ILINF2"),
            "IVASCU2" =>isNull("IVASCU2"),
            "PINAG" =>isNull("PINAG"),
            "MARGEN" =>isNull("MARGEN"),
            "TNM2" =>isNull("TNM2"),
            "PSAPOS" =>isNull("PSAPOS"),
            "RTPADYU" =>isNull("RTPADYU"),
            "RTPMES" =>isNull("RTPMES"),
            "RBQ" =>isNull("RBQ"),
            "TRBQ" =>isNull("TRBQ"),
            "T1MTX" =>isNull("T1MTX"),
            "FECHAFIN" =>isNull("FECHAFIN"),
            "FALLEC" =>isNull("FALLEC"),
            "TSUPERV" =>isNull("TSUPERV"),
            "TSEGUI" =>isNull("TSEGUI"),
            "PSAFIN" =>isNull("PSAFIN"),
            "CAPRA-S"=>isNull("CAPRA-S"),
            "RA-NUCLEAR" =>isNull("RA-NUCLEAR"),
            "RA-ESTROMA" =>isNull("RA-ESTROMA"),
            "PTEN" =>isNull("PTEN"),
            "ERG" =>isNull("ERG"),
            "KI-67" =>isNull("KI-67"),
            "SPINK1" =>isNull("SPINK1"),
            "C-MYC" =>isNull("C-MYC"),
            "IMC" =>isNull("IMC"),
            "ASA" =>isNull("ASA"),
            "GR" =>isNull("GR"),
            "PNV" =>isNull("PNV"),
            "TH" =>isNull("TH"),
            "PGG" =>isNull("PGG")
        );

        $http_requests = new HttpRequests();
        $response = $http_requests->getResponse("$BACKEND_URL/patients", "POST", http_build_query($post_req), $user->get_token());        
        $data = $response["data"];
        $db_errno = $data->errno;

        if($response["status"] == 200) {
            header("Location:  ../patients/addPatient.php");
            $_SESSION["message"] = "El paciente se ha introducido correctamente";
        }
        else {
            if($response["status"] == 401) {
                unset($_SESSION["user"]);
                array_push($_SESSION["error"], "La sesión ha caducado");
                header("Location: ../login.php");
            }
            else {
                array_push($_SESSION["error"], $response["data"]->errorMSG);
                header("Location: ../patients/addPatient.php");                
            }
        }
    }
?>