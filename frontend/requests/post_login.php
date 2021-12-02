<?php
    $ch = curl_init();

    $post_req = array("email" => $_POST["email"], "password" => $_POST["password"]);

    curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_req);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    curl_close($ch);
    $response_array = json_decode($response,true);
    $email = $response_array["email"];
    $password = $response_array["password"];

    header("Location: ../dashboard.php?email=$email&password=$password");
?>