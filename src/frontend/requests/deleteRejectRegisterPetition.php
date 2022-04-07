<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "../vendor/autoload.php";
    require_once("../models/User.php");
    require_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();

    $user = $_SESSION["user"];

    $delete_req = array(
        "id" => $_POST["id"]
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/register_petitions", "DELETE", $delete_req, $user->get_token());
   
    if($response["status"] == 200) {
        $data = $response["data"];
        $email = $data->email;
        $name = $data->name[0];

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                        
        $mail->Host       = "smtp.gmail.com";   
        $mail->SMTPAuth   = true;               
        $mail->Username   = $EMAIL_USER;     
        $mail->Password   = $EMAIL_PASSWORD;         
        $mail->SMTPSecure = "tls";              
        $mail->Port       = 587;                
        
        $mail->setFrom($EMAIL_USER, "Administrador");           
        $mail->addAddress($email);           

        $mail->isHTML(true);                                  
        $mail->Subject = "SOLICITUD DE REGISTRO RECHAZADA";
        $mail->Body    = "Hola $name. Te informamos que hemos <b>RECHAZADO</b> tu solicitud de registro.";
        $mail->AltBody = "Hola $name. Te informamos que hemos RECHAZADO tu solicitud de registro.";
        
        $mail->send();

        $page = $_GET["numElems"] == 1 ? $_GET["page"] - 1 : $_GET["page"];
        header("Location: ../registerPetitions.php?page=$page");
    }
    else{
        if($response["status"] == 401){
            unset($_SESSION["user"]);
            $_SESSION["message"] = "La sesión ha caducado";
            header("Location: ../login.php");
        }
    }
?>
