<?php
    $_SESSION["is_logged"] = true; // Linea para debugear borrar cuando todo este completo
    $_SESSION["is_admin"] = true; // Linea para debugear borrar cuando todo este completo

    if (!isset($_SESSION["is_logged"]) || !$_SESSION["is_logged"] || !isset($_SESSION["is_admin"]) || !$_SESSION["is_admin"]){
        header("Location: /index.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Solicitudes de registro</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>"https://smtpjs.com/v3/smtp.js"</script>
        <script src="js/registerPetitions.js"></script>
    </head>
    <body>
        <h1>Solicitudes de registro</h1>

        <table id="register_petitions">

        </table>
    </body>
</html>