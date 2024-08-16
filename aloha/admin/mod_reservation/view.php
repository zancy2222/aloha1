<?php
if (!defined('WEB_ROOT')) {
  exit;
}

$code = $_GET['code'];



$query = "SELECT  `G_FNAME` ,  `G_LNAME` ,  `G_ADDRESS` ,  `G_CITY`,  `G_CADDRESS`,  `TRANSDATE` ,  `CONFIRMATIONCODE`, `age` , `emailaddress`,  `PQTY` ,  `SPRICE` ,`STATUS`
				FROM  `tblpayment` p,  `tblguest` g
				WHERE p.`GUESTID` = g.`GUESTID` AND `CONFIRMATIONCODE`='" . $code . "'";
$mydb->setQuery($query);
$res = $mydb->loadSingleResult();

if ($res->STATUS == 'Confirmed') {
  $stats = '<li class="next"><a href="' . WEB_ROOT . 'admin/mod_reservation/controller.php?action=checkin&code=' . $res->CONFIRMATIONCODE .
    '">Confirmed &rarr;</a></li>';
} elseif ($res->STATUS == 'Checkedin') {
  $stats = '<li class="next"><a href="' . WEB_ROOT . 'admin/mod_reservation/controller.php?action=checkout&code=' . $res->CONFIRMATIONCODE .
    '">Checkin &rarr;</a></li>';
} elseif ($res->STATUS == 'Checkedout') {
  $stats = "";
} else {
  $stats = '<li class="next"><a href="' . WEB_ROOT . 'admin/mod_reservation/controller.php?action=confirm&code=' . $res->CONFIRMATIONCODE .
    '">Confirm &rarr;</a></li>';
}

?>

<div class="container">



    <div class="col-lg-3">
        <div class="card bg-info text-white">
            <div class="card-header">
                <h5 class="card-title mb-0">Guest Information</h5>
                <hr class="bg-light" />
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                <li class="list-group-item bg-info">
    <strong class="text-white">Guest Name:</strong>
    <span class="float-right"><?php echo $res->G_FNAME . ' ' . $res->G_LNAME; ?></span>
</li>

                    <li class="list-group-item bg-info">
                        <strong class="text-white">Guest Address:</strong>
                        <span class="float-right"><?php echo $res->G_ADDRESS . ' ' . $res->G_CITY; ?></span>
                    </li>

                    <li class="list-group-item bg-info">
                        <strong class="text-white">Guest Email:</strong>
                        <span class="float-right"><?php echo $res->emailaddress; ?></span>
                    </li>

                   
                    <li class="list-group-item bg-info">
                        <strong class="text-white">Guest Age:</strong>
                        <span class="float-right"><?php echo $res->age; ?></span>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>


    <!-- Add more cards for other information if needed -->
