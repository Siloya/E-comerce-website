<?php
include ('database.php');
include_once('../functions/cart_functions.php');
$email_phone = $_POST['email_phone'];
$password = $_POST['password'];
$sql="SELECT * FROM vendor WHERE (email='$email_phone' OR tel='$email_phone') AND password='$password';";
$result = $conn->query($sql);

if (!$result) {
    echo $conn->error;
}

if ($result->num_rows > 0) {
  while($vendor = $result->fetch_assoc()) {
    $_SESSION['vendor_id'] =  $vendor['id'];
  }
  $_SESSION['authentication_failed'] = false;
  header('Location: ../vendor_products.php');
} else {
 $_SESSION['authentication_failed'] = true;
 $_SESSION['open_vendor_login_modal'] = true;
 header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
