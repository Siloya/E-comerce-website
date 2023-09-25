<?php
include_once('server/database.php');
include_once('functions/staff_functions.php');
?>


<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
          <li class='nav-item'>
            <a class="nav-item nav-link" href="manage_vendors.php">
              <i class="fas fa-th-list"></i> Vendors
            </a>
          </li>
          <li class='nav-item'>
            <a class="nav-item nav-link" href="manage_customers.php">
              <i class="fas fa-th-list"></i> Customers
            </a>
          </li>
          <li class='nav-item'>
            <a class="nav-item nav-link" href="manage_products.php">
              <i class="fas fa-th-list"></i> Products
            </a>
          </li>
          <li class='nav-item'>
            <a class="nav-item nav-link" href="manage_categories.php">
              <i class="fas fa-th-list"></i> Categories
            </a>
          </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#">
          <img src="images/log1.jpeg" style="width: 70px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2" style="position: absolute; top: 10px; right: 0px;">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php
              if(isset($_SESSION['staff_id'])){
                  echo "<i class='flaticon-people'></i> Hi, ".get_staff_name($_SESSION['staff_id']);
              }
              ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="sign_out.php">
                <?php
                if(isset($_SESSION['staff_id'])){
                  echo "Sign Out";
                } else {
                  echo "Sign In";
                }
                 ?>

              </a>
            </div>
          </li>
        </ul>
    </div>
</nav>
  