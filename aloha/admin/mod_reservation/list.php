
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
<td width="80"><strong>ROOMS</strong></td>
<td width="80"><strong>Transaction Date</strong></td>
<td width="80"><strong>Confimation Code</strong></td>
<td width="70"><strong>Total Rooms</strong></td>
<td width="80"><strong>Total Price</strong></td>
<!-- <td width="80"><strong>Nights</strong></td> -->
<td width="80"><strong>Status</strong></td>
<td width="100"><strong>Initial_payment</strong></td> <!-- Add this line -->
<td width="100"><strong>Balance</strong></td> <!-- Add this line -->
<td width="100"><strong>Action</strong></td>
<th width="100"><strong>Print</strong></th> <!-- Add this line -->
</tr>
</thead>
<tbody>
<?php

$mydb->setQuery("SELECT `G_FNAME`, `G_LNAME`, `G_ADDRESS`, `TRANSDATE`, `CONFIRMATIONCODE`, `PQTY`, `SPRICE`, `STATUS`, `initial_payment`, `BALANCE`, `emailaddress`
                FROM `tblpayment` p
                INNER JOIN `tblguest` g ON p.`GUESTID` = g.`GUESTID`
                WHERE p.`is_archived` = 0
                ORDER BY p.`TRANSDATE` DESC");

$cur = $mydb->loadResultList();
				  		
foreach ($cur as $result) {
?>
<tr>
<td width="5%" align="center"></td>
<td><?php echo $result->G_FNAME." ".$result->G_LNAME; ?></td>
<td>			<a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">View Rooms</a></td>
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
 

<td><?php echo $result->initial_payment; ?></td> 
<td><?php echo $result->BALANCE; ?></td> 
<td>
    <?php 
    if($result->STATUS == 'Confirmed'){ ?>
        <div class="btn-group" role="group">
            <a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i> View</a>
            <a href="controller.php?action=checkin&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-success btn-xs"><i class="icon-edit"></i> Check in</a>
        </div>
    <?php
    } elseif($result->STATUS == 'Checkedin'){ ?>
        <div class="btn-group" role="group">
            <a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i> View</a>
            <a href="controller.php?action=checkout&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-danger btn-xs"><i class="icon-edit"></i> Check out</a>
        </div>
    <?php
    } elseif($result->STATUS == 'Checkedout'){ ?>
        <div class="btn-group" role="group">
            <a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>&sprice=<?php echo $result->SPRICE; ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i> View</a>
            <a href="controller.php?action=deleteOne&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-danger btn-xs"><i class="icon-edit"></i> Archive</a>
        </div>
    <?php } elseif($result->STATUS == 'Cancelled'){ ?>
        <div class="btn-group" role="group">
            <a href="controller.php?action=deleteOne&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-danger btn-xs"><i class="icon-edit"></i> Archive</a>
        </div>
    <?php } else { ?>
        <div class="btn-group" role="group">
            <a href="index.php?view=view&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i> View</a>
            <a href="controller.php?action=cancel&code=<?php echo $result->CONFIRMATIONCODE; ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i> Cancel</a>
            <a href="controller.php?action=confirm&code=<?php echo $result->CONFIRMATIONCODE; ?> " class="btn btn-success btn-xs" onclick="sendEmail('<?php echo $result->CONFIRMATIONCODE; ?>')" ><i class="icon-edit">Confirm</a>
        </div>
    <?php } ?>
</td>


<td>
            <!-- Add Print button -->
            <a href="javascript:void(0);" onclick="printEntry('<?php echo $result->CONFIRMATIONCODE; ?>');" class="btn btn-info btn-xs"><i class="icon-print">Print</a>
         </td>

<?php }
?>
  
		<div class="modal fade" id="profile" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						

						<div class="alert alert-info">Profile:</div>
					</div>

					<form action="#"  method=
					"post">
						<div class="modal-body">
					
												
								<div id="display">
									
										<p>ID : <div id="infoid"></div></p><br/>
											Name : <div id="infoname"></div><br/>
											Email Address : <div id="Email"></div><br/>
											Gender : <div id="Gender"></div><br/>
											Birthday : <div id="bday"></div>
										</p>
										
								</div>
						</div>

						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal" type=
							"button">Close</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

</table>
<div class="btn-group">
				  <a href="index.php?view=archive" class="btn btn-default">View Archive</a>
				
				</div>

</form>
<!-- </div> -->
</div>

<script>
   function printEntry(confirmationCode) {
      // You can customize the URL based on your requirements
      
      var printUrl = 'print_all.php?confirmationCode=' + confirmationCode;
      var printWindow = window.open(printUrl, '_blank');
      printWindow.print();
   }
</script>



 