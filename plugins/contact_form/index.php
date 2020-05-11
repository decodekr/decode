<?php
	$contact_form['message'] = '전송되었습니다.'; //성공후 메세지, 공백시 사용안함
	$contact_form['url'] = ''; // 리턴 URL, 공백시 이전 페이지로
	$contact_form['fields'] = array(
		'name' =>'이름',
		'age'=>'나이'
	); //필드를 한글로 전환할 목록을 작성하세요.
	
	sqlQuery('CREATE TABLE IF NOT EXISTS `applicants` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `contents` text NOT NULL COMMENT "내용",
  `status` int(10) unsigned NOT NULL DEFAULT "0" COMMENT "답변완료 여부 0미완료 1완료",
  `create_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  `modify_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;
');
	include'models/index.php';

	if($melon['is_admin']){

		include $pluginPath.'/models/admin.php';
		
	}
	else{
		include'models/index.php';
	}