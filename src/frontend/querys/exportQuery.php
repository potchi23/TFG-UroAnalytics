<?php
    include_once("../models/User.php");

    session_start();

    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Exportar datos</title>
        <?php include_once("../common/includes.php");?>
    </head>
    <body>
        <div class="header">
            <?php include_once("../common/header.php");?>
        </div> 
        <div class="sidebar-container">
            <?php include_once("sidebarQueryResult.php")?>
        </div>  
        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                    <?php                         
                        if (isset($_SESSION["error"]) && !empty($_SESSION["error"])) {
                            echo"<div class='alert-message' style='width: fit-content;'><div class='alert alert-danger'>";
                            foreach($_SESSION["error"] as $error){
                                echo $error . "<br>";
                            }
                            echo"</div></div>";
                            unset($_SESSION["error"]);
                        }
                    ?>

                    <h1 class="display-8" style="font-weight:600;">Exportar datos</h1>
                    <hr class="my-1"><br>
                    
                    <h5>Los datos se exportarán en formato .xlsx</h5><br>
                                        
                    <form action="../requests/getExportdb.php?father=query" method="post" name="exportdb" id="exportdb" enctype="multipart/form-data">
                        <button type="submit" id="submit" class="btn btn-primary ml-2">Exportar datos</button>
                    </form>       
                </div>      
            </div>
        </div>
        <footer class="bg-light text-center text-lg-start", style="position:fixed; left: 0; bottom: 0; width: 100%;">
            <?php include_once("../common/footer.php")?>
        </footer> 

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>        