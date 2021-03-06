<?php
    require_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    
    $_SESSION["error"] = array();

    $name = htmlspecialchars($_POST["name"]);
    $surname_1 = htmlspecialchars($_POST["surname_1"]);
    $surname_2 = htmlspecialchars($_POST["surname_2"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $password_confirm = htmlspecialchars($_POST["password_confirm"]);

    append_error_message(strlen($name) <= 0, "El nombre no puede ser vacío");
    append_error_message(strlen($name) >= 20, "El nombre no puede tener más de 20 caracteres");
    append_error_message(strlen($surname_1) <= 0, "El apellido 1 no puede ser vacío");
    append_error_message(strlen($surname_1) >= 20, "El Apellido 1 no puede tener más de 20 caracteres");
    append_error_message(strlen($surname_2) <= 0, "El apellido 2 no puede ser vacío");
    append_error_message(strlen($surname_2) >= 20, "El Apellido 2 no puede tener más de 20 caracteres");
    append_error_message(strlen($email) <= 0, "El email no puede ser vacío");
    append_error_message(strlen($email) > 50, "El email  no puede tener más de 50 caracteres");
    append_error_message(strlen($email) > 0 && strlen($email) <= 50 && !filter_var($email, FILTER_VALIDATE_EMAIL), "$email no es un email válido");
    append_error_message(strlen($_POST["password"]) <= 0, "La contraseña no puede ser vacía");
    append_error_message(strlen($_POST["password_confirm"]) <=0, "La confirmación de contraseña no puede ser vacía");
    append_error_message($_POST["password"] != $_POST["password_confirm"], "Las contraseñas no coinciden");
    append_error_message(strlen($_POST["password"]) > 0 && !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST["password"]), "La contraseña debe contener al menos 8 caracteres alfanuméricos con mayúsculas y minúsculas");

    if (count($_SESSION["error"]) > 0){
        header("Location: ../register.php");
    }

    else {
        $post_req = array(
            "name" => $name,
            "surname_1" => $surname_1,
            "surname_2" => $surname_2,
            "email" => $email, 
            "password" => $password,
            "password_confirm" => $password_confirm
        );

        $http_requests = new HttpRequests();
        $response = $http_requests->getResponse("$BACKEND_URL/register", "POST", $post_req);
        $data = $response["data"];

        $db_errno = $data->errno;

        if($response["status"] == 200){
            $_SESSION["email"] = $post_req["email"];
            unset($_SESSION["error"]);
            header("Location: ../pending.php");
        }
        else{
            $_SESSION["error"] = array();

            if($db_errno == 1062){ // 1062 - Error de MySQL cuando hay un dato duplicado en la base de datos
                array_push($_SESSION["error"], "El email introducido está en uso");
            }
            else{
                array_push($_SESSION["error"], "Hay un error desconocido en el servidor. Póngase en contacto con el administrador.");
            }

            header("Location: ../register.php");
        }
    }

    function append_error_message($is_not_valid, $error_msg){
        if($is_not_valid){
            array_push($_SESSION["error"], $error_msg);
        }
    }
?>