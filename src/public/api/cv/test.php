<?php
ob_start();
session_start();

spl_autoload_register(function($class) {
    require         "../../../private/app/Model/$class.php";
});

// Hämta metod
$method = $_SERVER['REQUEST_METHOD'];
header("Access-Control-Allow-Origin: http://localhost:3004");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Content-type:application/json;charset=utf-8");
// Gör det möjligt att hämta data so mskickas
$input = json_decode(file_get_contents("php://input"),true);

$result = json_decode($input['payload']);

$mess = "Message: " . $result->street;

echo json_encode($mess);