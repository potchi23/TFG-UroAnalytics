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
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/predictions.css">
        <link rel="stylesheet" href="../css/header.css">
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
            <div class="header fixed-top">
                <?php include_once("../common/header.php");?>
            </div>    
            
            <div class="content-container">
                <div class="container-fluid">
                    <!-- Main component for a primary marketing message or call to action -->
                    <div class="jumbotron">
                        <?php
                            if (isset($_SESSION["error"]) && count($_SESSION["error"]) > 0){
                                echo"</p><div class='alert-message' style='width: 30%;'><div class='alert alert-danger'>";
                                foreach($_SESSION["error"] as $error){
                                    echo "<div>$error</div>";
                                }
                                echo"</div></div>";
                                unset($_SESSION["error"]);
                            }
                        ?> 
                        <h1 class="display-8" style="font-weight:600;margin-top:25px;">Realizar una predicción</h1>
                        <hr class="my-8">

                        <div class="prediction-header">
                            <h2> Datos del paciente</h2><br>
                        
                            <div>
                                <form action="./submit_csv.php" method="post" enctype="multipart/form-data">
                                    <input type="file" id="prediction-import" name="prediction-import">
                                    <button class="btn btn-primary ml-4" type="submit">Importar desde CSV</button>
                                </form>
                            </div>
                        </div>

                        <br><br>
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
                        <button type="button" class="btn btn-primary btn-lg ml-2" style="background-color: #004370;" onclick="unselectButton2()">Quitar selección</button>
                        
                        <div class="input-group precision">
                            
                            <label for="prediction-precision">
                                Precisión: 
                            </label>

                            <input type="text" id="prediciton-precision" name="prediciton-precision" value="0.0" disabled>
                            <div class="input-group-preppend">
                                <span class="input-group-text" style="border-color: black;">%</span>
                            </div>
                            <button class="btn btn-danger btn-sm ml-2" type="button" style="z-index:0;">Predecir</button>

                        </div>

                        <div class="input-group result">
                            <label for="prediction-result">
                                Resultado: 
                            </label>
                            <input type="text" id="prediciton-result" name="prediciton-result" value="Prediccion" disabled>
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