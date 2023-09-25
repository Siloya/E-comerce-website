<?php
include ('database.php');
$email_phone = $_POST['email_phone'];
$password = $_POST['password'];
$sql="SELECT * FROM staff WHERE (email='$email_phone' OR tel='$email_phone') AND password='$password';";
$result = $conn->query($sql);

if (!$result) {
    echo $conn->error;
}

if ($result->num_rows > 0) {
  while($staff = $result->fetch_assoc()) {
    $_SESSION['staff_id'] =  $staff['id'];
  }
  $_SESSION['authentication_failed'] = false;
  header('Location: ../manage_vendors.php');
} else {
 $_SESSION['authentication_failed'] = true;
 $_SESSION['open_staff_login_modal'] = true;
 header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
