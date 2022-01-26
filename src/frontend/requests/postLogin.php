<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");

    session_start();

    $post_req = array(
        "email" => $_POST["email"], 
        "password" => $_POST["password"]
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponseData("http://localhost:5000/login", "POST", $post_req);
    $data = $response["data"];

    $id = $data->id;
    $name = $data->name;
    $surname_1 = $data->surname_1;
    $surname_2 = $data->surname_2;
    $email = $data->email;
    $accepted = $data->accepted;
    $type = $data->type;
    $token = $data->token;

    $is_registered = $data->is_registered;
    
    if($response["status"] == 200) {
        $_SESSION["user"] = new User($id, $name, $surname_1, $surname_2, $email, $type, $accepted, $token);

        header("Location: ../dashboard.php");
    }
    else if($response["status"] == 404){
        if($is_registered && $accepted){
            $error = urlencode("Email o password incorrectos");
            header("Location: ../login.php?error=$error");
        }
        else if (!$is_registered || !$accepted){
            $error = urlencode("El usuario no está registrado");
            header("Location: ../login.php?error=$error");
        }
    }
?>
