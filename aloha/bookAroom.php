  <?php
  $msg = "";

  if (isset($_POST['booknow'])) {

    $days = 0;
    $day = dateDiff($_SESSION['arrival'], $_SESSION['departure']);

    if ($day <= 0) {
      $totalprice = $_POST['ROOMPRICE'] * 1;
      $days = 1;
    } else {
      $totalprice = $_POST['ROOMPRICE'] * $day;
      $days = $day;
    }

    addtocart($_POST['ROOMID'], $days, $totalprice, $_SESSION['arrival'], $_SESSION['departure']);

    redirect(WEB_ROOT . 'booking/');
  }




  $days = dateDiff($_POST['arrival'], $_POST['departure']);

  if ($days <= 0) {
    $msg = 'Available room today';
  } else {
    $msg =  'Available room From:' . $_POST['arrival'] . ' To: ' . $_POST['departure'];
  }


  $_SESSION['arrival'] = date_format(date_create($_POST['arrival']), "Y-m-d");
  $_SESSION['departure'] = date_format(date_create($_POST['departure']), "Y-m-d");





  $accomodation = ' | ' . $_POST['accomodation'];
  ?>



  <div id="new-accom-title" class="container text-center">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="display-4"><?php echo $title; ?></h1>
        <small class="text-muted"><?php echo $accomodation; ?></small>
      </div>
    </div>
  </div>



  <div id="bread">
    <ol class="breadcrumb">
      <li><a href="<?php echo WEB_ROOT; ?>index.php">Home</a>
      </li>
      <li class="active"><?php print $title; ?></li>
      <li style="color: #02aace; float:right"> <?php print  $msg; ?></li>
    </ol>
  </div>

  

  <div id="main" class="site-main clr">
    
    <div id="primary" class="content-area clr">
      <div id="content-wrap">
        <!--  <h1 class="page-title"><?php print $title . $accomodation; ?></h1>  -->

        <div class="col-lg-9" id="bookaroom">
          <div class="tabs-wrapper clr">
          <div class="card border-primary mb-3">
            <form method="POST" action="index.php?p=booking" class="container mt-5">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <h3 class="text-center mb-4">Book a Room</h3>

                  <div class="form-group row">
                    <label for="date_pickerfrom" class="col-sm-2 col-form-label">Check In</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                      <input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" data-link-format="yyyy-mm-dd" name="arrival" id="date_pickerfrom" value="<?php echo isset($_POST['arrival']) ? $_POST['arrival'] : date('m/d/Y'); ?>" readonly="true" class="date_pickerfrom form-control">

                        <span class="input-group-btn">
                          <i class="date_pickerto fa fa-calendar"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="date_pickerto" class="col-sm-2 col-form-label">Check Out</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                      <input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" data-link-format="yyyy-mm-dd" name="departure" id="date_pickerto" value="<?php echo isset($_POST['departure']) ? $_POST['departure'] : date('m/d/Y'); ?>" readonly="true" class="date_pickerto form-control">

                        <span class="input-group-btn">
                          <i class="date_pickerto fa fa-calendar"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="accomodation" class="col-sm-2 col-form-label">Accomodation</label>
                    <div class="col-sm-10">
                      <?php
                      $accomodation = new Accomodation();
                      $cur = $accomodation->listOfaccomodation();
                      ?>
                     <select class="form-control" name="accomodation" id="accomodation">
    <?php foreach ($cur as $result) { ?>
        <option value="<?php echo $result->ACCOMODATION; ?>" <?php echo isset($_POST['accomodation']) && $_POST['accomodation'] == $result->ACCOMODATION ? 'selected' : ''; ?>><?php echo $result->ACCOMODATION; ?></option>
    <?php } ?>
</select>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="person" class="col-sm-2 col-form-label">Person</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="person" id="person">
    <?php
    $sql = "SELECT distinct(`NUMPERSON`) as 'NumberPerson' FROM `tblroom`";
    $mydb->setQuery($sql);
    $cur = $mydb->loadResultList();
    foreach ($cur as $result) {
        $selected = isset($_POST['person']) && $_POST['person'] == $result->NumberPerson ? 'selected' : '';
        echo '<option value=' . $result->NumberPerson . ' ' . $selected . '>' . $result->NumberPerson . '</option>';
    }
    ?>
