
<?php

// if (@$_SESSION['from']==""){
//   message("Please Choose check in Date and Check out Out date to continue reservation!", "error");
//   redirect(WEB_ROOT.'index.php?page=5');
 
// }
// if (@$_SESSION['to']==""){
//   message("Please Choose check in Date and Check out Out date to continue reservation!", "error");
//   redirect(WEB_ROOT.'index.php?page=5');
// }


//   $arrival = $_SESSION['from']; 
//  $departure = $_SESSION['to'];


 /*if(!isset($_POST['adults'])){
    message("Choose from Adults!", "error");  
    redirect(".WEB_ROOT. 'booking/");
    //exit;
 }*/
 /* if(isset($_POST['adults'])&&isset($_POST['child'])){
    $_SESSION['roomid']=$_POST['roomid'];
  $_SESSION['adults'] = $_POST['adults'];
  $_SESSION['child']  = $_POST['child'];
   */

if(isset($_GET['id'])){
    removetocart($_GET['id']);
}

 
 if (isset($_POST['clear'])){
   unset($_SESSION['pay']);
   unset($_SESSION['monbela_cart']);
   message("The cart is empty.","success");
  redirect(WEB_ROOT."booking/");

 }

 function displayModal($message) {
    echo '
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ' . $message . '
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#messageModal").modal("show");
        });
    </script>';
}

 
 
?>
<div id="modern-accom-title" class="container d-flex justify-content-center align-items-center vh-100">
    <div class="custom-pagetitle text-center">
        <h1 class="custom-heading">Your Booking Cart</h1>
    </div>
</div>

<style>
    /* Add any additional custom styles here */
    #modern-accom-title {
        background-color: #6d4330; /* Set background color to black */
    }

    .custom-pagetitle {
        padding: 20px; /* Add custom padding */
        border-radius: 10px; /* Add border-radius for rounded corners */
    }

    .custom-heading {
        color: #ffffff; /* Set text color to black */
    }
</style>



<div id="bread">
   <ol class="breadcrumb">
      <li><a href="<?php echo WEB_ROOT ;?>index.php">Home</a>
      </li>
      <li class="active">Booking Cart</li>
      <!-- <li  style="color: #02aace; float:right"> <?php print  $msg; ?></li> -->
  </ol> 
</div>

 
          <table class="table table-hover">

             <thead>
              <tr  bgcolor="#999999">
              <!-- <th width="10">#</th> -->
              <th align="center" width="120">Room</th>
              <th align="center" width="120">Check In</th>
              <th align="center" width="120">Check Out</th> 
              <th  width="120">Price</th> 
              <th align="center" width="120">Nights</th>
              <th align="center" width="90">Amount</th>
              <th align="center" width="90">Action</th> 
            </tr> 
          </thead>
          <tbody>
          <?php

$payable = 0;
$discount_amount = 0; // Initialize the discount amount

