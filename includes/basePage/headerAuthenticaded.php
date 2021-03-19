<?php

require '../vendor/autoload.php';
$client = new GuzzleHttp\Client();
$res = $client->request('GET', 'https://dog.ceo/api/breeds/image/random', );
 $res->getBody();
 $picture = json_decode($res->getBody(), true)['message'];


 ?>
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

<header class="menu">
        <div class="userinfo">
            <img draggable="false" class="dogprofileimage" src=<?= $picture ?> alt="Loading...">
            <p class="username"><?= $_SESSION['UserName']; ?></p>
        </div>

        <nav>
            <ul>
                <li><a href="/"> <i class="fas fa-home"></i> <p class="word" >Home</p> </a></li>
                <li><a href="../../templates/Myposts.php"> <i class="fas fa-comment-alt"></i> <p class="word" >Meus posts</p>  </a></li>
                <li><a href="../../templates/Loggout.php"> <i class="fas fa-door-open"></i> <p class="word" >Sair</p> </a></li>
            </ul>
        </nav>
    </header>