<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    
    $biopsy = array(
        "biopsy1" => $_POST['biopsy1'], 
        "biopsy2" => $_POST['biopsy2'], 
        "biopsy3" => $_POST['biopsy3'], 
        "biopsy3<" => $_POST['biopsy3<'], 
        "biopsy3=" => $_POST['biopsy3='], 
        "biopsy3>" => $_POST['biopsy3>'], 
        "biopsy4" => $_POST['biopsy4']
    );

    $cir = array(
        "cir1" => $_POST['cir1']
    );

    $clinic = array(
        "clinic1" => $_POST['clinic1']
    );

    $evolve = array(
        "evolve1" => $_POST['evolve1'],
        "evolve1<" => $_POST['evolve1<'],
        "evolve1=" => $_POST['evolve1='],
        "evolve1>" => $_POST['evolve1>'],
        "evolve2" => $_POST['evolve2'],
        "evolve3" => $_POST['evolve3'],
        "evolve3<" => $_POST['evolve3<'],
        "evolve3=" => $_POST['evolve3='],
        "evolve3>" => $_POST['evolve3>'],
        "evolve4" => $_POST['evolve4'],
        "evolve5" => $_POST['evolve5'],
        "evolve6" => $_POST['evolve6'],
        "evolve7" => $_POST['evolve7'],
        "evolve7<" => $_POST['evolve7<'],
        "evolve7=" => $_POST['evolve7='],
        "evolve7>" => $_POST['evolve7>'],
        "evolve8" => $_POST['evolve8'],
        "evolve8<" => $_POST['evolve8<'],
        "evolve8=" => $_POST['evolve8='],
        "evolve8>" => $_POST['evolve8>'],
        "evolve9" => $_POST['evolve9'],
        "evolve9<" => $_POST['evolve9<'],
        "evolve9=" => $_POST['evolve9='],
        "evolve9>" => $_POST['evolve9>'],
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

    $prostate = array(
        "prostate1" => $_POST['prostate1'],
        "prostate2" => $_POST['prostate2'],
        "prostate3" => $_POST['prostate3'],
        "prostate3<" => $_POST['prostate3<'],
        "prostate3=" => $_POST['prostate3='],
        "prostate3>" => $_POST['prostate3>'],
        "prostate4" => $_POST['prostate4'],
        "prostate5" => $_POST['prostate5'],
        "prostate6" => $_POST['prostate6'],
        "prostate7" => $_POST['prostate7'],
        "prostate8" => $_POST['prostate8']
    );

    $sociodemographic = array(
        "sociodemographic1" => $_POST['sociodemographic1'],
        "sociodemographic1<" => $_POST['sociodemographic1<'],
        "sociodemographic1=" => $_POST['sociodemographic1='],
        "sociodemographic1>" => $_POST['sociodemographic1>'],
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