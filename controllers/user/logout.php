<?php
$logParam['user_no'] = $session['login'];
$logParam['ip'] = $_SERVER['REMOTE_ADDR'];

		$logParam['type'] = 'logout';
	
	destroySession('login,id,is_admin,name,grade');


		getBack('/');

	
?>