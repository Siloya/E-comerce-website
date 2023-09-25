<?php
include_once('database.php');
$stars = $_POST['stars'];
$rating_text = $_POST['rating_text'];
$vendor_id = $_POST['vendor_id'];
$customer_id = $_SESSION['client_id'];
$already_rated = false;
$sql = "SELECT * FROM rating WHERE customer_id='$customer_id' AND vendor_id='$vendor_id'";

$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  if($result->num_rows>0){
    $already_rated = true;
    $rating = $result->fetch_assoc();
    $rating_id = $rating['id'];
  }
}
if($already_rated){
  $sql = "UPDATE rating SET stars='$stars', review='$rating_text', updated_at=now()
  WHERE id='$rating_id'";
} else {
  $sql = "INSERT INTO rating (stars, review, vendor_id, customer_id)
  VALUES ('$stars', '$rating_text', '$vendor_id', '$customer_id')";
}

$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  header('Location: ../client_orders_received.php');
}
 ?>
