<?php

function displayStatus($status){
	if($status==0){
		return '견적바구니';
	}
	if($status==1){
		return '주문접수';
	}
	if($status==2){
		return '구매자정보확인';
	}
	if($status==3){
		return '입금대기중';
	}
	if($status==4){
		return '입금확인';
	}
	if($status==5){
		return '계약서 및 서류 확인';
	}
	if($status==6){
		return '배송중';
	}

	if($status==9){
		return '주문취소';
	}
	if($status==10){
		return '판매완료';
	}
}
function displayDetail($details){

$details=json_decode( $details,true);
$detailIndex=0;

	unset($details['uni_price']);
					unset($details['price']);
					unset($details['quantity']);
					
					echo $product['category'];
		if($details!=''){
					foreach($details as $title=>$detail){	
				
						
						if($detail!=''){
							if($detailIndex!=0){	
							echo ',';
							}
					echo $detail;
						}
						$detailIndex++;
					}
					}

}
function displayDetailEach($details,$detailsEach){

$details=json_decode( $details,true);
$detailIndex=0;

	echo $details[$detailsEach];

}


