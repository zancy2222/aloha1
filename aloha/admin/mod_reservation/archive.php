<div class="container">
<?php
		check_message();
			
		?>
<!-- <div class="panel panel-primary"> -->
			<div class="panel-body">
<form  method="post" action="processreservation.php?action=delete">
	<table id="table" class="table table-striped" cellspacing="0">
<thead>
<tr>
<td width="5%">#</td>	

<td width="90"><strong>Guest</strong></td>
<!--<td width="10"><strong>Confirmation</strong></td>-->
<td width="80"><strong>Transaction Date</strong></td>
<td width="80"><strong>Confimation Code</strong></td>
<td width="70"><strong>Total Rooms</strong></td>
<td width="80"><strong>Total Price</strong></td>
<!-- <td width="80"><strong>Nights</strong></td> -->
<td width="80"><strong>Status</strong></td>
<td width="100"><strong>Coupon Code</strong></td> <!-- Add this line -->
<td width="100"><strong>Initial_payment</strong></td> <!-- Add this line -->
<td width="100"><strong>Balance</strong></td> <!-- Add this line -->
<td width="100"><strong>Action</strong></td>

</tr>
</thead>
<tbody>
<?php

$mydb->setQuery("SELECT `G_FNAME`, `G_LNAME`, `G_ADDRESS`, `TRANSDATE`, `CONFIRMATIONCODE`, `PQTY`, `SPRICE`, `STATUS`, `COUPON_CODE`, `initial_payment`, `BALANCE`
                FROM `tblpayment` p
                INNER JOIN `tblguest` g ON p.`GUESTID` = g.`GUESTID`
                WHERE p.`is_archived` = 1
                ORDER BY p.`STATUS`='pending' DESC");

$cur = $mydb->loadResultList();
				  		
foreach ($cur as $result) {
?>
<tr>
<td width="5%" align="center"></td>
<td><?php echo $result->G_FNAME." ".$result->G_LNAME; ?></td>
<td><?php echo $result->TRANSDATE; ?></td>
<!-- <td><?php echo date_format(date_create($result->ARRIVAL),'m/d/Y'); ?></td>
<td><?php echo date_format(date_create($result->DEPARTURE),'m/d/Y'); ?></td> -->
<!--<td><?php echo $result->roomName; ?></td>-->
<!-- <td><?php echo $result->ACCOMODATION; ?></td> -->
<!-- <td><?php echo dateDiff($result->ARRIVAL,$result->DEPARTURE); ?></td> -->
<td><?php echo $result->CONFIRMATIONCODE; ?></td>
<td><?php echo $result->PQTY; ?></td>
<td><?php echo $result->SPRICE; ?></td>
<td><?php echo $result->STATUS; ?></td> 
<td><?php echo $result->COUPON_CODE; ?></td> <!-- Add this line -->

<td><?php echo $result->initial_payment; ?></td> 
<td><?php echo $result->BALANCE; ?></td> 

<td >


<a href="controller.php?action=unArchive&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-warning btn-xs">
    <i class="icon-edit">Retrieve</i>
</a>

		


	
	
</td>


<?php }
?>
  
	

</table>
<div class="btn-group">
				  <a href="index.php" class="btn btn-default">Go back</a>
				
				</div>

</form>
<!-- </div> -->
</div>



