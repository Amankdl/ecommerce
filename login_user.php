<?php
include 'database.php';
include 'functions.php';
$connection = new Database();
$email = get_safe_senatize_value($_POST['email']);
$password = get_safe_senatize_value($_POST['password']);
$connection -> select("users","id, name, email, mobile","email = '$email' AND password = '$password'");
$result = $connection -> getResult();
if (count($result) == 0) {
    echo "Invalid Credentials";
} else if (gettype($result[0]) === "string") {
    echo "Error - " . $result[0];
}else{
    session_start();
    $_SESSION['USER_LOGGEDIN'] = 'yes';
    $_SESSION['USER_ID'] = $result[0]['id'];
    $_SESSION['USER_NAME'] = $result[0]['name'];
    $_SESSION['USER_EMAIL'] = $result[0]['email'];

    if(isset($_SESSION['WISHLIST_PRODUCT'])){
        $pid = $_SESSION['WISHLIST_PRODUCT'];
        $user_id = $_SESSION['USER_EMAIL'];
        $connection->insert("wishlist", ['pid' => $pid, 'user_id' => $user_id]);
        unset($_SESSION['WISHLIST_PRODUCT']);
    }

    echo "loggedin";
}
?>