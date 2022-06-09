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

    if($_FILES["prediction-import"]["name"] == ""){
        array_push($_SESSION["error"], "No se ha seleccionado ningún fichero");
    }

    else if($fileType != "csv" && $fileType != "xls" && $fileType != "xlsx") {
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
            $http_requests = new HttpRequests();

            if($fileType == "csv"){
                $file = fopen($target_file,"r");
                $header = fgetcsv($file, 0, ";");
                $data = fgetcsv($file, 0, ";");
                
                $columns_response = $http_requests->getResponse("$BACKEND_URL/getColumns", "GET", "", $user->get_token());
                $db_columns = $columns_response["data"]->data;

                $i = 0;
                foreach($header as $column){
                    if(in_array($column, $db_columns)){
                        $_SESSION["dataInputs"] += [$column => $data[$i]];
                    }
                    $i++;
                }

                fclose($file);
                unlink($target_file);
                $_SESSION["message"] = "Se importado el paciente correctamente";
                header("Location: predictions.php#dataPatients");
            }
            else{
                $handle = fopen($target_file, "r");
                $data = fread($handle, filesize($target_file));
                $post_req = array(
                    "file" => base64_encode($data)
                );
                
                fclose($handle);
                unlink($target_file);

                $response = $http_requests->getResponse("$BACKEND_URL/import_prediction", "POST", $post_req, $user->get_token());
                $columns_response = $http_requests->getResponse("$BACKEND_URL/getColumns", "GET", "", $user->get_token());
                $db_columns = $columns_response["data"]->data;

                $data = $response["data"];
                if($response["status"] == 200) {
                    foreach($data as $column=>$value){
                        if(in_array($column, $db_columns)){
                            $_SESSION["dataInputs"] += [$column => $value->{'0'}];
                        }
                    }
  
                    $_SESSION["message"] = "Se importado el paciente correctamente";
                    header("Location: predictions.php#dataPatients");
                }
                else {
                    unset($_SESSION["dataInputs"]);
                    if($response["status"] == 401) {
                        unset($_SESSION["user"]);
                        array_push($_SESSION["error"], "La sesión ha caducado");
                        header("Location: ../login.php");
                    }
                    else {
                        array_push($_SESSION["error"], "ERROR: El excel importado no cumple con los requisitos. ".$response["data"]->errorMSG);
                    
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