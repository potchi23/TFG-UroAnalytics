<?php
    require_once("models/User.php");
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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="css/formUserProfile.css"/>
            <link rel="stylesheet" href="css/header.css"/>
        </head>
        <body>
            <div class="header">
                <?php require("common/header.php");?>
            </div>   
            
            <div class="content-container">
                <div class="container-fluid">
                    <div class="jumbotron">
     
                        <?php
    
                            if (isset($_SESSION["message"])){
                                $message = $_SESSION["message"];
                                echo "<div class='alert-message'><p></p><p class='alert alert-success'>$message</p></div>";
    
                                unset($_SESSION["message"]);
                            }
    
                            if (isset($_SESSION["error"]) && !empty($_SESSION["error"])){
                                echo"</p><div class='alert-message'><div class='alert alert-danger'>";
                                foreach($_SESSION["error"] as $error){
                                    echo $error . "<br>";
                                }
                                echo"</div></div>";
                                unset($_SESSION["error"]);
                            }
                        ?> 
    
                        <h1 class="display-8" style="font-weight:600;">Mis datos de perfil</h1>
                        <hr class="my-8">
    
                        <button class="btn btn-primary" onclick="enableEditing()">Editar información</button><br>
    
                        <form action="requests/patchEditUserProfile.php" method="post" target="_self">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" placeholder="Nombre" value="<?php echo $name?>" disabled><br><br>
    
                            <label for="surname_1">Apellido 1</label>
                            <input type="text" id="surname_1" name="surname_1" placeholder="Apellido 1" value="<?php echo $surname_1?>" disabled><br><br>
    
                            <label for="surname_2">Apellido 2</label>
                            <input type="text" id="surname_2" name="surname_2" placeholder="Apellido 2" value="<?php echo $surname_2?>" disabled><br><br>
    
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email?>" disabled><br><br>
    
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" placeholder="Nueva contraseña (opcional)" disabled><br><br>
    
                            <label for="password_confirm">Confirmar contraseña</label>
                            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmar contraseña" disabled><br><br>
                        
                            <button type="button" id="btn-submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop01" disabled>
                                Guardar cambios
                            </button>

                            <div class="modal fade" id="staticBackdrop01" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel01" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel01">Guardar cambios</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Está seguro/a de que quiere guardar los cambios realizados?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop02">
                            Eliminar cuenta
                        </button>

                        <div class="modal fade" id="staticBackdrop02" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel02" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel02">Eliminar cuenta</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Está seguro/a de que quiere eliminar su cuenta?</p>
                                        <p>Una vez eliminada su cuenta, tendrá que registrarse de nuevo.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="requests/postDeleteUser.php" method="post" target="_self">
                                            <button type="submit" class="btn btn-danger">Eliminar cuenta</button>                          
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
    
            <footer class="bg-light text-center text-lg-start">
                <?php require("common/footer.php")?>
            </footer> 
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

            <script>
                function enableEditing(){
                    let input = document.getElementsByTagName('input');
    
                    for (i = 0; i < input.length; i++) {
                        input[i].disabled = !input[i].disabled;
                    }
    
                    var button = document.getElementById('btn-submit');
                    button.disabled = !button.disabled;
                }
            </script>    
        </body>
    </html>