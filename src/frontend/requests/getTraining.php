<?php
    require_once("../models/User.php");
    require_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/training", "GET", "", $user->get_token());

    if ($response["status"] == 200){
        header("Location: ../predictions/predictions.php");
    }
    else{
        if ($response["status"] == 401){
            unset($_SESSION["user"]);
            $_SESSION["message"] = "La sesión ha caducado";
            header("Location: ../login.php");
        }
    }
?>