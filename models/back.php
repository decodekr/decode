	/////////////////하단은 
	/*
	머천트 => 판매자
	
	*/
	function giveToSeller($tid,$certifCode){
		$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/transfer/sms/verify';
		  $data= array('tid'=>$tid,'verifyWord'=>$certifCode);

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}

	function getUserBalance(){
	}

	/*
	유저지갑 =>머천트 지갑 전환 인증
	
	*/
	function certifyGiveToShop($tid,$certifCode){
		$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/transfer/sms/verify';
		  $data= array('tid'=>$tid,'verifyWord'=>$certifCode);

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}
	
	

		/*
	머천트 =>판매자 지갑 지갑 전환 인증
	
	*/
	function certifyGiveToShop($tid,$certifCode){
		$url='https://stgftapi.welcomepayments.co.kr/wp/api/user/transfer';
		  $data= array('tid'=>$tid,'verifyWord'=>$certifCode);

		  $data=jsonEncode($data);
		return welcomeCURL($url,$data,'post');
	}
	