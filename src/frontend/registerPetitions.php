<?php
    include_once("models/User.php");
    include_once("requests/HttpRequests.php");
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/forms.css"/>
        <link rel="stylesheet" href="css/registerPetitions.css"/>
        <meta charset="utf-8">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </head>
    <body>
        <?php include_once("header/navbar.php");?>

        <div class="container">
            <div class="table-container">

                <div class="table-responsive table-content">
                    <h1 class="table-title">Solicitudes de registro</h1>

                    <table class="table table-striped table-bordered table-hover">
                        <?php
                        $page = $_SESSION["page"];
                        
                        $get_req = array(
                            "offset" => ($page - 1) * $NUM_ELEMENTS_BY_PAGE,
                            "num_elems" => $NUM_ELEMENTS_BY_PAGE
                        );
                
                        $http_requests = new HttpRequests();
                        $response = $http_requests->getResponse("$BACKEND_URL/register_petitions", "GET", $get_req, $user->get_token());
            
                        $data_array = $response["data"]->data;

                        if($response["status"] != 200) {
                            if($response["status"] == 401){
                                unset($_SESSION["user"]);
                                $_SESSION["message"] = "La sesión ha caducado";
                                header("Location: ../login.php");
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
                            else{
                                echo "<div style='background-color:white; border-color:white;'class='btn btn-primary previous'><</div>";      
                            }
                            echo "</div>";
                            
                            $numPages = ceil($response["data"]->num_entries[0]/$NUM_ELEMENTS_BY_PAGE);
                            echo "<div style='background-color:white; border-color:white' class='btn btn-warning'>$page/$numPages</div>";

                            echo "<div>";
                            if ($get_req["offset"] + $NUM_ELEMENTS_BY_PAGE < $response["data"]->num_entries[0] && count($data_array) > 0){
                                $next_page = $_SESSION["page"] + 1;    
                                echo "<a class='btn btn-primary next' href='registerPetitions.php?page=$next_page'>></a>"; 
                            }
                            else{
                                echo "<div style='background-color:white; border-color:white;'class='btn btn-primary previous'>></div>";      
                            }
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>