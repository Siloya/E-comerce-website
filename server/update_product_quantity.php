<?php
include('database.php');

$quantity = $_POST['quantity'];
$product_id = $_POST['product_id'];

$sql = "UPDATE product SET quantity='$quantity' WHERE id='$product_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
}
?>
