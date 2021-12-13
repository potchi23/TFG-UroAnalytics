<!DOCTYPE html>

<?php
    //if(session_status() == PHP_SESSION_NONE){
    include_once("models/User.php");
    session_start();
    //}
?>

<html>
    <head>
        <title>Bienvenidos a savana </title>
    </head>
    <body>
        <?php
            if (isset($_SESSION["user"])){
                header("Location: dashboard.php");
            }
            else{
                header("Location: login.php");
            }
        ?>
    </body>
</html>
