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
        <title>Pacientes</title>
        <link rel="stylesheet" href="../css/forms.css"/>
        <?php require_once("../common/includes.php");?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
       

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <script src="http://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script>

            
            function cargarDatos(query, id){                    
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
    <body>
        <<div class="header">
            <?php require("../common/header.php");?>
        </div>   
        <div class="sidebar-container">
            <?php include_once("sidebarPatients.php");?>
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
                    
                    <?php
                    $http_requests = new HttpRequests();
                    $response = $http_requests->getResponse("$BACKEND_URL/graphicPatients", "GET","");
                   
                    if($response["status"] == 200) {
                        $ETNIA = json_encode($response["data"]->ETNIA);
                        $EDAD = json_encode($response["data"]->EDAD);
                        $TABACO = json_encode($response["data"]->TABACO);
                        $OBESO = json_encode($response["data"]->OBESO);

                        echo "<script> cargarDatos($ETNIA,'etnia')</script>";
                        echo "<script> cargarDatos($EDAD, 'edad') </script>";
                        echo "<script> cargarDatos($TABACO, 'tabaco') </script>";
                        echo "<script> cargarDatos($OBESO, 'obeso') </script>";

                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>    

    </body>
</html>