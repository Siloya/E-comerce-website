<?php
include('database.php');
include_once('../functions/image_functions.php');
include_once('../functions/security_functions.php');
staff_only();
$category_name = $_POST['category_name'];
$category_description = $_POST['category_description'];
$category_image = $_FILES['category_image'];

if(strlen($category_image['name'])>0){
  $url = save_category_image($category_image);
}

$category_id = $_POST['category_id'];


if(strlen($category_image['name'])>0){
  $sql = "UPDATE category SET
            name='$category_name',
            description='$category_description',
            image='$url' WHERE id='$category_id'";
} else {
  $sql = "UPDATE category SET
            name='$category_name',
            description='$category_description'
            WHERE id='$category_id'";
}

$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
  die();
} else {
  $_SESSION['category_saved'] = true;
  header('Location: ../manage_categories.php?id='.$category_id);
}
?>
