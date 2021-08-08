<?php
include 'database.php';
include 'functions.php';
session_start();

if(!isset($_SESSION['ADMIN_USER_LOGGEDIN']) || $_SESSION['ADMIN_USER_LOGGEDIN'] == ""){
    echo "Sorry you are not a valid user";
    die();
}

$order_id = get_safe_senatize_value($_POST['order_id']);
$order_status = get_safe_senatize_value($_POST['order_status']);

$connection = new Database();
$connection -> update("orders",['order_status' => $order_status], "id = $order_id");
$result = $connection -> getResult();

echo $result[0];
?>