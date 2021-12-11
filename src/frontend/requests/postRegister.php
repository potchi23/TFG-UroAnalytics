<?php
    $ch = curl_init();
    $error = "";

    $name = htmlspecialchars($_POST["name"]);
    $surname_1 = htmlspecialchars($_POST["surname_1"]);
    $surname_2 = htmlspecialchars($_POST["surname_2"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);
    $password_confirm = password_hash(htmlspecialchars($_POST["password_confirm"]), PASSWORD_DEFAULT);

    $error = append_error_message($error, strlen($name) <= 0, "El%20nombre%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($name) >= 20, "El%20nombre%20no%20puede%20tener%20más%20de%2020%20carácteres");
    $error = append_error_message($error, strlen($surname_1) <= 0, "El%20apellido%201%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($surname_1) >= 20, "El%20Apellido%201%20no%20puede%20tener%20más%20de%2020%20carácteres");
    $error = append_error_message($error, strlen($surname_2) <= 0, "El%20apellido%202%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($surname_2) >= 20, "El%20Apellido%202%20no%20puede%20tener%20más%20de%2020%20carácteres");
    $error = append_error_message($error, strlen($email) <= 0, "El%20email%20no%20puede%20ser%20vacío");
    $error = append_error_message($error, strlen($email) > 50, "El%20email%20%20no%20puede%20tener%20más%20de%2050%20carácteres");
    $error = append_error_message($error, strlen($email) > 0 && strlen($email) <= 50 && !filter_var($email, FILTER_VALIDATE_EMAIL), "$email%20no%20es%20un%20email%20válido");
    $error = append_error_message($error, strlen($_POST["password"]) <= 0, "La%20contraseña%20no%20puede%20ser%20vacía");
    $error = append_error_message($error, strlen($_POST["password_confirm"]) <=0, "La%20confirmación%20de%20contraseña%20no%20puede%20ser%20vacía");
    $error = append_error_message($error, $_POST["password"] != $_POST["password_confirm"], "Las%20contraseñas%20no%20coinciden");
    $error = append_error_message($error, strlen($_POST["password"]) > 0 && !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST["password"]), "La%20contraseña%20debe%20contener%208%20carácteres%20alfanuméricos%20con%20mayúsculas%20y%20minúsculas");

    if (strlen($error) > 0){
        header("Location: ../register.php?error=$error");
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

        curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/register");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_req);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        $response_array = json_decode($response,true);
        $db_errno = $response_array["errno"];

        if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 200){
            $email = $post_req["email"];
            header("Location: ../pending.php?email=$email");
        }
        else{
            if($db_errno == 1062){ // 1062 - Error de MySQL cuando hay un dato duplicado en la base de datos
                header("Location: ../register.php?error=El%20email%20introducido%20está%20en%20uso");
            }
            else{
                header("Location: ../register.php?error=Hay%20un%20error%20desconocido%20en%20el%20servidor");
            }
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