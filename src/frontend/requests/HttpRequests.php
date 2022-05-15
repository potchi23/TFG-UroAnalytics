<?php

class HttpRequests {
    private $ch;

    function getResponse($endpoint, $method, $body, $token = null){
        $this->ch = curl_init();

        if($token != null){
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("x-access-token: $token"));
        }

        curl_setopt($this->ch, CURLOPT_URL, $endpoint);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);

        $data = curl_exec($this->ch);
        $status = curl_getinfo($this->ch, CURLINFO_RESPONSE_CODE);

        curl_close($this->ch);

        $response = array("data" => json_decode($data), "status" => $status);

        return $response;
    }
}


?>