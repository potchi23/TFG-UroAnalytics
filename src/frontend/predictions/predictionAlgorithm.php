<script src="predictions.js"></script>
<label for="algorithms">Algoritmo seleccionado: </label>
<select name="algorithms" id="algorithms">
    <option value="none">Seleccione algoritmo...</option>
    <option value="rfc">Bosques Aleatorios</option>
    <option value="lrc">Regresión Logística</option>
    <option value="knn">k-NN</option>
    <option value="best">Clasificación por votación</option>
</select>

<button class="btn btn-danger btn-sm ml-2" id="prediction-button" type="button" style="z-index:0;">Predecir</button>

<div>        
    <div class="prediction-accuracy">
        <label for="prediction-accuracy">
            Accuracy: 
        </label>
        <input type="text" id="prediction-accuracy" name="prediction-accuracy" value="0.0" disabled>
    </div>
    <br>
    <div class="prediction-recall">
        <label for="prediction-recall-1" style="margin-right:1.7rem;">
            Recall Si (CASOS): 
        </label>
        <input type="text" id="prediction-recall-1" name="prediction-recall-1" value="0.0" disabled>

        <label for="prediction-recall-2" style="margin-right:1.7rem;">
            Recall No (CONTROLES): 
        </label>
        <input type="text" id="prediction-recall-2" name="prediction-recall-2" value="0.0" disabled>
    </div>

    <br>

    <div class="prediction-precision">
        <label for="prediction-precision-1">
            Precision Si (CASOS): 
        </label>
        <input type="text" id="prediction-precision-1" name="prediction-precision-1" value="0.0" disabled>
        
        <label for="prediction-precision-2">
            Precision No (CONTROLES): 
        </label>
        <input type="text" id="prediction-precision-2" name="prediction-precision-2" value="0.0" disabled>
    </div>
</div>

<br>

<div class="input-group result">
    <label for="prediction-result">
        Resultado:
    </label>
    
    <input type="text" class="prediction-result" id="prediction-result" name="prediction-result" value="" disabled>
</div>
