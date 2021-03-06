<?php
    require_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");

    session_start();

    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }
    define('import-form', TRUE);
    $user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Realizar predicción</title>
        
        <?php require_once("../common/includes.php");?>
        <link rel="stylesheet" href="../css/predictions.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
        <body>
            <div class="header">
                <div class="fixed-top">
                    <?php include_once("../common/header.php");?>
                </div>
            </div>
            
            <div class="sidebar-container" id="list-example">
                <?php require("sidebarPredictions.php")?>
            </div>

            <div class="content-container" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                <div class="container-fluid">
                    <div class="jumbotron" id="indexPrediction">                        
                        <h1 class="display-8" style="font-weight:600;">Realizar una predicción</h1><br>                        
                        <hr class="my-1"><br>

                        <p>Para realizar una predicción debe importar un archivo de formato <b>.csv, .xls y .xlsx</b> y después pulsar el botón "Importar desde fichero".
                            También puede rellenar manualmente las variables.</p>
                        <p>A continuación, debe elegir el algoritmo de predicción que desee emplear.</p><br>
                        <h5>Para más detalles consultar el <a href="../userGuide/userGuideIndex.php#predictionsGuide">manual de usuario</a>.</h5>
                        <hr class="my-4">
                        <div id="last-train">
                            <span>Entrenado en: </span>
                            <span id="last-train-date">Nunca</span>
                        </div>
                    </div> 
                        
                    <div id="dataPatients">
                        <?php require("dataPatients.php")?>
                    </div>            

                    <div id="predictionAlgorithm">
                    <div class="jumbotron">
                        <h1 style="font-weight:600;">Algoritmo a utilizar</h1>
                        <hr class="my-4">
                        <?php require("predictionAlgorithm.php")?>
                    </div>
                    </div>
                </div>
            </div>    
            <footer class="bg-light text-center text-lg-start">
                <?php require("../common/footer.php") ?>
            </footer> 
        <input id='token' type="hidden" value=<?php echo $user->get_token()?>>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>