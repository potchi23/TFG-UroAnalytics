<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();

    $_SESSION["error"] = array();

    $user = $_SESSION["user"];
    $id = $user->get_id();
    $name = htmlspecialchars($_POST["name"]);
    $surname_1 = htmlspecialchars($_POST["surname_1"]);
    $surname_2 = htmlspecialchars($_POST["surname_2"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    
    append_error_message(strlen($name) <= 0, "El nombre no puede ser vacío");
    append_error_message(strlen($name) >= 20, "El nombre no puede tener más de 20 carácteres");
    append_error_message(strlen($surname_1) <= 0, "El apellido 1 no puede ser vacío");
    append_error_message(strlen($surname_1) >= 20, "El Apellido 1 no puede tener más de 20 carácteres");
    append_error_message(strlen($surname_2) <= 0, "El apellido 2 no puede ser vacío");
    append_error_message(strlen($surname_2) >= 20, "El Apellido 2 no puede tener más de 20 carácteres");
    append_error_message(strlen($email) <= 0, "El email no puede ser vacío");
    append_error_message(strlen($email) > 50, "El email  no puede tener más de 50 carácteres");
    append_error_message(strlen($email) > 0 && strlen($email) <= 50 && !filter_var($email, FILTER_VALIDATE_EMAIL), "$email no es un email válido");
    append_error_message($_POST["password"] != $_POST["password_confirm"], "Las contraseñas no coinciden");
    append_error_message(strlen($_POST["password"]) > 0 && !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST["password"]), "La contraseña debe contener al menos 8 carácteres alfanuméricos con mayúsculas y minúsculas");
 
    if (count($_SESSION["error"]) > 0) {
        header("Location: ../userProfile.php");
    }
    else {
        $patch_req = array(
            "name" => $name,
            "surname_1" => $surname_1,
            "surname_2" => $surname_2,
            "email" => $email,
            "password" => $password
        );

        $http_requests = new HttpRequests();
        $response = $http_requests->getResponse("$BASE_URL/users/$id", "PATCH", $patch_req, $user->get_token());

        if($response["status"] == 200) {
            $user->set_name($name);
            $user->set_surname_1($surname_1);
            $user->set_surname_2($surname_2);
            $user->set_email($email);

            $message = urlencode("Usuario actualizado");
            header("Location: ../userProfile.php?message=$message");
        }
        else {
            if($response["status"] == 401){
                unset($_SESSION["user"]);
                $message = urlencode("La sesión ha caducado");
                header("Location: ../login.php?message=$message");
            }
        }
    }

    function append_error_message($is_not_valid, $error_msg){
        if($is_not_valid){
            array_push($_SESSION["error"], $error_msg);
        }
    }
?>