<?php

    require_once("../models/User.php");

    session_start();
    $user = $_SESSION["user"];

    $filename = "plantilla_datos_pacientes.xlsx";      
   
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);
    exit;
    

?>
