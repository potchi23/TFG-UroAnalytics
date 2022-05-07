<?php

    if(!defined('import-form')) {
        die('Direct access not permitted');
    }

    require_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");

    $user = $_SESSION["user"];

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/patients/variables", "GET", "", $user->get_token());
    $data_array = $response["data"]->data;

    if ($response["status"] == 200){
        $ignored_columns = array('N', 'NOTAS', 'FECHACIR', 'FECHAFIN','ETNIA', 'IPERIN', 'ILINF', 'IVASCU', 'ILINF2', 'IVASCU2', 'FALLEC', 'RBQ');

        asort($data_array);
        
        if(isset($_SESSION["dataInputs"])){
            foreach($data_array as $column){
                if(!in_array($column, $ignored_columns)){
                    echo <<<EOL
                    <div class="input-group-prepend">
                        <span class="prediction-form-label input-group-text">$column</span>
                        <input class="prediction-form-input" type="text" id="$column" name="$column" value="{$_SESSION["dataInputs"][$column]}">
                    </div>
                    EOL;
                }
            }

            unset($_SESSION["dataInputs"]);
        }
        else{
            foreach($data_array as $column){
                if(!in_array($column, $ignored_columns)){
                    echo <<<EOL
                    <div class="input-group-prepend">
                        <span class="prediction-form-label input-group-text">$column</span>
                        <input class="prediction-form-input" type="text" id="$column" name="$column">
                    </div>
                    EOL;
                }
            }
        }
    }
    else{
        if ($response["status"] == 401){
            unset($_SESSION["user"]);
            echo "<script>alert('La sesión ha caducado. Vuelva a iniciar sesión.');</script>";
            $_SESSION["message"] = "La sesión ha caducado";
            echo "<script type='text/javascript'>window.location.href = '../login.php';</script>";
        }
    }
?>