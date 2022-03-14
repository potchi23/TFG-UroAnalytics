<?php
    include_once("../models/User.php");

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
        
        <?php include_once("../common/includes.php");?>
        <link rel="stylesheet" href="../css/predictions.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- <script language="javaScript">
            function unselectButtons() {
                b1 = document.getElementById("op1");
                b2 = document.getElementById("op2");
                b3 = document.getElementById("op3");

                b1.disable = false; b1.checked = false;
                b2.disable = false; b2.checked = false;
                b3.disable = false; b3.checked = false;
            }
            
            function disableButton3() {
                document.getElementById("op3").disabled = true; 
            }
        </script> -->
    </head>
        <body>
            <div class="header">
                <?php include_once("../common/header.php");?>
            </div>
            
            <div class="sidebar-container" id="list-example">
                <?php include_once("sidebarPredictions.php")?>
            </div>
            
            <div class="content-container" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                <div class="container-fluid">
                    <div class="jumbotron" id="indexPrediction">                        
                        <h1 class="display-8" style="font-weight:600;">Realizar una predicción</h1><br>                        
                        <hr class="my-1"><br>
                        <h5>Para realizar una predicción debe importar un archivo CSV y después pulsar el botón "Importar desde CSV"
                            o puede rellenar manualmente las siguientes variables.</h5>
                        <h5>Y a continuación debe elegir el algoritmo de predicción que desee emplear.</h5><br>

                        <?php
                            if(!isset($_SESSION["last_train"])){
                                echo "<p>Último entrenamiento: Nunca</p>";
                            }
                            else{
                                $last_train= $_SESSION['last_train'];
                                echo "<p>Último entrenamiento: $last_train</p>";
                            }
                        ?>
                        <hr class="my-4">
                    </div> 
                        
                    <div id="dataPatients">
                        <?php include_once("dataPatients.php")?>
                    </div>            

                    <div id="predictionAlgorithm">
                        <?php include_once("predictionAlgorithm.php")?>
                    </div>

                </div>
            </div>    
            <footer class="bg-light text-center text-lg-start">
                <?php include_once("../common/footer.php") ?>
            </footer> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>