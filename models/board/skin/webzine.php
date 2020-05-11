<?php
switch  ($board['mode']) {
    case 'list' :

		addKeywordCondition($path,$where,$param['search_type'],$param['search_keyword'],true);

		if($melon['is_admin']){
			//관리자 전용
		}
		break;
	case 'view' :
		
		break;
	case 'write' :
        
	    
		if($param['has_data']){//form 전송모드
			if($_FILES['image']['name']){
            $image = uploadFile($_FILES['image'],'/files');
			}

            $param['image']= $image['path'];

           
		}
		


		

		
		if($param['no']){
			

		}
		else{
			
		}
		
	
		break;
	case 'delete' :
		
		break;
	case 'comment' :
		
		break;
	case 'comment_write' :
		
		break;
	case 'comment_delete' :
		
	break;
}