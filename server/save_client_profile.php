<?php
include_once('database.php');
include_once('../functions/image_functions.php');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$image = $_FILES['image'];
$url = save_client_image($image);
$client_id = $_POST['client_id'];

if(strlen($image['name'])>0){
  $sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname',
  email='$email', address='$address', tel='$tel', image='$url' WHERE id='$client_id'";
} else {
  $sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname',
  email='$email', address='$address', tel='$tel' WHERE id='$client_id'";
}

$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
}
$_SESSION['client_profile_saved'] = true;
header("Location: ../client_profile.php?client_id=".$client_id);
 ?>
