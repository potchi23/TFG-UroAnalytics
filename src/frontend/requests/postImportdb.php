<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
  
    move_uploaded_file($_FILES['file']['tmp_name'], dirname(dirname(__DIR__)).'/backend/tmp_uploads/'.$_FILES['file']['name']);
    
    $post_req = array(
        "filename" => $_FILES['file']['name']
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/importdb", "POST", $post_req);
    print_r($response);
    if($response["status"] == 200){
        $num_entries = $response["data"]->num_entries;
        echo "se han introducido $num_entries pacientes.";
    }
?>
