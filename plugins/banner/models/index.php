<?php
	if(!$param['mode']){
		$param['mode'] = 'list';
	}
		
	switch($param['mode']){
		case 'add' :
			if($param['has_data']){
				if($_FILES['image']){
					$image = uploadFile($_FILES['image'],'/files');
					$param['image'] = $image['path'];
				}
				if($param['no']){
					updateItem('banners',$param,$param['no']);
					
				}
				else{
					insertItem('banners',$param);
				}
				getBack($melon['path'].'/mode/list');
				exit;
			}
			if($param['no']){
				$banner = getItem('banners',$param['no']);
			}
			break;
		case 'list' : 
			
			$banners = pageList('banners','','',5,10,$param['page'],$melon['path'].'/mode/list/page/$page'.$path);
		break;

		case 'delete'  :
			deleteItem('banners',$param['no']);
			getBack($melon['path'].'/mode/list');
			exit;
			break;
	}

	include $pluginPath.'/views/'.$param['mode'].'.html';
?>