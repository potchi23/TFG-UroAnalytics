<?php

    require_once("../models/User.php");
    require_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];

    $target_dir = "tmp/";
    $target_file = $target_dir . basename($_FILES["import-data"]["name"]);

    if($_FILES['import-data']['size'] == 0) {
        $_SESSION["error"] = "No se ha seleccionado ningun un fichero";
        header("Location: ../patients/importdb.php");
    }
    else {
        $fileType = strtolower(pathinfo($_FILES['import-data']['name'], PATHINFO_EXTENSION));
        
        if($fileType != "xls" && $fileType != "xlsx") {
            $_SESSION["error"] = "Solo se permiten ficheros con formato .xls y .xlsx";
            header("Location: ../patients/importdb.php");
        }
        else {
            if(!file_exists($target_dir)) {
                if(!mkdir($target_dir, 0777, true)) {
                    array_push($_SESSION["error"], "Sorry, cannot create the " . $target_dir . "directory");
                }            
            }
            
            if(!copy($_FILES["import-data"]["tmp_name"], $target_file)) {
                array_push($_SESSION["error"], "Sorry, there was an error uploading your file");
            }
            else{
                $handle = fopen($target_file, "r");
                $data = fread($handle, filesize($target_file));
                $post_req = array(
                    "file" => base64_encode($data)
                );
                
                fclose($handle);
                unlink($target_file);

                $http_requests = new HttpRequests();
                $response = $http_requests->getResponse("$BACKEND_URL/database", "POST", $post_req, $user->get_token());

                if($response["status"] == 200) {
                    $num_entries = $response["data"]->num_entries;
                    $_SESSION["message"] = "Se han introducido $num_entries pacientes";
                    header("Location: ../patients/importdb.php");
                }
                else {
                    if($response["status"] == 401) {
                        unset($_SESSION["user"]);
                        $_SESSION["error"] = "La sesión ha caducado";
                        header("Location: ../login.php");
                    }
                    else {
                        $_SESSION["error"] = "Error. El excel importado no cumple con los requisitos. ".$response["data"]->errorMSG;
                    
                        header("Location: ../patients/importdb.php");
                    }
                }
            }
        }
    }
?>
