<?php
    include_once("models/Paciente.php");
    session_start();

    $user = $_SESSION["user"]; //cambiar esto para que sea el paciente

    if (!isset($_SESSION["user"])){
        header("Location: /index.php");
    }

    $id = $user->get_id();
    $name = $user->get_name();
    $surname_1 = $user->get_surname_1();
    $surname_2 = $user->get_surname_2();
    $email = $user->get_email();
    $telefono = $usaer->get_telefono();
    $patologia = $user->get_patologia();
    //meter los campos que sean
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar paciente</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/forms.css"/>
        <meta charset="utf-8">
    </head>
    <body>
        <?php include_once("header/navbar.php");?>
        <div class="container">
            <div class="form-container">
                <h1 class="form-title">Editar paciente</h1>
                <div class="form-content">
                <form action="requests/patchEditarPaciente.php" method="post" target="_self">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" placeholder="Nombre" value="<?php echo $name?>" disabled><br><br>

                    <label for="surname_1">Apellido 1:</label>
                    <input type="text" id="surname_1" name="surname_1" placeholder="Apellido 1" value="<?php echo $surname_1?>" disabled><br><br>

                    <label for="surname_2">Apellido 2:</label>
                    <input type="text" id="surname_2" name="surname_2" placeholder="Apellido 2" value="<?php echo $surname_2?>" disabled><br><br>

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email?>" disabled><br><br>

                    <label for="email">Telefono:</label>
                    <input type="text" id="telefono" name="telefono" placeholder="telefono" value="<?php echo $telefono?>" disabled><br><br>

                    <label for="password">Patologia:</label>
                    <input type="text" id="patologia" name="patologia" placeholder="patologia" value="<?php echo $patologia?>" disabled><br><br>
                
                    <input type="submit" value="Guardar cambios" disabled>
                </form>
                <form action="requests/postEditarPaciente.php" method="post" target="_self">
                    <input type="submit" value="Editar paciente">
                </form>
                
                </div>
                

                <?php

                    if (isset($_SESSION["message"])){
                        $message = $_SESSION["message"];
                        echo "<p></p><p class='alert alert-success'>$message</p>";
                    
                        unset($_SESSION["message"]);
                    }

                    if (isset($_SESSION["error"]) && count($_SESSION["error"]) > 0){
                        echo"</p><div class='alert alert-danger'>";
                        foreach($_SESSION["error"] as $error){
                            echo "<div>$error</div>";
                        }
                        echo"</div>";
                        unset($_SESSION["error"]);
                    }
                ?>
            </div>
        </div>
        <script>
            function enableEditing(){
                let input = document.getElementsByTagName('input');

                for (i = 0; i < input.length - 1; i++) {
                    input[i].disabled = !input[i].disabled;
                }
            }
        </script>
    </body>
</html>