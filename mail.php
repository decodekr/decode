<?

 
  $to = "enarastudent@gmail.com";
$subject = "your subject";
$body = "<p>Your Body</p>";
$headers  = "From: Sender Name <mail2@example.com>" . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
mail($to, $subject, $body, $headers);