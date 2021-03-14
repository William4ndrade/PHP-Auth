<?php

use app\classes\User;

require_once("../includes/basePage/pagenoauth.php");
require_once("../includes/RedirectAuthUser.php");
require_once("../app/classes/User.php");


$status = [];

if($_POST) {
    if ($_POST["email"] && $_POST["Password"]) {
            $user = new User($_POST["email"], $_POST["Password"]);
            $ResponseLogin = $user->login();
            if($ResponseLogin['ok']){
                $status[] = "<p class='status green'>" . 'Autenticado com sucesso' . "</p>";
                $_SESSION['UserId'] = $ResponseLogin['userinfo']['id'];
                $_SESSION['UserName'] = $ResponseLogin['userinfo']['name'];
                $exp = time() + 60 * 60 * 24 * 30;
                setcookie('Auth', $ResponseLogin['JWT'], $exp, "/");
                header('location: Dashboard.php');
                

            }else{
                $status[] = "<p class='status red'>" . $ResponseLogin['statusmensage'] . "</p>";
            }


        }
     else {
        $status[] = "<p class='status red'>" . "Preecha todos os dados" . "</p>";
    }
}




?>


<link rel="stylesheet" href="../styles/login.css">

<main class="login">

    <div class="loginbox">
        <h1 class="titlelogin">Login</h1>
        <div>
            <?php
            foreach ($status as $element) {
                 echo $element;
             }
            ?>

        </div>

        <div class="container">
            <div class="img">
                <img class="conversation" src="/app/assets/images/undraw_online_discussion_5wgl.svg" alt="conversation">
            </div>
            <form class="loginform" method="post">
                <div class="divinput">
                    <i class="fas fa-user"></i>
                    <label for="email">E-mail</label>
                    <input required type="email" name="email" id="email">
                </div>

                <div class="divinput">
                    <i class="fas fa-lock"></i>
                    <label for="Password">Password</label>
                    <input minlength="5" required type="password" name="Password" id="Password">
                </div>


                <button class="btn-login"> Entrar </button>



            </form>




        </div>





    </div>

</main>