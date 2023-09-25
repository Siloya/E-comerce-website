<?php
include('database.php');
include_once('../functions/cart_functions.php');
create_cart_if_not_exist();
$cart_id = get_pending_cart_id();
$product_id = $_POST['product_id'];
$sql = "SELECT * FROM product WHERE id='$product_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  if($result->num_rows > 0){
    $product = $result->fetch_assoc();
  } else {
    echo "Product not found";
    die();
  }
}
if($product['request']){
  $delivery_status = 'requested';
} else {
  $delivery_status = 'pending';
}
$sql = "INSERT INTO cart_product (product_id, cart_id, client_ordered_date, delivery_status)
VALUES ('$product_id', '$cart_id', now(), '$delivery_status')";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

 ?>
