<?php

use app\classes\posts\Post;

require_once('../includes/RedirectNoAuthUser.php');
require_once('../app/classes/Posts.php');



 $erros = [];
 
 if($_POST){
     if($_POST['posttext']){
         $post = new Post('dassdad', 39);
     }
 }






?>


<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>
    <?php require_once('../includes/basePage/headerAuthenticaded.php'); ?>   
    <div class="formarea">
        <?php
            if(count($erros) > 0){
                echo "<div>";
            foreach($erros as $elementos){
                echo $elementos;
            }

            echo "</div>";

            }
        ?>
        <form method="post">
            <textarea   placeholder="Digite aqui" minlength="1" required maxlength="230" name="posttext"  id="posttext" cols="30" rows="10"></textarea>
            <div class="count" id="count"> <i class="fas fa-stopwatch"></i> 0/230</div>
            <button class="btn-newpost">Enviar</button>
        </form>
        
        
    </div>


    <script>
        const count = document.querySelector('#count')
        const inputext = document.querySelector('#posttext')
        inputext.addEventListener('keyup', () => {
            console.log(inputext.value.length)
            count.innerHTML = ` <i class="fas fa-stopwatch"></i>  ${inputext.value.length}/230`
        }) 
    
    </script>


</body>
</html>





