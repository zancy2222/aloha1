<?php

if (!isset($_SESSION['monbela_cart'])) {
  # code...
  redirect(WEB_ROOT.'index.php');
}


// if (isset($_POST['profileCheck'])) {
//   # code...
//     unset($_SESSION['pay']);
//    unset($_SESSION['monbela_cart']);
// }

/*$guestid =$_GET['guestid'];
$guest = new Guest();
$result=$guest->single_guest($guestid);*/

  $name = $_SESSION['name']; 
  $last = $_SESSION['last'];
  // $country =$_SESSION['country'];
  $city = $_SESSION['city'] ;
  $address = $_SESSION['address'];
  $zip =  $_SESSION['zip'] ;
  $phone = $_SESSION['phone'];
  // $email = $_SESSION['email'];
  // $password =$_SESSION['pass'];
  $stat = $_SESSION['pending'];

?>

 <div id="accom-title"  > 
    <div  class="pagetitle">   
            <h1  >Reservation Details
                 
            </h1> 
       </div> 
  </div>

<div class="container"> 

    <div class="col-xs-12 col-sm-11">
      <!--<div class="jumbotron">-->
        <div class="">
           

          <td valign="top" class="body" style="padding-bottom:10px;">

           <form action="index.php?view=payment" method="post"  name="" >
            <span id="printout">
            
           <p>
            <? print(Date("l F d, Y")); ?>
            <br/><br/>
           Sir/Madam <?php echo $name.' '.$last;?> <br/>
           <?php echo $address;?><br/>
           <?php echo $phone;?> <br/>
           <!-- <?php echo $email;?><br/><br/> -->
           Dear Sir/Madam. <?php echo $last;?>,<br/><br/>
           Greetings from monbela Beach Resorts!<br/><br/>
           Please check the details of your reservation:<br/><br/>
           <strong>GUEST NAME(S):</strong> <?php echo $name.' '.$last;?>


          </p>

        <table class="table table-hover">
              <thead>
                <tr  bgcolor="#999999">
                  <!-- <th width="10">#</th> -->
                  <th align="center" width="120">Room Type</th>
                  <th align="center" width="120">Check In</th>
                  <th align="center" width="120">Check Out</th>
                  <th align="center" width="120">Nights</th>
                  <th  width="120">Price</th>
                  <th align="center" width="120">Room</th>
                  <th align="center" width="90">Amount</th> 
                </tr> 
              </thead>
          <tbody>
          
            <?php




             // $arival   = $_SESSION['from']; 
             //  $departure = $_SESSION['to']; 
              // $days = dateDiff($arival,$departure);
              $count_cart = count($_SESSION['monbela_cart']);

                for ($i=0; $i < $count_cart  ; $i++) {    
              $mydb->setQuery("SELECT * FROM `tblroom` r, `tblaccomodation` a WHERE  r.`ACCOMID`=a.`ACCOMID` AND `ROOMID` =". $_SESSION['monbela_cart'][$i]['monbelaroomid']);
              $cur = $mydb->loadResultList();

              foreach ($cur as $result) {
                echo '<tr>'; 
                // echo '<td></td>';
                echo '<td>'. $result->ROOM.' '. $result->ACCOMODATION.'</td>';
                echo '<td>'.$_SESSION['monbela_cart'][$i]['monbelacheckin'].'</td>';
                echo '<td>'.$_SESSION['monbela_cart'][$i]['monbelacheckout'].'</td>';
                echo '<td>'.$_SESSION['monbela_cart'][$i]['monbeladay'].'</td>';
                echo '<td> &#8369 '. $result->PRICE.'</td>';
                echo '<td >1</td>';
                echo '<td >'. $_SESSION['monbela_cart'][$i]['monbelaroomprice'].'</td>'; 
                echo '</tr>';
              } 


          }
           $payable= $result->PRICE *$days;
           $_SESSION['pay']= $payable;
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5"></td><td align="right"><h5><b>Order Total: </b></h5>
              <td align="left">
              <h5><b> <?php echo ' &#8369 ' . $payable= $days*$result->PRICE; ?></b></h5>
                           
              </td>
            </tr>
            <!--   <tr>
            <td colspan="4"></td><td colspan="5">
                  <div class="col-xs-12 col-sm-12" align="right">
                      <button type="submit" class="btn btn-primary" align="right" name="btnlogin">Payout</button>
                  </div>

            </td>
            </tr> -->

          </tfoot>  
        </table>

    <?php   
     // unset($_SESSION['pay']);
     //    unset($_SESSION['monbela_cart']);
        ?>
<p>We are eagerly anticipating your arrival and would like to advise you of the following in order to help you with your trip planning.Your reservation number is <b><?php echo $_SESSION['confirmation']?>:</b><br/><br/>Should there be a concern with your reservation, a customer service representative will contact you. Otherwise, consider your reservation confirmed.</p>
<ul>
 <li>Function Room rate is Php 500.00 for first four hours and Php 100.00 for each succeeding hours.</li>
 <li>No pets allowed.</li>
 <li>Outside foods are allowed inside the guest house.</li>
 <li>Check in time is 1pm and Check out time is 12 noon.</li>
 <li>Guest arriving before 1 pm shall be accommodated if rooms are vacant and ready.</li>
 <li>Free WIFI access.</li>
 <li>Room rates inclusive of government tax and service charge.</li>
 <li>Rates are subject to change without prior notice.</li>
 <li>Cancellation notification must be made at least 10 days prior to arrival for refund of deposits. Cancellation received within the 10 days period will result to forfeiture of full deposits.</li>
 <li>We serve Breakfast, Lunch and Dinner upon request with 2 hours notice.</li><br>
<strong>I have agreed that I will present the following documents upon check in:</strong><br/>
 <li>Copy of BDO Payment.</li>
 <li>Authorization letter issued by BDO payer for guest/s whose transactions were paid for in his/ her behalf.</li>
 </ul>
If you have any questions, please email at monbelaBeachResorts.com or call (034) 4713 – 135
<br/><br/>
Thank you for choosing monbela beach Resorts
<br/><br/>
Respectfully your,<br/><br/>
monbela Beach Resorts
<br/><br/><br/>
</span>
<div id="divButtons" name="divButtons">
<a href="print_reservation.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
<!-- <input type="button" value="Print" onclick="tablePrint();" class="btn btn-primary"> -->
</div>
              </form>
 
        </div>
    <!--  </div>-->
    </div>
    <!--/span--> 
    <!--Sidebar-->

  </div>
  <!--/row-->
  <script>
function tablePrint(){ 
 document.all.divButtons.style.visibility = 'hidden';  
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=no,width=500, height=500, left=100, top=25";  
    var content_innerhtml = document.getElementById("printout").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></html>');  
    document_print.print();  
    document_print.document.close(); 
   
    return false;  
    } 
  $(document).ready(function() {
    oTable = jQuery('#list').dataTable({
    "bJQueryUI": true,
    "sPaginationType": "full_numbers"
    } );
  });   
</script>