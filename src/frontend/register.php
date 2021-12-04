<?php
    if (isset($_SESSION["is_logged"]) && $_SESSION["is_logged"]){
        header("Location: /dashboard.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Solicitar registro</title>
    </head>
    <body>
        <h1>Solicitar registro</h1>
        <form action="requests/post_register.php" method="post" target="_blank">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name"><br><br>

            <label for="surname_1">Apellido 1:</label>
            <input type="text" id="surname_1" name="surname_1"><br><br>

            <label for="surname_2">Apellido 2:</label>
            <input type="text" id="surname_2" name="surname_2"><br><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password"><br><br>

            <input type="submit" value="Solicitar registro">
        </form>
    </body>
</html>