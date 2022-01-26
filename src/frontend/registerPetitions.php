<?php
    include_once("models/User.php");
    include_once("requests/HttpRequests.php");

    session_start();
    
    $user = $_SESSION["user"];

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
            <h1>Solicitudes de registro</h1>

            <div class="table-responsive table-content">
                <table class="table table-striped table-hover" id="register_petitions" border="1">
                    <?php
                    // Enviamos token al servidor
                    $token = $user->get_token();

                    $http_requests = new HttpRequests();
                    $response = $http_requests->getResponse("http://localhost:5000/register_petitions", "GET", "", $token);
        
                    $data_array = $response["data"]->data;

                    if($response["status"] != 200) {
                        header("Location: login.php");
                    }

                    if (count($data_array) > 0){
                        echo <<< EOL
                            <tr class="table-active">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido 1</th>
                                <th>Apellido 2</th>
                                <th>Email</th>
                                <th>Aceptar</th>
                            </tr>
                        EOL;
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
                                                <form action="requests/patchAcceptRegisterPetition.php" method="POST">
                                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                                    <input class="btn btn-success" type="submit" value="✔"></input>
                                                </form>
                                            </div>
                                            <div class="req-btn">
                                                <form action="requests/deleteRejectRegisterPetition.php" method="POST">
                                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                                    <input class="btn btn-danger" type="submit" value="✘"></input>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            EOL;
                        }
                    }
                    else{
                        echo "<h3>No hay solicitudes de registro</h3>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>