<?php
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");
    require_once("../models/User.php");

    session_start();
    $NUM_ELEMENTS_BY_PAGE = 5;

    $user = $_SESSION["user"];

    $_SESSION["page"] = isset($_GET["page"]) ? $_GET["page"] : 1;
    
    if($_SESSION["page"] <= 0){
        $_SESSION["page"] = 1;
    }

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Pacientes</title>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php require("../common/includes.php");?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/formUserProfile.css"/>
        <link rel="stylesheet" href="../css/predictions.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <script src="predictions.js"></script>
    </head>
    <body>
        <div class="header">
            <?php require("../common/header.php");?>
        </div>   

        <div class="sidebar-container" id="list-example">
            
            <div class="sidebar-logo">
                PREDICCIONES
            </div>

            <ul class="sidebar-navigation">
                <li class="header-sidebar">Índice</li>

                <?php
                if($user->is_admin()){
                    echo <<<EOL
                        <li>
                            <a href="predictions.php#training">
                            <i aria-hidden="true"></i> Entrenamiento
                            </a>
                        </li>
                    EOL;
                }
                ?>

                <li>
                    <a href="predictions.php#indexPrediction">
                    <i aria-hidden="true"></i> Inicio Predicción
                    </a>
                </li>
                <li>
                    <a href="predictions.php#dataPatients">
                    <i aria-hidden="true"></i> Datos del paciente
                    </a>
                </li>
                <li>
                    <a href="predictions.php#predictionAlgorithm">
                    <i aria-hidden="true"></i> Algoritmo a utilizar
                    </a>
                </li>

                <li>
                    <a href="patients.php">
                    <i aria-hidden="true"></i> Prediccion sobre paciente existente
                    </a>
                </li>
            </ul>
        </div>
            
        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1 style="font-weight:600;">Pacientes existentes a predecir</h1>
                    <h5>Puede realizar una predicción sobre aquellos pacientes almacenados cuyo RBQ es desconocido.</h5>
                    <hr class="my-8">

                    <?php
                        $http_requests = new HttpRequests();
                        
                        $page = $_SESSION["page"];
                        
                        $get_req = array(
                            "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
                            "num_elems" => $NUM_ELEMENTS_BY_PAGE,
                            "rbq_null" => "true"
                        );
                
                        $http_requests = new HttpRequests();

                        if(isset($_GET["patientId"])){
                            $patientId = is_numeric($_GET["patientId"]) ? $_GET["patientId"] : -1;
                            $response = $http_requests->getResponse("$BACKEND_URL/patients/$patientId", "GET", $get_req, $user->get_token());
                        }
                        else{
                            $response = $http_requests->getResponse("$BACKEND_URL/patients", "GET", $get_req, $user->get_token());
                        }
            
                        $data_array = $response["data"]->data;

                        if($response["status"] != 200) {
                            if($response["status"] == 401){
                                unset($_SESSION["user"]);
                                echo "<script>alert('La sesión ha caducado. Vuelva a iniciar sesión.');</script>";
                                $_SESSION["message"] = "La sesión ha caducado";
                                echo "<script type='text/javascript'>window.location.href = '../login.php';</script>";
                            }
                        }
                        
                        $num_patients = $response["data"]->num_entries;

                        if($num_patients > 0) 
                            echo "<h5>Número de pacientes con RBQ desconocido: $num_patients</h5><br>";                                    
                    ?>
                    
                    <div class="table-container m-auto">
                        <div class="table-responsive table-content">

                            <div class="search">
                                <form action="../requests/postSearchPredictionPatient.php" method="POST">
                                    <input id="patientId" name="patientId" type="text" placeholder="Buscar paciente por ID..."/>
                                    <button class="btn btn-primary ml-4" type="submit">Buscar paciente</button>
                                </form>

                                <form action="patients.php">
                                    <button class="btn btn-primary ml-4" type="submit">Limpiar búsqueda</button>
                                </form>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-light">
                                <?php                                    
                                    if (count($data_array) > 0) {

                                        echo '<tr class="thead-dark">';
                                        echo "<th></th>";
                                        echo "<th>#</th>";
                                        foreach($data_array[0] as $key=>$value){
                                            if($key != "N"){
                                                echo "<th>$key</th>";
                                            }
                                        }
                                        echo "</tr>";  
  
                                        $numElems = count($data_array);
                                        
                                        echo"<input type='hidden' id='selected' value=''></input>";
                                        foreach($data_array as $petition){
                                            echo "<tr id='patients_$petition->N'>";
                                            echo <<<EOL
                                                <td style="padding:0px;">
                                                <button type="button" id="$petition->N" onclick="select(this)" class="btn" data-bs-toggle="modal" data-bs-target="#modal" style="margin-top:2rem;">
                                                    <input class="btn btn-outline-primary" type="submit" value="Predecir" style="padding-right:4.3rem; padding-bottom:2rem;"></input>
                                                </button>

                                                <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel01" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel01">Predecir sobre paciente #$petition->N</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                            

                                                EOL;        
                                                            require("predictionModal.php");
                                                            echo <<<EOL
                                                            <br>
                                                            <p>¿Actualizar datos del paciente con los resultados de la predicción?</p>

                                                            </div>
                                                        
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <form action="../requests/patchUpdatePrediction.php" method="POST">
                                                                    <input type="hidden" id="patientId" name="patientId" value="$petition->N"></input>
                                                                    <input type="hidden" class="prediction-result-input" name="prediction-result" value=""></input>
                                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                                EOL;
                                            
                                            echo "<td>$petition->N</td>";
                                            
                                            foreach($petition as $key=>$value){
                                                if($key != "N"){
                                                    echo "<td id='$key' class='prediction-values-$petition->N'>$value</td>";
                                                }
                                            }
                                            echo "</tr>";                                      
                                        }

                                        $empty_rows = $NUM_ELEMENTS_BY_PAGE - $numElems;
                                        
                                        for ($i = 0; $i < $empty_rows; $i++){
                                            echo "<tr>";
                                            for ($j = 0; $j < count((array)$data_array[0]) + 1; $j++){
                                                echo "<td><div style='margin-bottom:2.38rem;'></div></td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    else{
                                        echo "<h5>No se han encontrado pacientes</h5>";
                                    }
                                ?>
                            </table>                    
                        </div>
                    </div>

                    <div class="page-buttons">
                        <?php
                        if(!isset($_GET["patientId"]) && count($data_array) > 0){
                            echo "<div>";
                            if($_SESSION["page"] != 1 && count($data_array) > 0){
                                $prev_page = $_SESSION["page"] - 1;    
                                echo "<a class='btn btn-primary previous' href='patientsIndex.php?page=$prev_page'><</a>";
                            }                                    
                            echo "</div>";
                            
                            $numPages = ceil($response["data"]->num_entries/$NUM_ELEMENTS_BY_PAGE);
                            echo "<div style='background-color:#e9ecef; border-color:#e9ecef' class='btn btn-warning'>$page/$numPages</div>";

                            echo "<div>";
                            if ($get_req["offset"] + $NUM_ELEMENTS_BY_PAGE < $response["data"]->num_entries && count($data_array) > 0){
                                $next_page = $_SESSION["page"] + 1;    
                                echo "<a class='btn btn-primary next' href='patientsIndex.php?page=$next_page'>></a>"; 
                            }
                            else{
                                echo "<div style='background-color:#e9ecef; border-color:#e9ecef;'class='btn btn-primary previous'>></div>";      
                            }
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <input id='token' type="hidden" value=<?php echo $user->get_token()?>>
        <div style="margin-bottom:25%;"></div>

        <div class="footer">
            <?php require("../common/footer.php");?>
        </div>   

    </body>
</html>