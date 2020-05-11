<?php

if($_SERVER['REMOTE_ADDR']!="112.155.161.11" && $_SERVER['REMOTE_ADDR']!="165.76.184.67" && $_SERVER['REMOTE_ADDR']!="180.191.158.224" && $_SERVER['REMOTE_ADDR']!="45.64.175.181" && $_SERVER['REMOTE_ADDR']!="183.111.171.253" && $_SERVER['REMOTE_ADDR']!="183.111.171.222" && $_SERVER['REMOTE_ADDR']!="183.111.171.162" && $_SERVER['REMOTE_ADDR']!="61.103.0.82" && $_SERVER['REMOTE_ADDR']!="59.150.65.94" && $_SERVER['REMOTE_ADDR']!="220.64.195.69" && $_SERVER['REMOTE_ADDR']!="101.79.92.7" && $_SERVER['REMOTE_ADDR']!="124.217.213.216" && $_SERVER['REMOTE_ADDR']!="180.210.3.141" && $_SERVER['REMOTE_ADDR']!="45.64.174.134" && $_SERVER['REMOTE_ADDR']!="101.79.75.22" && $_SERVER['REMOTE_ADDR']!="183.111.171.223" && $_SERVER['REMOTE_ADDR']!="180.191.103.99" && $_SERVER['REMOTE_ADDR']!="180.191.159.105" && $_SERVER['REMOTE_ADDR']!="180.191.159.97"  && $_SERVER['REMOTE_ADDR']!="61.113.209.231" && $_SERVER['REMOTE_ADDR']!="121.169.223.134" ){
	
}
	$melon['debug']						="DEBUG";
	$melon['charset']					= 'utf-8';		//Default Encoding
	$melon['column']['index']			= 'no';		//Sequence field name
	$melon['column']['create']		= 'create_date';	//Create date field name
	$melon['column']['update']		= 'modify_date';		//Update date field name
	$melon['upload']['filter'] = "php|htm|html";
	$melon['db']['type']				= 'mysqli';		//Database Type
	$melon['db']['host']				= 'localhost';	//Database Host
	$melon['db']['id']				= 'root';	//Database Connection ID
	$melon['db']['pw']				= 'skanxn11';	//Database Connection Password
	$melon['db']['name']				= 'mom';	//Database Name
	$melon['helper']['pagination'] = array(
		'first'=>'<li><a href="[url]">&lt;&lt;</a></li>',
		'prev'=>'<li><a href="[url]">&lt;</a></li>',
		'number'=>'<li><a href="[url]">$page</a></li>',
		'next'=>'<li><a href="[url]">&gt;</a></li>',
		'last'=>'<li><a href="[url]">&gt;&gt;</a></li>',
		'current'=>'<li class="active"><a href="[url]" >$page</a></li>'
	);


	/*
		Segment URI Setting
	*/
	
	$melon['helper']['uri']			 = true;
//	$melon['singleParam']['/boardtest/boardtest2/index']=array(0=>'board_id',1=>'board_mode'); //Mono Parameter
//	$melon['singleParam']['/test']=array(0=>'board_id',1=>'board_mode'); //Mono Parameter
	//$melon['singleParam']['index']=array(0=>'test'); //Mono Parameter
	$melon['singleParam']['board/']=array(0=>'board_id',1=>'board_mode'); //Mono Parameter
	$melon['param']=array('page','no','search_type','search_keyword','board_name','board_mode','mode','category_no','wholesaler_no');  //valid parameter

//db 에러는 500에러로 돌리는것 개선
?>