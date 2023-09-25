<?php
include_once('database.php');
$product_id = $_POST['product_id'];
$cart_id = $_POST['cart_id'];
$sql = "UPDATE cart_product SET delivery_status='vendor_delivered',
vendor_delivered_date=now() WHERE product_id=$product_id
AND cart_id=$cart_id";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $_SESSION['product_marked_as_delivered'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
