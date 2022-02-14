<?php

class User {
    private $id;
    private $name;
    private $surname_1;
    private $surname_2;
    private $email;
    private $telefono;
    private $patologia;
    private $token;

    public function __construct($id, $name, $surname_1, $surname_2, $email, $telefono, $patologia, $token) {
        $this->id = $id;
        $this->name = $name;
        $this->surname_1 = $surname_1;
        $this->surname_2 = $surname_2;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->patologia = $patologia;
        $this->token = $token;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function get_name(){
        return $this->name;
    }

    public function get_surname_1(){
        return $this->surname_1;
    }

    public function get_surname_2(){
        return $this->surname_2;
    }

    public function get_full_name(){
        return $this->name . " " . $this->surname_1 . " " . $this->surname_2;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_telefono(){
        return $this->telefono;
    }

    public function get_patologia(){
        return $this->patologia;
    }

    public function get_token(){
        return $this->token;
    }
    public function set_name($name){
        $this->name = $name;
    }

    public function set_surname_1($surname_1){
        $this->surname_1 = $surname_1;
    }

    public function set_surname_2($surname_2){
        $this->surname_2 = $surname_2;
    }

    public function set_email($email) {
        $this->email = $email;
    }

    public function set_telefono($telefono){
        $this->telefono = $telefono;
    }

    public function set_patologia($patologia){
        $this->patologia = $patologia;
    }

   
}

?>