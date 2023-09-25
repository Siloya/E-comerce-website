<?php
include('database.php');
include_once('../functions/cart_functions.php');
include_once('../functions/image_functions.php');
$client_firstname = $_POST['firstname'];
$client_lastname = $_POST['lastname'];
$client_address = $_POST['address'];
$client_phone = $_POST['tel'];
$client_password = $_POST['password'];
$client_email = $_POST['email'];
$client_image = $_FILES['image'];
$url = save_client_image($client_image);
$sql = "SELECT * FROM customer WHERE email LIKE '$client_email' OR tel LIKE '$client_phone'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  if($result->num_rows > 0){
    $_SESSION['email_exists_client_registration'] = true;
    $_SESSION['client_registration_email'] = $client_email;
    $_SESSION['client_registration_phone'] = $client_phone;
    $_SESSION['client_registration_address'] = $client_address;
    $_SESSION['client_registration_firstname'] = $client_firstname;
    $_SESSION['client_registration_lastname'] = $client_lastname;
    $_SESSION['open_client_register_modal'] = true;
    header("Location: ".$_SERVER['HTTP_REFERER']);
    die();
  }
}

$sql = "INSERT INTO customer (firstname, lastname, email, tel, address, password, image)
VALUES ('$client_firstname', '$client_lastname', '$client_email', '$client_phone',
'$client_address', '$client_password', '$url');";

if ($conn->query($sql) === TRUE) {
  $client_id = $conn->insert_id;
  $_SESSION['client_id'] = $client_id;
  $_SESSION['authentication_failed'] = false;
  create_cart_if_not_exist();
 header('Location: ../all_categories.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

 ?>
