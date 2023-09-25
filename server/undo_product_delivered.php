<?php
include_once('database.php');
require '../functions/carbon/autoload.php';
use Carbon\Carbon;

$cart_id = $_POST['cart_id'];
$product_id = $_POST['product_id'];

$sql = "SELECT * FROM cart_product WHERE product_id='$product_id' AND cart_id='$cart_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  if($result->num_rows > 0){
    while($cart_product = $result->fetch_assoc()){
      $delivered_date = new Carbon($cart_product['vendor_delivered_date']);
      $now = Carbon::now();
      $canBeUndone = true;
      if($delivered_date->diffInMinutes($now)>=5){
        $canBeUndone = false;
      }
    }
  }
}

if($canBeUndone == false){
  $_SESSION['product_marked_as_pending'] = false;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  die();
}

$sql = "UPDATE cart_product SET delivery_status='pending' WHERE product_id=$product_id
AND cart_id=$cart_id";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $_SESSION['product_marked_as_pending'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 ?>
