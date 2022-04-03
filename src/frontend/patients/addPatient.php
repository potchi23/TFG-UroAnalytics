<!DOCTYPE html>

<?php
    include_once("../request/HttpRequests.php");
    require_once("../config/config.php");
?>

<html>
    <head>
        <title>Añadir paciente</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/forms.css"/>
        <?php include_once("../common/includes.php");?>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="container">
            <div class="form-container">

                <h1 class="form-title">Añadir paciente</h1>

                <div class="form-content">
                    <form action="../requests/postRegistrarPaciente.php" method="post" target="_self">
                        
                        <label for="FECHACIR">FECHACIR</label>
                        <input type="text" id="FECHACIR" name="FECHACIR"><br><br>

                        <label for="EDAD">EDAD</label>
                        <input type="text" id="EDAD" name="EDAD"><br><br>

                        <label for="ETNIA">ETNIA</label>
                        <input type="text" id="ETNIA" name="ETNIA"><br><br>

                        <label for="HTA">HTA</label>
                        <input type="text" id="HTA" name="HTA"><br><br>

                        <label for="DM">DM</label>
                        <input type="text" id="DM" name="DM"><br><br>

                        <label for="TABACO">TABACO</label>
                        <input type="text" id="TABACO" name="TABACO"><br><br>

                        <label for="HEREDA">HEREDA</label>
                        <input type="text" id="HEREDA" name="HEREDA"><br><br>

                        <label for="TACTOR">TACTOR</label>
                        <input type="text" id="TACTOR" name="TACTOR"><br><br>

                        <label for="PSAPRE">PSAPRE</label>
                        <input type="text" id="PSAPRE" name="PSAPRE"><br><br>

                        <label for="PSALT">PSALT</label>
                        <input type="text" id="PSALT" name="PSALT"><br><br>

                        <label for="TDUPPRE">TDUPPRE</label>
                        <input type="text" id="TDUPPRE" name="TDUPPRE"><br><br>

                        <label for="ECOTR">ECOTR</label>
                        <input type="text" id="ECOTR" name="ECOTR"><br><br>

                        <label for="HISTO">HISTO</label>
                        <input type="text" id="HISTO" name="HISTO"><br><br>

                        <label for="GLEASON1">GLEASON1</label>
                        <input type="text" id="GLEASON1" name="GLEASON1"><br><br>

                        <label for="NCILPOS">NCILPOS</label>
                        <input type="text" id="NCILPOS" name="NCILPOS"><br><br>

                        <label for="BILAT">BILAT</label>
                        <input type="text" id="BILAT" name="BILAT"><br><br>

                        <label for="PORCENT">PORCENT</label>
                        <input type="text" id="PORCENT" name="PORCENT"><br><br>

                        <label for="IPERIN">IPERIN</label>
                        <input type="text" id="IPERIN" name="IPERIN"><br><br>

                        <label for="ILINF">ILINF</label>
                        <input type="text" id="ILINF" name="ILINF"><br><br>

                        <label for="IVASCU">IVASCU</label>
                        <input type="text" id="IVASCU" name="IVASCU"><br><br>

                        <label for="TNM1">TNM1</label>
                        <input type="text" id="TNM1" name="TNM1"><br><br>

                        <label for="HISTO2">HISTO2</label>
                        <input type="text" id="HISTO2" name="HISTO2"><br><br>

                        <label for="GLEASON2">GLEASON2</label>
                        <input type="text" id="GLEASON2" name="GLEASON2"><br><br>

                        <label for="BILAT2">BILAT2</label>
                        <input type="text" id="BILAT2" name="BILAT2"><br><br>

                        <label for="LOCALIZ">LOCALIZ</label>
                        <input type="text" id="LOCALIZ" name="LOCALIZ"><br><br>

                        <label for="MULTIFOC">MULTIFOC</label>
                        <input type="text" id="MULTIFOC" name="MULTIFOC"><br><br>

                        <label for="VOLUMEN">VOLUMEN</label>
                        <input type="text" id="VOLUMEN" name="VOLUMEN"><br><br>

                        <label for="EXTRACAP">EXTRACAP</label>
                        <input type="text" id="EXTRACAP" name="EXTRACAP"><br><br>

                        <label for="VVSS">VVSS</label>
                        <input type="text" id="VVSS" name="VVSS"><br><br>

                        <label for="IPERIN2">IPERIN2</label>
                        <input type="text" id="IPERIN2" name="IPERIN2"><br><br>

                        <label for="ILINF2">ILINF2</label>
                        <input type="text" id="ILINF2" name="ILINF2"><br><br>

                        <label for="IVASCU2">IVASCU2</label>
                        <input type="text" id="IVASCU2" name="IVASCU2"><br><br>

                        <label for="PINAG">PINAG</label>
                        <input type="text" id="PINAG" name="PINAG"><br><br>

                        <label for="MARGEN">MARGEN</label>
                        <input type="text" id="MARGEN" name="MARGEN"><br><br>

                        <label for="TNM2">TNM2</label>
                        <input type="text" id="TNM2" name="TNM2"><br><br>

                        <label for="PSAPOS">PSAPOS</label>
                        <input type="text" id="PSAPOS" name="PSAPOS"><br><br>

                        <label for="RTPADYU">RTPADYU</label>
                        <input type="text" id="RTPADYU" name="RTPADYU"><br><br>

                        <label for="RTPMES">RTPMES</label>
                        <input type="text" id="RTPMES" name="RTPMES"><br><br>

                        <label for="RBQ">RBQ</label>
                        <input type="text" id="RBQ" name="RBQ"><br><br>

                        <label for="TRBQ">TRBQ</label>
                        <input type="text" id="TRBQ" name="TRBQ"><br><br>

                        <label for="TDUPLI">TDUPLI</label>
                        <input type="text" id="TDUPLI" name="TDUPLI"><br><br>

                        <label for="TDUPLI.r1">TDUPLI.r1</label>
                        <input type="text" id="TDUPLI.r1" name="TDUPLI.r1"><br><br>

                        <label for="T1MTX">T1MTX</label>
                        <input type="text" id="T1MTX" name="T1MTX"><br><br>

                        <label for="FECHAFIN">FECHAFIN</label>
                        <input type="text" id="FECHAFIN" name="FECHAFIN"><br><br>

                        <label for="t.seg">t.seg</label>
                        <input type="text" id="t.seg" name="t.seg"><br><br>

                        <label for="FALLEC">FALLEC</label>
                        <input type="text" id="FALLEC" name="FALLEC"><br><br>

                        <label for="TSUPERV">TSUPERV</label>
                        <input type="text" id="TSUPERV" name="TSUPERV"><br><br>

                        <label for="TSEGUI">TSEGUI</label>
                        <input type="text" id="TSEGUI" name="TSEGUI"><br><br>

                        <label for="PSAFIN">PSAFIN</label>
                        <input type="text" id="PSAFIN" name="PSAFIN"><br><br>

                        <label for="CAPRA S">CAPRA S</label>
                        <input type="text" id="CAPRA S" name="CAPRA S"><br><br>

                        <label for="RA nuclear">RA nuclear</label>
                        <input type="text" id="RA nuclear" name="RA nuclear"><br><br>

                        <label for="RA estroma">RA estroma</label>
                        <input type="text" id="RA estroma" name="RA estroma"><br><br>

                        <label for="PTEN">PTEN</label>
                        <input type="text" id="PTEN" name="PTEN"><br><br>

                        <label for="ERG">ERG</label>
                        <input type="text" id="ERG" name="ERG"><br><br>

                        <label for="KI-67">KI-67</label>
                        <input type="text" id="KI-67" name="KI-67"><br><br>

                        <label for="SPINK1">SPINK1</label>
                        <input type="text" id="SPINK1" name="SPINK1"><br><br>

                        <label for="C-MYC">C-MYC</label>
                        <input type="text" id="C-MYC" name="C-MYC"><br><br>

                        <label for="NOTAS">NOTAS</label>
                        <input type="text" id="NOTAS" name="NOTAS"><br><br>

                        <label for="IMC">IMC</label>
                        <input type="text" id="IMC" name="IMC"><br><br>

                        <label for="ASA">ASA</label>
                        <input type="text" id="ASA" name="ASA"><br><br>

                        <label for="GR">GR</label>
                        <input type="text" id="GR" name="GR"><br><br>

                        <label for="PNV">PNV</label>
                        <input type="text" id="PNV" name="PNV"><br><br>

                        <label for="TQ">TQ</label>
                        <input type="text" id="TQ" name="TQ"><br><br>

                        <label for="TH">TH</label>
                        <input type="text" id="TH" name="TH"><br><br>

                        <label for="NGG">NGG</label>
                        <input type="text" id="NGG" name="NGG"><br><br>

                        <label for="PGG">PGG</label>
                        <input type="text" id="PGG" name="PGG"><br><br>

                        <input class="submit btn btn-success" type="submit" value="Añadir">
                    </form>
                </div>
             </div>

                <?php
                    if (isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo <<<EOL
                            <div class='alert alert-danger'>
                                <div>$error</div>
                            </div>
                        EOL;
                        unset($_SESSION["error"]);
                    }

                    if (isset($_SESSION["message"])){
                        $message = $_SESSION["message"];
                        echo <<<EOL
                            <div class='alert alert-info'>
                                <div>$message</div>
                            </div>
                        EOL;
                        unset($_SESSION["message"]);
                    }
                ?>
            </div>
        </div>
    </body>
</html>
