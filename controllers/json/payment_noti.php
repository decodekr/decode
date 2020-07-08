<?php




header('Content-Type: application/json; charset=UTF-8');

if(!in_array('application/json',explode(';',$_SERVER['CONTENT_TYPE']))){
    //echo json_encode(array('result_code' => '400'));
  //  exit;
}

$__rawBody = file_get_contents("php://input");

$data= json_decode($__rawBody,true);

$param['received_data'] = $__rawBody;

if($data['trnsctnType']=='MEMBER_DEPOSIT'){
	
	$user=getItem('users','virtual_account_number="'.$data['vaccntNo'].'"');
	$order=getItem('estimate_orders','user_no='.$user['no'],'no desc');
	$carts=getList('estimate_cart_products',' status=1 AND order_no='.$order['no']);

	$cartParam['status'] = 2;
	updateItem('estimate_cart_products',$cartParam,'order_no='.$order['no']);

	$orderParam['status']=2;
	updateItem('estimate_orders',$orderParam,$order['no']);




	sendSMS('01062420349','주문번호 '.str_replace(array(' ','-',':'),'',$order['create_date']).$order['no'].'의 입금이 완료되었습니다. 상품 발송을 시작해주세요.');
	
}
insertItem('notifications',$param);


echo "SUCCESS";
