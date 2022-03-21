<?php

if(!defined('import-form')) {
    die('Direct access not permitted');
}

echo <<<EOHTML

    <div class="input-group-prepend">
    <span class="input-group-text">NHIS</span>
    <input class="prediction-form-input" type="text" id="NHIS" name="NHIS" placeholder="NHIS"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">FECHACIR</span>
    <input class="prediction-form-input" type="text" id="FECHACIR" name="FECHACIR" placeholder="FECHACIR"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">EDAD</span>
    <input class="prediction-form-input" type="text" id="EDAD" name="EDAD" placeholder="EDAD"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">ETNIA</span>
    <input class="prediction-form-input" type="text" id="ETNIA" name="ETNIA" placeholder="ETNIA"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">OBESO</span>
    <input class="prediction-form-input" type="text" id="OBESO" name="OBESO" placeholder="OBESO"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">HTA</span>
    <input class="prediction-form-input" type="text" id="HTA" name="HTA" placeholder="HTA"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">DM</span>
    <input class="prediction-form-input" type="text" id="DM" name="DM" placeholder="DM"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TABACO</span>
    <input class="prediction-form-input" type="text" id="TABACO" name="TABACO" placeholder="TABACO"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">HEREDA</span>
    <input class="prediction-form-input" type="text" id="HEREDA" name="HEREDA" placeholder="HEREDA"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TACTOR</span>
    <input class="prediction-form-input" type="text" id="TACTOR" name="TACTOR" placeholder="TACTOR"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">PSAPRE</span>
    <input class="prediction-form-input" type="text" id="PSAPRE" name="PSAPRE" placeholder="PSAPRE"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">PSALT</span>
    <input class="prediction-form-input" type="text" id="PSALT" name="PSALT" placeholder="PSALT"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TDUPPRE</span>
    <input class="prediction-form-input" type="text" id="TDUPPRE" name="TDUPPRE" placeholder="TDUPPRE"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">ECOTR</span>
    <input class="prediction-form-input" type="text" id="ECOTR" name="ECOTR" placeholder="ECOTR"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">NBIOPSIA</span>
    <input class="prediction-form-input" type="text" id="NBIOPSIA" name="NBIOPSIA" placeholder="NBIOPSIA"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">HISTO</span>
    <input class="prediction-form-input" type="text" id="HISTO" name="HISTO" placeholder="HISTO"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">GLEASON1</span>
    <input class="prediction-form-input" type="text" id="GLEASON1" name="GLEASON1" placeholder="GLEASON1"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">NCILPOS</span>
    <input class="prediction-form-input" type="text" id="NCILPOS" name="NCILPOS" placeholder="NCILPOS"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">BILAT</span>
    <input class="prediction-form-input" type="text" id="BILAT" name="BILAT" placeholder="BILAT"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">PORCENT</span>
    <input class="prediction-form-input" type="text" id="PORCENT" name="PORCENT" placeholder="PORCENT"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">IPERIN</span>
    <input class="prediction-form-input" type="text" id="IPERIN" name="IPERIN" placeholder="IPERIN"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">ILINF</span>
    <input class="prediction-form-input" type="text" id="ILINF" name="ILINF" placeholder="ILINF"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">IVASCU</span>
    <input class="prediction-form-input" type="text" id="IVASCU" name="IVASCU" placeholder="IVASCU"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TNM1</span>
    <input class="prediction-form-input" type="text" id="TNM1" name="TNM1" placeholder="TNM1"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">HISTO2</span>
    <input class="prediction-form-input" type="text" id="HISTO2" name="HISTO2" placeholder="HISTO2"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">GLEASON2</span>
    <input class="prediction-form-input" type="text" id="GLEASON2" name="GLEASON2" placeholder="GLEASON2"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">BILAT2</span>
    <input class="prediction-form-input" type="text" id="BILAT2" name="BILAT2" placeholder="BILAT2"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">LOCALIZ</span>
    <input class="prediction-form-input" type="text" id="LOCALIZ" name="LOCALIZ" placeholder="LOCALIZ"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">MULTIFOC</span>
    <input class="prediction-form-input" type="text" id="MULTIFOC" name="MULTIFOC" placeholder="MULTIFOC"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">VOLUMEN</span>
    <input class="prediction-form-input" type="text" id="VOLUMEN" name="VOLUMEN" placeholder="VOLUMEN"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">EXTRACAP</span>
    <input class="prediction-form-input" type="text" id="EXTRACAP" name="EXTRACAP" placeholder="EXTRACAP"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">VVSS</span>
    <input class="prediction-form-input" type="text" id="VVSS" name="VVSS" placeholder="VVSS"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">IPERIN2</span>
    <input class="prediction-form-input" type="text" id="IPERIN2" name="IPERIN2" placeholder="IPERIN2"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">ILINF2</span>
    <input class="prediction-form-input" type="text" id="ILINF2" name="ILINF2" placeholder="ILINF2"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">IVASCU2</span>
    <input class="prediction-form-input" type="text" id="IVASCU2" name="IVASCU2" placeholder="IVASCU2"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">PINAG</span>
    <input class="prediction-form-input" type="text" id="PINAG" name="PINAG" placeholder="PINAG"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">MARGEN</span>
    <input class="prediction-form-input" type="text" id="MARGEN" name="MARGEN" placeholder="MARGEN"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TNM2</span>
    <input class="prediction-form-input" type="text" id="TNM2" name="TNM2" placeholder="TNM2"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">PSAPOS</span>
    <input class="prediction-form-input" type="text" id="PSAPOS" name="PSAPOS" placeholder="PSAPOS"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">RTPADYU</span>
    <input class="prediction-form-input" type="text" id="RTPADYU" name="RTPADYU" placeholder="RTPADYU"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">RTPMES</span>
    <input class="prediction-form-input" type="text" id="RTPMES" name="RTPMES" placeholder="RTPMES"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">RBQ</span>
    <input class="prediction-form-input" type="text" id="RBQ" name="RBQ" placeholder="RBQ"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TRBQ</span>
    <input class="prediction-form-input" type="text" id="TRBQ" name="TRBQ" placeholder="TRBQ"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TDUPLI</span>
    <input class="prediction-form-input" type="text" id="TDUPLI" name="TDUPLI" placeholder="TDUPLI"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">T1MTX</span>
    <input class="prediction-form-input" type="text" id="T1MTX" name="T1MTX" placeholder="T1MTX"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">FECHAFIN</span>
    <input class="prediction-form-input" type="text" id="FECHAFIN" name="FECHAFIN" placeholder="FECHAFIN"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">FALLEC</span>
    <input class="prediction-form-input" type="text" id="FALLEC" name="FALLEC" placeholder="FALLEC"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TSUPERV</span>
    <input class="prediction-form-input" type="text" id="TSUPERV" name="TSUPERV" placeholder="TSUPERV"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">PSAFIN</span>
    <input class="prediction-form-input" type="text" id="PSAFIN" name="PSAFIN" placeholder="PSAFIN"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">TSEGUI</span>
    <input class="prediction-form-input" type="text" id="TSEGUI" name="TSEGUI" placeholder="TSEGUI"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">CAPRA-S</span>
    <input class="prediction-form-input" type="text" id="CAPRA-S" name="CAPRA-S" placeholder="CAPRA-S"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">RA</span>
    <input class="prediction-form-input" type="text" id="RA" name="RA" placeholder="RA"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">PTEN</span>
    <input class="prediction-form-input" type="text" id="PTEN" name="PTEN" placeholder="PTEN"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">ERG</span>
    <input class="prediction-form-input" type="text" id="ERG" name="ERG" placeholder="ERG"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">KI-67</span>
    <input class="prediction-form-input" type="text" id="KI-67" name="KI-67" placeholder="KI-67"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">SPINK1</span>
    <input class="prediction-form-input" type="text" id="SPINK1" name="SPINK1" placeholder="SPINK1"">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text">C-MYC</span>
    <input class="prediction-form-input" type="text" id="C-MYC" name="C-MYC" placeholder="C-MYC"">
    </div>

    EOHTML;