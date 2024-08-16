<?php

require_once("../../includes/initialize.php");
global $mydb;

// Use $confirmationCode instead of $_GET['confirmationCode']
$confirmationCode = isset($confirmationCode) ? $confirmationCode : '';


// If confirmation code is set, filter the query
if (!empty($confirmationCode)) {
    $mydb->setQuery("SELECT `G_FNAME`, `G_LNAME`, `G_ADDRESS`, `TRANSDATE`, `CONFIRMATIONCODE`, `PQTY`, `SPRICE`, `STATUS`, `COUPON_CODE`, `initial_payment`, `BALANCE`
                    FROM `tblpayment` p
                    INNER JOIN `tblguest` g ON p.`GUESTID` = g.`GUESTID`
                    WHERE p.`CONFIRMATIONCODE` = '{$confirmationCode}'");
} else {
    // If confirmation code is not set, retrieve all payment details
    $mydb->setQuery("SELECT `G_FNAME`, `G_LNAME`, `G_ADDRESS`, `TRANSDATE`, `CONFIRMATIONCODE`, `PQTY`, `SPRICE`, `STATUS`, `COUPON_CODE`, `initial_payment`, `BALANCE`
                    FROM `tblpayment` p
                    INNER JOIN `tblguest` g ON p.`GUESTID` = g.`GUESTID`
                    ORDER BY p.`STATUS`='pending' DESC");
}



$cur = $mydb->loadResultList();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALOHA NUI HOTEL - Payment Receipt</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <!-- Font Awesome CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #3498db;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .hotel-header {
        display: flex;
        align-items: center;
    }

    .hotel-logo {
        max-width: 100px;
        margin-bottom: 20px;
    }

    .hotel-name {
        font-size: 24px;
        font-weight: bold;
        margin-left: 10px;
        color: #3498db;
        text-transform: uppercase; /* Convert text to uppercase */
        letter-spacing: 1px; /* Add some letter spacing */
        text-shadow: 1px 1px 1px #000; /* Add a subtle text shadow */
    }
    </style>
</head>
<body>

<div class="container">
    <!-- Add the hotel logo -->
    <div class="hotel-header">
        <img src="https://i.ibb.co/ydJWLjZ/alohalogo.png" alt="ALOHA NUI HOTEL Logo" class="hotel-logo">
        <span class="hotel-name">ALOHA NUI HOTEL</span>
    </div>

    <h2 class="mt-4 mb-4">ALOHA NUI HOTEL - Payment Receipt</h2>

   

  <table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Guest</th>
            <th>Transaction Date</th>
            <th>Confirmation Code</th>
            <th>Total Rooms</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Coupon Code</th>
            <th>Initial Payment</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($cur as $result) {
        ?>
            <tr>
                <td></td>
                <td><?php echo $result->G_FNAME . " " . $result->G_LNAME; ?></td>
                <td><?php echo $result->TRANSDATE; ?></td>
                <td><?php echo $result->CONFIRMATIONCODE; ?></td>
                <td><?php echo $result->PQTY; ?></td>
                <td><?php echo $result->SPRICE; ?></td>
                <td><?php echo $result->STATUS; ?></td>
                <td><?php echo $result->COUPON_CODE; ?></td>
                <td><?php echo $result->initial_payment; ?></td>
                <td><?php echo $result->BALANCE; ?></td>
            </tr>
        <?php
            // Switch statement inside the loop
            $statusMessage = '';

            switch ($result->STATUS) {
              
                case 'pending':
                    $statusMessage = 'Thank you for booking at ALOHA NUI HOTEL. Your booking is pending confirmation.';
                    break;
                case 'Confirmed':
                    $statusMessage = 'Thank you for choosing ALOHA NUI HOTEL. Your booking is confirmed.';
                    break;
                case 'checkin':
                    $statusMessage = 'Welcome to ALOHA NUI HOTEL! We hope you have a pleasant stay.';
                    break;
                case 'checkout':
                    $statusMessage = 'Thank you for staying with us at ALOHA NUI HOTEL. We hope to see you again soon.';
                    break;
                case 'arrival':
                    $statusMessage = 'Welcome to ALOHA NUI HOTEL! We look forward to serving you.';
                    break;
                case 'Cancelled':
                    $statusMessage = 'Your booking at ALOHA NUI HOTEL has been cancelled.';
                     break;
                default:
                    $statusMessage = 'Thank you for choosing ALOHA NUI HOTEL.';
            }

            echo '<p class="status-message mt-4">' . $statusMessage . '</p>';
        }
        ?>
    </tbody>
    <!-- Add any table footers if needed -->
</table>


   

    <div class="container">


  <div class="col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title ">Guest Information</h3>
        <hr />
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a><i class="fa fa-inbox"></i> Guest Name ::
          <?php echo $result->G_FNAME." ".$result->G_LNAME; ?></a></li><br />
          <li class="active"><a><i class="fa fa-file-text-o"></i> ADDRESS ::
          
              <?php echo $result->G_ADDRESS; ?> </a></li>

        </ul>
      </div>
      <!-- /.box-body -->
    </div>

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
  <!-- ... (previous HTML code) ... -->

<?php
$code = isset($confirmationCode) ? $confirmationCode : '';
$query = "SELECT * 
            FROM  `tblreservation` r,  `tblguest` g,  `tblroom` rm, tblaccomodation a
            WHERE r.`ROOMID` = rm.`ROOMID` 
            AND a.`ACCOMID` = rm.`ACCOMID` 
            AND g.`GUESTID` = r.`GUESTID`
            AND  `CONFIRMATIONCODE` = '" . $code . "'";
$mydb->setQuery($query);
$res = $mydb->loadResultList();

// Check if data is retrieved successfully
if (!empty($res)) {
    foreach ($res as $cur) {
        $image = WEB_ROOT . 'admin/mod_room/' . $cur->ROOMIMAGE;
        $day = dateDiff(date($cur->ARRIVAL), date($cur->DEPARTURE));
?>
        <!-- Blog Post Row -->
        <div class="row">
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
                    <p><strong>Check In: </strong><?php echo date_format(date_create($cur->ARRIVAL), 'm/d/Y'); ?></p>
                    <p><strong>Check Out: </strong><?php echo date_format(date_create($cur->DEPARTURE), 'm/d/Y'); ?></p>
                    <p><strong>Night(s): </strong><?php echo ($day == 0) ? '1' : $day; ?></p>
                    <p><strong>PRICE: </strong><?php echo $cur->RPRICE; ?></p>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <hr>
<?php
    }
} else {
    // Handle the case where no data is retrieved
    echo "No data found for confirmation code: $code";
}
?>
<!-- ... (remaining HTML code) ... -->

  </div>

    <footer class="mt-4">
        <p>
            <i class="fas fa-hotel"></i> Aloha Nui Hotel, Event Center, Restaurant & Bar<br>
            National Highway Brgy. Paras, Candon City, Ilocos Sur 2710 Philippines<br>
            Email Address: alohanuihotel@gmail.com<br>
            TEL.# (077) 632-4463   COMPANY MOBILE: 0936-497-6747
        </p>
        <div>
            <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
