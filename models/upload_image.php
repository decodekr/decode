<?php

	
	$today = date('Y/m/');
	$no=uploadFile($_FILES["upload"],"/files/editor/".$today);
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('{$param['CKEditorFuncNum']}', '/files/editor/$today{$no['path']}', '업로드 완료');if(parent.$('input[name=\"image_no\"]').val()==''){parent.$('input[name=\"image_no\"]').val({$no['no']});}</script>";
?>