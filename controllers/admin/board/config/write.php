<?php	


	$skins = array();
	$dir = $_SERVER['DOCUMENT_ROOT']."/views/board";
	
	
	

	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {

				if( $file == '.' || $file == '..'){
					continue;
				}
				array_push($skins,$file);
				
		
				//echo filetype($dir.'/'.$file);
				//echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
			}
			closedir($dh);
		}
	}


	if($param['has_data']==1){


	
		if(!is_empty_array($param['categories'])){
			$param['categories'] = implode('|',$param['categories']);
		}
		

		if($param['no']){
			$sql = '';
			$sqlComment = '';
			$defaultField = array('no','title','contents','hit','comments','create_date','user_no','modify_date','delete_date','is_secret','password');
				$defaultFieldComment = array('no','title','contents','hit','comments','create_date','user_no','modify_date','delete_date','sort','depth','parent_no','board_no','reply_no','password');
			$boardFields = getListQuery('show full columns from board_'.$param['id']);
			$boardCommentFields = getListQuery('show full columns from board_'.$param['id'].'_comment');

			
			function searchField($boardFields,$fieldName){
				$result = false;

				$boardFields = $boardFields['list'];
				
				foreach($boardFields as $boardField){
				
			
				
					
					if($boardField['Field']==$fieldName){
						$result = true;
						
					}

					
				}
				return $result;
			}

	
			if(!is_empty_array($param['field'])){
				foreach($param['field'] as $index=>$field){
					$dataType = $param['data_type'][$index];
					$comment = $param['comment'][$index];
					$size = $param['data_type_size'][$index];
						$unsigned = $param['unsigned'][$index];
					$default = 0;

					if($dataType=='varchar'||$dataType=='text'){
						$default = '""';
					}
					if($dataType=='datetime'){
						$default = '"0000-00-00 00:00:00"';
					}
					if($size!=''){
						$size = '('.$size.')';
					}
					if($unsigned==1){
						$unsigned = 'unsigned';
					}
						else{
						 $unsigned='';
					}



					if($param['origin_field'][$index]){ //변경된 필드의 경우
						$sql.='ALTER TABLE  `board_'.$param['id'].'` CHANGE  `'.$param['origin_field'][$index].'`  `'.$field.'` '.$dataType.$size.' '.$unsigned.' not null default '.$default.' comment "'.$comment.'";';
						
					}
					else if(!searchField($boardFields,$field)){ //기존에 없는 필드의 경우
						if($index==0){
							$prevField = 'contents';
						}
						else{
							$prevField = $param['field'][$index-1];
						}
						$sql.='ALTER TABLE  `board_'.$param['id'].'` ADD  `'.$field.'` '.$dataType.$size.' '.$unsigned.' not null default '.$default.' comment "'.$comment.'" AFTER '.$prevField.';';
					}
				}
			}
			//삭제할 필드 찾기
			if(is_empty_array($param['field'])){
				$param['field'] = array();
			}
			if(is_empty_array($param['origin_field'])){
				$param['origin_field'] = array();
			}

			foreach($boardFields['list'] as $index=>$boardField){
				if($index=='length'){
					continue;
				}
				if($boardField['Field']==''){
					continue;
				}
				
				if(!in_array($boardField['Field'],$param['field'])&&!in_array($boardField['Field'],$param['origin_field'])&&!in_array($boardField['Field'],$defaultField)){
					$sql.='ALTER TABLE  `board_'.$param['id'].'` DROP  `'.$boardField['Field'].'`;';

				}
			
					
			}
			/*
				회원제 사용에 분류하여 비번, 회원번호를 유동적으로 추가
			*/

			if($param['user_type']==1){ //회원제 사용 할 경우
				if(searchField($boardFields,'user_no')) { //회원제를 이미 쓰고있는지 체크
					
				}	
				else{

					$sql.="ALTER TABLE  `board_".$param['id']."` ADD  `user_no` INT UNSIGNED NOT NULL COMMENT  '회원 번호' AFTER  `hit`;";
				}
				if(searchField($boardFields,'password')){ //회원제를 이미 쓰고있는지 체크
					$sql.="ALTER TABLE  `board_".$param['id']."` DROP  `password`;";	
				}
				else{
				
				}
			}
			else if($param['user_type']==2){
				if(searchField($boardFields,'user_no')) { //회원제를 이미 쓰고있는지 체크
					
				}	
				else{

					$sql.="ALTER TABLE  `board_".$param['id']."` ADD  `user_no` INT UNSIGNED NOT NULL COMMENT  '회원 번호' AFTER  `hit`;";
				}
				if(searchField($boardFields,'password')) { //비밀번호를 이미 쓰고있는지 체크
					
				}	
				else{

					$sql.="ALTER TABLE  `board_".$param['id']."` ADD  `password` VARCHAR(255) NOT NULL DEFAULT '' COMMENT  '비밀 번호' AFTER  `hit`;";
				}

			}
			else{
				if(searchField($boardFields,'user_no')){ //회원제를 이미 쓰고있는지 체크
					$sql.="ALTER TABLE  `board_".$param['id']."` DROP  `user_no`;";	
				}
				else{
				
				}
				if(searchField($boardFields,'password')){ //회원제를 이미 쓰고있는지 체크
					$sql.="ALTER TABLE  `board_".$param['id']."` DROP  `password`;";	
				}
				else{
				
				}
			}

			/*
				임시삭제 여부에 따라 삭제일을 추가/제거
			*/

			if($param['delete_type']==0){ //임시삭제 사용 할 경우
				if(searchField($boardFields,'delete_date')){ //임시삭제일을 이미 쓰고있는지 체크
					
				}
				else{
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` ADD  `delete_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT  '삭제일' AFTER  `board_no`;";
				}
			}
			else{

				if(searchField($boardFields,'delete_date')){ //임시삭제일을 이미 쓰고있는지 체크
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` DROP  `delete_date`;";	
				}
				else{
				
				}
			}

			/*
				비밀글 여부에 따라 is secret 추가 여부 설정
			*/

			if($param['use_secret']==1){ //회원제 사용 할 경우
				if(searchField($boardFields,'is_secret')) { //회원제를 이미 쓰고있는지 체크
					
				}
				else{

					$sql.="ALTER TABLE  `board_".$param['id']."` ADD  `is_secret` INT UNSIGNED NOT NULL COMMENT  '비밀글 여부' AFTER  `hit`;";
					
				}
			}
			else{
				if(searchField($boardFields,'is_secret')){ //회원제를 이미 쓰고있는지 체크
					$sql.="ALTER TABLE  `board_".$param['id']."` DROP  `is_secret`;";	
					
				}
				else{
				
				}
			}

			// 댓글관련 수정



			if(!is_empty_array($param['field_comment'])){
				foreach($param['field_comment'] as $index=>$field){
					$dataType = $param['data_type_comment'][$index];
					$comment = $param['comment_comment'][$index];
					$size = $param['data_type_size_comment'][$index];
						$unsigned = $param['unsigned_comment'][$index];
					$default = 0;

					if($dataType=='varchar'||$dataType=='text'){
						$default = '""';
					}
					if($dataType=='datetime'){
						$default = '"0000-00-00 00:00:00"';
					}
					if($size!=''){
						$size = '('.$size.')';
					}
					if($unsigned==1){
						$unsigned = 'unsigned';
					}
						else{
						 $unsigned='';
					}



					if($param['origin_field_comment'][$index]){ //변경된 필드의 경우
						$sql.='ALTER TABLE  `board_'.$param['id'].'_comment` CHANGE  `'.$param['origin_field_comment'][$index].'`  `'.$field.'` '.$dataType.$size.' '.$unsigned.' not null default '.$default.' comment "'.$comment.'";';
						
					}
					else if(!searchField($boardCommentFields,$field)){ //기존에 없는 필드의 경우
						if($index==0){
							$prevField = 'contents';
						}
						else{
							$prevField = $param['field_comment'][$index-1];
						}
						$sql.='ALTER TABLE  `board_'.$param['id'].'_comment` ADD  `'.$field.'` '.$dataType.$size.' '.$unsigned.' not null default '.$default.' comment "'.$comment.'" AFTER '.$prevField.';';
					}	
				}
			}
				if(is_empty_array($param['field_comment'])){
					$param['field_comment'] = array();
				}
				if(is_empty_array($param['origin_field_comment'])){
					$param['origin_field_comment'] = array();
				}

				foreach($boardCommentFields['list'] as $index=>$boardField){

					
					if($index=='length'){
						continue;
					}
					if($boardField['Field']==''){
						continue;
					}
					if(!in_array($boardField['Field'],$param['field_comment'])&&!in_array($boardField['Field'],$param['origin_field_comment'])&&!in_array($boardField['Field'],$defaultFieldComment)){
						$sql.='ALTER TABLE  `board_'.$param['id'].'_comment` DROP  `'.$boardField['Field'].'`;';
					}
						
				}
			
			/*
				회원제 사용에 분류하여 비번, 회원번호를 유동적으로 추가
			*/
			
			if($param['user_type']==1){ //회원제 사용 할 경우
				if(searchField($boardCommentFields,'user_no')){ //회원제를 이미 쓰고있는지 체크
					
				}
				else{
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` ADD  `user_no` INT UNSIGNED NOT NULL COMMENT  '회원 번호' AFTER  `board_no`;";
				}
				if(searchField($boardCommentFields,'password')){ //비회원제를 이미 쓰고있는지 체크
				
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` DROP  `password`;";	

				}
				else{
				
				}
			}
			else if($param['user_type']==2){ //회원제, 비회원제 모두 사용 할 경우
				if(searchField($boardCommentFields,'user_no')){ //회원제를 이미 쓰고있는지 체크
					
				}
				else{
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` ADD  `user_no` INT UNSIGNED NOT NULL COMMENT  '회원 번호' AFTER  `board_no`;";
				}
				if(searchField($boardCommentFields,'password')){ //비회원제를 이미 쓰고있는지 체크
					
				}
				else{

					$sql.="ALTER TABLE  `board_".$param['id']."_comment` ADD  `password` VARCHAR(255) NOT NULL DEFAULT '' COMMENT  '비밀번호' AFTER  `board_no`;";
				}
			}
			else{
				if(searchField($boardCommentFields,'user_no')){ //회원제를 이미 쓰고있는지 체크
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` DROP  `user_no`;";	

				}
				else{
				
				}
				if(searchField($boardCommentFields,'password')){ //비회원제를 이미 쓰고있는지 체크
				
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` DROP  `password`;";	

				}
				else{
				
				}
			}

			/*
				회원제 사용에 분류하여 삭제일을 유동적으로 추가
			*/
			if($param['delete_type']==0){ //임시삭제 사용 할 경우
				if(searchField($boardCommentFields,'delete_date')){ //임시삭제일을 이미 쓰고있는지 체크
					
				}
				else{
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` ADD  `delete_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT  '삭제일' AFTER  `board_no`;";
				}
			}
			else{

				if(searchField($boardCommentFields,'delete_date')){ //임시삭제일을 이미 쓰고있는지 체크
					$sql.="ALTER TABLE  `board_".$param['id']."_comment` DROP  `delete_date`;";	
				}
				else{
				
				}
			}

	
			$sql = explode(';',$sql);

		
			foreach($sql as $sqlItem){
				if($sqlItem!=''){
					sqlQuery($sqlItem);
				}
				
			}

			updateItem('boards',$param,$param['no']);
		}
		else{
			$boardCustomField =='';
		if(!is_empty_array($param['field'])){
		
			foreach($param['field'] as $index=>$field){
			
				if($field==''){
					continue;
				}


				$dataType = $param['data_type'][$index];
				$comment = $param['comment'][$index];
				$size = $param['data_type_size'][$index];
				$unsigned = $param['unsigned'][$index];
				$default = 0;
				if($dataType=='varchar'||$dataType=='text'){
					$default = '""';
				}
				if($dataType=='datetime'){
					$default = '"0000-00-00 00:00:00"';
				}
				if($size!=''){
					$size = '('.$size.')';
				}

				if($unsigned==1){
					$unsigned = 'unsigned';
				}
				else{
					 $unsigned='';
				}
				$boardCustomField.= ($field.' '.$dataType.$size.' '.$unsigned.' not null default '.$default.' comment "'.$comment.'",');
			}
			
		}
		
			$boardCommentCustomField =='';
			if(!is_empty_array($param['field_comment'])){
				foreach($param['field_comment'] as $index=>$field){

					if($field==''){
						continue;
					}
					$dataType = $param['data_type_comment'][$index];
					$comment = $param['comment_comment'][$index];
					$size = $param['data_type_size_comment'][$index];
						$unsigned = $param['unsigned_comment'][$index];
					$default = 0;
					if($dataType=='varchar'||$dataType=='text'){
						$default = '""';
					}
					if($dataType=='datetime'){
						$default = '"0000-00-00 00:00:00"';
					}
					if($size!=''){
						$size = '('.$size.')';
					}
					if($unsigned==1){
						$unsigned = 'unsigned';
					}
						else{
						 $unsigned='';
					}
					$boardCommentCustomField.= ($field.' '.$dataType.$size.' '.$unsigned.' not null default '.$default.' comment "'.$comment.'",');
				}
				
			}

			if($param['user_type']==1||$param['user_type']==2){
				$userScheme = 'user_no int unsigned not null default 0 comment "회원번호",';
			}
			if($param['user_type']==2){
				$userScheme = 'password varchar(255) not null default "" comment "비밀번호",';
			}
			if($param['delete_type']==0){
				$deleteScheme = 'delete_date DATETIME not null default "0000-00-00 00:00:00" comment "삭제일",';
			}
			if($param['use_secret']==1){

				$secretScheme = 'is_secret int unsigned not null default 0 comment "비밀글 여부",';
			}
			insertItem('boards',$param);
			
			//SQL로 기본형 생성
			sqlQuery("CREATE TABLE `board_{$param['id']}` (
			  `no` int(11) NOT NULL AUTO_INCREMENT,
			  title varchar(255) not null default '' comment '제목',
			  contents TEXT not null default '' comment '내용',
			  ".$boardCustomField."
			  hit int unsigned not null default 0 comment '조회수',
			  comments int unsigned not null default 0 comment '댓글수',
			  ".$userScheme."
			   ".$deleteScheme."
			   ".$secretScheme."
			 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
			`modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
			  PRIMARY KEY (`no`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
			sqlQuery("CREATE TABLE `board_{$param['id']}_comment` (
				  `no` int(11) NOT NULL AUTO_INCREMENT,
				  contents TEXT not null default '' comment '내용',
				  ".$boardCommentCustomField."
				    reply_no int unsigned not null default 0 comment '댓글용 번호',
				  sort int unsigned not null default 0 comment '댓글용  같은 번호 내 정렬',
				  depth int unsigned not null default 0 comment '깊이',
				  parent_no int unsigned not null default 0 comment '부모번호',
				  board_no int unsigned not null default 0 comment '부모 게시글 번호',
				   ".$userScheme."
				   ".$deleteScheme."
				`create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
				`modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
				  PRIMARY KEY (`no`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			");
		}


		redirect('/admin/board/config');
		exit;
	}
	if($param['no']){

		$board = getItem('boards',$param['no']);

		$categories = explode('|',$board['categories']);
		
		$boardFields = getListQuery('show full columns from board_'.$board['id']);
		$boardCommentFields = getListQuery('show full columns from board_'.$board['id'].'_comment');
	

		
	
	}
	



	include'views/admin/document.html';
	include'views/admin/header.html';
?>	
<h2 id="contents_title">
	<i class="fa fa-leaf"></i>
	게시판 관리
</h2>
<div class="contents">
	
	<div class="container">
		<h3 class="title">
			<i class="fa fa-users"></i> 게시판 설정 상세
		</h3>
		<form action="" method="post" class="form-horizontal form-bordered ">
			<input type="hidden" name="has_data" value="1" />
			
			<table class="table horizontal">
				
					<?php
					if(!$param['no']){
				?>
					<tr>
						<th>게시판 테이블 정의</th>
						<td>
							<div class="row">
								<input type="text" name="field[]"  placeholder="필드명" style="width:130px;">
								<select name="data_type[]">
									<option value="int">INT</option>
									<option value="varchar">VARCHAR</option>
									
									
									<option value="text">TEXT</option>
									<option value="datetime">DATETIME</option>
									<option value="float">FLOAT</option>
								</select>
								
								<input type="text" name="data_type_size[]" placeholder="자료형 크기"  style="width:90px;">
								<input type="checkbox" name="unsigned[]" value="1"> 양수
								<input type="checkbox" name="unsigned[]" value="0"> 음/양수
								<input type="checkbox" name="unsigned[]" value="string" /> 문자열
								<input type="text" name="comment[]" placeholder="코멘트" />
							</div>

							
						
							<a href="" class="btn green add_field" class="add_field" >필드 추가</a>
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</td>
					</tr>

					<tr>
						<th>게시판 댓글 테이블 정의</th>
						<td>
							<div class="row">
								<input type="text" name="field_comment[]"  placeholder="필드명" style="width:130px;" >
								<select name="data_type_comment[]">
									<option value="int">INT</option>
									<option value="varchar">VARCHAR</option>
									<option value="text">TEXT</option>
									<option value="datetime">DATETIME</option>
									<option value="float">FLOAT</option>
								</select>

								<input type="text" name="data_type_size_comment[]" placeholder="자료형 크기" style="width:90px;">
								<input type="checkbox" name="unsigned_comment[]" value="1"> 양수
								<input type="checkbox" name="unsigned_comment[]" value="0"> 음/양수
								<input type="checkbox" name="unsigned_comment[]" value="string"> 문자열
								<input type="text" name="comment_comment[]" placeholder="코멘트" />
							</div>
						
							<a href="" class="btn green add_field_comment" class="add_field" >필드 추가</a>
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</td>
					</tr>



				<?php
					}
				else{
				 
				?>
				<tr>
						<th>게시판 테이블 정의</th>
					<td>
						<?php

						$defaultField = array('no','title','contents','hit','comments','create_date','user_no','modify_date','delete_date','is_secret','password');
						$defaultFieldComment = array('no','title','contents','hit','comments','create_date','user_no','modify_date','delete_date','sort','depth','parent_no','board_no','reply_no','password');
							foreach($boardFields['list'] as $boardField){

						$type=  null;
						$type2=null;
						$type = explode('(',$boardField['Type']);
						if(count($type)>1){
							$type2 = explode(')',$type[1]);
							
						}
						$type[1] = $type2[0];
						$type[2] = trim($type2[1]);

						if(in_array($boardField['Field'],$defaultField )===true){
							continue;
						}
					

						//print_x($boardField);
						?>
						<div class="row">
							<input type="text" name="field[]"  value="<?=$boardField['Field']?>" placeholder="필드명" style="width:130px;" >
							<input type="hidden" name="origin_field[]"  value="<?=$boardField['Field']?>"/>
							<select name="data_type[]">
								<option value="int" <?=attr($type[0]=='int')?>>INT</option>
								
								<option value="varchar" <?=attr($type[0]=='varchar')?>>VARCHAR</option>
								<option value="text" <?=attr($type[0]=='text')?>>TEXT</option>
								<option value="datetime" <?=attr($type[0]=='datetime')?>>DATETIME</option>
								<option value="float" <?=attr($type[0]=='float')?>>FLOAT</option>
							</select>
							
								<input type="text" name="data_type_size[]" value="<?=$type[1]?>" placeholder="자료형 크기"  style="width:90px;">
							<input type="checkbox" name="unsigned[]" value="1"  <?=attr($type[2]=='unsigned'&&($type[0]=='int'||$type[0]=='float'),'checked')?>> 양수
							<input type="checkbox" name="unsigned[]" value="0"  <?=attr($type[2]!='unsigned'&&($type[0]=='int'||$type[0]=='float'),'checked')?>> 음/양수
							<input type="checkbox" name="unsigned[]" value="0"  <?=attr($type[2]!='unsigned'&&($type[0]=='varchar'||$type[0]=='text'||$type[0]=='datetime'),'checked')?>> 문자열 
							<input type="text" name="comment[]" placeholder="코멘트" value="<?=$boardField['Comment']?>" />
							<a href="#" class="btn btn-xs btn-danger delete_button">삭제</a>
						</div>
							
						
					
							
						<?php
							}	
						?>
						<a href="" class="btn green add_field" class="add_field" >필드 추가</a>
						</td>
					</tr>
			

				<tr>
					<th>게시판 댓글 테이블 정의</th>
					<td>
						<?php
					foreach($boardCommentFields['list'] as $boardCommentField){

					$type=  null;
					$type2=null;
					$type = explode('(',$boardCommentField['Type']);
					if(count($type)>1){
						$type2 = explode(')',$type[1]);
						
					}
					$type[1] = $type2[0];
					$type[2] = trim($type2[1]);

					if(in_array($boardCommentField['Field'],$defaultFieldComment )===true){
						continue;
					}

					//print_x($boardCommentField);
					?>
						<div class="row">
							<input type="text" name="field_comment[]"  value="<?=$boardCommentField['Field']?>" placeholder="필드명"  style="width:130px;">
							<input type="hidden" name="origin_field_comment[]"  value="<?=$boardCommentField['Field']?>"/>
							<select name="data_type_comment[]">
								<option value="int" <?=attr($type[0]=='int')?>>INT</option>
								<option value="varchar" <?=attr($type[0]=='varchar')?>>VARCHAR</option>
								<option value="float" <?=attr($type[0]=='float')?>>FLOAT</option>
								
								<option value="text" <?=attr($type[0]=='text')?>>TEXT</option>
								<option value="datetime" <?=attr($type[0]=='datetime')?>>DATETIME</option>
							</select>
							
							
							<input type="text" name="data_type_size_comment[]" value="<?=$type[1]?>" placeholder="자료형 크기"  style="width:90px;">
							<input type="checkbox" name="unsigned_comment[]" value="1"  <?=attr($type[2]=='unsigned'&&($type[0]=='int'||$type[0]=='float'),'checked')?>> 양수
							<input type="checkbox" name="unsigned_comment[]" value="0"  <?=attr($type[2]!='unsigned'&&($type[0]=='int'||$type[0]=='float'),'checked')?>> 음/양수
							<input type="checkbox" name="unsigned_comment[]" value="0"  <?=attr($type[2]!='unsigned'&&($type[0]=='varchar'||$type[0]=='text'||$type[0]=='datetime'),'checked')?>> 문자열
							<input type="text" name="comment_comment[]" placeholder="코멘트" value="<?=$boardCommentField['Comment']?>" />
							<a href="#" class="btn btn-xs btn-danger delete_button">삭제</a>
						</div>
					
						
					<?php
						}	
					?>
					
						<a href="" class="btn green add_field_comment" class="add_field" >필드 추가</a>
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</td>
				</tr>

				<?php
				}
				?>
				<tr>
						<th>게시판 그룹</th>
						<td>
							<input type="text" name="group_name" value="<?=$board['group_name']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</td>
					</tr>
					<tr>
						<th>게시판 이름</th>
						<td>
							
							<input type="text" name="name" value="<?=$board['name']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</td>
					</tr>
					<tr>
						<th>게시판 아이디</th>
						<td>
							<input type="text" name="id" value="<?=$board['id']?>" <?=attr($param['no'],'readonly')?>>
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</td>
					</tr>
					<tr>
						<th>카테고리</th>
						<td>
						<?php
							if(!$param['no']){
						?>
						<input type="text" name="categories[]" class="form-control">
						<?php
							}
						?>
						
						<a href="" class="btn btn-success" id="add_category" style="margin-top:10px;">카테고리 추가</a>
						<?php
						if(!is_empty_array($categories)){

							foreach ($categories as $category){
						?>
						<div class="row">
							<input type="text" name="categories[]" value="<?=$category?>" >
							<a href="#" class="delete">x</a>
						</div>
						
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						<?php
							}
						}
						?>
						</div>
					</tr>
					<tr>
						<th>목록 수</th>
						<td>
							<input type="text" name="item_count" value="<?=$board['item_count']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>목록 페이징 수</th>
						<td>
							<input type="text" name="paging_count" value="<?=$board['paging_count']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>댓글 목록 수</th>
						<td>
							<input type="text" name="comment_count" value="<?=$board['comment_count']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>댓글 페이징 수</th>
						<td>
							<input type="text" name="comment_paging_count" value="<?=$board['comment_paging_count']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>

					<tr>
						<th>스킨</th>
						<td>
						
							<select name="skin" class="form-control">
								<option value="">
									스킨 선택
								</option>
								<?php
									foreach ($skins as $skin ) {
								?>
								<option value="<?=$skin?>" <?=attr($board['skin']==$skin)?>><?=$skin?></option>
								<?php
									}	
								?>
							</select>
						</div>
					</tr>
					
					<tr>
						<th>목록 조회 권한</th>
						<td>
							<input type="text" name="list_grade" value="<?=$board['list_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>상세 조회 권한</th>
						<td>
							<input type="text" name="read_grade" value="<?=$board['read_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					
					<tr>
						<th>쓰기 권한</th>
						<td>
							<input type="text" name="write_grade" value="<?=$board['write_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>수정 권한</th>
						<td>
							<input type="text" name="modify_grade" value="<?=$board['modify_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>삭제 권한</th>
						<td>
							<input type="text" name="delete_grade" value="<?=$board['delete_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					
					<tr>
						<th>댓글 목록 조회 권한</th>
						<td>
							<input type="text" name="comment_list_grade" value="<?=$board['comment_list_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</div>
		
					
					<tr>
						<th>댓글 쓰기 권한</th>
						<td>
							<input type="text" name="comment_write_grade" value="<?=$board['comment_write_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>댓글 수정 권한</th>
						<td>
							<input type="text" name="comment_modify_grade" value="<?=$board['comment_modify_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>댓글 삭제 권한</th>
						<td>
							<input type="text" name="comment_delete_grade" value="<?=$board['comment_delete_grade']?>" />
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>데이터 삭제 유형</th>
						<td>
							<input type="radio" name="delete_type" value="0" <?=attr($board['delete_type']==0,'checked')?>> 임시 삭제(DB에 기록 남김)
							<input type="radio" name="delete_type" value="1" <?=attr($board['delete_type']==1,'checked')?>> 영구 삭제 (DB에서 삭제)
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>회원제 사용</th>
						<td>
							
							
							<input type="radio" name="user_type" value="0" <?=attr($board['user_type']==0,'checked')?>> 비회원만 사용
							<input type="radio" name="user_type" value="1" <?=attr($board['user_type']==1,'checked')?>> 회원만 사용
							<input type="radio" name="user_type" value="2" <?=attr($board['user_type']==2,'checked')?>> 회원 비회원 모두 사용
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>비밀글 사용</th>
						<td>
							
							<input type="radio" name="use_secret" value="1" <?=attr($board['use_secret']==1,'checked')?>> 사용
							<input type="radio" name="use_secret" value="0" <?=attr($board['use_secret']==0,'checked')?>> 사용안함
							<!-- <span class="help-block">
							Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
						</div>
					</tr>
					<tr>
						<th>필드 불러오기</th>
						<td>
							<input type="text" name="list_user_field"  value="<?=$board['list_user_field']?>" placeholder="리스트에서 사용 할 유저 필드"  style="width:600px;"><br><br>
							<input type="text" name="view_user_field"  value="<?=$board['view_user_field']?>" placeholder="뷰에서 사용 할 유저 필드"  style="width:600px;"><br><br>
							<input type="text" name="write_user_field"  value="<?=$board['write_user_field']?>" placeholder="글쓰기에서 사용 할 유저 필드"  style="width:600px;"><br><br>
							<input type="text" name="comment_user_field"  value="<?=$board['comment_user_field']?>" placeholder="댓글에서 사용 할 유저 필드"  style="width:600px;">
						</td>
					</tr>
					
					
					<?php
						if ($param['no']) {
					?>
					<tr>
						<th>등록일</th>
						<td>
						 <div  class="input-append date datetimepicker">
							<input type="text" name="create_date" readonly value="<?=$board['create_date']?>" />
					</tr>
						
					
					<?php
						}
					?>
					
		
		
			</table>
			<div class="buttons">
				<input type="submit" value="<?=attr($param['no'],'수정','등록')?>" class="btn btn-blue btn-large">
				<a href="/admin/board/config" class="btn btn-red btn-large">목록</a>
			</div>
		</form>
	</div>

</div>
	
   

<style type="text/css">
.row{
	margin-top:5px;
	margin-left:10px;
}
.add_field{
	margin-top:10px;
}
.add_field_comment{
	margin-top:10px;
}
</style>
<script type="text/javascript">
	$('.add_field').click(function(){
		$(this).before('<div class="row"><input type="text" name="field[]"  placeholder="필드명" style="width:130px;"><input type="hidden" name="origin_field[]"  value=""/> <select name="data_type[]"><option value="int">INT</option><option value="varchar">VARCHAR</option><option value="text">TEXT</option><option value="datetime">DATETIME</option><option value="float">FLOAT</option></select> <input type="text" name="data_type_size[]" placeholder="자료형 크기" style="width:90px;">  <input type="checkbox" name="unsigned[]" value="1"> 양수 <input type="checkbox" name="unsigned[]" value="0"> 음/양수 <input type="checkbox" name="unsigned[]" value="string"> 문자열 <input type="text" name="comment[]" placeholder="코멘트" /> <a href="#" class="btn btn-xs btn-danger delete_button">삭제</a></div>');
		return false;
	
	});
	$('.add_field_comment').click(function(){
		$(this).before('<div class="row"><input type="text" name="field_comment[]"  placeholder="필드명"  style="width:130px;"> <input type="hidden" name="origin_field[]"  value=""/><select name="data_type_comment[]"><option value="int">INT</option><option value="varchar">VARCHAR</option><option value="text">TEXT</option><option value="datetime">DATETIME</option><option value="float">FLOAT</option></select> <input type="text" name="data_type_size_comment[]" placeholder="자료형 크기"  style="width:90px;"> <input type="checkbox" name="unsigned_comment[]" value="1"> 양수 	<input type="checkbox" name="unsigned_comment[]" value="0"> 음/양수 	 <input type="checkbox" name="unsigned_comment[]" value="string"> 문자열 <input type="text" name="comment_comment[]" placeholder="코멘트" /> <a href="#" class="btn btn-xs btn-danger delete_button">삭제</a></div>');
		return false;
	
	});
	$('[name="edit_board_table"],[name="edit_comment_table"]').click(function(){
		var checked = $(this).prop('checked');
		if(checked){
			var affirmative= confirm('구조 수정시 기존 데이터가 모두 삭제됩니다.');
			if(!affirmative){
				$(this).prop('checked',false);
				return false;
			}
		}
	});

	$('#add_category').click(function(){
		$(this).before('<div><input type="text" name="categories[]" style="margin-top:10px;"> <a href="" class="delete">x</a></div>');
		return false;
	});
	$('.delete').click(function(){
		$(this).parent().remove();
		return false;
	});

	$(document).on('click','.delete_button',function(){
		$(this).parent().remove();
		return false;
	});
</script>

<?php
	include'views/admin/footer.html';
?>