<?php
    require_once("models/User.php");
    require_once("requests/HttpRequests.php");
    require_once("config/config.php");
    
    session_start();

    $NUM_ELEMENTS_BY_PAGE = 5;

    $user = $_SESSION["user"];

    $_SESSION["page"] = isset($_GET["page"]) ? $_GET["page"] : 1;
    
    if($_SESSION["page"] <= 0){
        $_SESSION["page"] = 1;
    }

    if (!isset($_SESSION["user"]) || !$user->is_admin()){
        header("Location: /index.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Solicitudes de registro</title>
        <link rel="stylesheet" href="css/forms.css"/>
        <link rel="stylesheet" href="css/registerPetitions.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/formUserProfile.css"/>
        <link rel="stylesheet" href="css/header.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </head>
    <body>
        <div class="header">
            <?php require("common/header.php");?>
        </div>   

        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1 style="font-weight:600;">Solicitudes de registro</h1>
                    <hr class="my-8">

                    <?php
                        $page = $_SESSION["page"];
                        
                        $get_req = array(
                            "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
                            "num_elems" => $NUM_ELEMENTS_BY_PAGE
                        );
                
                        $http_requests = new HttpRequests();
                        $response = $http_requests->getResponse("$BACKEND_URL/register_petitions", "GET", $get_req, $user->get_token());
                        
                        if($response["status"] != 200) {
                            if($response["status"] == 401){
                                unset($_SESSION["user"]);
                                echo "<script>alert('La sesión ha caducado. Vuelva a iniciar sesión.');</script>";                                
                                $_SESSION["message"] = "La sesión ha caducado";
                                echo "<script type='text/javascript'>window.location.href = '../login.php';</script>";
                            }
                        }

                        $data_array = $response["data"]->data;
                        $num_petitions = $response["data"]->num_entries;

                        if($num_petitions > 0) 
                            echo "<h5>Número de solicitudes: " . $num_petitions . "</h5><br>";
                        else
                            echo "<h5>No hay solicitudes de registro</h5><br>";                                        
                    ?>

                    <div class="table-container m-auto">
                        <div class="table-responsive table-content">
                            <table class="table table-striped table-bordered table-hover table-light">
                                <?php                                    
                                    if (count($data_array) > 0) {
                                        echo <<< EOL
                                            <tr class="thead-dark">
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Apellido 1</th>
                                                <th>Apellido 2</th>
                                                <th>Email</th>
                                                <th>Aceptar</th>
                                            </tr>
                                        EOL;

                                        $numElems = count($data_array);

                                        foreach($data_array as $petition){
                                            echo <<<EOL
                                                <tr id="register_petition_$petition->id">
                                                    <td> $petition->id </td>
                                                    <td> $petition->name </td>
                                                    <td> $petition->surname_1 </td>
                                                    <td> $petition->surname_2 </td>
                                                    <td> $petition->email </td>
                                                    <td class="buttons-row">
                                                        <div class="buttons-container">
                                                            <div class="req-btn p-6">
                                                                <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#modal01-$petition->id">
                                                                    <input class="btn btn-outline-success" type="submit" value="✔" style="padding:10px 30px 28px 10px;"></input>
                                                                </button>
                                                                <div class="modal fade" id="modal01-$petition->id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel01" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="staticBackdropLabel01">Aceptar solicitud</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>¿Aceptar solicitud de $petition->name $petition->surname_1 $petition->surname_2 ($petition->email)?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                                <form action="requests/patchAcceptRegisterPetition.php?page=$page&numElems=$numElems" method="POST">
                                                                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                                                                    <button type="submit" class="btn btn-danger">Aceptar</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="req-btn p-6">
                                                                <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#modal02-$petition->id">
                                                                    <input class="btn btn-outline-danger" type="submit" value="✘" style="padding:10px 28px 28px 10px;"></input>
                                                                </button>
                                                                <div class="modal fade" id="modal02-$petition->id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel02" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="staticBackdropLabel02">Denegar solicitud</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>¿Denegar solicitud de $petition->name $petition->surname_1 $petition->surname_2 ($petition->email)?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                                <form action="requests/deleteRejectRegisterPetition.php?page=$page&numElems=$numElems" method="POST">
                                                                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                                                                    <button type="submit" class="btn btn-danger">Denegar</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
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
                                        echo "<h3>No hay solicitudes de registro</h3>";
                                    }
                                ?>
                            </table>
                            
                            <div class="page-buttons">
                                <?php
                                if(count($data_array) > 0){
                                    echo "<div>";
                                    if($_SESSION["page"] != 1 && count($data_array) > 0){
                                        $prev_page = $_SESSION["page"] - 1;    
                                        echo "<a class='btn btn-primary previous' href='registerPetitions.php?page=$prev_page'><</a>";      
                                    }                                    
                                    echo "</div>";
                                    
                                    $numPages = ceil($response["data"]->num_entries/$NUM_ELEMENTS_BY_PAGE);
                                    echo "<div style='background-color:#e9ecef; border-color:#e9ecef' class='btn btn-warning'>$page/$numPages</div>";

                                    echo "<div>";
                                    if ($get_req["offset"] + $NUM_ELEMENTS_BY_PAGE < $response["data"]->num_entries && count($data_array) > 0){
                                        $next_page = $_SESSION["page"] + 1;    
                                        echo "<a class='btn btn-primary next' href='registerPetitions.php?page=$next_page'>></a>"; 
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
        <div style="margin-bottom:5%;"></div>
        <footer class="bg-light text-center text-lg-start">
            <?php require("common/footer.php")?>
        </footer>  
    </body>
</html>