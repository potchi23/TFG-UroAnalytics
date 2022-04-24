<div class="jumbotron">
    <h1 style="font-weight:600;">Predicciones</h1>
    <hr class="my-4">
    
    <?php
        if($user->is_admin()) {
            echo "<p>En la página de <b>Predicciones</b> podrá realizar las siguientes acciones:</p>
                <ul style='margin-left:-20px;'>
                    <li><b>Entrenar:</b> Para realizar un entrenamiento con los datos actuales 
                        en la base de datos, pulse el botón <b>Entrenar</b>.</li>
                    <li><b>Realizar una predicción:</b> Para realizar una predicción debe realizar los siguientes pasos:</li>
                </ul>";
        }
        else {
            echo "<p>Para realizar una predicción debe realizar los siguientes pasos:</p>";
        }    
    ?>

    <ol>
        <li>
            <p>Importar un archivo en formato <b>.csv, .xls y .xlsx</b> y un tamaño <b>menor a 200Kb</b> con los datos 
                del paciente sobre el que quiera realizar la predicción y después pulsar 
                el botón <b>Importar desde fichero</b>. También puede rellenar manualmente las 
                variables que aparecen en el <b>Formulario de paciente para predicción</b>.</p>
            <p>En el caso de importar un archivo, el formulario se rellenará automáticamente 
               con los datos del archivo.</p>
        </li>
        <li><p>En la sección <b>Algoritmo a utilizar</b> aparece lo siguiente:</p>
            <img src="../img/userGuide5.png" class="d-block w-100" style="border: 20px solid #FFF;" alt="userGuide5"><br>
            En esta sección, debe elegir el algoritmo de predicción que desee emplear y pulsar el botón <b>Predecir</b>. Los algoritmos 
            de predicción posibles son los siguientes:
            <ul>
                <li><b>Árboles aleatorios</b></li>
                <li><b>Regresión logística</b></li>
                <li><b>K-NN</b></li>
                <li><b>Mejor resultado</b></li>
            </ul>
        </li><br>
        <li>Una vez realizada la predicción se le mostrará los porcentajes de <b>Acuracy, Recall y Precision</b> y en el campo 
            <b>Resultado</b> el valor de la variable <b>RBQ</b> obtenida.</li>
    </ol>
    <br>
    <p>Existe la posibilidad de realizar predicciones sobre aquellos pacientes en la base de datos cuyo RBQ no ha sido obtenido aún, 
        en la sección <b>Predicción sobre paciente existente</b>.</p>    
</div>