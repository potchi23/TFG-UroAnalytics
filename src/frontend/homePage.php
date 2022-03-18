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
        <title>Inicio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/header.css"/>
        <link rel="stylesheet" href="css/homePage.css"/>
        <link rel="stylesheet" href="css/form.css"/>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->
    </head>
    <body>
        <div class="header">
            <?php include_once("common/header.php");?>
        </div>   
        
        <div class="content-container">
            <div class="container-fluid">

                <div class="jumbotron">                
                    <div id="banner" class="carousel slide">
                        <div class="carousel-inner">
                            <img src="img/banner.jpg" class="d-block w-100" style="border-radius:20px;" alt="banner">
                            <div class="centered-left">                
                                <h4>Hola, <?php echo $user->get_full_name();?></h4><br>
                                <h1 class="display-8" style="font-weight:700;">Bienvenido a Savana Barata</h1>
                                <br>
                                <h2>Servicio de consultas y predicciones <br>
                                sobre pacientes</h2>
                                <br>                            
                                <p>(Imagen de prueba, añadir otra mejor)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="jumbotron">
                    <h1>¿Qué puedes hacer en Savana Barata?</h1>
                    <hr>
                    <div class="container mt-4 mb-4">
                        <div class="text-center d-flex justify-content-center">                        
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="services">
                                        <div class="icon"> <img src="img/query.png" style="max-height:125px;max-width:125px;"> </div>
                                        <div class="services-body">
                                            <h5 style="font-weight: bold;">Consultar pacientes</h5>
                                            <p>Realizar consultas de pacientes con más de 40 filtros diferentes.</p> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="services">
                                        <div class="icon"> <img src="img/prediction.png" style="max-height:125px;max-width:125px;"> </div>
                                        <div class="services-body">
                                            <h5 style="font-weight: bold;">Predicciones</h5>
                                            <p>Realizar una predicción sobre un paciente en concreto.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="services">
                                        <div class="icon"> <img src="img/patient.png" style="max-height:125px;max-width:125px;"> </div>
                                        <div class="services-body">
                                            <h5 style="font-weight: bold;">Editar pacientes</h5>
                                            <p>Editar la información de pacientes existentes en la 
                                                base de datos o añadir los datos de un paciente nuevo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>

                <div class="jumbotron">
                    <p>Añadir información sobre la BBDD (número de pacientes que hay, qué 
	                    datos se tiene de cada uno de ellos, etc)</p>
                </div>                    
            </div>
        </div>

        <footer class="bg-light text-center text-lg-start">
            <?php include_once("common/footer.php")?>
        </footer> 
    </body>
    
    <!-- <script src="js/barGraphExample.js"></script> -->
</html>