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
        <title>Realizar consulta</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/predictions.css">

        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">

        <meta charset="utf-8">

        <script language="javaScript">
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
        </script>
    </head>
        <body>  
            <div class="header">
                <?php include_once("../common/header.php"); ?>
            </div>
            
            <div class="content-container">
                <div class="container-fluid">
                    <!-- Main component for a primary marketing message or call to action -->
                    <div class="jumbotron">
                        <h1 class="display-4" style="font-weight:600;">Realizar una predicción</h1>
                        <hr class="my-4">

                        <div class="prediction-header">
                            <h2> Datos del paciente</h2><br>
                         
                            <div>
                                <form action="./submit_csv.php" method="post" enctype="multipart/form-data">
                                    <input type="file" id="prediction-import" name="prediction-import">
                                    <button class="btn btn-primary"type="submit">Importar desde CSV</label>
                                </form>
                            </div>
                        </div>

                        <br>
                        <div class="d-flex justify-content-between input-group prediction-data">
                        
                        <?php
                            if(!isset($_SESSION["dataInputs"])){
                                include_once("empty-form.php");
                            }
                            else{
                                include_once("filled-form.php");
                                unset($_SESSION["dataInputs"]);
                            }
                        ?>
                        </div>
                        <br>
                        <hr class="my-4">
                        <h2> Algoritmo a utilizar </h2>
                        <br>
                        <button type="button" class="btn btn-primary btn-lg" name="alg">Regresión Logística</button>
                        <button type="button" class="btn btn-primary btn-lg" name="alg">k-NN</button>
                        <button type="button" class="btn btn-primary btn-lg" name="alg">Árboles Aleatorios</button>
                        <button type="button" class="btn btn-primary btn-lg" style="background-color: #004370;" onclick="unselectButton2()">Quitar selección</button>
                        
                        <div class="input-group precision">
                            
                            <label for="prediction-precision">
                                Precisión: 
                            </label>

                            <input type="text" id="prediciton-precision" name="prediciton-precision" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                                <button class="btn btn-danger btn-sm" type="button">Predecir</button>
                            </div>
                        </div>

                        <div class="input-group result">
                            <label for="prediction-result">
                                Resultado: 
                            </label>
                            <input type="text" id="prediciton-result" name="prediciton-result" value="tienes sida" disabled>
                        </div>
                    </div>
                </div>
            </div>    
            <footer class="bg-light text-center text-lg-start">
                <?php include_once("../common/footer.php") ?>
            </footer> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>