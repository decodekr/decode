<?php

    /*function welcomeEncrypt($text) {

        $enckey = "1608588035fd66dfa63c67d5d60e4b61c158ed67700e86fd0fa289f15027aa34";
        $iv = "e9db13fafb673166254f91e86eecd4cb";

        list($usec, $sec) = explode(" ", microtime());

        $millis = round(((float)$usec + (float)$sec) * 1000);

        $enctext = bin2hex(openssl_encrypt($text, 'AES-256-CBC', hex2bin($enckey), OPENSSL_RAW_DATA, hex2bin($iv)));

    }*/


    function hextobin($hexstr)
    {
        $n = strlen($hexstr);
        $sbin="";
        $i=0;
        while($i<$n)
        {
            $a =substr($hexstr,$i,2);
            $c = pack("H*",$a);
            if ($i==0){$sbin=$c;}
            else {$sbin.=$c;}
            $i+=2;
        }
        return $sbin;
    }


    function welcomeENCRYPT($text) {

        $enckey = "d57c8d99de8db2361f4d32e98a50a63649f4631db5995a68ca85f0b86ea697aa";
        $iv = "570018c89785f2c3895823f217f06118";

        $enctext = bin2hex(openssl_encrypt($text, 'AES-256-CBC', hextobin($enckey), 1, hextobin($iv)));

        return $enctext;

    }


	function welcomeCURL($url,$data='',$method){
		$welcomeHeader = array(
			'Content-Type:application/json',
			'WP_KEY:179',
			'WP_HASH:t9EgC1dxcltHyIyrITqKLqsOqygSbWlS',
			'ENCRYPT:TRUE'
		);
		$headers=$welcomeHeader;
		 $ch = curl_init(); //curl 사용 전 초기화 필수(curl handle)
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_URL, $url); //URL 지정하기
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, 64, false);
//		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


        $data = welcomeENCRYPT($data);

		if($method=='post'){
			curl_setopt($ch, CURLOPT_POST, 1); //0이 default 값이며 POST 통신을 위해 1로 설정해야 함
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $data); //POST로 보낼 데이터 지정하기
		}

		// put 분기
		if ($method == "put") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        }

		// put 분기
		if ($method == "delete") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        }

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);//헤더 정보를 보내도록 함(*필수)
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data); //header 지정하기
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); //이 옵션이 0으로 지정되면 curl_exec의 결과값을 브라우저에 바로 보여줌. 이 값을 1로 하면 결과값을 return하게 되어 변수에 저장 가능(테스트 시 기본값은 1인듯?)
		  $result = curl_exec($ch);
		  curl_close($ch);
		  return $result;
	}
//	echo addUser('박철균','tesuescapes@naver.com','01071777777');
	//echo addUser('박철균','tesuedscape@naver.com','01048858988');
	//echo checkAccount('1002147262084','박철균','20');
	//echo addUser('손태수','tesuescape@naver.com','01011854885'); 유저등록
	//echo addBalance('f155ab00587337b7a3748e81841df3b0b4b6e0a09702c0cb5cdec5036ca663d2"'); 계좌생성

