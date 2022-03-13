<div class="jumbotron">
    <div class="prediction-header">

        <h1 style="font-weight:600;">Datos del paciente</h1>
        <hr class="my-4">
                            
        <div class="import-form">
            <form action="submit_csv.php" method="post" enctype="multipart/form-data">
                <input type="file" id="prediction-import" name="prediction-import">
                <button class="btn btn-primary ml-4" type="submit">Importar desde CSV</button>
            </form>
        </div>

        <?php
            if (isset($_SESSION["message"])){
                $message = $_SESSION["message"];
                echo "<div class='alert-message'><p></p><p class='alert alert-success'>$message</p></div>";

                unset($_SESSION["message"]);
            }

            if (isset($_SESSION["error"]) && count($_SESSION["error"]) > 0){
                echo"</p><div class='alert-message'><div class='alert alert-danger'>";
                foreach($_SESSION["error"] as $error){
                    echo "<div>$error</div>";
                }
                echo"</div></div>";
                unset($_SESSION["error"]);
            }
        ?> 

        <div class="training-form">
            <form action="../requests/getTraining.php" method="get">
                <label for="training-button" class="btn btn-danger">
                    Entrenar [PRUEBA!!!]
                </label>
                <input id="training-button" type="submit"/> 
            </form>
            <p>Ver logs en la consola de Flask</p>
        </div>
    </div>
    <br><br>
    
    <div class="d-flex justify-content-between input-group prediction-data">

        <?php
            if(!isset($_SESSION["dataInputs"])) {
                include_once("empty-form.php");
            }
            else {
                include_once("filled-form.php");
                unset($_SESSION["dataInputs"]);
            }
        ?>
    </div>
</div>
