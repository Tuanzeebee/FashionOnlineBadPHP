<?php
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");

$verification_code = mt_rand(1000, 9999);

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // enable SMTP

$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->CharSet = 'UTF-8';
// Nội dung email
$mail->Username = "tuanzeebee@gmail.com";
$mail->Password = "vsrhsmcgvdjhasny";
$mail->SetFrom("tuanzeebee@gmail.com");
$mail->AddAddress("lancuoicungdayok@gmail.com");

// $mail->setFrom('your-email@example.com', 'Tên của bạn');
// $mail->addAddress($email);  // Người nhận

$mail->isHTML(true);
$mail->Subject = 'Mã Xác Thực Email';
$mail->Body = "Mã xác thực của bạn là: <strong>$verification_code</strong>";

if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent";
}
