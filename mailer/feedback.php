<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'form_setting.php';
require '../vendor/autoload.php';

if(isset($_POST)){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	
	$messages  = "<h3>New message from the site " .$fromName. "</h3> \r\n";
	$messages .= "<ul>";
	$messages .= "<li><strong>Name: </strong>" .$name."</li>";
	$messages .= "<li><strong>Email: </strong>" .$email."</li>";
	$messages .= "<li><strong>Message: </strong>" .$message."</li>";
	$messages .= "</ul> \r\n";
	$mail = new PHPMailer(true);
    $mail -> isSMTP();
    $mail->IsHTML();
    $mail-> SMTPAuth = true;
    $mail-> Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail ->Username="thedragon7ell@gmail.com";
    $mail ->Password="fwso yfas zzgv adbe";
	$mail->From = $from;
	$mail->FromName = $fromName;

    try {
        $mail->addAddress($to, 'Admin');
    } catch (Exception $e) {
        print ($e);
    }

    $mail->CharSet = $charset;

	$mail->Subject = $subj;
	$mail->Body    = $messages;

    try {
        if (!$mail->send()) {
            print json_encode(array('status' => 0));
        } else {
            print json_encode(array('status' => 1));
        }
    } catch (Exception $e) {
        print ($e);
    }

}
	
?>