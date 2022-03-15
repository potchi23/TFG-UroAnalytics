<div class="jumbotron">
    <h1 style="font-weight:600;">Filtro de evolutivos</h1>
    
    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> PSA posoperatorio 1º </h3>
        </div>
        <div class="col-">
                <input type="text" class="form-control" placeholder="PSAPOS" name="evolve1" style="width:10em;">
        </div>
        <div class="col my-auto">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="psaop1" name="evolve1<" onclick="toggleCB(document.getElementById('psaop3'))">
                <label class="custom-control-label" for="psaop1">Menor que</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="evolve1=" id="psaop2">
                <label class="custom-control-label" for="psaop2">Igual</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="psaop3" name="evolve1>" onclick="toggleCB(document.getElementById('psaop1'))">
                <label class="custom-control-label" for="psaop3">Mayor que</label>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> RTP adyuvante </h3>
        </div>
        <div class="col my-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="evolve2" style="width:10em">
                <option selected>Choose...</option>
                <option value="1">Si</option>
                <option value="2">No</option>
            </select>
        </div>
    </div>
    
    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Tiempo hasta RTP adyuvante </h3>
        </div>
        <div class="col-">
                <input type="text" class="form-control" placeholder="meses" name="evolve3" style="width:10em;">
        </div>
        <div class="col my-auto">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="rtpop1" name="evolve3<" onclick="toggleCB(document.getElementById('rtpop3'))">
                <label class="custom-control-label" for="rtpop1">Menor que</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="evolve3=" id="rtpop2">
                <label class="custom-control-label" for="rtpop2">Igual</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="rtpop3" name="evolve3>" onclick="toggleCB(document.getElementById('rtpop1'))">
                <label class="custom-control-label" for="rtpop3">Mayor que</label>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Recidiva BQ </h3>
        </div>
        <div class="col my-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="evolve4" style="width:10em">
                <option selected>Choose...</option>
                <option value="1">Si (CASOS)</option>
                <option value="2">No (CONTROLES)</option>
                <option value="3">Persitencia PSA (PSA > 0,2 primer posoperatorio tras PRL)</option>
            </select>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Tiempo hasta RBQ </h3>
        </div>
        <div class="col my-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="evolve5" style="width:10em">
                <option selected>Choose...</option>
                <option value="1">Bajo riesgo (mayor o igual que 18 meses)</option>
                <option value="2">Alto riesgo (menor que 18 meses)</option>
            </select>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Tiempo duplicación PSA </h3>
        </div>
        <div class="col my-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="evolve6" style="width:10em">
                <option selected>Choose...</option>
                <option value="1">Alto riesgo (menor que 12 meses)</option>
                <option value="2">Bajo riesgo (mayor o igual que 12 meses)</option>
            </select>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Tiempo hasta 1ª metástasis </h3>
        </div>
        <div class="col-">
                <input type="text" class="form-control" placeholder="meses" name="evolve7" style="width:10em;">
        </div>
        <div class="col my-auto">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="metop1" name="evolve7<" onclick="toggleCB(document.getElementById('metop3'))">
                <label class="custom-control-label" for="metop1">Menor que</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="metop2" name="evolve7=">
                <label class="custom-control-label" for="metop2">Igual</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="metop3" name="evolve7>" onclick="toggleCB(document.getElementById('metop1'))">
                <label class="custom-control-label" for="metop3">Mayor que</label>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Tiempo de seguimiento desde PRL </h3>
        </div>
        <div class="col-">
                <input type="text" class="form-control" placeholder="meses" name="evolve8" style="width:10em;">
        </div>
        <div class="col my-auto">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="segop1" name="evolve8<" onclick="toggleCB(document.getElementById('segop3'))">
                <label class="custom-control-label" for="segop1">Menor que</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="evolve8=" id="segop2">
                <label class="custom-control-label" for="segop2">Igual</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="segop3" name="evolve8>" onclick="toggleCB(document.getElementById('segop1'))">
                <label class="custom-control-label" for="segop3">Mayor que</label>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Último PSA en seguimiento </h3>
        </div>
            <div class="col-">
                    <input type="text" class="form-control" placeholder="PSAPOS" name="evolve9" style="width:10em;">
            </div>
            <div class="col my-auto">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="ultpsaop1" name="evolve9<" onclick="toggleCB(document.getElementById('ultpsaop3'))">
                    <label class="custom-control-label" for="ultpsaop1">Menor que</label>
                </div>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="ultpsaop2" name="evolve9=">
                    <label class="custom-control-label" for="ultpsaop2">Igual</label>
                </div>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="ultpsaop3" name="evolve9>" onclick="toggleCB(document.getElementById('ultpsaop1'))">
                    <label class="custom-control-label" for="ultpsaop3">Mayor que</label>
                </div>
            </div>
    </div> 
    
    <hr class="my-4">

    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> CAPRA-S </h3>
        </div>
            <div class="col my-auto">
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="evolve10" style="width:10em">
                    <option selected>Choose...</option>
                    <option value="1">Bajo riesgo (0-2)</option>
                    <option value="2">Medio (2-5)</option>
                    <option value="3">Alto riesgo (> 5)</option>
                </select>
            </div>
    </div>
</div>
