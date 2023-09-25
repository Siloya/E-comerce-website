<?php
include_once('database.php');
$user_1 = $_POST['user_1'];
$user_1_type = $_POST['user_1_type'];
$user_2 = $_POST['user_2'];
$user_2_type = $_POST['user_2_type'];

$sql = "SELECT * FROM conversation WHERE (user_1='$user_1'
AND user_1_type='$user_1_type' AND user_2='$user_2'
AND user_2_type='$user_2_type') OR (user_2='$user_1'
AND user_2_type='$user_1_type' AND user_1='$user_2'
AND user_1_type='$user_2_type')";

$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  if($result->num_rows>0) {
    $conversation = $result->fetch_assoc();
  }
}
if(!$conversation){
  $sql = "INSERT INTO conversation
          (created_at, updated_at, user_1, user_1_type, user_2, user_2_type)
          VALUES (now(), now(), '$user_1', '$user_1_type', '$user_2',
          '$user_2_type')";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  }
}
if($conn->insert_id > 0){
  header('Location: ../chat.php?conversation_id='.$conn->insert_id);
} else {
    header('Location: ../chat.php?conversation_id='.$conversation['id']);
}


?>
