<?php
    session_start();
    
    if (isset($_SESSION["user"])){
        header("Location: /dashboard.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Solicitar registro</title>
    </head>
    <body>
        <h1>Solicitar registro</h1>
        <form action="requests/postRegister.php" method="post" target="_self">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" placeholder="Nombre"><br><br>

            <label for="surname_1">Apellido 1:</label>
            <input type="text" id="surname_1" name="surname_1" placeholder="Apellido 1"><br><br>

            <label for="surname_2">Apellido 2:</label>
            <input type="text" id="surname_2" name="surname_2" placeholder="Apellido 2"><br><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email"><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Contraseña"><br><br>

            <label for="password_confirm">Confirmar contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmar contraseña"><br><br>

            <input type="submit" value="Solicitar registro">
        </form>

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