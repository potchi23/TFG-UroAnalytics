<?php
   
    require_once("../models/User.php");

    session_start();
    $user = $_SESSION["user"];

    $filename = "manual_usuario.pdf";

    if ($user->is_admin()) {
        $filename = "manual_usuario_admin.pdf";
    }
                      
    header('Content-Type: application/pdf');
    header('Content-Length: ' . filesize($filename));
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);
    exit;            
?>
