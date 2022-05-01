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
        <title>Manual de usuario</title>
        <?php include_once("../common/includes.php");?>        
    </head>
    <body>
        <div class="header">
            <div class="fixed-top">
                <?php include_once("../common/header.php");?>
            </div>
        </div>   
        <div class="sidebar-container" id="list-example">
                <?php include_once("sidebarUserGuide.php")?>
        </div>
        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron" id="indexUserGuide">
                    <h1 style="font-weight: 600">Manual de usuario</h1>
                    <hr class="my-4">
                    <h5>Este es el manual de usuario, donde se describe la funcionalidad de cada una de las páginas 
                        que compone la aplicación web de <b>Savana Barata</b>.</h5>

                    <br>

                    <h5>Si quiere descargarse el manual de usuario pulse en el siguiente botón:</h5>
                    <br>

                    <?php
                        $filename = "manual_usuario";

                        if ($user->is_admin()) {
                            $filename = "manual_usuario_admin";
                        }
                    ?>

                    <a href="../resources/<?php echo $filename . ".pdf";?>" download="<?php echo $filename; ?>">
                        <button id="descripcion_variables" class="btn btn-primary">Descargar manual de usuario</button>
                    </a>

                </div>
                <div id="querysGuide">
                    <?php include_once("./querysGuide.php")?>
                </div>      
                <div id="predictionsGuide">
                    <?php include_once("./predictionsGuide.php")?>
                </div>
                <div id="patientsGuide">
                    <?php include_once("./patientsGuide.php")?>
                </div>
                <?php                    
                    if ($user->get_type() == 'admin') {
                        echo "<div id='registerPetitionsGuide'>";
                        include_once("./registerPetitionsGuide.php");
                        echo "</div>";
                    }
                ?>
                <div id="myAccountGuide">
                    <?php include_once("./myAccountGuide.php")?>
                </div>           
            </div>
        </div>
        
        <footer class="bg-light text-center text-lg-start">
            <?php require_once("../common/footer.php")?>
        </footer> 
    </body>    
</html>