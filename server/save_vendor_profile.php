<?php
include_once('database.php');
include_once('../functions/image_functions.php');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$description = $_POST['description'];
$tel = $_POST['tel'];
$image = $_FILES['image'];
$url = save_vendor_image($image);
$vendor_id = $_POST['vendor_id'];

if(strlen($image['name'])>0){
  $sql = "UPDATE vendor SET firstname='$firstname', lastname='$lastname',
  email='$email', address='$address', tel='$tel', image='$url', description='$description' WHERE id='$vendor_id'";
} else {
  $sql = "UPDATE vendor SET firstname='$firstname', lastname='$lastname',
  email='$email', address='$address', tel='$tel', description='$description' WHERE id='$vendor_id'";
}

$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
}
$_SESSION['vendor_profile_saved'] = true;
header("Location: ../vendor_profile.php?vendor_id=".$vendor_id);
 ?>
