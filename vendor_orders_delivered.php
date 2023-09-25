<?php
include_once('server/database.php');
include_once('include/html_header.php');
include_once('include/vendor_bar.php');
require 'functions/carbon/autoload.php';
use Carbon\Carbon;
include_once('functions/security_functions.php');
no_suspended();

$vendor_id = $_SESSION['vendor_id'];
$sql = "SELECT product.name, customer.firstname, customer.lastname,
cart_product.quantity, cart_product.updated_at, cart_product.id, cart_product.product_id,
cart_product.vendor_delivered_date, cart_product.cart_id,cart.customer_id, product.request
FROM `product`, `cart_product`, `cart`, `customer`
WHERE product.id = cart_product.product_id AND cart.id = cart_product.cart_id
AND product.vendor_id = $vendor_id AND cart.status='checked_out'
AND customer.id = cart.customer_id AND cart_product.delivery_status = 'vendor_delivered'";
$result = $conn->query($sql);
if(!$result){
  echo $conn->error;
} else {
  $products = array();
  if($result->num_rows > 0){
    while($product = $result->fetch_assoc()){
      $products[] = $product;
    }
  }
}
 ?>
<div class="container">
  <h1>My Orders</h1>
  <hr>
  <ul class="nav nav-tabs" style="font-size: 80%;">
    <li class="nav-item">
      <a class="nav-link" href="vendor_orders_requested.php">Requests (<?php echo get_requested_items_count($_SESSION['vendor_id']) ?>)</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="vendor_orders_pending.php">Pending (<?php echo get_pending_items_count($_SESSION['vendor_id']) ?>)</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Delivered (<?php echo get_delivered_items_count($_SESSION['vendor_id']) ?>)</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="vendor_orders_received.php">Received (<?php echo get_received_items_count($_SESSION['vendor_id']) ?>)</a>
    </li>
  </ul>
  <br>
  <?php
    if(isset($_SESSION['product_marked_as_pending']) && $_SESSION['product_marked_as_pending']){
   ?>
    <div class="alert alert-warning" role="alert">
      This product has been reset as Pending.
    </div>
  <?php
    unset($_SESSION['product_marked_as_pending']);
  }
  ?>
  <?php
    if(isset($_SESSION['product_marked_as_pending']) && $_SESSION['product_marked_as_pending']==false){
   ?>
    <div class="alert alert-danger" role="alert">
      This product can't be reset as pending.
      You can only reset products within 5 minutes.
    </div>
  <?php
    unset($_SESSION['product_marked_as_pending']);
  }
  ?>
  <div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Client Name</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Order Date</th>
        <th scope="col">Delivered Date</th>
        <th scope="col" data-toggle="tooltip" data-placement="top"
        title="You only have 5 minutes to undo setting a product as delivered.">
          Action <i class="fa fa-question-circle"></i>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php for($i=0; $i<count($products); $i++){
                $product = $products[$i];
                $product_id = $product['product_id'];
                $delivered_date = new Carbon($product['vendor_delivered_date']);
                $now = Carbon::now();
                $canBeUndone = true;
                if($delivered_date->diffInMinutes($now)>=5){
                  $canBeUndone = false;
                }
      ?>
        <tr>
          <td><?php echo $product['id'] ?></td>
          <td>
            <a href="client_profile.php?client_id=<?php echo $product['customer_id'] ?>">
              <?php echo $product['firstname'].' '.$product['lastname']; ?>
            </a>
          </td>
          <td><a href="product.php?id=<?php echo $product_id ?>"><?php echo $product['name']; ?></a></td>
          <td>
            <?php
              if($product['request']){
                echo 'Available Upon Request';
              }
              else {
                echo $product['quantity'];
              }
            ?>
          </td>
          <td><?php echo $product['updated_at']; ?></td>
          <td><?php echo $product['vendor_delivered_date'] ?></td>
          <td>
            <?php if($canBeUndone){ ?>
            <form action="server/undo_product_delivered.php" method="post">
              <input type="hidden" name="cart_id" value="<?php echo $product['cart_id']; ?>">
              <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
              <button name="button" class="btn btn-warning">
                Reset as Pending
              </button>
            </form>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
</div>
 <?php
include_once('include/html_footer.php');
  ?>
