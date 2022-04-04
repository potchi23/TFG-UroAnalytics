<?php
    include_once("../requests/HttpRequests.php");
    require_once("../config/config.php");
    include_once("../models/User.php");
    
    //session_start();

    $NUM_ELEMENTS_BY_PAGE = 5;

    $user = $_SESSION["user"];

    $_SESSION["page"] = isset($_GET["page"]) ? $_GET["page"] : 1;
    
    if($_SESSION["page"] <= 0){
        $_SESSION["page"] = 1;
    }

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Pacientes</title>
        <link rel="stylesheet" href="../css/forms.css"/>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php include_once("../common/includes.php");?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/formUserProfile.css"/>
       

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </head>
    <body>
        <div class="header">
            <?php include_once("../common/header.php");?>
        </div>   

        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1 style="font-weight:600;">Pacientes</h1>
                    <hr class="my-8">

                    <?php
                        $http_requests = new HttpRequests();
                        $response = $http_requests->getResponse("$BACKEND_URL/numPatients", "GET", "", $user->get_token());
                        
                        $num_patients = 0;
                        if($response["status"] == 200) {                          
                            $numPatients = $response["data"]->num_patients;                        
                        }
                        $page = $_SESSION["page"];
                        
                        $get_req = array(
                            "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
                            "num_elems" => $NUM_ELEMENTS_BY_PAGE
                        );
                
                        $http_requests = new HttpRequests();
                        $response = $http_requests->getResponse("$BACKEND_URL/patients", "GET", $get_req, $user->get_token());
            
                        $data_array = $response["data"]->data;

                        if($response["status"] != 200) {
                            if($response["status"] == 401){
                                unset($_SESSION["user"]);
                                $_SESSION["message"] = "La sesión ha caducado";
                                header("Location: ../login.php");
                            }
                        }

                        if($num_patients > 0) 
                            echo "<h5>Número de pacientes: " . $num_patients . "</h5><br>";
                        else
                            echo "<h5>No hay pacientes en la base de datos</h5><br>";                                        
                    ?>

                    <div class="table-container m-auto">
                        <div class="table-responsive table-content">
                            <table class="table table-striped table-bordered table-hover table-light">
                                <?php                                    
                                    if (count($data_array) > 0) {
                                        echo <<< EOL
                                            <tr class="thead-dark">
                                            <th>N</th>
                                            <th>FECHACIR</th> 
                                            <th>EDAD</th> 
                                            <th>ETNIA</th> 
                                            <th>HTA</th>
                                            <th>DM</th>
                                            <th>TABACO</th>
                                            <th>HEREDA</th>
                                            <th>TACTOR</th>
                                            <th>PSAPRE</th>
                                            <th>PSALT</th>
                                            <th>TDUPPRE</th>
                                            <th>ECOTR</th>
                                            <th>NBIOPSIA</th>
                                            <th>HISTO</th>
                                            <th>GLEASON1</th>
                                            <th>NCILPOS</th>
                                            <th>BILAT</th>
                                            <th>PORCENT</th>
                                            <th>IPERIN</th>
                                            <th>ILINF</th>
                                            <th>IVASCU</th>
                                            <th>TNM1</th>
                                            <th>HISTO2</th>
                                            <th>GLEASON2</th>
                                            <th>BILAT2</th>
                                            <th>LOCALIZ</th>
                                            <th>MULTIFOC</th>
                                            <th>VOLUMEN</th>
                                            <th>EXTRACAP</th>
                                            <th>VVSS</th>
                                            <th>IPERIN2</th>
                                            <th>ILINF2</th>
                                            <th>IVASCU2</th>
                                            <th>PINAG</th>
                                            <th>MARGEN</th>
                                            <th>TNM2</th>
                                            <th>PSAPOS</th>
                                            <th>RTPADYU</th>
                                            <th>RTPMES</th>
                                            <th>RBQ</th>
                                            <th>TRBQ</th>
                                            <th>TDUPLI</th>
                                            <th>TDUPLI</th>
                                            <th>T1MTX</th>
                                            <th>FECHAFIN</th>
                                            <th>t.seg</th>
                                            <th>FALLEC</th>
                                            <th>TSUPERV</th>
                                            <th>TSEGUI</th>
                                            <th>PSAFIN</th>
                                            <th>CAPRA S</th>
                                            <th>RA-NUCLEAR</th>
                                            <th>RA-ESTROMA</th>
                                            <th>PTEN</th>
                                            <th>ERG</th>
                                            <th>KI-67</th>
                                            <th>SPINK1</th>
                                            <th>C-MYC</th>
                                            <th>NOTAS</th>
                                            <th>IMC</th>
                                            <th>ASA</th>
                                            <th>GR</th>
                                            <th>PNV</th>
                                            <th>TQ</th>
                                            <th>TH</th>
                                            <th>NGG</th>
                                            <th>PGG</th>
                                            </tr>
                                        EOL;

                                        $numElems = count($data_array);

                                        foreach($data_array as $petition){
                                            echo <<<EOL
                                                <tr id="patients_$petition->N">
                                                <td> $petition->N </td>
                                                <td> $petition->FECHACIR </td>
                                                <td> $petition->EDAD </td>
                                                <td> $petition->ETNIA </td>
                                                <td> $petition->HTA </td>
                                                <td> $petition->DM </td>
                                                <td> $petition->TABACO </td>
                                                <td> $petition->HEREDA </td>
                                                <td> $petition->TACTOR </td>
                                                <td> $petition->PSAPRE </td>
                                                <td> $petition->PSALT </td>
                                                <td> $petition->TDUPPRE </td>
                                                <td> $petition->ECOTR </td>
                                                <td> $petition->NBIOPSIA </td>
                                                <td> $petition->HISTO </td>
                                                <td> $petition->GLEASON1 </td>
                                                <td> $petition->NCILPOS </td>
                                                <td> $petition->BILAT </td>
                                                <td> $petition->PORCENT </td>
                                                <td> $petition->IPERIN </td>
                                                <td> $petition->ILINF </td>
                                                <td> $petition->IVASCU </td>
                                                <td> $petition->TNM1 </td>
                                                <td> $petition->HISTO2 </td>
                                                <td> $petition->GLEASON2 </td>
                                                <td> $petition->BILAT2 </td>
                                                <td> $petition->LOCALIZ </td>
                                                <td> $petition->MULTIFOC </td>
                                                <td> $petition->VOLUMEN </td>
                                                <td> $petition->EXTRACAP </td>
                                                <td> $petition->VVSS </td>
                                                <td> $petition->IPERIN2 </td>
                                                <td> $petition->ILINF2 </td>
                                                <td> $petition->IVASCU2 </td>
                                                <td> $petition->PINAG </td>
                                                <td> $petition->MARGEN </td>
                                                <td> $petition->TNM2 </td>
                                                <td> $petition->PSAPOS </td>
                                                <td> $petition->RTPADYU </td>
                                                <td> $petition->RTPMES </td>
                                                <td> $petition->RBQ </td>
                                                <td> $petition->TRBQ </td>
                                                <td> $petition->TDUPLI </td>
                                                <td> $petition->TDUPLI </td>
                                                <td> $petition->T1MTX </td>
                                                <td> $petition->FECHAFIN </td>
                                                <td> $petition->t_seg </td>
                                                <td> $petition->FALLEC </td>
                                                <td> $petition->TSUPERV </td>
                                                <td> $petition->TSEGUI </td>
                                                <td> $petition->PSAFIN </td>
                                                <td> $petition->CAPRA </td>
                                                <td> $petition->RA_nuclear </td>
                                                <td> $petition->RA_estroma </td>
                                                <td> $petition->PTEN </td>
                                                <td> $petition->ERG </td>
                                                <td> $petition->KI </td>
                                                <td> $petition->SPINK1 </td>
                                                <td> $petition->C_MYC </td>
                                                <td> $petition->NOTAS </td>
                                                <td> $petition->IMC </td>
                                                <td> $petition->ASA </td>
                                                <td> $petition->GR </td>
                                                <td> $petition->PNV </td>
                                                <td> $petition->TQ </td>
                                                <td> $petition->TH </td>
                                                <td> $petition->NGG </td>
                                                <td> $petition->PGG </td>
                                                </tr>
                                            EOL;
                                        }

                                        $empty_rows = $NUM_ELEMENTS_BY_PAGE - $numElems;
                                        
                                        for ($i = 0; $i < $empty_rows; $i++){
                                            echo "<tr>";
                                            for ($j = 0; $j < count((array)$data_array[0]) + 1; $j++){
                                                echo "<td><div style='margin-bottom:2.38rem;'></div></td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    else{
                                        echo "<h3>No existen pacientes en la base de datos</h3>";
                                    }
                                ?>
                            </table>
                            
                            <div class="page-buttons">
                                <?php
                                if(count($data_array) > 0){
                                    echo "<div>";
                                    if($_SESSION["page"] != 1 && count($data_array) > 0){
                                        $prev_page = $_SESSION["page"] - 1;    
                                        echo "<a class='btn btn-primary previous' href='viewPatient.php?page=$prev_page'><</a>";
                                    }                                    
                                    echo "</div>";
                                    
                                    $numPages = ceil($response["data"]->num_entries[0]/$NUM_ELEMENTS_BY_PAGE);
                                    echo "<div style='background-color:#e9ecef; border-color:#e9ecef' class='btn btn-warning'>$page/$numPages</div>";

                                    echo "<div>";
                                    if ($get_req["offset"] + $NUM_ELEMENTS_BY_PAGE < $response["data"]->num_entries[0] && count($data_array) > 0){
                                        $next_page = $_SESSION["page"] + 1;    
                                        echo "<a class='btn btn-primary next' href='viewPatient.php?page=$next_page'>></a>"; 
                                    }
                                    else{
                                        echo "<div style='background-color:#e9ecef; border-color:#e9ecef;'class='btn btn-primary previous'>></div>";      
                                    }
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>