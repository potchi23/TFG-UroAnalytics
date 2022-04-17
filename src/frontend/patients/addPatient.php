<?php
    include_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");

    session_start();

    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Añadir un paciente</title>
        <?php include_once("../common/includes.php");?>
    </head>
    <body>
        <div class="header">
            <?php include_once("../common/header.php");?>
        </div> 
        <div class="sidebar-container">
            <?php include_once("sidebarPatients.php")?>
        </div>  
        <div class="jumbotron">
            <div class="d-flex justify-content-between input-group prediction-data">

            <?php
                if(!isset($_SESSION["dataInputs"])) {
                    include("empty-form.php");
                }
                else {
                    include("filled-form.php");
                    unset($_SESSION["dataInputs"]);
                }
            ?>
            </div>
            <div class="training-form">
                <form action="../requests/addPatientRequest.php" method="post">
                    <label for="patient-button" class="submit btn btn-success">
                        Añadir
                    </label>
                    <input id="patient-button" type="submit"/> 
                    <button class="btn btn-primary ml-4" type="submit">Añadir</button>
                </form>
            </div>
    </body>
</html>