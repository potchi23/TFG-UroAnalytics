<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();

    function minormayor($arg){
        $aux = "";

        if(isset($_POST[$arg."op"])){
            $aux .= $_POST[$arg."op"];
            if(isset($_POST[$arg."="])){
                $aux .= $_POST[$arg."="];
            }
        }elseif(isset($_POST[$arg."="])){
            $aux .= $_POST[$arg."="];
        }

        return $aux;
    }

    $biopsy3op = minormayor("biopsy3")
    $biopsy = array(
        "biopsy1" => $_POST['biopsy1'], 
        "biopsy2" => $_POST['biopsy2'], 
        "biopsy3" => $_POST['biopsy3'], 
        "biopsy3op" => $biopsy3op, 
        "biopsy4" => $_POST['biopsy4']
    );

    $cir = array(
        "cir1" => $_POST['cir1']
    );

    $clinic = array(
        "clinic1" => $_POST['clinic1']
    );

    $evolve1op = minormayor("evolve1")
    $evolve3op = minormayor("evolve3")
    $evolve7op = minormayor("evolve7")
    $evolve8op = minormayor("evolve8")
    $evolve9op = minormayor("evolve9")
    $evolve = array(
        "evolve1" => $_POST['evolve1'],
        "evolve1op" => $evolve1op,
        "evolve2" => $_POST['evolve2'],
        "evolve3" => $_POST['evolve3'],
        "evolve3op" => $evolve3op,
        "evolve4" => $_POST['evolve4'],
        "evolve5" => $_POST['evolve5'],
        "evolve6" => $_POST['evolve6'],
        "evolve7" => $_POST['evolve7'],
        "evolve7op" => $evolve7op,
        "evolve8" => $_POST['evolve8'],
        "evolve8op" => $evolve8op,
        "evolve9" => $_POST['evolve9'],
        "evolve9op" => $evolve9op,
        "evolve10" => $_POST['evolve10']
    );

    $markers = array(
        "markers1" => $_POST['markers1'],
        "markers2" => $_POST['markers2'],
        "markers3" => $_POST['markers3'],
        "markers4" => $_POST['markers4'],
        "markers5" => $_POST['markers5'],
        "markers6" => $_POST['markers6'],
        "markers7" => $_POST['markers7']
    );

    $prostate3op = minormayor("prostate3")
    $prostate = array(
        "prostate1" => $_POST['prostate1'],
        "prostate2" => $_POST['prostate2'],
        "prostate3" => $_POST['prostate3'],
        "prostate3op" => $prostate3op,
        "prostate4" => $_POST['prostate4'],
        "prostate5" => $_POST['prostate5'],
        "prostate6" => $_POST['prostate6'],
        "prostate7" => $_POST['prostate7'],
        "prostate8" => $_POST['prostate8']
    );

    $sociodemographic1op = minormayor("sociodemographic1")
    $sociodemographic = array(
        "sociodemographic1" => $_POST['sociodemographic1'],
        "sociodemographic1op" => $sociodemographic1op
    );

    $post_req = array(
        "biopsy" => $biopsy
         "cir" => $cir,
         "clinic" => $clinic,
         "evolve" => $evolve,
         "markers" => $markers,
         "prostate" => $prostate,
         "sociodemographic" => $sociodemographic
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/query", "GET", "", $post_req);

?>