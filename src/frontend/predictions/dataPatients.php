<div class="jumbotron">
    <div class="prediction-header">

        <h1 style="font-weight:600;">Datos del paciente</h1>
        <hr class="my-4">
                            
        <div class="import-form">
            <form action="submit_data.php" method="post" enctype="multipart/form-data">
                <input type="file" id="prediction-import" name="prediction-import">
                <button class="btn btn-primary ml-4" type="submit">Importar desde fichero</button>
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
    </div>
    <br><br>
    
    <div class="d-flex justify-content-between input-group prediction-data">

        <?php
            if(!isset($_SESSION["dataInputs"])) {
                include("empty-form.php");
            }
            else {
                include("filled-form.php");
                unset($_SESSION["dataInputs"]);
            }
        ?>
    </div>
</div>
