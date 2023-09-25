<?php
include ('database.php');
include_once('../functions/cart_functions.php');
$cart_id = get_pending_cart_id();

$product_ids = $_POST['product_id'];

for($i = 0; $i < count($product_ids); $i++){
  $product_id = $product_ids[$i];
  $sql = "SELECT cart_product.delivery_status, product.request
  FROM cart_product, product WHERE product_id='$product_id' AND cart_id='$cart_id'
  AND cart_product.product_id = product.id";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    if($result->num_rows > 0){
      $cart_product = $result->fetch_assoc();
      if($cart_product['delivery_status']=='requested' && $cart_product['request']){
        $_SESSION['cart_requests_pending'] = true;
        header("Location: ../cart.php");
        die();
      }
    }
  }
}

$product_quantities = $_POST['product_quantity'];
$_SESSION['product_names'] = ''; //product which don't have enough quantity

for($i = 0; $i < count($product_ids); $i++){
  $sql = "UPDATE cart_product SET quantity='$product_quantities[$i]' WHERE product_id='$product_ids[$i]' AND cart_id='$cart_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  }

  $sql = "SELECT * FROM product WHERE id='$product_ids[$i]'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    if($result->num_rows > 0){
      while($product = $result->fetch_assoc()){
        $product_quantity = $product['quantity'];
        $product_name = $product['name'];
        $product_initial_quantity = $product['quantity'];
      }
    }
  }

  $product_quantity = $product_quantity - $product_quantities[$i];
  if($product_quantity < 0){
    $_SESSION['checked_out'] = false;
    $_SESSION['product_names'] .= " $product_name, ";
    $_SESSION['product_quantities'] .= " $product_initial_quantity, ";
  } else {
    $sql = "UPDATE product SET quantity='$product_quantity' WHERE id='$product_ids[$i]'";
    $result = $conn->query($sql);
    if(!$result){
      echo $conn->error;
    }
  }
}

if(isset($_SESSION['checked_out']) && $_SESSION['checked_out']==false){
  header('Location: ../cart.php');
  die();
}

$sql = "UPDATE cart SET status='checked_out' WHERE customer_id = '".$_SESSION['client_id']."' AND status='pending'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $_SESSION['checked_out'] = true;
  header('Location: ' . '../cart_success.php');
}


 ?>
