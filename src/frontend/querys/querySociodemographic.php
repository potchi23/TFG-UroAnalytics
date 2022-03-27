
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h1 style="font-weight:600;">Filtro sociodemográfico</h1>
            <hr class="my-4">
            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Edad del paciente </h3>
                </div>
                    <div class="col-">
                            <input type="text" class="form-control" name="sociodemographic1" placeholder="Edad" style="width:10em;">
                    </div>
                    <div class="col my-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" value="<" class="custom-control-input" name="sociodemographic1op" id="sociodemographicop1" onclick="toggleCB(document.getElementById('sociodemographicop3'))">
                            <label class="custom-control-label" for="sociodemographicop1">Menor que</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" value="=" class="custom-control-input" name="sociodemographic1=" id="sociodemographicop2">
                            <label class="custom-control-label" for="sociodemographicop2">Igual</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" value=">" class="custom-control-input" name="sociodemographic1op" id="sociodemographicop3" onclick="toggleCB(document.getElementById('sociodemographicop1'))">
                            <label class="custom-control-label" for="sociodemographicop3">Mayor que</label>
                        </div>
                    </div>
            </div>

        </div>