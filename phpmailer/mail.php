<?php
  require 'c:/xampp/htdocs/test/phpmailer/PHPMailerAutoload.php';
  require "c:/xampp/htdocs/test/phpmailer/credential.php";
class mail
{
  function __construct($appointment)
  {
    
    $mail = new PHPMailer;
    
    $mail->SMTPDebug = 4;                               // Enable verbose debug output
    
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = EMAIL;                 // SMTP username
    $mail->Password = PASS;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
 
    $mail->setFrom(EMAIL, 'Laboratory');
    $mail->addAddress($appointment->patient->email);     // Add a recipient             // Name is optional
    $mail->addReplyTo(EMAIL, 'Information');
  
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   /// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    //$mail->isHTML(true);        
  
    $mail->Subject = 'Lab Appointment';                          // Set email format to HTML
    $mail->Body =  ($appointment->mailbody);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
  }
}
?>

