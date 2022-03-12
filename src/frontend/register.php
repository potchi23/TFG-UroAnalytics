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
        <link rel="stylesheet" href="css/form.css"/>
        <?php include_once("common/includes.php");?>
    </head>
    <body>
        <div class="container">
            <div class="form-container">

                <h1 class="form-title font-weight-bold">Solicitar registro</h1>

                <div class="register-form">        
                    <p for="register">¿Ya tienes cuenta? <a href="login.php">Accede aquí</a></p>
                </div>

                <div class="form-content">
                    <form action="requests/postRegister.php" method="post" target="_self">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" ><br><br>

                        <label for="surname_1">Apellido 1</label>
                        <input type="text" id="surname_1" name="surname_1"><br><br>

                        <label for="surname_2">Apellido 2</label>
                        <input type="text" id="surname_2" name="surname_2"><br><br>

                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" ><br><br>

                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password"><br><br>

                        <label for="password_confirm">Confirmar contraseña</label>
                        <input type="password" id="password_confirm" name="password_confirm"><br><br>

                        <input class="submit btn btn-success" type="submit" value="Solicitar registro">
                    </form>
                </div>
                <br><br>
                <?php
                        if (isset($_SESSION["error"]) && count($_SESSION["error"]) > 0){
                            echo "<div class='alert alert-danger'>";
                            foreach($_SESSION["error"] as $error){
                                echo "<div>$error</div>";
                            }
                            echo "</div>";
                            
                            unset($_SESSION["error"]);
                        }
                ?>

            </div>
        </div>>
    </body>
</html>