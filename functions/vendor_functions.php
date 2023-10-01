<?php
function get_vendor_name($vendor_id){
  global $conn;
  $sql = "SELECT * FROM vendor WHERE id=$vendor_id";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    if($result->num_rows > 0){
      while($vendor = $result->fetch_assoc()){
        return $vendor['firstname'].' '.$vendor['lastname'];
      }
    }
  }
}

function get_delivered_items_count($vendor_id){
  global $conn;
  $sql = "SELECT * FROM cart_product, product, cart
  WHERE product.id=cart_product.product_id AND product.vendor_id='$vendor_id'
  AND cart_product.delivery_status='vendor_delivered' AND cart.status='checked_out'
  AND cart.id=cart_product.cart_id";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}

function get_pending_items_count($vendor_id){
  global $conn;
  $sql = "SELECT * FROM cart_product, product, cart
  WHERE product.id=cart_product.product_id AND product.vendor_id='$vendor_id'
  AND cart_product.delivery_status='pending' AND cart.status='checked_out'
  AND cart.id=cart_product.cart_id";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}


function get_received_items_count($vendor_id){
  global $conn;
  $sql = "SELECT * FROM cart_product, product, cart
  WHERE product.id=cart_product.product_id AND product.vendor_id='$vendor_id'
  AND cart_product.delivery_status='client_received' AND cart.status='checked_out'
  AND cart.id=cart_product.cart_id";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}


function get_requested_items_count($vendor_id){
  global $conn;
  $sql = "SELECT * FROM cart_product, product
  WHERE product.id=cart_product.product_id AND product.vendor_id='$vendor_id'
  AND cart_product.delivery_status='requested'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}


 ?>