//echo	createWithdrawAccount('97c8a70b2c2a4453871f2e2e2865a866','3333037010481','박철균','90');


	/**
	 * 은행 목록 조회
	 */

	function getBankList(){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/common/withdrawaccount/banks';
		$url='https://openapi.welcomefin.com/wp/api/common/withdrawaccount/banks';
		return welcomeCURL($url,'','get');
	}


	/**
	 * 계좌주 인증
	 */

	function checkAccount($account,$owner,$bank_code){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/inquiry/selectinquiry/account/name';
		$url='https://openapi.welcomefin.com/wp/api/inquiry/selectinquiry/account/name';
		  $data= array('memAccntno'=>$account,'bankOwnerName'=>$owner,'bankId'=>$bank_code);
		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}



	/**
	 * 유저 등록
	 */
	function addUser($name,$email,$phone){
		
		 //$url='https://stgftapi.welcomepayments.co.kr/wp/api/user';
		 $url='https://openapi.welcomefin.com/wp/api/user';
		  $data= array('memName'=>$name,'memType'=>'USER','memEmail'=>$email,'mobileNo'=>$phone,'smsYn'=>'Y');
		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}



	/**
	 * 지갑 추가(판매자 전용, 프로스세스 일원화하게되면 미사용 예정)
	 */
	function addBalance($guid){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/balance/create/'.$guid;
		$url='https://openapi.welcomefin.com/wp/api/user/balance/create/'.$guid;
		  //$data= array('memName'=>$name,'memType'=>'USER','memEmail'=>$email,'mobileNo'=>$phone,'smsYn'=>'Y');
		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	
	/**
	 * 출금계좌 만들기
	 */
	function createWithdrawAccount($guid,$account,$owner,$bank_code){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/withdrawaccount/'.$guid;
		$url='https://openapi.welcomefin.com/wp/api/user/withdrawaccount/'.$guid;
		$data='{
			"bankId": '.$bank_code.',
			"memAccntno":"'.$account.'",
			"bankOwnerName":"'.$owner.'"
		}';
		 
		return welcomeCURL($url,$data,'post');
	}

	

	/**
	 * 출금계좌 본인인증
	 */

	function certifyWithdrawAccount($guid,$tid,$certifCode){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/withdrawaccount/verify/'.$guid;
		$url='https://openapi.welcomefin.com/wp/api/user/withdrawaccount/verify/'.$guid;
		  $data= array('tid'=>$tid,'verifyWord'=>$certifCode,'verifyKind'=>'WAC');
	
		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	
	/**
	 * 가상계좌 발급
	 */

	function getVirtualAccount($guid,$name){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/virtualaccount/none/create/'.$guid;
		$url='https://openapi.welcomefin.com/wp/api/user/virtualaccount/none/create/'.$guid;
		  $data= array('vaccntOwnerName'=>$name,'bankId'=>'50');
		
		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}


		
	/**
	 * 유저 지갑 => 머천트 지갑 전환(구매자 -> MOM)
	 */

	function giveToShop($guid,$amount){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/transfer/'.$guid;
		$url='https://openapi.welcomefin.com/wp/api/user/transfer/'.$guid;
		  $data= array('orgAmt'=>$amount,'orgCrrncy'=>'KRW','remark'=>'상품 구매 신청');

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	// echo giveToShop('9ef5466c966549019a458b22583bf998', 1);



	/**
	 * 유저지갑 =>머천트 지갑 전환 인증(구매자 인증)
	 */
	function certifyGiveToShop($tid,$certifCode){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/transfer/sms/verify';
		$url='https://openapi.welcomefin.com/wp/api/user/transfer/sms/verify';
		  $data= array('tid'=>$tid,'verifyWord'=>$certifCode);

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	// echo certifyGiveToShop(76335,'4332');


	/**
	 * 머천트 -> 판매자 송금 단건 요청(수수료 제외한 금액 판매자에게 송금 요청)
	 */

	// 현재 별다른 인증없이 송금되는 상태
	function giveToSeller($guid,$amount){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/merchant/transfer';
		$url='https://openapi.welcomefin.com/wp/api/merchant/transfer';
		  $data= array('guid'=>$guid,'orgAmt'=>$amount,'orgCrrncy'=>'KRW');

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	// echo giveToSeller('9ef5466c966549019a458b22583bf998', 1);



	/**
	 * 머천트 -> 판매자 송금 요청 인증(수수료 제외한 금액 판매자에게 송금 요청 인증)
	 */

	 // 테스트 서버여서 그런지 인증확인 안해도 현재 송금되는 상태임

    // 운영서버도 현재 인증없이 송금가능

	function certifyGiveToSeller($tid, $verifyWord, $verifyNo){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/merchant/list/transfers/sms/verify';
		$url='https://openapi.welcomefin.com/wp/api/merchant/list/transfers/sms/verify';
		  $data= array('tid'=>$tid,'verifyKind'=>'SMS','verifyWord'=>$verifyWord, 'verifyNo'=>$verifyNo);

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}



	/**
	 * 판매자 출금(지갑에서 실제 현금으로 출금)
	 */

	function sellerWithdraw($guid,$amount){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/withdraw/'.$guid;
		$url='https://openapi.welcomefin.com/wp/api/user/withdraw/'.$guid;
		  $data= array('orgAmt'=>$amount,'orgCrrncy'=>'KRW');

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	 //echo sellerWithdraw('9ef5466c966549019a458b22583bf998', 1);
	

	/**
	 * 판매자 출금 인증(지갑에서 실제 현금으로 출금 인증)
	 */
	function certifySellerWithdraw($tid,$certifCode){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/withdraw/sms/verify';
		$url='https://openapi.welcomefin.com/wp/api/user/withdraw/sms/verify';
		$data= array('tid'=>$tid,'verifyWord'=>$certifCode);

		$data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	// echo certifySellerWithdraw(76339, '0977');




	/**
	 * 머천트 출금(MOM 수익 -> 실제 현금으로 출금)
	 */

	function merchantWithdraw($amount){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/merchant/withdraw/1f732aee3e6a4c5484d99a3f756325da';
		$url='https://openapi.welcomefin.com/wp/api/merchant/withdraw/425cb462504444f7b67a67516a66324d';
		$data= array('orgAmt'=>$amount,'orgCrrncy'=>'KRW');

		$data=jsonEncode($data);

		return welcomeCURL($url,$data,'post');
	}

	// echo merchantWithdraw(1);



	/**
	 * 머천트 출금 인증(MOM 수익 -> 실제 현금으로 출금 인증)
	 */
	function certifyMerchantWithdraw($tid,$certifCode){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/merchant/withdraw/sms/verify';
		$url='https://openapi.welcomefin.com/wp/api/merchant/withdraw/sms/verify';
		$data= array('tid'=>$tid,'verifyWord'=>$certifCode);

		$data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}


	/**
	 * 머천트 출금 인증 재전송(인증 번호 못받았을 시, MOM 수익 -> 실제 현금으로 출금 인증 재전송)
	 */
	function resendCertifyMerchantWithdraw($tid){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/merchant/withdraw/sms/resend';
		$url='https://openapi.welcomefin.com/wp/api/merchant/withdraw/sms/resend';
		$data= array('tid'=>$tid);

		$data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}




	/**
	 * 머천트 잔액조회
	 */
	function getMerchantBalance(){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/merchant/balance/1f732aee3e6a4c5484d99a3f756325da';
		$url='https://openapi.welcomefin.com/wp/api/merchant/balance/425cb462504444f7b67a67516a66324d';
		$data= array('crrncyType'=>'KRW');

		$data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	// echo checkBalanceMerchant();


	/**
	 * 멤버 입출금 내역 조회(페이징 적용)
	 */

	function getMemberBalanceInOut($guid, $page, $size, $startDate, $endDate){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/v2/member/balance/inout/'.$guid.'?page='.$page.'&size='.$size.'&crrncyType=KRW&startDate='.$startDate.'&endDate='.$endDate;
//		$url='https://openapi.welcomefin.com/wp/api/v2/member/balance/inout/'.$guid.'?page='.$page.'&size='.$size.'&crrncyType=KRW&startDate='.$startDate.'&endDate='.$endDate;
		$url="https://openapi.welcomefin.com/wp/api/v2/member/balance/inout/$guid?page=$page&size=$size&crrncyType=KRW&startDate=$startDate&endDate=$endDate";
		return welcomeCURL($url,'','get');
	}

	// echo getBalanceInOutMembers('9ef5466c966549019a458b22583bf998', 1, 20, 20200530, 20200531);


	/**
	 * 머천트 입출금 내역 조회(페이징 적용)
	 */

	function getMerchantBalanceInOut($page, $size, $startDate, $endDate){
		//$url='https://stgftapi.welcomepayments.co.kr/wp/api/v2/merchant/balance/inout/?page='.$page.'&size='.$size.'&crrncyType=KRW&startDate='.$startDate.'&endDate='.$endDate;
		$url="https://openapi.welcomefin.com/wp/api/v2/merchant/balance/inout/?page=$page&size=$size&crrncyType=KRW&startDate=$startDate&endDate=$endDate";
		return welcomeCURL($url,'','get');
	}

	// echo getMerchantBalanceInOut(1, 20, 20200530, 20200531);



    /**
     * 머천트에 가입되어 있는 유저 전체 조회(페이징 적용)
     */

    function getUserList($page, $size){
        //$url='https://stgftapi.welcomepayments.co.kr/wp/api/v2/user?page='.$page.'&size='.$size;
        $url='https://openapi.welcomefin.com/wp/api/v2/user?page='.$page.'&size='.$size;
        return welcomeCURL($url,'','get');
    }

    // echo getUserList(1, 20);



    /**
     * 유저 이름 / 이메일 수정
     */
    function updateUserNameEmail($guid, $name, $email){
        //$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/'.$guid;
        $url='https://openapi.welcomefin.com/wp/api/user/'.$guid;
        $data= array('memName'=>$name, 'memEmail'=>$email);

        $data=jsonEncode($data);
        return welcomeCURL($url,$data,'put');
    }

    // echo updateUserNameEmail('9ef5466c966549019a458b22583bf998', '박기성', 'chris.park@decodelab.co.kr');


    /**
     * 출금계좌 번호 변경
     */

    // 유저당 하루에 3번만 가능

    function updateWithdrawAccount($guid, $bankId, $memAccntno, $bankOwnerName){
        //$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/withdrawaccount/'.$guid;
        $url='https://openapi.welcomefin.com/wp/api/user/withdrawaccount/'.$guid;
        $data= array('bankId'=>$bankId,'memAccntno'=>$memAccntno, 'bankOwnerName'=>$bankOwnerName);

        $data=jsonEncode($data);
        return welcomeCURL($url,$data,'put');
    }

    // echo updateWithdrawAccount('9ef5466c966549019a458b22583bf998', 20, '1002338278658', '박기성');



    /**
     *  생성된 가상계좌 번호 조회
     */

    function getVirtualAccountNumber($guid){
        //$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/virtualaccount/'.$guid;
        $url='https://openapi.welcomefin.com/wp/api/user/virtualaccount/'.$guid;
        return welcomeCURL($url,'','get');
    }

    // echo getVirtualAccountNumber('9ef5466c966549019a458b22583bf998');

    /**
     *  유저 탈퇴
     */

    function deleteUser($guid){
        //$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/virtualaccount/'.$guid;
        $url='https://openapi.welcomefin.com/wp/api/user/'.$guid;
        return welcomeCURL($url,'','delete');
    }

    // echo getVirtualAccountNumber('9ef5466c966549019a458b22583bf998');


function getBusinessStatus($txprDscmNo){

    $url = 'https://teht.hometax.go.kr/wqAction.do?actionId=ATTABZAA001R08&screenId=UTEABAAA13&popupYn=true&realScreenId=';

    $data = "<map id=\"ATTABZAA001R08\">
        <pubcUserNo/>
        <mobYn>N</mobYn>
        <inqrTrgtClCd>1</inqrTrgtClCd>
        <txprDscmNo>$txprDscmNo</txprDscmNo>
        <dongCode>15</dongCode>
        <psbSearch>Y</psbSearch>
        <map id=\"userReqInfoVO\"/>
    </map>";


    //$post_field_string = http_build_query($data, '', '&');

    $headers = array(
        'Content-Type:application/xml; charset=UTF-8'
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, false);

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
}


/**
 * 머천트 PUSH URL 조회
 */

function getMerchantPushUrl(){

    $url='https://openapi.welcomefin.com/wp/api/merchant/push/url';

    return welcomeCURL($url,'','get');
}

/**
 * 머천트 PUSH URL 등록
 */
function registerMerchantPushUrl(){

    $url='https://openapi.welcomefin.com/wp/api/merchant/push/url';

    $data= array('pushUrl'=>'https://marketofmaterial.com/json/payment_noti');

    $data=jsonEncode($data);
    return welcomeCURL($url,$data,'post');
}

/**
 * 머천트 PUSH URL 변경
 */
function updateMerchantPushUrl(){

    $url='https://openapi.welcomefin.com/wp/api/merchant/push/url';

    $data= array('pushUrl'=>'https://marketofmaterial.com/json/payment_noti');

    $data=jsonEncode($data);
    return welcomeCURL($url,$data,'put');
}







	

