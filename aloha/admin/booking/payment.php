<?php

if (!isset($_SESSION['monbela_cart'])) {
    # code...
    redirect(WEB_ROOT . 'index.php');
}

function createRandomPassword()
{

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";

    srand((float)microtime() * 1000000);

    $i = 0;

    $pass = '';
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;
    }

    return $pass;
}

$confirmation = createRandomPassword();
$_SESSION['confirmation'] = $confirmation;



// $arival    = $_SESSION['from']; 
// $departure = $_SESSION['to'];
// echo $name      = $_SESSION['name']; 
// echo $last      = $_SESSION['last'];
// echo $nationality   = $_SESSION['nationality'];
// // echo // $city      = $_SESSION['city'] ;
// echo $address   =  $_SESSION['city'] . ' ' . $_SESSION['address'];
// echo $zip       = $_SESSION['zip'] ;
// echo $phone     = $_SESSION['phone'];
// echo $username     = $_SESSION['username'];
// echo $company     = $_SESSION['company'];
// echo $caddress     = $_SESSION['caddress'];
// echo $password  = $_SESSION['pass'];
// echo $dbirth   = $_SESSION['dbirth'];


$count_cart = count($_SESSION['monbela_cart']);

if (isset($_POST['btnsubmitbooking'])) {
    $message = $_POST['message'];






    if (!isset($_SESSION['GUESTID'])) {

        // var_dump($_SESSION);exit;

        $guest = new Guest();
        $guest->G_FNAME          = $_SESSION['name'];
        $guest->G_LNAME          = $_SESSION['last'];
        $guest->G_CITY           = $_SESSION['city'];
        $guest->G_ADDRESS        = $_SESSION['address'];
        $guest->DBIRTH           = date_format(date_create($_SESSION['dbirth']), 'Y-m-d');
        $guest->G_PHONE          = $_SESSION['phone'];
        $guest->G_NATIONALITY    = $_SESSION['nationality'];
        $guest->G_COMPANY        = $_SESSION['company'];
        $guest->G_CADDRESS       = $_SESSION['caddress'];
        $guest->G_TERMS          = 1;
        $guest->G_UNAME          = $_SESSION['username'];
        $guest->G_PASS           = sha1($_SESSION['pass']);
        $guest->ZIP              = $_SESSION['zip'];
        $guest->create();
        $lastguest = $guest->id;

        $_SESSION['GUESTID'] =   $lastguest;
    }

    $count_cart = count($_SESSION['monbela_cart']);


    for ($i = 0; $i < $count_cart; $i++) {

        // $rm = new Room();
        // $result = $rm->single_room($_SESSION['monbela_cart'][$i]['monbelaroomid']);

        // if($result->ROOMNUM>0){

        //   $room = new Room(); 
        //   $room->ROOMNUM    = $room->ROOMNUM - 1; 
        //   $room->update($_SESSION['monbela_cart'][$i]['monbelaroomid']); 

        // }
        $reservation = new Reservation();
        $reservation->CONFIRMATIONCODE = $_SESSION['confirmation'];
        $reservation->TRANSDATE = date('Y-m-d h:i:s');
        $reservation->ROOMID = $_SESSION['monbela_cart'][$i]['monbelaroomid'];
        $reservation->ARRIVAL = date_format(date_create($_SESSION['monbela_cart'][$i]['monbelacheckin']), 'Y-m-d');
        $reservation->DEPARTURE = date_format(date_create($_SESSION['monbela_cart'][$i]['monbelacheckout']), 'Y-m-d');
        $reservation->RPRICE = $_SESSION['pay'];
        $reservation->GUESTID = $_SESSION['GUESTID'];
        $reservation->PRORPOSE = 'Travel';
        $reservation->STATUS = 'Pending';

 // Check if the file input has a file selected
 if (isset($_FILES['paymentProof']) && $_FILES['paymentProof']['error'] === UPLOAD_ERR_OK) {
    // Specify the target directory for uploads
    $targetDir = 'proof/';
    
    // Get the original file name
    $originalFileName = basename($_FILES['paymentProof']['name']);
    
    // Generate a unique name for the uploaded file to avoid overwriting existing files
    $uniqueFileName = uniqid() . '_' . $originalFileName;
    
    // Specify the path where the file will be moved to
    $targetPath = $targetDir . $uniqueFileName;

   // Move the uploaded file to the destination directory
   if (move_uploaded_file($_FILES['paymentProof']['tmp_name'], $targetPath)) {
    // Set the proof_of_transaction property with the unique file name
    $reservation->proof_of_transaction = $uniqueFileName;
    echo "File successfully uploaded. File name: " . $uniqueFileName;
} else {
    echo "Error moving the uploaded file.";
}
} else {
echo "No file uploaded or an error occurred.";
}
    

    
        // Retrieve the applied coupon code from the session
        $applied_coupon_code = isset($_SESSION['applied_coupon_code']) ? $_SESSION['applied_coupon_code'] : null;
    
        // Add the coupon code to the reservation
        $reservation->COUPON_CODE = $applied_coupon_code;
    
        // Save the reservation object to the database
        $reservation->create(); // Adjust this method based on your implementation
    


        @$tot += $_SESSION['pay'];
    }

    $item = count($_SESSION['monbela_cart']);

    $sql = "INSERT INTO `tblpayment` (`TRANSDATE`,`CONFIRMATIONCODE`,`PQTY`, `GUESTID`, `SPRICE`,`MSGVIEW`,`STATUS`, `COUPON_CODE`, `initial_payment`)
    VALUES ('" . date('Y-m-d h:i:s') . "','" . $_SESSION['confirmation'] . "'," . $item . "," . $_SESSION['GUESTID'] . "," . $tot . ",0,'Pending', '$applied_coupon_code', 0)";
    




    $mydb->setQuery($sql);
    $msg = $mydb->executeQuery();

    //   $lastreserv=mysql_insert_id(); 
    //   $mydb->setQuery("INSERT INTO `comments` (`firstname`, `lastname`, `email`, `comment`) VALUES('$name','$last','$email','$message')");
    //   $msg = $mydb->executeQuery();
    //   message("New [". $name ."] created successfully!", "success");

    //  unsetSessions();

    unset($_SESSION['monbela_cart']);
    // unset($_SESSION['confirmation']);
    unset($_SESSION['pay']);
    unset($_SESSION['from']);
    unset($_SESSION['to']);
    $_SESSION['activity'] = 1;

?>

    <script type="text/javascript">
        alert("Booking is successfully submitted!");
    </script>

<?php


redirect(WEB_ROOT . "index.php");
}
?>


