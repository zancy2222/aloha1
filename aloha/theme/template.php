<?php
if(isset($_POST['avail'])){
  
$_SESSION['from'] = $_POST['from'];
$_SESSION['to']  = $_POST['to'];

  redirect(WEB_ROOT. "index.php?page=5");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo isset($title) ? $title . ' | Aloha Nui Hotel' :  'Aloha Nui Hotel' ; ?></title>
<link rel="icon" type="image/png" href="https://i.ibb.co/ydJWLjZ/alohalogo.png">
 

 <!-- Add the following lines to include Fancybox -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    
<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>style.css">  
<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>css/responsive.css">    

<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>css/bootstrap.css">  

<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>fonts/css/font-awesome.min.css"> 

<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>css/custom-navbar.min.css"> 
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
   <!-- FlexSlider CSS and JS files -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css" type="text/css" media="screen" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<!-- DataTables CSS -->
<!-- <link href="<?php echo WEB_ROOT; ?>css/dataTables.bootstrap.css" rel="stylesheet"> -->
 
 <link href="<?php echo WEB_ROOT; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <link href="<?php echo WEB_ROOT; ?>css/datepicker.css" rel="stylesheet" media="screen">

 <link href="<?php echo WEB_ROOT; ?>css/galery.css" rel="stylesheet" media="screen">
 <link href="<?php echo WEB_ROOT; ?>css/ekko-lightbox.css" rel="stylesheet">
</head>

<?php
if (isset($_SESSION['monbela_cart'])){
  if (count($_SESSION['monbela_cart'])>0) {
    $cart = '<span class="carttxtactive"> '.count($_SESSION['monbela_cart']) .' </span>';
  } 
 
} 
if (isset($_SESSION['activity'])){
  if (is_array($_SESSION['activity']) && count($_SESSION['activity'])>0) {
    $activity = '<span class="carttxtactive"> '.count($_SESSION['activity']) .' </span>';
  } 
 
} 




// }
 ?>
 


<style type="text/css">
  #newsLoading {
    margin-top: 10px;
    text-align:center;
    display:none;
    position: relative;
  }

  .footer {
     
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* Bootstrap light gray background color */
            padding: 10px;
            text-align: center;
        }

        .footer img {
            max-width: 50px; /* Adjust the maximum width of the image */
            margin-right: 10px; /* Adjust margin as needed */
        }
 

#site-navigation-wrap,
 #footer-wrap,
 #menuSm ,
 #availability-wrap,
 #accom-title{
  background-color: #6d4330;
 }

 #site-navigation-wrap li a{
  background-color: #6d4330;
  font-size: 13px; 
 
 }

  #menuSm li:hover{
    background-color: #2cdcf1;
  }
   #menuSm {
   border-bottom: 1px solid yellow;
  }
  #site-navigation-wrap li:hover {
  background-color: skyblue;
  
 }
 .img-portfolio img {
    max-height: 200px;
    width: 400px;
 }
 #sidebarRight-wrap{
  background-color: #6d4330;
  border-bottom: 6px solid yellow;
 }

/* Heading */
.slides li h4{
 text-shadow:rgb(255, 255, 255) 0px 1px 1px, rgb(0, 0, 0) 0px -1px 1px;
}

/* Paragraph */
.slides li p{
 font-weight:700;
 text-shadow:rgb(255, 255, 255) 0px 1px 1px, rgb(0, 0, 0) 0px -1px 1px;
}

@media (min-width:1081px){

 /* Paragraph */
 .slides li p{
  font-size:17px;
 }
 

  /* Heading */
  .slides li h4{
  font-size:94px;
 }
 
}


</style>

 

 
<body> 


<!-- header -->
<div class="banner-top">
    <div class="social-bnr-agileits">
        <ul class="social-icons3">
            <li><a href="https://www.facebook.com/profile.php?id=100067186514924" class="fa fa-facebook icon-border facebook"> </a></li>
        </ul>
    </div>
    <div class="contact-bnr-w3-agile">
        <ul>
            <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:alohanuihotel@gmail.com">alohanuihotel@gmail.com</a></li>
            <li><i class="fa fa-phone" aria-hidden="true"></i>+63 9364976747</li>
        </ul>
    </div>
    <div class="clearfix"></div>

