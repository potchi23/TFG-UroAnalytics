
        <div class="jumbotron">
            <h1 style="font-weight:600;">Filtro de filiación</h1>
            <input type="button" value="Fecha exacta" onclick="document.getElementById('cir21').style.display = 'none'; document.getElementById('cir22').style.display = 'none';">
            <input type="button" value="Intervalo" onclick="document.getElementById('cir21').style.display = 'block'; document.getElementById('cir22').style.display = 'block';">
            <hr class="my-4">
            <div class="form-row align-items-center">
                <div class="col-xl-">
                    <h3> Fecha PRL:  </h3>
                </div>
                <div class="col-xl-">
                    <input type="date" name="cir1">      
                </div>
                <div id="cir21" class="col-xl-" style="display: none">
                    <h4>Hasta: </h4>
                </div>
                <div id="cir22" class="col-xl-" style="display: none">
                    <input type="date" name="cir2">
                </div>
            </div>     
        </div>
