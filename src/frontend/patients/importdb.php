<?php
    include_once("../models/User.php");

    session_start();

    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Importar datos</title>
        <?php include_once("../common/includes.php");?>
    </head>
    <body>
        <div class="header">
            <?php include_once("../common/header.php");?>
        </div> 
        <div class="sidebar-container">
            <?php include_once("../patients/sidebarPatients.php")?>
        </div>  
        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                    <?php 
                        if (isset($_SESSION["message"])){
                            $message = $_SESSION["message"];
                            echo "<div class='alert-message'><p></p><p class='alert alert-success'>$message</p></div>";
                            unset($_SESSION["message"]);
                        }

                        if (isset($_SESSION["error"])) {
                            $error = $_SESSION["error"];
                            echo"<div class='alert-message'><div class='alert alert-danger'>$error</div></div>";
                            unset($_SESSION["error"]);
                        }
                    ?>

                    <h1 class="display-8" style="font-weight:600;">Importar datos</h1>
                    <hr class="my-1"><br>
                    
                    <h5>Para importar los datos de los pacientes, asegúrese de que 
                        el archivo tenga alguno de los siguientes formatos: .xls, .xlsx</h5><br>
                    
                    <div class="row">
                        <div class="col-12 col-md-12">                         
                            <div class="bg-light py-5 px-4 border rounded">
                                <form action="../requests/postImportdb.php" method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                    <input type="file" id="import-data" name="import-data">
                                    <button type="submit" id="submit" class="btn btn-primary ml-4">Importar</button>
                                </form>
                            </div>
                        </div> 
                    </div>  
                </div> 
                
                <div class="jumbotron">
                    <h1>Requisitos para importar un Excel</h1>
                    <hr>
                    <div class="justify-content-center">
                        <a href="../resources/plantilla_datos_pacientes.xlsx" download="plantilla_datos_pacientes.xlsx">
                            <button id="downloadTemplate" class="btn btn-success">Descargar plantilla Excel</button>
                        </a>
                        <br>
                        <br>
                        <p>La información dentro del Excel debe empezar en la primera fila que serán las columnas.</p>
                        <p>Cualquier campo de un paciente que no esté incluido en la Base de Datos será descartado.</p>
                        <br>
                        <h5>Para más detalles consultar el <a href="../userGuide/userGuideIndex.php#patientsGuide">manual de usuario</a>.</h5>
                    </div>  
                </div> 
            </div>
        </div>
        <div style="margin-bottom:5%;"></div>
        <footer class="bg-light text-center text-lg-start">
            <?php include_once("../common/footer.php")?>
        </footer> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>        