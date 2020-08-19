<?php
include 'views/header.html';
?>
<?php

if($param['code']==''){
	redirect('/');
}
else{
	$certif=getItem('mail_certif_codes','code="'.$param['code'].'"');
	if(!$certif){
		printMessage('인증 기간이 만료되었거나 사용한 이메일입니다.','/user/join_send_mail');
		exit;
	}
}
deleteItem('mail_certif_codes','code="'.$param['code'].'"');
    if($param['has_data']){
		include'models/payment.php';
		if($param['password'][0]==$param['password'][1]){
			$param['password'] = $param['password'][0];
		}
		else{
			printMessage('비밀번호 와 비밀번호 확인이 일치하지 않습니다.');
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

    </style>

 <main class="site-main site-login">
        <div class="box-center">
        <div class="customer-login">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="title-login">회원가입</h5>
                        <p class="p-title-login"></p>
                        <form class="register" method="post" id="join_form">
							<input type="hidden" name="has_data" value="1">
							<input type="hidden" name="code" id="code" value="">
							<input type="hidden" name="user_type" id="user_type" value="">
							<p class="form-row form-row-wide">
                                <label>ID(이메일)<span class="required">*</span></label>
                                <input type="email" id="signup_mail_input" name="id" placeholder="" readonly class="input-text "value="<?=$certif['email']?>">
							
                            </p>
                            <p class="form-row form-row-wide">
                                <label>가입자 유형 선택</label><br>
                            	
								  <button class="btn btn-default user_type_check" data-type="seller">판매자</button>
								  <button class="btn btn-default user_type_check" data-type="buyer">구매자</button>
								 <!-- <input type="text" placeholder="인증번호 입력" class="input-text" style="margin-top:10px;" id="email_certif_input"> -->
                            </p>
                            
                            <p class="form-row form-row-wide">
                                <label>이름<span class="required">*</span></label>
                                <input type="text"  id="name" value="" name="name" placeholder="" class="input-text">
                            </p>
                            <p class="form-row form-row-wide">
                                <label>비밀번호:<span class="required"></span></label>
                                <input type="password" name="password[]" id="password" class="input-text">
                            </p>
                            <p class="form-row form-row-wide">
                                <label>비밀번호 확인<span class="required">*</span></label>
                                <input type="password" name="password[]" id="password_check" class="input-text">
                            </p>
							<p class="form-row form-row-wide">
                                <label>휴대전화<span class="required">*</span></label><br>
                                <input type="text" name="phone" id="reg_mb_hp" placeholder="" class="input-text right_button">
								
								<a href="" class="btn btn-default" id="check_certif_button" style="height:40px;vertical-align: middle;line-height: 28px;"> 인증번호 전송</a>
								 <input type="text"  id="certif_input" placeholder="인증번호 입력" class="input-text" style="margin-top:10px;display: none;">
                            </p>
                            <ul>
                                <!-- <li><label class="inline"><input type="checkbox" id="agree"><span class="input"></span>본인은 <a href="" style="text-decoration:underline;" id="usage_button">이용약관</a>,
                                        <a href="" id="agree_button" style="text-decoration:underline;">개인정보 처리 방침</a>,
                                        <a href="" id="etc_button" style="text-decoration:underline;">기타 서비스 이용약관</a>에 모두 동의합니다.</label></li>-->

                                <li><label class="inline"><input type="checkbox" id="agree"><span class="input"></span>본인은
                                        이용약관, 전자금융거래 이용약관, 개인정보 처리 방침, 기타 서비스 이용약관에 모두 동의합니다.</label></li>
                            </ul>


                            <li><label class="inline"><input type="checkbox" id="usage_check"><span
                                            class="input"></span>마켓오브메테리얼 이용약관 동의</label></li>
                       <?php
						include'views/agree.html';
					   ?>


                            </div>
							
                            <p class="form-row">
                                <input type="submit" value="회원가입" name="Submit" class="button-submit">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </main>




	<script>
var emailCertif=1;
var certif=0;


$('#join_form').submit(function(){

	var name = $('#name').val();
	var password = $('#password').val();
	var passwordCheck = $('#password_check').val();
	var agree = $('#agree').prop('checked');

	if(password==''){
		Swal.fire({
		  title: '',
		  text: '비밀번호를 입력해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
	}
	if(name==''){
		Swal.fire({
		  title: '',
		  text: '이름을 입력해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
	}
	if(passwordCheck==''){
		Swal.fire({
		  title: '',
		  text: '비밀번호 확인을 입력해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
	}
	if(passwordCheck!=password){
		Swal.fire({
		  title: '',
		  text: '비밀번호와 비밀번호 확인이 일치하지 않습니다.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
	}
	if(emailCertif==0){
		Swal.fire({
		  title: '',
		  text: '이메일 인증을 진행해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
	}
	if(certif==0){
		Swal.fire({
		  title: '',
		  text: '휴대폰 인증을 진행해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
	}
	if($('#agree:checked').size()==0){
		Swal.fire({
		  title: '',
		  text: '이용 약관 및 개인정보 수집에 동의해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
	}

	
	
});


$('#check_id').click(function(){
	var id = $('#signup_id').val();
	$.ajax({
		url : '/bbs/ajax.mb_id.php',
		data: {reg_mb_id:id},
		type:'POST',
		dataType:'TEXT',
		success : function($data){
			if($data==''){
				alert('사용 가능한 아이디입니다.');
			}
			else{
				alert($data)
			}

		}

	});
});
$('#check_nickname').click(function(){
	var nickname = $('#signup_nickname').val();
	$.ajax({
		url : '/bbs/ajax.mb_nick.php',
		data: {reg_mb_nick:nickname},
		type:'POST',
		dataType:'TEXT',
		success : function($data){
			if($data==''){
				alert('사용 가능한 닉네임입니다.');
			}
			else{
				alert($data)
			}

		}

	});
});



	var send = 0;
	var code=0;
		$('#reg_mb_hp').keydown(function(){
			$('#certif_wrap').fadeIn();
			$('#certif_coplete').hide();
		});
		
$('#check_certif_button').click(function(){

	
if(send==1){
	return false;;
}
var phone =  $('#reg_mb_hp').val();
if(phone==''||!phoneCheck(phone)){
alert('올바른 휴대폰 번호를 입력해 주십시오.');
return false;
}				


	$.ajax({
		type:'POST',
			dataType:'JSON',
		url : '/json/send_certif',
		data : {number :phone},
		success : function($data){
if($data.result==-1){
alert('이미 인증한 휴대폰 번호입니다.');
return false;

}
$('#reg_mb_hp').prop({readonly:true})
$('#txtTd').fadeIn();
send =1;
code = $data.result
alert('인증번호를 발송했습니다^^ 1분이내 도착합니다.');
			
			$('#check_certif_button').css({opacity:0.3})
				$('#certif_input').fadeIn();
		}
	});
	return false;
});


$('#certif_input').keyup(function(){
	var value = $(this).val();
	if(value.length==4){
	if(code==value){
		alert('인증되었습니다.');
		certif=1;
		$('#certif_input').after('<span style="color:green">휴대폰 인증 완료</span>')
		$('#certif_input').fadeOut();
		
	}
	else{
		alert('인증번호가 일치하지 않습니다.');
		$(this).val('');
	}
	}
});





				function phoneCheck(phoneNumber) { 
			
					var regExp = /(01[0|1|6|9|7])(\d{3}|\d{4})(\d{4}$)/g; 
					var regExp2 = /(01[0|1|6|9|7])[-](\d{3}|\d{4})[-](\d{4}$)/g;

					var result = regExp.exec(phoneNumber);
					var result2 = regExp2.exec(phoneNumber);
					
					if(result||result2) return true; else return false;
					}





$('#signup,#go_signup').click(function(){
	$('.modal_bg').fadeOut();
	$('#signup_modal').fadeIn();
	
	return false;
});
var certifCode='_';

$('#send_certif_mail_button').click(function(){
	var mail=$('#signup_mail_input').val();
	if(mail==''){
		alert('이메일을 입력해주세요.');
		return false;
	}
	$(this).text('재전송');
	
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
			alert('이메일로 인증 메일이 발송되었습니다.');
			
			certifCode=$data.result;
		}

	});
	return false;
});

$('#email_certif_input').on('keyup paste',function(){
	//$('#step2').slideDown();
		//$('#step1').slideUp();return false;
			
	
	var certifInput = $('#email_certif_input').val();
	if(certifInput==certifCode){
		alert('인증되었습니다.');
		$('#signup_mail_input').prop({readonly:true})
		$(this).after('<span style="color:green">이메일 인증 완료</span>')
			$(this).fadeOut();
		emailCertif=1;
	}

});

	$('#signin').click(function(){
$('#signin_modal').fadeIn();
return false;
});

$('#login_form').keydown(function($event){
	if($event.keyCode==13){
	$('#btt_login').click();
	}
});


 $("#login_auto_login").click(function(){
        if ($(this).is(":checked")) {
            if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                return false;
        }
    });




$('#all_agree').click(function(){
	var checked= $(this).prop('checked');
	$('#marketing_agree').prop({checked:checked})
	$('#privacy_agree').prop({checked:checked})
});



var win_password_lost = function(href) {
    window.open(href, "win_password_lost", "left=50, top=50, width=617, height=330, scrollbars=1");
}


    $("#login_password_lost, #ol_password_lost").click(function(){
        win_password_lost(this.href);

        return false;
    });

if(location.hash.indexOf('#login')!=-1){
	
	$('#signin').click();
}




$('.ic_close').click(function(){
	$('.modal_bg').fadeOut();
	return false;
});


$('.search bar').keyup(function(){
	
});
getAlarm();
setInterval(function(){
	getAlarm();
},3000);
function getAlarm(){
$.ajax({
	url : '/json/get_unread_alarm.php',
	type:'POST',
	data:{},
	dataType:'JSON',
	success : function($data){
		
			$('#alarm_count').text($data.list.length);
			if($data.list.length>0){
		TweenMax.to('#alarm_count',0.5,{yoyo:true,repeat:-1,top:4});
		if($('#alarm_sound').size()==0){
			$('body').append('<iframe width="560" height="315" src="https://www.youtube.com/embed/G7UaHq-6LGY?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="display:none;" id="alarm_sound"></iframe>');
		}
			}
		}

});
}


/*$('#usage_button').click(function(){
	if($('#usage_text_wrap').is(':visible')){
			$('#usage_text_wrap').slideUp();
	}
	else{
			$('#usage_text_wrap').slideDown();
	}


	return false;
});

$('#agree_button').click(function(){
	if($('#agree_text_wrap').is(':visible')){
			$('#agree_text_wrap').slideUp();
	}
	else{
			$('#agree_text_wrap').slideDown();
	}
	return false;
});

$('#etc_button').click(function(){
    if($('#etc_text_wrap').is(':visible')){
        $('#etc_text_wrap').slideUp();
    }
    else{
        $('#etc_text_wrap').slideDown();
    }
    return false;
});*/

$(document).on('change', '#agree',function() {

    if($('#agree').prop('checked')) {

        $('#usage_text_wrap').slideDown();
        $('#electronic_financial_text_wrap').slideDown();
        $('#agree_text_wrap').slideDown();
        $('#etc_text_wrap').slideDown();

        $('#usage_check').prop('checked', true);
        $('#electronic_financial_check').prop('checked', true);
        $('#information_check').prop('checked', true);
        $('#etc_check').prop('checked', true);

    } else {

        $('#usage_text_wrap').slideUp();
        $('#electronic_financial_text_wrap').slideUp();
        $('#agree_text_wrap').slideUp();
        $('#etc_text_wrap').slideUp();

        $('#usage_check').prop('checked', false);
        $('#electronic_financial_check').prop('checked', false);
        $('#information_check').prop('checked', false);
        $('#etc_check').prop('checked', false);
    }


    return false;

});

$(document).on('change', '#usage_check', function () {

    if($('#usage_check').prop('checked')) {

        $('#usage_text_wrap').slideDown();

        $('#usage_check').prop('checked', true);

    } else {

        $('#usage_text_wrap').slideUp();

        $('#usage_check').prop('checked', false);
    }

    if ($('#usage_check').prop('checked') && $('#electronic_financial_check').prop('checked') && $('#information_check').prop('checked') && $('#etc_check').prop('checked')) {

        $('#agree').prop('checked', true);

    } else {

        $('#agree').prop('checked', false);
    }

    return false;

});

$(document).on('change', '#electronic_financial_check', function () {

    if($('#electronic_financial_check').prop('checked')) {

        $('#electronic_financial_text_wrap').slideDown();

        $('#electronic_financial_check').prop('checked', true);

    } else {

        $('#electronic_financial_text_wrap').slideUp();

        $('#electronic_financial_check').prop('checked', false);
    }

    if ($('#usage_check').prop('checked') && $('#electronic_financial_check').prop('checked') && $('#information_check').prop('checked') && $('#etc_check').prop('checked')) {

        $('#agree').prop('checked', true);

    } else {

        $('#agree').prop('checked', false);
    }

    return false;

});

$(document).on('change', '#information_check', function () {

    if($('#information_check').prop('checked')) {

        $('#agree_text_wrap').slideDown();

        $('#information_check').prop('checked', true);

    } else {

        $('#agree_text_wrap').slideUp();

        $('#information_check').prop('checked', false);
    }

    if ($('#usage_check').prop('checked') && $('#electronic_financial_check').prop('checked') && $('#information_check').prop('checked') && $('#etc_check').prop('checked')) {

        $('#agree').prop('checked', true);

    } else {

        $('#agree').prop('checked', false);
    }

    return false;

});

$(document).on('change', '#etc_check', function () {

    if($('#etc_check').prop('checked')) {

        $('#etc_text_wrap').slideDown();

        $('#etc_check').prop('checked', true);

    } else {

        $('#etc_text_wrap').slideUp();

        $('#etc_check').prop('checked', false);
    }

    if ($('#usage_check').prop('checked') && $('#electronic_financial_check').prop('checked') && $('#information_check').prop('checked') && $('#etc_check').prop('checked')) {

        $('#agree').prop('checked', true);

    } else {

        $('#agree').prop('checked', false);
    }

    return false;

});




$('#join_form').submit(function() {

    if(!$('#usage_check').prop('checked')) {
        alert('이용약관 동의 체크를 해주세요.');

        return false;
    }

    if(!$('#information_check').prop('checked')) {
        alert('개인정보처리 취급방침 동의 체크를 해주세요.');

        return false;
    }

    if(!$('#etc_check').prop('checked')) {
        alert('기타 서비스 이용약관 동의 체크를 해주세요.');

        return false;
    }

});


$('#menu').click(function(){
	$('.slide_menu').toggleClass('open')
});

	$('.user_type_check').click(function(){
		$('#user_type').val($(this).data('type'));
		$(this).addClass('btn-primary').removeClass('btn-default').siblings().removeClass('btn-primary').addClass('btn-default');
	return false;
	});
</script>
<?php
include 'views/footer.html';
?>