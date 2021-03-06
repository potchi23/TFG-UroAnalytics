<?php 
    require_once("../models/User.php");
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];
    
    if(isset($_POST["button"])){
        unset($_POST["button"]);
        $get_req = $_SESSION["get_req"];
        
        $columns = array_keys($_POST);

        for($i = 0; $i < count($_POST); $i++){
            if($columns[$i] != "extended"){
                $get_req["drop".$columns[$i]] = $columns[$i];
            }
        }

        isset($_POST["extended"]) ? $get_req["extended"] = False: $get_req["extended"] = True;

        unset($_POST["extended"]);
        

        $http_requests = new HttpRequests();
        $response = $http_requests->getResponse("$BACKEND_URL/getDetails", "GET", $get_req, $user->get_token());
        
        if($response["status"] == 200){
            $user_id = (string) $response["data"];
            header("Location: viewProfiling.php?current_user=$user_id");
        }else if($response["status"] == 401){
            unset($_SESSION["user"]);
            echo "<script>alert('La sesión ha caducado. Vuelva a iniciar sesión.');</script>";
            $_SESSION["message"] = "La sesión ha caducado";
            echo "<script type='text/javascript'>window.location.href = '../login.php';</script>";
        }else if($response["data"]->errorMsg != ""){
            $error = $response["data"]->errorMsg;
            echo"<div class='alert-message'><div class='alert alert-danger'>$error</div></div>";
        }
    }else{
        $http_requests = new HttpRequests();
        $columns = $http_requests->getResponse("$BACKEND_URL/getColumns", "GET", "", $user->get_token());
    ?>

<!DOCTYPE html>

<html>
    <head>
        <title>Detalles de la consulta</title>
        <link rel="stylesheet" href="../css/form.css"/>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php require("../common/includes.php");?>
        <html lang="es">
        <script src="https://unpkg.com/htmlincludejs"></script>
    </head>
    <body>
        <script type="text/javascript">
            var loadingJS = loadingJS();
            loadingJS.start();
        </script> 
            
        <div class="header">
            <div class="fixed-top">
                <?php require("../common/header.php");?>
            </div>
        </div>
        
        <div class="sidebar-container" id="list-example">
            <?php include_once("sidebarQueryResult.php");?>
        </div>
        
        <div class="content-container">
            <div class="container-fluid">
                <div class="jumbotron">
                <h1 style="font-weight:600;">Detalles de la consulta</h1>
                    <form method="post" target="_blank">
                        <hr class="my-8">
                        <div class="custom-control custom-switch custom-switch-md">
                            <input type="checkbox" class="custom-control-input" id="extended" name="extended">
                            <label class="custom-control-label" for="extended"> Generar detalles extendidos (Esto aumentará el tiempo de espera)</label>
                        </div>
                        <hr class="my-8">
                        <h3>Seleccione los datos que desea excluir de los detalles.</h3>
                        <hr class="my-8">
                            <?php require_once("../common/patientDetails.php")?>
                            <hr class="my-8">
                            <br>
                            <center>
                                <button type="submit" class="btn btn-primary btn-md ml-4" name="button" value="">Pulse aquí para ver los detalles</button>
                            </center>
                    </form>
                </div>
            </div>
        </div>

        <footer class="bg-light text-center text-lg-start">
            <?php require("../common/footer.php")?>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
<?php
    }
?>