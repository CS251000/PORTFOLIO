<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
header("Location:thanks.html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["input-email"];
    $message = $_POST["input-message"];
    $phone = $_POST["input-phone"];
    // $mailContent = "Name: $name\n";
    // $mailContent .= "Email: $email\n";
    // $mailContent .= "Phone number:\n$phone\n";
    // $mailContent .= "Message:\n$message";
    $mailContent = nl2br("Name:$name\n Email: $email\n Phone:$phone\n Message:$message");
   

    // Include the PHPMailer autoload file
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    // Create a PHPMailer instance
    $mail = new PHPMailer();

    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP(); // Send using SMTP
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'chiragsinghal04@gmail.com'; // SMTP username
    $mail->Password = 'zrlvwgpwiqsckahf'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587; // TCP port to connect to

    // Recipients
    $mail->setFrom('chiragsinghal04@gmail.com', 'Chirag Singhal');
    $mail->addAddress('chiragsinghal04@gmail.com'); // Add a recipient
    $mail->addReplyTo('chiragsinghal04@gmail.com', 'CHIRAGSINGHAL');

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'CONTACT FORM ENQUIRY';
    $mail->Body = $mailContent;
    $mail->AltBody = $mailContent;

    if ($mail->send()) {
        // Redirect to thanks.html upon successful submission
        header("Location: thanks.html");
        exit();
    } else {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
