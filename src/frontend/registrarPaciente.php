<!DOCTYPE html>

<?php
    include_once("models/Paciente.php");
?>

<html>
    <head>
        <title>Añadir paciente</title>
        <link rel="stylesheet" href="css/forms.css">
        <?php include_once("common/includes.php");?>
    </head>
    <body>
        <div class="container">
            <div class="form-container">

                <h1 class="form-title">Añadir paciente</h1>

                <div class="form-content">
                    <form action="requests/postRegistrarPaciente.php" method="post" target="_self">
                        
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre"><br><br>

                        <label for="apellido1">Apellido1</label>
                        <input type="text" id="apellido1" name="apellido1"><br><br>

                        <label for="apellido2">Apellido2</label>
                        <input type="text" id="apellido2" name="apellido2"><br><br>

                        <label for="email">Email</label>
                        <input type="text" id="email" name="email"><br><br>

                        <label for="telefono">Telefono</label>
                        <input type="text" id="telefono" name="telefono"><br><br>

                        <label for="patologia">Patologia</label>
                        <input type="text" id="patologia" name="patologia"><br><br>

                        <input class="submit btn btn-success" type="submit" value="Añadir">
                    </form>
                </div>
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
            </div>
        </div>
    </body>
</html>
