<?php   
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "../vendor/autoload.php";
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    
    $user = $_SESSION["user"];
    $id = $user->get_id();

    $delete_req = array(
        "id" => $id
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/users/$id", "DELETE", $delete_req, $user->get_token());
   
    if($response["status"] == 200) {
        $data = $response["data"];
        $email = $data->email;
        $name = $data->name[0];

        $mail = new PHPMailer();
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
        $mail->Subject = "CUENTA ELIMINADA CON ÉXITO";
        $mail->Body    = "Hola $name. Te informamos que hemos <b>ELIMINADO</b> tu cuenta.";
        $mail->AltBody = "Hola $name. Te informamos que hemos ELIMINADO tu cuenta.";
        
        $mail->send();

        header("Location: ../logout.php");
    }
    else {
        if($response["status"] == 401) {
            unset($_SESSION["user"]);
            $_SESSION["message"] = "La sesión ha caducado";
            header("Location: ../login.php");
        }
    }
?>
