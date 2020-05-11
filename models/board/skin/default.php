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

		if($param['has_data']){

			
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