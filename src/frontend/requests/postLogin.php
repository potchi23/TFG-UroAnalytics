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
    $data_array = json_decode($response["data"], true);

    $id = $data_array["id"];
    $name = $data_array["name"];
    $surname_1 = $data_array["surname_1"];
    $surname_2 = $data_array["surname_2"];
    $email = $data_array["email"];
    $accepted = $data_array["accepted"];
    $type = $data_array["type"];
    $token = $data_array["token"];

    $is_registered = $data_array["is_registered"];
    
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
