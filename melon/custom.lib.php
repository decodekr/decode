<?php
function sendSMS($number,$message){


	
   /******************** 인증정보 ********************/
    $sms_url = "http://sslsms.cafe24.com/sms_sender.php"; // 전송요청 URL
	// $sms_url = "https://sslsms.cafe24.com/sms_sender.php"; // HTTPS 전송요청 URL
   $sms['user_id'] = base64_encode("decodesms"); //SMS 아이디.
	$sms['secure'] = base64_encode("7980f9ccbb2848867d8f6b81b65e47ef ") ;//인증키


    $sms['msg'] = base64_encode(stripslashes($message));
     $sms['rphone'] = base64_encode($number);
    $sms['sphone1'] = base64_encode('031');//$param['sphone1']);
    $sms['sphone2'] = base64_encode('732');//$param['sphone1']);
    $sms['sphone3'] = base64_encode('0349');//$param['sphone1']);
    $sms['rdate'] = base64_encode($param['rdate']);
    $sms['rtime'] = base64_encode($param['rtime']);
    $sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.
    $sms['returnurl'] = base64_encode($param['returnurl']);
    $sms['testflag'] = base64_encode($param['testflag']);
    $sms['destination'] = base64_encode($param['destination']);
    $returnurl = $param['returnurl'];
    $sms['repeatFlag'] = base64_encode($param['repeatFlag']);
    $sms['repeatNum'] = base64_encode($param['repeatNum']);
    $sms['repeatTime'] = base64_encode($param['repeatTime']);
    $nointeractive = $param['nointeractive']; //사용할 경우 : 1, 성공시 대화상자(alert)를 생략

    $host_info = explode("/", $sms_url);
    $host = $host_info[2];
    $path = $host_info[3]."/".$host_info[4];

    srand((double)microtime()*1000000);
    $boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
    //print_r($sms);

    // 헤더 생성
    $header = "POST /".$path ." HTTP/1.0\r\n";
    $header .= "Host: ".$host."\r\n";
    $header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";

    // 본문 생성
    foreach($sms AS $index => $value){
        $data .="--$boundary\r\n";
        $data .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
        $data .= "\r\n".$value."\r\n";
        $data .="--$boundary\r\n";
    }
    $header .= "Content-length: " . strlen($data) . "\r\n\r\n";

    $fp = fsockopen($host, 80);

    if ($fp) {
        fputs($fp, $header.$data);
        $rsp = '';
        while(!feof($fp)) {
            $rsp .= fgets($fp,8192);
        }
        fclose($fp);
        $msg = explode("\r\n\r\n",trim($rsp));
        $rMsg = explode(",", $msg[1]);
        $Result= $rMsg[0]; //발송결과
        $Count= $rMsg[1]; //잔여건수

        //발송결과 알림
        if($Result=="success"){ 
            $alert =  $_SESSION['certif_code'];
			$param["tel"]=$param["sphone1"].$param["sphone2"].$param["sphone3"];
			if(strlen($param["birth_month"])==1){
				$param["birth_month"]="0".$param["birth_month"];
			}
			if(strlen($param["birth_date"])==1){
				$param["birth_date"]="0".$param["birth_date"];
			}
			$param["birth"]=$param["birth_year"].$param["birth_month"].$param["birth_date"];
	
		
		
			//아이라이크클릭 실적 저장 끝
        }
        else if($Result=="reserved") {
			
            $alert = "성공적으로 예약되었습니다.";
            $alert .= " 잔여건수는 ".$Count."건 입니다.";
        }
        else if($Result=="3205") {
            $alert = "잘못된 번호형식입니다.";
        }

		else if($Result=="0044") {
            $alert = "스팸문자는발송되지 않습니다.";
        }

        else {
			echo iconv('euc-kr','utf-8',$Result);
			exit;
            $alert = "정보를 모두 입력해주세요.";
        }
    }
    else {
        $alert = "Connection Failed";
    }

    if($nointeractive=="1" && ($Result!="success" && $Result!="Test Success!" && $Result!="reserved") ) {



	
    }
    else if($nointeractive!="1") {
		
    }
}
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


