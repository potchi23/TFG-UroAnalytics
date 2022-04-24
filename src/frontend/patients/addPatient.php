<?php
    include_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");

    session_start();

    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Añadir un paciente</title>
        <?php include_once("../common/includes.php");?>
    </head>
    <body>
        <div class="header">
            <?php include_once("../common/header.php");?>
        </div> 
        <div class="sidebar-container">
            <?php include_once("sidebarPatients.php");?>
        </div>  
        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1 style="font-weight:600;">Añadir un paciente</h1>
                    <br><br>
                    <div class="form-content">
                        <form action="../requests/postAddPatientRequest.php" method="post" target="_self">
                            
                            <label for="FECHACIR">FECHACIR</label>
                            <input type="date" id="FECHACIR" name="FECHACIR" ><br><br>

                            <label for="EDAD">EDAD</label>
                            <input type="number" id="EDAD" name="EDAD" ><br><br>

                            <label for="ETNIA">ETNIA</label>
                            <input type="number" id="ETNIA" name="ETNIA" ><br><br>

                            <label for="OBESO">OBESO</label>
                            <input type="number" id="OBESO" name="OBESO" ><br><br>

                            <label for="HTA">HTA</label>
                            <input type="number" id="HTA" name="HTA" ><br><br>

                            <label for="DM">DM</label>
                            <input type="number" id="DM" name="DM" ><br><br>

                            <label for="TABACO">TABACO</label>
                            <input type="number" id="TABACO" name="TABACO" ><br><br>

                            <label for="HEREDA">HEREDA</label>
                            <input type="number" id="HEREDA" name="HEREDA" ><br><br>

                            <label for="TACTOR">TACTOR</label>
                            <input type="number" id="TACTOR" name="TACTOR" ><br><br>

                            <label for="PSAPRE">PSAPRE</label>
                            <input type="number" id="PSAPRE" name="PSAPRE" step="any"><br><br>

                            <label for="PSALT">PSALT</label>
                            <input type="number" id="PSALT" name="PSALT" step="any"><br><br>

                            <label for="TDUPPRE">TDUPPRE</label>
                            <input type="number" id="TDUPPRE" name="TDUPPRE" step="any"><br><br>

                            <label for="ECOTR">ECOTR</label>
                            <input type="number" id="ECOTR" name="ECOTR" ><br><br>

                            <label for="NBIOPSIA">NBIOPSIA</label>
                            <input type="number" id="NBIOPSIA" name="NBIOPSIA" ><br><br>

                            <label for="HISTO">HISTO</label>
                            <input type="number" id="HISTO" name="HISTO" ><br><br>

                            <label for="GLEASON1">GLEASON1</label>
                            <input type="number" id="GLEASON1" name="GLEASON1" ><br><br>

                            <label for="NCILPOS">NCILPOS</label>
                            <input type="number" id="NCILPOS" name="NCILPOS" ><br><br>

                            <label for="BILAT">BILAT</label>
                            <input type="number" id="BILAT" name="BILAT" step="any"><br><br>

                            <label for="PORCENT">PORCENT</label>
                            <input type="number" id="PORCENT" name="PORCENT" step="any"><br><br>

                            <label for="IPERIN">IPERIN</label>
                            <input type="number" id="IPERIN" name="IPERIN" ><br><br>

                            <label for="ILINF">ILINF</label>
                            <input type="number" id="ILINF" name="ILINF" ><br><br>

                            <label for="IVASCU">IVASCU</label>
                            <input type="number" id="IVASCU" name="IVASCU" ><br><br>

                            <label for="TNM1">TNM1</label>
                            <input type="number" id="TNM1" name="TNM1" ><br><br>

                            <label for="HISTO2">HISTO2</label>
                            <input type="number" id="HISTO2" name="HISTO2" ><br><br>

                            <label for="GLEASON2">GLEASON2</label>
                            <input type="number" id="GLEASON2" name="GLEASON2" ><br><br>

                            <label for="BILAT2">BILAT2</label>
                            <input type="number" id="BILAT2" name="BILAT2" ><br><br>

                            <label for="LOCALIZ">LOCALIZ</label>
                            <input type="number" id="LOCALIZ" name="LOCALIZ" ><br><br>

                            <label for="MULTIFOC">MULTIFOC</label>
                            <input type="number" id="MULTIFOC" name="MULTIFOC" ><br><br>

                            <label for="VOLUMEN">VOLUMEN</label>
                            <input type="number" id="VOLUMEN" name="VOLUMEN" step="any"><br><br>

                            <label for="EXTRACAP">EXTRACAP</label>
                            <input type="number" id="EXTRACAP" name="EXTRACAP" ><br><br>

                            <label for="VVSS">VVSS</label>
                            <input type="number" id="VVSS" name="VVSS" ><br><br>

                            <label for="IPERIN2">IPERIN2</label>
                            <input type="number" id="IPERIN2" name="IPERIN2" ><br><br>

                            <label for="ILINF2">ILINF2</label>
                            <input type="number" id="ILINF2" name="ILINF2" ><br><br>

                            <label for="IVASCU2">IVASCU2</label>
                            <input type="number" id="IVASCU2" name="IVASCU2" ><br><br>

                            <label for="PINAG">PINAG</label>
                            <input type="number" id="PINAG" name="PINAG" ><br><br>

                            <label for="MARGEN">MARGEN</label>
                            <input type="number" id="MARGEN" name="MARGEN" ><br><br>

                            <label for="TNM2">TNM2</label>
                            <input type="number" id="TNM2" name="TNM2" ><br><br>

                            <label for="PSAPOS">PSAPOS</label>
                            <input type="number" id="PSAPOS" name="PSAPOS" step="any"><br><br>

                            <label for="RTPADYU">RTPADYU</label>
                            <input type="number" id="RTPADYU" name="RTPADYU" ><br><br>

                            <label for="RTPMES">RTPMES</label>
                            <input type="number" id="RTPMES" name="RTPMES" step="any"><br><br>

                            <label for="RBQ">RBQ</label>
                            <input type="number" id="RBQ" name="RBQ" ><br><br>

                            <label for="TRBQ">TRBQ</label>
                            <input type="number" id="TRBQ" name="TRBQ" step="any"><br><br>

                            <label for="T1MTX">T1MTX</label>
                            <input type="number" id="T1MTX" name="T1MTX" step="any"><br><br>

                            <label for="FECHAFIN">FECHAFIN</label>
                            <input type="date" id="FECHAFIN" name="FECHAFIN" ><br><br>

                            <label for="t_seg">t_seg</label>
                            <input type="number" id="t_seg" name="t_seg" step="any"><br><br>

                            <label for="FALLEC">FALLEC</label>
                            <input type="number" id="FALLEC" name="FALLEC" step="any"><br><br>

                            <label for="TSUPERV">TSUPERV</label>
                            <input type="number" id="TSUPERV" name="TSUPERV" step="any"><br><br>

                            <label for="TSEGUI">TSEGUI</label>
                            <input type="number" id="TSEGUI" name="TSEGUI" step="any"><br><br>

                            <label for="PSAFIN">PSAFIN</label>
                            <input type="number" id="PSAFIN" name="PSAFIN" step="any"><br><br>

                            <label for="CAPRA-S">CAPRA-S</label>
                            <input type="number" id="CAPRA-S" name="CAPRA-S" ><br><br>

                            <label for="RA-NUCLEAR">RA-NUCLEAR</label>
                            <input type="number" id="RA-NUCLEAR" name="RA-NUCLEAR" step="any"><br><br>

                            <label for="RA-ESTROMA">RA-ESTROMA</label>
                            <input type="number" id="RA-ESTROMA" name="RA-ESTROMA" step="any"><br><br>

                            <label for="PTEN">PTEN</label>
                            <input type="number" id="PTEN" name="PTEN" step="any"><br><br>

                            <label for="ERG">ERG</label>
                            <input type="number" id="ERG" name="ERG" step="any"><br><br>

                            <label for="KI-67">KI-67</label>
                            <input type="number" id="KI-67" name="KI-67" step="any"><br><br>

                            <label for="SPINK1">SPINK1</label>
                            <input type="number" id="SPINK1" name="SPINK1" step="any"><br><br>

                            <label for="C-MYC">C-MYC</label>
                            <input type="number" id="C-MYC" name="C-MYC" step="any"><br><br>

                            <label for="NOTAS">NOTAS</label>
                            <input type="text" id="NOTAS" name="NOTAS" ><br><br>

                            <label for="IMC">IMC</label>
                            <input type="number" id="IMC" name="IMC" step="any"><br><br>

                            <label for="ASA">ASA</label>
                            <input type="number" id="ASA" name="ASA" ><br><br>

                            <label for="GR">GR</label>
                            <input type="number" id="GR" name="GR" ><br><br>

                            <label for="PNV">PNV</label>
                            <input type="number" id="PNV" name="PNV" ><br><br>

                            <label for="TH">TH</label>
                            <input type="number" id="TH" name="TH" ><br><br>

                            <label for="PGG">PGG</label>
                            <input type="number" id="PGG" name="PGG" step="any"><br><br>

                            <input class="submit btn btn-success" type="submit" value="Añadir">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>