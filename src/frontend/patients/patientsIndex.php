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
        <?php include_once("../common/includes.php");?>
    </head>
    <body>  
        <div class="header">
            <div class="fixed-top">
                <?php include_once("../common/header.php");?>
            </div>
        </div>
        <div class="sidebar-container">
            <?php include_once("sidebarPatients.php");?>
        </div>
        <div class="content-container">
            <div class="container-fluid">
    
                <div class="jumbotron">
                    <h1 class="display-8" style="font-weight:600;">Entorno de pacientes</h1>
                    <hr class="my-4">
                    <p>Seleccione en las opciones de su izquierda la acción que desea realizar.</p>
                    <br>
                    <h5>Para más detalles consultar el <a href="../userGuide/userGuideIndex.php#patientsGuide">manual de usuario</a>.</h5>
                </div>
                
                <div id="viewPatient">
                    <div class="jumbotron">
                        <h1 style="font-weight:600;">Pacientes</h1>
                        <hr class="my-8">

                        <div class="search">
                            <form action="../requests/postSearchPatient.php" method="POST">
                                <input id="patientId" name="patientId" type="number" placeholder="Buscar paciente por ID..." style="width:15rem;"/>
                                <button class="btn btn-primary ml-4" type="submit">Buscar paciente</button>

                                <a href="../patients/patientsIndex.php" draggable="false">
                                    <button class="btn btn-primary ml-4">Limpiar búsqueda</button>
                                </a>
                            </form>
                        </div>
                        <br>
                        <a href="../resources/descripcion_variables.pdf" download="descripcion_variables">
                            <button id="descripcion_variables" class="btn btn-success">Descargar descripción variables</button>
                        </a>
                        <?php 
                            require("viewPatient.php"); 
                        ?>
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
