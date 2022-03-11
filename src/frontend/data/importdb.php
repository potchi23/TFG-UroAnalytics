<?php
    include_once("../models/User.php");
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: /login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Importar datos</title>
        <link rel="stylesheet" href="../css/importdb.css"/>
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
            <div class="container-fluid">
                <h3>Importar archivo</h3>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-12"> 
                    <!-- Contenido -->
                    <p> aquí poner algo </p>
                    <div class="outer-container">
                        <form action="../requests/postImportdb.php" method="POST"
                            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                            <div>
                                <label>Elija Archivo Excel</label> <input type="file" name="file"
                                    id="file" accept=".xls,.xlsx">
                                <button type="submit" id="submit" name="import"
                                    class="btn-submit">Importar</button>
                        
                            </div>  
                        </form>
                    </div>
                </div>  
            </div>      
        </div>
        <footer class="bg-light text-center text-lg-start">
            <?php include_once("../common/footer.php")?>
        </footer> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>        