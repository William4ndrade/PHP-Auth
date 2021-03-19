<?php
use Carbon\Carbon;
use app\classes\posts\DatabasePosts;
require_once(__DIR__ . '/../../app/classes/Posts_db_model.php');
require_once(__DIR__ . '/../../vendor/autoload.php');
$posts = new DatabasePosts;
$allposts = $posts->Getposts();

?>

<link rel="stylesheet" href="../../styles/posts.css">


  <section class='sec-posts-area'>
        <div class="post-area" >
            <?php

            foreach($allposts['data'] as $atualpost){
            echo '<div class="post-div" >';
            echo    "<div class='infopost' >";
            echo         "<p class='usernamepost' >{$atualpost['name']}</p>";
            echo         "<p class='postdate'>". Carbon::parse($atualpost['CreatedAt'])->diffForHumans()     ."</p>";
            echo    "</div> ";
            echo    "<div class='textpostarea'>";
            echo        "<p>{$atualpost['Text']}</p>";
            
            echo       "</div>";




            echo '</div>';

            }

                

            ?>

            <p style="color:white;" >--__--</p>
        </div>
    
    
    
    </section>

