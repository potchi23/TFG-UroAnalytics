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
        <link rel="stylesheet" href="css/dashboard.css"/>
        <link rel="stylesheet" href="css/header.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <meta charset="utf-8">
    </head>
    <body>        
        <?php include_once("common/header.php");?>
        <div class="dashboard">
            <h2>Hola, <?php echo $user->get_full_name();?></h2>
            <h3>Tipo usuario: <?php echo $user->get_type()?></h3>
            <?php
                if ($user->get_type() == 'admin') {
                    echo "<a href='registerPetitions.php?page=1'>Peticiones de registro</a>";
                }
            ?>
            <a href="userProfile.php">Ver mi perfil</a>
            <a href="EditarPaciente.php">Editar paciente</a>
            <a href="RegistrarPaciente.php">Añadir paciente</a>

            <p>Falta meter más cosas y barra lateral izquierdo</p>
            
            <div class="graphics">
                <div class="chart-container">
                    <canvas id="bar-chart" width="50" height="30"></canvas>
                </div>
            </div>
        </div>
    </body>
    
    <script src="js/barGraphExample.js"></script>
</html>