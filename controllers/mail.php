<?php
// 받는 사람이 여럿일 경우 , 로 늘려준다.
$to  = $siteConfig['email'];

$siteConfig = getItem('site_configs');
// 제목


$subject = '고객문의 메일 도착';

$contents = '';

// 내용
$message = '
<table align="center" width="700" border="0" cellpadding="0" cellspacing="0">
  <tbody>
  <tr><td style="padding-top:20px;">
    <table width="700" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr><td style="padding:50px 50px 50px 50px; border:10px #e5e8ea solid; ">
        <table align="center" width="580" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr><td style="font-size:24px; font-family:dotum; line-height:20px; font-weight:bold; color:#232833;">
	'.iconv('utf-8','euc-kr',$siteConfig['site_name']).'에서 고객문의가 도착했습니다.
          </td></tr>
       
          <tr><td style="padding-top:10px;">
            <table width="580" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
              <tbody>'.$contents.'

        

             
            </tbody></table>
          </td></tr>
          <tr><td style="padding:30px 0 80px 0"></td></tr>
          <tr><td>
            <table width="580" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr><td height="1" bgcolor="#d4d8dc"></td></tr>
              <tr><td height="80" style="font-size:12px; font-family:dotum; line-height:20px; font-weight:normal; color:#232833;">
                본 메일은 발신전용 입니다. <br>
                
              </td></tr>
              <tr><td height="1" bgcolor="#d4d8dc"></td></tr>
           
            </tbody></table>
          </td></tr>
        </tbody></table>
      </td></tr>
    </tbody></table>
  </td></tr>
  <tr><td height="100"></td></tr>
</tbody></table>
';

// HTML 내용을 메일로 보낼때는 Content-type을 설정해야한다
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=euc-kr' . "\r\n";

// 추가 header

// 받는사람 표시
$headers .= 'To: Mary <'.$siteConfig['email'].'>,'. "\r\n";

// 보내는사람
$headers .= 'From: '. iconv('utf-8','euc-kr',$siteConfig['site_name'] ).' <'.$siteConfig['email'].'>' . "\r\n";



// 메일 보내기
mail($to, $subject, $message, $headers);
?>