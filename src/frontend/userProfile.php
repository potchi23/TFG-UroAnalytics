<?php
    include_once("models/User.php");
    session_start();

    $user = $_SESSION["user"];

    if (!isset($_SESSION["user"])){
        header("Location: /index.php");
    }

    $id = $user->get_id();
    $name = $user->get_name();
    $surname_1 = $user->get_surname_1();
    $surname_2 = $user->get_surname_2();
    $email = $user->get_email();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mis datos de perfil</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/forms.css"/>
        <meta charset="utf-8">
    </head>
    <body>
        <?php include_once("common/header.php");?>
        <div class="container">
            <div class="form-container">
                <h1 class="form-title">Mis datos de perfil</h1>
                <div class="form-content">
                <form action="requests/patchEditUserProfile.php" method="post" target="_self">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" placeholder="Nombre" value="<?php echo $name?>" disabled><br><br>

                    <label for="surname_1">Apellido 1:</label>
                    <input type="text" id="surname_1" name="surname_1" placeholder="Apellido 1" value="<?php echo $surname_1?>" disabled><br><br>

                    <label for="surname_2">Apellido 2:</label>
                    <input type="text" id="surname_2" name="surname_2" placeholder="Apellido 2" value="<?php echo $surname_2?>" disabled><br><br>

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email?>" disabled><br><br>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Nueva contraseña (opcional)" disabled><br><br>

                    <label for="password_confirm">Confirmar contraseña:</label>
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmar contraseña" disabled><br><br>
                
                    <input type="submit" value="Guardar cambios" disabled>
                </form>
                <form action="requests/postDeleteUser.php" method="post" target="_self">
                    <input type="submit" value="Eliminar cuenta">
                </form>
                
                </div>
                <button class="btn btn-primary" onclick="enableEditing()">Editar información</button>

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