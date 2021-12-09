<?php
    $ch = curl_init();

    $post_req = array(
        "name" => htmlspecialchars($_POST["name"]),
        "surname_1" => htmlspecialchars($_POST["surname_1"]),
        "surname_2" => htmlspecialchars($_POST["surname_2"]),
        "email" => htmlspecialchars($_POST["email"]), 
        "password" => password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT)
    );

    curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/register");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_req);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    curl_close($ch);
    $response_array = json_decode($response,true);
    $status = $response_array["status"];
    
    if($status == 200){
        $email = $post_req["email"];
        header("Location: ../pending.php?email=$email");
    }
    else{
        header("Location: ../login.php?message=Hay%un%error");
    }

?>