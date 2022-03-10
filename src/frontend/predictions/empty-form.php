<?php

if(!defined('import-form')) {
    die('Direct access not permitted');
}

echo <<<EOHTML
        
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">NHIS</span>
                    <input class="prediction-form-input" type="text" size="12" id="NHIS" name="NHIS" placeholder="NHIS">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">FECHACIR</span>
                    <input class="prediction-form-input" type="text" size="12" id="FECHACIR" name="FECHACIR" placeholder="FECHACIR">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">EDAD</span>
                    <input class="prediction-form-input" type="text" size="12" id="EDAD" name="EDAD" placeholder="EDAD">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">ETNIA</span>
                    <input class="prediction-form-input" type="text" size="12" id="ETNIA" name="ETNIA" placeholder="ETNIA">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">OBESO</span>
                    <input class="prediction-form-input" type="text" size="12" id="OBESO" name="OBESO" placeholder="OBESO">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">HTA</span>
                    <input class="prediction-form-input" type="text" size="12" id="HTA" name="HTA" placeholder="HTA">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">DM</span>
                    <input class="prediction-form-input" type="text" size="12" id="DM" name="DM" placeholder="DM">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TABACO</span>
                    <input class="prediction-form-input" type="text" size="12" id="TABACO" name="TABACO" placeholder="TABACO">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">HEREDA</span>
                    <input class="prediction-form-input" type="text" size="12" id="HEREDA" name="HEREDA" placeholder="HEREDA">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TACTOR</span>
                    <input class="prediction-form-input" type="text" size="12" id="TACTOR" name="TACTOR" placeholder="TACTOR">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">PSAPRE</span>
                    <input class="prediction-form-input" type="text" size="12" id="PSAPRE" name="PSAPRE" placeholder="PSAPRE">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">PSALT</span>
                    <input class="prediction-form-input" type="text" size="12" id="TABACO" name="PSALT" placeholder="PSALT">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TDUPPRE</span>
                    <input class="prediction-form-input" type="text" size="12" id="TDUPPRE" name="TDUPPRE" placeholder="TDUPPRE">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">ECOTR</span>
                    <input class="prediction-form-input" type="text" size="12" id="ECOTR" name="ECOTR" placeholder="ECOTR">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">NBIOPSIA</span>
                    <input class="prediction-form-input" type="text" size="12" id="NBIOPSIA" name="NBIOPSIA" placeholder="NBIOPSIA">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">HISTO</span>
                    <input class="prediction-form-input" type="text" size="12" id="HISTO" name="HISTO" placeholder="HISTO">
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">GLEASON1</span>
                    <input class="prediction-form-input" type="text" size="12" id="GLEASON1" name="GLEASON1" placeholder="GLEASON1">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">NCILPOS</span>
                    <input class="prediction-form-input" type="text" size="12" id="NCILPOS" name="NCILPOS" placeholder="NCILPOS">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">BILAT</span>
                    <input class="prediction-form-input" type="text" size="12" id="BILAT" name="BILAT" placeholder="BILAT">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">PORCENT</span>
                    <input class="prediction-form-input" type="text" size="12" id="PORCENT" name="PORCENT" placeholder="PORCENT">
                </div>
            </div>
        </div>
    </div>
 
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">IPERIN</span>
                    <input class="prediction-form-input" type="text" size="12" id="IPERIN" name="IPERIN" placeholder="IPERIN">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">ILINF</span>
                    <input class="prediction-form-input" type="text" size="12" id="ILINF" name="ILINF" placeholder="ILINF">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">IVASCU</span>
                    <input class="prediction-form-input" type="text" size="12" id="IVASCU" name="IVASCU" placeholder="IVASCU">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TNM1</span>
                    <input class="prediction-form-input" type="text" size="12" id="TNM1" name="TNM1" placeholder="TNM1">
                </div>
            </div>
        </div>
    </div>    

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">HISTO2</span>
                    <input class="prediction-form-input" type="text" size="12" id="HISTO2" name="HISTO2" placeholder="HISTO2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">GLEASON2</span>
                    <input class="prediction-form-input" type="text" size="12" id="GLEASON2" name="GLEASON2" placeholder="GLEASON2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">BILAT2</span>
                    <input class="prediction-form-input" type="text" size="12" id="BILAT2" name="BILAT2" placeholder="BILAT2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">LOCALIZ</span>
                    <input class="prediction-form-input" type="text" size="12" id="LOCALIZ" name="LOCALIZ" placeholder="LOCALIZ">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">MULTIFOC</span>
                    <input class="prediction-form-input" type="text" size="12" id="MULTIFOC" name="MULTIFOC" placeholder="MULTIFOC">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">VOLUMEN</span>
                    <input class="prediction-form-input" type="text" size="12" id="VOLUMEN" name="VOLUMEN" placeholder="VOLUMEN">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">EXTRACAP</span>
                    <input class="prediction-form-input" type="text" size="12" id="EXTRACAP" name="EXTRACAP" placeholder="EXTRACAP">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">VVSS</span>
                    <input class="prediction-form-input" type="text" size="12" id="VVSS" name="VVSS" placeholder="VVSS">
                </div>
            </div>
        </div>
    </div>   

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">IPERIN2</span>
                    <input class="prediction-form-input" type="text" size="12" id="IPERIN2" name="IPERIN2" placeholder="IPERIN2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">ILINF2</span>
                    <input class="prediction-form-input" type="text" size="12" id="ILINF2" name="ILINF2" placeholder="ILINF2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">IVASCU2</span>
                    <input class="prediction-form-input" type="text" size="12" id="IVASCU2" name="IVASCU2" placeholder="IVASCU2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">PINAG</span>
                    <input class="prediction-form-input" type="text" size="12" id="PINAG" name="PINAG" placeholder="PINAG">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">MARGEN</span>
                    <input class="prediction-form-input" type="text" size="12" id="MARGEN" name="MARGEN" placeholder="MARGEN">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TNM2</span>
                    <input class="prediction-form-input" type="text" size="12" id="TNM2" name="TNM2" placeholder="TNM2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">PSAPOS</span>
                    <input class="prediction-form-input" type="text" size="12" id="PSAPOS" name="PSAPOS" placeholder="PSAPOS">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">RTPADYU</span>
                    <input class="prediction-form-input" type="text" size="12" id="RTPADYU" name="RTPADYU" placeholder="RTPADYU">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">RBQ</span>
                    <input class="prediction-form-input" type="text" size="12" id="RBQ" name="RBQ" placeholder="RBQ">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">FALLEC</span>
                    <input class="prediction-form-input" type="text" size="12" id="FALLEC" name="FALLEC" placeholder="FALLEC">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">CAPRA-S</span>
                    <input class="prediction-form-input" type="text" size="12" id="CAPRA-S" name="CAPRA-S" placeholder="CAPRA-S">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">RTPMES</span>
                    <input class="prediction-form-input" type="text" size="12" id="RTPMES" name="RTPMES" placeholder="RTPMES">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TRBQ</span>
                    <input class="prediction-form-input" type="text" size="12" id="TRBQ" name="TRBQ" placeholder="TRBQ">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TDUPLI</span>
                    <input class="prediction-form-input" type="text" size="12" id="TDUPLI" name="TDUPLI" placeholder="TDUPLI">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">T1MTX</span>
                    <input class="prediction-form-input" type="text" size="12" id="T1MTX" name="T1MTX" placeholder="T1MTX">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">FECHAFIN</span>
                    <input class="prediction-form-input" type="text" size="12" id="FECHAFIN" name="FECHAFIN" placeholder="FECHAFIN">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TSUPERV</span>
                    <input class="prediction-form-input" type="text" size="12" id="TSUPERV" name="TSUPERV" placeholder="TSUPERV">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">PSAFIN</span>
                    <input class="prediction-form-input" type="text" size="12" id="PSAFIN" name="PSAFIN" placeholder="PSAFIN">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">TSEGUI</span>
                    <input class="prediction-form-input" type="text" size="12" id="TSEGUI" name="TSEGUI" placeholder="TSEGUI">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">Unnamed: 52</span>
                    <input class="prediction-form-input" type="text" size="12" id="Unnamed: 52" name="Unnamed: 52" placeholder="Unnamed: 52">
                </div>
            </div>
        </div>
    </div> 
    
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">Unnamed: 53</span>
                    <input class="prediction-form-input" type="text" size="12" id="Unnamed: 53" name="Unnamed: 53" placeholder="Unnamed: 53">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">RA</span>
                    <input class="prediction-form-input" type="text" size="12" id="RA" name="RA" placeholder="RA">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">PTEN</span>
                    <input class="prediction-form-input" type="text" size="12" id="PTEN" name="PTEN" placeholder="PTEN">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">ERG</span>
                    <input class="prediction-form-input" type="text" size="12" id="ERG" name="ERG" placeholder="ERG">
                </div>
            </div>
        </div>
    </div>    

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">KI-67</span>
                    <input class="prediction-form-input" type="text" size="12" id="KI-67" name="KI-67" placeholder="KI-67">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">SPINK1</span>
                    <input class="prediction-form-input" type="text" size="12" id="SPINK1" name="SPINK1" placeholder="SPINK1">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="border-color: black;">C-MYC</span>
                    <input class="prediction-form-input" type="text" size="12" id="C-MYC" name="C-MYC" placeholder="C-MYC">
                </div>
            </div>
        </div>
    </div>
    
    <div class="input-group mt-4">
        <div class="input-group-prepend">
            <span class="input-group-text" style="border-color: black;">NOTAS</span>
            <input class="prediction-form-input" type="text" size="50" id="NOTAS" name="NOTAS" placeholder="NOTAS">
        </div>
    </div>

    EOHTML;