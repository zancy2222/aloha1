<?php

require_once("../../includes/initialize.php");

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


    $mail = new PHPMailer(true);

     // Set the confirmation code as a variable
     $confirmationCode = isset($_GET['confirmationCode']) ? $_GET['confirmationCode'] : '';

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tlqdevera.ccit@unp.edu.ph';
        $mail->Password = 'PerryThePlatypus.2002';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
        $mail->Port = 587;
        $mail->setFrom('tlqdevera.ccit@unp.edu.ph', 'Aloha Nui Hotel');
        $mail->addAddress('cyrustristanquiaeo@gmail.com');
        $mail->Subject = ('Test');
        $mail->isHTML(true);

    
        ob_start();

        include('print_entry.php?'.'confirmationCode='. 'mk3w0fx3');
        
        $htmlContent = ob_get_clean(); // Capture the output and assign it to $htmlContent
        
        $mail->Body = $htmlContent;
        
        $mail->send();
        

        // Success message
        echo '<div style="color: green;">Message has been sent successfully!</div>';

    } catch (Exception $e) {
        // Error message
        echo '<div style="color: red;">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
    }

?>


