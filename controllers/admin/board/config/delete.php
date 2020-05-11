<?php
	$board = getItem('boards',$param['no']);
	sqlQuery('drop table board_'.$board['id']);
	sqlQuery('drop table board_'.$board['id'].'_comment');
	deleteItem('boards',$param['no']);
	redirect();
?>