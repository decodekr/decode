<?php
	//어드민 공통 모델



	if($melon['segment'][1]!='login'&&(!$session['login']||$session['is_admin']!=1)){
		getBack('/admin/login');
		exit;
	}

	$melon['helper']['pagination'] = array(
		'first'=>'<a href="[url]" >&lt;&lt;</a>',
		'prev'=>'<a href="[url]">&lt;</a>',
		'number'=>'<a href="[url]">$page</a>',
		'next'=>'<a href="[url]" >&gt;</a>',
		'last'=>'<a href="[url]">&gt;&gt;</a>',
		'current'=>'<a href="[url]" class="active" >$page</a>'
	);

	$headerBoards = getList('boards','','','','group_name desc');
?>