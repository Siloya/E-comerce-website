<?php
include('database.php');
include_once('../functions/image_functions.php');
$vendor_firstname = $_POST['firstname'];
$vendor_lastname = $_POST['lastname'];
$vendor_address = $_POST['address'];
$vendor_phone = $_POST['tel'];
$vendor_password = $_POST['password'];
$vendor_email = $_POST['email'];
$vendor_image = $_FILES['image'];
$url = save_vendor_image($vendor_image);
$vendor_description= $_POST['description'];
$target_file = '/../user_files/vendor_photos/' . basename($_FILES["image"]["name"]);
move_uploaded_file($vendor_image["tmp_name"], $target_file);

$sql = "SELECT * FROM vendor WHERE email LIKE '$vendor_email' OR tel LIKE '$vendor_phone'";
echo $sql;
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  if($result->num_rows > 0){
    $_SESSION['email_exists_vendor_registration'] = true;
    $_SESSION['vendor_registration_email'] = $vendor_email;
    $_SESSION['vendor_registration_phone'] = $vendor_phone;
    $_SESSION['vendor_registration_address'] = $vendor_address;
    $_SESSION['vendor_registration_firstname'] = $vendor_firstname;
    $_SESSION['vendor_registration_lastname'] = $vendor_lastname;
    $_SESSION['vendor_registration_description'] = $vendor_description;
    $_SESSION['open_vendor_register_modal'] = true;
    header("Location: ".$_SERVER['HTTP_REFERER']);
    die();
  }
}

if(strlen($vendor_image['name'])>0){
  $sql = "INSERT INTO vendor (firstname, lastname, email, tel, address, password, image, description)
  VALUES ('$vendor_firstname', '$vendor_lastname', '$vendor_email', '$vendor_phone',
  '$vendor_address', '$vendor_password', '$url','$vendor_description');";
} else {
  $sql = "INSERT INTO vendor (firstname, lastname, email, tel, address, password, description)
  VALUES ('$vendor_firstname', '$vendor_lastname', '$vendor_email', '$vendor_phone',
  '$vendor_address', '$vendor_password','$vendor_description');";
}


if ($conn->query($sql) === TRUE) {
  $vendor_id = $conn->insert_id;
  $_SESSION['vendor_id'] =  $vendor_id;
  $_SESSION['authentication_failed'] = false;
  header('Location: ../vendor_products.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

 ?>
