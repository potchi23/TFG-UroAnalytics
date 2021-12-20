<?php
   
    include_once("../models/User.php");
    session_start();

    $ch = curl_init();

    $post_req = array(
        "email" => $_POST["email"], 
        "password" => $_POST["password"]
    );

    curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/login");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_req);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    curl_close($ch);
    $response_array = json_decode($response,true);
    $id = $response_array["id"];
    $name = $response_array["name"];
    $surname_1 = $response_array["surname_1"];
    $surname_2 = $response_array["surname_2"];
    $email = $response_array["email"];
    $accepted = $response_array["accepted"];
    $type = $response_array["type"];
    $token = $response_array["token"];

    $is_registered = $response_array["is_registered"];
    
    if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 200) {
        $_SESSION["user"] = new User($id, $name, $surname_1, $surname_2, $email, $type, $accepted, $token);

        header("Location: ../dashboard.php");
    }
    else if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 404){
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
