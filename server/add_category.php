<?php
include('database.php');
include_once('../functions/image_functions.php');
include_once('../functions/security_functions.php');
staff_and_vendors_only();
$category_name = $_POST['category_name'];
$category_description = $_POST['category_description'];
$category_image = $_FILES['category_image'];
$url = save_category_image($category_image);


$sql = "INSERT INTO category (name, description, image) VALUES ('$category_name', '$category_description', '$url')";
$result = $conn->query($sql);
if(!$result){
  $conn->error;
} else {
  $_SESSION['category_added'] = true;
  header('Location: ../manage_categories.php');
}
?>
