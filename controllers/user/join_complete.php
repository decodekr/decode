<?php

include 'views/header.html';
?>
<?php

    if($param['has_data']){

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
		$param['phone'] = $param['phone'][0].'-'.$param['phone'][1].'-'.$param['phone'][2];

		$param['birthday'] = $param['year'].'-'.$param['month'].'-'.$param['date'];
		
		//$param['grade'] = 2; 2020-01-14 ky 변경
		$param['grade'] = 1;

		//$param['password'] = 'PASSWORD("'.$param['password'].'")';

		
		$session['login']= insertItem('users',$param);
		$session['id'] = $param['id'];
		$session['name'] = $param['name'];
		$session['grade'] = 2;
		$session['login_date'] =time();

	
		printMessage('가입을 축하합니다.','/user/join_complete');

		exit;
	}
?>
 <main class="site-main site-login">
        <div class="box-center">
            <div class="customer-login">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6" style="padding:100px 0;">
                            <h5 class="title-login"> 회원 가입이 완료되었습니다!</h5>
                            <p class="p-title-login"></p>

                            <div>
                               상단의 MOM 로고를 클릭하시면 메인 페이지로 이동합니다.

                            </div>

                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
include 'views/footer.html';
?>