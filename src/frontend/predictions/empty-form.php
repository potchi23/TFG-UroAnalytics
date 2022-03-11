<?php

if(!defined('import-form')) {
    die('Direct access not permitted');
}

echo <<<EOHTML
    
        <div class="input-group-prepend">
        <span class="input-group-text">NHIS</span>
        <input class="prediction-form-input" type="text" id="NHIS" name="NHIS" placeholder="NHIS" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">FECHACIR</span>
        <input class="prediction-form-input" type="text" id="FECHACIR" name="FECHACIR" placeholder="FECHACIR" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">EDAD</span>
        <input class="prediction-form-input" type="text" id="EDAD" name="EDAD" placeholder="EDAD" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">ETNIA</span>
        <input class="prediction-form-input" type="text" id="ETNIA" name="ETNIA" placeholder="ETNIA" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">OBESO</span>
        <input class="prediction-form-input" type="text" id="OBESO" name="OBESO" placeholder="OBESO" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">HTA</span>
        <input class="prediction-form-input" type="text" id="HTA" name="HTA" placeholder="HTA" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">DM</span>
        <input class="prediction-form-input" type="text" id="DM" name="DM" placeholder="DM" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TABACO</span>
        <input class="prediction-form-input" type="text" id="TABACO" name="TABACO" placeholder="TABACO" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">HEREDA</span>
        <input class="prediction-form-input" type="text" id="HEREDA" name="HEREDA" placeholder="HEREDA" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TACTOR</span>
        <input class="prediction-form-input" type="text" id="TACTOR" name="TACTOR" placeholder="TACTOR" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">PSAPRE</span>
        <input class="prediction-form-input" type="text" id="PSAPRE" name="PSAPRE" placeholder="PSAPRE" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">PSALT</span>
        <input class="prediction-form-input" type="text" id="PSALT" name="PSALT" placeholder="PSALT" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TDUPPRE</span>
        <input class="prediction-form-input" type="text" id="TDUPPRE" name="TDUPPRE" placeholder="TDUPPRE" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">ECOTR</span>
        <input class="prediction-form-input" type="text" id="ECOTR" name="ECOTR" placeholder="ECOTR" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">NBIOPSIA</span>
        <input class="prediction-form-input" type="text" id="NBIOPSIA" name="NBIOPSIA" placeholder="NBIOPSIA" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">HISTO</span>
        <input class="prediction-form-input" type="text" id="HISTO" name="HISTO" placeholder="HISTO" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">GLEASON1</span>
        <input class="prediction-form-input" type="text" id="GLEASON1" name="GLEASON1" placeholder="GLEASON1" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">NCILPOS</span>
        <input class="prediction-form-input" type="text" id="NCILPOS" name="NCILPOS" placeholder="NCILPOS" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">BILAT</span>
        <input class="prediction-form-input" type="text" id="BILAT" name="BILAT" placeholder="BILAT" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">PORCENT</span>
        <input class="prediction-form-input" type="text" id="PORCENT" name="PORCENT" placeholder="PORCENT" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">IPERIN</span>
        <input class="prediction-form-input" type="text" id="IPERIN" name="IPERIN" placeholder="IPERIN" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">ILINF</span>
        <input class="prediction-form-input" type="text" id="ILINF" name="ILINF" placeholder="ILINF" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">IVASCU</span>
        <input class="prediction-form-input" type="text" id="IVASCU" name="IVASCU" placeholder="IVASCU" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TNM1</span>
        <input class="prediction-form-input" type="text" id="TNM1" name="TNM1" placeholder="TNM1" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">HISTO2</span>
        <input class="prediction-form-input" type="text" id="HISTO2" name="HISTO2" placeholder="HISTO2" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">GLEASON2</span>
        <input class="prediction-form-input" type="text" id="GLEASON2" name="GLEASON2" placeholder="GLEASON2" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">BILAT2</span>
        <input class="prediction-form-input" type="text" id="BILAT2" name="BILAT2" placeholder="BILAT2" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">LOCALIZ</span>
        <input class="prediction-form-input" type="text" id="LOCALIZ" name="LOCALIZ" placeholder="LOCALIZ" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">MULTIFOC</span>
        <input class="prediction-form-input" type="text" id="MULTIFOC" name="MULTIFOC" placeholder="MULTIFOC" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">VOLUMEN</span>
        <input class="prediction-form-input" type="text" id="VOLUMEN" name="VOLUMEN" placeholder="VOLUMEN" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">EXTRACAP</span>
        <input class="prediction-form-input" type="text" id="EXTRACAP" name="EXTRACAP" placeholder="EXTRACAP" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">VVSS</span>
        <input class="prediction-form-input" type="text" id="VVSS" name="VVSS" placeholder="VVSS" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">IPERIN2</span>
        <input class="prediction-form-input" type="text" id="IPERIN2" name="IPERIN2" placeholder="IPERIN2" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">ILINF2</span>
        <input class="prediction-form-input" type="text" id="ILINF2" name="ILINF2" placeholder="ILINF2" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">IVASCU2</span>
        <input class="prediction-form-input" type="text" id="IVASCU2" name="IVASCU2" placeholder="IVASCU2" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">PINAG</span>
        <input class="prediction-form-input" type="text" id="PINAG" name="PINAG" placeholder="PINAG" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">MARGEN</span>
        <input class="prediction-form-input" type="text" id="MARGEN" name="MARGEN" placeholder="MARGEN" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TNM2</span>
        <input class="prediction-form-input" type="text" id="TNM2" name="TNM2" placeholder="TNM2" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">PSAPOS</span>
        <input class="prediction-form-input" type="text" id="PSAPOS" name="PSAPOS" placeholder="PSAPOS" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">RTPADYU</span>
        <input class="prediction-form-input" type="text" id="RTPADYU" name="RTPADYU" placeholder="RTPADYU" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">RTPMES</span>
        <input class="prediction-form-input" type="text" id="RTPMES" name="RTPMES" placeholder="RTPMES" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">RBQ</span>
        <input class="prediction-form-input" type="text" id="RBQ" name="RBQ" placeholder="RBQ" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TRBQ</span>
        <input class="prediction-form-input" type="text" id="TRBQ" name="TRBQ" placeholder="TRBQ" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TDUPLI</span>
        <input class="prediction-form-input" type="text" id="TDUPLI" name="TDUPLI" placeholder="TDUPLI" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">T1MTX</span>
        <input class="prediction-form-input" type="text" id="T1MTX" name="T1MTX" placeholder="T1MTX" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">FECHAFIN</span>
        <input class="prediction-form-input" type="text" id="FECHAFIN" name="FECHAFIN" placeholder="FECHAFIN" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">FALLEC</span>
        <input class="prediction-form-input" type="text" id="FALLEC" name="FALLEC" placeholder="FALLEC" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TSUPERV</span>
        <input class="prediction-form-input" type="text" id="TSUPERV" name="TSUPERV" placeholder="TSUPERV" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">PSAFIN</span>
        <input class="prediction-form-input" type="text" id="PSAFIN" name="PSAFIN" placeholder="PSAFIN" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">TSEGUI</span>
        <input class="prediction-form-input" type="text" id="TSEGUI" name="TSEGUI" placeholder="TSEGUI" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">NOTAS</span>
        <input class="prediction-form-input" type="text" id="NOTAS" name="NOTAS" placeholder="NOTAS" value="">
        </div>
    
        <div class="input-group-prepend">
        <span class="input-group-text">CAPRA-S</span>
        <input class="prediction-form-input" type="text" id="CAPRA-S" name="CAPRA-S" placeholder="CAPRA-S" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">RA</span>
        <input class="prediction-form-input" type="text" id="RA" name="RA" placeholder="RA" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">PTEN</span>
        <input class="prediction-form-input" type="text" id="PTEN" name="PTEN" placeholder="PTEN" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">ERG</span>
        <input class="prediction-form-input" type="text" id="ERG" name="ERG" placeholder="ERG" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">KI-67</span>
        <input class="prediction-form-input" type="text" id="KI-67" name="KI-67" placeholder="KI-67" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">SPINK1</span>
        <input class="prediction-form-input" type="text" id="SPINK1" name="SPINK1" placeholder="SPINK1" value="">
        </div>
        <div class="input-group-prepend">
        <span class="input-group-text">C-MYC</span>
        <input class="prediction-form-input" type="text" id="C-MYC" name="C-MYC" placeholder="C-MYC" value="">
        </div>

    EOHTML;