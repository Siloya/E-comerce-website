<div class="container">
      <h1 class="text-primary" >Client Registration</h1>
      <hr>
      <?php
      if(isset($_SESSION['email_exists_client_registration'])) {
       ?>
      <div class="alert alert-danger" role="alert">
        This email is already in use by another user!
      </div>
      <?php
      unset($_SESSION['email_exists_client_registration']);
      }
       ?>
      <form  action="server/add_client_to_database.php" enctype="multipart/form-data" method="post">
        <div class="form-group">
           <label for="email">Email address*</label>
           <input value="<?php echo isset($_SESSION['client_registration_email'])?$_SESSION['client_registration_email']:''; ?>" type="email" class="form-control" id="email" placeholder="Enter email"  name="email"required>
         </div>
         <div class="form-group">
            <label for="phone">Phone number*</label>
            <input value="<?php echo isset($_SESSION['client_registration_phone'])?$_SESSION['client_registration_phone']:''; ?>" type="text" class="form-control" id="phone" placeholder="Your Phone Number"  name="tel"required>
          </div>
          <div class="form-group">
             <label for="first-name">First name*</label>
             <input value="<?php echo isset($_SESSION['client_registration_firstname'])?$_SESSION['client_registration_firstname']:''; ?>" type="text" class="form-control" id="first-name" placeholder="Your name" name="firstname"required>
          </div>
          <div class="form-group">
             <label for="last-name">Last name*</label>
             <input value="<?php echo isset($_SESSION['client_registration_lastname'])?$_SESSION['client_registration_lastname']:'';?>" type="text" class="form-control" id="last-name" placeholder="Your last name"  name="lastname"required>
          </div>
          <div class="form-group">
             <label for="address">Address*</label>
             <input value="<?php echo isset($_SESSION['client_registration_address'])?$_SESSION['client_registration_address']:''; ?>" type="text" class="form-control" id="address" placeholder="Your address"  name="address"required>
          </div>
         <div class="form-group">
           <label for="password">Password*</label>
           <input type="password" class="form-control" id="client-register-password" placeholder="Password" name="password"required>
         </div>
         <div class="form-group">
           <label for="passwordconfirm">Password confirm*</label>
           <input type="password" class="form-control" id="client-register-passwordconfirm" placeholder="Password Confirm" name="passwordconfirm"required>
         </div>
         <div class="form-group">
           <label for="image">Your Photo</label>
           <input type="file" class="form-control" id="image" name="image">
         </div>
         <button type="submit" id="client-register-button" class="btn btn-primary">Register</button>
      </form>
    </div>
<script type="text/javascript">
    $("#client-register-button").on("click", function checkPassword(evt){
     var clientPassword = $('#client-register-password').val();
     var clientConfirmPassword = $('#client-register-passwordconfirm').val();
    if(clientPassword!=clientConfirmPassword){
      alert("Your password dosen't match");
      evt.preventDefault();
    }
  });
  </script>
