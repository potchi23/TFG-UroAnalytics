<?php

    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];


    if($_FILES['import-data']['size'] == 0) {
        $_SESSION["error"] = "No se ha seleccionado ningun un fichero";
        header("Location: ../data/importdb.php");
    }
    else {
        $fileType = strtolower(pathinfo($_FILES['import-data']['name'], PATHINFO_EXTENSION));
        
        if($fileType != "xls" && $fileType != "xlsx") {
            $_SESSION["error"] = "Solo se permiten ficheros con formato .xls y .xlsx";
            header("Location: ../data/importdb.php");
        }
        else {
            move_uploaded_file($_FILES['import-data']['tmp_name'], dirname(dirname(__DIR__)).'/backend/tmp_uploads/'.$_FILES['import-data']['name']);        
            
            $post_req = array(
                "filename" => $_FILES['import-data']['name']
            );

            $http_requests = new HttpRequests();
            $response = $http_requests->getResponse("$BACKEND_URL/importdb", "POST", $post_req, $user->get_token());

            if($response["status"] == 200) {
                $num_entries = $response["data"]->num_entries;
                $_SESSION["message"] = "Se han introducido $num_entries pacientes";
                header("Location: ../data/importdb.php");
            }
            else {
                if($response["status"] == 401) {
                    unset($_SESSION["user"]);
                    $_SESSION["error"] = "La sesión ha caducado";
                    header("Location: ../login.php");
                }
                else {
                    $_SESSION["error"] = "No se ha podido importar los datos";
                }
            }
        }
    }
?>
