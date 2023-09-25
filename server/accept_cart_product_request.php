<?php
include_once('database.php');

$cart_id = $_POST['cart_id'];
$product_id = $_POST['product_id'];
$sql = "UPDATE cart_product SET delivery_status='pending' WHERE cart_id='$cart_id' AND product_id='$product_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  $_SESSION['cart_product_request_accepted'] = true;
  header("Location: ../vendor_orders_requested.php");
}
 ?>
