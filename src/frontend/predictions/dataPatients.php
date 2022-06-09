<div class="jumbotron">
    <div class="prediction-header">

        <h1 style="font-weight:600;">Datos del paciente</h1>
        <hr class="my-4">
                            
        <div class="import-form">
            <h2>Importar datos de paciente</h2>
            <p>
                Los ficheros admitidos son de extensión .csv, .xls y xlsx. Si el fichero contiene más de una fila, solamente se utilizará la primera fila.
                Los datos importados aparecerán automáticamente en el <b>Formulario de paciente para predicción</b> que aparece más abajo. <br/><br/>

                Si se dispone de una hoja de datos, se sugiere copiar la fila con los datos necesarios en la plantilla que puede descargarse 
                <a href="../resources/plantilla_datos_pacientes.xlsx" download="plantilla_datos_pacientes.xlsx">aquí</a>.
            </p>

            <form action="submit_data.php" method="post" enctype="multipart/form-data">
                <input type="file" id="prediction-import" name="prediction-import">
                <button class="btn btn-primary ml-4" type="submit">Importar desde fichero</button>
            </form>
        </div>
        </br>

        <?php
            if (isset($_SESSION["message"])){
                $message = $_SESSION["message"];
                echo "<div class='alert-message'><p></p><p class='alert alert-success'>$message</p></div>";

                unset($_SESSION["message"]);
            }

            if (isset($_SESSION["error"]) && !empty($_SESSION["error"])){
                echo"</p><div class='alert-message'><div class='alert alert-danger'>";
                foreach($_SESSION["error"] as $error){
                    echo $error . "<br>";
                }
                echo"</div></div>";
                unset($_SESSION["error"]);
            }
        ?> 
    </div>
    <br>

    <h2>Formulario de paciente para predicción</h2>
    <br>
    <div class="d-flex justify-content-between input-group prediction-data">

        <?php
            include("predictionForm.php");

            if(!isset($_SESSION["dataInputs"])) {
                unset($_SESSION["dataInputs"]);
            }
        ?>
    </div>
</div>