</select>

                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button class="btn monbela-btn btn-primary btn-sm" name="booknowA" type="submit" id="booknowA">Check Availability</button>
                    </div>
                  </div>

                </div>
              </div>
            </form>
          </div>


            <div class="row">

              <?php

              $arrival =  $_SESSION['arrival'];
              $departure =  $_SESSION['departure'];
              $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND `ACCOMODATION`='" . $_POST['accomodation'] . "' AND `NUMPERSON` = " . $_POST['person'];
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {

                // Filtering the rooms
                // ======================================================================================================

                $mydb->setQuery("SELECT * FROM `tblreservation` WHERE ((
  '$arrival' >= DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d')
  AND  '$arrival' <= DATE_FORMAT(`DEPARTURE`,'%Y-%m-%d')
  )
  OR (
  '$departure' >= DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d')
  AND  '$departure' <= DATE_FORMAT(`DEPARTURE`,'%Y-%m-%d')
  )
  OR (
  DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d') >=  '$arrival'
  AND DATE_FORMAT(`ARRIVAL`,'%Y-%m-%d') <=  '$departure'
  )
  )
  AND ROOMID =" . $result->ROOMID);

                $curs = $mydb->loadResultList();

                $resNum = $result->ROOMNUM;

                $stats = $mydb->executeQuery();
                $rows = mysqli_fetch_assoc($stats);
                $status = isset($rows['STATUS']) ? $rows['STATUS'] : '';

                if ($resNum == 0) {

                  if ($status == 'Confirmed') {
                    $btn =  '<div style="margin-top:10px; color: rgba(0,0,0,1); font-size:16px;"><strong>Fully Reserve!</strong></div>';
                    $img_title = ' 

     <figcaption class="img-title-active">
          <h5>Reserve!</h5>    
      </figcaption>
';
                  } elseif ($status == 'Checkedin') {
                    $btn =  '<div style="margin-top:10px; color: rgba(0,0,0,1); font-size:16px;"><strong>Fully Book!</strong></div>';
                    $img_title = ' 

     <figcaption class="img-title-active">
          <h5>Book!</h5>    
      </figcaption>
';
                  } else {
                    $btn =  '
<div class="form-group">
<div class="row">
<div class="col-xs-12 col-sm-12">
<div class="text-center mt-3">
<input type="submit" class="btn monbela-btn btn-primary btn-sm" id="booknow" name="booknow" onclick="return validateBook();" value="Book Now!"/>
</div>

</div>
</div>
</div>';
                    $img_title = ' 
<figcaption class="img-title">
<h5>' . $result->ROOM . ' <br/> ' . $result->ROOMDESC . '  <br/>
' . $result->ACCOMODATION . ' <br/> 
' . $result->ACCOMDESC . '<br/>  
Number of Person:' . $result->NUMPERSON . ' <br/> 
Price:' . $result->PRICE . '</h5>    
</figcaption>
';
                  }
                } else {
                  $btn =  '
<div class="form-group">
<div class="row">
<div class="col-xs-12 col-sm-12">
<div class="text-center mt-3">
    <input type="submit" class="btn monbela-btn btn-primary btn-sm" id="booknow" name="booknow" onclick="return validateBook();" value="Book Now!"/>
</div>

</div>
</div>
</div>';
                  $img_title = ' 
<figcaption class="img-title">
<h5>' . $result->ROOM . ' <br/> ' . $result->ROOMDESC . '  <br/>
' . $result->ACCOMODATION . ' <br/> 
' . $result->ACCOMDESC . '<br/>  
Number of Person:' . $result->NUMPERSON . ' <br/> 
Price:' . $result->PRICE . '</h5>    
</figcaption>
';
                }

                // ============================================================================================================================

              ?>
              
                <form method="POST" action="index.php?p=accomodation">
                  <input type="hidden" name="ROOMPRICE" value="<?php echo $result->PRICE; ?>">
                  <input type="hidden" name="ROOMID" value="<?php echo $result->ROOMID; ?>">
                  <div id="roomimg" class="col-md-4 img-portfolio">
                    <div  class="wrapper clearfix">
                    <a href="#" >
                        <figure class="gallery-item ">
                            <?php if(is_file('admin/mod_room/'.$result->ROOMIMAGE)): ?>
                            <img class="img-responsive img-hover"  src="<?php echo WEB_ROOT .'admin/mod_room/'.$result->ROOMIMAGE; ?>">
                            <?php else: ?>
                            <img class="img-responsive img-hover"  src="<?php echo WEB_ROOT .'no-img.png'; ?>">
                            <?php endif; ?>
                    
                             <!-- <?php echo $img_title; ?> -->
                           

             
                        </figure> 
                       </a>  
                        <ul style="font-size:10px"><h4><p><?php echo $result->ROOM ;?></p></h4>
                        <li>Price:<?php echo $result->PRICE ;?></li>
                        <li><?php echo $result->ACCOMODATION ;?></li>
                        <li><?php echo $result->ROOMDESC ;?></li>
                        <li>Number Person : <?php echo $result->NUMPERSON ;?></li>
                         <li>Remaining Rooms :<?php echo  $resNum ;?></li>   
                        <!-- <li style="list-style:none;"><?php echo $btn ;?></li>   -->
                        <div class="row" >
                          <?php echo $btn ; ?>
                        </div>
                        </ul> 

                        <!-- <div class="row" >
                          <?php echo $btn ; ?>
                        </div> -->
                    </div> 
                     
                </div> 

                </form>
              <?php

              }

              ?>

            </div>
          </div>

        </div>

          
        
        <div class="col-lg-3">
          
