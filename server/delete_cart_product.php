<?php
include ('database.php');
include_once('../functions/cart_functions.php');
$cart_id = get_pending_cart_id();
$product_id =  $_POST['product_id'];
$sql = "DELETE FROM cart_product WHERE cart_id='$cart_id' AND product_id='$product_id';";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
