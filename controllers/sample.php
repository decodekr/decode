<?php
	
	$tableName = 'banners';
	$insertParam['title'] = '테스트';
	$insertParam['image'] = 'http://dabgil.com/images/logo.png';
	$insertParam['location'] = '메인';
	/*
		insertItem = DB를 삽입
		@param 테이블명 
		@param 필드명과 값을 갖는 연관배열
	*/
	insertItem($tableName,$insertParam);

	/*
		deleteItem = DB를 삭제
		@param 테이블명
		@param Where문
	*/

	deleteItem($tableName,'no=6');

	
	/*
		getList = DB목록을 조회
		@param 테이블명
		@param Where문 #
		@param 몇번부터 가져올지 #
		@param 몇개 가져올지 #
		@param 정렬 ORDER by #
	*/
	$banners= getList($tableName,'no>5',5,5,'title desc');
	print_x($banners);

	/*
		getItem = 조건에 가장 적합한 DB 1열을 가져옴
		@param 테이블명
		@param Where문 #
		@param 정렬 ORDER by #t
	*/

	$bannerItem= getItem($tableName,'no<3','create_date desc');
	print_x($bannerItem);
		

	/*
		updateItem = DB를 삽입
		@param 테이블명 
		@param 필드명과 값을 갖는 연관배열
		@param Where문
	*/

	$updateParam['location'] = '서브';
	updateItem($tableName,$updateParam,'no=1');

	
?>