<?php
function get_client_name($client_id){
  global $conn;
  $sql = "SELECT * FROM customer WHERE id=$client_id";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    if($result->num_rows > 0){
      while($customer = $result->fetch_assoc()){
        return $customer['firstname'].' '.$customer['lastname'];
      }
    }
  }
}

function get_delivered_items_count($client_id){
  global $conn;
  $sql = "SELECT * FROM cart_product, cart
  WHERE cart.id=cart_product.cart_id AND cart.customer_id='$client_id'
  AND cart_product.delivery_status='vendor_delivered'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}

function get_pending_items_count($client_id){
  global $conn;
  $sql = "SELECT * FROM cart_product, cart
  WHERE cart.id=cart_product.cart_id AND cart.customer_id='$client_id'
  AND cart_product.delivery_status='pending'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}

function get_received_items_count($client_id){
  global $conn;
  $sql = "SELECT * FROM cart_product, cart
  WHERE cart.id=cart_product.cart_id AND cart.customer_id='$client_id'
  AND cart_product.delivery_status='client_received'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}
 ?>
