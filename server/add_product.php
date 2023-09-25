<?php
include('database.php');
include_once('../functions/image_functions.php');
include_once('../functions/security_functions.php');
staff_and_vendors_only();
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_image = $_FILES['product_image'];
$url = save_product_image($product_image);
$product_price = $_POST['product_price'];
$product_quantity = $_POST['product_quantity'];
$product_category = $_POST['product_category'];
$product_request = $_POST['product_request'];
if($product_request == 'on'){
  $product_request = 1;
} else {
  $product_request = 0;
}
if(isset($_SESSION['vendor_id'])){
  $vendor_id = $_SESSION['vendor_id'];
} else if(isset($_SESSION['staff_id'])) {
  $vendor_id = $_POST['product_vendor'];
} else {
  die();
}

$sql = "INSERT INTO product (name, description, price, quantity, category_id, vendor_id, image, request)
        VALUES ('$product_name', '$product_description', '$product_price',
                '$product_quantity', '$product_category', '$vendor_id', '$url', '$product_request')";
$result = $conn->query($sql);
if(!$result){
  $conn->error;
} else {
  $_SESSION['product_added'] = true;
  if($_SESSION['staff_id']){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    die();
  }
  header('Location: ../vendor_products.php');
}
?>
