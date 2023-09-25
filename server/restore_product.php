<?php
include ('database.php');
include_once('../functions/security_functions.php');
staff_only();
$product_id  =  $_POST['product_id'];
$sql = "UPDATE product SET active='1' WHERE id='$product_id';";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  $_SESSION['product_suspended'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
