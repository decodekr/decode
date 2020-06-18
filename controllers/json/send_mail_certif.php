<?php
include'models/mail.php';

$check = getItem('users','id="'.$param['mail'].'"');

if($check){
	jsonMessage('-1');
	exit;
} 
$subject = "[MOM]회원가입 인증 메일입니다.";
$code=generateCode(6,'shorthand:number');
$mailText='
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>회원가입 축하 메일</title>
</head>

<body>

<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">
    <div style="border:1px solid #dedede">
        <h1 style="padding:30px 30px 30px;background:#f7f7f7;color:#555;font-size:1.4em">
           MOM 회원가입 인증메일입니다.
        </h1><br>

        <p style="margin:20px 0 0;padding:30px 30px 50px;min-height:200px;height:auto !important;height:200px;border-bottom:1px solid #eee">
            <b>회원가입 이메일 인증을 위해 하단의 링크를 클릭해주세요.
       <br>
	   <a href="https://mom.identt.co.kr/json/mail_certif_complete?code='.$code.'&email='.urlencode($param['mail']).'" style="color:#f9530b;display:block;width:60%;text-align:center;margin:20px;">[인증하기]</a>
      </b>


      
        </p>

		<table>
		<tr><td style="background:#fff; padding:40px 0 20px 30px; border-left:1px solid #b6b6b6; border-right:1px solid #b6b6b6; font-family:dotum, sans-serif; font-size:11px; color:#333; line-height:22px; ">
                   본 메일은 발신전용으로 회신되지 않습니다.
                   <br> 이메일(E-mail) 안내장에 관하여 궁금하신 사항은 02-2108-1000 또는 <a href="mailto:admin@identt.co.kr" rel="noreferrer noopener" target="_blank">admin@identt.co.kr</a> 로 문의하여 주시기 바랍니다.
                </td></tr>
		</table>

      
    </div>
</div>

</body>
</html>';

sendMail($subject,$mailText,$param['mail']);





  $to = $param['mail'];





   $headers = "From: skanxn@drumreal.identt.co.kr\r\n";
$headers .= "Content-Type:text/html; charset=UTF-8\r\n";

//mail($to, $subject, $mailText, $headers);
 jsonMessage($code);
    

?>