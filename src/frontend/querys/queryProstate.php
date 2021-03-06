
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h1 style="font-weight:600;">Filtro tras prostatectomía</h1>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Gleason pieza PRL </h3>
                </div>
                    <div class="col my-auto">
                        <select class="custom-select mr-sm-2" name="prostate1" id="inlineFormCustomSelect" style="width:10em">
                            <option selected value="">Choose...</option>
                            <option value="1">6</option>
                            <option value="2">7 (3+4)</option>
                            <option value="3">7 (4+3)</option>
                            <option value="4">8-10</option>
                            <option value="5"> menor que 6</option>
                        </select>
                    </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Bilateralidad </h3>
                </div>
                    <div class="col my-auto">
                        <select class="custom-select mr-sm-2" name="prostate2" id="inlineFormCustomSelect" style="width:10em">
                            <option selected value="">Choose...</option>
                            <option value="1">Si</option>
                            <option value="2">No</option>
                        </select>
                    </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Volumen tumoral </h3>
                </div>
                <div class="col-xl-">
                    <div class="custom-control custom-switch custom-switch-md" style="margin-bottom: 0.5em">
                        <input type="checkbox" class="custom-control-input" id="boolProstate3" name="boolProstate3" onclick="toggleField('prostate3', 'boolProstate3')">
                        <label class="custom-control-label" for="boolProstate3"></label>
                    </div>
                </div>
            </div>
            
            <div id="prostate3" style="display:none;">
                <div class="form-row align-items-center">
                    <div class="col my-auto">
                        <input type="range" name="prostate3" value="50" min="0" style="width:80%; margin-left:10px" max="100" step="1" oninput="this.nextElementSibling.value = this.value">
                        <output style="margin-left:10px">50</output>%                    
                    </div>
                    <div class="col my-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" value="<" class="custom-control-input" name="prostate3op" id="volop1" onclick="toggleCB(document.getElementById('volop3'))">
                            <label class="custom-control-label" for="volop1">Menor que</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" value="=" class="custom-control-input" name="prostate3=" id="volop2">
                            <label class="custom-control-label" for="volop2">Igual</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" value=">" class="custom-control-input" name="prostate3op" id="volop3" onclick="toggleCB(document.getElementById('volop1'))">
                            <label class="custom-control-label" for="volop3">Mayor que</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Extensión extracapsular </h3>
                </div>
                    <div class="col my-auto">
                        <select class="custom-select mr-sm-2" name="prostate4" id="inlineFormCustomSelect" style="width:10em">
                            <option selected value="">Choose...</option>
                            <option value="1">Si</option>
                            <option value="2">No</option>
                        </select>
                    </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Invasión Vesículas Seminales </h3>
                </div>
                    <div class="col my-auto">
                        <select class="custom-select mr-sm-2" name="prostate5" id="inlineFormCustomSelect" style="width:10em">
                            <option selected value="">Choose...</option>
                            <option value="1">Si</option>
                            <option value="2">No</option>
                            <option value="3">NC</option>
                        </select>
                    </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> PIN alto grado pieza </h3>
                </div>
                    <div class="col my-auto">
                        <select class="custom-select mr-sm-2" name="prostate6" id="inlineFormCustomSelect" style="width:10em">
                            <option selected value="">Choose...</option>
                            <option value="1">Si</option>
                            <option value="2">No</option>
                            <option value="3">NC</option>
                        </select>
                    </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Márgenes quirúrgicos positivos </h3>
                </div>
                    <div class="col my-auto">
                        <select class="custom-select mr-sm-2" name="prostate7" id="inlineFormCustomSelect" style="width:10em">
                            <option selected value="">Choose...</option>
                            <option value="1">Si</option>
                            <option value="2">No</option>
                            <option value="3">NC</option>
                        </select>
                    </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> TNM pieza </h3>
                </div>
                    <div class="col my-auto">
                        <select class="custom-select mr-sm-2" name="prostate8" id="inlineFormCustomSelect" style="width:10em">
                            <option selected value="">Choose...</option>
                            <option value="1">pT2ab</option>
                            <option value="2">pT2c</option>
                            <option value="3">pT3</option>
                            <option value="3">pT4</option>
                            <option value="3">pN+</option>
                        </select>
                    </div>
            </div>
        </div>