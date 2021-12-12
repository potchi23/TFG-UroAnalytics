<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>        
        <?php
            include_once("header/header.php");
        ?>
        <h2>Hola <?php echo $_GET["name"] . " " . $_GET["surname_1"]; ?></h2>
    </body>
</html>