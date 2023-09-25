<?php
include_once('database.php');
$cart_product_id = $_POST['cart_product_id'];
$sql = "UPDATE cart_product SET delivery_status='client_received', client_received_date=now()
WHERE id=$cart_product_id";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $_SESSION['product_marked_as_received'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
