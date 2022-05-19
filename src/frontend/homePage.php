<?php
    require_once("models/User.php");
    require_once("requests/HttpRequests.php");
    require_once("config/config.php");

    session_start();
    
    if (!isset($_SESSION["user"])){
        header("Location: /login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Inicio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/header.css"/>
        <link rel="stylesheet" href="css/homePage.css"/>
        <link rel="stylesheet" href="css/form.css"/>
    </head>
    <body>
        <div class="header">
            <?php require_once("common/header.php");?>
        </div>   
        
        <div class="content-container">
            <div class="container-fluid">

                <div class="jumbotron">                
                    <div id="banner" class="carousel slide">
                        <div class="carousel-inner">
                            <img src="img/banner.jpg" class="d-block w-100" style="border-radius:20px; height: 450px;" alt="banner">
                            <div class="centered-left">                
                                <h4>Hola, <?php echo $user->get_full_name();?></h4><br>
                                <h1 class="display-8" style="font-weight:700;">Bienvenido a UroAnalytics</h1>
                                <br>
                                <h2>Servicio de consultas y predicciones <br>
                                sobre pacientes</h2>
                                <br>                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="jumbotron">
                    <center>
                        <h1>¿Qué puedes hacer en UroAnalytics?</h1>
                        <hr>
                        <h5>Aquí te mostramos algunas de las opciones.</h5>
                    </center>
                    <div class="container mt-4 mb-5">
                        <div class="d-flex justify-content-center">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="patients/importdb.php">
                                        <div class="services">
                                            <div class="icon"> <img src="img/query.png" style="max-height:125px;max-width:125px;"> </div>
                                            <div class="services-body">
                                                <h5 style="font-weight: bold;">Importar pacientes</h5>
                                                <p>Importar pacientes para enriquecer la base de datos.</p> 
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="querys/queryIndex.php">
                                        <div class="services">
                                            <div class="icon"> <img src="img/query.png" style="max-height:125px;max-width:125px;"> </div>
                                            <div class="services-body">
                                                <h5 style="font-weight: bold;">Consultar pacientes</h5>
                                                <p>Realizar consultas de pacientes con más de 40 filtros diferentes.</p> 
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="predictions/predictions.php">
                                        <div class="services">
                                            <div class="icon"> <img src="img/prediction.png" style="max-height:125px;max-width:125px;"> </div>
                                            <div class="services-body">
                                                <h5 style="font-weight: bold;">Predicciones</h5>
                                                <p>Realizar una predicción sobre un paciente en concreto.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="patients/patientsIndex.php">
                                        <div class="services">
                                            <div class="icon"> <img src="img/patient.png" style="max-height:125px;max-width:125px;"> </div>
                                            <div class="services-body">
                                                <h5 style="font-weight: bold;">Visualizar pacientes</h5>
                                                <p>Visualizar la información de pacientes existentes en la 
                                                    base de datos.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="common/viewGraphs.php?father=patients">
                                        <div class="services">
                                            <div class="icon"> <img src="img/patient.png" style="max-height:125px;max-width:125px;"> </div>
                                            <div class="services-body">
                                                <h5 style="font-weight: bold;">Estudios estadísticos</h5>
                                                <p>Recopilar información estadóstica sobre un conjunto de pacientes extenso.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="patients/exportdb.php">
                                        <div class="services">
                                            <div class="icon"> <img src="img/patient.png" style="max-height:125px;max-width:125px;"> </div>
                                            <div class="services-body">
                                                <h5 style="font-weight: bold;">Exportar datos</h5>
                                                <p>Guarda los datos de la consulta realizada de forma sencilla.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>  
                        </div>                      
                    </div>
                    <div class="text-center">
                        <?php
                        
                            $http_requests = new HttpRequests();
                            $response = $http_requests->getResponse("$BACKEND_URL/numPatients", "GET", "", $user->get_token());
                                                    
                            if($response["status"] == 200) {                          
                                $numPatients = $response["data"]->num_patients;                        
                                echo "<h5 style='font-weight: bold;'>Actualmente la base de datos cuenta con " . $numPatients . " pacientes sobre los que se puede realizar consultas y predicciones.</h5>";
                            }
                            else {
                                if($response["status"] == 401) {
                                    unset($_SESSION["user"]);
                                    $_SESSION["message"] = "La sesión ha caducado";
                                    echo "<script>alert('La sesión ha caducado. Vuelva a iniciar sesión.');</script>";
                                    echo "<script type='text/javascript'>window.location.href = '../login.php';</script>";
                                }
                            } 
                        ?>
                    </div> 
                </div>   
                </div>
                <div class="jumbotron">
                    <blockquote class="blockquote text-center bg-light py-3 px-0" style="border-radius:20px;">
                        <div class="h5 mb-1 font-weight-bold font-italic">
                            "El buen médico trata la enfermedad; el gran médico trata al paciente que tiene la enfermedad."
                        </div>
                        <footer class="blockquote-footer"><cite title="source">William Osler</cite></footer>
                    </blockquote>             
                </div>
            </div>
        </div>

        <footer class="bg-light text-center text-lg-start">
            <?php require_once("common/footer.php")?>
        </footer> 
    </body>    
</html>