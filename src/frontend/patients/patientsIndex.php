<!DOCTYPE html>

<?php
    require_once("../models/User.php");
    session_start();

    if(isset($_GET["patientId"]) && $_GET["patientId"] == null){
        header("Location: patientsIndex.php");
    }
?>

<html>
    <head>
        <title>Entorno pacientes</title>
        <link rel="stylesheet" href="../css/predictions.css"></link>
        <?php include_once("../common/includes.php");?>
    </head>
    <body>  
        <div class="header">
            <?php require("../common/header.php");?>
        </div>
        <div class="sidebar-container">
            <?php require("../patients/sidebarPatients.php")?>
        </div>
        <div class="content-container">
            <div class="container-fluid">
    
                <div class="jumbotron">
                    <h1 class="display-8" style="font-weight:600;">Entorno de pacientes</h1>
                    <h5>Seleccione en las opciones de su izquierda la acción que desea realizar.</h5>
                </div>
                
                <div id="viewPatient">
                    <div class="content-container" style="padding:0px;">
                        <div class="container-fluid">
                            <div class="jumbotron">
                                <h1 style="font-weight:600;">Pacientes</h1>
                                <hr class="my-8">

                                <div class="search">
                                    <form action="../requests/postSearchPatient.php" method="POST">
                                        <input id="patientId" name="patientId" type="text" placeholder="Buscar paciente por ID..."/>
                                        <button class="btn btn-primary ml-4" type="submit">Buscar paciente</button>
                                    </form>

                                    <form action="patientsIndex.php">
                                            <button class="btn btn-primary ml-4" type="submit">Limpiar búsqueda</button>
                                    </form>
                                </div>
                                
                                <?php 
                                    require("viewPatient.php"); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <footer class="bg-light text-center text-lg-start">
            <?php require("../common/footer.php")?>
        </footer>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
