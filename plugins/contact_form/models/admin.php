		<?php
		if(isset($param['status'])){
			updateItem('applicants',$param,$param['no']);
			getBack();
			exit;
		}

		if($param['no']){
			deleteItem('applicants',$param['no']);
			getBack();
			exit;
		}


		$where = '';
		$path = '';
		if($param['search_keyword']){
			if($where!=''){
				$where.=' AND ';
			}
			if(!$param['search_type']){
				$where .= 'contents like "%'.$param['search_keyword'].'%"';
				
			}
			else{
				$where .= 'SUBSTRING_INDEX(SUBSTRING_INDEX(contents,\'"'.$param['search_type'].'":"\',-1),\'"\',1) like "%'.$param['search_keyword'].'%"';
			}
			$path.='/search_keyword/'.$param['search_keyword'].'/search_type/'.$param['search_type'];
		}
			$applicants = pageList('applicants',$where,'',10,10,$param['page'],$melon['path'].'/page/$page'.$path);
		
		include $pluginPath.'/views/admin.html';
		?>
			