<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        
        <?php
            include_once("header/header.php");
            echo $_GET["email"] . " " . $_GET["password"];
        ?>
    </body>
</html>