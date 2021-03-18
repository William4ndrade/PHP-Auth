<?php


use app\classes\posts\Post;


require_once('../includes/RedirectNoAuthUser.php');
require_once('../app/classes/Posts.php');
require_once('../app/classes/Posts_db_model.php');
require_once('../vendor/autoload.php');




 $status = [];
 
 if($_POST){
     if($_POST['posttext']){
         $post = new Post($_POST['posttext'], $_SESSION['UserId']);
         $response =  $post->newpost();
         if($response['ok']){
            $status[] =  '<div class="statusnewpost green ">' .  $response['statusmensage'] . '</div>';
            header('location: Dashboard.php');
         }else{
            $status[] =  '<div class="statusnewpost red ">' .  $response['statusmensage'] . '</div>';
         }




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
           foreach($status as $elemento){
               echo $elemento;
           }
            
        ?>
        <form method="post">
            <textarea   placeholder="Digite aqui" minlength="1" required maxlength="230" name="posttext"  id="posttext" cols="30" rows="10"></textarea>
            <div class="count" id="count"> <i class="fas fa-stopwatch"></i> 0/230</div>
            <button class="btn-newpost">Enviar</button>
        </form>
        
        
    </div>

    <?php require_once('../includes/basePage/allposts.php') ?>
    
    
    
    


    <script>
        const count = document.querySelector('#count')
        const inputext = document.querySelector('#posttext') 
        inputext.addEventListener('keyup', () => {
            count.innerHTML = ` <i class="fas fa-stopwatch"></i>  ${inputext.value.length}/230`
        }) 
       const teste =  document.querySelector("div.statusnewpost");
        if(teste){
            setTimeout(() => {
                teste.remove()
            },3000)
        }else{
            console.log("ok")
        }


    </script>


</body>
</html>





