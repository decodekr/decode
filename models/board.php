<?php

	$melon['board']= 'boards'; // 게시판 설정 테이블명
	$melon['board_prefix'] = 'board_'; // 게시판 테이블 머리말
	if($param['board_mode']==''){
		$param['board_mode']='list'; //첫페이지 리스트 로드
	}
	
	
	if($melon['self']=='index'){
		$melonBoardSelf = '';
	}
	else{
	 $melonBoardSelf = 	$melon['self'].'/';
	}
	$board=array(
		'id'=>$param['board_id'],
		'mode'=>$param['board_mode'],
		'parent'=>$melon['dir'].'/'.$melonBoardSelf .$param['board_id'],
		'view_path'=>$melon['dir'].'/'.$melonBoardSelf .$param['board_id'].'/view/no/'.$param['no'],
		'write_path'=>$melon['dir'].'/'.$melonBoardSelf .$param['board_id'].'/write',
		'list_path'=>$melon['dir'].'/'.$melonBoardSelf .$param['board_id'].'/list',
		'self'=>$melon['dir'].'/'.$melonBoardSelf .$param['board_id'].'/'.$param['board_mode']
	);  //파라미터 정리


	$board['table'] = $melon['board_prefix'].$board['id'];
	$mode=array('list','delete','write','view','comment','comment_delete','password'); //허용되는 모드

	if(!in_array($board['mode'],$mode)){
		include'errors/error_404.html'; //db에 없는게시판의 경우 404
		exit;
	}
	
	
	$board['config'] = getItem($melon['board'],'id="'.$board['id'].'"');
	
	$board['config']['categories'] = explode('|',$board['config']['categories']);
	$board['config']['categories_number'] =  count($board['config']['categories']);

	if(!$board['config']){ 
		include'errors/error_404.html'; //db에 없는게시판의 경우 404
		exit;
	}
	

	$customSkinModel = 'models/board/skin/'.$board['config']['skin'].'.php';
	$customModel = 'models/board/'.$board['config']['id'].'.php';

	

	switch  ($board['mode']) {
		case 'list' :
		
			if(!is_file('views/board/'.$board['config']['skin'].'/list.html')){
				include'errors/error_404.html'; //db에 없는게시판의 경우 404
				exit;
			}
			//목록 권한 체크
			if($session['grade']<(int)$board['config']['list_grade']){
				if($param['data_type']=='json'){
					$board['list']['result'] = 0;
				}
				else{
					redirect('','조회 권한이 없습니다.');
					exit;
				}
			}
			
				



		//	$pagingTags = array('first'=>'<a href="/page/$page">&lt;&lt;</a>','prev'=>'<a href="/page/$page">&lt;</a>','number'=>'<a href="/page/$page">$page</a>','next'=>'<a href="/page/$page">&gt;</a>','last'=>'<a href="/page/$page">&gt;&gt;</a>','current'=>'<a href="/page/$page" class="active">$page</a>');
			

			
			if(is_file($customSkinModel)){
				include $customSkinModel; //커스텀 모델이 존재시 로드
			}
			if(is_file($customModel)){
				include $customModel; //커스텀 모델이 존재시 로드
			}

			fillEmptyParam($param['page']);
			$currentPage=$param["page"];
			if(!$where){
				$where ='';
			}
			if(!$path){
				$path ='';
			}
			if($order==''){
				$order=$board['table'].'.no desc';
			}
			if(!$join){
				$join = array();		
			}
			if(!$field){
				$field =$board['table'].'.*';
			}

			if($board['config']['list_user_field']!=''){ //유저 사용시
				
				$fields = explode(',',$board['config']['list_user_field']);
			
				foreach($fields as $fieldEach){
					
					$field.=(','.'users.'.$fieldEach.' AS user_'.$fieldEach);
				}

				array_push($join,array('LEFT','users',$board['table'].'.user_no = users.no'));

			}

			if($board['config']['delete_type']==0){
				
				if(!$melon['is_admin_page']){
					if($where!=''){
						$where.=' AND ';
					}
					$where.='delete_date="0000-00-00 00:00:00"';
				}
			}

			$pagingTags = $board['parent'].'/list/page/$page'.$path;
			$board['list']=pageListJoin($board['table'],$join,$field,$where,$order,$board['config']['item_count'],$board['config']['paging_count'],$param['page'],$pagingTags);
			

			if($param['data_type']=='json'){
				unset($board['list']['pagination']);
				echo jsonEncode($board['list']);
				exit;	
			}
			else{
				$board['list']['length'] = $board['list']['length'];	
				$board['list']['data'] = $board['list']['list'];	
			}
			


			$board['view_template'] =  'views/'.$mobilePath.'board/'.$board['config']['skin'].'/list.html';
			$board['view_template_admin'] =  'views/board/'.$board['config']['skin'].'/admin/list.html';
			break;
		case 'view' :
			if(!is_file('views/board/'.$board['config']['skin'].'/view.html')){
				include'errors/error_404.html'; //db에 없는게시판의 경우 404
				exit;
			}

			if($session['grade']<(int)$board['config']['view_grade']){
				redirect('','조회 권한이 없습니다.');
				exit;
			}
		
			
			$join = array();
			emptyParam($param['no']);

			if(is_file($customSkinModel)){
				include $customSkinModel; //커스텀 모델이 존재시 로드
			}
			if(is_file($customModel)){
				include $customModel; //커스텀 모델이 존재시 로드
			}

			if(!$field){
				$field =$board['table'].'.*';
			}

			if($board['config']['view_user_field']!=''){ //유저 사용시
					
				$fields = explode(',',$board['config']['view_user_field']);
			
				foreach($fields as $fieldEach){
					
					$field.=(','.'users.'.$fieldEach.' AS user_'.$fieldEach);
				}

				array_push($join,array('LEFT','users',$board['table'].'.user_no = users.no'));
			}
			
			$board['view']=getItemJoin($board['table'],$join,$field,$board['table'].'.no='.$param['no']);

				
			if($board['view']['is_secret']==1&$session['is_admin']==0){ //비밀글 사용시 관리자가 아닐 때
				if($session['login']){

					if($session['login']!=$board['view']['user_no']){
						redirect('','조회 권한이 없습니다.');
						exit;
					}
				}
				else{
					if($param['password']!=$board['view']['password']||$param['password']==''){
						redirect('','조회 권한이 없습니다.');
						exit;
					}
				}
			}
			

			/* 쿠키 체크하여 조회수 적용 */
	
			if($_COOKIE[$board['id'].'-'.$param['no']]!=1){
				setcookie($board['id'].'-'.$param['no'],1,time()+3600*24);
				
				$hitParam['hit'] =1;
				calcItem($board['table'],$hitParam,$param['no']);
			}
		
		
			
			
			if($param['data_type']=='json'){
				
			
				echo jsonEncode($board['view']);
				exit;
				
			}

			


			$board['view_template'] = 'views/'.$mobilePath.'board/'.$board['config']['skin'].'/view.html';
			$board['view_template_admin'] = 'views/board/'.$board['config']['skin'].'/admin/view.html';
			break;
		case 'password' : 

			if(!is_file('views/board/'.$board['config']['skin'].'/password.html')){
				include'errors/error_404.html'; //db에 없는게시판의 경우 404
				exit;
			}

			if(is_file($customSkinModel)){
				include $customSkinModel; //커스텀 모델이 존재시 로드
			}
			if(is_file($customModel)){
				include $customModel; //커스텀 모델이 존재시 로드
			}

			$board['view_template'] = 'views/'.$mobilePath.'board/'.$board['config']['skin'].'/password.html';
			$board['view_template_admin'] = 'views/board/'.$board['config']['skin'].'/admin/password.html';
			break;
		case 'write' :

			if(is_file($customSkinModel)){
				include $customSkinModel; //커스텀 모델이 존재시 로드
			}
			if(is_file($customModel)){
				include $customModel; //커스텀 모델이 존재시 로드
			}
			if($param['has_data']){
				if($param['no']){
					$board['write']=getItem($board['table'],$param['no']);

					if($session['grade']<(int)$board['config']['modify_grade']){
						redirect('','작성 권한이 없습니다.');
						exit;
					}

					if($session['login']&&$session['is_admin']==0){ //유저사용 하고 관리자가 아닐 때
						if($session['login']!=$board['write']['user_no'] && $param['password']!=$board['write']['password']){ //작성자가 안맞고 동시에 비번이 안맞을때
							redirect('','작성 권한이 없습니다.');
							exit;
						}
					}
					else{
						if($session['is_admin']!=1){
							if($param['password']!=$board['write']['password']){ //비번만 맞는지 체크
								redirect('','작성 권한이 없습니다.');
								exit;
							}
						}
					}
					updateItem($board['table'],$param,$param['no']);
					$redirect = $board['parent'].'/view/no/'.$param['no'];
					
				}
				else{
					
					if($session['grade']<(int)$board['config']['write_grade']){
						redirect('','작성 권한이 없습니다.');
						exit;
					}
					if($session['login']){
						$param['user_no'] = $session['login'];
					}
					$param['inserted_no']=insertItem($board['table'],$param);

					

					//게시판최근글 삽입
					$latestParam['title']=$param['title'];
					$latestParam['user_no']=$param['user_no'];
					$latestParam['board_no']=$param['inserted_no'];
					$latestParam['board_id']=	 $board['id'];
					$latestParam['board_name']=	$board['config']['name'];
					insertItem('latest_boards',$latestParam);

				}

				redirect($board['parent']);
				exit;
			}
			
			if(!is_file('views/board/'.$board['config']['skin'].'/write.html')){
				include'errors/error_404.html'; //db에 없는게시판의 경우 404
				exit;
			}

			

			
			if($param['no']){
				if($session['grade']<(int)$board['config']['modify_grade']){
					redirect('','조회 권한이 없습니다.');
					exit;
				}

				if(!$field){
					$field =$board['table'].'.*';
				}

				if($board['config']['write_user_field']!=''){ //유저 사용시
						
					$fields = explode(',',$board['config']['write_user_field']);
				
					foreach($fields as $fieldEach){
						
						$field.=(','.'users.'.$fieldEach.' AS user_'.$fieldEach);
					}

					array_push($join,array('LEFT','users',$board['table'].'.user_no = users.no'));
				}
				
				$board['write']=getItemJoin($board['table'],$join,$field,$board['table'].'.no='.$param['no']);

			}
			else{
				if($session['grade']<(int)$board['config']['write_grade']){
					redirect('','조회 권한이 없습니다.');
					exit;
				}
			}
			
		
			
		
			

			$board['view_template'] = 'views/'.$mobilePath.'board/'.$board['config']['skin'].'/write.html';
			$board['view_template_admin'] = 'views/board/'.$board['config']['skin'].'/admin/write.html';
			break;
		case 'delete' :
			$board['delete']=getItem($board['table'],$param['no']);

			if($session['grade']<(int)$board['config']['delete_grade']){
				redirect('','삭제 권한이 없습니다.');
				exit;
			}

			if($session['login']&&$session['is_admin']==0){ //유저사용 하고 관리자가 아닐 때
				if($session['login']!=$board['delete']['user_no'] && $param['password']!=$board['delete']['password']){ //작성자가 안맞고 동시에 비번이 안맞을때
					redirect('','삭제 권한이 없습니다.');
					exit;
				}
			}
			else{
				if($param['password']!=$board['delete']['password']){ //비번만 맞는지 체크
					redirect('','삭제 권한이 없습니다.');
					exit;
				}
			}
		
			if(!$redirect){
				$redirect  = $board['parent'].'/list';
			}

			if(is_file($customSkinModel)){
				include $customSkinModel; //커스텀 모델이 존재시 로드
			}
			if(is_file($customModel)){
				include $customModel; //커스텀 모델이 존재시 로드
			}
			
			if($board['config']['delete_type']==0) {
				$param['delete_date'] = date('Y-m-d H:i:s');
				updateItem($board['table'],$param,$param['no']);
			}
			else{
				deleteItem($board['table'],$param['no']);
			}

			deleteItem('latest_boards','board_no='.$param['no']);
			
			redirect($redirect);
			break;
		case 'comment' :
			//목록 권한 체크
			if($session['grade']<(int)$board['config']['comment_list_grade']){
				$data['result'] = 0;
			}
			else{

				
				

			//	$pagingTags = array('first'=>'<a href="/page/$page">&lt;&lt;</a>','prev'=>'<a href="/page/$page">&lt;</a>','number'=>'<a href="/page/$page">$page</a>','next'=>'<a href="/page/$page">&gt;</a>','last'=>'<a href="/page/$page">&gt;&gt;</a>','current'=>'<a href="/page/$page" class="active">$page</a>');
				$pagingTags = '$page';

	
				/*Essential
					공통 폼검증, 파일업로드, 섬네일처리 등.
				*/
				if(is_file($customSkinModel)){
					include $customSkinModel; //커스텀 모델이 존재시 로드
				}
				if(is_file($customModel)){
					include $customModel; //커스텀 모델이 존재시 로드
				}

				

				if($param['has_data']){
				
					if($param['no']){
						if($session['grade']<(int)$board['config']['comment_modify_grade']){
							$data['result'] = 0;
							exit;
						}

						$board['comment']=getItem($board['table'].'_comment',$param['no']);

						if($session['login']&&$session['is_admin']==0){ //유저사용 하고 관리자가 아닐 때
							if($session['login']!=$board['comment']['user_no'] && $param['password']!=$board['comment']['password']){ //작성자가 안맞고 동시에 비번이 안맞을때
								$data['result'] = 0;
								exit;
							}
						}
						else{
							if($param['password']!=$board['comment']['password']){ //비번만 맞는지 체크
								$data['result'] = 0;
								exit;
							}
						}
				
					
						updateItem($board['table'].'_comment',$param,$param['no']);
						$data['result'] = 1; 
						
						
					}
					else{
						if($session['grade']<(int)$board['config']['comment_write_grade']){
							$data['result'] = 0;
						}
						else{
							$commentTableInfo= getItemQuery('show table status like "'.$board['table'].'_comment'.'" ');
							
						
							if($param['parent_no']){

								
								
								$parent = getItem($board['table'].'_comment',$param['parent_no']);
								$childComment = getItem($board['table'].'_comment','parent_no='.$param['parent_no']);
							
								$param['reply_no'] = $parent['reply_no'];
								$param['depth'] = $parent['depth'] + 1;
								
								
								if(!$childComment){
									$param['sort']=$parent['sort']+1;
								}
								else{
									$param['sort'] =  $childComment['sort']+1;
								}
								$replyParam['sort'] = 1;
								calcItem($board['table'].'_comment',$replyParam,'reply_no='.$parent['reply_no'].' AND sort>='.$param['sort']);
							}
							else{
								
								$param['sort'] =1;
								$param['parent_no'] = $param['reply_no'];
								$param['reply_no'] =$commentTableInfo['Auto_increment'];
							}

						

							if($session['login']){
								$param['user_no'] = $session['login'];
							}



							$param['inserted_no']=insertItem($board['table'].'_comment',$param);

							// 최근댓글 체크하여 삽입
							$param['comment_no'] = $param['inserted_no'];
							$param['board_name'] = $board['config']['name'];
							insertItem('latest_comments',$param);



							$data['result'] = $param['inserted_no']; 
						}
					}

					if($param['parent_no']){
						//하위 댓글수 점검 후 업데이트
						$replyTotalWhere = 'parent_no='.$param['parent_no'];
						if($board['config']['delete_type']==0){
							$replyTotalWhere.=' AND delete_date="0000-00-00 00:00:00"';
						}
						$replyTotal = getTotal($board['table'].'_comment',$replyTotalWhere);
						$replyParam['replies'] = $replyTotal;
						updateItem($board['table'].'_comment',$replyParam,$param['parent_no']);

						//이 댓글의 latest도 찾아서 업데이트.
				
						$latestParam['replies'] =  $replyTotal;

						updateItem('latest_comments',$latestParam,'comment_no='.$param['parent_no']);
					}
					
					//댓글수 점검 후 업데이트
					$commentTotalWhere = 'board_no='.$param['board_no'];
					if($board['config']['delete_type']==0){
						$commentTotalWhere.=' AND delete_date="0000-00-00 00:00:00"';
					}
					$commentTotal = getTotal($board['table'].'_comment',$commentTotalWhere);
					$boardParam['comments'] = $commentTotal;
					updateItem($board['table'],$boardParam,$param['board_no']);

					//이 댓글의 부모글의 latest도 찾아서 업데이트.
				
					$latestParam['comments'] =  $commentTotal;

					updateItem('latest_boards',$latestParam,'board_no='.$param['board_no']);


					echo jsonEncode($data);
					exit;

				}
				

				fillEmptyParam($param['page']);
				$currentPage=$param["page"];
				if(!$where){
					$where ='board_no='.$param['board_no'];
				}
				if(!$path){
					$path ='';
				}
				if($order==''){
					$order=$board['table'].'_comment.no asc';
				}
				if(!$join){
					$join = array();		
				}
				if(!$field){
					$field =$board['table'].'_comment.*';
				}

				if($board['config']['delete_type']==0){	
					if(!$melon['is_admin_page']){
						if($where!=''){
							$where.=' AND ';
						}
						$where.='delete_date="0000-00-00 00:00:00"';
					}
				}

				if($board['config']['comment_user_field']!=''){ //유저 사용시
					
					$fields = explode(',',$board['config']['comment_user_field']);
				
					foreach($fields as $fieldEach){
						
						$field.=(','.'users.'.$fieldEach.' AS user_'.$fieldEach);
					}

					array_push($join,array('LEFT','users',$board['table'].'_comment.user_no = users.no'));
				}


				
	
				$board['comment']=pageListJoin($board['table'].'_comment',$join,$field,$where,$order,$board['config']['comment_count'],$board['config']['comment_paging_count'],$param['page'],$pagingTags);

				$data=$board['comment'];
			}
			echo jsonEncode($data);
			exit;
			break;
		case 'comment_delete' :
			

			if($session['grade']<(int)$board['config']['delete_grade']){
				
				$data['result'] = 0;
				exit;
			}
				
			$board['comment_delete']=getItem($board['table'].'_comment',$param['no']);

			if($session['login']&&$session['is_admin']==0){ //유저사용 하고 관리자가 아닐 때
				if($session['login']!=$board['comment_delete']['user_no'] && $param['password']!=$board['comment_delete']['password']){ //작성자가 안맞고 동시에 비번이 안맞을때
					$data['result'] = 0;
				exit;
				}
			}
			else{
				if($param['password']!=$board['comment_delete']['password']){ //비번만 맞는지 체크
					$data['result'] = 0;
					exit;
				}
			}

			if(is_file($customSkinModel)){
				include $customSkinModel; //커스텀 모델이 존재시 로드
			}
			if(is_file($customModel)){
				include $customModel; //커스텀 모델이 존재시 로드
			}
			
			if($board['config']['delete_type']==0) {
				$param['delete_date'] = date('Y-m-d H:i:s');
				$data['result'] = updateItem($board['table'].'_comment',$param,$param['no']);
			}
			else{
				$data['result'] = deleteItem($board['table'].'_comment',$param['no']);
			}

			// 최근댓글 체크하여 제거

			deleteItem('latest_comments','comment_no='.$param['no']);

			

			
		if($board['comment_delete']['parent_no']!=0){
			//하위 댓글수 점검 후 업데이트
			$replyTotalWhere = 'parent_no='.$board['comment_delete']['parent_no'];
			if($board['config']['delete_type']==0){
				$replyTotalWhere.=' AND delete_date="0000-00-00 00:00:00"';
			}
			$replyTotal = getTotal($board['table'].'_comment',$replyTotalWhere);
			$replyParam['replies'] = $replyTotal;
			updateItem($board['table'].'_comment',$replyParam,$board['comment_delete']['parent_no']);
			
			//이 댓글의 latest도 찾아서 업데이트.
			
			$latestParam['replies'] =  $replyTotal;

			updateItem('latest_comments',$latestParam,'comment_no='.$board['comment_delete']['parent_no']);

		}

		//댓글수 점검 후 업데이트
		$commentTotalWhere = 'board_no='.$board['comment_delete']['board_no'];
		if($board['config']['delete_type']==0){
			$commentTotalWhere.=' AND delete_date="0000-00-00 00:00:00"';
		}
		$commentTotal = getTotal($board['table'].'_comment',$commentTotalWhere);

		$boardParam['comments'] = $commentTotal;
		updateItem($board['table'],$boardParam,$board['comment_delete']['board_no']);

		//이 댓글의 부모글의 latest도 찾아서 업데이트.
				
		$latestParam['comments'] =  $commentTotal;

		updateItem('latest_boards',$latestParam,'board_no='.$board['comment_delete']['board_no']);



		echo jsonEncode($data);
		exit;
		break;
		
	}
	/*
	if($config['use_view']){
		$board['db']='view_'.$param['board_name']; //뷰사용시
	}
	else{
		$board['db']='table_'.$param['board_name']; //뷰사용안할시 테이블`
	}
	if(!$config){ 
		include'errors/error_404.html'; //db에 없는게시판의 경우 404
		exit;
	}
	$board = array_merge($board, $config);
	include $board['mode'].'.php'; //각모드에 대한 컨트롤러 로드*/
?>