<?php
include 'views/header.html';
?>
<?php

    if($param['has_data']){
		include'models/payment.php';
		if($param['password'][0]==$param['password'][1]){
			$param['password'] = $param['password'][0];
		}
		else{
			printMessage('비밀번호 와 비밀번호 확인이 일치하지 않습니다.');
			exit;
		}

		$certif=getItem('mail_certif_codes','code="'.$param['code'].'" AND email="'.$param['id'].'"');


		if(!$certif){
			printMessage('이메일 인증이 진행되지 않았습니다.');
			exit;
		}
		//$grade = 2; 2020-01-14 ky 변경

		$grade = 1;

			$date = new DateTime();
			$date->add(new DateInterval('P31D'));
			$vipDate = $date->format('Y-m-d');

			//$param['vip_date']=$vipDate;  2020-01-14 ky 주석처리

	//	$param['email'] = $param['email'][0].'@'.$param['email'][1];
	

		$param['birthday'] = $param['year'].'-'.$param['month'].'-'.$param['date'];
		
		//$param['grade'] = 2; 2020-01-14 ky 변경
		$param['grade'] = 1;

		//$param['password'] = 'PASSWORD("'.$param['password'].'")';

		//$data=jsonDecode(addUser($param['name'],$param['id'],$param['phone']));
	
		//$param['guid'] = $data['data']['memGuid'];

		$session['login']= insertItem('users',$param);
		$session['id'] = $param['id'];
		$session['name'] = $param['name'];
		$session['grade'] = 2;
		$session['user_type'] =$param['user_type'];
		$session['login_date'] =time();
	
	
		printMessage('가입을 축하합니다.','/user/join_complete');

		exit;
	}
?>

    <style>
        #agree_text_wrap
        {
            overflow-y: scroll;
            width: 100%;
            height: 200px;
            display: none;
            margin-bottom: 20px;
        }
        #usage_text_wrap
        {
            overflow-y: scroll;
            margin-bottom: 20px;
            width: 100%;
            height: 200px;
            display: none;
        }

        #electronic_financial_text_wrap
        {
            overflow-y: scroll;
            margin-bottom: 20px;
            width: 100%;
            height: 200px;
            display: none;
        }

        #etc_text_wrap
        {
            overflow-y: scroll;
            margin-bottom: 20px;
            width: 100%;
            height: 200px;
            display: none;
        }
		.signinForm{
			width: 500px;
			margin:  0 auto;
		}
		.signinForm input[type="email"]{
		padding: 8px 15px;
		width: 400px;
		}

    </style>

 <main class="site-main site-login">
     <div class="box-center">
   <div class="main">
      <div class="wrapper">
         <div class="auth-form">
            <div class="signinForm">
			   <br>
			      <br>
               <h2 class="typeName">회원가입</h2>
               <p class="guide">회원가입을 위한 회사용 이메일 주소를 입력해주세요.

</p>
               <p class="guide">회원가입 절차를 진행하실 수 있는 링크를 보내드리겠습니다</p><br><br>
               <h3> 이메일</h3>
               <div class="input-with-button"><input class="input" type="email" value="" id="signup_mail_input"><button class="Button outline desktop large" id="send_mail_certif_button">보내기</button></div>
			   <br>
               <div class="guideToSignup"><span>이미 회원이신가요?</span>&nbsp;&nbsp;&nbsp;<a href="/user/login" style="color:#2c4fa3;font-weight:bold;">로그인</a></div>
			   <br><br>
            </div>
         </div>
      </div>
   </div>
</div>
    </main>


<style>
	

</style>
<script>
		

$('#send_mail_certif_button').click(function(){
	var mail=$('#signup_mail_input').val();
	if(mail==''){
		alert('이메일을 입력해주세요.');
		return false;
	}
	if(!ValidateEmail(mail)){
		alert('올바른 이메일을 입력해주세요.');
		return false;
	}
	
	
	$.ajax({
		url : '/json/send_mail_certif',
		data:{mail:mail},
		type:'POST',
		dataType:'JSON',
		success : function($data){
			
			if($data.result==-1){
			alert('이미 가입한 이메일 주소입니다.');
			return false;
			}
			$('#code').val($data.result)
			$(this).text('재전송');
			alert('이메일로 인증 메일이 발송되었습니다.');
			
			certifCode=$data.result;
		}

	});
	return false;
});

function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
  
    return (false)
}
</script>



<?php
include 'views/footer.html';
?>