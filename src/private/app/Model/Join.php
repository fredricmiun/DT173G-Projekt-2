<?php

class Join extends Database {
    protected $arr = [];
    protected $string_int = "";

    public function register_user($primary_key, $username, $email, $password) {

        $password_hashed = password_hash( $password, PASSWORD_DEFAULT );

        $stmt = $this->connect()->prepare("INSERT INTO dt173g_projekt.users(`user_id`, `username`, `email`, `password`) 
        VALUES (?,?,?,?);");

        $stmt->execute([$primary_key, $username, $email, $password_hashed]);
        
        if($stmt->rowCount()){
            return true;
        }
    }

    public function check_key($x) {
        $stmt = $this->connect()->query("SELECT u.user_id
        FROM dt173g_projekt.users u");
        if($stmt->rowCount()){
            while($row = $stmt->fetch()){
                array_push($this->arr, $row);
            }
        }
    }
    
    public function check_user($x) {

        $stmt = $this->connect()->prepare("SELECT u.username
        FROM dt173g_projekt.users u
        WHERE username = ?");
        
        $stmt->execute([$x]);
        if($stmt->rowCount()){
            return true;
        }
    }

    public function check_email($x) {

        $stmt = $this->connect()->prepare("SELECT u.email
        FROM dt173g_projekt.users u
        WHERE email = ?");
        
        $stmt->execute([$x]);
        if($stmt->rowCount()){
            return true;
        }
    }

    public function retrieve_string_int() {
        return $this->number_of;
    }
    
    public function retrieve_arr(){
        return $this->arr;
    }
}