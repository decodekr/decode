<?php
include'models/payment.php';
if($param['mode']=='add_user'){
	echo addUser($param['name'],$param['email'],$param['phone']);
}

if($param['mode']=='account_check'){

	$data=jsonDecode(addUser($param['name'],$param['email'],$param['phone']));
	
	if($data['error']!=''){
		if(indexOf($data['error']['message'],'중복')!=-1){
			$guidCrude=explode('[GUID = ',$data['error']['message']);
			$guidCrude =str_replace(']','',$guidCrude[1]);
			
			deleteUser($guidCrude);
			$data=jsonDecode(addUser($param['name'],$param['email'],$param['phone']));
			$userParam['guid'] = $data['data']['memGuid'] ;
			
		

			//$userParam['guid'] =$guidCrude ;
		}
		
		
	}
	else{
		$userParam['guid']= $data['data']['memGuid'];
	}

	updateItem('users',$userParam,$session['login']);


	$accountResult  = jsonDecode ( createWithdrawAccount($userParam['guid'],$param['account'],$param['name'],$param['bankcode']) );

	if($accountResult['error']!=''){
		if(indexOf($accountResult['error']['message'],'5번')!=-1){
			$result='출금계좌 인증은 하루 5번만 가능합니다.';
			echo jsonMessage(-1,$result);
			exit;
		}
		if(indexOf($accountResult['error']['message'],'점검')!=-1){
			$result='은행 업무 점검 시간입니다.';
			echo jsonMessage(-1,$result);
			exit;
		}
	}
	else{
		echo jsonMessage(1,$accountResult['data']['tid']);
	}
	
	
}
if($param['mode']=='certify_account'){
	$user=getItem('users',$session['login']);
	$data=jsonDecode(certifyWithdrawAccount($user['guid'],$param['tid'],$param['certif_code']));

	if($data['error']!=''){
		if(indexOf($data['error']['message'],'인증번호를 다시')!=-1){
			$result='인증번호가 올바르지 않습니다.';
			echo jsonMessage(-1,$result);
		}
		exit;
	}
	
	
	$result=getVirtualAccount($user['guid'],$param['name']);
	$result= jsonDecode ($result);

	$userParam['account_number'] = $param['account_number'];
	$userParam['bank_code'] = $param['bank_code'];
	$userParam['virtual_account_number'] = $result['data']['vaccntNo'];
	$userParam['virtual_account_owner'] = $param['name'];
	updateItem('users',$userParam,$session['login']);
	

	echo jsonMessage(1,$result['data']['vaccntNo']);
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

// 유저 출금 신청
if($param['mode']=='sellerWithdraw') {
	echo sellerWithdraw($param['guid'], $param['orgCrrncy']);
}

// 유저 출금 인증
if($param['mode']=='certifySellerWithdraw') {
	echo certifySellerWithdraw($param['tid'], $param['verifyWord']);
}

if ($param['mode'] == 'getMerchantPushUrl') {
	echo getMerchantPushUrl();
}

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
