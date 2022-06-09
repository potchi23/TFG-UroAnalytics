<!DOCTYPE html>

<?php
    require_once("../models/User.php");
    session_start();

    $user = $_SESSION["user"];
    $_SESSION["error"] = array();

    $_SESSION["page"] = isset($_GET["page"]) ? $_GET["page"] : 1;
    
    if($_SESSION["page"] <= 0){
        $_SESSION["page"] = 1;
    }

    if(isset($_POST["fromIndex"])){
        unset($_POST["fromIndex"]);
        unset($_SESSION["get_req"]);

        if(!isset($_POST["boolBiopsy"]) && !isset($_POST["boolCIR"]) && !isset($_POST["boolClinic"]) &&
           !isset($_POST["boolEvolve"]) && !isset($_POST["boolMarkers"]) && !isset($_POST["boolProstate"]) &&
           !isset($_POST["boolSociodemographic"])) {
            array_push($_SESSION["error"], "Seleccionar al menos un filtro");
        } 
    
        if (count($_SESSION["error"]) > 0) {
            header("Location: queryIndex.php");
        }
    }
?>

<html>
    <head>
        <title>Consultas</title>
        <link rel="stylesheet" href="../css/form.css"/>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php require("../common/includes.php");?>
        <link rel="stylesheet" href="../css/formUserProfile.css"/>
       
    </head>
    <body>
        <div class="header">
            <div class="fixed-top">
                <?php require("../common/header.php");?>
            </div>
        </div>

        <div class="sidebar-container" id="list-example">
            <?php include_once("sidebarQueryResult.php");?>
        </div>

        <div class="content-container">
            <div class="container-fluid">

                <div id="viewPatient">
                    <div class="content-container" style="padding:0px;">
                        <div class="container-fluid">
                            <div class="jumbotron">
                                <h1 style="font-weight:600;">Consultas</h1>
                                <hr class="my-8">

                                <?php 
                                    $page = $_SESSION["page"];
                                    require("getQuery.php");
                                ?>

                                <div class="page-buttons">
                                    <?php
                        
                                    if($data_array != NULL && !isset($_GET["patientId"]) && count($data_array) > 0){
                                        echo "<div>";
                                        if($_SESSION["page"] != 1 && count($data_array) > 0){
                                            $prev_page = $_SESSION["page"] - 1;    
                                            echo "<a class='btn btn-primary previous' href='viewQuery.php?page=$prev_page'><</a>";
                                        }                                    
                                        echo "</div>";
                                        
                                        $numPages = ceil($response["data"]->num_entries/$NUM_ELEMENTS_BY_PAGE);
                                        echo "<div style='background-color:#e9ecef; border-color:#e9ecef' class='btn btn-warning'>$page/$numPages</div>";

                                        echo "<div>";
                                        if ($get_req["offset"] + $NUM_ELEMENTS_BY_PAGE < $response["data"]->num_entries && count($data_array) > 0){
                                            $next_page = $_SESSION["page"] + 1;    
                                            echo "<a class='btn btn-primary next' href='viewQuery.php?page=$next_page'>></a>"; 
                                        }
                                        else{
                                            echo "<div style='background-color:#e9ecef; border-color:#e9ecef;'class='btn btn-primary previous'>></div>";      
                                        }
                                        echo "</div>";
                                    }
                                    unset($_GET["patientId"]);
                                    ?>
                                </div>
                                <br>
                                <a href="../resources/descripcion_variables.pdf" download="descripcion_variables">
                                    <button id="descripcion_variables" class="btn btn-success">Descargar descripción variables</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        if(isset($_SESSION["errorMsg"])){
            unset($_SESSION["errorMsg"]);
            ?>
            <footer class="bg-light text-center text-lg-start fixed-bottom">
                <?php require("../common/footer.php")?>
            </footer>
            <?php
        }else{
            ?>
            <footer class="bg-light text-center text-lg-start">
                <?php require("../common/footer.php")?>
            </footer>
        <?php
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>