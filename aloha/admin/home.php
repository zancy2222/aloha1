<style>
  .fa-facebook {
    background-color: black;
  }
</style>

<div class="container mt-5">
  <h1 class="text-center">Welcome to Aloha Nui Hotel Dashboard</h1>

  <div class="row mt-4">
    <!-- Rooms -->
    <div class="col-md-4">
      <a href="<?php echo WEB_ROOT; ?>admin/mod_room/index.php" class="text-decoration-none">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title text-dark">Rooms</h5> <!-- Explicitly set text color to dark -->
            <p class="card-text text-dark">Total Rooms:
              <?php
              $query = "SELECT SUM(ROOMNUM) as 'Total' FROM `tblroom`"; // Adjust the table name if needed
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {
                echo '<span class="badge badge-primary">' . $result->Total . '</span>';
              }
              ?>

            </p>

            <i class="fas fa-bed fa-3x" style="color: #007BFF;"></i> <!-- Set icon color using inline CSS -->
          </div>
        </div>
      </a>
    </div>




    <!-- Comments -->
    <div class="col-md-4">
      <a href="<?php echo WEB_ROOT; ?>admin/mod_comments/index.php" class="text-decoration-none">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title text-dark">Comments</h5> <!-- Explicitly set text color to dark -->
            <p class="card-text text-dark">Total Comments:
              <?php
              $query = "SELECT count(*) as 'Total' FROM `tblreviews`"; // Adjust the table name if needed
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {
                echo '<span class="badge badge-primary">' . $result->Total . '</span>';
              }
              ?>
            </p>

            <i class="fas fa-comments fa-3x"></i>
          </div>
        </div>
      </a>
    </div>


    <!-- Accomodation -->
    <div class="col-md-4">
      <a href="<?php echo WEB_ROOT; ?>admin/mod_accomodation/index.php" class="text-decoration-none">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title text-dark">Accommodation</h5> <!-- Explicitly set text color to dark -->
            <p class="card-text text-dark">Total Accommodations:
              <?php
              $query = "SELECT count(*) as 'Total' FROM `tblaccomodation`"; // Adjust the table name if needed
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {
                echo '<span class="badge badge-primary">' . $result->Total . '</span>';
              }
              ?>
            </p>

            <i class="fas fa-hotel fa-3x"></i>
          </div>
        </div>
      </a>
    </div>





  </div>

  <div class="row mt-4">

    <!-- Reservation -->
    <div class="col-md-4">
      <a href="<?php echo WEB_ROOT; ?>admin/mod_reservation/index.php" class="text-decoration-none">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title text-dark">Reservation</h5> <!-- Explicitly set text color to dark -->
            <p class="card-text text-dark">Total Reservations:
              <?php
              $query = "SELECT count(*) as 'Total' FROM `tblpayment` WHERE `STATUS`='Pending'"; // Adjust the table name if needed
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {
                echo '<span class="badge badge-primary">' . $result->Total . '</span>';
              }
              ?>
            </p>

            <i class="fas fa-calendar-check fa-3x"></i>
          </div>
        </div>
      </a>
    </div>




    <!-- Coupon -->
    <div class="col-md-4">
      <a href="<?php echo WEB_ROOT; ?>admin/mod_coupons/index.php" class="text-decoration-none">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title text-dark">Coupon</h5> <!-- Explicitly set text color to dark -->
            <p class="card-text text-dark">Total Coupons:
              <?php
              $query = "SELECT count(*) as 'Total' FROM `tblcoupon`"; // Adjust the table name if needed
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {
                echo '<span class="badge badge-primary">' . $result->Total . '</span>';
              }
              ?>
            </p>

            <i class="fas fa-tags fa-3x"></i>
          </div>
        </div>
      </a>
    </div>



    <!-- Users -->
    <div class="col-md-4">
      <a href="<?php echo WEB_ROOT; ?>admin/mod_comments/index.php" class="text-decoration-none">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title text-dark">Gallery</h5> <!-- Explicitly set text color to dark -->
            <p class="card-text text-dark">Total Pictures:
              <?php
              $query = "SELECT SUM(LENGTH(IMAGE_URL) - LENGTH(REPLACE(IMAGE_URL, ',', '')) + 1) AS 'Total' FROM `tblgallery`";
              // Adjust the table name if needed
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {
                echo '<span class="badge badge-primary">' . $result->Total . '</span>';
              }
              ?>
            </p>

            <i class="fas fa-tags fa-3x"></i>
          </div>
        </div>
      </a>
    </div>