<?php
    session_start();
    
    if (isset($_SESSION["user"])){
        header("Location: /dashboard.php");
    }

    if(!isset($_SESSION["email"])){
        if(isset($_SESSION["error"])){
            unset($_SESSION["error"]);
        }

        header("Location: /login.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Registro solicitado</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/forms.css"/>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="container">
            <div class="form-container">
                <h1 class="form-title">Registro solicitado</h1>
                <div class="form-content">
                    <?php
                        $email = $_SESSION["email"];
                        echo "<p>Un administrador se pondrá en contacto contigo a través de tu correo <b>$email</b> para confirmar la solicitud</p>";
                        unset($_SESSION["email"]);
                    ?>
                </div>
                <p for="register">¿Ya han aceptado tu solicitud? <a href="login.php">Accede aquí</a></p>
            </div>
        </div>
    </body>
</html>
