<?php
include ('database.php');
include_once('../functions/security_functions.php');
staff_only();
$customer_id  =  $_POST['customer_id'];
$sql = "UPDATE customer SET active='0' WHERE id='$customer_id';";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  $_SESSION['customer_suspended'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
