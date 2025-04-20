<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Include PHPMailer files
require 'libs/src/PHPMailer.php';
require 'libs/src/SMTP.php';
require 'libs/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['first_name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = '';  // ✅ Your Gmail (sender)
        $mail->Password = '';  // ✅ Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set correct sender email (Must match Username)
        $mail->setFrom('', 'Message from Customer');  // ✅ FIXED: Must be your own email
        $mail->addReplyTo($email, $name);  // ✅ User's email for reply
        $mail->addAddress(''); // ✅ Your email to receive messages

        // Email Details
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body = "Name: $name\nPhone: $phone\nEmail: $email\nMessage:\n$message";

        $mail->send();
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error sending message: {$mail->ErrorInfo}'); window.location.href='contact.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='contact.php';</script>";
}
?>
