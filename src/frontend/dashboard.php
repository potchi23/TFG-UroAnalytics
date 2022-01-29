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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/forms.css"/>
        <meta charset="utf-8">
    </head>
    <body>        
        <?php include_once("header/navbar.php");?>
        <div>
            <h2>Hola, <?php echo $user->get_full_name();?></h2>
            <h3>Tipo usuario: <?php echo $user->get_type()?></h3>
            <?php
                if ($user->get_type() == 'admin') {
                    echo "<a href='registerPetitions.php?page=1'>Peticiones de registro</a>";
                }
            ?>
            <a href="userProfile.php">Ver mi perfil</a>

            <p>Falta meter más cosas y barra lateral izquierdo</p>
        </div>

    </body>
</html>