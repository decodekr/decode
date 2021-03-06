<?php
include 'views/header.html';
	$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier');
	$carts = getListJoin('estimate_cart_products',array('LEFT','product_lists','estimate_cart_products.product_no=product_lists.no'),'estimate_cart_products.*,product_lists.details,product_lists.price,product_lists.grade','estimate_cart_products.status=0 AND estimate_cart_products.user_no='.$session['login'].' AND estimate_cart_products.product_no in ('.$param['product_no'].')');

$user=getItem('users',$_SESSION['login']);
if($param['order']==1){

		
	$sellers=getListQuery('SELECT estimate_cart_products.*,product_lists.user_no AS product_user_no,users.id,users.phone FROM `estimate_cart_products` 
Left join product_lists ON product_lists.no=estimate_cart_products.product_no
Left join users ON users.no = product_lists.user_no
Where estimate_cart_products.user_no='.$session['login'].'
 GROUP BY product_user_no');
 print_x($sellers);
$order['no']='20200731476949';
foreach($sellers['list'] as $seller){
	$alarmContents='등록하신 매물이 서울의 구매자님과 거래 예정입니다. 대금 지급 예정일은 '.dateFormat($param['pay_date'],'m월d일').' 입니다. 매물의 판매 가능 여부를 확인 부탁 드립니다. 해당 자재의 판매가 가능하면 "예", 판매가 불가능 하시면 "아니오"를 클릭해 주세요';
    alarm($seller['product_user_no'],$alarmContents,'sell_receive');
    $code=generateCode(6,'shorthand:number');
	$subject = "[MOM]판매가 시작되었습니다.";
	$contents='<p style="margin:20px 0 0;padding:30px 30px 50px;min-height:200px;height:auto !important;height:200px;border-bottom:1px solid #eee">
					<b>'.$alarmContents.'
			   <br>
			   <br>
			   <br>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://marketofmaterial.com/seller/status?no='.$order['no'].'&user_no='.$seller['product_user_no'].'&result=2">[예]</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://marketofmaterial.com/seller/status?no='.$order['no'].'&user_no='.$seller['product_user_no'].'&result=20" style="color:red;">[아니오]</a>
			  </b>
	';
	sendSMS($seller['phone'],'등록하신 매물이 거래 예정입니다.(주문번호'.$order['order_id'].') 대금 지급 예정일은 '.dateFormat($param['pay_date'],'m월d일').' 입니다. 매물의 판매 가능 여부를 확인 부탁 드립니다. 자세한 내용은 MOM 홈페이지에서 확인 가능합니다. (www.marketofmaterial.com)','L');
	sendmail2($subject,$contents,$seller['id']);

}
 
	$orderParam['user_no']=$session['login'];
	$orderParam['wish_date']=$param['wish_date'];
	$orderParam['pay_date']=$param['pay_date'];
	$orderParam['total_price']=0;
	$orderParam['status']=1;

	foreach($carts['list'] as $cart){

		if($cart['grade']=='A'){
							if($cart['price']*$cart['amount']>=100000000){
								$fee=$cart['price']*$cart['amount']*0.0774;
							}
							else if($cart['price']*$cart['amount']>=50000000){
								$fee=$cart['price']*$cart['amount']*0.0815;
							}
							else if($cart['price']*$cart['amount']>=10000000){
								$fee=$cart['price']*$cart['amount']*0.0857;
							}
							else if($cart['price']*$cart['amount']>=5000000){
								$fee=$cart['price']*$cart['amount']*0.0903;
							}
							else if($cart['price']*$cart['amount']>=1000000){
								$fee=$cart['price']*$cart['amount']*0.0950;
							}
							else{
									$fee+=$cart['price']*$cart['amount']*0.1;
							}
						}
						if($cart['grade']=='B'){
							
							if($cart['price']*$cart['amount']>100000000){
								$fee=$cart['price']*$cart['amount']*0.1161;
							}
							else if($cart['price']*$cart['amount']>=50000000){
								$fee=$cart['price']*$cart['amount']*0.1222;
							}
							else if($cart['price']*$cart['amount']>=10000000){
								$fee=$cart['price']*$cart['amount']*0.1286;
							}
							else if($cart['price']*$cart['amount']>=5000000){
								$fee=$cart['price']*$cart['amount']*0.1354;
							}
							else if($cart['price']*$cart['amount']>=1000000){
								$fee=$cart['price']*$cart['amount']*0.1425;
							}
							else{
									$fee=$cart['price']*$cart['amount']*0.15;
							}
						}
						if($cart['grade']=='C'){
							if($cart['price']*$cart['amount']>=100000000){
								$fee=$cart['price']*$cart['amount']*0.1548;
							}
							else if($cart['price']*$cart['amount']>=50000000){
								$fee=$cart['price']*$cart['amount']*0.1629;
							}
							else if($cart['price']*$cart['amount']>=10000000){
								$fee=$cart['price']*$cart['amount']*0.1715;
							}
							else if($cart['price']*$cart['amount']>=5000000){
								$fee=$cart['price']*$cart['amount']*0.1805;
							}
							else if($cart['price']*$cart['amount']>=1000000){
								$fee=$cart['price']*$cart['amount']*0.19;
							}
							else{
									$fee=$cart['price']*$cart['amount']*0.2;
							}
						}


		$orderParam['total_price']+=($cart['price']*$cart['amount'] + $fee);
		
		//재고 빼기
		$stockParam['amount'] = -1;
		calcItem('product_lists',$stockParam,$cart['product_no']);

		//CART STUTUS 변경하기

		$cartParam['status'] = 1;
		updateItem('product_lists',$cartParam,$cart['no']);

	}

	$discountRate = 0;
	if($orderParam['total_price']  > 99999999){
	$discountRate = 0.045;
	}
	else if($orderParam['total_price']  > 79999999){
		$discountRate = 0.040;
	}
	else if($orderParam['total_price']  > 59999999){
		$discountRate = 0.035;
	}
	else if($orderParam['total_price']  > 29999999){
		$discountRate = 0.030;
	}
	else if($orderParam['total_price']  > 9999999){
		$discountRate = 0.025;
	}
	else if($orderParam['total_price']  > 7999999){
		$discountRate = 0.020;
	}
	else if($orderParam['total_price']  > 5999999){
		$discountRate = 0.015;
	}
	else if($orderParam['total_price']  > 2999999){
		$discountRate = 0.01;
	}
	else if($orderParam['total_price']  > 1000000){
		$discountRate = 0.005;
	}

	$orderParam['total_price'] = $orderParam['total_price'] * (1-$discountRate);

	

	


	$cartParam['order_no']=insertItem('estimate_orders',$orderParam);
	
	updateItem('estimate_cart_products',$cartParam,'user_no='.$session['login'].' AND status=0');



	
	$order=getItem('estimate_orders',$cartParam['order_no']);

	alarm(0,'"새로운 거래 주문번호('.str_replace(array(' ','-',':'),'',$order['create_date']).$order['no'].')가 시작되었습니다."');


	//sendSMS('01062420349','주문이 완료되었습니다');
	printMessage('주문이 완료되었습니다. '.$param['pay_date'].'까지 대금을 '.$session['name'].'님의 가상계좌에 입금하시면 거래가 진행됩니다.\n'.$param['pay_date'].'까지 가상계좌 입금이 진행되지 않으면, 요청하신 현재 거래는 취소됩니다,','/user/order');
exit;
}
?>
<?php
	if(!$session['login']){
?>
	<script>
		
			Swal.fire({
			  title: '',
			  text: '로그인 후 이용해주세요.',
			  icon: 'error',
	
				  onAfterClose:function(){
	location.href='/user/login'
			  },
			  confirmButtonText: '확인'
			});
		
		

	</script>
	<?php
}	
?>

<?php
	if($param['test']==''){
?>
	<style>
		.form_row.card{
	display: none;
}

	</style>
<div id="contentsWrap" class="wrap" tabindex="0" style="display:none;">
	
		
		<div id="all_layout_masking_div" aria-hidden="true" style="opacity: 0.5; position: absolute; background-color: rgb(255, 255, 255); z-index: 200; top: 0px; left: 0px; width: 760px; height: 570px; display: none;"></div>
		
		
		





	<div class="header header_color">
		<span aria-hidden="true">웰컴페이먼츠 결제 페이지</span>   
			<div class="help">
			
				
								
					<a href="javascript:;" id="header_lang">
					
					</a>
							
				
				
				
					<span class="sp ir dot" id="header_dot_flag"></span> 
					<a href="javascript:;" id="webAcessInfo" aria-label="스크린리더 사용고객은 반드시 읽어주세요. 새창">웹접근성안내</a>
				
				
				
				
<!-- 				<span class="sp ir dot"></span> -->

			</div>
	</div>

	<div id="kcp_spay_logo" class="logo">
	
		
			
			
				<span id="spay_logo_t" class="logo_t">&nbsp;</span>
			
		

		
		
			
			
			
			<div class="location" id="layout_header_loc">
				
					
						
					
								
			</div>
					
		
		
		
	</div>

		
	    
		






	
	
	
	<div id="directNOS" style="display: none;">
		<div class="skip"><a id="nosInstPopup" href="javascript:;" aria-label="고객님의 안전한 거래를 위하여 보안프로그램의 설치가 필요합니다. Enter키를 누르면 설치페이지로 이동됩니다. 새창"> 보안프로그램 설치 바로가기</a></div>
	</div>	
	
	
	<div id="spin_container" class="spin_container"></div>

	
	<form id="frmObj" name="frmObj" method="POST" data-nppfs-form-id="d42ef95293f7fe36e"><div class="nppfs-elements" style="display:none;"><input type="hidden" name="__E2E_KEYPAD__" value="0ae98fd928fad1b37a8b7ba7d65a6aab445fea1a8338fe9bfce8b9d3f938faab6d272eb86e2fe97c727311ecbee8bb3ab252f7087416bf6d6b6583605c93d08432065e64493091594886f67ec03066a056977429933d34c952dba4a0e0d50ce5fa6ea802b100def7a4e5f109c4348ec7abfb12647d832f295da31b37b1f531612b10a9dc807dd4e182577b3e4f88fbe2af5e15fbc949a8e503e142aa37e457cfb79e22e57972183b929339ca02f20a0a1c40b057811e03898da22a2f924d7864271aaf93f57dff673c00a22eeae40d46ef6493d80d8f26c70a064c1c75b5bf94965dc74dba82e29f9adbe00ad288e439596f432901a3a8906c3063f510882f6d">
<input type="hidden" name="__E2E_UNIQUE__" value="158767557188872"><input type="hidden" name="__KH_9f904c58d009" value=""><input type="hidden" name="__KI_card_num3" value="be73aa7c14394fbb763edd39b88154076d940bfc2f0df4619a4ff0b6a04f10c244131213b3729d2c1baf837c840004be12a25ebe417e605eaab407c616168c8b968813724df9ccb8bbbe5541b5417f0a08625c73253600958977e16472d5f055"><input type="hidden" name="__KU_9f904c58d009" value="Y" class="nppfs-dynamic-field"><input type="hidden" name="__KH_c84a5c7a97db" value=""><input type="hidden" name="__KI_card_num4" value="7aeb7ce675f0f1fb398e050e7e8c165602a817a156c922458ddff7c3e8deb8a27219367f90282335390779b550955b668b405ffbeee40d9a4aae2ba433c4c51e8ac815cbd3802116036082e6d27ea9f15754d5781cb8fb24b9bf079f7714a9c6"><input type="hidden" name="__KU_c84a5c7a97db" value="Y" class="nppfs-dynamic-field"></div>    
	
		
		
		

		<!--contents-->
		<div class="content">
		
			<div class="price" tabindex="0" aria-label="상품명 및 상품금액을 자세히 확인하시려면 아래 방향키로 확인하세요.">
				<span title="결제내역은다음과같습니다"></span>
				<div class="p_w1">
					
					<span class="form_row p_row">
						<span class="col_tit">상품명</span><span class="col_cont t_over" id="pname"></span>
					</span>
					
					<span class="form_row p_row">
						<span class="col_tit">제공기간</span><span class="col_cont">[ 별도 제공기간 없음 ]</span>
					</span>
				</div>
				<div class="p_w2">
					
					<span class="form_row p_row">
						<span class="col_tit">상품금액</span>
						<span class="con_price" id="pprice">
						
	           				
	           					
	           						69,000원
	           					
	           					
	           					
	           										
						</span>
					</span>
					
			
			
				
				
				
					
				
			
				
				</div>
				
				
				
				
								
				<div class="last_price">
					최종결제금액
					<br>
					<span class="txt_price" id="pay_price">
					
						
							
								<em>69,000</em>원
							
							
		        			
		        		
					</span>
				</div>
			</div>

			<div class="con">
			
				
				<div class="agree_new form_row">
					<h1 id="con" class="tit">약관 및 이용동의</h1>  
					<div class="view_agree"><a href="javascript:;" id="cardAgree" title="이용약관 전체보기 새창">보기<span class="sp ic_view"></span></a></div>
					
					<div class="agree_chk_bg">
						<div class="chk_box chk_agree_all">
							<input type="checkbox" id="chk_all" name="chk_all" aria-label="체크하면 한 번에 동의가 됩니다">
							<label for="chk_all"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>전체동의</label>
						</div>
						
						<div class="chk_box chk_agree">
							<input type="checkbox" id="chk_agree1" name="chk_agree1">
							<label for="chk_agree1"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>전자금융거래 이용약관</label>
						</div>
						<div class="chk_box chk_agree">
							<input type="checkbox" id="chk_agree2" name="chk_agree2">
							<label for="chk_agree2"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>개인정보 수집 및 이용동의</label>
						</div>
					</div>
				</div>
<style>
.content{
    padding: 0 25px;
    width: 759px !important;
    height: 434px;
    position: relative;

						overflow-y:auto;
						overflow-x:hidden;
						}
	#agree_text
								{
								overflow-y: scroll;
								width: 100%;
								height: 200px;
								display: none;
								margin-top: 20px;
								
    position: absolute;
    top: 22px;
    left: 0;
    border: 2px solid #ddd;
    z-index: 54000;
    background: #fff;
								}

</style>
<script>
	$('#cardAgree').click(function(){
	if($('#agree_text').is(':visible')){
			$('#agree_text').slideUp();
			$(this).text('보기')
	}
	else{
			$('#agree_text').slideDown();
			$(this).text('닫기')
	}
	return false;
});


</script>
				<div id="agree_text">

				<h3>
					전자금융거래 이용약관

				</h3>
<br>					제1장   통 칙
<br>제１조   (목적)
<br>	
<br>본 약관은 마켓오브메테리얼 주식회사(이하 ‘회사’라고 합니다)가 제공하는 전자지급결제대행서비스, 결제대금예치서비스 및 선불전자지급수단(이하 ‘마켓오브메테리얼캐시’라고 합니다)의 발행 및 관리서비스(이하 통칭하여 ‘전자금융거래서비스’라고 합니다)를 이용자에게 제공함에 있어, 회사와 이용자간의 권리ㆍ의무 관계를 정함을 목적으로 합니다.
<br> 
<br>제２조   (정의)
<br>①   본 약관에서 사용하는 용어의 정의는 다음 각 호와 같습니다.
<br>1.   “전자금융거래”라 함은 회사가 전자적 장치를 통하여 전자금융서비스를 제공(이하 ‘전자금융업무’라고 합니다)하고, 이용자가 회사의 종사자와 직접 대면하거나 의사 소통을 하지 아니하고, 자동화된 방식으로 이를 이용하는 거래를 말합니다.
<br>2.   “전자지급거래”라 함은 자금을 주는 자(이하 ‘지급인’이라고 합니다)가 회사로 하여금 전자지급수단을 이용하여 자금을 받는 자(이하 ‘수취인’이라고 합니다)에게 자금을 이동하게 하는 전자금융거래를 말합니다.
<br>3.   “전자지급결제대행서비스”라 함은 전자적 방법으로 재화 등의 구매에 있어서 지급결제정보를 송신하거나 수신하는 것 또는 그 대가의 정산을 대행하거나 매개하는 서비스를 말합니다.
<br>4.   “전자지급수단”이라 함은 전자자금이체, 직불전자지급수단, 선불전자지급수단, 전자화폐,신용카드, 전자채권 그 밖에 전자적 방법에 따른 지급수단을 말합니다.
<br>5.   “전자적 장치”라 함은 전자금융거래정보를 전자적 방법으로 전송하거나 처리하는데 이용되는 장치로서 현금자동지급기, 자동입출금기, 지급용 단말기, 컴퓨터, 전화기, 그 밖에 전자적 방법으로 정보를 전송하거나 처리하는 장치를 말합니다.
<br>6.   “전자문서"라 함은 「전자문서 및 전자거래 기본법」 제2조제1호에 따른 작성, 송신ㆍ수신 또는 저장된 정보를 말합니다.
<br>7.   “접근매체”라 함은 전자금융거래에 있어서 이용자가 거래지시를 하거나 또는 이용자 및 거래내용의 진실성과 정확성을 확보하기 위하여 사용되는 다음 각 목의 어느 하나에 해당하는 수단 또는 정보를 말합니다.
<br>가.   전자식 카드 및 이에 준하는 전자적 정보(신용카드번호를 포함)
<br>나.   「전자서명법」 제2조제4호에 따른 전자서명생성정보 및 같은 조 제7호에 따른 인증서
<br>다.   회사에 등록된 이용자번호
<br>라.   이용자의 생체정보
<br>마.   가목 또는 나목의 수단이나 정보를 사용하는 데 필요한 비밀번호
<br>8.   “이용자”라 함은 본 약관에 동의하고, 본 약관에 따라 회사의 전자금융거래서비스를 이용하는 회원을 말합니다.
<br>9.   “이용자번호”라 함은 이용자의 동일성 식별과 서비스 이용을 위하여, 이용자가 설정하고 회사가 승인한 숫자와 문자의 조합을 말합니다.
<br>10.   “비밀번호”라 함은 이용자의 동일성 식별과 회원정보의 보호를 위하여, 이용자가 설정하고 회사가 승인한 숫자와 문자의 조합을 말합니다.
<br>11.   “거래지시”라 함은 이용자가 전자금융거래계약에 따라 금융기관 또는 전자금융업자에게 전자금융거래의 처리를 지시하는 것을 말합니다.
<br>12.  “오류”라 함은 이용자의 고의 또는 과실 없이 전자금융거래가 전자금융거래계약 또는 이용자의 거래지시에 따라 이행되지 아니한 경우를 말합니다.
<br>②   본 약관에서 별도로 정하지 아니한 용어의 정의는 「전자금융거래법」 등 관련 법령에서 정하는 바에 따릅니다.
<br> 
<br>제３조   (약관의 명시 및 변경)
<br>①  회사는 이용자가 전자금융거래를 하기 전에 본 약관을 회사가 운영ㆍ제공하는 “인터넷사이트(www.marketofmaterial.com)” 및 “마켓오브메테리얼 모바일 애플리케이션” 등(이하 통칭하여 ‘인터넷사이트 등’이라고 합니다)에 게시하고, 이용자가 본 약관이 중요한 내용을 확인할 수 있도록 합니다.
<br>②   회사는 이용자가 요청하면 전자문서를 전송(전자우편을 이용한 전송을 포함합니다)하는 방식으로 본 약관의 사본을 이용자에게 교부합니다.
<br>③   회사는 본 약관을 변경하는 때에는 그 시행일 1월 전에 변경되는 약관을 인터넷사이트 등에 게시하고 이용자에게 통지합니다. 다만, 법령의 개정으로 인하여 긴급하게 약관을 변경한 때에는 그 변경된 약관을 인터넷사이트 등에 1개월 이상 게시하고 이용자에게 전자우편 등을 통하여 사후 통지합니다.
<br>④   회사는 제3항에 따른 고지 및 통지를 할 경우에는 “이용자가 변경에 동의하지 아니한 경우 고지나 통지를 받은 날로부터 30일 이내에 계약을 해지할 수 있으며, 계약해지의 의사표시를 하지 아니한 경우에는 변경된 약관에 동의한 것으로 본다.”라는 취지의 내용을 함께 고지 및 통지합니다.
<br>⑤   이용자가 제4항에 따른 고지나 통지를 받은 날로부터 30일 이내에 계약해지의 의사표시를 하지 아니한 경우에는 변경된 약관에 동의한 것으로 봅니다.
<br> 
<br>제４조   (전자금융거래서비스의 구성 및 내용)
<br>①   전자금융거래서비스는 다음 각 호의 서비스로 구성되며, 필요한 경우에는 본 약관의 각 장에서 해당 서비스에 대한 자세한 내용을 게시합니다.
<br>1.   전자지급결제대행서비스
<br>2.   결제대금예치서비스
<br>3.   선불전자지급수단의 발행 및 관리 서비스
<br>②   회사는 전자금융거래서비스를 추가하거나 변경하고자 하는 경우에는 이용자에게 그 내용을 사전 고지하고 해당 전자금융거래서비스를 추가하거나 변경할 수 있습니다.
<br> 
<br>제５조   (이용시간)
<br>①         회사는 이용자에게 연중무휴 1일 24시간 전자금융거래 서비스를 제공함을 원칙으로 합니다.단, 금융회사 및 그 밖의 결제수단 발행업자 사정에 따라 달리 정할 수 있습니다.
<br>②         회사는 정보통신설비의 보수, 점검 및 그 밖의 기술상 필요나 금융회사 및 그 밖의 결제수단 발행업자 사정에 따라 전자금융거래 서비스 중단이 불가피한 경우에는 해당 서비스 중단 3일 전까지 게시 가능한 전자적 수단을 통하여 해당 서비스 중단 사실을 게시한 후 해당 서비스를 일시 중단할 수 있습니다. 다만, 시스템 장애복구, 긴급한 프로그램 보수, <br>외부요인 등 불가피한 경우에는 사전 게시 없이 전자금융거래 서비스를 중단할 수 있습니다.
<br> 
<br>제６조  (접근매체의 관리)
<br>①   회사는 전자금융거래서비스 제공 시 접근매체를 선정하여 이용자의 신원, 권한 및 거래지시의 내용 등을 확인합니다.
<br>②   이용자는 접근매체를 사용함에 있어서 다른 법률에 특별한 규정이 있는 경우를 제외하고는 다음 각 호의 어느 하나에 해당하는 행위를 하여서는 아니 됩니다.
<br>1.   접근매체를 양도하거나 양수하는 행위
<br>2.   접근매체를 대여하거나 사용을 위임하는 행위
<br>3.   접근매체를 질권 및 그 밖의 담보 목적으로 하는 행위
<br>4.   제1호부터 제3호까지의 행위를 알선하는 행위
<br>③   이용자는 자신의 접근매체를 제3자에게 누설 또는 노출하거나 방치하여서는 안되며, 접근매체의 도용이나 위조 또는 변조를 방지하기 위하여 충분한 주의를 기울여야 합니다.
<br>④   회사는 이용자로부터 접근매체의 분실이나 도난 등의 통지를 받은 때에는 그 때부터 제3자가 그 접근매체를 사용함으로 인하여 이용자에게 발생한 손해를 배상할 책임이 있습니다.
<br> 
<br>제７조   (거래내용의 확인)
<br>①   회사는 인터넷사이트 등에 해당 서비스 조회 화면을 통하여 이용자가 자신의 거래내용(이용자의 ‘오류정정 요구사실 및 처리결과에 관한 사항’을 포함합니다)을 확인할 수 있도록 합니다.이 경우 전자적 장치의 운영장애 또는 그 밖의 사유로 거래내용을 확인하게 할 수 없는 때에는 회사는 인터넷사이트 등을 이용하여 즉시 그 사유를 알리고, 그 사유가 종료된 때부터 <br>이용자가 자신의 거래내용을 확인할 수 있도록 합니다.
<br>②   이용자는 회사에 대하여 자신의 거래내용을 서면으로 제공하여 줄 것을 인터넷사이트 등 초기화면에 게시된 고객센터의 연락처 또는 인터넷사이트 등의 고객문의 기능을 통하여 요청할 수 있고, 회사는 그 요청을 받은 날로부터 2주 이내에 모사전송, 우편 또는 직접 교부의 방법으로 거래내용에 관한 서면을 교부합니다.
<br>③   회사는 제2항에 따라 이용자로부터 거래내용에 관한 서면교부를 요청받았으나 전자적 장치의 운영장애 또는 그 밖의 사유로 거래내용에 관한 서면을 교부할 수 없는 경우에는 해당 이용자에게 즉시 그 사실 및 사유를 알립니다. 이 경우 전자적 장치의 운영장애 또는 그 밖의 사유로 거래내용에 관한 서면을 교부할 수 없는 기간은 제2항에 따른 거래내용에 관한 서면의 <br>교부기간에 산입하지 아니합니다.
<br>④   회사가 제1항 및 제2항에 따라 제공하는 거래내용 중 대상기간이 5년인 것은 다음 각 호와 같습니다.
<br>1.   거래계좌의 명칭 또는 번호
<br>2.   거래의 종류 및 금액
<br>3.   거래의 상대방에 관한 정보
<br>4.   거래 일시
<br>5.   전자적 장치의 종류 및 전자적 장치를 식별할 수 있는 정보
<br>6.   회사가 전자금융거래의 대가로 받은 수수료
<br>7.   추심이체시 지급인의 출금동의에 관한 사항
<br>8.   해당 전자금융거래와 관련한 전자적 장치의 접속 기록
<br>9.   전자금융거래의 신청 및 조건의 변경에 관한 사항
<br>10.   건당 거래금액이 1만원을 초과하는 전자금융거래에 관한 기록
<br>⑤   회사가 제1항 및 제2항에 따라 제공하는 거래내용 중 대상기간이 1년인 것은 다음 각 호와 같습니다.
<br>1.   건당 거래금액이 1만원 이하인 소액 전자금융거래에 관한 기록
<br>2.   전자지급수단 이용과 관련된 거래승인에 관한 기록
<br>3.   이용자의 오류정정 요구사실 및 처리결과에 관한 사항
<br> 
<br>제８조   (오류의 정정 등)
<br>①   이용자는 전자금융거래서비스를 이용함에 있어 오류가 있음을 안 때에는 회사에 대하여 그 정정을 요구할 수 있습니다.
<br>②   회사는 전항에 따른 오류의 정정 요구를 받은 때 또는 스스로 전자금융거래에 오류가 있음을 안 때에는 이를 즉시 조사하여 처리한 후 정정요구를 받은 날 또는 오류가 있음을 안 날로부터 2주 이내에 오류의 원인과 처리 결과를 문서, 전화 또는 전자우편으로 해당 이용자에게 알립니다. 이 경우 이용자가 문서로 알려줄 것을 요청하는 경우에는 문서로 알립니다.
<br>
<br>제９조   (전자금융거래 기록의 생성과 보존)
<br>①   회사는 이용자가 이용한 전자금융거래의 내용을 추적, 검색하거나 그 내용에 오류가 발생한 경우에 이를 확인하거나 정정할 수 있는 기록을 생성하여 보존합니다.
<br>②   전항에 따라 회사가 보존하여야 하는 기록의 종류 및 보존기간은 제7조제4항 및 제5항에서 정한 바에 따릅니다.
<br> 
<br>제１０조   (지급의 효력발생시기 및 거래지시의 철회)
<br>①   전자지급수단을 이용하여 자금을 지급하는 경우 지급의 효력은 다음 각 호에서 정한 때에 발생합니다.
<br>1.   전자자금이체의 경우 : 거래지시된 금액의 정보에 대하여 수취인의 계좌가 개설되어 있는 금융기관 계좌의 원장에 입금기록이 끝난 때
<br>2.   선불전자지급수단으로 지급하는 경우 : 거래지시된 금액의 정보가 수취인이 지정한 전자적 장치에 도달한 때
<br>3.   그 밖의 전자지급수단으로 지급하는 경우 : 거래지시된 금액의 정보가 수취인의 계좌가 개설되어 있는 금융기관의 전자적 장치에 입력이 끝난 때
<br>②   이용자는 제1항에 따라 지급의 효력이 발생하기 전까지 인터넷사이트 등의 초기화면에 게시된 고객센터의 연락처 또는 인터넷사이트 등의 고객문의 기능을 통하여 전자문서를 전송하는 방법으로, 거래지시를 철회할 수 있습니다.
<br>③   이용자는 통신판매에 따른 재화 또는 용역(이하 ‘재화 등’이라고 합니다)의 구매대금으로 전자지급수단을 지급하여 제1항에 따라 지급의 효력이 발행한 경우에는 「전자상거래 등에서의 소비자보호에 관한 법률」에 따른 청약철회의 방법에 따라 해당 결제대금을 반환 받을 수 있습니다.
<br> 
<br>제１１조   (이용자정보에 대한 비밀보장)
<br>회사는 전자금융업무를 수행함에 있어서 취득한 이용자의 인적사항, 이용자의 계좌, 접근매체 및 전자금융거래의 내용과 실적에 관한 정보 또는 자료를 관련 법령에서 정한 경우를 제외하고는 해당 이용자의 동의를 얻지 아니하고 제3자에게 제공하거나 업무상 목적 외에 사용하지 아니합니다.
<br> 
<br>제１２조  (회사의 책임)
<br>①   회사는 다음 각 호의 어느 하나에 해당하는 사고로 인하여 이용자에게 손해가 발생한 경우에는 그 손해를 배상할 책임을 부담합니다.
<br>1.   접근매체의 위조나 변조로 발생한 사고
<br>2.   계약체결 또는 거래지시의 전자적 전송이나 처리과정에서 발행한 사고
<br>3.   전자금융거래를 위한 전자적 장치 또는 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」 제2조제1항제1호에 따른 정보통신망에 침입하여 거짓이나 그 밖의 부정한 방법으로 획득한 접근매체의 이용으로 발생한 사고
<br>②   회사는 제1항에도 불구하고 다음 각 호의 어느 하나에 해당하는 사유로 인하여 이용자에게 발생한 손해의 전부 또는 일부를 그 이용자가 부담하게 할 수 있습니다.
<br>1.   이용자가 접근매체를 제3자에게 대여하거나 그 사용을 위임한 경우 또는 양도나 담보의 목적으로 제공한 경우
<br>2.   제3자가 권한 없이 이용자의 접근매체를 이용하여 전자금융거래를 할 수 있음을 알았거나 쉽게 알 수 있었음에도 불구하고 접근매체를 누설하거나 노출 또는 방치한 경우
<br>3.   금융회사 또는 전자금융업자가 「전자금융거래법」 제6조제1항에 따른 확인 외에 보안강화를 위하여 전자금융거래 시 요구하는 추가적인 보안조치를 이용자가 정당한 사유 없이 거부하여 전항 제3호에 따른 사고가 발생한 경우
<br>4.   이용자가 제3호에 따른 추가적인 보안조치에 사용되는 매체ㆍ수단 또는 정보에 대하여 누설ㆍ노출 또는 방치하거나 이를 제3자에게 대여ㆍ사용위임ㆍ양도 또는 담보의 목적으로 제공하여 전항 제3호에 따른 사고가 발생한 경우
<br>5.   법인(「중소기업기본법」 제2조제2항에 따른 소기업을 제외합니다)인 이용자에게 손해가 발생한 경우로서 회사가 사고를 방지하기 위하여 보안절차를 수립하고 이를 철저히 준수하는 등 합리적으로 요구되는 충분한 주의의무를 다한 경우
<br>③   회사는 컴퓨터 등 정보통신설비의 보수점검, 교체의 사유 등이 발생한 경우에는 전자금융거래서비스의 제공을 일시적으로 중단할 수 있습니다. 이 경우 회사는 인터넷사이트 등을 통하여 이용자에게 전자금융거래서비스 제공의 중단일정 및 중단사유를 사전에 공지합니다.
<br> 
<br>제１３조  (분쟁처리 및 분쟁조정)
<br>①   이용자는 인터넷사이트 등의 초기화면에 게시된 분쟁처리 담당자 연락처를 통하여 전자금융거래와 관련한 의견 제출 및 손해배상의 청구 등의 분쟁처리신청 등을 할 수 있습니다.
<br>②   회사는 이용자로부터 제1항에 따른 분쟁처리신청을 받은 경우에는 그 신청 받은 날로부터 15일 이내에 이에 대한 조사 또는 처리 결과를 이용자에게 알립니다.
<br>③   이용자는 제2항에 따른 회사의 분쟁처리결과에 대하여 이의가 있을 경우에는 「금융위원회의 설치 등에 관한 법률」에 따른 금융감독원의 금융분쟁조정위원회나 「소비자기본법」에 따른 한국소비자원의 소비자분쟁조정위원회에 회사의 전자금융거래서비스의 이용과 관련한 분쟁 조정을 신청할 수 있습니다.
<br> 
<br>제１４조   (회사의 안전성 확보 의무)
<br>
<br>회사는 전자금융거래가 안전하게 처리될 수 있도록 선량한 관리자로서의 주의를 다하며, 전자금융거래의 안전성과 신뢰성을 확보할 수 있도록 전자금융거래의 종류별로 전자적 전송이나 처리를 위한 인력, 시설, 전자적 장치 등의 정보기술부문 및 전자금융업무에 관하여 금융위원회가 정하는 기준을 준수합니다.
<br> 
<br>제１５조   (약관 적용의 우선순위)
<br>①   회사와 이용자 사이에 개별적으로 합의한 사항이 본 약관에 정한 사항과 다를 때에는 그 합의사항을 본 약관에 우선하여 적용합니다.
<br>②   전자금융거래에 관해서는 본 약관을 우선 적용하며, 본 약관에서 정하지 않은 사항은 개별약관 및 「전자금융거래법」 등 관련 법령이 정하는 바에 따릅니다.
<br> 
<br>제１６조   (관할)
<br>회사와 이용자간에 발생한 분쟁에 관한 관할은 「민사소송법」에 정한 바에 따릅니다.
<br> 
<br>제2장   결제대금예치서비스
<br>제１７조   (정의)
<br>본 장에서 정하는 용어의 정의는 다음과 같습니다.
<br>1.   “결제대금예치서비스”라 함은 인터넷사이트 등에서 이루어지는 선지급식 통신판매에 있어서, 회사는 소비자가 지급하는 결제대금을 예치하고 배송이 완료된 후 재화 등의 대금을 판매자에게 지급하는 제도를 말합니다.
<br>2.   “선지급식 통신판매”라 함은 소비자가 재화 등을 공급받기 전에 미리 대금의 전부 또는 일부를 지급하는 대금 지급 방식의 통신판매를 말합니다.
<br>3.   “판매자”라 함은 본 약관에 동의하고 인터넷사이트 등에 입점한 자로서, 통신판매를 하는 자를 말합니다.
<br>4.   “소비자”라 함은 본 약관에 동의하고 인터넷사이트 등에 입점한 판매자로부터 재화 등을 구매하는 자로서 「전자상거래 등에서의 소비자보호에 관한 법률」 제2조제5호의 요건에 해당하는 자를 말합니다.
<br> 
<br>제１８조   (예치된 결제대금의 지급방법)
<br>①   소비자(그 소비자의 동의를 얻은 경우에는 재화 등을 공급받을 자를 포함합니다)는 재화 등을 공급받은 사실을 재화 등을 공급받은 날로부터 3영업일 이내에 회사에 통보하여야 합니다.
<br>②   회사는 제1항에 따라 소비자로부터 재화 등을 공급받은 사실을 통보받은 경우에는 회사가 정한 기일 내에 판매자에게 결제대금을 지급합니다.
<br>③   회사는 소비자가 재화 등을 공급받은 날부터 3영업일이 지나도록 정당한 사유의 제시 없이 그 공급받은 사실을 회사에 통보하지 아니하는 경우에는 소비자의 동의 없이 해당 판매자에게 결제대금을 지급할 수 있습니다.
<br>④   회사는 판매자에게 결제대금을 지급하기 전에 소비자가 그 결제대금을 환급받을 사유가 발생한 경우에는 그 결제대금을 소비자에게 환급합니다.
<br> 
<br>제3장   선불전자지급수단
<br>제１９조   (정의)
<br>본 장에서 정하는 용어의 정의는 다음과 같습니다.
<br>1.   “선불전자지급수단”이라 함은 인터넷사이트 등에서 이용되는 마켓오브메테리얼캐시 또는 회사가 발행 당시 미리 이용자에게 공지한 전자금융거래법상 선불전자지급수단을 말합니다. 회사가 발행한 각종 선불전자지급수단의 상세 내용은 인터넷사이트 등의 해당 서비스 화면을 통하여 확인할 수 있습니다.
<br>2.   “마켓오브메테리얼캐시”라 함은 이용자가 인터넷사이트 등에 입점한 판매자로부터 재화 등을 구매하고 그 대가를 지급하는데 사용하기 위하여 회사가 발행ㆍ관리하는 선불식전자지급수단을 말합니다.
<br>3.   “판매자”라 함은 이용자에게 재화 등을 판매하고 선불전자지급수단을 결제수단으로 하여 그 대가를 지급받는 자를 말합니다.
<br>4.   “이용자”라 함은 본 약관에 동의하고 판매자로부터 재화 등을 구매하고 선불전자지급수단을 결제수단으로 하여 그 대가를 지급하는 자를 말합니다.
<br> 
<br>제２０조   (유효기간)
<br>①   회사는 이용자가 이벤트, 미사용쿠폰 등에 대한 환불 등을 통하여 회사로부터 무상으로 제공받는 선불전자지급수단에 대하여 유효기간을 설정할 수 있으며, 이용자는 회사가 정한 유효기간 내에서만 무상으로 지급받은 선불전자지급수단을 사용할 수 있습니다.
<br>②   회사는 해당 이벤트 등에 관한 인터넷사이트 등의 관련 화면 등을 통하여 유효기간 설정 여부 및 그 기간을 사전에 고지합니다.
<br> 
<br>제２１조   (구매 취소 및 환급)
<br>①   구매한 선불전자지급수단은 구매일로부터 7일 이내인 경우 구매 취소가 가능합니다.
<br>②   이용자는 보유 중인 선불전자지급수단의 적립된 금액의 60% 이상(1만원 이하는 80%이상)을 사용한 경우에만 회사에 대하여 나머지 금액에 대한 환급을 요구할 수 있습니다. 이 경우 회사는 별도의 비용없이 나머지 금액을 이용자에게 환급하여 줄 수 있습니다. 다만, 다음 각 호의 어느 하나에 해당하는 경우에는 잔액 전부를 환급하여야 합니다.
<br>1. 천재지변 등의 사유로 회사가 재화 또는 용역을 제공하기 곤란하여 선불전자지급수단을 사용하지 못하게 된 경우
<br>2. 선불전자지급수단의 결함으로 회사가 재화 또는 용역을 제공하지 못하는 경우
<br>③   이용자가 이벤트, 포상, 보상 등을 통하여 무상으로 제공받은 선불전자지급수단의 환급은 그 무상 제공 시에 해당 선불전자지급수단의 환급이 가능함을 이용자에게 사전에 공지하거나 통지한 경우에 한합니다.
<br>제２２조   (환수)
<br>회사는 이용자가 보유중인 선불전자지급수단이 다음 각 호의 어느 하나에 해당하는 경우에는 이를 환수할 수 있습니다.
<br>1.   선불전자지급수단의 제공원인 사유가 취소된 경우
<br>2.   이용자가 거짓이나 그 밖의 부정한 방법으로 선불전자지급수단을 보유한 경우
<br> 
<br>부칙
<br>이 약관은 2020년  6월  1일부터 시행됩니다.

<h3>
				개인정보 수집 및 이용동의

				</h3>



								고객의 개인정보 보호는 마켓오브메테리얼 주식회사(이하 ‘마켓오브메테리얼’)의 중요한 사업 원칙입니다. 마켓오브메테리얼은 지속적으로 고객에게 더 높은 수준의 서비스, 편리함과 가치를 제공하기 위해 노력하지만 결코 고객 개인정보 보호라는 가치를 희생하며 서비스 목표를 달성하지 않습니다.  <br>  

따라서, 마켓오브메테리얼이 수행하는 모든 활동은 정보통신망 이용촉진 및 정보보호 등에 관한 법률(이하 ‘정보통신망법’)과 개인정보 보호법 등 국내 관련 법령을 준수하며, 본 개인정보 처리방침을 따릅니다.<br>

본 개인정보 처리방침은 마켓오브메테리얼의 개인정보 처리와 관련한 정보를 제공하고 고객이 가진 권리 및 어떻게 그 권리를 행사할 수 있는지에 대하여 설명합니다. 마지막으로, 마켓오브메테리얼의 서비스 이용 중 개인정보와 관련하여 문의가 있을 경우 연락할 수 있는 개인정보 보호책임자 및 담당자의 연락처를 안내합니다.<br>

마켓오브메테리얼은 고객의 개인정보와 관련된 변경사항이 생길 경우 개인정보 처리방침 개정을 통해 빠른 시일 안에 고객에게 안내합니다. 개인정보 처리방침의 세부 목차는 아래와 같습니다.<br>
1. 수집하는 개인정보 및 이용에 관한 안내<br>
2. 개인정보의 제3자 제공<br>
3. 개인정보의 처리위탁<br>
4. 개인정보의 파기<br>
5. 이용자의 권리와 의무<br>
6. 자동 수집 장치의 설치/운영 및 그 거부에 관한 사항<br>
7. 개인정보 보호책임자 및 담당자 안내<br>
8. 고지의 의무<br>
1. 수집하는 개인정보 및 이용에 관한 안내<br>
1.1 정회원<br>
정회원이란 마켓오브메테리얼 웹사이트 혹은 마켓오브메테리얼 앱을 통해 가입한 회원을 말합니다.<br>
분류	수집∙이용목적	수집 ∙이용항목	보유 및 이용기간<br>
필수정보	가입 서비스 이용 및 상담, <br>
부정이용 확인∙방지, <br>
환불 및 리콜 안내	이름, 연락처(휴대전화번호 또는 전화번호), ID(이메일 주소), 비밀번호, 	회원 탈퇴 시 즉시 삭제함<br><br>

부정이용 방지를 위한 정보(ID, 불량 이용 기록)는 탈퇴DB에서 6개월 후 삭제함<br><br>

거래기록 보존을 위한 정보(ID, 계좌번호, 배송지 주소)는 5년간 보관함(전자상거래 등에서의 소비자보호에 관한 법률)<br><br>

IP 의 경우 3개월 보관함(통신비밀보호법)
		회사명, 계좌번호, 운송지 주소 서비스 이용기록 (방문일시, IP, 불량 이용 기록 등), 기기 정보(기기 종류, OS버전)	<br>
추가정보	본인확인 성인인증	휴대전화 본인확인: 이름, 생년월일, 성별, 통신사명, 휴대전화번호, Duplicate Information(DI), Connecting Information(CI), 내/외국인정보<br>
	회원 탈퇴 시 즉시 삭제부정이용 방지를 위한 고객 식별정보(DI, CI)는 탈퇴 DB에서 6개월 후 삭제함<br><br>

거래기록 보존을 위해 소비자 식별정보(DI, CI), 결제, 취소, 환불 및 배송정보는 5년간 보관함(전자상거래 등에서의 소비자 보호에 관한 법률)<br>
	업체 인증	사업자 등록번호, 사업자등록증 사본	<br>
	결제	가상계좌이체: 은행명, 계좌번호<br>
무통장입금: 은행명, 입금자명<br>
세금계산서 발급정보: 사업자 등록번호, 회사명, 사업자 계좌 번호, 은행명	<br>
	취소∙환불	예금주 이름, 은행명, 계좌번호	<br>
	운송	수취인정보(이름, 연락처, 주소)	<br>
	관세부과 및 통관	개인고유통관부호	정보 삭제 요청 및 회원 탈퇴 시 즉시 삭제<br>
선택정보	배송서비스 개선	개인 위치정보	배달 완료 후 1년까지 보관정보 삭제 요청 시 즉시 삭제<br>
	마케팅, 분석	이메일, 연락처(휴대전화번호), 아기정보(나이, 성별, 이름)	정보 삭제 또는 이용 정지 요청 및 회원 탈퇴 시 즉시 삭제<br>
※ 부정이용이란 회원 탈퇴 후 재가입, 상품 구매 후 구매취소 등을 반복적으로 행하는 등 “마켓오브메테리얼”이 제공하는 이벤트 혜택 등의 경제상 이익을 불·편법적으로 수취하는 행위, 이용약관 등에서 금지하고 있는 행위, 명의도용 등의 불·편법 행위 등을 포함합니다. <br>
※ 고객의 권리를 보장해 드리기 위하여 탈퇴 회원 또는 장기 미이용 회원에게 환불 또는 리콜 안내를 목적으로 구매정보를 이용하여 연락을 취할 수 있습니다. <br>
※ 위의 정보는 서비스 이용에 따른 통계∙분석에 이용될 수 있습니다.<br><br><br>

1.2 비회원<br>
비회원은 마켓오브메테리얼의 웹 혹은 앱을 통해 회원가입을 하지 않고 마켓오브메테리얼의 서비스(검색, 매물정보 등)를 이용하는 회원을 말합니다.<br>
분류	수집방법	수집.이용목적	수집.이용항목	보유 및 이용기간<br>
구독회원 신청	마켓오브메테리얼 웹사이트 내 구독하기 <br>
직접 입력	소식지 발송	이메일	구독 종료시 즉시 삭제<br><br>

1.3 이벤트 참여 회원 <br>
이벤트 참여 회원은 마켓오브메테리얼에서 운영하는 사이트의 게시판 등을 통하여 진행하는 이벤트에 참여한 회원을 말합니다.<br>
분류	수집방법	수집항목	이용목적	보유.파기<br>
이벤트 <br>
응모	마켓오브메테리얼 게시판에 댓글 달기 등을 통해 직접 참여하거나, 이메일을 통한 이벤트 당첨 정보 입력 전송	이름, 마켓오브메테리얼 ID	당첨자 선정	수집된 정보는 마켓오브메테리얼 이벤트 종료 후 30일 이내 파기<br>
이벤트  당첨	이벤트 당첨에 따른 메시지 또는 댓글로 당첨자 직접 입력 송부	배송 상품: 성명, 연락처, 주소 <br>
문자상품권(기프티쇼): 이름, 연락처 	경품 전달	<br>
2. 개인정보의 제3자 제공<br>
2.1 일반 이용 회원<br>
주문과 결제가 이루어진 경우, 상담 및 배송 등의 원활한 거래 이행을 위하여 관련된 정보를 필요한 범위 내에서 제3자 에게 전달합니다. 제공받은 자의 자세한 정보는 아래의 ‘제공받는 자’의 각 항목을 클릭하시면 확인 할 수 있습니다.<br>
<br>제공받는 자	제공목적	제공 정보	보유 및 이용 기간
<br>판매자	주문상품의 배송(예약), 고객상담 및 불만처리	성명, 휴대전화번호, 배송지주소, 이메일
<br>※ 구매자와 수취인이 다를 경우에는 수취인의 정보(해외 운송 상품은 개인고유통관부호 포함)가 제공될 수 있습니다.	재화 또는 서비스의 제공 목적이 달성된 후 파기(단, 관계법령에 정해진 규정에 따라 법정기간 동안 보관)
<br>해외 주재의 상품 제공업체	서비스제공, 구매자확인, 해피콜, 통관업무처리※ 물품 구매 시 구매내역 전달	성명, 휴대전화번호, 배송지주소, 개인통관고유부호
<br>※ 구매자와 수취인이 다를 경우에는 수취인의 정보가 제공될 수 있습니다.	
<br>※ 동의 거부권 등에 대한 고지
<br>개인정보 제공은 서비스 이용을 위해 꼭 필요합니다. 개인정보 제공을 거부하실 수 있으나, 이 경우 서비스 이용이 제한될 수 있습니다. 개인정보 제3자 제공은 구매 시에만 이뤄지며, 명확한 내용은 구매 시 안내하여 드립니다.
<br>
<br>2.2 마켓오브메테리얼 전자 결제 시스템
<br>마켓오브메테리얼이 제공하는 안심 결제 서비스를 통하여 결제가 이루어지기 때문에 거래 이행을 위하여 관련된 정보를 필요한 범위 내에서 관련 업체에게 제공합니다.
<br>제공받는 자	NH농협, 수협, SC제일, 전북은행 등 가상계좌의 귀속 은행, 및 페이게이트 주식회사
<br>제공 목적	결제, 취소, 결제계좌 등록 관련 업무, 예금주 확인, 서비스 이행을 위한 본인 식별 및 실명 확인, 결제수단 인증, 결제 도용 방지, 포인트조회/전환
<br>제공 정보	성명, 생년월일, 계좌번호, 통신사, 휴대폰번호
<br>보유 및 이용 기간	마켓오브메테리얼 안심 결제 서비스 이용 해지 시 등록된 계좌 정보는 즉시 삭제
<br>다만, 전자상거래 등에서의 소비자보호에 관한 법률에 따라 거래기록 보존을 위하여 실제 결제에 이용된 계좌 및카드 정보는 5년간 보관
<br>※ 회원이 안심 결제 서비스와 연동하여 실제 이용하는 금융기관에만 관련 정보가 제공됩니다.
<br>※ 위와 같이 제공하는 개인정보에 대해, 동의하지 않거나 개인정보를 기재하지 않음으로써 정보 제공을 거부할 수 있습니다. 다만, 이때 회원에게 제공되는 서비스가 제한될 수 있습니다.
<br>
<br>3. 개인정보의 위탁
<br>마켓오브메테리얼은 위탁한 개인정보를 수탁자들이 안전하게 처리하고 있는지 지속적으로 관리 감독하고 있으며, 수탁 업무가 종료된 때에 수탁자가 보유하고 있는 개인정보는 즉시 파기하도록 하고 있습니다.
<br>
<br>3.1 개인정보 국내 처리 위탁 현황
<br>구분	수탁자	위탁업무
<br>고객상담	한국고용정보, 주식회사 트랜스코스모스코리아, U-BASE	고객 및 주문 정보 이용관리 등 콜센터 업무의 일체
<br>본인확인	한국모바일인증㈜, NHN 한국사이버결제 주식회사, 코리아크레딧뷰로㈜, 케이지모빌리언스	본인인증
<br>	인비즈넷㈜, ThinkAT	추심이체동의를 위한 ARS인증
<br>배송서비스	㈜ 대영로지스, 개인 배송사업자
<br>상품의 배송
<br>결제처리	㈜ 웰컴페이먼츠 주식회사	무통장 입금(가상계좌) 등을 통한 결제처리
<br>알림 발송	LGU+, 주식회사 케이티, ㈜ 카카오, NHN 주식회사	SMS 및 메시지 발송
<br>데이터 보관	카페24.	데이터 보관
<br>데이터 처리	Microsoft	이메일, 문서/파일 저장과 내부 커뮤니케이션 및 협업 도구
<br>4. 개인정보의 파기
<br>수집된 개인정보의 보유•이용기간은 서비스 이용계약 체결(회원가입)시부터 서비스 이용계약 해지(탈퇴신청, 직권탈퇴포함)시까지 입니다. 또한 동의 해지 시 고객의 개인정보를 상기 명시한 정보보유 사유에 따라 일정 기간 저장하는 자료를 제외하고는 지체 없이 파기합니다. 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각 등을 통하여 파기하고, 전자적 파일형태로 저장<br>된 개인정보는 기록을 재생할 수 없는 기술적 방법 또는 물리적 방법을 사용하여 파기합니다.
<br>수집•이용목적이 달성된 개인정보의 경우 별도의 DB에 옮겨져 내부규정 및 관련 법령을 준수하여 안전하게 보관되며, 정해진 기간이 종료되었을 때 지체없이 파기됩니다. 이때, 별도의 DB로 옮겨진 개인정보는 회원이 동의한 목적을 초과하거나 혹은 법률이 정한 경우 외의 다른 목적으로 이용되지 않습니다.
<br>마켓오브메테리얼을 최종 이용 후 1년 동안 이용 기록이 없는 고객(장기미이용회원)의 개인정보는 별도로 분리하여 안전하게 관리하게 되며, 대상자에게는 분리 보관 처리일을 기준으로 하여 최소 30일 이전에 이메일 주소를 통해 안내를 합니다. 단, 통신비밀보호법, 전자상거래 등에서의 소비자보호에 관한 법률 등의 관계법령의 규정에 의하여 보존할 필요가 있는 경우 규정<br>된 기간 동안 고객의 개인정보를 보관합니다.
<br>
<br>5. 고객의 권리와 의무
<br>5.1 고객의 권리
<br>고객 및 법정대리인은 언제든지 수집 정보에 대하여 수정, 동의 철회, 삭제, 열람을 요청할 수 있습니다. 다만, 동의 철회, 삭제 시 서비스의 일부 또는 전부 이용이 제한될 수 있습니다. 마켓오브메테리얼이 수집한 개인정보는 아래와 같은 방법을 통해 확인할 수 있습니다:
<br>      [수집된 개인정보 확인]
<br>           · 마켓오브메테리얼 웹페이지에서 - 마이마켓오브메테리얼 > My 정보 > 개인정보 확인 수정 / 주문목록 / 배송조회
<br>
<br>마켓오브메테리얼 웹 또는 앱을 통해 직접 확인하지 못하는 정보는 마켓오브메테리얼 고객센터(1577-7011, help@marketofmaterial.com)에 요청하여 확인할 수 있습니다.
<br>개인정보 동의 철회 및 삭제, 처리 정지를 요청하고자 하는 경우에는 마켓오브메테리얼 고객센터(1577-7011, help@marketofmaterial.com)를 통해 요청할 수 있습니다. 또한, 고객은 언제든 회원탈퇴를 통해 개인정보의 수집 및 이용 동의를 철회할 수 있습니다. 이러한 요청 시, 서비스의 일부 또는 전부 이용이 제한될 수 있습니다. 또한, 법률에 특별한 규정<br>이 있거나 법령상 의무를 준수하기 위하여 불가피한 경우, 다른 사람의 생명·신체를 해할 우려가 있거나 다른 사람의 재산과 그 밖의 이익을 부당하게 침해할 우려가 있는 경우, 개인정보를 처리하지 아니하면 정보 주체와 약정한 서비스를 제공하지 못하는 등 계약의 이행이 곤란한 경우로서 정보주체가 그 계약의 해지 의사를 명확하게 밝히지 아니한 경우에는 동의 철회, 삭<br>제, 처리 정지가 어려울 수 있습니다.
<br>요청하신 처리가 완료될 때까지 해당 정보를 이용하거나 타인에게 제공하지 않습니다. 또한, 합리적인 사유로 잘못된 개인정보를 제3자에게 이미 제공한 경우, 그 결과를 지체 없이 제3자에게 통지하여 동의 철회, 삭제, 처리 정지하도록 조치합니다
<br>5.2. 고객의 의무
<br>고객은 자신의 개인정보를 보호할 의무가 있으며, 회사의 귀책사유가 없이 ID(이메일 주소), 비밀번호, 접근매체 등의양도·대여·분실이나 로그인 상태에서 이석 등 고객 본인의 부주의나 관계법령에 의한 보안조치로 차단할 수 없는 방법이나 기술을 사용한 해킹 등 회사가 상당한 주의에도 불구하고 통제할 수 없는 인터넷상의 문제 등으로 개인정보가 유출되어 발생한 문제에 <br>대해 회사는 책임을 지지 않습니다. 고객은 자신의 개인정보를 최신의 상태로 유지해야 하며, 고객의 부정확한 정보 입력으로 발생하는 문제의 책임은 고객 자신에게 있습니다. 타인의 개인정보를 도용한 회원가입 또는 ID등을 도용하여 결제 처리 시 고객 자격 상실과 함께 관계법령에 의거하여 처벌될 수 있습니다. 고객은 아이디, 비밀번호 등에 대해 보안을 유지할 책임이 <br>있으며 제3자에게 이를 양도하거나 대여할 수 없습니다. 고객은 회사의 개인정보보호정책에 따라 보안을 위한 주기적인 활동에 협조할 의무가 있습니다.
<br>
<br>6. 자동 수집 장치의 설치/운영 및 그 거부에 관한 사항
<br>마켓오브메테리얼은 고객의 간편하고 효율적이며 개인 맞춤화된 거래를 위하여 서비스 이용과정에서 자동으로 생성하는 정보를 저장(수집)하거나 개인식별이 불가능한 기기 정보를 수집하고 저장할 수 있습니다. 마켓오브메테리얼은 이러한 자동 생성 정보 중 어떠한 정보를 수집하며 어떻게 수집 거부를 설정할 수 있는지 안내합니다.
<br>6.1. 쿠키
<br>쿠키(Cookie)는 사용자의 효율적이고 안전한 웹 사용을 보장하기 위해 웹사이트 접속 시 사용자의 디바이스로 전송 및 저장되는 작은 텍스트 파일입니다. 쿠키가 저장된 이후 다시 웹사이트를 방문할 경우 쿠키는 웹사이트 사용자의 디바이스를 인식하여 지난 설정과 과거 이용내역을 자동으로 불러옵니다. 또한 방문한 서비스 정보, 서비스 접속 시간 및 빈도, 서비스 이용 <br>과정에서 생성된 또는 제공(입력)한 정보 등을 분석하여 고객의 취향과 관심에 특화된 서비스(광고 포함)를 제공할 수 있습니다. 고객은 쿠키에 대한 선택권을 가지고 있으며, 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.
<br>
<br>      [쿠키 설정 변경 방법]
<br>      현재 사용하는 브라우저의 쿠키 설정 확인 및 변경은 아래와 같은 방법을 통해 가능합니다.
<br>           • Internet Explorer를 사용하는 경우 쿠키 설정 방법 보 기
<br>           • Safari를 사용하는 경우 쿠키 설정 방법 보 기
<br>           • FireFox를 사용하는 경우 쿠키 설정 방법 보 기
<br>           • Chrome 브라우저를 사용하는 경우 쿠키 설정 방법 보 기
<br>
<br>6.2. 맞춤형 광고
<br>고객에게 맞춤형 광고를 제공하기 위하여 마켓오브메테리얼은 웹 브라우저에서 ‘쿠키’를 수집하여 사용합니다. 마켓오브메테리얼은 쿠키를 통해 고객의 서비스 사용 이력을 자동으로 수집하여 페이스북 및 구글에 제공합니다. 페이스북 및 구글은 이를 활용하여 고객 맞춤 광고를 진행합니다. 마켓오브메테리얼에서 수집하는 쿠키는 다른 개인정보와 연계되지 않으며 개인을 식별하<br>지 않습니다. 또한, 페이스북 및 구글은 마켓오브메테리얼에서 제공하는 정보를 활용하여 개인을 식별하지 않습니다.
<br>
<br>사용자는 언제든지 이러한 맞춤형 광고 수신을 거부할 수 있으며, 이 경우 맞춤형 광고가 아닌 임의의 광고가 노출됩니다.
<br>
<br>7. 개인정보 보호책임자 및 담당자 안내
<br>고객의 개인정보에 관한 업무를 총괄해서 책임지고, 개인정보와 관련된 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자 및 담당부서를 지정하여 운영하고 있습니다. 회사가 제공하는 서비스를 이용하면서 발생하는 모든 개인정보 보호 관련 문의, 불만, 피해구제 등에 관한 사항은 아래로 연락하여 문의할 수 있습니다. 마켓오브메테리얼은 이러한 문의에 대<br>해 지체 없이 답변 및 처리할 것입니다.
<br>
<br>개인정보 보호책임자	개인정보 민원처리 담당부서
<br>성명: 조윤기
<br>연락처: 1577-7011
<br>이메일: help@marketofmaterial.com	부서명: 마켓오브메테리얼 고객센터
<br>연락처: 1577-7011
<br>이메일: help@marketofmaterial.com
<br>마켓오브메테리얼 관련 개인정보 민원처리
<br>
<br>기타 개인정보 침해 신고나 상담이 필요하신 경우에는 아래 기관에 문의 가능합니다.
<br>      ▶ 개인정보 침해신고센터: (국번없이) 118 / (웹사이트: privacy.kisa.or.kr)
<br>      ▶ 대검찰청 사이버범죄수사단 : (국번없이) 1301 / (웹사이트: www.spo.go.kr)
<br>      ▶ 경찰청 사이버안전국 : (국번없이) 182 / (웹사이트: cyberbureau.police.go.kr)
<br>
<br>8. 고지의 의무
<br>이 개인정보 처리방침은 시행일로부터 적용됩니다. 고객의 개인정보 권리에 중요한 변경 사유가 발생하는 경우 최소 14일전에 마켓오브메테리얼 공지사항을 통하여 고지합니다. 이 외의 다른 변경사항이 발생하는 경우에는 변경사항의 시행 최소 7일 전부터 공지사항을 통해 고지합니다.
<br>
<br>개인정보 처리방침 버전 번호: 1.0
<br>
<br>현재 개인정보 처리방침 공고일자: 2020년 4월 1일
<br>현재 개인정보 처리방침 시행일자: 2020년 4월 8일

				</div>

				<h1 class="blind">카드 및 할부 선택</h1>
				<div class="icon2">
					<span title="카드에 따라서 할인쿠폰은 상단의 할인받기를 확인하여, 포인트는 하단의 포인트사용 체크상자 선택하여, 무이자 할부는 하단의 할부선택 콤보상자를 선택하여 혜택을 사용합니다. KB국민, BC, 그외의 카드를 선택하게 되면 무이자 할부는 다음 버튼을 클릭하여 나타나는 새창에서 선택해야 합니다"></span>

										
					
				
										 
				</div>

				<span id="selectCardTitle" title="카드를 선택하세요"></span>
				
				
				
				
				<div class="card form_row">
				
					
					
					
					
						
						
							
							
													
							
						
							
												
					
					
					
						
	
					
					 
								
					
	
						<div class="form_row b2b_bn">
						
							
							
								
								<div class="bn_pay1">	
								
									
									
										<span class="b2b_w1 btnCard">
											<a href="javascript:;" id="PAYCO" title="선택" class="linkArea btnInfo">
												<span class="b2b_w1_table">
													<span class="card_bn_logo">
														<img src="img/card_logo/logo_payco.png" alt="페이코간편결제" aria-hidden="false">
													</span>
													
													
														
															
															
														
														
													
													
													
													<span class="card_bn_txt" style="display:visible">페이코 결제 시 2만원 이상 4천원 할인!<br>(생애 첫 결제 및 90일 휴면 대상)<br></span>
													
													<i class="area_icon">
														<img src="img/ic_coupon.png" alt="쿠폰" class="ic_icon1">
														<img src="img/ic_point.png" alt="포인트" class="ic_icon1">
														<img src="img/ic_month.png" alt="무이자할부" class="ic_icon1">
													</i>
												</span>		
											</a>
										</span>								
									
									
									
									
																	
									
								
								</div>		
								
							
							
							
							
							
								
								<div class="bn_card">
									
										
										
										
										
										<span class="btnCard b2b_w3"> 	
											<a href="javascript:;" id="CCBC" title="선택" class="linkArea btnInfo">
												<span class="b2b_w3_table">
											
													
													
														
															
														
														
													
													
													<span class="card_bn_logo">비씨카드</span>
													<span class="card_bn_txt">2~6개월 무이자할부(법인/체크/GIFT제외)</span>
													
													
													
														<i class="area_icon">
															<img src="img/ic_month.png" alt="무이자할부" class="ic_icon1">
														</i>
													
													
												</span>
											</a>
										</span>										
										
									
										
										
										
										
										<span class="btnCard b2b_w3"> 	
											<a href="javascript:;" id="CCDI" title="선택" class="linkArea btnInfo">
												<span class="b2b_w3_table">
											
													
													
														
															
														
														
													
													
													<span class="card_bn_logo">현대카드</span>
													<span class="card_bn_txt">2~6개월 무이자 (코스트코,스마일카드 포함)</span>
													
													
													
														<i class="area_icon">
															<img src="img/ic_month.png" alt="무이자할부" class="ic_icon1">
														</i>
													
													
												</span>
											</a>
										</span>										
										
																
								</div>
								
							
							
						
						</div>		
						
					
					
					 
					

					
					
							
								
													    
														
													
					
													    
					
					
					
					
						<ul class="form_row">
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCLG" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCLG.png" aria-hidden="true" alt="신한">
														<em>신한</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCKM" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCKM.png" aria-hidden="true" alt="KB국민">
														<em>KB국민</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCNH" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCNH.png" aria-hidden="true" alt="NH채움">
														<em>NH채움</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCSS" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCSS.png" aria-hidden="true" alt="삼성">
														<em>삼성</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCLO" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCLO.png" aria-hidden="true" alt="롯데">
														<em>롯데</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCPH" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCPH.png" aria-hidden="true" alt="우리">
														<em>우리</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
										
											
										
									
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
						</ul>
						
						
							
							
							<ul class="form_row">
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
												
												
												
												<li class="w1 btnCard">
													<a href="javascript:;" id="CCHN" title="카드 선택" class="btnInfo">
														<span class="bank_logo">
															<img src="img/card_logo/logo_CCHN.png" aria-hidden="true" alt="하나">
															<em>하나</em>
														</span>
														
															<i class="area_icon" title="제공">
																 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2"> 
															</i>
														
													</a>
												</li>
											
																				
									
									
								
								
									
										
											
												
												
												
												<li class="w1 btnCard">
													<a href="javascript:;" id="CCKE" title="카드 선택" class="btnInfo">
														<span class="bank_logo">
															<img src="img/card_logo/logo_CCKE.png" aria-hidden="true" alt="하나(외환)">
															<em>하나(외환)</em>
														</span>
														
															<i class="area_icon" title="제공">
																 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2"> 
															</i>
														
													</a>
												</li>
											
																				
									
									
								
								
									
										
											
												
												
												
												<li class="w1 btnCard">
													<a href="javascript:;" id="CCUF" title="카드 선택" class="btnInfo">
														<span class="bank_logo">
															<img src="img/card_logo/logo_CCUF.png" aria-hidden="true" alt="은련(해외카드)">
															<em>은련(해외카드)</em>
														</span>
														
													</a>
												</li>
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
								
								
												
								
					
									<li class="sel_w2">
										<div id="etcCard" class="sel_w2_bg">
											<a href="javascript:;">그외 카드<img src="img/sel_arrow_off.gif" class="ic_arrow" alt="카드 선택"></a>
											<ul style="display:none;">
												<li class="etcCardList">
													<a href="javascript:;" id="etcTitle">그외 카드</a>
												</li>
												
													
												
													
												
													
												
													
												
													
												
													
												
													
												
													
												
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCPB" title="카드 선택" class="btnInfo">
																우체국
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCSU" title="카드 선택" class="btnInfo">
																수협
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCSM" title="카드 선택" class="btnInfo">
																MG새마을
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCCJ" title="카드 선택" class="btnInfo">
																제주
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCJB" title="카드 선택" class="btnInfo">
																전북
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCCT" title="카드 선택" class="btnInfo">
																씨티
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCCU" title="카드 선택" class="btnInfo">
																신협
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKJ" title="카드 선택" class="btnInfo">
																광주
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKD" title="카드 선택" class="btnInfo">
																KDB산업
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCSB" title="카드 선택" class="btnInfo">
																저축은행
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="BC81" title="카드 선택" class="btnInfo">
																하나BC
																
																	<i class="area_icon" title="제공">
																		 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2"> 
																	</i>
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCHS" title="카드 선택" class="btnInfo">
																KB증권
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKA" title="카드 선택" class="btnInfo">
																카카오뱅크
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKK" title="카드 선택" class="btnInfo">
																케이뱅크
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCMD" title="카드 선택" class="btnInfo">
																미래에셋대우
																
															</a>
														</li>		
													
												
											</ul>
										</div>
									</li>
											
								
								
																
							</ul>
							
								
						
					
					
					
					
					
					
					
						
						
					    
					    
						
					
							
					
						<ul class="form_row">
							
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="SSSG" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_SSSG.png" aria-hidden="true" alt="SSGPAY">
														<em>SSGPAY</em>
													</span>
												</a>
											</li>
										
																			
								
								
							
							
							
							
											
										
							
							
															
						</ul>
												
					
					
					
										
				</div>

				
				
					<div id="ssAppCard" class="chk_box chk_txt">

						<label for="chk_sm">
							<span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>
							<span>무통장 입금</span>
						</label>
						<div>
							<br>
							<div style="padding-left:10px;">
							<table class="table table-bordered"> 
								<tr>
									
									<th>은행명</th>
									<td>
										상호 저축은행

									</td>
								</tr>
								<tr>
									<th>계좌번호</th>
	<td><?=$user['virtual_account_number']?></td>
								</tr>
								<tr>
										<th>
											예금주

										</th>
										<td>
											
<?=$_SESSION['name']?>
										</td>

								</tr>

							</table>

					
							</div>

					
						</div>
					</div>
				

				
				<div id="selCard_opt" class="sel_box form_row" style="display:none">
								
					
					<label id="select-monthLabel" style="display:none" for="select-month" class="blind">할부선택</label>
					<select id="select-month" style="display:none" name="select-month" class="select_month">
						<option value="00">일시불</option>
					</select>

					
					<div id="supportAppCard" class="chk_box chk_txt" style="display:none;">
						<input type="checkbox" id="chkApp" name="chkApp" value="Y" onclick="javascript:;">
						<label for="chkApp"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span><span id="appCardMsg"></span></label>
					</div>

					
					<div id="supportPoint" class="chk_box chk_txt" style="display:none;">
						<input type="checkbox" id="chkPoint" name="chkPoint" value="Y">
						<label for="chkPoint">
							<span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>
							<span id="pointCardMsg"></span>
						</label>
					</div>
						
				</div>  
				
				
				
				
				<div id="oseaUI" class="form_row ma_t15" style="display:none;">
					<div class="account_w fl_l">
						<div id="ONLY_CCXX" class="txt_foreign overseaCardField" style="display:none;">* VISA / MASTER / JCB만 가능</div>
					

						<label for="card_num1" class="account_tit overseaCardField">
							카드번호
							<span class="sp ic_required">필수입력</span>
							<span class="blind">앞자리</span> 
						</label>
						
						<div class="input_col4 overseaCardField">
							<span class="input_area">
								<input type="text" id="card_num1" name="card_num1" class="input_txt oseaCardNum" value="" maxlength="4" placeholder="4자리" title="카드번호 필수입력 첫번째자리">
							</span>
							<span class="input_area">
								<input type="text" id="card_num2" name="card_num2" class="input_txt oseaCardNum" value="" maxlength="4" placeholder="4자리" title="카드번호 두번째자리">
							</span>
							<span class="input_area">
								<span class="ic_slock"><img src="img/ic_slock.png" alt="보안키패드" aria-hidden="true"></span>
								<input type="password" id="card_num3" name="card_num3" npkencrypt="on" data-keypad-type="num" class="input_txt oseaCardNum nppfs-npv" value="" maxlength="4" placeholder="* * * *" title="카드번호 세번째자리" readonly="readonly" nppfs-keypad-uuid="nppfs-keypad-card_num3" data-input-useyn-type="toggle" data-keypad-useyn-input="__KU_9f904c58d009">
							</span>
							<span class="input_area">
								<span class="ic_slock"><img src="img/ic_slock.png" alt="보안키패드" aria-hidden="true"></span>
								<input type="password" id="card_num4" name="card_num4" npkencrypt="on" data-keypad-type="num" class="input_txt oseaCardNum nppfs-npv" value="" maxlength="4" placeholder="* * * *" title="카드번호 네번째자리" readonly="readonly" nppfs-keypad-uuid="nppfs-keypad-card_num4" data-input-useyn-type="toggle" data-keypad-useyn-input="__KU_c84a5c7a97db">
							</span>
						</div>
						<div id="OSEA_INFO" class="account_r overseaCardField"><a href="javascript:;" title="새창"><span class="sp ic_notice">주의사항</span>해외카드 3D 인증안내</a></div>
						
						<!-- PGAPP-9002 은련카드 카드번호 검증 start  -->
						<label for="card_num5" class="account_tit unionpayField">
							카드번호
							<span class="sp ic_required">필수입력</span>
							<span class="blind">16자리 에서 19자리</span>
						</label>
						<div class="input_area unionpayField">
							<input type="text" id="card_num5" name="card_num5" class="input_txt input_w1 unionPayNum" value="" placeholder="16자리 ~ 19자리" maxlength="19" title="카드번호 필수입력 16자리 에서 19자리">
						</div>
						<!-- PGAPP-9002 은련카드 카드번호 검증 end  -->
						
					</div>

					<div class="account_w fl_r">
						<label for="sel_card_month" class="account_tit">유효기간
							<span class="sp ic_required">필수입력</span>
							<span class="blind">월 선택</span>
						</label>
						<select id="sel_card_month" name="sel_card_month" class="sel_card_month2">
							<option value="">월 선택</option>
							
								<option value="1">1</option>
							
								<option value="2">2</option>
							
								<option value="3">3</option>
							
								<option value="4">4</option>
							
								<option value="5">5</option>
							
								<option value="6">6</option>
							
								<option value="7">7</option>
							
								<option value="8">8</option>
							
								<option value="9">9</option>
							
								<option value="10">10</option>
							
								<option value="11">11</option>
							
								<option value="12">12</option>
													
						</select>
						
						
						
						
						<label for="sel_card_year" class="blind">년 선택</label>
						<select id="sel_card_year" name="sel_card_year" class="sel_card_month3">
							<option value="">년 선택</option>
							
								<option value="2020">2020</option>
							
								<option value="2021">2021</option>
							
								<option value="2022">2022</option>
							
								<option value="2023">2023</option>
							
								<option value="2024">2024</option>
							
								<option value="2025">2025</option>
							
								<option value="2026">2026</option>
							
								<option value="2027">2027</option>
							
								<option value="2028">2028</option>
							
								<option value="2029">2029</option>
							
								<option value="2030">2030</option>
							
								<option value="2031">2031</option>
							
								<option value="2032">2032</option>
							
								<option value="2033">2033</option>
							
								<option value="2034">2034</option>
							
								<option value="2035">2035</option>
							
								<option value="2036">2036</option>
							
								<option value="2037">2037</option>
							
								<option value="2038">2038</option>
							
								<option value="2039">2039</option>
							
								<option value="2040">2040</option>
							
								<option value="2041">2041</option>
							
								<option value="2042">2042</option>
							
								<option value="2043">2043</option>
							
								<option value="2044">2044</option>
							
								<option value="2045">2045</option>
							
								<option value="2046">2046</option>
							
								<option value="2047">2047</option>
							
								<option value="2048">2048</option>
							
								<option value="2049">2049</option>
							
								<option value="2050">2050</option>
													
						</select>
					</div>
				</div>
				
				
				
				
				
			</div>	

			<div class="bn1">
				
				
								
			</div>
		</div>
		<!--//contents-->

		
		<div class="footer">
		
			
			
			
			
            
            
            

            
			
				
					
				
				
			<style>
			.content,.footer{
			display: none;
			}
				.loading{
			
			text-align: center;
			padding: 170px;
			}

			</style>
			
            <span class="notice_check blind" tabindex="0" style="display:none;">다음 버튼 이후에 공지사항이 있으니 들어주세요.</span>
			
			
			<div class="btn_area">
				
				<button type="button" class="btn_gray ma_r5" id="usrCancel" >취소</button>
				
				<button type="button" class="btn_color disable" id="cardNext" aria-label="카드사 새창에서 결제정보를 입력하면 결제내역화면으로 넘어갑니다.">다음</button>
			</div>
		</div>
		<!--//footer-->
		
		<div class="loading">
			
			<img src="/images/loading_blue.gif" alt=""><br>
			잠시만 기다려 주십시오.
		</div>
		
		<div id="CARD_CERT_DIV" class="layerCon_elsepay" role="dialog" style="display:none;">
			<div id="CARD_CERT_IFR_BAR" class="popComTitle" style="background-color: rgb(12, 12, 12);">
				<a href="javascript:;" class="btn_close" id="btnClose_pay_ifr">카드사창 닫기</a>
			</div>
		</div>
		
		
		<div id="KCP_TERMS_DIV" class="layerCon_elsepay" role="dialog" style="display:none;">
		</div>
		
		<div id="CARD_COUP_DIV" aria-hidden="true" style="width:0px;height:0px;display:none;"></div>		
		
		
		

    
    <div class="nppfs-keypad-div"><div id="nppfs-keypad-card_num3" class="nppfs-keypad" data-width="259" data-height="172" style="display: none;">
<style type="text/css">
	#nppfs-keypad-card_num3 .kpd-wrap { position:relative; width:259px; height:172px; }
	#nppfs-keypad-card_num3 .kpd-image { background-image:url('https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=5312e46984120a14ddcbe12e945d027ce172efce3ff87568ae9581a81bed4decc1905763c3b04afbbbd1312f5f938dcd653e5448cc87aef731880231f4cb1818ddb2ecd4fd3c4721c732792bcacea35ba2db75d2052d1949767195d356890b80&pi=N'); background-repeat:no-repeat; background-position:0px 0px; }
	#nppfs-keypad-card_num3 .kpd-button { position:absolute; width:undefinedpx; height:undefinedpx; overflow:hidden; /* border:1px solid #f88; */ }
</style>
<div class="kpd-wrap kpd-image">
<div class="kpd-group number">
<div class="kpd-button kpd-image kpd-cmd " data-action="action:delete" data-left="23" data-top="122" data-width="34" data-height="34" data-pos-x="0" data-pos-y="210" style=" left:23px; top:122px; width: 34px; height: 34px; background-position: -0px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:clear" data-left="58" data-top="122" data-width="34" data-height="34" data-pos-x="36" data-pos-y="210" style=" left:58px; top:122px; width: 34px; height: 34px; background-position: -36px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:refresh" data-left="128" data-top="122" data-width="34" data-height="34" data-pos-x="72" data-pos-y="210" style=" left:128px; top:122px; width: 34px; height: 34px; background-position: -72px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:close" data-left="217" data-top="3" data-width="34" data-height="34" data-pos-x="108" data-pos-y="210" style=" left:217px; top:3px; width: 34px; height: 34px; background-position: -108px -210px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:f782b8952117ad3336881e5427becdbf9ac6f204:1" data-left="23" data-top="52" data-width="34" data-height="34" data-pos-x="0" data-pos-y="174" style=" left:23px; top:52px; width: 34px; height: 34px; background-position: -0px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:2e8923d4e2b51713656e673ba1d031ce17a062f2:1" data-left="58" data-top="52" data-width="34" data-height="34" data-pos-x="36" data-pos-y="174" style=" left:58px; top:52px; width: 34px; height: 34px; background-position: -36px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:adf92b0e9c393632633cbbac9bcc1ecd282c250d:1" data-left="93" data-top="52" data-width="34" data-height="34" data-pos-x="72" data-pos-y="174" style=" left:93px; top:52px; width: 34px; height: 34px; background-position: -72px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:74ac05cbf1773949753a23532980c96b65c27cdf:1" data-left="163" data-top="52" data-width="34" data-height="34" data-pos-x="108" data-pos-y="174" style=" left:163px; top:52px; width: 34px; height: 34px; background-position: -108px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:19eeb16c8f45c8ba2326fccca2a24b32273f8a88:1" data-left="198" data-top="52" data-width="34" data-height="34" data-pos-x="144" data-pos-y="174" style=" left:198px; top:52px; width: 34px; height: 34px; background-position: -144px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:7ae000c330b24fed2cb866629719c87addfd5df2:1" data-left="23" data-top="87" data-width="34" data-height="34" data-pos-x="180" data-pos-y="174" style=" left:23px; top:87px; width: 34px; height: 34px; background-position: -180px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:12cd30ef1b0458af12557d276cac4956d4f8d18d:1" data-left="58" data-top="87" data-width="34" data-height="34" data-pos-x="216" data-pos-y="174" style=" left:58px; top:87px; width: 34px; height: 34px; background-position: -216px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:69e16d231cae81362ba662be1896121fe73e6690:1" data-left="93" data-top="87" data-width="34" data-height="34" data-pos-x="252" data-pos-y="174" style=" left:93px; top:87px; width: 34px; height: 34px; background-position: -252px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:d396e483a07dace8c6cb611cced9c242431f2b15:1" data-left="163" data-top="87" data-width="34" data-height="34" data-pos-x="288" data-pos-y="174" style=" left:163px; top:87px; width: 34px; height: 34px; background-position: -288px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:3ead7f09f0792b9f799914d8caa7ff97824260b3:1" data-left="198" data-top="87" data-width="34" data-height="34" data-pos-x="324" data-pos-y="174" style=" left:198px; top:87px; width: 34px; height: 34px; background-position: -324px -174px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:enter" data-left="163" data-top="122" data-width="69" data-height="33" data-pos-x="0" data-pos-y="246" style=" left:163px; top:122px; width: 69px; height: 33px; background-position: -0px -246px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="128" data-top="52" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:128px; top:52px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="128" data-top="87" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:128px; top:87px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="93" data-top="122" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:93px; top:122px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
</div>
</div>
</div><div id="nppfs-keypad-card_num4" class="nppfs-keypad" data-width="259" data-height="172" style="display: none;">
<style type="text/css">
	#nppfs-keypad-card_num4 .kpd-wrap { position:relative; width:259px; height:172px; }
	#nppfs-keypad-card_num4 .kpd-image { background-image:url('https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=b0e2bc9a8546471fc2219163461ec0762c0ac244d3d5dd199f8385cb36b70cbaf7d8d6e6af40ef181555a89de50d78b84218bee0e139fcd4675f60b50838d6cbef7faa6197c255b1bea53a4a7b06996a719b655bcc8e61877b610f719f115c0d&pi=N'); background-repeat:no-repeat; background-position:0px 0px; }
	#nppfs-keypad-card_num4 .kpd-button { position:absolute; width:undefinedpx; height:undefinedpx; overflow:hidden; /* border:1px solid #f88; */ }
</style>
<div class="kpd-wrap kpd-image">
<div class="kpd-group number">
<div class="kpd-button kpd-image kpd-cmd " data-action="action:delete" data-left="23" data-top="122" data-width="34" data-height="34" data-pos-x="0" data-pos-y="210" style=" left:23px; top:122px; width: 34px; height: 34px; background-position: -0px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:clear" data-left="93" data-top="122" data-width="34" data-height="34" data-pos-x="36" data-pos-y="210" style=" left:93px; top:122px; width: 34px; height: 34px; background-position: -36px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:refresh" data-left="128" data-top="122" data-width="34" data-height="34" data-pos-x="72" data-pos-y="210" style=" left:128px; top:122px; width: 34px; height: 34px; background-position: -72px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:close" data-left="217" data-top="3" data-width="34" data-height="34" data-pos-x="108" data-pos-y="210" style=" left:217px; top:3px; width: 34px; height: 34px; background-position: -108px -210px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:86e91e6932f2b76e7dded1e952a00d80cf8c97ad:1" data-left="23" data-top="52" data-width="34" data-height="34" data-pos-x="0" data-pos-y="174" style=" left:23px; top:52px; width: 34px; height: 34px; background-position: -0px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:4cbb661554f7ed685b6bef54b17601bc14ccc7bf:1" data-left="58" data-top="52" data-width="34" data-height="34" data-pos-x="36" data-pos-y="174" style=" left:58px; top:52px; width: 34px; height: 34px; background-position: -36px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:3214a96aa27bf66e05c5ced17ff6d76be61a5fec:1" data-left="93" data-top="52" data-width="34" data-height="34" data-pos-x="72" data-pos-y="174" style=" left:93px; top:52px; width: 34px; height: 34px; background-position: -72px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:a732155cfd2b452b0bd74912105c05f494f8e77c:1" data-left="163" data-top="52" data-width="34" data-height="34" data-pos-x="108" data-pos-y="174" style=" left:163px; top:52px; width: 34px; height: 34px; background-position: -108px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:f70d60eeb0291e1c6e2972ff2311ac6364ae0490:1" data-left="198" data-top="52" data-width="34" data-height="34" data-pos-x="144" data-pos-y="174" style=" left:198px; top:52px; width: 34px; height: 34px; background-position: -144px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:b5255e157cffe815a5f086d096d7e3cb42deafdd:1" data-left="23" data-top="87" data-width="34" data-height="34" data-pos-x="180" data-pos-y="174" style=" left:23px; top:87px; width: 34px; height: 34px; background-position: -180px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:d99d3c92ac5e1455bfbe52cc483d2b9470cf9cf3:1" data-left="58" data-top="87" data-width="34" data-height="34" data-pos-x="216" data-pos-y="174" style=" left:58px; top:87px; width: 34px; height: 34px; background-position: -216px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:00feebf5dafd55a9c39b794760fad01a08610091:1" data-left="128" data-top="87" data-width="34" data-height="34" data-pos-x="252" data-pos-y="174" style=" left:128px; top:87px; width: 34px; height: 34px; background-position: -252px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:b10516da2f4b991ceadad67eff5b61495562a9be:1" data-left="163" data-top="87" data-width="34" data-height="34" data-pos-x="288" data-pos-y="174" style=" left:163px; top:87px; width: 34px; height: 34px; background-position: -288px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:bd5e84ca6f88e870c640a8572433493b908e15dd:1" data-left="198" data-top="87" data-width="34" data-height="34" data-pos-x="324" data-pos-y="174" style=" left:198px; top:87px; width: 34px; height: 34px; background-position: -324px -174px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:enter" data-left="163" data-top="122" data-width="69" data-height="33" data-pos-x="0" data-pos-y="246" style=" left:163px; top:122px; width: 69px; height: 33px; background-position: -0px -246px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="128" data-top="52" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:128px; top:52px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="93" data-top="87" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:93px; top:87px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="58" data-top="122" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:58px; top:122px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
</div>
</div>
</div></div>

</form>
		
		
		
		





				
	</div>

<script>
	
	$('#chk_all').click(function(){
		$('.chk_agree input').prop({checked:$(this).prop('checked')});
		
	});
	setInterval(function(){
		if($('#chk_agree2').prop('checked')&&$('#chk_agree1').prop('checked')){
			$('#cardNext').removeClass('disable')
		}
			else{
			$('#cardNext').addClass('disable')
			}
	});

	$('#cardNext').click(function(){
		if($(this).hasClass('disable')){
			alert('약관 및 이용에 동의해주십시오.');
			return false;
		}
		if($('#upgu').val()==''){
			/*alert('입금자명을 입력해주십시오.');
			return false;*/
		}
		openLoading();
		setTimeout(function(){
	
		 location.href='/user/estimate?order=1&wish_date=<?=$param['wish_date']?>&product_no=<?=$param['product_no']?>&pay_date=<?=$param['pay_date']?>'
	},2500);
 
 
	});

	

	function openLoading(){
		$('.content,.footer').hide();
		$('.loading').show();
	}
	function closeLoading(){
		$('.content,.footer').show();
		$('.loading').hide();
	}
</script>
	<style>

	#contentsWrap{
		position: fixed;z-index: 9999;
		top: 50%;;
		left: 50%;
		margin-left: -380px;
		margin-top: -250px;;
	}
		/*! CSS Used from: https://spay.kcp.co.kr/css/kcp_common.css?version=20200407 */
div,ul,li,h1,form,input,select,button,span{margin:0;padding:0;}
input,button,select{overflow:hidden;font-family:'나눔바른고딕','NanumBarunGothic',NanumBarunGothic,'돋움',dotum,Helvetica,sans-serif;font-size:12px;color:#5e5e5e;-webkit-text-size-adjust:none;font-weight:400;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}
img{border:0 none;vertical-align:top;}
ul,li{list-style:none;}
button{overflow:visible;border:0 none;background-color:transparent;cursor:pointer;}
input,select{width:100%;max-width:100%;padding:2px 10px;margin-right:0;height:28px;line-height:auto;border:1px solid #b2b1b1;border-radius:0;}
button{-webkit-appearance:none;margin-right:0;border-radius:0;}
button::-moz-focus-inner{padding:0;border:0;}
em{font-style:normal;}
a,a:focus,a:active,a:hover{color:#000;text-decoration:none;}
input[type="text"]::-webkit-input-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]:-moz-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]::-moz-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]:-ms-input-placeholder{color:#828282;letter-spacing:1px;}
input::-ms-clear{display:none;}
input:focus,select:focus{border:1px solid #000;position:relative;z-index:9;color:#000;}

.chk_box input[type="checkbox"]{position:absolute;width:15px;height:15px;overflow:hidden;margin:0;padding:0;;;z-index:5;}
.chk_box label{display:inline-block;padding-left:18px;line-height:18px;}
.chk_box{position:relative;}
.chk_box input[type="checkbox"] + label .chk_ico{display:inline-block;position:absolute;left:0;top:2px;width:16px;height:15px;vertical-align:middle;color:#5e5e5e;z-index:-1;}
.input_area{position:relative;display:block;}
.input_txt{font-size:12px;font-weight:500;line-height:auto;vertical-align:top;background:#fff;color:#5e5e5e;}
.input_w1{width:325px;}
.input_area .ic_slock{width:11px;height:11px;position:absolute;top:9px;right:6px;}
.input_col4 .input_area{float:left;}
.input_col4 .input_area{width:86px;}
.input_col4 .input_area:first-child{width:87px;}
.input_col4 .input_txt{padding:0;text-align:center;height:32px;}
select{-webkit-appearance:none;-moz-appearance:none;appearance:none;background:url(https://spay.kcp.co.kr/img/sel_arrow_off.gif) no-repeat 95% 50%;background-color:#fff;color:#5e5e5e;}
select::-ms-expand{display:none;}
select:focus{background:url(https://spay.kcp.co.kr/img/sel_arrow_on.gif) no-repeat 95% 50%;background-color:#fff;}
.blind{overflow:hidden;position:absolute;top:0;left:0;width:1px;height:1px;font-size:0;line-height:100px;white-space:nowrap;}
.sp{overflow:hidden;display:inline-block;line-height:200px;text-indent:-9999em;vertical-align:top;background:url(https://spay.kcp.co.kr/img/sp.png) no-repeat;}
.ir{overflow:hidden;text-indent:-9999em;}
.ma_t15{margin-top:15px!important;}
.ma_r5{margin-right:5px!important;}
.fl_l{float:left;}
.fl_r{float:right;}
.t_over{-webkit-text-overflow:ellipsis;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.col_cont,.form_row{*zoom:1;position:relative;}
.col_cont:after,.form_row:after,.price:after{display:block;clear:both;content:'';}
.form_row{position:relative;clear:both;width:100%;}
.skip{height:0;}
.skip a{display:block;position:absolute;left:0;top:-100px;width:100%;height:1px;text-align:center;}
.skip a:focus,.skip a:active{position:absolute;top:0;z-index:120;height:35px;padding:10px 0 0;background:#5e5e5e;color:#fff;font-size:1.4em;font-weight:700;}
.wrap{width:760px;height:570px;border-radius:4px;background:#fff;position:absolute;z-index:2;}
.header{height:25px;border-radius:4px 4px 0 0;font-size:12px;line-height:17px;color:#fff;padding:4px 25px 2px;position:relative;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
.content{padding:0 25px;width:710px;height:434px;position:relative;}
.footer{width:100%;min-height:55px;position:relative;background:#f3f3f4;border-radius:0 0 4px 4px;text-align:center;}
.help{position:absolute;right:25px;top:5px;}
.help a{color:#fff;text-decoration:none;}
.dot{width:2px;height:2px;background-position:-15px 0px;margin:7px 2px 0 3px;}
.logo{margin:10px 25px 0;position:relative;height:36px;line-height:36px;font-size:12px;font-weight:700;color:#1a1a1a;}
.logo_t{width:180px;display:inline-block;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.location{line-height:36px;font-size:12px;height:20px;position:absolute;right:0px;top:0px;}
.location a{padding-left:10px;color:#5e5e5e;font-weight:normal;}
.location a:hover{color:#1a1a1a;}
.price{border:1px solid #ebeaea;max-height:50px;margin-top:10px;position:relative;font-size:12px;line-height:17px;overflow:hidden;}
.price .p_w1{width:310px;float:left;padding:6px 0 4px;}
.price .p_w2{width:175px;float:left;padding:6px 0 4px;}
.last_price{position:absolute;right:0;width:204px;height:44px;text-align:center;background:#f5f4f4;border-left:1px solid #ebeaea;color:#1a1a1a;padding-top:6px;}
.txt_price{color:#eb2525;font-weight:bold;font-size:13px;}
.txt_price em{font-size:20px;line-height:22px;position:relative;top:0px;margin-right:2px;}
.price .p_w1 .col_tit{float:left;color:#5e5e5e;margin:0 5px 0 20px;width:83px;}
.price .p_w2 .col_tit{float:left;color:#5e5e5e;margin:0 5px 0 0px;width:60px;}
.price .col_cont{width:192px;padding-right:10px;color:#1a1a1a;display:inline-block;float:left;}
.con_price{color:#1a1a1a;font-weight:700;width:102px;text-align:right;display:inline-block;float:right;}
.p_row{height:20px;line-height:20px;}
.con{position:relative;margin-top:15px;}
.con .tit{font-size:15px;color:#000000;padding-top:5px;padding-bottom:13px;display:block;font-weight:700;}
.sel_box{font-size:12px;line-height:20px;margin-top:10px;}
.icon2{font-size:12px;position:absolute;left:0;top:320px;margin-top:3px;}
.bn1{position:absolute;bottom:0px;right:25px;}
.link_month{display:inline-block;text-decoration:underline;color:#5e5e5e;}
.link_month a{color:#5e5e5e;}
.card{text-align:center;font-size:12px;color:#707070;margin-top:-4px;}
.card a{color:#707070;}
.sel_w2{width:117px;height:32px;line-height:32px;border:1px solid #ebeaea;display:inline-block;float:left;margin-top:-1px;margin-left:-1px;z-index:3;text-align:left;}
.sel_w2 .sel_w2_bg{width:117px;height:32px;position:relative;}
.sel_w2 .sel_w2_bg a{padding-left:8px;}
.sel_w2_bg ul{width:117px;position:relative;top:0px;right:1px;z-index:30;max-height:150px;background:#fff;overflow-y:scroll;}
.sel_w2_bg li{line-height:30px;background:#fff;z-index:30;}
.sel_w2_bg li a{display:block;}
.sel_w2_bg li a:hover{display:block;background:#f3f3f4;}
.sel_w2_bg .area_icon{margin-left:1px;position:relative;top:-2px;}
.w1{width:117px;height:32px;line-height:32px;border:1px solid #ebeaea;display:inline-block;float:left;margin-top:-1px;margin-left:-1px;z-index:3;}
.w1:first-child{width:118px;margin-left:0px;}
.area_icon{margin-left:1px;}
.w1 a,.sel_w2_bg a{display:block;}
.b2b_bn{width:100%;}
.bn_pay1,.bn_card{width:100%;height:100%;display:block;clear:both;}
.b2b_w1,.b2b_w3{display:table;}
.bn_pay1 .b2b_w1{width:708px;height:50px;border:1px solid #ebeaea;text-align:left;float:left;position:relative;margin-top:-1px;margin-left:0px;z-index:3;display:block;}
.bn_pay1 .b2b_w1 .b2b_w1_table{width:708px;height:50px;display:table-cell;vertical-align:middle;position:relative;}
.bn_pay1 .b2b_w1 .linkArea{display:block;}
.bn_pay1 .b2b_w1 .card_bn_logo{display:inline-block;margin:3px 0 0px 12px;color:#1a1a1a;font-size:13px;font-weight:bold;line-height:24px;float:left;position:relative;}
.bn_pay1 .b2b_w1 .card_bn_txt{display:inline-block;width:300px;float:left;margin:6px 0 0px 10px;color:#f91313;font-size:12px;line-height:17px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.b2b_w1_table .area_icon{position:absolute;top:19px;right:10px;height:14px;}
.bn_card .b2b_w3{width:353px;height:40px;border:1px solid #ebeaea;text-align:left;float:left;position:relative;margin-top:-1px;margin-left:-1px;z-index:3;display:block;overflow:hidden;}
.bn_card .b2b_w3:first-child{width:354px;margin-left:0px;}
.bn_card .b2b_w3 .b2b_w3_table{width:354px;height:40px;display:table-cell;vertical-align:middle;position:relative;}
.bn_card .b2b_w3 .linkArea{display:block;}
.bn_card .b2b_w3 .card_bn_logo{display:inline-block;margin:2px 0 0px 12px;color:#1a1a1a;font-size:12px;font-weight:bold;line-height:24px;float:left;position:relative;}
.bn_card .b2b_w3 .card_bn_txt{display:inline-block;width:254px;float:left;margin:5px 0 0px 4px;color:#707070;font-size:12px;line-height:20px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.b2b_w3_table .area_icon{position:absolute;top:14px;right:10px;height:14px;}
.bn_pay1 .b2b_w1 .linkArea:focus,.bn_card .b2b_w3 .linkArea:focus{background:none;opacity:100;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";}
.ic_icon{position:relative;top:0px;padding-right:3px;}
.ic_icon1{padding-left:3px;float:left;}
.ic_icon2{position:relative;top:10px;}
.ic_notice{width:12px;height:12px;background-position:0px -17px;vertical-align:middle;margin:-3px 2px 0;z-index:9;}
.ic_arrow{position:absolute;top:2px;right:4px;}
.ic_required{width:5px;height:5px;background-position:-59px -17px;vertical-align:middle;margin:-3px 3px 0;}
.ic_slock{width:11px;height:11px;position:absolute;top:9px;right:4px;}
.bank_logo em{display:inline-block;}
.bank_logo img{display:none;}
.w1:hover .bank_logo em{display:none;}
.w1:hover .bank_logo img{display:inline-block;height:16px;margin-top:7px;}
.select_month{height:34px;width:120px;float:left;border:1px solid #959595;margin-right:20px;}
.sel_card_month2{width:170px;height:34px;border:1px solid #b2b1b1;color:#707070;font-size:12px;margin-right:7px;float:left;}
.sel_card_month3{width:170px;height:34px;border:1px solid #b2b1b1;color:#707070;font-size:12px;float:left;}
.chk_txt{margin-top:8px;margin-right:20px;float:left;}
.chk_agree{color:#1a1a1a;font-weight:700;font-size:13px;line-height:18px;padding-top:2px;}
.ic_view{width:3px;height:7px;background-position:-54px -17px;vertical-align:middle;margin:-3px 3px 0;}
.agree_new{border:1px solid #ebeaea;height:42px;width:708px;margin-top:-5px;margin-bottom:15px;}
.agree_new .tit{font-size:13px;line-height:42px;margin-left:18px;height:20px;padding-top:0;float:left;}
.agree_new .agree_chk_bg{position:absolute;top:0px;right:10px;}
.agree_new .chk_agree_all{color:#1a1a1a;font-weight:700;font-size:11px;line-height:18px;float:left;margin:12px 4px 11px 10px;}
.agree_new .view_agree{color:#5e5e5e;font-size:11px;float:left;line-height:18px;margin:13px 20px 0 5px;}
.agree_new .view_agree a{color:#5e5e5e;}
.agree_new .chk_agree{color:#707070;font-weight:normal;font-size:11px;line-height:18px;float:left;margin:12px 5px 11px 8px;}
.account_w{width:347px;margin-bottom:10px;position:relative;}
.account_tit{color:#1a1a1a;font-size:13px;display:block;margin-bottom:4px;}
.account_r{position:absolute;top:0;right:0px;color:#5e5e5e;font-size:12px;}
.account_r a{color:#5e5e5e;}
.txt_foreign{color:#ff0000;font-size:11px;width:170px;text-align:right;position:absolute;top:1px;left:540px;z-index:3;}
.btn_area{position:absolute;top:0px;right:0px;padding:10px 25px 11px 0;width:426px;height:35px;text-align:right;}
.btn_area:after{display:block;clear:both;content:'';}
.btn_gray,.btn_color{overflow:hidden;display:inline-block;color:#fff;font-size:15px;font-weight:700;text-align:center;border:none;}
.disable{background:#585858;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=15)";filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=15);opacity:0.15;}
.disable:focus{-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=100);opacity:1;}
.btn_gray,.btn_color{background:#8f8f8f;width:158px;height:35px;border-radius:3px;}
.btn_gray:hover{background:#5a5a5a;}
.layerCon_elsepay{background:#fff;padding:0px 0px 4px;z-index:500;position:relative;border:1px solid #000;border-radius:4px;}
.popComTitle{position:relative;top:0px;height:30px;background:#000;border-radius:4px 4px 0 0px;}
.popComTitle a.btn_close{cursor:pointer;position:absolute;right:7px;top:6px;display:inline-block;width:18px;height:18px;line-height:17px;color:#fff;text-align:center;overflow:hidden;text-indent:-9999em;vertical-align:top;background:url(https://spay.kcp.co.kr/img/btn_pop_close2_on.png) no-repeat 0 0;}
.popComTitle a.btn_close:hover{cursor:pointer;background:url(https://spay.kcp.co.kr/img/btn_pop_close2_off.png) no-repeat;background-color:#fff;}
.notice_check{display:none;}
@media \0screen{
input,button,select{font-family:'돋움',dotum,arial,Helvetica,sans-serif;}
img{-ms-interpolation-mode:bicubic;}
input,select{line-height:28px!important;}
.input_txt{line-height:28px!important;}
select{background:none;background-color:#fff;padding:3px 3px 5px;}
select::-ms-expand{display:none;}
select:focus{background:none;background-color:#fff;}
.ic_icon{position:relative;top:0px;padding-top:0px;padding-right:2px;}
.agree_new .tit{line-height:42px;margin-left:18px;float:left;font-size:12px;letter-spacing:-1px;}
.agree_new .agree_chk_bg{float:right;margin-right:15px;letter-spacing:-1px;font-size:11px;}
.chk_box input[type="checkbox"]{width:16px;height:15px;}
}
@media screen and (-ms-high-contrast:active), (-ms-high-contrast:none){
.content{padding:0 24px;height:434px;position:relative;}
}
/*! CSS Used from: https://spay.kcp.co.kr/css/skin/color_blue.css */
.header_color{background:#207bba;}
.location .on,.location .on:hover{color:#207bba;font-weight:bold;}
.b2b_w1:hover,.b2b_w3:hover,.w1:hover{border:1px solid #207bba;background:#e8fcff;color:#333;position:relative;z-index:10;}
.sel_w2_bg:hover{border:1px solid #207bba;background:#e8fcff;color:#333;position:relative;z-index:10;top:-1px;left:-1px;}
.sel_w2_bg ul{border:1px solid #207bba;}
.btn_color{background:#207bba;}
.btn_color:hover,.disable:focus{background:#1a5d8c;}
/*! CSS Used from: Embedded */
div.nppfs-keypad-div{position:absolute;display:none;width:0px;height:0px;}
div.nppfs-keypad{position:relative;margin:0px;z-index:9999;}
div.nppfs-keypad .kpd-group{width:0px;height:0px;}
div.nppfs-keypad .kpd-button{cursor:pointer;}
div.nppfs-keypad .kpd-blank{cursor:default;}
/*! CSS Used from: Embedded */
#nppfs-keypad-card_num3 .kpd-wrap{position:relative;width:259px;height:172px;}
#nppfs-keypad-card_num3 .kpd-image{background-image:url(https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=5312e46984120a14ddcbe12e945d027ce172efce3ff87568ae9581a81bed4decc1905763c3b04afbbbd1312f5f938dcd653e5448cc87aef731880231f4cb1818ddb2ecd4fd3c4721c732792bcacea35ba2db75d2052d1949767195d356890b80&pi=N);background-repeat:no-repeat;background-position:0px 0px;}
#nppfs-keypad-card_num3 .kpd-button{position:absolute;width:undefinedpx;height:undefinedpx;overflow:hidden;}
/*! CSS Used from: Embedded */
#nppfs-keypad-card_num4 .kpd-wrap{position:relative;width:259px;height:172px;}
#nppfs-keypad-card_num4 .kpd-image{background-image:url(https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=b0e2bc9a8546471fc2219163461ec0762c0ac244d3d5dd199f8385cb36b70cbaf7d8d6e6af40ef181555a89de50d78b84218bee0e139fcd4675f60b50838d6cbef7faa6197c255b1bea53a4a7b06996a719b655bcc8e61877b610f719f115c0d&pi=N);background-repeat:no-repeat;background-position:0px 0px;}
#nppfs-keypad-card_num4 .kpd-button{position:absolute;width:undefinedpx;height:undefinedpx;overflow:hidden;}
/*! CSS Used fontfaces */
@font-face{font-family:'NanumBarunGothic';font-style:normal;font-weight:400;src:local(※),          url(https://cdn.kcp.co.kr/font/NanumBarunGothic.woff) format('woff');}
@font-face{font-family:'NanumBarunGothic';font-style:normal;font-weight:700;src:local(※),          url(https://cdn.kcp.co.kr/font/NanumBarunGothicBold.woff) format('woff');}

	</style>
	<?php
}	
?>
 <main class="site-main site-login">
        <div class="box-center box-center-2">
            <div class="toolbar-products">
                <h4 class="title-product">견적서</h4>
            </div>
            <table class="search-list-table">
                <thead>
                <tr>
                    <th>CATEGORY</th>
                    <th>DESCRIPTION</th>
                 
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                </tr>
                </thead>
                <tbody>
			  <?php
			  $totalPrice=0;
			  $feePrice=0;

			  
						

						


					foreach($carts['list'] as $cart){

						if($cart['grade']=='A'){
							if($cart['price']*$cart['amount']>=100000000){
								$fee=$cart['price']*$cart['amount']*0.0774;
							}
							else if($cart['price']*$cart['amount']>=50000000){
								$fee=$cart['price']*$cart['amount']*0.0815;
							}
							else if($cart['price']*$cart['amount']>=10000000){
								$fee=$cart['price']*$cart['amount']*0.0857;
							}
							else if($cart['price']*$cart['amount']>=5000000){
								$fee=$cart['price']*$cart['amount']*0.0903;
							}
							else if($cart['price']*$cart['amount']>=1000000){
								$fee=$cart['price']*$cart['amount']*0.0950;
							}
							else{
									$fee+=$cart['price']*$cart['amount']*0.1;
							}
						}
						if($cart['grade']=='B'){
							
							if($cart['price']*$cart['amount']>100000000){
								$fee=$cart['price']*$cart['amount']*0.1161;
							}
							else if($cart['price']*$cart['amount']>=50000000){
								$fee=$cart['price']*$cart['amount']*0.1222;
							}
							else if($cart['price']*$cart['amount']>=10000000){
								$fee=$cart['price']*$cart['amount']*0.1286;
							}
							else if($cart['price']*$cart['amount']>=5000000){
								$fee=$cart['price']*$cart['amount']*0.1354;
							}
							else if($cart['price']*$cart['amount']>=1000000){
								$fee=$cart['price']*$cart['amount']*0.1425;
							}
							else{
									$fee=$cart['price']*$cart['amount']*0.15;
							}
						}
						if($cart['grade']=='C'){
							if($cart['price']*$cart['amount']>=100000000){
								$fee=$cart['price']*$cart['amount']*0.1548;
							}
							else if($cart['price']*$cart['amount']>=50000000){
								$fee=$cart['price']*$cart['amount']*0.1629;
							}
							else if($cart['price']*$cart['amount']>=10000000){
								$fee=$cart['price']*$cart['amount']*0.1715;
							}
							else if($cart['price']*$cart['amount']>=5000000){
								$fee=$cart['price']*$cart['amount']*0.1805;
							}
							else if($cart['price']*$cart['amount']>=1000000){
								$fee=$cart['price']*$cart['amount']*0.19;
							}
							else{
									$fee=$cart['price']*$cart['amount']*0.2;
							}
						}
						$feePrice+=$fee;
						$cart['details']=json_decode( $cart['details'],true);
						$cart['details']['package_type']=null;
						$cart['details']['delivery_type']=null;
						$cart['details']['Submit']=null;
					//	$cart['details']['product_type']=null;
						$cart['details']['has_data']=null;
						if($cart['details']['category']==''){
						continue;
						}
						$totalPrice = $totalPrice+($cart['price']*$cart['amount']);
				?>
                <tr>
                    <th scope="row"><?=$cart['details']['category']?></th>
                    <th class="product_detail">
						<?php
				
echo displayEssentialField($cart['details']['category'],$cart['details']);
				?>


                    </th>
                  
                    <td><?=$cart['amount']?> (<?=$cart['grade']?>)</td>
                    <td><?=number_format($cart['price']*$cart['amount'] + $fee)?></td>
                </tr>
				<?php

						

}

						$discountRate = 0;
						if($totalPrice  + $feePrice  > 99999999){
						$discountRate = 0.045;
						}
						else if($totalPrice  + $feePrice  > 79999999){
							$discountRate = 0.040;
						}
						else if($totalPrice  + $feePrice  > 59999999){
							$discountRate = 0.035;
						}
						else if($totalPrice  + $feePrice  > 29999999){
							$discountRate = 0.030;
						}
						else if($totalPrice  + $feePrice  > 9999999){
							$discountRate = 0.025;
						}
						else if($totalPrice  + $feePrice  > 7999999){
							$discountRate = 0.020;
						}
						else if($totalPrice  + $feePrice  > 5999999){
							$discountRate = 0.015;
						}
						else if($totalPrice  + $feePrice  > 2999999){
							$discountRate = 0.01;
						}
						else if($totalPrice  + $feePrice  > 1000000){
							$discountRate = 0.005;
						}


				?>
              
                </tbody>
            </table>
            <p class="estimate-cart-guide">* 상기 테이블에서 다운로드 가능한 성적서는 결제 진행 후, 등록하신 메일로 한 번에
                보내 드립니다.</p>
            <div class="cart-tooltip">
                <p>가장 빠른 운송 일정을 제공해 드렸습니다!
                    모든 제품이 동일한 일정으로 운송되는 것이 더 편하신가요?</p>
            </div>
			<div id="total_wrap">
				<div class="estimate-sheet-amount sub_amount">
					<div class="box-price"><span class="text-label">합계</span>
						<span class="box-format-amount"> <strong class="text-value" id="tprice"><?=number_format($totalPrice+$feePrice)?></strong>
							<span class="text-unit">원</span></span>
					</div>
				</div>
				<div class="estimate-sheet-amount sub_amount">
					<div class="box-price"><span class="text-label">할인률</span>
						<span class="box-format-amount"> <strong class="text-value" id="tprice_discount"> <?=$discountRate*100?></strong>
							<span class="text-unit">%</span></span>
					</div>
				</div>
				<div class="estimate-sheet-amount main_amount">
					<div class="box-price"><span class="text-label">총액</span>
						<span class="box-format-amount"> <strong class="text-value" id="tprice_result"><?=number_format(($totalPrice+$feePrice)*(1-$discountRate))?></strong>
							<span class="text-unit">원</span></span>
					</div>
				</div>

			</div>
            
            <button type="submit" class="btn-checkout estimate-sheet-buy">
                <span>구매하기</span>
            </button>
        </div>
    </main>
<script>
/*
	var doc = new jsPDF();
doc.text(20, 20, 'Hello world!');
doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
doc.addPage();
doc.text(20, 20, 'Do you like that?');

doc.save('Test.pdf');
*/
$('.estimate-sheet-buy').click(function(){
Swal.fire({
  title: '<strong>견적서 내용대로 주문하시겠습니까?</strong>',
  icon: 'info',
  html:
    '',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a href="#"  style="color:white;">확인</a>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '취소',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {
	
  if (result.value) {
	  $('#fog,#contentsWrap').fadeIn();
	setTimeout(function(){
		closeLoading();
		$('#pname').text($.trim($('.product_detail').eq(0).text()).substr(0,25)+'외 '+($('.product_detail').size()-1)+'건');
		$('#pay_price').text($('#tprice_result').text()+'원')
	},2500);
 // location.href='/user/estimate?order=1'
  }
})
});

$('#usrCancel').click(function(){
Swal.fire({
  title: '<strong>진행하시려던 거래가 취소됩니다. 거래를 취소할까요?</strong>',
  icon: 'info',
  html:
    '',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a href="#"  style="color:white;">확인</a>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '취소',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {
	
  if (result.value) {
	  $('#fog,#contentsWrap').fadeOut();
 // location.href='/user/estimate?order=1'
  }
})

	return false;
});




</script>

<style>
	.swal2-container{
z-index: 9999 !important;
}

</style>
<?php
include 'views/footer.html';
?>