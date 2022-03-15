<div class="jumbotron">
    <h1 style="font-weight:600;">Filtro sociodemográfico</h1>
    <hr class="my-4">
    <div class="form-row align-items-center">
        <div class="col-xl-">
            <h3> Edad del paciente </h3>
        </div>
        <div class="col-">
                <input type="text" class="form-control" placeholder="Edad" name="sociodemographic1" style="width:10em;">
        </div>
        <div class="col my-auto">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="op1" name="sociodemographic1<" onclick="toggleCB(document.getElementById('op3'))">
                <label class="custom-control-label" for="op1">Menor que</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="op2" name="sociodemographic1=">
                <label class="custom-control-label" for="op2">Igual</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="op3" name="sociodemographic1>" onclick="toggleCB(document.getElementById('op1'))">
                <label class="custom-control-label" for="op3">Mayor que</label>
            </div>
        </div>
    </div>
</div>