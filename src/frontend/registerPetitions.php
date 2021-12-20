<?php
    include_once("models/User.php");
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </head>
    <body>
        <h1>Solicitudes de registro</h1>

        <table id="register_petitions" border="1">
            <?php
            $ch = curl_init();

            // Enviamos token al servidor
            $token = $user->get_token();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-access-token: $token"));

            curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/register_petitions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $response_array = json_decode($response)->data;

            if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) != 200) {
                header("Location: login.php");
            }

            if (count($response_array) > 0){
                echo <<< EOL
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido 1</th>
                        <th>Apellido 2</th>
                        <th>Email</th>
                        <th>Aceptar</th>
                    </tr>
                EOL;
                foreach($response_array as $petition){

                    echo <<<EOL
                        <tr id="register_petition_$petition->id">
                            <td> $petition->id </td>
                            <td> $petition->name </td>
                            <td> $petition->surname_1 </td>
                            <td> $petition->surname_2 </td>
                            <td> $petition->email </td>
                            <td>
                                <form action="requests/patchAcceptRegisterPetition.php" method="POST">
                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                    <input type="submit" value="✔"></input>
                                </form>
                                <form action="requests/deleteRejectRegisterPetition.php" method="POST">
                                    <input type="hidden" id="id" name="id" value="$petition->id"></input>
                                    <input type="submit" value="✘"></input>
                                </form>
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
    </body>
</html>