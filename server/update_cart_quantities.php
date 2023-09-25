<?php
include ('database.php');
$quantity =  $_POST['quantity'];
$product_id =  $_POST['product_id'];
$cart_id = $_POST['cart_id'];

$sql = "UPDATE cart_product SET quantity='$quantity'
        WHERE product_id='$product_id' AND cart_id='$cart_id';";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
}
 ?>
