<?php

use function PHPSTORM_META\type;

include 'database.php';
session_start();


if (isset($_POST['pid']) && isset($_POST['type'])) {
    $pid = $_POST['pid'];
    $type = $_POST['type'];

    if (!isset($_SESSION['USER_LOGGEDIN'])) {
        //echo $type;
        if ($type == "add") {
            $_SESSION['WISHLIST_PRODUCT'] = $pid;
        }
        echo "needs login";
        die();
    }
    // added unique constraint on combination of (pid and user_id) in Database.
    $connection = new Database();
    $user_id = $_SESSION['USER_ID'];
    if ($type == "add") {
        $connection->insert("wishlist", ['pid' => $pid, 'user_id' => $user_id]);
        $result = $connection->getResult();
        if (gettype($result[0]) === 'integer') {
            $connection->get("SELECT COUNT(id) FROM wishlist WHERE user_id = $user_id");
            $count = $connection->getResult();
            echo $count[0]['COUNT(id)'];
            die();
        } else {
            echo "Already Added";
            die();
        }
    }
    if ($type == "delete") {
        $connection -> delete("wishlist", "pid = $pid AND user_id = $user_id");
        $connection->get("SELECT COUNT(id) FROM wishlist WHERE user_id = $user_id");
        $count = $connection->getResult();
        echo $count[0]['COUNT(id)'];
        die();
    }

} else {
    echo "Ops";
}