<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
}
?>
<div id="modern-accom-title" class="container d-flex justify-content-center align-items-center vh-100">
    <div class="custom-pagetitle text-center">
        <h1 class="custom-heading">Billing Details</h1>
    </div>
</div>


<style>
    /* Add any additional custom styles here */
    #modern-accom-title {
        background-color: #6d4330;
        /* Set background color to black */
    }

    .custom-pagetitle {
        padding: 20px;
        /* Add custom padding */
        border-radius: 10px;
        /* Add border-radius for rounded corners */
    }

    .custom-heading {
        color: #ffffff;
        /* Set text color to black */
    }
</style>

<div id="bread">
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_ROOT; ?>index.php">Home</a> </li>
        <li><a href="<?php echo WEB_ROOT; ?>booking/">Booking Cart</a></li>
        <!-- <li  ><a href="<?php echo WEB_ROOT; ?>booking/index.php?view=logininfo">Verify Accounts</a></li> -->
        <li class="active">Booking Details</li>
    </ol>
</div>



<div>


<form id="bookingForm" action="index.php?view=payment" method="post" name="personal" enctype="multipart/form-data">



        <div class="col-md-12">

            <div class="row">
                <div class="col-md-8 col-sm-4">
                    <div class="col-md-12">
                        <label>Name:</label>
                        <?php echo $_SESSION['name'] . ' ' . $_SESSION['last'];
                        
                        ?>
                    </div>
                    <div class="col-md-12">
                        <label>Address:</label>
                        <?php echo isset($_SESSION['city']) ? $_SESSION['city'] : ' ' . ' ' . (isset($_SESSION['address'])  ? $_SESSION['address'] : ' '); ?>
                    </div>
                    <div class="col-md-12">
                        <label>Phone #:</label>
                        <?php echo $_SESSION['phone']; ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-2">
                    <div class="col-md-12">
                        <label>Transaction Date:</label>
                        <?php echo date("m/d/Y"); ?>
                    </div>
                    <div class="col-md-12">
                        <label>Transaction Id:</label>
                        <?php echo $_SESSION['confirmation']; ?>
                    </div>

                </div>
            </div>
            <br />




            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Room</td>
                                <td>Arrival</td>
                                <td>Departure</td>
                                <td>Price</td>
                                <td>Night(s)</td>
                                <td>Subtotal</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $payable = $_SESSION['pay'] ;
                            if (isset($_SESSION['monbela_cart'])) {
                                $count_cart = count($_SESSION['monbela_cart']);


                                for ($i = 0; $i < $count_cart; $i++) {

                                    $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND ROOMID=" . $_SESSION['monbela_cart'][$i]['monbelaroomid'];
                                    $mydb->setQuery($query);
                                    $cur = $mydb->loadResultList();
                                    foreach ($cur as $result) {


                            ?>


                                        <tr>
                                            <td><?php echo  $result->ROOM . ' ' . $result->ROOMDESC; ?></td>
                                            <td><?php echo  date_format(date_create($_SESSION['monbela_cart'][$i]['monbelacheckin']), "m/d/Y"); ?></td>
                                            <td><?php echo  date_format(date_create($_SESSION['monbela_cart'][$i]['monbelacheckout']), "m/d/Y"); ?></td>
                                            <td><?php echo  ' &#8369 ' . $result->PRICE; ?></td>
                                            <td><?php echo   $_SESSION['monbela_cart'][$i]['monbeladay']; ?></td>
                                            <td><?php echo ' &#8369 ' .   $_SESSION['pay'];?></td>
                                        </tr>
                            <?php
                                        $payable += $_SESSION['monbela_cart'][$i]['monbelaroomprice'];
                                    }
                                }
                              
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>




            <hr />
            <label for="paymentProof">Upload Payment Proof:</label>
                            <input type="file" id="paymentProof" name="paymentProof" required>
            <div class="row">
                <h3 align="right">Total: &#8369 <?php echo   $_SESSION['pay']; ?></h3>
            </div>
            <div class="pull-right">
                <!-- Remove the previous "Submit Booking" button -->
                <!-- Button to trigger the payment modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="showGCashInstructions();">
                 Pay with Gcash
                </button>
                  <!--   <button type="button" id="downloadButton" class="btn btn-primary" onclick="downloadTransactionDetails()">Download Transaction Details</button>-->
           
              
                          
                  <button type="submit" class="btn btn-primary" align="right" name="btnsubmitbooking" >Submit Booking</button>
                     
            </div>
        </div>
</div>
</form>

</div>




<script>
   

    function showGCashInstructions() {
    var totalAmount = <?php echo $_SESSION['pay']; ?>;
    var fiftyPercent = totalAmount * 0.5;

    var gcashInstructionsModal = `
        <div class="modal fade" id="gcashInstructionsModal" tabindex="-1" role="dialog" aria-labelledby="gcashInstructionsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gcashInstructionsModalLabel">GCash Payment Instructions</h5>
                        <h5 class="modal-title" id="gcashInstructionsModalLabel">Minimum Payment of: &#8369 ${fiftyPercent}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>1. Open GCash app and scan or send a minimum of 50% of the total amount to the provided GCash number.</p>
                        <!-- Add an image here for the GCash QR code or number -->
                        <img src="img/gcash.jpg" alt="GCash QR Code or Number" style="max-width: 100%; height: auto;">

                        <p>2. After completing the payment, exit this modal and upload the payment transaction then submit the booking!</p>
                        <!-- Input text box for Reference ID -->
                     
                       

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       
                  
                    </div>
                </div>
            </div>
        </div>
    `;

    $('body').append(gcashInstructionsModal);
    $('#gcashInstructionsModal').modal('show');

        // Disable the submit button initially
        $('#submitBookingBtn').prop('disabled', true);

// Add validation to prevent form submission when required fields are empty
$('#bookingForm').submit(function(event) {
    var paymentProof = $('#paymentProof').val();

    if (paymentProof.trim() === '') {
        // Display an alert or do something to inform the user about the empty fields
        alert('Please fill in all required fields.');
        event.preventDefault(); // Prevent form submission
    }
});


}

</script>

<script>
    function downloadTransactionDetails() {
        // Call the PHP function to generate the PDF
        var pdfFilename = <?php echo json_encode(generateTransactionPDF()); ?>;

        // Create a link element
        var link = document.createElement('a');

        // Set the href attribute to the file path
        link.href = pdfFilename;

        // Set the download attribute with the desired file name
        link.download = 'transaction_details.pdf';

        // Append the link to the document
        document.body.appendChild(link);

        // Trigger a click on the link to start the download
        link.click();

        // Remove the link from the document
        document.body.removeChild(link);
    }
</script>


<?php

function generateTransactionPDF()
{
    // Include the FPDF library
    require('fpdf/fpdf.php');

    // Create a new PDF instance with smaller size (e.g., A5)
    $pdf = new FPDF('P', 'mm', 'A5');
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', 'B', 16);

    // Add a title
    $pdf->Cell(0, 10, 'Transaction Details', 0, 1, 'C');

    // Set font for the content
    $pdf->SetFont('Arial', '', 12);

    // Add a table for the content

    $pdf->Cell(40, 10, 'Names:', 1, 0, 'C');
    $pdf->Cell(90, 10, $_SESSION['name'] . ' ' . $_SESSION['last'], 1, 1);


    $pdf->Cell(40, 10, 'Address:', 1, 0, 'C');
    $pdf->Cell(90, 10, ($_SESSION['city'] ?? '') . ' ' . ($_SESSION['address'] ?? ''), 1, 1);


    $pdf->Cell(40, 10, 'Phone #:', 1, 0, 'C');
    $pdf->Cell(90, 10, $_SESSION['phone'], 1, 1);


    $pdf->Cell(40, 10, 'Transaction ID:', 1, 0, 'C');
    $pdf->Cell(90, 10, $_SESSION['confirmation'], 1, 1);

    // Save the PDF to a file (you can change the filename and path)
    $pdfFilename = 'transaction_details.pdf';
    $pdf->Output($pdfFilename, 'F');

    return $pdfFilename; // Return the filename
}


?>

<style>
    /* Heading */
#bookingForm h3{
 position:relative;
 top:-3px;
 left:-89px;
}
</style>