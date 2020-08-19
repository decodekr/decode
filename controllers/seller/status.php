<?php
	$orderParam['status']=$param['result'];
	updateItem($$,$orderParam,'no='.$param['no'].' AND user_no='.$param['user_no']);
?>