<div class="w3_navigation">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1><a class="navbar-brand" href="<?php echo WEB_ROOT; ?>index.php">Aloha <span>Nui</span><p class="logo_w3l_agile_caption">EVENT CENTER, RESTAURANT & BAR</p></a></h1>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
    <nav class="menu menu--iris">
        <ul class="nav navbar-nav menu__list">
            <li class="menu__item menu__item--current"><a href="<?php echo WEB_ROOT; ?>index.php" class="menu__link">Home</a></li>
            <li class="menu__item"><a href="<?php echo WEB_ROOT; ?>index.php?p=rooms" class="menu__link scroll">Rooms</a></li>
            <li class="menu__item"><a href="index.php#about" class="menu__link">About</a></li>
            <li class="menu__item"><a href="#" class="menu__link scroll" data-toggle="modal" data-target="#businessNotesModal">Business Notes</a></li>
            <li class="menu__item"><a href="<?php echo WEB_ROOT; ?>index.php?p=contact" class="menu__link scroll">Contact Us</a></li>
       



<?php if (isset($_SESSION['GUESTID'])) {
  
  ?>
  
  <!-- User Account Links -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['name'] . ' ' . $_SESSION['last']; ?> <i class="fa fa-caret-down fa-fw"></i>
    </a>
    <ul class="dropdown-menu nav nav-stacked">
        <?php
        // Fetch user details for profile image
        $g = new Guest();
        $result = $g->single_guest($_SESSION['GUESTID']);
        ?>

        <li class="widget-user-header bg-yellow">
            <div class="widget-user-image">
                <img class="img-circle" style="cursor:pointer;width:200px;height:100px;padding:0;" data-target="#myModal" data-toggle="modal" src="<?php echo WEB_ROOT . $result->LOCATION; ?>" alt="User Avatar">
            </div>
            <h3 class="widget-user-username"><?php echo $_SESSION['name'] . ' ' . $_SESSION['last']; ?> </h3>
        </li>
        <li><a style="color:#000;text-align:left;border-bottom:1px solid #fff;" href="<?php echo WEB_ROOT; ?>guest/profile.php" data-toggle="lightbox">Account</a></li>
        <li><a style="color:#000;text-align:left;border-bottom:1px solid #fff;" href="<?php echo WEB_ROOT; ?>guest/bookinglist.php" data-toggle="lightbox">Bookings</a></li>
        <li><a style="color:#000;text-align:left;border-bottom:1px solid #fff;" href="<?php echo WEB_ROOT; ?>booking"><i class="fa fa-shopping-cart"></i> Cart</a></li>
        <li><a style="color:#000;text-align:left;border-bottom:1px solid #fff;" href="<?php echo WEB_ROOT . 'logout.php'; ?>">Logout </a></li>

        <!-- New feedback item -->
        <li><a style="color:#000;text-align:left;border-bottom:1px solid #fff;" href="<?php echo WEB_ROOT; ?>feedback.php" data-toggle="lightbox">Feedback</a></li>
    </ul>
</li>

    
<?php } else { ?>
    <!-- Add logic for non-logged-in users -->
    <!-- You can add additional menu items or login/register links here -->
<?php } ?>



        </ul>
    </nav>
</div>

        </nav>
    </div>
</div>

</div>

    
<!-- Bootstrap Modal -->
<div class="modal fade" id="businessNotesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Business Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your content here -->
        <img src="https://pix10.agoda.net/hotelImages/9403826/-1/6662ff58892ad4c6e965f58d772543b2.jpg?ca=9&ce=1&s=414x232&ar=16x9" alt="Business Notes Image" class="img-fluid">

        <h4>Hotel Guidelines</h4>
        <ul id="hotelGuidelines">
          <li>Respect fellow guests and hotel staff.</li>
          <li>Follow posted safety guidelines.</li>
          <li>Conserve energy and water.</li>
          <!-- Add more hotel guidelines as needed -->
        </ul>
        <h4>Business Rules</h4>
        <ul id="businessRules">
          <li>No smoking in designated areas.</li>
          <li>Adhere to check-in and check-out times.</li>
          <li>Use hotel facilities responsibly.</li>
          <!-- Add more business rules as needed -->
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<style>
        .banner-top {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white; /* Add your desired background color */
            z-index: 1000;
        }

       
    </style>
<style>
  /* Add this CSS in your stylesheet or in a <style> tag in your HTML */

#businessNotesModal .modal-body {
  text-align: center;
}

#businessNotesModal img {
  max-width: 100%;
  height: auto;
  margin-bottom: 20px;
}

#businessNotesModal h4 {
  font-size: 24px;
  margin-top: 20px;
  margin-bottom: 10px;
}

#hotelGuidelines, #businessRules {
  list-style-type: none;
  padding: 0;
}

