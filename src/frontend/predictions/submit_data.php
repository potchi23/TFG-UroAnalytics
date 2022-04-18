<?php
    require_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");
    session_start();

    $user = $_SESSION["user"];
    $_SESSION["error"] = array();

    $target_dir = "tmp/";
    $target_file = $target_dir . basename($_FILES["prediction-import"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if($fileType != "csv" && $fileType != "xls" && $fileType != "xlsx") {
        array_push($_SESSION["error"], "Solo se permiten ficheros CSV y Excel");
    }

    else if ($_FILES["prediction-import"]["size"] > 200000) {
        array_push($_SESSION["error"], "El fichero es muy grande");
    }
    
    else {
        if(!file_exists($target_dir)) {
            if(!mkdir($target_dir, 0777, true)) {
                array_push($_SESSION["error"], "Sorry, cannot create the " . $target_dir . "directory");
            }            
        }
                
        if(!copy($_FILES["prediction-import"]["tmp_name"], $target_file)) {
            array_push($_SESSION["error"], "Sorry, there was an error uploading your file");
        }
        else {
            $_SESSION["dataInputs"] = array();

            if($fileType == "csv"){
                $file = fopen($target_file,"r");
                $header = fgetcsv($file, 0, ";");
                $data = fgetcsv($file, 0, ";");

                $i = 0;
                foreach($header as $column){
                    $_SESSION["dataInputs"] += [$column => $data[$i]];
                    $i++;
                }

                fclose($file);
                unlink($target_file);
                $_SESSION["message"] = "Fichero CSV importado con éxito";
                header("Location: predictions.php#dataPatients");
            }
            else{
                $post_req = array(
                    "filename" => $_FILES['prediction-import']['name']
                );
    
                $http_requests = new HttpRequests();
                $response = $http_requests->getResponse("$BACKEND_URL/import_prediction", "POST", $post_req, $user->get_token());
                $data = $response["data"];
                if($response["status"] == 200) {
                    

                    foreach($data as $column=>$value){
                        $_SESSION["dataInputs"] += [$column => $value->{'0'}];
                    }
  
                    $_SESSION["message"] = "Se importado el paciente correctamente";
                    header("Location: predictions.php#dataPatients");
                }
                else {
                    unset($_SESSION["user"]);
                    unset($_SESSION["dataInputs"]);
                    if($response["status"] == 401) {
                        $_SESSION["error"] = "La sesión ha caducado";
                        header("Location: ../login.php");
                    }
                    else {
                        $_SESSION["error"] = "Error. El excel importado no cumple con los requisitos. ".$response["data"]->errorMSG;
                    
                        header("Location: ../predictions/predictions.php");
                    }
                }
            }
        }        
    }

    if (count($_SESSION["error"]) > 0) {
        header("Location: predictions.php#dataPatients");
    }

?>