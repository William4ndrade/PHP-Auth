<?php

use GuzzleHttp\Client;
session_start();
require '../vendor/autoload.php';
$client = new GuzzleHttp\Client();
$res = $client->request('GET', 'https://dog.ceo/api/breeds/image/random', );
 $res->getBody();
 $picture = json_decode($res->getBody(), true)['message'];

 ?>
    <link rel="stylesheet" href="../styles/dashboard.css">

<header class="menu">
        <div class="userinfo">
            <img draggable="false" class="dogprofileimage" src=<?= $picture ?> alt="Loading...">
            <p class="username"><?= $_SESSION['UserName']; ?></p>
        </div>

        <nav>
            <ul>
                <li><a href="/"> <i class="fas fa-home"></i> Home</a></li>
                <li><a href=""> <i class="fas fa-comment-alt"></i> Meus posts</a></li>
                <li><a href="../../templates/Loggout.php"> <i class="fas fa-door-open"></i> Sair</a></li>
            </ul>
        </nav>
    </header>