<?php
include'models/payment.php';
if($param['mode']=='add_user'){
	echo addUser($param['name'],$param['email'],$param['phone']);
}

if($param['mode']=='account_check'){
	echo createWithdrawAccount($param['guid'],$param['account'],$param['name'],$param['bankcode']);
}
if($param['mode']=='certify_account'){
	echo certifyWithdrawAccount($param['guid'],$param['tid'],$param['certif_code']);
}
if($param['mode']=='get_virtual_account'){
	echo getVirtualAccount($param['guid'],$param['name']);
}

	
	

?>
