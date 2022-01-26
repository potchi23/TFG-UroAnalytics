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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/forms.css"/>
    </head>
    <body>
        <div class="form-container">
            <h1 class="form-title">Registro solicitado</h1>
            <div class="form-content">
                <?php
                    $email = $_GET["email"];
                    echo "<p>Un administrador se pondrá en contacto contigo a través de tu correo <b>$email</b> para confirmar la solicitud</p>"
                ?>
            </div>
            <p for="register">¿Ya han aceptado tu solicitud? <a href="login.php">Accede aquí</a></p>
        </div>
    </body>
</html>
