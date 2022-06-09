<?php
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");
    require_once("../models/User.php");

    $NUM_ELEMENTS_BY_PAGE = 20;

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
        <link rel="stylesheet" href="../css/form.css"/>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php require("../common/includes.php");?>
        <link rel="stylesheet" href="../css/formUserProfile.css"/>
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </head>
    <body>
        <div class="header">
            <div class="fixed-top">
                <?php include_once("../common/header.php");?>
            </div>
        </div>  

        <?php
            $http_requests = new HttpRequests();
            
            $page = $_SESSION["page"];
            
            $get_req = array(
                "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
                "num_elems" => $NUM_ELEMENTS_BY_PAGE,
            );

            $http_requests = new HttpRequests();

            if(isset($_GET["patientId"])){
                $patientId = is_numeric($_GET["patientId"]) ? $_GET["patientId"] : -1;
                $response = $http_requests->getResponse("$BACKEND_URL/patients/$patientId", "GET", $get_req, $user->get_token());
                if($response["data"]->errorMsg != ""){
                    $error = $response["data"]->errorMsg;
                    echo"<div class='alert-message'><div class='alert alert-danger'>$error</div></div>";
                }else{
                    require_once("../common/viewTable.php");
                }
            }
            else{
                $response = $http_requests->getResponse("$BACKEND_URL/patients", "GET", $get_req, $user->get_token());
                require_once("../common/viewTable.php");
            }

        ?>
        
        
        
        <div class="page-buttons">
            <?php
            
            if(!isset($_GET["patientId"]) && count($data_array) > 0){
                echo "<div>";
                if($_SESSION["page"] != 1 && count($data_array) > 0){
                    $prev_page = $_SESSION["page"] - 1;    
                    echo "<a class='btn btn-primary previous' href='../patients/patientsIndex.php?page=$prev_page'><</a>";
                }                                    
                echo "</div>";
                
                $numPages = ceil($response["data"]->num_entries/$NUM_ELEMENTS_BY_PAGE);
                echo "<div style='background-color:#e9ecef; border-color:#e9ecef' class='btn btn-warning'>$page/$numPages</div>";

                echo "<div>";
                if ($get_req["offset"] + $NUM_ELEMENTS_BY_PAGE < $response["data"]->num_entries && count($data_array) > 0){
                    $next_page = $_SESSION["page"] + 1;    
                    echo "<a class='btn btn-primary next' href='../patients/patientsIndex.php?page=$next_page'>></a>"; 
                }
                else{
                    echo "<div style='background-color:#e9ecef; border-color:#e9ecef;'class='btn btn-primary previous'>></div>";      
                }
                echo "</div>";
            }
            unset($_GET["patientId"]);
            ?>
        </div>
    </body>
</html>