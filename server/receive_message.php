<?php
include_once('database.php');
$last_received_id = $_GET['last_received_id'];
$conversation_id = $_GET['conversation_id'];

$sql = "SELECT * FROM message WHERE id > $last_received_id
        AND conversation_id = $conversation_id";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $messages = array();
  if($result->num_rows > 0){
    while($message = $result->fetch_assoc()){
      $messages[] = $message;
    }
    header('Content-Type: application/json');
    echo json_encode($messages);
  }
}

?>