<div class="row">


    <div id="newSidebarWrap" class="custom-sidebar-wrap">
        <div class="descRoom">
            <div class="row">
                <div class="col-md-10 block">
                    <h3>Type of Rooms</h3>
                </div>
            </div>
            <ul class="list-unstyled a">
            <li><a href="index.php?p=rooms"><p>ALL ROOMS</p></a></li>
          
                <?php
                $query = "SELECT distinct(ROOM) FROM `tblroom` ";
                $mydb->setQuery($query);
                $cur = $mydb->loadResultList();
                
                foreach ($cur as $result) { ?>
                    <li><a href="<?php echo WEB_ROOT; ?>index.php?p=rooms&q=<?php echo $result->ROOM; ?>"><p><?php echo $result->ROOM; ?></p></a></li>
                <?php } ?>
      
            </ul>
        </div>
    </div>
</div>
</div>
      

          <style type="text/css">



 .a a {
  color:white;
 }
  .a li {
  list-style: none;
 }
 /* .a  a:hover{
      color: blue;
    }*/

    
/* List Item */
#roomimg ul li{
 font-size:15px;
}


    /* Customize the sidebar layout */
#newSidebarWrap {
    margin-top: 20px;
}

/* Style the headings */
#newSidebarWrap h3 {
    color: #000000; /* Change text color to black */
    font-size: 24px;
}

/* Style the list items */
#newSidebarWrap ul.a {
    padding: 0;
    list-style-type: none;
}

#newSidebarWrap ul.a li {
    margin-bottom: 10px;
}

#newSidebarWrap ul.a li a {
    text-decoration: none;
}

#newSidebarWrap ul.a li a p {
    margin: 0;
    padding: 8px;
    background-color: #f0f0f0; /* Set your desired background color complementary to the content */
    border-radius: 5px;
    display: inline-block;
    width: 100%;
}

/* Apply Bootstrap classes for additional styling */
#newSidebarWrap .row {
    margin-bottom: 15px;
}

/* Primary */
#primary{
 transform:translatex(0px) translatey(0px);
}

/* Paragraph */
.descRoom a p{
 color:#020202;
}

/* Desc room */
#newSidebarWrap .descRoom{
 background-color:#ffffff;
 transform:translatex(0px) translatey(0px);
}

</style>

<style type="text/css">
 .a a {
  color:white;
 }
  .a li {
  list-style: none;
 }
 /* .a  a:hover{
      color: blue;
    }*/

    
/* List Item */
#roomimg ul li{
 font-size:15px;
}


    /* Customize the sidebar layout */
#newSidebarWrap {
    margin-top: 20px;
}

/* Style the headings */
#newSidebarWrap h3 {
    color: #000000; /* Change text color to black */
    font-size: 24px;
}

/* Style the list items */
#newSidebarWrap ul.a {
    padding: 0;
    list-style-type: none;
}

#newSidebarWrap ul.a li {
    margin-bottom: 10px;
}

#newSidebarWrap ul.a li a {
    text-decoration: none;
}

#newSidebarWrap ul.a li a p {
    margin: 0;
    padding: 8px;
    background-color: #f0f0f0; /* Set your desired background color complementary to the content */
    border-radius: 5px;
    display: inline-block;
    width: 100%;
}

/* Apply Bootstrap classes for additional styling */
#newSidebarWrap .row {
    margin-bottom: 15px;
}

/* Primary */
#primary{
 transform:translatex(0px) translatey(0px);
}

/* Paragraph */
.descRoom a p{
 color:#020202;
}

/* Desc room */
#newSidebarWrap .descRoom{
 background-color:#ffffff;
 transform:translatex(0px) translatey(0px);
}


 </style>

 
       

        </div>


      </div>
  

  </div>