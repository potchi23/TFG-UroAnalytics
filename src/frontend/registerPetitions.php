<?php
    include_once("models/User.php");
    session_start();


    $user = $_SESSION["user"];

    if (!isset($_SESSION["user"]) || !$user->is_admin()){
        header("Location: /index.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Solicitudes de registro</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <script src="js/registerPetitions.js"></script>
    </head>
    <body>
        <h1>Solicitudes de registro</h1>

        <table id="register_petitions">

        </table>
    </body>
</html>