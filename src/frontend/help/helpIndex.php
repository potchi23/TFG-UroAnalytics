<?php
    require_once("../models/User.php");

    session_start();
    
    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Ayuda</title>
        <?php include_once("../common/includes.php");?>        
    </head>
    <body>
        <div class="header">
            <div class="fixed-top">
                <?php include_once("../common/header.php");?>
            </div>
        </div>   
        <div class="sidebar-container" id="list-example">
                <?php include_once("sidebarHelp.php")?>
        </div>
        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron" id="indexHelp">
                    <h1 style="font-weight: 600">Página de ayuda</h1>
                    <hr class="my-4">
                    <h5>Esta página describe la funcionalidad de cada una de las páginas 
                        que compone la aplicación web de Savana Barata.</h5>
                </div>
                <div id="querysHelpSection">
                    <?php include_once("./querysHelpSection.php")?>
                </div>      
                <div id="predictionsHelpSection">
                    <?php include_once("./predictionsHelpSection.php")?>
                </div>
                <div id="patientsHelpSection">
                    <?php include_once("./patientsHelpSection.php")?>
                </div>
                <?php                    
                    if ($user->get_type() == 'admin') {
                        echo "<div id='registerPetitionsHelpSection'>";
                        include_once("./registerPetitionsHelpSection.php");
                        echo "</div>";
                    }
                ?>
                <div id="profileHelpSection">
                    <?php include_once("./profileHelpSection.php")?>
                </div>           
            </div>
        </div>

        <footer class="bg-light text-center text-lg-start">
            <?php require_once("../common/footer.php")?>
        </footer> 
    </body>    
</html>