<div class="container">
  <h1 class="text-primary" >Vendor Registration</h1>
  <hr>
  <?php
  if(isset($_SESSION['email_exists_vendor_registration'])) {
   ?>
  <div class="alert alert-danger" role="alert">
    This email is already in use by another user!
  </div>
  <?php
  unset($_SESSION['email_exists_vendor_registration']);
  }
   ?>
  <form  action="server/add_vendor_to_database.php" enctype="multipart/form-data" method="post">
    <div class="form-group">
       <label for="email">Email address*</label>
       <input value="<?php echo isset($_SESSION['vendor_registration_email'])?$_SESSION['vendor_registration_email']:''; ?>" type="email" class="form-control" id="email" placeholder="Enter email"  name="email" required>
     </div>
     <div class="form-group">
        <label for="phone">Phone number*</label>
        <input value="<?php echo isset($_SESSION['vendor_registration_phone'])?$_SESSION['vendor_registration_phone']:''; ?>" type="text" class="form-control" id="phone" placeholder="Your Phone Number"  name="tel" required>
      </div>
      <div class="form-group">
         <label for="first-name">First name*</label>
         <input value="<?php echo isset($_SESSION['vendor_registration_firstname'])?$_SESSION['vendor_registration_firstname']:''; ?>" type="text" class="form-control" id="first-name" placeholder="Your name" name="firstname" required>
      </div>
      <div class="form-group">
         <label for="last-name">Last name*</label>
         <input value="<?php echo isset($_SESSION['vendor_registration_lastname'])?$_SESSION['vendor_registration_lastname']:''; ?>" type="text" class="form-control" id="last-name" placeholder="Your last name"  name="lastname" required>
      </div>
      <div class="form-group">
         <label for="address">Address*</label>
         <input value="<?php echo isset($_SESSION['vendor_registration_address'])?$_SESSION['vendor_registration_address']:''; ?>" type="text" class="form-control" id="address" placeholder="Your address"  name="address" required>
      </div>
     <div class="form-group">
       <label for="description">Description</label>
       <input value="<?php echo isset($_SESSION['vendor_registration_description'])?$_SESSION['vendor_registration_description']:''; ?>" type="text" class="form-control" id="description" placeholder="description" name="description">
     </div>
     <div class="form-group">
       <label for="password">Password*</label>
       <input type="password" class="form-control" id="vendor-register-password" placeholder="Password" name="password" required>
     </div>
     <div class="form-group">
       <label for="passwordconfirm">Password confirm*</label>
       <input type="password" class="form-control" id="vendor-register-passwordconfirm" placeholder="Password Confirm" name="passwordconfirm" required>
     </div>
     <div class="form-group">
       <label for="image">Your Photo</label>
       <input type="file" class="form-control" id="image" name="image">
     </div>
     <button type="submit" id="vendor-register-button" class="btn btn-primary">Register</button>
  </form>
</div>
<script type="text/javascript">
  $("#vendor-register-button").on("click", function checkPassword(evt){
      var vendorPassword = $('#vendor-register-password').val();
      var vendorConfirmPassword = $('#vendor-register-passwordconfirm').val();
      if(vendorPassword!=vendorConfirmPassword){
        alert("Your password doesn't match.");
      }
  });

</script>
