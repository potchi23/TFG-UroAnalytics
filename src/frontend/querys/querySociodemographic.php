<!DOCTYPE html>

<?php
    include_once("../models/User.php");
    session_start();
?>

<html>
    <head>
        <title>Realizar consulta</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/sidebar.css">
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
                    <?php include_once("../common/header.php") ?>
                </div>
                <div class="sidebar-container">
                    <?php include_once("../querys/sidebarQuery.php")?>
                </div>
                <div class="content-container">
                    <div class="container-fluid">
                        <!-- Main component for a primary marketing message or call to action -->
                        <div class="jumbotron">
                            <h1 class="display-4" style="font-weight:600;">Filtro Sociodemográfico</h1>
                            <hr class="my-4">
                            <h2> Edad del paciente </h2>
                            <br>
                            <input type="text" class="form-control" placeholder="Edad" style="width:auto;">
                            <br>
                            <button type="button" class="btn btn-primary btn-lg" id="op1" onclick="disableButton3()"><</button>
                            <button type="button" class="btn btn-primary btn-lg" id="op2">=</button>
                            <button type="button" class="btn btn-primary btn-lg" id="op3">></button>
                            <button type="button" class="btn btn-primary btn-lg" style="background-color: #004370;" onclick="unselectButtons()">Quitar selección</button>
                            <hr class="my-4">
                            <h2> Etnia del paciente </h2>
                            <br>
                            <button type="button" class="btn btn-primary btn-lg" name="etnia">Caucásico</button>
                            <button type="button" class="btn btn-primary btn-lg" name="etnia">Negro</button>
                            <button type="button" class="btn btn-primary btn-lg" name="etnia">Hispano</button>
                            <button type="button" class="btn btn-primary btn-lg" name="etnia">Asiático</button>
                            <button type="button" class="btn btn-primary btn-lg" style="background-color: #004370;" onclick="unselectButton2()">Quitar selección</button>
                        </div>
                    </div>
                </div>    
                <footer class="bg-light text-center text-lg-start">
                    <?php include_once("../common/footer.php") ?>
                </footer> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>