<?php

    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/exportdb", "POST", "", $user->get_token());


    if($response["status"] == 200) {
        
        $url = "../data/tmp/datos_pacientes.xlsx";
        
        if(file_exists($url)) {
            $mime_type = mime_content_type($url);
            
            ob_end_clean();
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . basename($url) . '"');
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Content-Length: ' . filesize($url));
            readfile($url);
            exit;
        }
        else {
            $_SESSION["error"] = "No existe el fichero datos_pacientes.xlsx";
        }
    }
    else {
        if($response["status"] == 401) {
            unset($_SESSION["user"]);
            $_SESSION["error"] = "La sesión ha caducado";
            header("Location: ../login.php");
        }
        else {
            $_SESSION["error"] = "Error al exportar los datos de los pacientes";
            header("Location: ../data/exportdb.php");
        }
    }
?>
