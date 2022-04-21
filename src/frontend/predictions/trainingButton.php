<div class="content-container" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
    <div class="container-fluid">
        <div class="jumbotron" id="indexPrediction">                        
            <h1 class="display-8" style="font-weight:600;">Entrenar</h1><br>                        
            <hr class="my-1"><br>
            <h5>Para realizar un entrenamiento con los datos actuales en la base de datos, pulse el botón "Entrenar".</h5>
            <p>Esta opción solo está disponible para los Administradores.</p>
            <div class="training-form">
                <form action="../requests/getTraining.php" method="get">
                    <label for="training-button" class="btn btn-danger">
                        Entrenar
                    </label>
                    <input id="training-button" type="submit"/> 
                </form>
            </div>
        </div>
    </div>
</div>