#hotelGuidelines li, #businessRules li {
  font-size: 18px;
  margin-bottom: 10px;
}

</style>



   <!-- slider
=====================================================================
 -->

<!-- end slider
==============================================================================
 -->
 


    <?php 
    require_once $content;  
    ?> 

<!-- fotter  
 =========================================== 
 --> 
 
 <!-- Bootstrap Footer -->
 <footer class="footer">
        <div class="container">
            <img src="https://i.ibb.co/ydJWLjZ/alohalogo.png" alt="Footer Image">
            <span>Copyright © 2024 Aloha Nui Hotel</span>
        </div>
    </footer>

<!-- 
==================================================  
 end
  -->

 

</div>
<!-- container -->
<!-- Modal photo -->
          <div class="modal fade" id="myModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type=
                  "button">×</button>

                  <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
                </div>

                <form action="<?php echo WEB_ROOT; ?>guest/update.php" enctype="multipart/form-data" method=
                "post">
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="rows">
                        <div class="col-md-12">
                          <div class="rows">
                            <div class="col-md-8">
                              <input name="MAX_FILE_SIZE" type=
                              "hidden" value="1000000"> <input id=
                              "image" name="image" type=
                              "file">
                            </div>

                            <div class="col-md-4"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type=
                    "button">Close</button> <button class="btn btn-primary"
                    name="savephoto" type="submit">Upload Photo</button>
                  </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

<!--Start of Tawk.to Script

<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/65b6e9e20ff6374032c5e777/1hl9837c0';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>


 -->


  <!-- jQuery -->
  <script  src="<?php echo WEB_ROOT; ?>jquery/jquery.min.js"></script> 
  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo WEB_ROOT; ?>js/bootstrap.min.js"></script>
 
  <!-- DataTables JavaScript -->
  <script src="<?php echo WEB_ROOT; ?>js/jquery.dataTables.min.js"></script>
  <script src="<?php echo WEB_ROOT; ?>js/dataTables.bootstrap.min.js"></script>


<script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
    <!-- Custom Theme JavaScript --> 


 <script src="<?php echo WEB_ROOT; ?>js/ekko-lightbox.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>js/plugins.js"></script>
<script  type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>js/html5.js"></script> 
<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>js/retina.js"></script>  
<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>js/global.js"></script> 

  <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>

<script type="text/javascript">
 $('.date_pickerfrom').datetimepicker({
  format: 'mm/dd/yyyy',
   startDate : '01/01/2000', 
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0 

    });


$('.date_pickerto').datetimepicker({
  format: 'mm/dd/yyyy',
   startDate : '01/01/2000', 
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0   

    });



$(document).ready( function() {

    $('.gallery-item').hover( function() {
        $(this).find('.img-title').fadeIn(400);
    }, function() {
        $(this).find('.img-title').fadeOut(100);
    });
  
});



$('.dbirth').datetimepicker({
  format: 'mm/dd/yyyy',
   startDate : '01/01/1960', 
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0   

    });



  //Validates Personal Info
        function personalInfo(){
        var a=document.forms["personal"]["name"].value;
        var b=document.forms["personal"]["last"].value;
        var c=document.forms["personal"]["city"].value;
        var d=document.forms["personal"]["address"].value;
        var e=document.forms["personal"]["dbirth"].value;  
        var f=document.forms["personal"]["zip"].value; 
        var g=document.forms["personal"]["phone"].value;
        var h=document.forms["personal"]["username"].value;
        var i=document.forms["personal"]["password"].value;


        // var atpos=f.indexOf("@");
        // var dotpos=f.lastIndexOf(".");
        // if (atpos<1 || dotpos<atpos+2 || dotpos+2>=f.length)
        //   {
        //   alert("Not a valid e-mail address");
        //   return false;
        //   }
        // if( f != g ) {
        // alert("email does not match");
        //   return false;
        // }
         if (document.personal.condition.checked == false)
        {
        alert ('pls. agree the term and condition of this hotel');
        return false;
        }
        if ((a=="Firstname" || a=="") || (b=="lastname" || b=="") || (c=="City" || c=="") || (d=="address" || d=="") || (e=="dateofbirth" || e=="") || (f=="Zip" || f=="") || (g=="Phone" || g=="")|| (h=="username" || h=="") || (j=="password" || j==""))
          {
          alert("all field are required!");
          return false;
          }


   
        
        // else
        // {
        // return true;
        // }

        }
</script>
<!--/.container-->
<script language="javascript" type="text/javascript">
        function OpenPopupCenter(pageURL, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        } 
    </script>



</body>
</html>
