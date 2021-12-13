<?php
    session_start();
  
    if (isset($_SESSION["user"])){
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
            echo "<p>Un administrador se pondrá en contacto con usted a través de su correo $email para confirmar su solicitud</p>"
        ?>
    </body>
</html>
