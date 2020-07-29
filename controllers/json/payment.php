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
if($param['mode']=='check_business_code'){
	
echo getBusinessStatus($param['business_code']);

}

if($param['mode']=='getMemberBalanceInOut') {
	echo getMemberBalanceInOut($param['guid'], 1, 1000, $param['startDate'], $param['endDate']);
}

if($param['mode']=='getMemberBalanceInOut') {
	echo json_decode(getMemberBalanceInOut($param['guid'], 1, 1000, $param['startDate'], $param['endDate']));
}

if($param['mode']=='getMerchantBalance') {
	echo getMerchantBalance();
}

/*if ($param['mode'] == 'getMerchantPushUrl') {
	echo getMerchantPushUrl();
}*/

/*if ($param['mode'] == 'registerMerchantPushUrl') {
	echo registerMerchantPushUrl();
}*/

/*if ($param['mode'] == 'updateMerchantPushUrl') {
	echo updateMerchantPushUrl();
}*/


//echo checkAccount('1002338278658', '박기성', 20);

//echo addUser('박기성', 'chris.park@decodelab.co.kr', '01065050291');

//echo createWithdrawAccount('641f66c71b1c4744879494482b548473', '1002338278658', '박기성', '20');

//echo certifyWithdrawAccount('641f66c71b1c4744879494482b548473', 3308542, '3326');

//echo getVirtualAccount('641f66c71b1c4744879494482b548473', '박기성');

// 가상계좌로 입금후
//echo giveToShop('641f66c71b1c4744879494482b548473', 1);

//문자로 온 인증번호 입력
//echo certifyGiveToShop(3308579,'3844');

//echo giveToSeller('641f66c71b1c4744879494482b548473',1);


//echo sellerWithdraw('641f66c71b1c4744879494482b548473', 1);

//echo certifySellerWithdraw(3308595, '0501');

//echo getPushUrl();
//echo registerPushUrl();

//echo modifyPushUrl();

exit;

?>
