<?php
	$user=getItem('users','id="'.$param['id'].'" AND password="'.$param['password'].'"');
	if(!$user){
		jsonMessage(1);
	}
	else{
	jsonMessage(0);
	}
?>