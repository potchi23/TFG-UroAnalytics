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
        <?php include_once("common/includes.php");?>
        <link rel="stylesheet" href="css/dashboard.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body>
        <div class="header">
            <div class="fixed-top">
                <?php include_once("common/header.php");?>
            </div>
        </div>   
        <div class="dashboard">            
            <h2>Hola, <?php echo $user->get_full_name();?></h2>
            <h3>Tipo usuario: <?php echo $user->get_type()?></h3>
            <?php
                if ($user->get_type() == 'admin') {
                    echo "<a href='registerPetitions.php?page=1'>Peticiones de registro</a>";
                }
            ?>
            <a href="EditarPaciente.php">Editar paciente</a>
            <a href="RegistrarPaciente.php">Añadir paciente</a>

            <p>Falta meter más cosas y barra lateral izquierdo</p>
            
            <div class="graphics">
                <div class="chart-container">
                    <canvas id="bar-chart" width="50" height="30"></canvas>
                </div>
            </div>
        </div>

        <footer class="bg-light text-center text-lg-start">
            <?php include_once("common/footer.php")?>
        </footer> 
    </body>
    
    <script src="js/barGraphExample.js"></script>
</html>