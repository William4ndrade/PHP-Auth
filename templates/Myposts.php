<?php

use app\classes\posts\DatabasePosts;
use Carbon\Carbon;

require_once('../includes/RedirectNoAuthUser.php');
require_once('../app/classes/Posts_db_model.php');
require_once("../vendor/autoload.php");
$db = new DatabasePosts;
$myposts = $db->FindpostsbyUserId($_SESSION['UserId']);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My posts</title>
    <link rel="stylesheet" href="/styles/posts.css">
</head>
<body>
    <?= require_once("../includes/basePage/headerAuthenticaded.php") ?>
    <
    <section class="sec-posts-area" >
    <h1 style="color: wheat;">Seus Posts</h1>
        <?php  
            foreach($myposts['data'] as $atualpost){
                echo '<div class="post-div" >';
                echo    "<div class='infopost' >";
                echo         "<p class='usernamepost' >You</p>";
                echo         "<p class='postdate'>". Carbon::parse($atualpost['CreatedAt'])->diffForHumans()     ."</p>";
                echo    "</div> ";
                echo    "<div class='textpostarea'>";
                echo        "<p>{$atualpost['Text']}</p>";
                
                echo       "</div>";
    
    
    
    
                echo '</div>';







            }
        
        
        
        ?>
      <p style="color:white;" >--__--</p>
    
    </section>







</body>
</html>









