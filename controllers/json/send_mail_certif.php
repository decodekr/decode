<?php
include'models/mail.php';



$check = getItem('users','id="'.$param['mail'].'"');

if($check){
	jsonMessage('-1');
	exit;
} 

$code=generateCode(6,'shorthand:number');
$param['email'] = $param['mail'];
$param['code'] = $code;
insertItem('mail_certif_codes',$param);
//$subject = "[MOM]회원가입 인증 메일입니다.";

$subject = "=?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR","[MOM]회원가입 인증 메일입니다."))."?=";


$contents='<p style="margin:20px 0 0;padding:30px 30px 50px;min-height:200px;height:auto !important;height:200px;border-bottom:1px solid #eee">
				<b>회원가입 이메일 인증을 위해 하단의 링크를 클릭해주세요.
		   <br>
		   <a href="https://marketofmaterial.com/json/mail_certif_complete?code='.$code.'&email='.urlencode($param['mail']).'" style="color:#f9530b;display:block;width:60%;text-align:center;margin:20px;">[인증하기]</a>
		  </b>
';
sendmail2($subject,$contents,$param['mail']);

 jsonMessage($code);
    

?>