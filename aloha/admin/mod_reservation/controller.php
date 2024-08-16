<?php
require_once("../../includes/initialize.php");


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'modify' :
	dbMODIFY();
	break;
	
	case 'delete' :
	dbDELETE();
	break;

	case 'applydiscount' :
        applyDiscount();
        break;

		

	case 'unArchive' :
		dbUNARCHIVE();
		break;
	
	case 'deleteOne' :
	dbDELETEONE();
	break;
	case 'confirm' :
	doConfirm();
	break;
	case 'cancel' :
	doCancel();
	break;
	case 'checkin' :
	doCheckin();
	break;
	case 'checkout' :
	doCheckout();
	break;
	case 'cancelroom' :
	doCancelRoom();
	break;
	}

	function doCheckout(){
		global $mydb;
	
		// Update tblreservation and tblpayment
		$sql = "UPDATE `tblreservation` SET `STATUS`='Checkedout' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($sql);
		$mydb->executeQuery();
	
		$sql = "UPDATE `tblpayment` SET `STATUS`='Checkedout' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($sql);
		$mydb->executeQuery();
	
		$sql = "UPDATE `tblreservation` r,tblroom rm SET ROOMNUM=ROOMNUM + 1 WHERE r.`ROOMID`=rm.`ROOMID` AND `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($sql);
		$mydb->executeQuery();
	
		message("Reservation Updated successfully!", "success");
		redirect('index.php');
	}
	
	function doCheckin(){
		global $mydb;
	// $id = $_GET['id'];
	
	// $res = new Reservation();
	// $res->STATUS = 'Checkedin';
	// $res->update($id); 
			$sql = "UPDATE `tblreservation` SET `STATUS`='Checkedin' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	 
	
	$sql = "UPDATE `tblpayment` SET `STATUS`='Checkedin' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	
	
	message("Reservation Upadated successfully!", "success");
	redirect('index.php');
	
	
	
	}

	function doCancel(){
		global $mydb;
	
	
	$sql = "UPDATE `tblreservation` r,tblroom rm SET ROOMNUM=ROOMNUM + 1 WHERE r.`ROOMID`=rm.`ROOMID` AND `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($sql);
		$mydb->executeQuery();
	
	
	$sql = "UPDATE `tblreservation` SET `STATUS`='Cancelled' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	
	
	$sql = "UPDATE `tblpayment` SET `STATUS`='Cancelled' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	
  
	$mydb->setQuery("SELECT g.`emailaddress`
                FROM `tblpayment` p
                INNER JOIN `tblguest` g ON p.`GUESTID` = g.`GUESTID`
                WHERE p.`CONFIRMATIONCODE` = '" . $_GET['code'] . "' AND p.`is_archived` = 0
                ORDER BY p.`STATUS`='pending' DESC");

	$cur = $mydb->loadResultList();
	
	$mail = new PHPMailer(true);

	foreach ($cur as $result) {
	
    try {
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'tlqdevera.ccit@unp.edu.ph';
		$mail->Password = 'PerryThePlatypus.2002';
		$mail->SMTPSecure = null;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		$mail->Port = 587;
		$mail->setFrom('tlqdevera.ccit@unp.edu.ph', 'Aloha Nui Hotel');
		$mail->addAddress($result->emailaddress);
		$mail->Subject = 'ALOHA BOOKING';
		$mail->isHTML(true);
		
        // Generate the content of print_entry.php with confirmation code
		$confirmationCode = isset($_GET['code']) ? $_GET['code'] : '';
		$printEntryContent = generatePrintEntryContent($confirmationCode);

		// Set the generated content as the email body
		$mail->Body = $printEntryContent;
	
		$mail->send();
        

        // Success message
        echo '<div style="color: green;">Message has been sent successfully!</div>';

    } catch (Exception $e) {
        // Error message
        echo '<div style="color: red;">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
    }
					
	message("Reservation Upadated successfully!", "success");
	redirect('index.php');
}
	}

	function generatePrintEntryContent($confirmationCode) {
		ob_start();
	
		// Include the file and pass the confirmation code as a variable
		include('print_entry.php');
		
		return ob_get_clean();
	}
	
	function doCancelRoom(){
	// $id = $_GET['id'];
	global $mydb;
	// $res = new Reservation();
	// $res->STATUS = 'Cancelled';
	// $res->update($id); 
		$mydb->setQuery("SELECT * FROM `tblreservation` WHERE  `RESERVEID` ='" . $_GET['id'] ."'");
		$cur = $mydb->loadResultList(); 
		foreach ($cur as $result) {  
	
		$room = new Room(); 
		$room->ROOMNUM    = $room->ROOMNUM + 1; 
		$room->update($result->ROOMID); 
	
		}
	
	
	$sql = "UPDATE `tblreservation` SET `STATUS`='Cancelled' WHERE `RESERVEID` ='" . $_GET['id'] ."'";
	mysql_query($sql) or die(mysql_error());
	
					
	message("Reservation Upadated successfully!", "success");
	redirect('index.php');
	
	}
	
	function doConfirm(){
		global $mydb;
	// $id = $_GET['id'];
	
	// $res = new Reservation();
	// $res->STATUS = 'Confirmed';
	// $res->update($id);
	 $sql = "UPDATE `tblreservation` r,tblroom rm SET ROOMNUM=ROOMNUM - 1 WHERE r.`ROOMID`=rm.`ROOMID` AND  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	 $mydb->setQuery($sql);
	 $mydb->executeQuery();
	
	
	$sql = "UPDATE `tblreservation` SET `STATUS`='Confirmed' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	
	$sql = "UPDATE `tblpayment` SET `STATUS`='Confirmed' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	

	$mydb->setQuery("SELECT g.`emailaddress`
                FROM `tblpayment` p
                INNER JOIN `tblguest` g ON p.`GUESTID` = g.`GUESTID`
                WHERE p.`CONFIRMATIONCODE` = '" . $_GET['code'] . "' AND p.`is_archived` = 0
                ORDER BY p.`STATUS`='pending' DESC");

	$cur = $mydb->loadResultList();
	
	$mail = new PHPMailer(true);

	foreach ($cur as $result) {
	
    try {
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'tlqdevera.ccit@unp.edu.ph';
		$mail->Password = 'PerryThePlatypus.2002';
		$mail->SMTPSecure = null;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		$mail->Port = 587;
		$mail->setFrom('tlqdevera.ccit@unp.edu.ph', 'Aloha Nui Hotel');
		$mail->addAddress($result->emailaddress);
		$mail->Subject = 'ALOHA BOOKING';
		$mail->isHTML(true);
		
        // Generate the content of print_entry.php with confirmation code
		$confirmationCode = isset($_GET['code']) ? $_GET['code'] : '';
		$printEntryContent = generatePrintEntryContent($confirmationCode);

		// Set the generated content as the email body
		$mail->Body = $printEntryContent;
	
		$mail->send();
	
        

        // Success message
        echo '<div style="color: green;">Message has been sent successfully!</div>';

    } catch (Exception $e) {
        // Error message
        echo '<div style="color: red;">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
    }
	
}

message("Reservation Upadated successfully!", "success");
	redirect('index.php');
	}	
	/*function dbMODIFY(){
	$id = $_GET['id'];
	$arrival=$_POST['arrival'];
	$departure=$_POST['departure'];
	$adults=$_POST['adults'];
	$child=$_POST['child'];
	$sql="UPDATE reservation SET arrival='$arrival', departure='$departure',adults='$adults',child='$child' WHERE reservation_id=".$id;
	$result = dbQuery($sql);
	if(!$result)
	{
	  die('Could not modify record: ' . mysql_error());
	} else {
	
	header('Location:index_resv.php');}
	}
	*/
	function dbDELETEONE() {
    global $mydb;
	
    if (isset($_GET['code'])) {
        $code = $_GET['code'];

        $sql = "UPDATE `tblpayment` SET `is_archived`= 1 WHERE `CONFIRMATIONCODE` ='" . $code . "'";
        $mydb->setQuery($sql);
        $mydb->executeQuery();

        message("Archive successfully!", "success");
    } else {
        message("Invalid or missing code", "error");
    }

    redirect('index.php');
}

function dbUNARCHIVE() {
    global $mydb;
	
    if (isset($_GET['code'])) {
        $code = $_GET['code'];

        $sql = "UPDATE `tblpayment` SET `is_archived`= 0 WHERE `CONFIRMATIONCODE` ='" . $code . "'";
        $mydb->setQuery($sql);
        $mydb->executeQuery();

        message("Data Retrieve successfully!", "success");
    } else {
        message("Invalid or missing code", "error");
    }

    redirect('index.php');
}

function applyDiscount() {
	global $mydb;
    
	if (isset($_GET['code'])) {
		$code = $_GET['code'];

		// Assuming you have a fixed 20% discount
		$discountFactor = 0.20;

		// Update the SPRICE in tblpayment with the discount formula for the specified code
		$sql = "UPDATE tblpayment
				SET SPRICE = SPRICE - (SPRICE * $discountFactor)
				WHERE CONFIRMATIONCODE = '$code'";

		$mydb->setQuery($sql);

		// Execute the query
		if ($mydb->executeQuery()) {
			// Redirect after the update is done
			redirect('index.php');
		} else {
			// Handle the case when the query execution fails
		 
		}
	} else {
		// Handle the case when 'code' is not set in $_GET
		// For example, you can redirect the user to an error page.
		echo 'Invalid or missing code';
	}

	message("Reservation Upadated successfully!", "success");
	redirect('index.php');

}
?>
 