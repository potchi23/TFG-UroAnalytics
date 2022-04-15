<?php
    require_once("../models/User.php");
    require_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];
    $predictionResult = $_POST["prediction-result"];

    if($predictionResult == "SI (CASOS)"){
        $result = 1;
    }
    else if($predictionResult == "NO (CONTROLES)"){
        $result = 2;
    }
    else if($predictionResult == "PERSISTENCIA PSA"){
        $result = 3;
    }
    else{
        header("Location: ../predictions/patients.php");
    }

    $patch_req = array(
        "predictionResult" => $result
    );

    $patientId = $_POST["patientId"];

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/patients/$patientId", "PATCH", $patch_req, $user->get_token());

    if($response["status"] == 200) {
        header("Location: ../predictions/patients.php");
    }
    else{
        $_SESSION["error"] ="Hay un error desconocido en el servidor. Póngase en contacto con el administrador.";
        
        header("Location: ../login.php");
    }
?>
