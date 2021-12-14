<?php
    include_once("../models/User.php");
    session_start();

    $ch = curl_init();
    $error = "";

    $user = $_SESSION["user"];
    $id = $user->get_id();
    $name = htmlspecialchars($_POST["name"]);
    $surname_1 = htmlspecialchars($_POST["surname_1"]);
    $surname_2 = htmlspecialchars($_POST["surname_2"]);
    $email = htmlspecialchars($_POST["email"]);

    $error = append_error_message($error, strlen($name) <= 0, "El%20nombre%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($name) >= 20, "El%20nombre%20no%20puede%20tener%20más%20de%2020%20carácteres");
    $error = append_error_message($error, strlen($surname_1) <= 0, "El%20apellido%201%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($surname_1) >= 20, "El%20Apellido%201%20no%20puede%20tener%20más%20de%2020%20carácteres");
    $error = append_error_message($error, strlen($surname_2) <= 0, "El%20apellido%202%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($surname_2) >= 20, "El%20Apellido%202%20no%20puede%20tener%20más%20de%2020%20carácteres");
    $error = append_error_message($error, strlen($email) <= 0, "El%20email%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($email) > 50, "El%20email%20%20no%20puede%20tener%20más%20de%2050%20carácteres");
    $error = append_error_message($error, strlen($email) > 0 && strlen($email) <= 50 && !filter_var($email, FILTER_VALIDATE_EMAIL), "$email%20no%20es%20un%20email%20válido");
 
    if (strlen($error) > 0) {
        header("Location: ../userProfile.php?error=$error");
    }
    else {
        $post_req = array(
            "name" => $name,
            "surname_1" => $surname_1,
            "surname_2" => $surname_2,
            "email" => $email
        );
        
        $url = "http://localhost:5000/users/" . $id;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH'); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_req);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        
        curl_close($ch);

        $response_array = json_decode($response,true);

        if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 200) {
            $user->set_name($name);
            $user->set_surname_1($surname_1);
            $user->set_surname_2($surname_2);
            $user->set_email($email);
            header("Location: ../userProfile.php?Usuario%20actualizado");
        }
        else {
            echo "Error code: " . curl_getinfo($ch, CURLINFO_RESPONSE_CODE) . "\n";
            echo $url;
        }
    }

    function append_error_message($error, $is_not_valid, $error_msg){
        if(strlen($error) > 0){
            $error .= ",";
        }

        if($is_not_valid){
            $error .= $error_msg;
        }

        return $error;
    }
?>