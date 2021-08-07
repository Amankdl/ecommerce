<?php
include 'database.php';
include 'functions.php';
$connection = new Database();
$name = get_safe_senatize_value($_POST['name']);
$email = get_safe_senatize_value($_POST['email']);
$mobile = get_safe_senatize_value($_POST['mobile']);
$comment = get_safe_senatize_value($_POST['comment']);
$connection -> insert("contact_us",["name"=>$name, "email"=>$email, "mobile"=>$mobile, "comment"=>$comment]);
$result = $connection -> getResult();
echo "Thank you! We will revert you soon."
?>