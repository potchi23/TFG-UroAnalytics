<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/training", "GET", "", $user->get_token());

    if ($response["status"] == 200){
        $_SESSION["scores"] = $response["data"];
        
        header("Location: ../predictions/predictions.php");
    }
?>