<?php
include_once('server/database.php');
include_once('functions/vendor_functions.php');
include_once('functions/conversation_functions.php');
?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
          <li class='nav-item'>
            <a class="nav-item nav-link" href="vendor_products.php"><i class="fas fa-th-list"></i> My Products</a>
          </li>
          <li class='nav-item'>
            <a class="nav-item nav-link" href="vendor_orders_pending.php"><i class="fas fa-people-carry"></i> My Orders</a>
          </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#">
          <img src="images/log1.jpeg" style="width: 70px">
          Matjar
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
              if(isset($_SESSION['vendor_id'])){
                  echo "<i class='flaticon-people'></i> (" .get_vendor_unread_messages_count($_SESSION['vendor_id']).") Hi, ".get_vendor_name($_SESSION['vendor_id']);
              }
              ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              if(isset($_SESSION['vendor_id'])){
                $vendor_id = $_SESSION['vendor_id'];
                echo
                "<a class='dropdown-item' href='vendor_profile.php?vendor_id=$vendor_id'>
                <i class='fa fa-id-card'></i> Profile
                </a>";
                echo "<div class='dropdown-divider'></div>";
                echo "<a class='dropdown-item' href='messages.php'> (".
                get_vendor_unread_messages_count($_SESSION['vendor_id'])
                .") Messages</a>";
                echo "<div class='dropdown-divider'></div>";
              }
               ?>
              <a class="dropdown-item" href="sign_out.php">
                <?php
                if(isset($_SESSION['vendor_id'])){
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
 