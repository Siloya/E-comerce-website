<?php
include ('database.php');
include_once('../functions/security_functions.php');
staff_only();
$category_id  =  $_POST['category_id'];
$sql = "UPDATE category SET active='1' WHERE id='$category_id';";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  $_SESSION['category_restored'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
