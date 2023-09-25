<?php
include('database.php');
include_once('../functions/image_functions.php');
include_once('../functions/security_functions.php');
staff_and_vendors_only();
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_image = $_FILES['product_image'];

if(strlen($product_image['name'])>0){
  $url = save_product_image($product_image);
}

$product_price = $_POST['product_price'];
$product_quantity = $_POST['product_quantity'];
$product_category = $_POST['product_category'];
$product_id = $_POST['product_id'];
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

if(strlen($product_image['name'])>0){
  $sql = "UPDATE product SET
            name='$product_name',
            description='$product_description',
            price='$product_price',
            quantity='$product_quantity',
            category_id='$product_category',
            vendor_id='$vendor_id',
            request='$product_request',
            image='$url' WHERE id='$product_id'";
} else {
  $sql = "UPDATE product SET
            name='$product_name',
            description='$product_description',
            price='$product_price',
            quantity='$product_quantity',
            category_id='$product_category',
            request='$product_request',
            vendor_id='$vendor_id' WHERE id='$product_id'";
}

$result = $conn->query($sql);
if(!$result){
  $conn->error;
} else {
  $_SESSION['product_saved'] = true;
  header('Location: ../product.php?id='.$product_id);
}
?>
