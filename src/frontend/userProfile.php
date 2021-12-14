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
    </head>
    <body>
        <h1>Mis datos de perfil</h1>
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
            <input type="password" id="password" name="password" placeholder="Nueva contraseña" disabled><br><br>

            <label for="password_confirm">Confirmar contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmar contraseña" disabled><br><br>
        
            <input type="submit" value="Guardar cambios" disabled>
        </form>
            <button onclick="enableEditing()">Editar información</button>
        <br> 
        <!--
        <form action="requests/postDeleteUser.php" method="post" target="_self">
            <input type="submit" value="Eliminar cuenta">
        </form>
        !-->

        <?php

            if (isset($_GET["message"])){
                $message = $_GET["message"];
                echo "<p>$message</p>";
            
                unset($_GET["message"]);
            }

            if (isset($_GET["error"])){
                $error_array = explode(",", $_GET["error"]);
                
                foreach($error_array as $error){
                    echo "<p>$error</p>";
                }

                unset($_GET["error"]);
            }
        ?>
        
        <script>
            function enableEditing(){
                let input = document.getElementsByTagName('input');

                for (i = 0; i < input.length; i++){
                    input[i].disabled = !input[i].disabled;
                }
            }
        </script>
    </body>
</html>