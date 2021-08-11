<?php
include 'functions.php';
include 'database.php';
session_start();
$type= get_safe_senatize_value($_POST['type']);
if($type=='email'){
	$email=get_safe_senatize_value($_POST['email']);
    $connection = new Database();
    $connection -> select("users", "*", "email = $email");
    if($connection -> getCount() > 0){	
		echo "email_present";
		die();
	}

	$otp=rand(1111,9999);	
	$html="$otp is your otp, please do not share with anyone.";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="hemantpaliwal473@gmail.com";
	$mail->Password="MODI@555";
	$mail->SetFrom("hemantpaliwal473@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true); 
	$mail->Subject="New OTP";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
        $_SESSION['EMAIL_OTP']=$otp;
		echo "done";
	}else{
		echo "not_done";
	}
}
?>