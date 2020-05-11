<?php
	if($param['has_data']){
		$param['contents'] = jsonEncode($param);
		insertItem('applicants',$param);
		printMessage($contact_form['message'],$contact_form['url']);
		exit;
	}
	