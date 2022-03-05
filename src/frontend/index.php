<!DOCTYPE html>

<?php
    include_once("models/User.php");
    session_start();
?>

<html>
    <head>
        <?php include_once("common/includes.php");?>
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
