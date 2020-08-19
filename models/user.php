<?php
	//유저 공통 모델
	$device='pc';
    if(isMobile()){
        $device = 'mobile';
    }
    if($_SESSION['device']){
        $device = $_SESSION['device'];
    }
    if($param['device']){
        $device = $_SESSION['device'] = $param['device'];
    }
	if($siteConfig['use_mobile']==1){
		if($device=='mobile'){
			$mobilePath = 'mobile/';
		}
	}



	/*
		방문자 플러긴 코드
	*/

	$visitorParam['ip'] = $_SERVER['REMOTE_ADDR'];
    $visitorParam['refferer'] = $_SERVER['HTTP_REFERER'];
    $visitorParam['useragent'] = $_SERVER['HTTP_USER_AGENT'];


    $visitors = getItem('visitors','ip="'.$visitorParam['ip'].'" AND refferer="'.$visitorParam['refferer'].'"');
    if(!$visitors){
		insertItem('visitors',$visitorParam);
    }

if($melon['segment'][0]=='seller'&&$session['user_type']!='seller'){
	printMessage('로그인이 필요합니다.','/user/login');
	exit;
}

if(isset($session['user_type'])&&$session['user_type']==''&&$melon['segment'][0]!='user'&&$melon['segment'][0]!='json'){
	//printMessage('회원 유형을 이어서 작성해주세요.','/user/join_complete');
	//exit;
}

?>