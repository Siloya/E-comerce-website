<?php
include_once('database.php');
$conversation_id = $_POST['conversation_id'];
$text = $_POST['text'];
if(isset($_SESSION['client_id'])){
  $user_id = $_SESSION['client_id'];
  $usertype = 'customer';
} else if(isset($_SESSION['vendor_id'])) {
  $user_id = $_SESSION['vendor_id'];
  $usertype = 'vendor';
} else if(isset($_SESSION['staff_id'])){
  $user_id = $_SESSION['staff_id'];
  $usertpe = 'staff';
}

$text = $conn->real_escape_string($text);
$sql = "INSERT INTO message (conversation_id, text, user_id, usertype)
        VALUES ('$conversation_id', '$text', '$user_id', '$usertype')";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
}

$sql = "SELECT * FROM message WHERE id='$conn->insert_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  if($result->num_rows > 0){
    $message = $result->fetch_assoc();
    header('Content-Type: application/json');
    echo json_encode($message);
  }
}
