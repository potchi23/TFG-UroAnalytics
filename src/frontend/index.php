<!DOCTYPE html>

<?php
    require_once("models/User.php");
    session_start();
?>

<html>
    <head>
        <?php require_once("common/includes.php");?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="predictions/predictions.js"></script>
    </head>
    <body>
        <?php
            if (isset($_SESSION["user"])){
                header("Location: homePage.php");
            }
            else{
                header("Location: login.php");
            }
        ?>
    </body>
</html>
