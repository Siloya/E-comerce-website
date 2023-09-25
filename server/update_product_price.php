<?php
include('database.php');

$price = $_POST['price'];
$product_id = $_POST['product_id'];

$sql = "UPDATE product SET price='$price' WHERE id='$product_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
}
?>
