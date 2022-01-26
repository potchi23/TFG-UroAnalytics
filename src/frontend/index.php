<!DOCTYPE html>

<?php
    include_once("models/User.php");
    session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css"/>
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
