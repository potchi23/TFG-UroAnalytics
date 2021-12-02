<!DOCTYPE html>

<?php
    session_start();
    $_SESSION["is_logged"] = false;
?>

<html>
    <head>
        <title>Bienvenidos a ... </title>
    </head>
    <body>
        <?php
            if (isset($_SESSION["is_logged"]) && $_SESSION["is_logged"]){
                include_once("dashboard.php");
            }
            else{
                include_once("login.php");
            }
        ?>
    </body>
</html>
