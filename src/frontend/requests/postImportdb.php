<?php
    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
  
    move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.'/tmp_uploads/'.$_FILES['file']['name']);
 
    $post_req = array(
        "filename" => $_FILES['file']['name']
    );

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/importdb", "POST", $post_req);
    
    $data = $response["data"];

?>
