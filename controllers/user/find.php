<?php
	if($param['has_data']){

		$check=getItem('users','id="'.$param['mb_email'].'"');
		if(!$check){
			printMessage('일치하는 정보가 없습니다.');
			exit;
		}
		else{
			$userParam['password'] = generateCode(6);
			$code=$userParam['password'];
			updateItem('users',$userParam,'id="'.$param['mb_email'].'"');
		}
		require 'phpmailer/PHPMailerAutoload.php';
		
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
			$mail->setFrom('decode@decodelab.co.kr', '마켓오브메테리얼');
			$mail->addAddress($param['mb_email'], 'md');

		  //  $mail->addReplyTo($basicInfo['이메일'], $basicInfo['이름']);
		  //  $mail->addCC('heokree.lim@random2u.com');
		//    $mail->addAddress('heokree.lim@random2u.com', 'md');
			//language
			$mail->CharSet = "UTF-8";
			$mail->Encoding = "base64";

		

			// Content
			$mail->isHTML(true);                                 // Set email format to HTML
			$mail->Subject = "마켓오브메테리얼 비밀번호 찾기 안내입니다.";
$bodyContent='
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
          마켓오브메테리얼 비밀번호 찾기 안내입니다.
        </h1><br>

        <p style="margin:20px 0 0;padding:30px 30px 50px;min-height:200px;height:auto !important;height:200px;border-bottom:1px solid #eee">
            <b>문의하신 아이디와 비밀번호는
       <br>
	   <span style="color:#f9530b;display:block;
	   width:60%;text-align:center;margin:20px;">
	   
	   [ '.$code.' ]
	   
	   </span>
      </b>

입니다.

      
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
			$mail->Body = $bodyContent;

			$mail->send();

		 echo "<script>alert('비밀번호 찾기 이메일을 발송했습니다.'); history.back();</script>";



		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		  //  echo "<script>alert('이메일을 보내는 과정에 문제가 발생했습니다. md@random2u.com으로 연락부탁드립니다.'); history.back();</script>";
			$mail->stmpClose();
		}
	}
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>정보 찾기</title>
 </head>
 <body>
 <style>
 body{
background: #f5f7f6;
}
	/*! CSS Used from: https://demo.sir.kr/gnuboard5/theme/basic/css/default.css?ver=191202 */
h1,form,fieldset{margin:0;padding:0;border:0;}
h1{font-size:1em;font-family:'Malgun Gothic', dotum, sans-serif;}
label,input,button{vertical-align:middle;font-size:1em;}
input,button{margin:0;padding:0;font-family:'Malgun Gothic', dotum, sans-serif;font-size:1em;}
button{cursor:pointer;}
p{margin:0;padding:0;word-break:break-all;}
*,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
input[type=text]{-webkit-transition:all 0.30s ease-in-out;-moz-transition:all 0.30s ease-in-out;-ms-transition:all 0.30s ease-in-out;-o-transition:all 0.30s ease-in-out;outline:none;}
input[type=text]:focus{-webkit-box-shadow:0 0 5px #9ed4ff;-moz-box-shadow:0 0 5px #9ed4ff;box-shadow:0 0 5px #9ed4ff;border:1px solid #558ab7!important;}
.sound_only{display:inline-block!important;position:absolute;top:0;left:0;width:0;height:0;margin:0!important;padding:0!important;font-size:0;line-height:0;border:0!important;overflow:hidden!important;}
#captcha{display:inline-block;position:relative;}
.btn_submit{border:0;background:#0a0809;color:#fff;cursor:pointer;border-radius:3px;}
.btn_submit:hover{background:#2375eb;}
.btn_close{border:1px solid #dcdcdc;cursor:pointer;border-radius:3px;background:#fff;}
.frm_input{border:1px solid #d0d3db;background:#fff;color:#000;vertical-align:middle;border-radius:3px;padding:5px;-webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075);-moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075);box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075);}
.frm_input{height:40px;}
.full_input{width:100%;}

.new_win{position:relative;}
.new_win #win_title{font-size:1.3em;height:50px;line-height:30px;padding:10px 20px;color:#000;-webkit-box-shadow:0 1px 10px rgba(0,0,0,.1);-moz-box-shadow:0 1px 10px rgba(0,0,0,.1);box-shadow:0 1px 10px rgba(0,0,0,.1);}
.new_win .new_win_con{margin:20px 0;padding:20px;}
.new_win .new_win_con:after{display:block;visibility:hidden;clear:both;content:"";}
.new_win .win_btn{text-align:center;}
.new_win .btn_close{height:45px;width:60px;overflow:hidden;cursor:pointer;}
.new_win .btn_submit{padding:0 20px;height:45px;font-weight:bold;font-size:1.083em;}
/*! CSS Used from: https://demo.sir.kr/gnuboard5/skin/member/basic/style.css?ver=191202 */
#find_info p{line-height:1.5em;font-size:14px;}
#find_info #mb_email{margin:10px 0;}

 </style>
	  <div id="find_info" class="new_win">
    <h1 id="win_title">회원정보 찾기</h1>
    <div class="new_win_con">
        <form name="fpasswordlost" action="" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
        <input type="hidden" name="has_data" value="1">
		<fieldset id="info_fs">
            <p>
			회원가입 시 등록하신 이메일 주소를 입력해 주세요.<br>
해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.

<br>
           
            </p>
            <label for="mb_email" class="sound_only">E-mail 주소<strong class="sound_only">필수</strong></label>
            <input type="text" name="mb_email" id="mb_email" required="" class="required frm_input full_input email" size="30" placeholder="E-mail 주소">
        </fieldset>
        <fieldset id="captcha" class="captcha recaptcha"><script src="https://www.google.com/recaptcha/api.js?hl=ko"></script><script src="https://demo.sir.kr/gnuboard5/plugin/recaptcha/recaptcha.js"></script></fieldset>
        <div class="win_btn">
            <button type="submit" class="btn_submit">확인</button>
            <button type="button" onclick="window.close();" class="btn_close">창닫기</button>  
        </div>
        </form>
    </div>
</div>
 </body>
</html>

