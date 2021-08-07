<?php
include 'database.php';
include 'functions.php';
$connection = new Database();
$name = get_safe_senatize_value($_POST['name']);
$email = get_safe_senatize_value($_POST['email']);
$mobile = get_safe_senatize_value($_POST['mobile']);
$password = get_safe_senatize_value($_POST['password']);
$connection -> insert("users",["name"=>$name, "email"=>$email, "mobile"=>$mobile, "password"=>$password]);
$result = $connection -> getResult();
if (gettype($result[0]) === "string") {
    echo "Error - " . $result[0];
}else{
    echo $result[0];
}

?>