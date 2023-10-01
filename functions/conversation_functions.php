<?php
require 'functions/carbon/autoload.php';
use Carbon\Carbon;

function get_conversations_for_vendor($vendor_id){
  global $conn;
  $conversations = array();
  $sql = "SELECT * FROM conversation WHERE (user_1_type LIKE 'vendor' AND user_1='$vendor_id')
  OR (user_2_type LIKE 'vendor' AND user_2='$vendor_id')";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    if($result->num_rows>0){
      while($conversation = $result->fetch_assoc()){
        $conversations[] = $conversation;
      }
    }
  }
  return $conversations;
}

function get_conversation_vendor($conversation){
  global $conn;
  if($conversation['user_1_type'] == 'vendor'){
    $user_1 = $conversation['user_1'];
    $sql = "SELECT * FROM vendor WHERE id='$user_1'";
  } else {
    $user_2 = $conversation['user_2'];
    $sql = "SELECT * FROM vendor WHERE id='$user_2'";
  }
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    $vendor = $result->fetch_assoc();
    return $vendor;
  }
}

function get_conversation_customer($conversation){
  global $conn;
  if($conversation['user_1_type'] == 'customer'){
    $user_1 = $conversation['user_1'];
    $sql = "SELECT * FROM customer WHERE id='$user_1'";
  } else {
    $user_2 = $conversation['user_2'];
    $sql = "SELECT * FROM customer WHERE id='$user_2'";
  }
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    $customer = $result->fetch_assoc();
    return $customer;
  }
}

function get_last_message($conversation_id){
  global $conn;
  $sql = "SELECT *, max(created_at) as ca FROM message WHERE conversation_id='$conversation_id' ORDER BY 'created_at' ASC LIMIT 1";
  $message = null;
  $result = $conn->query($sql);
  if(!$result){
    echo  $conn->error;
    die();
  } else {
    if($result->num_rows>0){
      $message = $result->fetch_assoc();
    }
  }
  return $message;
}

function get_conversations_for_customer($customer_id){
  global $conn;
  $conversations = array();
  $sql = "SELECT * FROM conversation WHERE (user_1_type LIKE 'customer' AND user_1='$customer_id')
  OR (user_2_type LIKE 'customer' AND user_2='$customer_id')";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    if($result->num_rows>0){
      while($conversation = $result->fetch_assoc()){
        $conversations[] = $conversation;
      }
    }
  }
  return $conversations;
}

function update_vendor_last_access_to_messages($vendor_id){
    global $conn;
  $sql = "UPDATE vendor SET last_access_to_messages=now() WHERE id='$vendor_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  }
}

function update_customer_last_access_to_messages($customer_id){
  global $conn;
  $sql = "UPDATE customer SET last_access_to_messages=now() WHERE id='$customer_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  }
}

function get_vendor_unread_messages_count($vendor_id){
  global $conn;
  $sql = "SELECT * FROM vendor WHERE id='$vendor_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    $vendor = $result->fetch_assoc();
  }
  $conversations = get_conversations_for_vendor($vendor_id);
  $unread = 0;
  for($i=0; $i < count($conversations); $i++){
    $conversation = $conversations[$i];
    $last_message_string = get_last_message($conversation['id']);
    $last_message_date = new Carbon($last_message_string['ca']);
    $vendor_last_access_to_messages_string = $vendor['last_access_to_messages'];
    $vendor_last_access_to_messages_date = new Carbon($vendor_last_access_to_messages_string);
    if($last_message_date > $vendor_last_access_to_messages_date){
      $unread++;
    }
  }
  return $unread;
}
function get_customer_unread_messages_count($customer_id){
  global $conn;
  $sql = "SELECT * FROM customer WHERE id='$customer_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    $customer = $result->fetch_assoc();
  }
  $conversations = get_conversations_for_customer($customer_id);
  $unread = 0;
  for($i=0; $i < count($conversations); $i++){
    $conversation = $conversations[$i];
    $last_message_string = get_last_message($conversation['id']);
    $last_message_date = new Carbon($last_message_string['ca']);
    $customer_last_access_to_messages_string = $customer['last_access_to_messages'];
    $customer_last_access_to_messages_date = new Carbon($customer_last_access_to_messages_string);
    if($last_message_date > $customer_last_access_to_messages_date){
      $unread++;
    }
  }
  return $unread;
}
 ?>
