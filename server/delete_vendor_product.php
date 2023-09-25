<?php
include ('database.php');
$product_id = $_POST['product_id'];
$vendor_id = $_POST['vendor_id'];
$sql = "DELETE FROM product WHERE id='$product_id' AND vendor_id='$vendor_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $_SESSION['product_deleted'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 ?>
