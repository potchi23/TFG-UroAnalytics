<?php

class User {
    private $name;
    private $surname_1;
    private $surname_2;
    private $email;
    private $type;
    private $accepted;

    public function __construct($name, $surname_1, $surname_2, $email, $type, $accepted){
        $this->name = $name;
        $this->surname_1 = $surname_1;
        $this->surname_2 = $surname_2;
        $this->email = $email;
        $this->type = $type;
        $this->accepted = $accepted;
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

    public function is_admin(){
        return $this->type == "admin" ? true : false;
    }

    public function is_accepted(){
        return $this->accepted;
    }
}

?>