</div>


  <div class="col-lg-9">

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Reservation
          <small>View Rooms</small>
        </h1>
        <!--  <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Blog Home Two</li>
                </ol> -->
      </div>


    </div>
    <!-- /.row -->
    <?php

    $query = "SELECT * 
				FROM  `tblreservation` r,  `tblguest` g,  `tblroom` rm, tblaccomodation a
				WHERE r.`ROOMID` = rm.`ROOMID` 
				AND a.`ACCOMID` = rm.`ACCOMID` 
				AND g.`GUESTID` = r.`GUESTID`  AND r.`STATUS`<>'Cancelled'
				AND  `CONFIRMATIONCODE` = '" . $code . "'";
    $mydb->setQuery($query);
    $res = $mydb->loadResultList();

    foreach ($res as $cur) {
      $image = WEB_ROOT . 'admin/mod_room/' . $cur->ROOMIMAGE;
      $day = dateDiff(date($cur->ARRIVAL), date($cur->DEPARTURE));


      // Fetch proof_of_transaction from the database
      $proofOfTransaction = $cur->proof_of_transaction;

      // Display proof_of_transaction image if it exists
      if (!empty($proofOfTransaction)) {
        echo '<p><strong>Proof of Payment: </strong></p>';
        echo '<div class="col-md-6">';
        echo '<img src="' . WEB_ROOT . 'booking/proof/' . $proofOfTransaction . '" alt="Proof of Payment" class="img-fluid" style="width: 50%;">';
        echo '</div>';
    }
    
    ?>

      <!-- Blog Post Row -->
      <div class="row">
        <!-- <div class="col-md-1 text-center">
                <p><i class="fa fa-camera fa-4x"></i>
                </p>
                <p>June 17, 2014</p>
            </div> -->
        <div class="col-md-3">
          <img class="img-responsive img-hover" src="<?php echo $image; ?>" alt="">
        </div>
        <div class="col-md-6">
          <div class="box box-solid">
            <ul class="nav nav-pills nav-stacked">
              <li>
                <h3>
                  <?php echo $cur->ROOM; ?> [ <small><?php echo $cur->ACCOMODATION; ?></small> ]
                </h3>
              </li>
              <li></li>
            </ul>

            <p><strong>ARRIVAL: </strong><?php echo date_format(date_create($cur->ARRIVAL), 'm/d/Y'); ?></p>
            <p><strong>DEPARTURE: </strong><?php echo date_format(date_create($cur->DEPARTURE), 'm/d/Y'); ?></p>
            <p><strong>Night(s): </strong><?php echo ($day == 0) ? '1' : $day; ?></p>
            <p><strong>PRICE: </strong><?php echo $cur->RPRICE; ?></p>
          
          </div>


        </div>
      </div>
      <!-- /.row -->

      <hr>

    <?php }

    ?>
  </div>
  <style>
        /* Custom CSS for adding black borders to form elements and div */
        .form-container {
            border: 1px solid #000;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea,
        .form-group label,
        .form-check-input {
            border: 1px solid #000;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 10px;
        }

        .form-check-label {
            margin-bottom: 0;
        }
    </style>
  <!-- Pager -->
  <div class="row">
    <ul class="pager">
      <li class="previous"><a href="<?php echo WEB_ROOT . 'admin/mod_reservation/index.php'; ?>">&larr; Back</a>
      </li>
      <?php echo $stats; ?>
    </ul>
    <div class="container mt-5">

    
    <div class="row justify-content-center"> <!-- Center the form container -->
        <div class="col-md-6"> <!-- Set the width to 50% using Bootstrap grid system -->
    <div class="form-container">
        <form method="POST" action="">
            <div class="form-group text-center">
                <label for="initialPayment" class="font-weight-bold">Initial Payment:</label>
                <input type="text" id="initialPayment" name="initialPayment" class="form-control">
            </div>
            <div class="text-center">
                <input type="submit" value="Update Initial Payment" class="btn btn-primary">
            </div>
        </form>
    </div>
    </div>
</div>

    <div class="row justify-content-center"> <!-- Center the form container -->
        <div class="col-md-6"> <!-- Set the width to 50% using Bootstrap grid system -->
    <div class="form-container">
        <form id="discountForm" method="POST">
            <div class="form-group">
                <label for="allSeniorPWD">All Senior Citizen/PWD:</label>
                <input type="checkbox" id="allSeniorPWD" name="allSeniorPWD" onchange="handleCheckboxChange()">
            </div>
            <div class="form-group">
                <label for="numberOfGuests">Number of Guests:</label>
                <input type="number" class="form-control" id="numberOfGuests" name="numberOfGuests" required>
            </div>
            <div class="form-group">
                <label for="numberOfSeniorPWD">Number of Senior Citizen/PWD:</label>
                <input type="number" class="form-control" id="numberOfSeniorPWD" name="numberOfSeniorPWD" required>
            </div>
            <button type="submit" name="applyDiscount" class="btn btn-primary">Apply Discount</button>
        </form>
    </div>
</div>
</div>
</div>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the form is submitted and the applyDiscount button is clicked
  if (isset($_POST['applyDiscount'])) {
    global $mydb;

    $discountFactor = 0.20;

    
    // Retrieve the current SPRICE value from the database
    $getSpriceQuery = "SELECT SPRICE FROM tblpayment WHERE CONFIRMATIONCODE = '$code'";
    $mydb->setQuery($getSpriceQuery);
    $resultArray = $mydb->loadResultList();
    
    // Extract the first element of the array (assuming it's the only result)
    $currentSprice = reset($resultArray);
    
    
    // Check if allSeniorPWD checkbox is checked
    if (isset($_POST['allSeniorPWD'])) {
      // All senior citizen or PWD logic
      $sql = "UPDATE tblpayment
              SET SPRICE = SPRICE - (SPRICE * $discountFactor),
              COUPON_CODE = 'SENIOR_CITIZEN/PWD'
              WHERE CONFIRMATIONCODE = '$code'";
    } else {
      // Not all senior citizen or PWD logic
      $numberOfGuests = intval($_POST['numberOfGuests']);
      $numberOfSeniorPWD = intval($_POST['numberOfSeniorPWD']);
   

      $sql = "UPDATE tblpayment
              SET SPRICE = SPRICE - (SPRICE / $numberOfGuests / 1.12 * $discountFactor * $numberOfSeniorPWD),
              COUPON_CODE = 'SENIOR_CITIZEN/PWD'
              WHERE CONFIRMATIONCODE = '$code'";
    }

    $mydb->setQuery($sql);

    // Execute the query
    if ($mydb->executeQuery()) {
      // Redirect after the update is done
      redirect('index.php');
      message("VOUCHER ADDED successfully!", "success");
    } else {
      // Handle the case when the query execution fails
      echo "Failed to update reservation.";
    }
  }
}
?>

<script>
    function handleCheckboxChange() {
        var checkbox = document.getElementById('allSeniorPWD');
        var numberOfGuestsInput = document.getElementById('numberOfGuests');
        var numberOfSeniorPWDInput = document.getElementById('numberOfSeniorPWD');

        // Disable or enable inputs based on checkbox status
        numberOfGuestsInput.disabled = checkbox.checked;
        numberOfSeniorPWDInput.disabled = checkbox.checked;

        // Clear values if checkbox is checked
        if (checkbox.checked) {
            numberOfGuestsInput.value = "";
            numberOfSeniorPWDInput.value = "";
        }
    }
</script>





    <hr>


    <?php
// Previous code remains unchanged

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the initial payment value from the form submission
  $initialPayment = isset($_POST['initialPayment']) ? $_POST['initialPayment'] : '';

  // Update the tblpayment table
  $updatePaymentQuery = "UPDATE `tblpayment` SET `initial_payment` = '$initialPayment' WHERE `CONFIRMATIONCODE` = '$code'";
  $mydb->setQuery($updatePaymentQuery);

  // Execute the query
  if (!$mydb->executeQuery()) {
      die("Error updating payment: " . mysqli_error($mydb->getConnection()));
  }

  // Update the tblreservation table
  $updateReservationQuery = "
      UPDATE tblreservation r
      SET r.BALANCE = (
          SELECT SPRICE FROM tblpayment WHERE CONFIRMATIONCODE = '$code'
      ) - '$initialPayment'
      WHERE r.CONFIRMATIONCODE = '$code'";
  
  $mydb->setQuery($updateReservationQuery);

  // Execute the query
  if (!$mydb->executeQuery()) {
      die("Error updating reservation: " . mysqli_error($mydb->getConnection()));
  }

  // Redirect after both updates are done
  redirect('index.php');
  exit; // Make sure to exit after the redirect to prevent further execution
}


