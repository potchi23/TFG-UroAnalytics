<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "../vendor/autoload.php";
    include_once("../models/User.php");
    include_once("HttpRequests.php");
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
        $name = $data->name;

        $mail = new PHPMailer();
        $mail->isSMTP();                        // Set mailer to use SMTP
        $mail->Host       = "smtp.gmail.com;";    // Specify main SMTP server
        $mail->SMTPAuth   = true;               // Enable SMTP authentication
        $mail->Username   = $EMAIL_USER;     // SMTP username
        $mail->Password   = $EMAIL_PASSWORD;         // SMTP password
        $mail->SMTPSecure = "tls";              // Enable TLS encryption, "ssl" also accepted
        $mail->Port       = 587;                // TCP port to connect to
        
        $mail->setFrom($EMAIL_USER, "Administrador");           // Set sender of the mail
        $mail->addAddress($email);           // Add a recipient

        $mail->isHTML(true);                                  
        $mail->Subject = "SOLICITUD DE REGISTRO RECHAZADA";
        $mail->Body    = "Hola $name. Te informamos que hemos <b>RECHAZADO</b> tu solicitud de registro.";
        $mail->AltBody = "Hola $name. Te informamos que hemos RECHAZADO tu solicitud de registro.";
        
        $mail->send();

        $page = $_GET["page"];
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
