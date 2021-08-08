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
      echo "Invalid Transaction. Please try again";
} else {
      ?>
      <script>
            location.href = "thankyou.php";
      </script>
      <?php
}

?>
