<?php
include('database.php');
include_once('../functions/image_functions.php');
$staff_firstname = $_POST['firstname'];
$staff_lastname = $_POST['lastname'];
$staff_phone = $_POST['tel'];
$staff_password = $_POST['password'];
$staff_email = $_POST['email'];
$staff_image = $_FILES['image'];
$url = save_staff_image($staff_image);
$staff_description= $_POST['description'];
$target_file = '/../user_files/staff_photos/' . basename($_FILES["image"]["name"]);
move_uploaded_file($staff_image["tmp_name"], $target_file);

$sql = "SELECT * FROM staff WHERE email LIKE '$staff_email' OR tel LIKE '$staff_phone'";
echo $sql;
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  if($result->num_rows > 0){
    $_SESSION['email_exists_staff_registration'] = true;
    $_SESSION['staff_registration_email'] = $staff_email;
    $_SESSION['staff_registration_phone'] = $staff_phone;
    $_SESSION['staff_registration_firstname'] = $staff_firstname;
    $_SESSION['staff_registration_lastname'] = $staff_lastname;
    header("Location: ../register_staff.php");
    die();
  }
}

if(strlen($staff_image['name'])>0){
  $sql = "INSERT INTO staff (firstname, lastname, email, tel, password, image)
  VALUES ('$staff_firstname', '$staff_lastname', '$staff_email', '$staff_phone',
    '$staff_password', '$url');";
} else {
  $sql = "INSERT INTO staff (firstname, lastname, email, tel, password)
  VALUES ('$staff_firstname', '$staff_lastname', '$staff_email', '$staff_phone',
          '$staff_password');";
}


if ($conn->query($sql) === TRUE) {
  $staff_id = $conn->insert_id;
  $_SESSION['staff_id'] =  $staff_id;
  $_SESSION['authentication_failed'] = false;
  header('Location: ../manage_vendors.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

 ?>
