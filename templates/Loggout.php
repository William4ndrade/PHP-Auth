<?php

session_start();
require_once('../includes/RedirectNoAuthUser.php');
session_destroy();
setcookie('Auth', "", 0, "/");
header('location: ../index.php ');