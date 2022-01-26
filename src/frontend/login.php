<?php
    session_start();

    if (isset($_SESSION["user"])){
        header("Location: /dashboard.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Savana Barata - Login </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css"/>
    </head>
    <body>
        <div class="form-container">
            
            <h1 class="form-title">Acceder a la copia barata de Savana</h1>

            <div class="form-content">

                <form action="requests/postLogin.php" method="post" target="_self">
                    
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"><br><br>

                    <label for="email">Contraseña</label>
                    <input type="password" id="password" name="password"><br><br>

                    <input class="btn btn-success" id="submit"type="submit" value="Login">
                </form>
            </div>

            <?php
                if (isset($_GET["error"])){
                    $error_array = explode(",", $_GET["error"]);
                    
                    foreach($error_array as $error){
                        echo "<p class='alert alert-danger'>$error</p>";
                    }

                    unset($_GET["error"]);
                }
            ?>

            <div class="register-form">        
                <p for="register">¿No estás registrado? <a href="register.php">Solicita un registro</a></p>
            </div>
        </div>
    </body>
</html>
