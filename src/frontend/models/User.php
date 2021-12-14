<?php

class User {
    private $id;
    private $name;
    private $surname_1;
    private $surname_2;
    private $email;
    private $type;
    private $accepted;

    public function __construct($id, $name, $surname_1, $surname_2, $email, $type, $accepted) {
        $this->id = $id;
        $this->name = $name;
        $this->surname_1 = $surname_1;
        $this->surname_2 = $surname_2;
        $this->email = $email;
        $this->type = $type;
        $this->accepted = $accepted;
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

    public function get_type(){
        return $this->type;
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

    public function is_admin(){
        return $this->type == "admin" ? true : false;
    }

    public function is_accepted(){
        return $this->accepted;
    }
}

?>