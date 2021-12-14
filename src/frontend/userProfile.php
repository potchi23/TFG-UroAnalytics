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
        <form action="requests/postEditUserProfile.php" method="post" target="_self">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" placeholder="Nombre" value="<?php echo $name?>"><br><br>

            <label for="surname_1">Apellido 1:</label>
            <input type="text" id="surname_1" name="surname_1" placeholder="Apellido 1" value="<?php echo $surname_1?>"><br><br>

            <label for="surname_2">Apellido 2:</label>
            <input type="text" id="surname_2" name="surname_2" placeholder="Apellido 2" value="<?php echo $surname_2?>"><br><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email?>"><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Contraseña" value="password" ><br><br>

            <label for="password_confirm">Confirmar contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmar contraseña" value="password" ><br><br>
        
            <input type="submit" value="Guardar cambios">
        </form>
        <br> 
        <!--
        <form action="requests/postDeleteUser.php" method="post" target="_self">
            <input type="submit" value="Eliminar cuenta">
        </form>
        !-->

        <?php
            if (isset($_GET["error"])){
                $error_array = explode(",", $_GET["error"]);
                
                foreach($error_array as $error){
                    echo "<p>$error</p>";
                }

                unset($_GET["error"]);
            }
        ?>
        
    </body>
</html>