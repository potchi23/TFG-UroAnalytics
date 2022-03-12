<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "../vendor/autoload.php";

    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    
    $user = $_SESSION["user"];
    
    $patch_req = array(
        "id" => $_POST["id"]
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/register_petitions", "PATCH", $patch_req, $user->get_token());
   
    if($response["status"] == 200) {

        $data = $response["data"];
        $email = $data->email;
        $name = $data->name;

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
        $mail->Subject = "SOLICITUD DE REGISTRO ACEPTADA";
        $mail->Body    = "Hola $name. Te informamos que hemos <b>ACEPTADO</b> tu solicitud de registro. Puedes acceder a la aplicación a través del siguiente <a href='$FRONTEND_URL/login.php'>enlace</a>.";
        $mail->AltBody = "Hola $name. Te informamos que hemos ACEPTADO tu solicitud de registro. Puedes acceder a la aplicación copiando y pegando en tu navegador el siguiente enlace: $FRONTEND_URL/login.php";
        
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
