<?php
    include_once("models/User.php");
    include_once("requests/HttpRequests.php");

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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/forms.css"/>
        <link rel="stylesheet" href="css/registerPetitions.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </head>
    <body>
        <div class="table-container">
            <h1 class="table-title">Solicitudes de registro</h1>

            <div class="table-responsive table-content">
                <table class="table table-striped table-bordered table-hover">
                    <?php
                    // Enviamos token al servidor
                    $token = $user->get_token();

                    $page = $_SESSION["page"];
                    
                    $get_req = array(
                        "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
                        "num_elems" => $NUM_ELEMENTS_BY_PAGE
                    );
            
                    $http_requests = new HttpRequests();
                    $response = $http_requests->getResponse("http://localhost:5000/register_petitions", "GET", $get_req, $token);
        
                    $data_array = $response["data"]->data;

                    if($response["status"] != 200) {
                        if($response["status"] == 401){
                            unset($_SESSION["user"]);
                            $message = urlencode("La sesión ha caducado");
                            header("Location: ../login.php?message=$message");
                        }
                    }

                    if (count($data_array) > 0){
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
                                            <div class="req-btn">
                                                <form action="requests/patchAcceptRegisterPetition.php?page=$page&numElems=$numElems" method="POST">
                                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                                    <input class="btn btn-outline-success" type="submit" value="✔"></input>
                                                </form>
                                            </div>
                                            <div class="req-btn">
                                                <form action="requests/deleteRejectRegisterPetition.php?page=$page&numElems=$numElems" method="POST">
                                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                                    <input class="btn btn-outline-danger" type="submit" value="✘"></input>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            EOL;
                        }
                    }
                    else{
                        echo "<h3>No hay más solicitudes de registro</h3>";
                    }
                    ?>
                </table>
                
                <div class="page-buttons">
                    <?php
                        echo "<div>";
                        if($_SESSION["page"] != 1){
                            $prev_page = $_SESSION["page"] - 1;    
                            echo "<a class='btn btn-primary previous' href='registerPetitions.php?page=$prev_page'><</a>";      
                        }
                        echo "</div>";
                        
                        echo "<div>";
                        if (count($data_array) >= $NUM_ELEMENTS_BY_PAGE){
                            $next_page = $_SESSION["page"] + 1;    
                            echo "<a class='btn btn-primary next' href='registerPetitions.php?page=$next_page'>></a>"; 
                        }
                        echo "</div>";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>