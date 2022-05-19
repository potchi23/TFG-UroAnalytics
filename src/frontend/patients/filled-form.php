<?php

    require_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");

    $user = $_SESSION["user"];

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/patients/variables", "GET", "", $user->get_token());

    $data_array = $response["data"]->data;
    asort($data_array);
    
    if ($response["status"] == 200){
        foreach($response["data"]->data as $column){
            echo <<<EOL
            <div class="input-group-prepend">
                <span class="input-group-text">$column</span>
                <input class="patient-form-input" type="text" id="$column" name="$column" placeholder="$column" value="{$_SESSION["dataInputs"][$column]}">
            </div>
            EOL;
        }
    }
    else{
        if ($response["status"] == 401){
            unset($_SESSION["user"]);
            $_SESSION["message"] = "La sesión ha caducado";
            header("Location: ../login.php");
        }
    }
?>