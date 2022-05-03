<?php
    require_once("../requests/HttpRequests.php");
    require_once("../config/config.php");

    $http_requests = new HttpRequests();

    $get_req = array('current_user' => $_GET["current_user"]);

    $details = $http_requests->getResponse("$BACKEND_URL/getDetailsFile", "GET", $get_req);
    echo $details["data"]->data;
?>