<?php
function create_cart_if_not_exist(){
  if(isset($_SESSION['client_id']) == false){
    return;
  }
  global $conn;
  $existing_pending_cart = false;
  $sql = "SELECT * FROM cart WHERE customer_id='".$_SESSION['client_id']."' AND status='pending';";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    if($result->num_rows > 0){
      while($cart = $result->fetch_assoc()) {
        $cart_id = $cart['id'];
      }
      $existing_pending_cart = true;

    }
  }
  if($existing_pending_cart == false ){
    $sql = "INSERT INTO cart (customer_id) VALUES (".$_SESSION['client_id'].")";
    $result = $conn->query($sql);
    if(!$result){
      echo $conn->error;
    } else {
      $cart_id = $conn->insert_id;
    }
  }
}

function get_pending_cart_id(){
  if(isset($_SESSION['client_id']) == false){
    return;
  }
  global $conn;
  $sql = "SELECT * FROM cart WHERE customer_id='".$_SESSION['client_id']."' AND status='pending'";
  $result_cart = $conn->query($sql);
  if(!$result_cart){
    echo $conn->error;
  } else {
    if($result_cart->num_rows > 0){
      while($cart = $result_cart->fetch_assoc()){
        return $cart['id'];
      }
    }
  }
}

function is_product_in_cart($cart_id, $product_id){
  global $conn;
  $product_in_cart = false;
  $sql = "SELECT * FROM cart_product WHERE cart_id='$cart_id' AND product_id='$product_id'";
  $result_cart = $conn->query($sql);
  if(!$result_cart){
    echo $conn->error;
  } else {
    if($result_cart->num_rows > 0){
      $product_in_cart = true;
    }
  }
  return $product_in_cart;
}
 ?>
