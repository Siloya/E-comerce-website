<?php
include ('database.php');
include_once('../functions/security_functions.php');
staff_only();
$vendor_id  =  $_POST['vendor_id'];
$sql = "UPDATE vendor SET active='0' WHERE id='$vendor_id';";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  $_SESSION['vendor_suspended'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
