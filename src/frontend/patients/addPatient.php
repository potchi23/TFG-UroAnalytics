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
                        <div class='col-md-auto'>    
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="FECHACIR">FECHACIR</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="date" id="FECHACIR" name="FECHACIR" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="EDAD">EDAD</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="EDAD" name="EDAD" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="ETNIA">ETNIA</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="ETNIA" name="ETNIA" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="OBESO">OBESO</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="OBESO" name="OBESO" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="HTA">HTA</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="HTA" name="HTA" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="DM">DM</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="DM" name="DM" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TABACO">TABACO</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TABACO" name="TABACO" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="HEREDA">HEREDA</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="HEREDA" name="HEREDA" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TACTOR">TACTOR</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TACTOR" name="TACTOR" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PSAPRE">PSAPRE</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PSAPRE" name="PSAPRE" step="any"><br><br>
                                </div>  
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PSALT">PSALT</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PSALT" name="PSALT" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TDUPPRE">TDUPPRE</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TDUPPRE" name="TDUPPRE" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="ECOTR">ECOTR</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="ECOTR" name="ECOTR" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="NBIOPSIA">NBIOPSIA</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="NBIOPSIA" name="NBIOPSIA" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="HISTO">HISTO</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="HISTO" name="HISTO" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="GLEASON1">GLEASON1</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="GLEASON1" name="GLEASON1" ><br><br>
                                </div>                          
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="NCILPOS">NCILPOS</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="NCILPOS" name="NCILPOS" ><br><br>
                                </div>    
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="BILAT">BILAT</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="BILAT" name="BILAT" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PORCENT">PORCENT</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PORCENT" name="PORCENT" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="IPERIN">IPERIN</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="IPERIN" name="IPERIN" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="ILINF">ILINF</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="ILINF" name="ILINF" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="IVASCU">IVASCU</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="IVASCU" name="IVASCU" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TNM1">TNM1</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TNM1" name="TNM1" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="HISTO2">HISTO2</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="HISTO2" name="HISTO2" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="GLEASON2">GLEASON2</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="GLEASON2" name="GLEASON2" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="BILAT2">BILAT2</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="BILAT2" name="BILAT2" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="LOCALIZ">LOCALIZ</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="LOCALIZ" name="LOCALIZ" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="MULTIFOC">MULTIFOC</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="MULTIFOC" name="MULTIFOC" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="VOLUMEN">VOLUMEN</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="VOLUMEN" name="VOLUMEN" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="EXTRACAP">EXTRACAP</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="EXTRACAP" name="EXTRACAP" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="VVSS">VVSS</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="VVSS" name="VVSS" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="IPERIN2">IPERIN2</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="IPERIN2" name="IPERIN2" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="ILINF2">ILINF2</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="ILINF2" name="ILINF2" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="IVASCU2">IVASCU2</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="IVASCU2" name="IVASCU2" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PINAG">PINAG</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PINAG" name="PINAG" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="MARGEN">MARGEN</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="MARGEN" name="MARGEN" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TNM2">TNM2</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TNM2" name="TNM2" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PSAPOS">PSAPOS</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PSAPOS" name="PSAPOS" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="RTPADYU">RTPADYU</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="RTPADYU" name="RTPADYU" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="RTPMES">RTPMES</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="RTPMES" name="RTPMES" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="RBQ">RBQ</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="RBQ" name="RBQ" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TRBQ">TRBQ</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TRBQ" name="TRBQ" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="T1MTX">T1MTX</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="T1MTX" name="T1MTX" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="FECHAFIN">FECHAFIN</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="date" id="FECHAFIN" name="FECHAFIN" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="t_seg">t_seg</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="t_seg" name="t_seg" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="FALLEC">FALLEC</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="FALLEC" name="FALLEC" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TSUPERV">TSUPERV</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TSUPERV" name="TSUPERV" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TSEGUI">TSEGUI</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TSEGUI" name="TSEGUI" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PSAFIN">PSAFIN</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PSAFIN" name="PSAFIN" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="CAPRA-S">CAPRA-S</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="CAPRA-S" name="CAPRA-S" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="RA-NUCLEAR">RA-NUCLEAR</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="RA-NUCLEAR" name="RA-NUCLEAR" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="RA-ESTROMA">RA-ESTROMA</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="RA-ESTROMA" name="RA-ESTROMA" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PTEN">PTEN</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PTEN" name="PTEN" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="ERG">ERG</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="ERG" name="ERG" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="KI-67">KI-67</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="KI-67" name="KI-67" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="SPINK1">SPINK1</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="SPINK1" name="SPINK1" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="C-MYC">C-MYC</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="C-MYC" name="C-MYC" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="NOTAS">NOTAS</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="text" id="NOTAS" name="NOTAS" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="IMC">IMC</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="IMC" name="IMC" step="any"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="ASA">ASA</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="ASA" name="ASA" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="GR">GR</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="GR" name="GR" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PNV">PNV</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PNV" name="PNV" ><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="TH">TH</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="TH" name="TH" ><br><br>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class='col-md-auto' style="width: 8em">
                                    <label for="PGG">PGG</label>
                                </div>
                                <div class='col-md-auto'>
                                    <input type="number" id="PGG" name="PGG" step="any"><br><br>
                                </div>    
                            </div>
                        </div>
                            <input class="submit btn btn-success" type="submit" value="Añadir">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>