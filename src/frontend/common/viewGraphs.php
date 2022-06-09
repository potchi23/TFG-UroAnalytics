<?php
    require_once("../config/config.php");
    require_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    
   session_start();

    $user = $_SESSION["user"];

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Estadísticas de consulta</title>
        <link rel="stylesheet" href="../css/form.css"/>
        <?php require_once("includes.php");?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
       

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <script src="http://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script>

            
            function loadData(query, id){                    
                    const canvas = document.getElementById(id)
                    const ctx = canvas.getContext('2d'); 

                    const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(query),
                        datasets: [{
                            data: Object.values(query),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: { display: false }
                    }
                    });
            }
            </script>
    </head>
    <body style="position: relative;">
        <div class="header">
            <div class="fixed-top">
                <?php include_once("../common/header.php");?>
            </div>
        </div>   
        <div class="sidebar-container">
            <?php if($_GET["father"] == "querys"){
                    include_once("../querys/sidebarQueryResult.php");
                }elseif($_GET["father"] == "patients"){
                    include_once("../patients/sidebarPatients.php");
                }
            ?>
        
        </div>

        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">

                    <div class="card-body">
                    
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h3>TABLA ETNIA</h3>
                                </center>
                            </div>
                            <div class="col">
                                <center>
                                    <h3>TABLA EDAD</h3>                     
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <canvas id="etnia" width="50" height="50"></canvas>
                            </div>
                            <div class="col">
                                <canvas id="edad"  width="50" height="50"></canvas>                        
                            </div>
                        </div>
                        <hr class="my-8">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h3>TABLA TABACO</h3>
                                </center>
                            </div>
                            <div class="col">
                                <center>
                                    <h3>TABLA OBESIDAD</h3>                     
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <canvas id="tabaco" width="50" height="50" ></canvas>
                            </div>
                            <div class="col">
                                <canvas id="obeso" width="50" height="50"></canvas>
                            </div>
                        </div>
                        <hr class="my-8">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h3>TABLA RBQ</h3>
                                </center>
                            </div>
                            <div class="col">
                                <center>
                                    <h3>TABLA ECOTR</h3>                     
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <canvas id="rbq" width="50" height="50" ></canvas>
                            </div>
                            <div class="col">
                                <canvas id="ecotr" width="50" height="50"></canvas>
                            </div>
                        </div>
                        <hr class="my-8">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h3>TABLA TACTOR</h3>
                                </center>
                            </div>
                            <div class="col">
                                <center>
                                    <h3>TABLA HEREDA</h3>                     
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <canvas id="tactor" width="50" height="50" ></canvas>
                            </div>
                            <div class="col">
                                <canvas id="hereda" width="50" height="50"></canvas>
                            </div>
                        </div>
                    
                    
                        <?php

                        $http_requests = new HttpRequests();
                        $get_req = NULL;
                        if($_GET["father"] == "querys"){
                            $get_req = $_SESSION["get_req"];
                            $response = $http_requests->getResponse("$BACKEND_URL/graphicPatients", "GET", $get_req, $user->get_token());
                        }elseif($_GET["father"] == "patients"){
                            $response = $http_requests->getResponse("$BACKEND_URL/graphicPatients", "GET", $get_req, $user->get_token());
                        }
                    
                        if($response["status"] == 200) {
                            $ETNIA = json_encode($response["data"]->ETNIA);
                            $EDAD = json_encode($response["data"]->EDAD);
                            $TABACO = json_encode($response["data"]->TABACO);
                            $OBESO = json_encode($response["data"]->OBESO);
                            $RBQ = json_encode($response["data"]->RBQ);
                            $ECOTR = json_encode($response["data"]->ECOTR);
                            $TACTOR = json_encode($response["data"]->TACTOR);
                            $HEREDA = json_encode($response["data"]->HEREDA);

                            echo "<script> loadData($ETNIA,'etnia')</script>";
                            echo "<script> loadData($EDAD, 'edad') </script>";
                            echo "<script> loadData($TABACO, 'tabaco') </script>";
                            echo "<script> loadData($OBESO, 'obeso') </script>";
                            echo "<script> loadData($RBQ, 'rbq') </script>";
                            echo "<script> loadData($ECOTR, 'ecotr') </script>";
                            echo "<script> loadData($TACTOR, 'tactor') </script>";
                            echo "<script> loadData($HEREDA, 'hereda') </script>";

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>    
        <div style="margin-bottom:10rem;"></div>
        <footer class="bg-light text-center text-lg-start">
            <?php include_once("../common/footer.php")?>
        </footer> 
    </body>
</html>