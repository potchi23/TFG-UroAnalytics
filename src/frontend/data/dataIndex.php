<!DOCTYPE html>

<?php
    include_once("../models/User.php");
    session_start();

    if (!isset($_SESSION["user"])){
        header("Location: /login.php");
    }

    $user = $_SESSION["user"];
?>

<html>
    <head>
        <title>Realizar consulta</title>
        <?php include_once("../common/includes.php");?>
    </head>
    <body>  
        <div class="header">
            <?php include_once("../common/header.php");?>
        </div> 
        <div class="sidebar-container">
            <?php include_once("sidebarData.php")?>
        </div>
        <div class="content-container">

        
        </div>  
        <footer class="bg-light text-center text-lg-start">
            <?php include_once("../common/footer.php")?>
        </footer>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
