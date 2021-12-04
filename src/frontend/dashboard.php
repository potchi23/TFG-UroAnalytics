<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h2>Hola javi:)</h2>
        <?php
            include_once("header/header.php");
            echo $_GET["email"] . " " . $_GET["password"];
        ?>
    </body>
</html>