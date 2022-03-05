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
        <link rel="stylesheet" href="css/formLogin.css" styles="width=18.9px; height=61.7px;"/>
        <?php include_once("common/includes.php");?>
    </head>
    <body>
        <div class="container">
            <div class="form-container">
                <img class="logo" src="img/logo.png" alt="logo" draggable="false"/>
                <h1 class="form-title">Acceder a la copia barata de Savana</h1>

                <div class="form-content">

                    <form action="requests/postLogin.php" method="post" target="_self">
                        
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email"><br><br>

                        <label for="email">Contraseña</label>
                        <input type="password" id="password" name="password"><br><br>

                        <input class="submit btn btn-success" type="submit" value="Login">
                    </form>
                </div>

                <?php
                    if (isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo <<<EOL
                            <div class='alert alert-danger'>
                                <div>$error</div>
                            </div>
                        EOL;
                        unset($_SESSION["error"]);
                    }

                    if (isset($_SESSION["message"])){
                        $message = $_SESSION["message"];
                        echo <<<EOL
                            <div class='alert alert-info'>
                                <div>$message</div>
                            </div>
                        EOL;
                        unset($_SESSION["message"]);
                    }
                ?>

                <div class="register-form">        
                    <p for="register">¿No estás registrado? <a href="register.php">Solicita un registro</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
