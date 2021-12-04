<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if (isset($_SESSION["is_logged"]) && $_SESSION["is_logged"]){
        header("Location: /dashboard.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Registro terminado</title>
    </head>
    <body>
        <h1>Registro solicitado</h1>
        <?php
            $email = $_GET["email"];
            echo "<p>Un administrador se pondrá en contacto de usted a través de su correo $email para confirmar su solicitud</p>"
        ?>
    </body>
</html>
