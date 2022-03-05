
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h1 style="font-weight:600;">Filtro de biopsias prostáticas</h1>

            <!--
            <hr class="my-4">
            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h2> Número de biopsias previas </h2>
                </div>
                <div class="col-">
                        <input type="text" class="form-control" placeholder="Biopsias" style="width:10em;">
                </div>
                <div class="col my-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="op1" onclick="toggleCB(document.getElementById('op3'))">
                            <label class="custom-control-label" for="op1">Menor que</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="op2">
                            <label class="custom-control-label" for="op2">Igual</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="op3" onclick="toggleCB(document.getElementById('op1'))">
                            <label class="custom-control-label" for="op3">Mayor que</label>
                        </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h2> Tipo de histórico </h2>
                </div>
                    <div class="col my-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" checked class="custom-control-input" id="historicOp1" name="groupOfDefaultRadios">
                            <label class="custom-control-label" for="historicOp1">NC</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="historicOp2" name="groupOfDefaultRadios">
                            <label class="custom-control-label" for="historicOp2">Adenocarcinoma</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="historicOp3" name="groupOfDefaultRadios">
                            <label class="custom-control-label" for="historicOp3">Otro</label>
                        </div>
                    </div>
            </div>
            -->

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Gleason 1 </h3>
                </div>
                <div class="col my-auto">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                        <option selected>Choose...</option>
                        <option value="1">6</option>
                        <option value="2">7 (3+4)</option>
                        <option value="3">7 (4+3)</option>
                        <option value="4">8-10</option>
                        <option value="5">Inclasificable</option>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Número de cilindros positivos </h3>
                </div>
                <div class="col my-auto">
                <input type="range" value="50" min="0" max="100" oninput="this.nextElementSibling.value = this.value">
                <output style="margin-left:10px">50</output>%
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Mayor % afectación un cilindro </h3>
                </div>
                <div class="col my-auto">
                    <input type="range" value="50" min="0" style="width:80%; margin-left:10px" max="100" step="1" oninput="this.nextElementSibling.value = this.value">
                <output style="margin-left:10px">50</output>%                    
                </div>
                    <div class="col my-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="portcilop1" onclick="toggleCB(document.getElementById('portcilop3'))">
                            <label class="custom-control-label" for="portcilop1">Menor que</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="portcilop2">
                            <label class="custom-control-label" for="portcilop2">Igual</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="portcilop3" onclick="toggleCB(document.getElementById('portcilop1'))">
                            <label class="custom-control-label" for="portcilop3">Mayor que</label>
                        </div>
                    </div>
            </div>
            <!--

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h2> Bilateralidad </h2>
                </div>
                <div class="col my-auto">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                        <option selected>NC</option>
                        <option value="1">Sí</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h2> Infiltración perineural </h2>
                </div>
                <div class="col my-auto">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                        <option selected>NC</option>
                        <option value="1">Sí</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h2> Infiltración linfática </h2>
                </div>
                <div class="col my-auto">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                        <option selected>NC</option>
                        <option value="1">Sí</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h2> Infiltración vascular </h2>
                </div>
                <div class="col my-auto">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                        <option selected>NC</option>
                        <option value="1">Sí</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
            -->

            <hr class="my-4">

            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> cTNM biopsia </h3>
                </div>
                <div class="col my-auto">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width:10em">
                        <option selected>Choose...</option>
                        <option value="1">cT2ab</option>
                        <option value="2">cT2c</option>
                        <option value="3">cT3</option>
                    </select>
                </div>
            </div>
        </div>
