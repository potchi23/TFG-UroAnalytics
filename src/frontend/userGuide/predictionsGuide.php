<div class="jumbotron">
    <h1 style="font-weight:600;">Predicciones</h1>
    <hr class="my-4">
    <p>Para realizar una predicción debe realizar los siguientes pasos:</p>
    
    <ol>
        <li>
            <p>Importar un archivo en formato <b>.csv, .xls y .xlsx</b> y un tamaño <b>menor a 200Kb</b> con los datos 
                del paciente sobre el que quiera realizar la predicción y después pulsar 
                el botón <b>Importar desde fichero</b>. </p>
            <img src="../img/userGuide11.png" class="d-block w-100" style="border: 20px solid #FFF;" alt="userGuide11"><br>

            <p>También puede rellenar manualmente las variables que aparecen en el <b>Formulario de paciente para predicción</b>.</p>
            <img src="../img/userGuide12.png" class="d-block w-100" style="border: 20px solid #FFF;" alt="userGuide12"><br>

            <p>En el caso de importar un archivo, el formulario se rellenará automáticamente 
               con los datos del archivo.</p>
        </li>
        <li><p>En la sección <b>Algoritmo a utilizar</b> aparece lo siguiente:</p>
            <img src="../img/userGuide13.png" class="d-block w-100" style="border: 20px solid #FFF;" alt="userGuide13"><br>
            <p>
            En esta sección, el usuario debe elegir el algoritmo de predicción que 
            desee emplear y una vez seleccionado, aparecerá el botón <b>Predecir</b> que tendrá que pulsar para que se ejecute la predicción. 
            Los algoritmos de predicción posibles son los siguientes:</p>
            <ul>
                <li><b>Bosques aleatorios</b>: Es un modelo de Machine Learning formado por 
                    árboles aleatorios. La predicción se realiza a partir de los resultados 
                    de cada uno de los árboles siendo la predicción aquella salida que se ha “votado” mayoritariamente.</li>
                <li><b>Regresión logística</b>: este modelo de predicción consiste en clasificar los datos de entrada en valores binarios o categóricos.</li>
                <li><b>K-NN</b>: se trata de otro modelo de clasificación, pero este realiza la clasificación mediante <i>clustering</i>, es decir, dado 
                    un dato nuevo este se clasifica según la distancia a un dato o grupo de datos que ya han sido predecidos con anterioridad en dicho proceso 
                    de predicción. La salida de la predicción será el valor de la variable categórica con la que tenga la distancia más cercana.</li>
                <li><b>Clasificación por votación</b>: clasifica un nuevo dato en función de los distintos modelos de predicción que conforman este modelo.</li>
            </ul>
        </li><br>
        <li>Una vez realizada la predicción se le mostrará los porcentajes de <b>Accuracy, Recall y Precision</b> y en el campo 
            <b>Resultado</b> el valor de la variable <b>RBQ</b> obtenida.</li>
    </ol>   
</div>