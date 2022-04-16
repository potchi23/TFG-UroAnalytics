<?php   
    require_once("../models/User.php");
    require_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    
    $user = $_SESSION["user"];

    $patientId = htmlspecialchars($_POST["patientId"]);

    header("Location: ../predictions/patients.php?patientId=$patientId");
?>
