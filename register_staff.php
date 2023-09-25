<?php include('include/html_header.php')
?>
<div class="container">
  <h1 class="text-primary" >Staff Registration</h1>
  <hr>
  <?php
  if(isset($_SESSION['email_exists_staff_registration'])) {
   ?>
  <div class="alert alert-danger" role="alert">
    This email is already in use by another user!
  </div>
  <?php
  unset($_SESSION['email_exists_staff_registration']);
  }
   ?>
  <form  action="server/add_staff_to_database.php" enctype="multipart/form-data" method="post">
    <div class="form-group">
       <label for="email">Email address*</label>
       <input value="<?php echo isset($_SESSION['staff_registration_email'])?$_SESSION['staff_registration_email']:''; ?>" type="email" class="form-control" id="email" placeholder="Enter email"  name="email" required>
     </div>
     <div class="form-group">
        <label for="phone">Phone number*</label>
        <input value="<?php echo isset($_SESSION['staff_registration_phone'])?$_SESSION['staff_registration_phone']:''; ?>" type="text" class="form-control" id="phone" placeholder="Your Phone Number"  name="tel" required>
      </div>
      <div class="form-group">
         <label for="first-name">First name*</label>
         <input value="<?php echo isset($_SESSION['staff_registration_firstname'])?$_SESSION['staff_registration_firstname']:''; ?>" type="text" class="form-control" id="first-name" placeholder="Your name" name="firstname" required>
      </div>
      <div class="form-group">
         <label for="last-name">Last name*</label>
         <input value="<?php echo isset($_SESSION['staff_registration_lastname'])?$_SESSION['staff_registration_lastname']:''; ?>" type="text" class="form-control" id="last-name" placeholder="Your last name"  name="lastname" required>
      </div>
     <div class="form-group">
       <label for="password">Password*</label>
       <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
     </div>
     <div class="form-group">
       <label for="passwordconfirm">Password confirm*</label>
       <input type="password" class="form-control" id="passwordconfirm" placeholder="Password Confirm" name="passwordconfirm" required>
     </div>
     <div class="form-group">
       <label for="image">Your Photo</label>
       <input type="file" class="form-control" id="image" name="image">
     </div>
     <button type="submit" id="register-button" class="btn btn-primary">Register</button>
  </form>
</div>
<script type="text/javascript">
  $("#register-button").on("click", function checkPassword(evt){
      var password = $('#password').val();
      var confirmPassword = $('#passwordconfirm').val();
      if(password!=confirmPassword){
        alert("Your password doesn't match.");
      }
  });

</script>
<?php include('include/html_footer.php')
?>
