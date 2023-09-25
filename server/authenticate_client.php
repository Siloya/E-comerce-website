<?php
include ('database.php');
include_once('../functions/cart_functions.php');
$email_phone = $_POST['email_phone'];
$password = $_POST['password'];
$sql="SELECT * FROM customer WHERE (email='$email_phone' OR tel='$email_phone') AND password='$password';";
$result = $conn->query($sql);

if(!$result) {
  echo $conn->error;
}

if ($result->num_rows > 0) {
  while($client = $result->fetch_assoc()) {
    $_SESSION['client_id'] = $client['id'];
  }
  $_SESSION['authentication_failed'] = false;
  create_cart_if_not_exist();
  header('Location: ../all_categories.php');
} else {
  $_SESSION['authentication_failed'] = true;
  $_SESSION['open_client_login_modal'] = true;
  header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
