<?php
include 'database.php';
$status = $_POST["status"];
$firstname = $_POST["firstname"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];

$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$salt = "";
$key = "";
$mihpayid = $_POST["mihpayid"];
$status = $_POST["status"];


// var_dump($_POST);
// die();
// Salt should be same Post Request 
if (isset($_POST["additionalCharges"])) {
      $additionalCharges = $_POST["additionalCharges"];
      $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
      $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}
$hash = hash("sha512", $retHashSeq);
$connection = new Database();
$connection -> update("orders", ['mihpayid' => $mihpayid, 'payment_status' => $status], "txnid = '$txnid'");
if ($hash != $posted_hash) {
      echo '<div class="container failed-transaction my-5">
             <h2> Oh no :( Transaction failed.. Please try again.</h2>
             </div>';
} else {
      echo "<h3>Your order status is " . $status . ".</h3>";
      echo "<h4>Your transaction id for this transaction is " . $txnid . ". You may try making the payment by clicking the link below.</h4>";
}
?>