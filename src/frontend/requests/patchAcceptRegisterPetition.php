<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    
    $user = $_SESSION["user"];
    
    $patch_req = array(
        "id" => $_POST["id"]
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BASE_URL/register_petitions", "PATCH", $patch_req, $user->get_token());
   
    if($response["status"] == 200) {

        $data = $response["data"];
        $email = $data->email;
        $name = $data->name;

        $subject = 'Estado de solicitud de registro';
        
        $msg = "Hola $name. Te informamos que hemos aceptado tu solicitud de registro.";
        $headers = 'From: tfg@ucm.es' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        //mail($email, $subject, $msg, $headers);
 
        $page = $_GET["numElems"] == 1 ? $_GET["page"] - 1 : $_GET["page"];
        header("Location: ../registerPetitions.php?page=$page");
    }
    else{
        if($response["status"] == 401){
            unset($_SESSION["user"]);
            $_SESSION["message"] = "La sesión ha caducado";
            header("Location: ../login.php");
        }
    }
?>
