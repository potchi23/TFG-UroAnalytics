<?php
    include_once("models/User.php");
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: /login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/header.css"/>
        <link rel="stylesheet" href="css/dashboard.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body>
        <div class="header">
            <?php include_once("common/header.php");?>
        </div>   

        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h2>Hola, <?php echo $user->get_full_name();?></h2>
                    <!-- <h4>Tipo usuario: <?php echo $user->get_type()?></h4> -->                   
                    
                    <div class="graphics">
                        <div class="chart-container">
                            <canvas id="bar-chart" width="50" height="30"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-light text-center text-lg-start">
            <?php include_once("common/footer.php")?>
        </footer> 
    </body>
    
    <script src="js/barGraphExample.js"></script>
</html>