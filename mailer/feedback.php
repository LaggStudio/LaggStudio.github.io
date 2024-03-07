<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
require 'mailer/POP3.php';
require 'mailer/form_setting.php';

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

	$mail->From = $from;
	$mail->FromName = $fromName;
    try {
        $mail->addAddress($to, 'Admin');
    } catch (Exception $e) {
        print ($e);
    }

    $mail->isHTML(true);
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