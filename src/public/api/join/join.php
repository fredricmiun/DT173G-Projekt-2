<?php

spl_autoload_register(function($class) {
    require         "../../../private/app/Model/$class.php";
});

// Hämta metod
$method = $_SERVER['REQUEST_METHOD'];
header("Content-type:application/json;charset=utf-8");
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
// Gör det möjligt att hämta data so mskickas
$input = json_decode(file_get_contents('php://input'),true);

    $username = $input['username'];
    $email = $input['email'];
    $password = $input['password'];
    $password_confirm = $input['password_confirm'];

    switch ($method) {
        case "POST":
        // Ifall något av fälten är tomma, avbryt uppdatering. Ge felmeddelande.
        if(!isset($username)) {
            header("Location: ".host."");
        } else {
        
            if(empty($username) || empty($email) || empty($password) || empty($password_confirm)){
                $data['response'] = "error";
                $data['content'] = "Please enter your username, email, and password";
            } else {
                $check = new Join();
                /* Check if username is taken */ 
                if($check->check_user($username)) {
                    $data['response'] = "error";
                    $data['content'] = "This username is taken";
                } 
                else if (strlen($username)<3) {
                    $data['response'] = "error";
                    $data['content'] = "Username needs to be atleast 3 characters";
                }
                else if (strlen($username)>32) {
                    $data['response'] = "error";
                    $data['content'] = "Username needs to be shorter than 32 characters";
                }
                /* Only allow letters and digits for username */
                else if (!ctype_alnum($username)) {
                    $data['response'] = "error";
                    $data['content'] = "Usernames can only consist of letters between A-Z and digits";
                }  
                /* Check if email is taken */ 
                else if ($check->check_email($email)) {
                    $data['response'] = "error";
                    $data['content'] = "This email is already registered";
                }
                /* Check if email isn't too long */
                else if (strlen($email)>128) {
                    $data['response'] = "error";
                    $data['content'] = "Email needs to be shorter than 128 characters";
                }
                /* Check if mail is really valid */
                else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data['response'] = "error";
                    $data['content'] = "Email is invalid";
                } 
                /* Check if password is strong enough */ 
                else if (strlen($password)<8) {
                    $data['response'] = "error";
                    $data['content'] = "Password needs to be atleast 8 characters";
                } 
                /* Check if passwords match*/ 
                else if ($password != $password_confirm) {
                    $data['response'] = "error";
                    $data['content'] = "Passwords don't match";
                } 
                /* If all is well - register user */
                else {
                    if($check->register_user(generate_key(), $username, $email, $password)) {
                        $data['response'] = "success";
                        $data['content'] = "Welcome to Fredrics CV! Signing in.";
                            /* After they register we log them in */
                            // $login = new Login;
                            // if($login->login_user($username, $password)) { 
                            //     $data['response'] = "success";
                            //     $data['content'] = "Welcome to Fredrics CV! Signing in.";
                            // }
                            /* End of login */
                    }
                }
            }
        }
        break;
    }
    
    echo json_encode($data);

function check_key($string) {
    $init_key = new Join;  
    $init_key->check_key($string);
    $get_keys = $init_key->retrieve_arr();
    
    foreach($get_keys as $i => $keys) {
        if($keys['user_id'] == $string) {
           $keyExists = true;
            break;
        } else {
            $keyExists = false;
        }
    }

    return $keyExists;
}

function generate_key() {
    $prel_key = rand(10000000,99999999);
    $check_key = check_key($prel_key);

    while ($check_key == true) {
        $prel_key = rand(10000000,99999999);
        $check_key = check_key($prel_key);
    } 
    
    return $prel_key;
}