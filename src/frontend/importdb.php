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
        <title>Importar datos</title>
        <link rel="stylesheet" href="css/importdb.css"/>
        <?php include_once("common/includes.php");?>
    </head>
    <body>
        <div class="header">
            <div class="fixed-top">
                <?php include_once("common/header.php");?>
            </div>
        </div>   
        <div class="container">
            <h3 class="mt-5">Importar archivo</h3>
            <hr>
            <div class="row">
                <div class="col-12 col-md-12"> 
                <!-- Contenido -->
                <p> aquí poner algo </p>
                <div class="outer-container">
                    <form action="" method="post"
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
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>        