if (isset($_SESSION['monbela_cart'])) {
  $payable = 0;
  $count_cart = count($_SESSION['monbela_cart']);

  for ($i = 0; $i < $count_cart; $i++) {
      $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND ROOMID=" . $_SESSION['monbela_cart'][$i]['monbelaroomid'];
      $mydb->setQuery($query);
      $cur = $mydb->loadResultList();

      foreach ($cur as $result) {
          echo '<tr>';
          echo '<td>' . $result->ROOM . ' ' . $result->ROOMDESC . ' </td>';
          echo '<td>' . date_format(date_create($_SESSION['monbela_cart'][$i]['monbelacheckin']), "m/d/Y") . '</td>';
          echo '<td>' . date_format(date_create($_SESSION['monbela_cart'][$i]['monbelacheckout']), "m/d/Y") . '</td>';
          echo '<td > &#8369 ' . $result->PRICE . '</td>';
          echo '<td>' . $_SESSION['monbela_cart'][$i]['monbeladay'] . '</td>';
          echo '<td > &#8369 ' . $_SESSION['monbela_cart'][$i]['monbelaroomprice'] . '</td>';
          echo '<td ><a href="index.php?view=processcart&id=' . $result->ROOMID . '">Remove</td>';
      }

      $payable += $_SESSION['monbela_cart'][$i]['monbelaroomprice'];
  }

  // Apply coupon code if submitted
if (isset($_POST['apply_coupon'])) {
  $coupon_code = $_POST['coupon_code'];
  $user_id = $_SESSION['GUESTID'];

  // Check if the coupon has already been used by the user
$query_check_used = "SELECT * FROM `tblcoupon_usage` WHERE COUPON_CODE = '$coupon_code' AND GUEST_ID = $user_id";
$mydb->setQuery($query_check_used);
$used_result = $mydb->loadSingleResult();


  if ($used_result) {
      // Coupon has already been used by this user
      echo '<script>alert("Coupon has already been used by this user.")</script>';
  } else {
      // Check if the coupon is valid and has remaining usage
      $query = "SELECT * FROM `tblcoupon` WHERE COUPON_CODE = '$coupon_code' AND MAX_USAGE > 0";
      $mydb->setQuery($query);
      $coupon_result = $mydb->loadSingleResult();

      if ($coupon_result && property_exists($coupon_result, 'DISCOUNT')) {
          echo '<script>alert("Valid coupon code. Discount applied!")</script>';
          $decimal_discount = $coupon_result->DISCOUNT;
          $decimal_discount = max(0, min($decimal_discount, 1));

          // Calculate the discounted amount
          $discounted_amount = $decimal_discount * $payable;

          // Update the discount_amount
          $discount_amount = $discounted_amount;

          // Apply the discount to the total without multiplying it by the total amount
          $payable -= $discounted_amount;

          // Ensure the total does not go below zero
          $payable = max(0, $payable);

          // Update applied_coupon with the actual coupon object
          $_SESSION['applied_coupon'] = $coupon_result;

          // Update tblcoupon to decrement MAX_USAGE
          $sql = "UPDATE `tblcoupon` SET MAX_USAGE = MAX_USAGE - 1 WHERE COUPON_CODE = '$coupon_code'";
          $mydb->setQuery($sql);
          $msg = $mydb->executeQuery();

          // Record coupon usage for the user
          $sql = "INSERT INTO `tblcoupon_usage` (`COUPON_CODE`, `GUEST_ID`) VALUES ('$coupon_code', $user_id)";
          $mydb->setQuery($sql);
          $msg = $mydb->executeQuery();

 
      } else {
          // Coupon is invalid or has no remaining usage
          echo '<script>alert("Invalid coupon code or coupon has no remaining usage.")</script>';
      }
  }
}




  $_SESSION['pay'] = $payable;

  


}
?>
          </tbody>
          <tfoot>
    <tr>
        <td colspan="5"><h4 align="right">SubTotal:</h4></td>
        <td colspan="5">
            <h4><b> <?php echo isset($_SESSION['pay']) ? ' &#8369 ' . $_SESSION['pay'] : 'Your booking cart is empty.'; ?></b></h4>
        </td>
    </tr>
  
    <tr>
        <td colspan="5"><h4 align="right">Discount:</h4></td>
        <td colspan="5">
            <h4><b> <?php echo ' &#8369 ' . $discount_amount; ?></b></h4>
        </td>
    </tr>
</tfoot>




        </table> 
        <form method="post" action="">
    <div class="col-xs-12 col-sm-12" align="right">
        <?php
        if (isset($_SESSION['monbela_cart'])){
        ?>
            <a  href="<?php echo WEB_ROOT; ?>index.php?p=rooms" class="btn btn-primary" align="right" name="clear">Add Another Room</a>
            <button type="submit" class="btn btn-primary" align="right" name="clear">Clear Cart</button>

            <!-- Add the coupon code input field -->
            <label for="coupon_code">Coupon Code:</label>
            <input type="text" name="coupon_code" id="coupon_code">

            <button type="submit" class="btn btn-primary" align="right" name="apply_coupon">Apply Coupon</button>

            <?php
            if (isset($_SESSION['GUESTID'])){
            ?>
                <a href="<?php echo WEB_ROOT; ?>booking/index.php?view=payment" class="btn btn-primary" align="right" name="continue">Continue Booking</a>
            <?php 
            } else { ?>
                <a href="<?php echo WEB_ROOT; ?>booking/index.php?view=logininfo" class="btn btn-primary" align="right" name="continue">Continue Booking</a>
            <?php
            }
        } else {
        }
        ?>
    </div>
</form>
