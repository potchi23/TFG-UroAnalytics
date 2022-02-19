<?php
    session_start();

    $target_dir = "tmp/";
    $target_file = $target_dir . basename($_FILES["prediction-import"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if($fileType != "csv") {
        echo "Solo se permiten ficheros CSV.";
    } 

    else if ($_FILES["prediction-import"]["size"] > 2000) {
        echo "El fichero es muy grande.";
    }
    
    else{
        if (move_uploaded_file($_FILES["prediction-import"]["tmp_name"], $target_file)) {
            $file = fopen($target_file,"r");
            $header = fgetcsv($file, 0, ";");
            $data = fgetcsv($file, 0, ";");

            $_SESSION["dataInputs"] = array();

            $i = 0;
            foreach($header as $column){
                $_SESSION["dataInputs"] += [$column => $data[$i]];
                $i++;
            }

            echo $_SESSION["dataInputs"]["EDAD"];
            fclose($file);
            unlink($target_file);

            header("Location: predictions.php");
        } 
        else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>