<?php

session_start();

use app\classes\User;

require_once("../app/classes/User.php");
require_once("../includes/RedirectAuthUser.php");
require_once("../includes/basePage/pagenoauth.php");

$status = [];


if ($_POST) {
    if ($_POST["email"] && $_POST["Password"] && $_POST["ConfirmPass"] && $_POST["name"]) {
        if ($_POST["Password"] === $_POST["ConfirmPass"]) {
            $user = new User($_POST["email"], $_POST["Password"], $_POST["ConfirmPass"], $_POST["name"]);
            $ResponseRegister = $user->register();
            if ($ResponseRegister["ok"]) {
                $status[] = "<p class='status green'>" . $ResponseRegister["statusmensage"] . "</p>";
                $_SESSION['UserName'] = $ResponseRegister['User']['name'];
                $_SESSION['UserId'] = $ResponseRegister['User']['id'];
                $exp = time() + 60 * 60 * 24 * 30;
                setcookie('Auth', $ResponseRegister['JWT'], $exp, "/");
                header('location: Dashboard.php');
            } else {
                $status[] = "<p class='status red'>" . $ResponseRegister["statusmensage"] . "</p>";
            }
        } else {
            $status[] = "<p class='status red'>" . "Senhas não batem" . "</p>";
        }
    } else {
        $status[] = "<p class='status red'>" . "Preecha todos os dados" . "</p>";
    }
}









?>

<link rel="stylesheet" href="/styles/register.css">

<main class="register">

    <div class="registerbox">
        <h1 class="titleregister">Crie sua conta</h1>
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
            <form class="registerform" method="post">

                <div class="divinput">
                    <i class="fas fa-user-circle"></i>
                    <label for="email">Nome</label>
                    <input required minlength="3" maxlength="30" type="text" name="name" id="name">
                </div>


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

                <div class="divinput">
                    <i class="fas fa-lock"></i>
                    <label for="confirmPassw"> Confirm Password</label>
                    <input minlength="5" required type="Password" name="ConfirmPass" id="Confirmpass">
                </div>

                <button class="btn-register"> Register </button>



            </form>




        </div>





    </div>

</main>