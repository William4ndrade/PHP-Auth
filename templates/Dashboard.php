<?php

require_once('../includes/RedirectNoAuthUser.php');


 $erros = [];
 
 if($_POST){
     if($_POST['posttext']){
         
     }
 }






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
            <textarea placeholder="Digite aqui" minlength="1" required maxlength="230" name="posttext"  id="posttext" cols="30" rows="10"></textarea>
            <button class="btn-newpost">Enviar</button>

        </form>

    </div>


</body>
</html>





