<?php
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");
    require_once("../models/User.php");
    
    //session_start();

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
        <link rel="stylesheet" href="../css/forms.css"/>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php require("../common/includes.php");?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/formUserProfile.css"/>
       

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </head>
    <body>
        <div class="header">
            <?php require("../common/header.php");?>
        </div>   

        <div class="content-container" style="padding:0px;">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1 style="font-weight:600;">Pacientes</h1>
                    <hr class="my-8">

                    <?php
                        $http_requests = new HttpRequests();
                        
                        $page = $_SESSION["page"];
                        
                        $get_req = array(
                            "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
                            "num_elems" => $NUM_ELEMENTS_BY_PAGE
                        );
                
                        $http_requests = new HttpRequests();
                        $response = $http_requests->getResponse("$BACKEND_URL/patients", "GET", $get_req, $user->get_token());
            
                        $data_array = $response["data"]->data;

                        if($response["status"] != 200) {
                            if($response["status"] == 401){
                                unset($_SESSION["user"]);
                                $_SESSION["message"] = "La sesión ha caducado";
                                header("Location: ../login.php");
                            }
                        }
                        
                        $num_patients = $response["data"]->num_entries[0];

                        if($num_patients > 0) 
                            echo "<h5>Número de pacientes: $num_patients</h5><br>";
                        else
                            echo "<h5>No hay pacientes en la base de datos</h5><br>";                                        
                    ?>
                    
                    <div class="table-container m-auto">
                        <div class="table-responsive table-content">
                            <table class="table table-striped table-bordered table-hover table-light">
                                <?php                                    
                                    if (count($data_array) > 0) {

                                        echo '<tr class="thead-dark">';
                                        echo "<th>#</th>";
                                        foreach($data_array[0] as $key=>$value){
                                            echo "<th>$key</th>";
                                        }
                                        echo "</tr>";  
  
                                        $numElems = count($data_array);

                                        foreach($data_array as $petition){
                                            echo "<tr id='patients_$petition->N'>";
                                            echo "<td>$petition->N</td>";
                                            foreach($petition as $key=>$value){
                                                echo "<td>$value</td>";
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
                                        echo "<h3>No existen pacientes en la base de datos</h3>";
                                    }
                                ?>
                            </table>                    
                        </div>
                    </div>
                    
                    <div class="page-buttons">
                        <?php
                        if(count($data_array) > 0){
                            echo "<div>";
                            if($_SESSION["page"] != 1 && count($data_array) > 0){
                                $prev_page = $_SESSION["page"] - 1;    
                                echo "<a class='btn btn-primary previous' href='patientsIndex.php?page=$prev_page'><</a>";
                            }                                    
                            echo "</div>";
                            
                            $numPages = ceil($response["data"]->num_entries[0]/$NUM_ELEMENTS_BY_PAGE);
                            echo "<div style='background-color:#e9ecef; border-color:#e9ecef' class='btn btn-warning'>$page/$numPages</div>";

                            echo "<div>";
                            if ($get_req["offset"] + $NUM_ELEMENTS_BY_PAGE < $response["data"]->num_entries[0] && count($data_array) > 0){
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
    </body>
</html>