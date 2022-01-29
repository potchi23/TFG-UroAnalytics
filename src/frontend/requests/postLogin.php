<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();

    $post_req = array(
        "email" => $_POST["email"], 
        "password" => $_POST["password"]
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BASE_URL/login", "POST", $post_req);
    
    $data = $response["data"];

    $accepted = $data->accepted;
    $is_registered = $data->is_registered;
    
    if($response["status"] == 200) {
        $id = $data->id;
        $name = $data->name;
        $surname_1 = $data->surname_1;
        $surname_2 = $data->surname_2;
        $email = $data->email;
        $type = $data->type;
        $token = $data->token;
        $_SESSION["user"] = new User($id, $name, $surname_1, $surname_2, $email, $type, $accepted, $token);

        header("Location: ../dashboard.php");
    }
    else if($response["status"] == 401){
        
        if($is_registered && $accepted){
            $error = urlencode("Contraseña incorrecta");
            header("Location: ../login.php?error=$error");
        }
        else{
            $error = urlencode("El usuario no está registrado");
            header("Location: ../login.php?error=$error");
        }
    }
?>
