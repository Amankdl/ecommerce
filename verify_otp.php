<?php
include 'functions.php';
include 'database.php';
session_start();
$type= get_safe_senatize_value($_POST['type']);
if($type=='email'){
	$user_entered_otp=get_safe_senatize_value($_POST['otp']);
    $otp  =  $_SESSION['EMAIL_OTP'];
    // echo "user entered = $user_entered_otp and session otp $otp"; die();
    if($user_entered_otp  == $otp){
        echo 'verified';
    }else{
        echo 'not_verified';
    }
}
?>