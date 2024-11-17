<?php 
$fname = $_POST["fullName"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "munenekevin366@gmail.com";
$mail->Password = "ivfx fblz jhdm myvm";

$mail->setFrom($email, $fname); //from
$mail->addAddress("2205852@students.kcau.ac.ke", "Kevin"); //Recipient

$mail->Subject = $subject;
$mail->Body = $message;

try {
    if ($mail->send()) {
        // Email has been sent successfully
        header("Location: contact_us.php?status=success");
    } else {
        // Email sending failed
        header("Location: contact_us.php?status=error");
    }
} catch (Exception $e) {
    // Exception occurred
    header("Location: contact_us.php?status=error&message=" . urlencode($e->getMessage()));
}
exit; // Make sure to exit after the redirect
?>