<?php

use GuzzleHttp\Client;
session_start();
require_once('../includes/RedirectNoAuthUser.php');
require '../vendor/autoload.php';
$client = new GuzzleHttp\Client();
$res = $client->request('GET', 'https://dog.ceo/api/breeds/image/random', );
 $res->getBody();
 $picture = json_decode($res->getBody(), true)['message'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>
    <aside class="menu">
        <div class="userinfo">
            <img draggable="false" class="dogprofileimage" src=<?= $picture ?> alt="Loading...">
            <p class="username"><?= $_SESSION['UserName']; ?></p>
        </div>

        <nav class="menu">
            <ul class="list-links" >
                <li class="menu-item"><a class="linkmenu" href="Dashboard.php"> <i class="fas fa-house-user"></i> Home</a></li>
                <li class="menu-item"> <a class="linkmenu" href="MyPosts.php"> <i class="fas fa-scroll"></i> My Posts </a>  </li>
                <li class="menu-item"> <a class="linkmenu" href="Loggout.php"> <i class="fas fa-door-open"></i> Loggout </a> </li>
            </ul>
        </nav>
    </aside>