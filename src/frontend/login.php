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
        <title>Bienvenidos a ... </title>
    </head>
    <body>

        <?php
            include_once("header/header.php");
        ?>
        <h1>Login</h1>

        <form action="requests/postLogin.php" method="post" target="_self">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>

        <form action="register.php">
            <label for="register">¿No estas registrado?</label>
            <input type="submit" value="Registro" id="register" name="register">
        </form>
    </body>
</html>
