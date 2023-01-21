<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';


$mail = $_POST['mail'];
$name = $_POST['name'];
$message = $_POST['message'];


function sendMail($email,$name,$message){

	$mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mail qui vas servir de smtp ';                     //SMTP username
    $mail->Password   = 'mot de passe du mail smtp';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('destinataire@gmail.com', 'Nom du destinataire');     //Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content

    $contenu = "<!DOCTYPE html>
    			<html>
    				<head>
    					<title>Encoie de mail avec Java scripts</title>
    				</head>

    				<body>
    					<table border=6 cellspacing=12 cellpadding=20>
    						<tr> <td> Nom <td>  <td> ". $name ." <td> <tr>
    						<tr> <td> Mail <td>  <td> ". $email ." <td> <tr>
    						<tr> <td> Message <td>  <td> ". $message ." <td> <tr>
    					</table>
    				</body>
    			</html>
    			";

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Nouvelle prise de contact';
    $mail->Body    = $contenu;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()){
    	echo "false " . $mail->ErrorInfo; 
    }else{
    	echo "true";
    }

}


sendMail($mail,$name,$message);

?>