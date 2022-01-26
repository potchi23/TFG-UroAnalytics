<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");

    session_start();
    
    $user = $_SESSION["user"];
    
    $patch_req = array(
        "id" => $_POST["id"]
    );

    $token = $user->get_token();
    
    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("http://localhost:5000/register_petitions", "PATCH", $patch_req, $token);
   
    if($response["status"] == 200) {
        $data = $response["data"];
        $email = $data->email;
        $name = $data->name;

        $subject = 'Estado de solicitud de registro';
        
        $msg = "Hola $name. Te informamos que hemos aceptado tu solicitud de registro.";
        $headers = 'From: tfg@ucm.es' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        //mail($email, $subject, $msg, $headers);

        header("Location: ../registerPetitions.php");
    }
    else{
        echo "<h1>Hubo un error</h1>";
    }
?>
