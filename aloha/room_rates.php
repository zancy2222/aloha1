  <?php
$msg = "";

if(isset($_POST['booknow'])){

    $days =0;
    $day = dateDiff($_SESSION['arrival'],$_SESSION['departure']);  

   if($day <= 0){
      $totalprice = $_POST['ROOMPRICE'] *1;
      $days = 1;
    }else{
      $totalprice = $_POST['ROOMPRICE'] * $day;
      $days = $day;
    }
     
      addtocart($_POST['ROOMID'],$days, $totalprice,$_SESSION['arrival'],$_SESSION['departure']);

      redirect(WEB_ROOT. 'booking/'); 

}
 

 if(!isset($_SESSION['arrival'])){
   $_SESSION['arrival'] = date_create('Y-m-d');
 }
if(!isset($_SESSION['departure'])) {
  $_SESSION['departure'] =  date_create('Y-m-d') ;
}


if(isset($_POST['booknowA'])){ 


 $days = dateDiff($_POST['arrival'],$_POST['departure']); 

if($days <= 0){
  $msg = 'Available room today';
}else{
   $msg =  'Available room From:'.$_POST['arrival']. ' To: ' .$_POST['departure'];

} 


$_SESSION['arrival'] = date_format(date_create( $_POST['arrival']),"Y-m-d");
$_SESSION['departure'] =date_format(date_create($_POST['departure']),"Y-m-d");


 
 $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID`   AND `NUMPERSON` = " . $_POST['person'];
    

}elseif(isset($_GET['q'])){

    $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND `ROOM`='" . $_GET['q'] . "'"; 
   
  
  }else{
     $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID`";
  }

   $accomodation = ' | ' . @$_GET['q'];
  ?>


<div id="new-accom-title" style="text-align: center; margin-top: 20px;"> <!-- Changed ID and added inline CSS for centering and margin -->
    <div class="pagetitle" style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;"> <!-- Added inline CSS for styling -->
        <h1 style="color: #007bff;"><?php print $title; ?></h1> <!-- Added inline CSS for styling -->
        <!-- <small><?php print $accomodation; ?></small> -->
    </div> 
</div>

<div id="bread" class="text-center"> <!-- Added Bootstrap class to center content -->
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_ROOT; ?>index.php">Home</a></li>
        <li class="active"><?php print $title; ?></li>
        <li style="color: #02aace; float:right"><?php print $msg;?></li>

    </ol> 
</div>

   
  <div id="main" class="site-main clr"> 
    <div id="primary" class="content-area clr"> 
        <div id="content-wrap">
          <!--  <h1 class="page-title"><?php print $title . $accomodation; ?></h1>  --> 
           
           <div class="col-lg-9">
            <div class="tabs-wrapper clr"> 
               <div class="row"> 
               
                <?php 
 
                  $arrival =  $_SESSION['arrival'];
                  $departure =  $_SESSION['departure'] ;

                   $mydb->setQuery($query);
                   $cur = $mydb->loadResultList(); 
                      foreach ($cur as $result) { 


// filtering the rooms
 // ======================================================================================================
                    $mydb->setQuery("SELECT * FROM `tblreservation`     WHERE STATUS<>'Pending' AND ((
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
                        AND ROOMID =".$result->ROOMID);

                    

                     $curs = $mydb->loadResultList(); 
                     
                     $resNum = $result->ROOMNUM;
                         


                    $stats = $mydb->executeQuery();
                    $rows = $mydb->fetch_array($stats);
                    $status=isset($rows['STATUS']) ? $rows['STATUS'] : '';

                     
                    //$availRoom = $result->ROOMNUM;


              if($resNum==0){

             if($status=='Confirmed'){
              $btn = '<div class="text-center" style="margin-top: 10px; color: rgba(0, 0, 0, 1); font-size: 16px;"><strong>Fully Reserve!</strong></div>';

                 $img_title = ' 

                           <figcaption class="img-title-active">
                                <h5>Reserve!</h5>    
                            </figcaption>


                    ';
              }elseif($status=='Checkedin'){
                $btn = '<div class="text-center" style="margin-top: 10px; color: rgba(0, 0, 0, 1); font-size: 16px;"><strong>Fully Book!</strong></div>';

                 $img_title = ' 

                           <figcaption class="img-title-active">
                                <h5>Book!</h5>    
                            </figcaption>


                    ';
              }else{
                $btn = '
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 text-center">
                            <input type="submit" class="btn monbela-btn btn-primary btn-sm" id="booknow" name="booknow" onclick="return validateBook();" value="Book Now!" style="width: 150px; background-color: #3498db; color: #ffffff; font-weight: bold;"/>
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
                   
              }else{
                $btn = '
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 text-center">
                            <input type="submit" class="btn monbela-btn btn-primary btn-sm" id="booknow" name="booknow" onclick="return validateBook();" value="Book Now!" style="width: 150px; background-color: #3498db; color: #ffffff; font-weight: bold;"/>
                        </div>
                    </div>
                </div>';
            
                    $img_title = ' 

                           <figcaption class="img-title">
                                <h5>'.$result->ROOM . ' <br/> '.$result->ROOMDESC.'  <br/>
                                ' . $result->ACCOMODATION .' <br/> 
                                '.$result->ACCOMDESC . '<br/>  
                                Number of Person:' . $result->NUMPERSON .' <br/> 
                                Price:'.$result->PRICE.'</h5>    
                            </figcaption>


                    ';
                   

              }      
// ============================================================================================================================

 
                ?>
                 <form method="POST" action="index.php?p=accomodation">
                 <input type="hidden" name="ROOMPRICE" value="<?php echo $result->PRICE ;?>">
                  <input type="hidden" name="ROOMID" value="<?php echo $result->ROOMID ;?>">

                  <div id="roomimg" class="col-md-4 img-portfolio">
                    <div  class="wrapper clearfix">
                    <a href="index.php?p=gallery&room_id=<?php echo $result->ROOMID; ?>">
    <figure class="gallery-item">
        <?php if (is_file('admin/mod_room/' . $result->ROOMIMAGE)): ?>
            <img class="img-responsive img-hover" src="<?php echo WEB_ROOT . 'admin/mod_room/' . $result->ROOMIMAGE; ?>">
        <?php else: ?>
            <img class="img-responsive img-hover" src="<?php echo WEB_ROOT . 'no-img.png'; ?>">
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
   
</div>
<br/>
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
    
    </div>
    </div>
   
  </div>

 