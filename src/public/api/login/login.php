<?php
spl_autoload_register(function($class) {
    require         "../../../private/app/Model/$class.php";
});
header("Content-type:application/json;charset=utf-8");

$username = $_POST['username'];
$password = $_POST['password'];

if(!isset($username)) {
    header("Location: ".host."");
} else {
    /* Create new Object */
    $check = new Login();
    /* If fields are empty, display an error */
    if(empty($username) || empty($password)){
        $data['response'] = "error";
        $data['content'] = "Please enter your username or email, and password";
    } else {
        /* User can only enter usernames with digits or letters */
        if(ctype_alnum($username)) {
            /* Check if username and password matches with the criteria */ 
            if($check->login_user($username, $password)) {
                $data['response'] = "success";
                $data['content'] = "Welcome to Fredrics CV!";
            } else {
                $data['response'] = "error";
                $data['content'] = "Wrong email or password";
            }
        } else {
            $data['response'] = "error";
            $data['content'] = "Usernames can only be digits or letters";
        }
    }

    echo json_encode($data);
   
}