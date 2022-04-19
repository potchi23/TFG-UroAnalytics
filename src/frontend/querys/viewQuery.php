<!DOCTYPE html>

<?php
    require_once("../models/User.php");
    session_start();
?>

<html>
    <head>
        <title>Consultas</title>
        <link rel="stylesheet" href="../css/forms.css"/>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php require("../common/includes.php");?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/formUserProfile.css"/>
       
    </head>
    <body>
        <div class="header">
            <?php require("../common/header.php");?>
        </div>


        <div class="content-container">
            <div class="container-fluid">
                <div id="viewPatient">
                    <div class="content-container" style="padding:0px;">
                        <div class="container-fluid">
                            <div class="jumbotron">
                                <h1 style="font-weight:600;">Pacientes</h1>
                                <hr class="my-8">

                                <?php 
                                    require("getQuery.php");
                                ?>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-light text-center text-lg-start">
            <?php require("../common/footer.php")?>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>