<?php
session_start();
unset($_SESSION['ADMIN_USER_LOGGEDIN']);
unset($_SESSION['ADMIN_USERNAME']);
header("location:login.php");
die();
?>