<?php
$message =
'<div class="alert alert-danger" role="alert">
  You are not allowed to access this page.
</div>';

function clients_only(){
  global $message;
  if(isset($_SESSION['client_id']) == false){
    echo $message;
    die();
  }
}

function vendor_author_only($vendor_id){
  global $message;
  if(isset($_SESSION['vendor_id']) == false || $_SESSION['vendor_id']!=$vendor_id){
    echo $message;
    die();
  }
}

function staff_only(){
  global $message;
  if(isset($_SESSION['staff_id']) == false){
    echo $message;
    die();
  }
}

function no_suspended(){
  global $conn;
  if(isset($_SESSION['client_id'])){
    $client_id = $_SESSION['client_id'];
    $sql = "SELECT * FROM customer WHERE id='$client_id'";
    $result = $conn->query($sql);
    if(!$result){
      echo $conn->error;
      die();
    } else {
      if($result->num_rows>0){
        $customer = $result->fetch_assoc();
        if($customer['active'] == false){
          $sql = "SELECT email from staff where id=1";
          $result = $conn->query($sql);
          if(!$result){
            echo $conn->error;
            die();
          }else {
          if($result->num_rows>0){
            $staff=$result->fetch_assoc();
            $email=$staff['email'];
          }

          }
          echo '<div class="alert alert-danger" role="alert">
                    Your account is suspended :(<br>
                    <a href="mailto:'.$email.'">Contact Us</a> to restore your account.<br>
                    <a href="sign_out.php">Sign Out</a>
                  </div>';
          die();
        }
      }
    }
  } else if(isset($_SESSION['vendor_id'])){
    $vendor_id = $_SESSION['vendor_id'];
    $sql = "SELECT * FROM vendor WHERE id='$vendor_id'";
    $result = $conn->query($sql);
    if(!$result){
      echo $conn->error;
      die();
    } else {
      if($result->num_rows>0){
        $vendor = $result->fetch_assoc();
        if($vendor['active'] == false){
          $sql = "SELECT email from staff where id=1";
          $result = $conn->query($sql);
          if(!$result){
            echo $conn->error;
            die();
          }else {
          if($result->num_rows>0){
            $staff=$result->fetch_assoc();
            $email=$staff['email'];
          }

          }
            echo '<div class="alert alert-danger" role="alert">
                    Your account is suspended :(<br>
                    <a href="mailto:'.$email.'">Contact Us</a> to restore your account.<br>
                    <a href="sign_out.php">Sign Out</a>
                  </div>';
          die();
        }
      }
    }
  }
}

function staff_and_vendors_only(){
    global $message;
  if((isset($_SESSION['staff_id']) || isset($_SESSION['vendor_id']))==false){
    echo $message;
    die();
  }
}

function chatters_only($conversation_id){
  global $conn;
  global $message;
  $sql = "SELECT * FROM conversation WHERE id='$conversation_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    if($result->num_rows > 0){
      $conversation = $result->fetch_assoc();
      if(isset($_SESSION['client_id'])){
        if(!($conversation['user_1_type'] == 'customer'
        && $conversation['user_1']==$_SESSION['client_id'])
        && !($conversation['user_2_type'] == 'customer'
          && $conversation['user_2']==$_SESSION['client_id'])){
          echo $message;
          die();
        }
      } else if (isset($_SESSION['vendor_id'])){
        if(!($conversation['user_1_type'] == 'vendor'
        && $conversation['user_1']==$_SESSION['vendor_id'])
        && !($conversation['user_2_type'] == 'vendor'
          && $conversation['user_2']==$_SESSION['vendor_id'])){
          echo $message;
          die();
        }
      } else if(isset($_SESSION['staff_id'])){
        if(!($conversation['user_1_type'] == 'staff'
        && $conversation['user_1']==$_SESSION['staff_id'])
        && !($conversation['user_2_type'] == 'staff'
          && $conversation['user_2']==$_SESSION['staff_id'])){
          echo $message;
          die();
        }
      }
    }
  }

}
 ?>
 