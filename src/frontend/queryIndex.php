<!DOCTYPE html>

<?php
    include_once("models/User.php");
    session_start();
?>

<html>
    <head>
        <title>Realizar consulta</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/sidebar.css">
        <link rel="stylesheet" href="css/header.css"/>
        <meta charset="utf-8">
    </head>
    <body>  
                <div class="header">
                    <?php include_once("common/header.php");?>
                </div>
                <div class="sidebar-container">
                    <?php include_once("querys/sidebarQuery.php")?>
                </div>
                <div class="content-container">
                    <div class="container-fluid">
                        <!-- Main component for a primary marketing message or call to action -->
                        <div class="jumbotron">
                            <h1>Realizador de consultas</h1>
                            <p>Para realizar una consulta debe rellenar los filtros deseados de la barra lateral izquierda.</p>
                            <p>A continuación deberá presionar el botón de realizar consulta.</p>
                            <p>
                                <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
                            </p>
                        </div>
                    </div>
                </div>  
                <footer class="bg-light text-center text-lg-start">
                    <?php include_once("common/footer.php")?>
                </footer>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
