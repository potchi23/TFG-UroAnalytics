<?php
    session_start();

    $_SESSION["error"] = array();

    $target_dir = "tmp/";
    $target_file = $target_dir . basename($_FILES["prediction-import"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if($fileType != "csv") {
        array_push($_SESSION["error"], "Solo se permiten ficheros CSV");
    }

    else if ($_FILES["prediction-import"]["size"] > 2000) {
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
            $file = fopen($target_file,"r");
            $header = fgetcsv($file, 0, ";");
            $data = fgetcsv($file, 0, ";");

            $_SESSION["dataInputs"] = array();

            $i = 0;
            foreach($header as $column){
                $_SESSION["dataInputs"] += [$column => $data[$i]];
                $i++;
            }

            fclose($file);
            unlink($target_file);
            header("Location: predictions.php");
        }        
    }

    if (count($_SESSION["error"]) > 0) {
        header("Location: predictions.php");
    }
    else {
        $_SESSION["message"] = "Fichero csv importado con éxito";
    }
?>