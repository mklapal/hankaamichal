<html>
<head>
<title>PHPMailer - Mail() basic test</title>
</head>
<body>

<?php

require_once('../class.phpmailer.php');

$mail           = new PHPMailer();
$mail->From     = "info@nanana.cz";
$mail->Mailer   = "mail";
$mail->CharSet  = "windows-1250"; //for example

$mail->Body     = 'aaaaaaaaaaaaaaaaa';
  $mail->Subject  = 'test';
  $mail->AddAddress('michalklapal@gmail.com');

  if(!$mail->Send())
    echo $mail->ErrorInfo;
  else
    echo $mail->ErrorInfo;

?>

</body>
</html>
