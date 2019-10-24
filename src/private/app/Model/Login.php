<?php

class Login extends Database {

    public function login_user($username, $password) {

        $stmt = $this->connect()->prepare("SELECT *
        FROM dt173g_projekt.users
        WHERE email = ?
        OR username = ?");
        
        $stmt->execute([$username, $username]);

        /* First we control the result */
        if($stmt->rowCount()){
            /* Then we go through the result */
            while($row = $stmt->fetch()){
                /* Here we check so that the password matches the hashed on */
                $passwordCheck = password_verify($password, $row['password']);
                /* If it's false, return false */
                if($passwordCheck == false ) {
                    return false;
                } 
                /* If it's correct, return true */
                else if ($passwordCheck == true) {
                    /* Start the session and give the session variables user information */
                    session_start();
                    $_SESSION['id'] = $row['user_id'];
                    $_SESSION['name'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    return true;
                }
            }
        }
    }

    public function logoutUser() {
        session_start();
        session_unset();
        session_destroy();
        $actual_link = $_SERVER['REQUEST_URI'];
        header("Refresh:0");
    }
}