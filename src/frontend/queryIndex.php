<!DOCTYPE html>

<?php
    include_once("models/User.php");
    session_start();
?>

<html>
    <head>
        <title>Realizar consulta</title>

        <?php include_once("common/includes.php");?>
        
        <script language="javaScript">          
            function toggleCB(op) { 
                op.disabled = !op.disabled;
            }

            function toggleField(idfield, idCB){
                field = document.getElementById(idfield);
                cb = document.getElementById(idCB).checked;

                if(cb){
                    field.style.display = "block"
                }else{
                    field.style.display = "none"
                }
            }

            function toggleButtons(op){
                let switches = ["boolCIR", "boolSociodemographic", "boolClinic", "boolBiopsy", "boolProstate", "boolEvolve", "boolMarkers"];
                let fields = ["queryCIR", "querySociodemographic", "queryClinic", "queryBiopsy", "queryProstate", "queryEvolve", "queryMarkers"];
                let fieldsSidebar = ["queryCIRSidebar", "querySociodemographicSidebar", "queryClinicSidebar", "queryBiopsySidebar", "queryProstateSidebar", "queryEvolveSidebar", "queryMarkersSidebar"];

                
                if(op == 'enableAll'){
                    for(var i=0; i < switches.length; i++){
                        document.getElementById(switches[i]).checked = true;
                        toggleField(fields[i], switches[i]);
                        toggleField(fieldsSidebar[i], switches[i]);
                    }
                }
                else if (op == 'disableAll'){
                    for(var i=0; i < switches.length; i++){
                        document.getElementById(switches[i]).checked = false;
                        toggleField(fields[i], switches[i]);
                        toggleField(fieldsSidebar[i], switches[i]);
                    }
                }
            }
        </script>

        <meta charset="utf-8">
    </head>
    <body>  
                <div class="header">
                    <div class="fixed-top">
                        <?php include_once("common/header.php");?>
                    </div>
                </div>    
                <div class="sidebar-container" id="list-example">
                    <?php include_once("querys/sidebarQuery.php")?>
                </div>
                <div class="content-container" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                    <div class="container-fluid">
                        <!-- Main component for a primary marketing message or call to action -->
                        <div class="jumbotron" id="indexQuery">
                            <h1 style="font-weight: 600">Realizador de consultas</h1>
                            <hr class="my-4">
                            <h5>Para realizar una consulta debe rellenar los filtros deseados de la barra lateral izquierda.</h5>
                            <h5>A continuación deberá presionar el botón de realizar consulta.</h5>
                        </div>

                        <div class="jumbotron">
                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-switch custom-switch-md">
                                        <input type="checkbox" class="custom-control-input" id="boolCIR" onclick="toggleField('queryCIR', 'boolCIR'); toggleField('queryCIRSidebar', 'boolCIR')">
                                        <label class="custom-control-label" for="boolCIR">Filiación</label>
                                    </div>
                                    <div class="custom-control custom-switch custom-switch-md">
                                        <input type="checkbox" class="custom-control-input" id="boolSociodemographic" onclick="toggleField('querySociodemographic', 'boolSociodemographic'); toggleField('querySociodemographicSidebar', 'boolSociodemographic')">
                                        <label class="custom-control-label" for="boolSociodemographic">Sociodemográfico</label>
                                    </div>
                                    <div class="custom-control custom-switch custom-switch-md">
                                        <input type="checkbox" class="custom-control-input " id="boolClinic" onclick="toggleField('queryClinic', 'boolClinic'); toggleField('queryClinicSidebar', 'boolClinic')">
                                        <label class="custom-control-label" for="boolClinic">Clínico patológico</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="custom-control custom-switch custom-switch-md">
                                        <input type="checkbox" class="custom-control-input" id="boolBiopsy" onclick="toggleField('queryBiopsy', 'boolBiopsy'); toggleField('queryBiopsySidebar', 'boolBiopsy')">
                                        <label class="custom-control-label" for="boolBiopsy">Biopsias prostáticas</label>
                                    </div>
                                    <div class="custom-control custom-switch custom-switch-md">
                                        <input type="checkbox" class="custom-control-input" id="boolProstate" onclick="toggleField('queryProstate', 'boolProstate'); toggleField('queryProstateSidebar', 'boolProstate')">
                                        <label class="custom-control-label" for="boolProstate">Tras prostatectomía</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="custom-control custom-switch custom-switch-md">
                                        <input type="checkbox" class="custom-control-input" id="boolEvolve" onclick="toggleField('queryEvolve', 'boolEvolve'); toggleField('queryEvolveSidebar', 'boolEvolve')">
                                        <label class="custom-control-label" for="boolEvolve">Evolutivos</label>
                                    </div>
                                    <div class="custom-control custom-switch custom-switch-md">
                                        <input type="checkbox" class="custom-control-input" id="boolMarkers" onclick="toggleField('queryMarkers', 'boolMarkers'); toggleField('queryMarkersSidebar', 'boolMarkers')">
                                        <label class="custom-control-label" for="boolMarkers">Marcadores</label>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <button class="btn btn-primary btn-md ml-4" id="enableAll" onclick="toggleButtons('enableAll')">Seleccionar todos</button>
                                <button class="btn btn-secondary btn-md ml-4" id="disableAll" onclick="toggleButtons('disableAll')">Eliminar filtros</button>
                            </div>  
                        </div>
                        
                        <div id="queryCIR" style="display:none;">
                            <?php include_once("querys/queryCIR.php")?>
                        </div>

                        <div id="querySociodemographic" style="display:none;">
                            <?php include_once("querys/querySociodemographic.php")?>
                        </div>

                        <div id="queryClinic" style="display:none;">
                            <?php include_once("querys/queryClinic.php")?>
                        </div>

                        <div id="queryBiopsy" style="display:none;">
                            <?php include_once("querys/queryBiopsy.php")?>
                        </div>

                        <div id="queryProstate" style="display:none;">
                            <?php include_once("querys/queryProstate.php")?>
                        </div>

                        <div id="queryEvolve" style="display:none;">
                            <?php include_once("querys/queryEvolve.php")?>
                        </div>

                        <div id="queryMarkers" style="display:none;">
                            <?php include_once("querys/queryMarkers.php")?>
                        </div>

                    </div>
                </div>

               
                <footer class="bg-light text-center text-lg-start">
                    <?php include_once("common/footer.php")?>
                </footer>  
        <script>
            let switches = ["boolCIR", "boolSociodemographic", "boolClinic", "boolBiopsy", "boolProstate", "boolEvolve", "boolMarkers"];
            let fields = ["queryCIR", "querySociodemographic", "queryClinic", "queryBiopsy", "queryProstate", "queryEvolve", "queryMarkers"];
            let fieldsSidebar = ["queryCIRSidebar", "querySociodemographicSidebar", "queryClinicSidebar", "queryBiopsySidebar", "queryProstateSidebar", "queryEvolveSidebar", "queryMarkersSidebar"];

            for(var i=0; i < switches.length; i++){
                toggleField(fields[i], switches[i]);
                toggleField(fieldsSidebar[i], switches[i]);
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>