<?php
include_once('server/database.php');
include_once('functions/cart_functions.php');
include_once('functions/client_functions.php');
include_once('functions/conversation_functions.php');
include_once('functions/category_functions.php');
$cart_id = get_pending_cart_id();
$result= get_active_categories_list();
$menu_categories = "";
if(!$result){
  echo $conn->error;
} else {
  if(sizeof($result) > 0){
    $max = 5;
    $i = 0;
    foreach ($result as $category) {
      $i++;
      if($i>$max){
        break;
      }
      $get_parameter = "id=".$category['id'];
      $menu_categories .= "<li class='nav-item'><a class='nav-item nav-link'
      href='category_home.php?".$get_parameter."'>".substr($category['name'], 0, strlen($category['name'])>11?11:strlen($category['name'])).'</a></li>';
    }
    $menu_categories .= "<li class='nav-item'><a class='nav-item nav-link'
    href='all_categories.php'>More...</a></li>";
  }
}

$cart_id = get_pending_cart_id();
$sql = "SELECT * FROM cart_product WHERE cart_id='$cart_id'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $cart_quantity = $result->num_rows;
}
?>


<nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
          <li class='nav-item'>
            <a class="nav-item nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i>(<?php echo $cart_quantity ?>)</a>
          </li>
          <?php echo $menu_categories ?>
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
          <li>
            <div class="input-group">
                <?php
                $current_url = $_SERVER['REQUEST_URI'];
                if(strpos($current_url, 'category_home')){
                ?>
                <form action="category_home.php" class="form-inline search-bar" method="get">
                  <?php if(isset($id)){ ?>
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <?php } ?>
                  <?php if(isset($_GET['search'])){ ?>
                    <input type="text" class="form-control search-bar float-left"
                    placeholder="Search" name="search" value="<?php echo $_GET['search'] ?>">
                  <?php } else { ?>
                    <input type="text" class="form-control"
                    placeholder="Search" name="search">
                  <?php } ?>
                  <div class="input-group-append float-right">
                    <button class="btn btn-outline-secondary search-btn" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </form>
                <?php
                  }
                ?>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php
              if(isset($_SESSION['client_id'])){
                if(get_delivered_items_count($_SESSION['client_id'])>0 || get_customer_unread_messages_count($_SESSION['client_id']) > 0){
                  echo "<i class='fa fa-user'></i> (".
                  (get_delivered_items_count($_SESSION['client_id']) + get_customer_unread_messages_count($_SESSION['client_id'])).
                  ") Hi, ".get_client_name($_SESSION['client_id']);
                } else {
                  echo "<i class='fa fa-user'></i> Hi, ".get_client_name($_SESSION['client_id']);
                }
              } else {
                echo "<i class='fa fa-user'></i> Hi, Guest";
              }
              ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              if(isset($_SESSION['client_id'])){
                $client_id=$_SESSION['client_id'];
                echo "<a class='dropdown-item' href='client_orders_pending.php'><i class='fa fa-list-ol'></i> ("
                .get_delivered_items_count($_SESSION['client_id']).
                ") My Orders</a>";
                echo "<div class='dropdown-divider'></div>";
                echo "<a class='dropdown-item' href='client_profile.php?client_id=$client_id'><i class='fa fa-id-card'></i> Profile</a>";
                echo "<div class='dropdown-divider'></div>";
                echo "<a class='dropdown-item' href='messages.php'> (".
                get_customer_unread_messages_count($_SESSION['client_id'])
                .") Messages</a>";
                echo "<div class='dropdown-divider'></div>";
              }
               ?>
            <?php  if(isset($_SESSION['client_id']) == false){ ?>
              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#signInModal" >
                Sign In
              </a>
            <?php }  else { ?>
              <a class="dropdown-item" href="sign_out.php">
                <i class='fa fa-sign-out-alt'></i> Sign Out
              </a>
            <?php  } ?>
          </div>
          </li>
        </ul>
    </div>
</nav>

<?php include_once('authenticate_modals.php'); ?>
 