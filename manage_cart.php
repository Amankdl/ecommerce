<?php
include 'add_to_cart.php';
include 'functions.php';
$pid = get_safe_senatize_value($_POST['pid']);
$qty = get_safe_senatize_value($_POST['qty']);
$type = get_safe_senatize_value($_POST['type']);
$cart = new Add_to_cart();

if($type === "add"){
    $cart -> add_product_to_cart($pid, $qty);
}

if($type === "delete"){
    $cart -> remove_product_from_cart($pid);
}

if($type === "update"){
    $cart -> update_product_in_cart($pid, $qty);
}

echo $cart -> total_prod_in_cart();

?>