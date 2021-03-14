<?php 

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
include_once __DIR__ . '/../vendor/autoload.php';


if(isset($_COOKIE['Auth'])){
    $jwt = $_COOKIE['Auth'];
    $env =  Dotenv::createImmutable(__DIR__ .  '/../');
    $env->load();
    try {
        $JWT_DECODE = (array) JWT::decode($jwt, $_ENV['KEY_JWT'], ['HS256']);
        $_SESSION['UserName'] = $JWT_DECODE['Name'];
        $_SESSION['UserId'] = $JWT_DECODE['id'];    
    } catch(\Throwable $th) {
        
    }    
        
}

$validation = isset($_SESSION['UserName']) && isset($_SESSION['UserId']);

if($validation){
    header('location: /templates/Dashboard.php');
}
