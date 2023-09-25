<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Matjar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/conversate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
    body {
      <?php/*
        if(isset($_SESSION['vendor_id'])){
            echo "background-image: url('public/background_photos/vendor.png');";
            echo "background-size: cover;";
        } else if(isset($_SESSION['staff_id'])){
          echo "background-image: url('public/background_photos/admin.png');";
          echo "background-size: cover;";
        } else {
          echo "background-image: url('public/background_photos/client.png');";
          echo "background-size: contain;";
        }*/
       ?>
    }
    </style>

    <link rel="stylesheet" href="css/jquery-chat.css">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
  </head>
  <body>
 