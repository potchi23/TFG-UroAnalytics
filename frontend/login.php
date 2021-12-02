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

        <form action="requests/post_login.php" method="post" target="_blank">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
