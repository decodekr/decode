<?php
require 'phpmailer/PHPMailerAutoload.php';
	
	function sendMail($subject,$contents,$email) {
		
		
		$mail = new PHPMailer();

		try {
			//Server settings
		//	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();                                            // Send using SMTP
			$mail->SMTPDebug =0;
			$mail->Host       = 'smtp.worksmobile.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'decode@decodelab.co.kr';                     // SMTP username
			$mail->Password   = '3kp8izms!@';                               // SMTP password
			$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			//Recipients
			$mail->setFrom('decode@decodelab.co.kr', '마켓 오브 메테리얼');
			$mail->addAddress($email, 'md');

		  //  $mail->addReplyTo($basicInfo['이메일'], $basicInfo['이름']);
		  //  $mail->addCC('heokree.lim@random2u.com');
		//    $mail->addAddress('heokree.lim@random2u.com', 'md');
			//language
			$mail->CharSet = "UTF-8";
			$mail->Encoding = "base64";

		

			// Content
			$mail->isHTML(true);                                 // Set email format to HTML
			$mail->Subject = $subject;
$bodyContent=$contents;
			$mail->Body = $bodyContent;

			$mail->send();

		



		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		  //  echo "<script>alert('이메일을 보내는 과정에 문제가 발생했습니다. md@random2u.com으로 연락부탁드립니다.'); history.back();</script>";
			$mail->stmpClose();
		}
	}
	
?>