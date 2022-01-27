<?php
    include_once("models/User.php");
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: /login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>        
        <?php
            include_once("header/header.php");
        ?>

        <h2>Hola, <?php echo $user->get_full_name();?></h2>
        <h3>Tipo usuario: <?php echo $user->get_type()?></h3>
        <a href="registerPetitions.php?page=1">Peticiones de registro</a>
        <a href="userProfile.php">Ver mi perfil</a>
        <a href="logout.php">Logout</a>

    </body>
</html>