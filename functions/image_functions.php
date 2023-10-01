<?php

$PUBLIC_PATH = $_SERVER['DOCUMENT_ROOT'].'/matjar3/images/';
$PUBLIC_URL = 'http://192.168.0.101/matjar3/images/';

function save_vendor_image($file){
  global $PUBLIC_PATH;
  global $PUBLIC_URL;
  if($file['error'] > 0){
    echo $file['error'];
  } else {
    $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');
    $extUpload = strtolower( substr( strrchr($file['name'], '.') ,1));
    if(in_array($extUpload, $extsAllowed)){
      $destination = $PUBLIC_PATH.$file['name'];
      $url = "images/".$file['name'];
      $result = move_uploaded_file($file['tmp_name'], $destination);
      if(!$result){
        echo 'Upload error';
      }
      return $url;
    }
  }
}

function save_staff_image($file){
  global $PUBLIC_PATH;
  global $PUBLIC_URL;
  if($file['error'] > 0){
    echo 'error: '.$file['error'];
    die();
  } else {
    $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');
    $extUpload = strtolower( substr( strrchr($file['name'], '.') ,1));
    if(in_array($extUpload, $extsAllowed)){
      $destination = $PUBLIC_PATH.$file['name'];
      $url ="images/".$file['name'];
      $result = move_uploaded_file($file['tmp_name'], $destination);
      if(!$result){
        echo 'Upload error';
      }
      return $url;
    }
  }
}

function save_product_image($file){
  global $PUBLIC_PATH;
  global $PUBLIC_URL;
  if($file['error'] > 0){
    echo $file['error'];
  } else {
    $extsAllowed = array('jpg', 'jpeg', 'png', 'gif','jfif');
    $extUpload = strtolower( substr( strrchr($file['name'], '.') ,1));
    if(in_array($extUpload, $extsAllowed)){
      $destination = $PUBLIC_PATH.$file['name'];
      $url = "images/".$file['name'];
      $result = move_uploaded_file($file['tmp_name'], $destination);
      if(!$result){
        echo 'Upload error';
      }
      return $url;
    }
  }
}

function save_client_image($file){
  global $PUBLIC_PATH;
  global $PUBLIC_URL;
  if($file['error'] > 0){
    echo $file['error'];
  } else {
    $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');
    $extUpload = strtolower( substr( strrchr($file['name'], '.') ,1));
    if(in_array($extUpload, $extsAllowed)){
      $destination = $PUBLIC_PATH.$file['name'];
      $url ="images/".$file['name'];
      $result = move_uploaded_file($file['tmp_name'], $destination);
      if(!$result){
        echo 'Upload error';
      }
      return $url;
    }
  }
}

function save_category_image($file){
  global $PUBLIC_PATH;
  global $PUBLIC_URL;
  if($file['error'] > 0){
    echo $file['error'];
  } else {
    $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');
    $extUpload = strtolower( substr( strrchr($file['name'], '.') ,1));
    if(in_array($extUpload, $extsAllowed)){
      $destination = $PUBLIC_PATH.$file['name'];
      $url = "images/".$file['name'];
      $result = move_uploaded_file($file['tmp_name'], $destination);
      if(!$result){
        echo 'Upload error';
      }
      return $url;
    }
  }
}
  