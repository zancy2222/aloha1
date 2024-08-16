
<?php
require_once ("../includes/initialize.php");
  if (!isset($_SESSION['GUESTID'])){
      redirect("index.php");
     }

 ?>



<div class='book'>


		<table>
			<tr>
				<td width="87%" align="center">
				<img src="https://i.ibb.co/ydJWLjZ/alohalogo.png" alt="ALOHA NUI HOTEL Logo" class="hotel-logo" style="width: 20%;">
				<h3 >Aloha Nui Hotel</h3> 
				
				</td>
			</tr>
		</table>
		<h2 class="modal-title" id="myModalLabel">Billing Statement </h2> 	
 
<?php 

		
?> 
		<table id="table" class="fixnmix-table">
			<thead>
				<tr>
					<th align="center" width="120">Room</th>
		        
		              <th  width="120">Price</th> 
		              <th align="center" width="120">Nights</th>
		              <th align="center" width="90">Amount</th>
					  <th align="center" width="90">Status</th>
					  <th align="center" width="90">Balance</th>
					  

					  
					  

				</tr>
				</thead>
				<tbody>
 
				<?php
$query = "SELECT * 
          FROM  `tblreservation` r,   `tblroom` rm, tblaccomodation a
          WHERE r.`ROOMID` = rm.`ROOMID` 
          AND a.`ACCOMID` = rm.`ACCOMID`  
          AND  r.`GUESTID` = " . $_SESSION['GUESTID'];
$mydb->setQuery($query);
$res = $mydb->loadResultList();

foreach ($res as $result) {
    $day = (dateDiff($result->ARRIVAL, $result->DEPARTURE) > 0) ? dateDiff($result->ARRIVAL, $result->DEPARTURE) : '1';

    echo '<tr>';
    echo '<td>' . $result->ROOM . ' ' . $result->ROOMDESC . ' </td>';
    echo '<td > &#8369 ' . $result->PRICE . '</td>';
    echo '<td>' . $day . '</td>';
    echo '<td > &#8369 ' . $result->RPRICE . '</td>';
    
    // Check if STATUS property exists before accessing it
    echo '<td>';
    if (property_exists($result, 'STATUS')) {
        echo $result->STATUS;
    } else {
        echo 'N/A'; // or any default value you prefer
    }
    echo '</td>';


	  // Check if STATUS property exists before accessing it
	  echo '<td>';
	  if (property_exists($result, 'BALANCE')) {
		  echo $result->BALANCE;
	  } else {
		  echo '0'; // or any default value you prefer
	  }
	  echo '</td>';

    echo '</tr>';
}

?>

			</tbody>
	 
       </table>  
 
	   </div>