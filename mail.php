<?

 
  $to = "decode.chris.park@gmail.com";
$subject = "Shape of you";
$body = "<p>안녕하세요</p>";
$headers  = "From: Sender Name <mail2@example.com>" . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
echo mail($to, $subject, $body, $headers);