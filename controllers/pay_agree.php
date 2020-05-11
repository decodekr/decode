





<!DOCTYPE html>

	
	
		<html lang="ko">
	

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<title>약관 및 이용동의</title>
	
	<link rel="stylesheet" href="/css/popup/kcp_pop.css">
	
	<script type="text/javascript" src="/js/comm/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/js/comm/comUtils.js"></script>
	
	<!-- Design Team javascript -->
	<link rel="stylesheet" href="/css/skin/color_blue.css" type="text/css">
	<script type="text/javascript" src="/js/skin/chk_blue.js"></script>
	
	<script type="text/javascript">
		var chk_all		= '';
		var chk_agree1	= '';
		var chk_agree2	= '';
		
		var isAllChecked	= false;
		var ALL_AGREE_CHK		= "";
		var AGREE_CHK	= "";
		var AGREE_CHK_UI	= "";
		var LANG			= "ko";
		var SKIN_COLOR		= "blue";
		
		$(window).bind('load', function(){
			
			SPayComUtil.setLang(LANG);
			SPayComUtil.setSkinColor(SKIN_COLOR);
			
			ALL_AGREE_CHK	= $(".chk_all > input[type='checkbox']");
			AGREE_CHK		= $(".chk_agree > input[type='checkbox']");
			AGREE_CHK_UI	= $(".chk_agree > label");
			
			if( chk_all == "on" )
			{
				SPayComUtil.setChkColorObj(ALL_AGREE_CHK);		
				isAllChecked = SPayComUtil.setAllAgreeTerms(ALL_AGREE_CHK, AGREE_CHK, AGREE_CHK_UI);
			}
			else
			{
				if( chk_agree1 == "on" )
				{
					var chkAgree1 = $("#chk_agree1");
					SPayComUtil.setChkColorObj(chkAgree1);					
				}
				
				if( chk_agree2 == "on" )
				{
					var chkAgree2 = $("#chk_agree2");
					SPayComUtil.setChkColorObj(chkAgree2);	
				}
				
				isAllChecked = SPayComUtil.setAgreeTerms(ALL_AGREE_CHK, AGREE_CHK);
			}
		});

		// 닫기버튼 클릭
		$(document).on("click", "#agreeClose", function(){
			window.open("", "_self");
			window.close();
		});
	
		// 전체동의 선택
		$(document).on("change", ".chk_all > input[type='checkbox']", function(){
			// 전체 동의 UI 설정( 전체동의 객체, 개별동의 객체, on 클래스 , skin color )			
			isAllChecked = SPayComUtil.setAllAgreeTerms(ALL_AGREE_CHK, AGREE_CHK, AGREE_CHK_UI);
		});
		
		// 일반동의 선택
		$(document).on("change", ".chk_agree > input[type='checkbox']", function() {
			isAllChecked = SPayComUtil.setAgreeTerms(ALL_AGREE_CHK, AGREE_CHK);
		});
		
		// 확인버튼 클릭.
		$(document).on("click", "#btnConfirm", function(){
			sendOpenerData();
		});
		
		// 데이터 전달.
		function sendOpenerData()
		{
			if( !SPayComUtil.isEmptyData(window.opener) && !window.opener.closed )
			{
				if(typeof window.opener.fnResCardAgreeInfo != "undefined" || typeof window.opener.fnResCardAgreeInfo != "unknown")
				{
					var frmAgree 	= $("#frmObj :input");
					var agreeJSON 	= SPayComUtil.convertFormToJson(frmAgree);
					
					// cardMethod.js 에 선언된 함수 호출.
					opener.fnResCardAgreeInfo(agreeJSON);	
					
					window.open("", "_self");
					window.close();
				}
				else
				{
					window.open("", "_self");
					window.close();
				}
			}
			else
			{
				window.open("", "_self");
				window.close();
			}
		}
	</script>
<head>

<body>
<style>
	
	.agree_box{
		
		overflow: auto;}
</style>
	<!--layer:For Center screen-->
	<div class="layer">
	    <div class="layer_inner">
	        <!--layerContent-->
	        <div class="layerCon w_agree">
	            <h1 id="con" class="tit">약관 및 이용동의</h1> 
	            
	            <span role="dialog" title="약관에 특수문자가 적용되어 있으니 스크린리더(센스리더) 단축키 alt+shift+'(어퍼스트로피)로 전체 특수문자 사전선택 적용하여 약관을 읽어 주세요."></span>
	            
	            <form id="frmObj" name="frmObj">
		            <!--이용약관동의-->
		            <div class="con_agree">
		            
						
						<div class="form_row">
							<div class="chk_box chk_agree">
								<input type="checkbox" id="chk_agree1" name="chk_agree1">
								<label for="chk_agree1" class="chkTerm"><span class="chk_ico"><img src="/ico_chk_default.png" alt="" /></span>전자금융거래 이용약관</label>
							</div>
							<div class="agree_box">
								<div class="box_m">
									
										약관내용 시작
제1조 (목적)
이 약관은 웰컴페이먼츠 주식회사(이하 '회사'라 합니다)가 제공하는 전자지급결제대행서비스 및 결제대금예치서비스를 이용자가 이용함에 있어 회사와 이용자 사이의 전자금융거래에 관한 기본적인 사항을 정함을 목적으로 합니다.

제2조 (용어의 정의)
이 약관에서 정하는 용어의 정의는 다음과 같습니다.
1.'전자금융거래'라 함은 회사가 전자적 장치를 통하여 전자지급결제대행서비스 및 결제대금예치서비스(이하 '전자금융거래 서비스'라고 합니다)를 제공하고, 이용자가 회사의 종사자와 직접 대면하거나 의사소통을 하지 아니하고 자동화된 방식으로 이를 이용하는 거래를 말합니다.
2.'전자지급결제대행서비스'라 함은 전자적 방법으로 재화의 구입 또는 용역의 이용에 있어서 지급결제정보를 송신하거나 수신하는 것 또는 그 대가의 정산을 대행하거나 매개하는 서비스를 말합니다.
3.'결제대금예치서비스'라 함은 이용자가 재화의 구입 또는 용역의 이용에 있어서 그 대가(이하 '결제대금'이라 한다)의 전부 또는 일부를 재화 또는 용역(이하 '재화 등'이라 합니다)을 공급받기 전에 미리 지급하는 경우, 회사가 이용자의 물품수령 또는 서비스 이용 확인 시점까지 결제대금을 예치하는 서비스를 말합니다.
4.'가맹점'이라 함은 금융기관 또는 전자금융업자와의 계약에 따라 직불전자지급수단이나 선불전자지급수단 또는 전자화폐에 의한 거래에 있어서 이용자에게 재화 또는 용역을 제공하는 자로서 금융기관 또는 전자금융업자가 아닌 자를 말합니다.
5.'이용자'라 함은 이 약관에 동의하고 회사가 제공하는 전자금융거래 서비스를 이용하는 자를 말합니다.
6.'접근매체'라 함은 전자금융거래에 있어서 거래지시를 하거나 이용자 및 거래내용의 진실성과 정확성을 확보하기 위하여 사용되는 수단 또는 정보로서 전자식 카드 및 이에 준하는 전자적 정보(신용카드번호를 포함한다), '전자서명법'상의 인증서, 회사에 등록된 이용자번호, 이용자의 생체정보, 이상의 수단이나 정보를 사용하는데 필요한 비밀번호 등 전자금융거래법 제2조 제10호에서 정하고 있는 것을 말합니다.
7.'거래지시'라 함은 이용자가 본 약관에 의하여 체결되는 전자금융거래계약에 따라 회사에 대하여 전자금융거래의 처리를 지시하는 것을 말합니다.
8.'오류'라 함은 이용자의 고의 또는 과실 없이 전자금융거래가 전자금융거래계약 또는 이용자의 거래지시에 따라 이행되지 아니한 경우를 말합니다.
제3조 (약관의 명시 및 변경)
①회사는 이용자가 전자금융거래 서비스를 이용하기 전에 이 약관을 게시하고 이용자가 이 약관의 중요한 내용을 확인할 수 있도록 합니다.
②회사는 이용자의 요청이 있는 경우 전자문서의 전송방식에 의하여 본 약관의 사본을 이용자에게 교부합니다.
③회사가 약관을 변경하는 때에는 그 시행일 1월 전에 변경되는 약관을 회사가 제공하는 전자금융거래 서비스 이용 초기화면 및 회사의 홈페이지에 게시함으로써 이용자에게 공지합니다. 다만, 법령의 개정으로 인하여 긴급하게 약관을 변경하는 경우에는 즉시 공지합니다.
④이용자가 변경된 약관사항에 동의하지 않는 경우에는 서비스의 이용이 불가하며 이용자는 이용 계약을 해지할 수 있습니다.
제4조 (전자지급결제대행서비스의 종류)
회사가 제공하는 전자지급결제대행서비스는 지급결제수단에 따라 다음과 같이 구별됩니다.
1.신용카드결제대행서비스: 이용자가 결제대금의 지급을 위하여 제공한 지급결제수단이 신용카드인 경우로서, 회사가 전자결제시스템을 통하여 신용카드 지불정보를 송,수신하고 결제대금의 정산을 대행하거나 매개하는 서비스를 말합니다.
2.계좌이체대행서비스: 이용자가 결제대금을 회사의 전자결제시스템을 통하여 금융기관에 등록한 자신의 계좌에서 출금하여 원하는 계좌로 이체할 수 있는 실시간 송금 서비스를 말합니다.
3.가상계좌서비스: 이용자가 결제대금을 현금으로 결제하고자 경우 회사의 전자결제시스템을 통하여 자동으로 이용자만의 고유한 일회용 계좌의 발급을 통하여 결제대금의 지급이 이루어지는 서비스를 말합니다.
4.기타: 회사가 제공하는 서비스로서 지급결제수단의 종류에 따라 '휴대폰 결제대행서비스', 'ARS결제대행서비스', '상품권결제대행서비스', '교통카드결제대행서비스' 등이 있습니다.
제5조 (결제대금예치서비스의 내용)
①이용자(이용자의 동의가 있는 경우에는 재화 등을 공급받을 자를 포함합니다. 이하 본조에서 같습니다)는 재화 등을 공급받은 사실을 재화 등을 공급받은 날부터 3영업일 이내에 회사에 통보하여야 합니다.
②회사는 이용자로부터 재화 등을 공급받은 사실을 통보받은 후 회사와 통신판매업자간 사이에서 정한 기일 내에 통신판매업자에게 결제대금을 지급합니다.
③회사는 이용자가 재화 등을 공급받은 날부터 3영업일이 지나도록 정당한 사유의 제시없이 그 공급받은 사실을 회사에 통보하지 아니하는 경우에는 이용자의 동의없이 통신판매업자에게 결제대금을 지급할 수 있습니다.
④회사는 통신판매업자에게 결제대금을 지급하기 전에 이용자에게 결제대금을 환급받을 사유가 발생한 경우에는 그 결제대금을 소비자에게 환급합니다.
⑤회사는 이용자와의 결제대금예치서비스 이용과 관련된 구체적인 권리,의무를 정하기 위하여 본 약관과는 별도로 결제대금예치서비스이용약관을 제정할 수 있습니다.
제6조 (이용시간)
①회사는 이용자에게 연중무휴 1일 24시간 전자금융거래 서비스를 제공함을 원칙으로 합니다. 단, 금융기관 기타 결제수단 발행업자의 사정에 따라 달리 정할 수 있습니다.
②회사는 정보통신설비의 보수, 점검 기타 기술상의 필요나 금융기관 기타 결제수단 발행업자의 사정에 의하여 서비스 중단이 불가피한 경우, 서비스 중단 3일 전까지 게시 가능한 전자적 수단을 통하여 서비스 중단 사실을 게시한 후 서비스를 일시 중단할 수 있습니다. 다만, 시스템 장애복구, 긴급한 프로그램 보수, 외부요인 등 불가피한 경우에는 사전 게시없이 서비스를 중단할 수 있습니다.
제7조 (접근매체의 선정과 사용 및 관리)
①회사는 전자금융거래 서비스 제공 시 접근매체를 선정하여 이용자의 신원, 권한 및 거래지시의 내용 등을 확인할 수 있습니다.
②이용자는 접근매체를 제3자에게 대여하거나 사용을 위임하거나 양도 또는 담보 목적으로 제공할 수 없습니다.
③이용자는 자신의 접근매체를 제3자에게 누설 또는 노출하거나 방치하여서는 안되며, 접근매체의 도용이나 위조 또는 변조를 방지하기 위하여 충분한 주의를 기울여야 합니다.
④회사는 이용자로부터 접근매체의 분실이나 도난 등의 통지를 받은 때에는 그 때부터 제3자가 그 접근매체를 사용함으로 인하여 이용자에게 발생한 손해를 배상할 책임이 있습니다.
제8조 (거래내용의 확인)
①회사는 이용자와 미리 약정한 전자적 방법을 통하여 이용자의 거래내용(이용자의 '오류정정 요구사실 및 처리결과에 관한 사항'을 포함합니다)을 확인할 수 있도록 하며, 이용자의 요청이 있는 경우에는 요청을 받은 날로부터 2주 이내에 모사전송 등의 방법으로 거래내용에 관한 서면을 교부합니다. 다만, 전자적 장치의 운영 장애, 그 밖의 사유로 거래내용을 제공할 수 없는 때에는 즉시 이용자에게 전자문서 전송(전자우편을 이용한 전송을 포함합니다)의 방법으로 그러한 사유를 알려야 하며, 거래내용을 제공할 수 없는 기간은 서면교부 기간에 산입하지 아니합니다.
②회사가 이용자에게 제공하는 거래내용 중 거래계좌의 명칭 또는 번호, 거래의 종류 및 금액, 거래상대방을 나타내는 정보, 거래일자, 전자적 장치의 종류 및 전자적 장치를 식별할 수 있는 정보와 해당 전자금융거래와 관련한 전자적 장치의 접속기록, 회사가 전자금융거래의 대가로 받은 수수료, 이용자의 출금 동의에 관한 사항, 전자금융거래의 신청 및 조건의 변경에 관한 사항, 건당 거래금액이 1만원을 초과하는 전자금융거래에 관한 기록은 5년간, 건당 거래금액이 1만원 이하인 소액 전자금융거래에 관한 기록, 전자지급수단 이용시 거래승인에 관한 기록, 이용자의 오류정정 요구사실 및 처리결과에 관한 사항은 1년간의 기간을 대상으로 보존하고, 회사가 전자지급결제대행 서비스 제공의 대가로 수취한 수수료에 관한 사항을 제공합니다.
③이용자가 제1항에서 정한 서면교부를 요청하고자 할 경우 다음의 주소 및 전화번호로 요청할 수 있습니다.
주소: 서울시 구로구 디지털로26길 72(구로동, 웰컴페이먼츠)
이메일 주소: help@kcp.co.kr
전화번호: 1544-8667
제9조 (오류의 정정 등)
①이용자는 전자금융거래 서비스를 이용함에 있어 오류가 있음을 안 때에는 회사에 대하여 그 정정을 요구할 수 있습니다.
②회사는 전항의 규정에 따른 오류의 정정요구를 받은 때 또는 스스로 오류가 있음을 안 때에는 이를 즉시 조사하여 처리한 후 정정요구를 받은 날 또는 오류가 있음을 안 날부터 2주 이내에 그 결과를 이용자에게 알려 드립니다.
제10조 (가맹점의 준수사항 등)
①가맹점은 직불전자지급수단이나 선불전자지급수단 또는 전자화폐(이하 "전자화폐등"이라 한다)에 의한 거래를 이유로 재화 또는 용역의 제공 등을 거절하거나 이용자를 불리하게 대우하여서는 아니 됩니다.
②가맹점은 이용자로 하여금 가맹점수수료를 부담하게 하여서는 아니 됩니다.
③가맹점은 다음 각 호의 어느 하나에 해당하는 행위를 하여서는 아니 됩니다.
1.재화 또는 용역의 제공 등이 없이 전자화폐등에 의한 거래를 한 것으로 가장(가장)하는 행위
2.실제 매출금액을 초과하여 전자화폐등에 의한 거래를 하는 행위
3.다른 가맹점 이름으로 전자화폐등에 의한 거래를 하는 행위
4.가맹점의 이름을 타인에게 빌려주는 행위
5.전자화폐등에 의한 거래를 대행하는 행위
④가맹점이 아닌 자는 가맹점의 이름으로 전자화폐등에 의한 거래를 하여서는 아니 됩니다.
제11조 (가맹점 모집 등)
①회사는 가맹점을 모집하는 경우에는 가맹점이 되고자 하는 자의 영업여부 등을 확인하여야 합니다. 다만, 「여신전문금융업법」 제16조의2의 규정에 따라 이미 확인을 한 가맹점인 경우에는 그러하지 아니합니다.
②회사는 다음 각 호의 사항을 금융위원회가 정하는 방법에 따라 가맹점에 알려야 합니다.
1.가맹점수수료
2.제2항의 규정에 따른 가맹점에 대한 책임
3.전조 규정에 따른 가맹점의 준수사항
③회사는 가맹점이 전조의 규정을 위반하여 형의 선고를 받거나 관계 행정기관으로부터 위반사실에 대하여 서면통보를 받는 등 대통령령이 정하는 사유에 해당하는 때에는 특별한 사유가 없는 한 지체 없이 가맹점계약을 해지하여야 합니다. ‘대통령령이 정하는 사유’라 함은 다음 각 호의 어느 하나에 해당하는 경우를 말합니다.
1.가맹점이 전자금융거래법 제 26조 또는 전조 제3항 제3호 내지 제5호를 위반하여 형을 선고받은 경우
2.가맹점이 전조 제1항, 제2항 또는 제3항 제3호 내지 제5호를 위반한 사실에 관하여 관계 행정기관으로부터 서면통보가 있는 경우
3.관계 행정기관으로부터 해당 가맹점의 폐업사실을 서면으로 통보 받은 경우
제12조 (회사의 책임)
①접근매체의 위조나 변조로 발생한 사고로 인하여 이용자에게 발생한 손해에 대하여 배상책임이 있습니다. 다만 이용자가 제7조 제2항에 위반하거나 제3자가 권한 없이 이용자의 접근매체를 이용하여 전자금융거래를 할 수 있음을 알았거나 알 수 있었음에도 불구하고 이용자가 자신의 접근매체를 누설 또는 노출하거나 방치한 경우 그 책임의 전부 또는 일부를 이용자가 부담하게 할 수 있습니다.
②회사는 계약체결 또는 거래지시의 전자적 전송이나 처리과정에서 발생한 사고로 인하여 이용자에게 그 손해가 발생한 경우에는 그 손해를 배상할 책임이 있습니다. 다만 본조 제1항 단서에 해당하거나 법인('중소기업기본법' 제2조 제2항에 의한 소기업을 제외합니다)인 이용자에게 손해가 발생한 경우로서 회사가 사고를 방지하기 위하여 보안절차를 수립하고 이를 철저히 준수하는 등 합리적으로 요구되는 충분한 주의의무를 다한 경우에는 그러하지 아니합니다.
③회사는 이용자로부터의 거래지시가 있음에도 불구하고 천재지변, 회사의 귀책사유가 없는 정전, 화재, 통신장애 기타의 불가항력적인 사유로 처리 불가능하거나 지연된 경우로서 이용자에게 처리 불가능 또는 지연사유를 통지한 경우(금융기관 또는 결제수단 발행업체나 통신판매업자가 통지한 경우를 포함합니다)에는 이용자에 대하여 이로 인한 책임을 지지 아니합니다.
④회사는 전자금융거래를 위한 전자적 장치 또는 '정보통신망 이용촉진 및 정보보호 등에 관한 법률' 제 2조 제 1항 제 1호에 따른 정보통신망에 침입하여 거짓이나 그 밖의 부정한 방법으로 획득한 접근매체의 이용으로 발생한 사고로 인하여 이용자에게 그 손해가 발생한 경우에는 그 손해를 배상할 책임이 있습니다. 다만, 다음과 같은 경우 회사는 이용자에 대하여 일부 또는 전부에 대하여 책임을 지지 않습니다.
1.회사가 접근매체에 따른 확인 외에 보안강화를 위하여 전자금융거래 시 요구하는 추가적인 보안조치를 이용자가 정당한 사유 없이 거부하여 전자금융거래법 제9조 제1항 제3호에 따른(이하 '사고'라 한다)사고가 발생한 경우.
2.이용자가 동항 제 1호의 추가적인 보안조치에서 사용되는 매체, 수단 또는 정보에 대하여 다음과 같은 행위를 하여 사고가 발생하는 경우
가.누설, 누출 또는 방치한 행위
나.제 3자에게 대여하거나 그 사용을 위임한 행위 또는 양도나 담보의 목적으로 제공한 행위
제13조 (전자지급거래계약의 효력)
①회사는 이용자의 거래지시가 전자지급거래에 관한 경우 그 지급절차를 대행하며, 전자지급거래에 관한 거래지시의 내용을 전송하여 지급이 이루어지도록 합니다.
②회사는 이용자의 전자지급거래에 관한 거래지시에 따라 지급거래가 이루어지지 않은 경우 수령한 자금을 이용자에게 반환하여야 합니다.
제14조 (거래지시의 철회)
①이용자는 전자지급거래에 관한 거래지시의 경우 지급의 효력이 발생하기 전까지 다음의 주소, 전자우편 및 연락처에 연락을 취함으로써 거래지시를 철회할 수 있습니다.
주소: 서울시 구로구 디지털로26길 72(구로동, 웰컴페이먼츠)
이메일 주소: help@kcp.co.kr
전화번호: 1544-8667
②전항의 지급의 효력이 발생 시점이란 (i) 전자자금이체의 경우에는 거래지시된 금액의 정보에 대하여 수취인의 계좌가 개설되어 있는 금융기관의 계좌 원장에 입금기록이 끝난 때 (ii) 그 밖의 전자지급수단으로 지급하는 경우에는 거래지시된 금액의 정보가 수취인의 계좌가 개설되어 있는 금융기관의 전자적 장치에 입력이 끝난 때를 말합니다.
③이용자는 지급의 효력이 발생한 경우에는 전자상거래 등에서의 소비자보호에 관한 법률 등 관련 법령상 청약의 철회의 방법 또는 본 약관 제5조에서 정한 바에 따라 결제대금을 반환받을 수 있습니다.
제15조 (전자지급결제대행 서비스 이용 기록의 생성 및 보존)
①회사는 이용자가 전자금융거래의 내용을 추적, 검색하거나 그 내용에 오류가 발생한 경우에 이를 확인하거나 정정할 수 있는 기록을 생성하여 보존합니다.
②전항의 규정에 따라 회사가 보존하여야 하는 기록의 종류 및 보존방법은 제8조 제2항에서 정한 바에 따릅니다..
제16조 (전자금융거래정보의 제공금지)
회사는 전자금융거래 서비스를 제공함에 있어서 취득한 이용자의 인적사항, 이용자의 계좌, 접근매체 및 전자금융거래의 내용과 실적에 관한 정보 또는 자료를 이용자의 동의를 얻지 아니하고 제3자에게 제공, 누설하거나 업무상 목적 외에 사용하지 아니합니다. 단, 통신비밀보호법, 정보통신망 이용촉진 및 정보보호 등에 관한 법률 등 관계법령에 의하여 적법한 절차에 따르는 경우에는 그러하지 아니합니다.

제17조 (계약해지 및 이용제한)
①이용자는 서비스 홈페이지 또는 고객센터를 통하여 서비스 계약을 해지할 수 있습니다.
②회사는 이용자가 본 약관의 의무를 이행하지 않을 경우 사전 통지 없이 즉시 서비스 이용계약을 해지하거나 서비스 이용을 제한할 수 있습니다. 회사의 조치에 대하여 이의가 있는 경우에는 서비스 홈페이지 또는 고객센터를 통하여 이의신청을 할 수 있습니다.
③전 항의 이의가 정당하다고 판단되는 경우 회사는 서비스의 이용을 즉시 재개합니다.
제18조 (분쟁처리 및 분쟁조정)
①이용자는 다음의 분쟁처리 책임자 및 담당자에 대하여 전자금융거래 서비스 이용과 관련한 의견 및 불만의 제기, 손해배상의 청구 등의 분쟁처리를 요구할 수 있습니다.
담당자 : RM팀
연락처 (전화번호, 전자우편주소) :
070-5075-8041, minwon@kcp.co.kr
②이용자가 회사에 대하여 분쟁처리를 신청한 경우에는 회사는 15일 이내에 이에 대한 조사 또는 처리 결과를 이용자에게 안내합니다.
③이용자는 '금융위원회의 설치 등에 관한 법률' 제51조의 규정에 따른 금융감독원의 금융분쟁조정위원회나 '소비자기본법' 제33조의 규정에 따른 한국소비자원에 회사의 전자금융거래 서비스의 이용과 관련한 분쟁조정을 신청할 수 있습니다.
제19조 (회사의 안정성 확보 의무)
회사는 전자금융거래가 안전하게 처리될 수 있도록 선량한 관리자로서의 주의를 다하며 전자금융거래의 안전성과 신뢰성을 확보할 수 있도록 전자금융거래의 종류별로 전자적 전송이나 처리를 위한 인력, 시설, 전자적 장치 등의 정보기술부문 및 전자금융업무에 관하여 금융위원회가 정하는 기준을 준수합니다.

제20조 (약관 외 준칙 및 관할)
①회사와 이용자 사이에 개별적으로 합의한 사항이 이 약관에 정한 사항과 다를 때에는 그 합의사항을 이 약관에 우선하여 적용합니다.
②이 약관에서 정하지 아니한 사항에 대하여는 전자금융거래법, 전자상거래 등에서의 소비자 보호에 관한 법률, 통신판매에 관한 법률, 여신전문금융업법 등 소비자보호 관련 법령에서 정한 바에 따릅니다.
③회사와 이용자간에 발생한 분쟁에 관한 관할은 민사소송법에서 정한 바에 따릅니다.
부칙 < 제 1 호, 2006.12.26. >
본 약관은 2007년 1월 1일부터 시행한다

부칙 < 제 2 호, 2011.01.17. >
본 약관은 2011년 02월 21일부터 시행한다.
(제 2조 4항 신설, 제 8조 2항 일부 개정, 제 10조 신설, 제11조 신설)

부칙 < 제 3 호, 2015.10.14. >
본 약관은 2015 10월 14일부터 시행한다
(제 17조 제1항 일부 개정, 제 12조 제 5항 신설)

부칙 < 제 4 호, 2016.04.08. >
본 약관은 2016년 4월 26일부터 시행한다
(제 1조 일부 개정, 제 8조 제 3항 일부 개정)

부칙 < 제 5 호, 2016.11.11. >
본 약관은 2016년 11월 21일부터 시행한다
(제 17조 신설, 제3조 제3항 및 제4항, 제9조 제2항, 제14조 제1항, 제16조, 제18조 제3항 일부 개정)

부칙 < 제 6 호, 2016.11.28. >
본 약관은 2016년 11월 28일부터 시행한다
(제12조 제1항 삭제, 제6조 제2항, 제8조 제1항 및 제2항, 제9조 제2항, 제19조 개정, 제20조 제1항 신설)

부칙 < 제 7 호, 2018.01.19. >
본 약관은 2018년 02월 22일부터 시행한다
(제12조 제1항, 제2항 일부 개정)

부칙 < 제 8 호, 2018.07.23. >
본 약관은 2018년 07월 31일부터 시행한다
(제18조 제1항 일부 개정)

부칙 < 제 9 호, 2018.11.19. >
본 약관은 2018년 12월 20일부터 시행한다
(제8조 제3항, 제14조 제1항 개정)

부칙 < 제 10 호, 2019.05.21. >
본 약관은 2019년5월 31일부터 시행한다
(제8조 제3항, 제14조 제1항 개정)
								</div>
							</div>
						</div>
		
						
		                <div class="form_row ma_t10">
							<div class="chk_box chk_agree">
								<input type="checkbox" id="chk_agree2" name="chk_agree2">
								<label for="chk_agree2" class="chkTerm"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt="" /></span>개인정보 수집 및 이용동의</label>
							</div>
		
							<div class="agree_box">
								<div class="box_m">
									
										약관내용 시작
"웰컴페이먼츠 주식회사"(이하 "회사")는 이용자의 개인정보를 중요시하며, "정보통신망 이용촉진 및 정보보호에 관한 법률" 및 "개인정보보호법"과 "전자상거래 등에서의 소비자 보호에 관한 법률"을 준수하고 있습니다. 회사는 전자지급결제대행서비스 및 결제대금예치서비스(이하 "서비스") 이용자로부터 아래와 같이 개인정보를 수집 및 이용합니다.

1.개인정보의 수집 및 이용목적
회사는 다음과 같은 목적 하에 "서비스"와 관련한 개인정보를 수집합니다.
-서비스 제공 계약의 성립, 유지, 종료를 위한 본인 식별 및 실명확인, 각종 회원관리
-서비스 제공 과정 중 본인 식별, 인증, 실명확인 및 회원에 대한 각종 안내/고지
-대금 환불, 상품배송 등 전자상거래 관련 서비스 제공
-서비스 제공 및 관련 업무처리에 필요한 동의 또는 철회 등 의사확인
-이용 빈도 파악 및 인구통계학적 특성에 따른 서비스 제공 및 CRM
-현금영수증 발행 및 관리 등
-본인명의로 발행된 결제수단 인증
-서비스 제공(거래승인 등)및 관련 업무처리(민원, 개인정보 관리상태 점검 등)를 위해 이용자와 해당 결제수단에 관한 계약을 체결한 이용자의 해당 결제수단 발행자(ex) 신용카드의 경우 해당 신용카드사)에게 이용자의 결제정보, 개인정보 보관내역 등 전송
(결제수단 발행자에 대한 상세 내용은 아래 참조)
신용카드 : 국민, 비씨, 롯데, 삼성, NH농협, 현대, 신한, 하나 등 신용카드사
계좌이체 : 기업/KB국민/수협중앙회/농협중앙회/단위농협/우리/SC제일/한국씨티/대구/부산/광주/제주/전북/경남/새마을금고/신협중앙회/우체국/KEB하나/신한/산림조합/산업(이상 ‘은행’), 유안타/현대/미래에셋/한국투자/NH투자/하이투자/HMC투자/SK/대신/하나금융투자/신한금융투자/동부/유진투자/메리츠종금/신영/삼성/한화투자/ 미래에셋대우(이상 ‘증권사’), 금융결제원
뱅크월렛 : 금융결제원
가상계좌 : 기업/KB국민/수협중앙회/농협중앙회/단위농협/우리/SC제일/한국씨티/대구/부산/광주/제주/전북/경남/새마을금고/신협중앙회/우체국/KEB하나/신한/산림조합/산업(이상 ‘은행’), 유안타/현대/미래에셋/한국투자/NH투자/하이투자/HMC투자/SK/대신/하나금융투자/신한금융투자/동부/유진투자/메리츠종금/신영/삼성/한화투자 /미래에셋대우(이상 ‘증권사’), 세틀뱅크, KIB.Net
포인트 : SK마케팅앤컴퍼니(OK캐쉬백, 복지포인트), BC카드 및 서울시(에코마일리지), ㈜케이티(올레클럽KT별포인트)
상품권 : 해피머니아이엔씨(해피머니상품권), 북앤라이프(도서문화상품권), 컬쳐랜드(문화상품권, 게임문화상품권), 아이앤플레이(틴캐시), ㈜해피닷컴(에그머니), ㈜에듀박스(온캐시)
휴대폰 : SKT, KT, LGU+ 등 이동통신사, 다날, 모빌리언, 다우기술
전화결제(ARS폰빌) : ㈜케이티, 다날
ARS 신용카드 : 국민, 비씨, 롯데, 삼성, NH농협, 현대, 신한, 하나 등 신용카드사, 온세통신
모모캐쉬 : SKT, KT, LGU+ 등 이동통신사, 온세통신, KSkyB
현금영수증 : 국세청
2.수집하는 개인정보 항목
가.결제수단별 회사가 수집하는 개인정보의 항목은 다음과 같습니다.
(신용카드)
카드번호(3rd-마스킹), 승인시간, 승인번호, 승인금액 등
(계좌이체)
계좌번호, 비밀번호, 주민등록번호(외국인등록번호), 은행명, 보안카드 또는 OTP 등
(뱅크월렛)
휴대폰번호 등
(가상계좌)
입금자명, 입금은행 등
(포인트)
OK캐쉬백-OK캐쉬백 카드번호, 비밀번호 등
복지포인트-복지포인트 아이디(ID)/비밀번호(PW) 등
에코 마일리지-카드번호, 카드사정보, 유효기간, 비밀번호 등
KT별포인트 - 올레클럽 KT별포인트 카드번호, 생년월일 등
(상품권)
해피머니상품권-해피머니 아이디(ID)/비밀번호(PW) 등
도서문화상품권-북앤라이프 아이디(ID)/비밀번호(PW), 상품권번호(PIN) 등
문화상품권-컬쳐랜드 아이디(ID)/비밀번호(PW) 등
스마트문상-상품권번호(PIN) 등
틴캐시-틴캐시 아이디(ID)/비밀번호(PW)
에그머니-에그머니 아이디(ID)/비밀번호(PW), 상품권번호(PIN) 등
온캐시-온캐시 아이디(ID)/비밀번호(PW)
(휴대폰)
휴대폰번호, 이동통신사정보, 생년월일, 성별 등
(전화결제_ARS폰빌)
KT 전화번호, 생년월일, 성별 등
(정기과금_신용카드)
리얼-카드번호, 카드사, 유효기간, 비밀번호 등
파일배치-카드번호, 카드사, 유효기간, 비밀번호 등
(ARS신용카드_통신판매)
카드번호, 카드사, 유효기간, 비밀번호 등
(통머니)
미스터통아이디(ID)/비밀번호(PW) 등
(에스크로)
주민등록번호(외국인등록번호), 휴대폰번호 등
(모모캐쉬)
휴대폰번호, 이동통신사정보, 생년월일, 성별 등
(현금영수증)
현금영수증 카드번호, 주민등록번호(외국인등록번호), 사업자등록번호, 휴대폰번호, 승인번호 등
나.상기 명시된 개인정보 항목 이외의 "서비스" 이용과정이나 "서비스" 처리 과정에서 다음과 같은 추가 정보들이 자동 혹은 수동으로 생성되어 수집 될 수 있습니다.
-이용자 IP/Mac Address, 쿠키, e-mail, 서비스 접속 일시, 서비스 이용기록, 불량 혹은 비정상 이용기록, 결제기록
다.기타, 회사는 서비스 이용과 관련한 대금결제, 물품배송 및 환불 등에 필요한 정보를 추가로 수집할 수 있습니다.
3.개인정보의 보유 및 이용기간
이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기 합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존 합니다.
가.회사 내부 방침의 의한 정보보유
-부정이용방지와 비인가사용방지를 위한 결제 이용에 관한 기록
-보존기간 : 5년
나.관련법령에 의한 정보보유
상법, 전자상거래 등에서의 소비자보호에 관한 법률, 전자금융거래법 등 관련법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 관련법령에서 정한 일정한 기간 동안 정보를 보관합니다. 이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용하며 보존기간은 아래와 같습니다.
-계약 또는 청약철회 등에 관한 기록
보존기간: 5년 / 보존근거: 전자상거래 등에서의 소비자보호에 관한 법률
-대금결제 및 재화 등의 공급에 관한 기록
보존기간: 5년 / 보존근거: 전자상거래 등에서의 소비자보호에 관한 법률
(단, 건당 거래 금액이 1만원 이하의 경우에는 1년간 보존 합니다).
-소비자의 불만 또는 분쟁처리에 관한 기록
보존기간: 3년 / 보존근거: 전자상거래 등에서의 소비자보호에 관한 법률
-신용정보의 수집/처리 및 이용 등에 관한 기록
보존기간: 3년 / 보존근거: 신용정보의 이용 및 보호에 관한 법률
-방문에 관한 기록
보존기간: 3개월 / 보존근거: 통신비밀보호법
-현금영수증 결제내역에 관한 기록
보존기간: 1년 / 보존근거: 조세특례제한법
4.이용자의 개인정보의 수집 및 이용 거부
이용자는 회사의 개인정보 수집 및 이용 동의를 거부할 수 있습니다. 단, 동의를 거부 하는 경우 서비스 결제가 정상적으로 완료 될 수 없음을 알려 드립니다.
※개인정보의 처리와 관련된 사항은 회사의 개인정보처리방침 (통합결제창 하단에서 확인할 수 있습니다)에 따릅니다.
									
								</div>
							</div>
		                </div>
						<div class="line_top">
							<div class="chk_box chk_all">
								<input type="checkbox" id="chk_all" name="chk_all" class="" title="체크하면 한 번에 동의가 됩니다">
								<label for="chk_all"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt="" /></span>전체동의</label>
							</div>
							<button type="button" id="btnConfirm" class="btn_agree" aria-label="카드 및 할부선택 화면으로 넘어갑니다">확인</button>
						</div>
		            </div>
		          
		            <a href="javascript:;" id="agreeClose" class="ly_btn_close"><img src="img/btn_pop_close.png" alt="닫기" /></a>
	            </form>
	        </div>
	        <!--//layerContent-->
	    </div>
	</div>
	<!--//layer:For Center screen-->

	
	<input aria-hidden="true" type="hidden" name="skinIdx"		value="1"  />
	<input aria-hidden="true" type="hidden" name="skinColor"	value="blue"  />
	<input aria-hidden="true" type="hidden" name="lang"			value="ko"  />
	<input aria-hidden="true" type="hidden" name="encTraceNO"  	value="ZJJ4Q4bHdsoft7SHLB+xig=="  />
	
<style>
	

/*텍스트컬러*/
.txt_color{color:#207bba;}
.txt_color a{color:#185c8b;}

/*레이아웃*/
.header_color{background:#207bba;}

/*상단*/
.location .on,.location .on:hover{color:#207bba;font-weight:bold;}

/* error */
.ic_x{background-position:0px 0px;}

/* loading */
.ic_loading{overflow:hidden;display:block;line-height:200px;text-indent:-9999em;vertical-align:top;background:url(/img/loading_blue.gif) no-repeat}

/*카드사선택*/
.b2b_w1:hover,.b2b_w2:hover,.b2b_w3:hover,.w3:hover,.w2:hover,.w1:hover,.w_hp:hover,.w_all:hover,.b2b_w1.on,.b2b_w2.on,.b2b_w3.on,.w3.on,.w2.on,.w1.on,.w_hp.on,.w_all.on{border:1px solid #207bba;background:#e8fcff;color:#333;position:relative;z-index:10}
.sel_w2_bg:hover,.sel_w2_bg.on{border:1px solid #207bba;background:#e8fcff;color:#333;position:relative;z-index:10;top:-1px;left:-1px;}
.sel_w2_bg ul{border:1px solid #207bba;}

/*통신사선택*/
.w_hp_bg.on{border:1px solid #207bba;color:#333;position:relative;z-index:10;top:0px;left:-1px;}
.w_hp_bg.on select{background-color:#e8fcff;color:#333;}

/* giftcard */
.ic_plus_bg{background:#207bba;}

/*탭*/
.tab{border-bottom:1px solid #207bba;}
.tab .w_tab:hover,.tab .w_tab.on{color:#207bba;border-top:1px solid #207bba;border-left:1px solid #207bba;border-right:1px solid #207bba;border-bottom:1px solid #fff;}

/*버튼*/
.btn_color,.btn_sale{background:#207bba;}
.btn_color:hover,.btn_sale:hover,.disable:focus{background:#1a5d8c;}

@charset "utf-8";

@font-face {
  font-family: 'NanumBarunGothic';
  font-style:normal;
  font-weight:400;
  src: local(※),
       url(https://cdn.kcp.co.kr/font/NanumBarunGothic.woff) format('woff');
}

@font-face {
  font-family: 'NanumBarunGothic';
  font-style:normal;
  font-weight:700;
  src: local(※),
       url(https://cdn.kcp.co.kr/font/NanumBarunGothicBold.woff) format('woff');
}

body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,form,fieldset,legend,textarea,p,th,td,input,select,textarea,button,span{margin:0;padding:0;}
html,body{width:100%;height:100%}

body,input,button,select,button{overflow:hidden;font-family:'나눔바른고딕','NanumBarunGothic',NanumBarunGothic,'돋움',dotum,Helvetica,sans-serif;font-size:12px;color:#5e5e5e;-webkit-text-size-adjust:none;font-weight:400;
 -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}

fieldset,img{border:0 none;vertical-align:top}
dl,ul,ol,menu,li{list-style:none}
button{overflow:visible;border:0 none;background-color:transparent;cursor:pointer}
input,button, select{-webkit-appearance:none;width:100%;max-width:100%;padding:2px 10px;margin-right:0;height:28px;line-height:auto;border:1px solid #b2b1b1;border-radius:0;}/*180510*/


body.m button,body.m select{font-family:sans-serif}
button::-moz-focus-inner{padding:0;border:0}
address,caption,em{font-style:normal}
a,a:focus,a:active,a:hover{color:#000;text-decoration:none}
table {border-spacing:0;border-collapse:collapse; word-break:keep-all}
table, th, td{word-wrap:break-word}

input[type="text"]::-webkit-input-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]:-moz-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]::-moz-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]:-ms-input-placeholder{color:#828282;letter-spacing:1px;}

input::-ms-clear{display:none}
input:focus, textarea:focus, select:focus{border:1px solid #000;position:relative;z-index:9;color:#000}
button[disabled],input[type="text"][disabled]{opacity:0.4}

input[type="checkbox"]:focus + label,
input[type="checkbox"]:hover + label,
input[type="radio"]:focus + label
,input[type="radio"]:hover + label{outline:1px dotted #000;outline:-webkit-focus-ring-color auto;}

input[type="checkbox"].focus + label,
input[type="radio"].focus + label {outline:1px dotted #000;outline:-webkit-focus-ring-color auto;}


.radio-applied input[type="radio"], .chk_box input[type="checkbox"] ,.radio-applied-card input[type="radio"]{position:absolute;width:16px;height:15px;overflow:hidden;margin:0;padding:0;border:0;outline:0;opacity:0;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";z-index:5;}
.radio-applied label, .chk_box label {display:inline-block;padding-left:18px;line-height:20px;}


.radio-applied-card label{display:inline-block; padding-left:0px; line-height:20px; font-size:12px;}

/* check box */
.chk_box {position:relative;}
.chk_box input[type="checkbox"] + label .chk_ico{display:inline-block;position:absolute;left:0;top:3px;width:16px;height:15px;vertical-align:middle;color:#5e5e5e;}

/* radio */
.radio-applied {position:relative;}
.radio-applied input[type="radio"] + label .chk_ico{display:inline-block;position:absolute;left:0;top:3px;width:16px;height:15px;vertical-align:middle;}


/* input */
.input_area{position:relative;display:block;}
.input_area .input_lbl{position:absolute;top:0;left:10px;bottom:0;font-size:12px;line-height:auto;color:#5e5e5e;}/*180510*/
.input_txt{font-size:12px;font-weight:500;line-height:auto;vertical-align:top;background:#fff;color:#5e5e5e;}/*180510*/


/* Select */
select{-webkit-appearance:none;-moz-appearance:none; appearance:none;background: url(../../img/popup/sel_arrow_off.gif) no-repeat 95% 50%;background-color:#fff;color:#5e5e5e;}
select::-ms-expand{display:none;}
select:focus{background: url(../../img/popup/sel_arrow_on.gif) no-repeat 95% 50%;background-color:#fff}

.blind,legend{overflow:hidden;position:absolute;top:0;left:0;width:1px;height:1px;font-size:0;line-height:100px;white-space:nowrap}
.sp{overflow:hidden;display:inline-block;line-height:200px;text-indent:-9999em;vertical-align:top;background:url(../../img/popup/pop_sp.png) no-repeat}


/* margin */
.ma_t4{margin-top:4px !important;}
.ma_t8{margin-top:8px !important;}
.ma_t10{margin-top:10px !important;}
.ma_t15{margin-top:15px !important;}
.ma_t20{margin-top:20px !important;}
.ma_t30{margin-top:30px !important;}

.ma_l5{margin-left:5px !important;}
.ma_l20{margin-left:20px !important;}

.ma_r5{margin-right:5px !important;}

.ma_b10{margin-bottom:10px !important;}
.ma_b20{margin-bottom:20px !important;}
.ma_b30{margin-bottom:30px !important;}
.ma_b_notice{margin-bottom:50px !important;}
.ma_btn{margin:0 2px 0 8px}
.ma_btn2{margin:0 2px 0 28px}
.ma_cash{margin-left:18px !important;}

/* align */
.fl_l{float:left}
.fl_r{float:right}
.align_c{text-align:center}
.align_l{text-align:left}
.align_r{text-align:right}

/* text-color */
.txt_bold{font-weight:700;}
.txt_blue{color:#6b91c5 !important;font-weight:500;}
.txt_red{color:#eb2525 !important;font-weight:500;}
.txt_s_gray{color:#707070 !important
  ;font-size:11px;}
.txt_serialnumber{height:32px;line-height:32px;color:#707070;padding-left:5px;}
.t_over{text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}

.form_lst,.col_cont,.form_row{*zoom:1;position:relative;}
.form_lst:after,.col_cont:after,.form_row:after,.price:after{display:block;clear:both;content:''}
.form_row{position:relative;clear:both;width:100%;}

.form_row .col_tit{float:left;width:60px;color:#5e5e5e;margin-left:20px}
.form_row .col_cont{width:215px;padding-right:10px;color:#1a1a1a;display:inline-block;float:right;}

/* loading */
.content_loading{padding:6px 25px;height:345px;position:relative;text-align:center;background:#fff;}
.loading{width:64px;height:64px;margin:100px auto 0;}
.loading_con{font-size:15px;line-height:20px;color:#1a1a1a;margin-top:15px;}
.ic_loading{overflow:hidden;display:block;line-height:200px;text-indent:-9999em;vertical-align:top;background:url(../../img/popup/loading_blue.gif) no-repeat}


/* pop */
/*For Center screen*/
.layer {position:absolute; display:table; top:0; left:0; width:100%; height:100%}
.layer .layer_inner {display:table-cell; text-align:left; vertical-align:top;}
.layer .layerCon {display:inline-block; text-align:left;}

.layerCon {background:#fff;padding:30px;z-index:500;position:relative;}

.w_coupon{width:394px;height:352px}
.w_nointerest{width:340px;height:390px}
.w_otp{width:340px;height:660px}
.w_step{width:340px;}
.w_e2e{width:540px;height:278px}
.w_agree{width:652px;height:424px;}
.w_agree_nc{width:652px;} /*190925 추가*/
.sc_agree{width:660px;height:340px;overflow-y:scroll;overflow:auto;padding-right:10px;}

.fullDimmed {width:100%; height:100%; background:#000; opacity:.5;filter:alpha(opacity=50);-ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)'; position:fixed; top:0; left:0; right:0; bottom:0; z-index:500;}


.ly_btn_close{position:absolute;top:17px;right:17px;cursor:pointer;width:18px;height:18px;}
.ly_btn_close :hover{background:#e6e6e6;}

.layerCon .tit{font-size:16px;line-height:19px;font-weight:700;color:#000;padding-bottom:10px;}/*180510*/
.layerCon .tit2{font-size:13px;line-height:15px;font-weight:700;color:#000;padding:9px 0 4px;}
.layerCon .stit {font-size:13px;line-height:15px;color:#5e5e5e;}
.layerCon .stit2{font-size:13px;line-height:15px;color:#1a1a1a;font-weight:500}
.layerCon .stit3{font-size:12px;line-height:17px;color:#5e5e5e;font-weight:normal}
.layerCon .scon{font-size:12px;line-height:17px;color:#1a1a1a;font-weight:500}
.layerCon .notice{margin-top:10px;font-size:12px;color:#5e5e5e;line-height:17px;}
.layerCon .notice p{position:relative;padding-left:18px;color:#5e5e5e;letter-spacing:-0.2px;}
.layerCon .ic_dot{width:2px;height:2px;background:#5e5e5e;position:absolute;top:7px;margin-left:-7px}

/* coupon */
.coupon_bg{padding:0px 5px 15px;height:233px;margin-top:15px;overflow-y:scroll;overflow:auto;}
.coupon_box{width:168px;height:115px;float:left;margin:0px 20px 17px 0;}
.coupon{width:168px;height:77px;background:url(../../img/popup/coupon_bg.png) no-repeat 0;vertical-align:top;margin-bottom:8px}
.coupon.cp_dimmed{opacity:0.4;filter:alpha(opacity=20);-ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=20)';z-index:999;}
.coupon .coupon_logo{width:136px;text-align:center;font-size:14px;padding:16px 0 5px;display:block}
.coupon .coupon_logo img{height:18px;}
.coupon .coupon_txt{width:136px;text-align:center;display:block;font-size:13px;color:#eb2525;margin-top:5px;}

.coupon_end{width:160px;height:87px;text-align:center;margin:77px auto 0;}
.coupon_end .ic_x{font-size:14px;color:#eb2525;}
.coupon_end .txt{font-size:13px;color:#eb2525;margin-top:10px;}

/* 무이자_nointerest */
.nointerest_bg{width:354px;height:302px;margin-top:15px;overflow-y:scroll;overflow:auto;}
.nointerest_box_bg{margin:0px 20px 0px 0;width:333px;vertical-align:top;border:1px solid #e1e1e1;background-color:#f7f7f7;font-size:12px;color:#5e5e5e;font-weight:normal}
.nointerest_box{width:333px;min-height:59px;display:table;border-top:1px solid #e1e1e1}
.nointerest_box p{display:table-cell;vertical-align:middle;padding:5px 15px;}
.nointerest_box:first-child{border-top:0px solid #e1e1e1}
.nointerest_box .name{font-size:13px;color:#1a1a1a;font-weight:bold;display:block;margin-bottom:3px;}
.nointerest_box .contens{display:block;font-size:12px;line-height:16px}
.nointerest_box .except{display:block;font-size:11px;line-height:16px;color:#eb2525;}

/* otp */
.otp_bg{margin-top:5px;}
.otp_bg .stit{font-size:13px;color:#1a1a1a;line-height:18px}
.otp_bg p{margin:3px 0 5px 13px;font-size:12px;color:#5e5e5e;line-height:16px;letter-spacing:-0.1px}
.otp_bg p em{color:#eb2525}

/* step */
.logo{position:absolute;top:25px;left:25px;}
.step_con{position:absolute;top:60px;width:340px;text-align:center;}
.step_con_eng{position:absolute;top:20px;width:340px;text-align:center;}
.tit_exe{font-size:16px;line-height:20px;color:#000;border-bottom:1px solid #000;display:inline-block;}
.tit_exe2{width:100%;font-size:16px;line-height:20px;color:#000;display:block;text-align:center;margin-top:7px;}
.tit_exe2 em{border-bottom:1px solid #000;}

.delfino{margin:17px 0 10px;font-size:12px;line-height:32px;height:32px;color:#054a84;letter-spacing:-0.2px;}
.step_box{width:100%;height:28px;border:1px solid #d7d7d7;font-size:12px;line-height:30px;color:#5e5e5e;padding:0;border-radius:2px;}
.step_box em{color:#1a1a1a;font-weight:700}
.w_step .footer{position:absolute;left:0px;top:390px;width:100%;height:40px;background:#e5e5e5;text-align:center;font-size:14px;line-height:40px;color:#5e5e5e}
.w_step .footer button {display:inline-block;width:100%;height:100%;color:#5e5e5e;border:none;font-size:14px}
.w_step .footer button:hover {color:#fff;background:#5a5a5a}
.txt_exp{font-size:13px;line-height:15px;color:#1a1a1a;margin-top:10px}

/* 3D_certification */
.notice_3d{margin-top:10px;font-size:12px;color:#1a1a1a;line-height:16px;}
.notice_3d p{position:relative;padding-left:7px;color:#1a1a1a;letter-spacing:-0.3px;margin-bottom:8px}
.notice_3d .ic_dot{width:2px;height:2px;background:#5e5e5e;position:absolute;top:8px;margin-left:-7px}


/* e2e */
.e2e_box_bg{background:#f3f3f4;padding:18px 0;width:100%;font-size:15px;color:#1a1a1a;text-align:center;margin-top:15px}
.e2e_box_left{width:250px;text-align:left;margin:7px 0 7px 40px}
.e2e_box_left em{margin-left:5px}

/* agree */
.con_agree{position:relative;  }
.chk_all{font-size:13px;line-height:18px;color:#1a1a1a;padding-top:1px}
.chk_agree{color:#1a1a1a;font-weight:700;font-size:13px;line-height:18px;padding-top:1px}
.agree_box{background:#f5f5f5;padding:10px;margin:5px 0 8px;line-height:17px;}
.box_m{padding:0 10px 22px 8px;height:38px;}
.agree_iframe{width:100%;border:0;height:60px;overflow-y:scroll;overflow:auto;}


.box_txt_bg{overflow-x:hidden;overflow-y:auto}
.box_txt{padding:0 10px 10px 0px}
.box_txt h1,.box_txt h2,.box_txt h3,.box_txt h4{font-size:12px;color:#1a1a1a;margin-bottom:5px;font-weight:bold}
.box_txt p,.box_txt li,.box_txt span{font-size:11px;line-height:16px;color:#5e5e5e}
.box_txt h1,.box_txt h2,.box_txt h3,.box_txt ul,.box_txt ol,.box_txt p{margin-top:12px;}
.box_txt .first{margin-top:5px;}
.box_txt .txt_gray_b2{color:#1a1a1a;font-weight:bold}
.box_txt h3:first-child,.box_txt ul:first-child,.box_txt ol:first-child,.box_txt p:first-child{margin-top:0;}
.box_txt h2 + p,.box_txt h2 + ol{margin-top:0}
.box_txt p + ul,.box_txt p + ol{margin-top:0}
.box_txt p,.box_txt li{line-height:16px;color:#747474}
.box_txt ol .first_letter{display:inline-block;width:10px;height:18px;position:absolute;top:0;left:0px;}
.box_txt ol li{position:relative;padding-left:15px;margin:5px 0;}
.box_txt li{margin:5px 0;}


.pop_box_01{width:98%; border:1px solid #e7e7e7;}
.pop_box_01 caption{font-weight:bold;margin:4px 0;color:#474747;}
.pop_box_01 table{margin:7px 0;}
.pop_box_01 td{height:21px; text-align:center; padding-top:4px;color:#7f7f7f;}
.pop_box_01 th.bg_gy_01{ background:#CCC;border-left:1px solid #e7e7e7; text-align:center; font-weight:bold;color:#474747;}
.pop_box_01 td.bdr_ty_01{border-left:1px solid #e7e7e7; border-bottom:1px solid #e7e7e7;}
.pop_box_01 td.bdr_ty_02{border-left:1px solid #e7e7e7; border-bottom:1px solid #e7e7e7;text-align:left;}
.pop_box_01 th{ height:21px; font-weight:normal; padding-top:4px;}
.pop_box_01 th.bdr_ty_01{border-bottom:1px solid #e7e7e7;color:#707070;text-align:center}


.line_top{border-top:1px solid #ebeaea;margin:20px 0 0px;padding-top:17px;position:relative}
.btn_agree{overflow:hidden;display:inline-block;color:#fff;font-size:13px;font-weight:700;text-align:center;border:none;background:#3b3b3b;width:118px;height:33px;border-radius:3px;position:absolute;right:0px;top:12px}
.btn_agree:hover{background:#000;}

.pop_tab{text-align:center;font-size:12px;color:#707070;position:absolute;top:-5px;right:0px;z-index:100} 
.pop_tab li{width:70px;height:20px;line-height:22px;background:#f5f4f4;border:1px solid #b2b1b1;display:inline-block;float:left;margin-left:-1px;z-index:3}
.pop_tab li:first-child{margin-left:0px;width:70px;}
.pop_tab li a{width:70px;height:20px;display:inline-block}
.pop_tab li:hover,.layerCon .pop_tab li.on{background:#585858;border:1px solid #b2b1b1;color:#fff;}
.pop_tab li a:hover,.layerCon .pop_tab li.on a{color:#fff;}

/* sensereader_help*/
.w_help{width:540px;height:540px}
.txt_explan{font-size:13px;line-height:17px;}
.con_help{margin:20px 0 0;font-size:12px;line-height:17px;color:#5e5e5e;}
.con_help .stit{font-size:15px;line-height:15px;color:#1a1a1a;font-weight:700;margin-bottom:5px}

.help_box_bg{background:#f3f3f4;padding:10px 0 14px;width:100%;font-size:12px;color:#1a1a1a;line-height:16px;margin-top:10px}
.help_box_bg .h_con{position:relative;padding-left:18px;color:#1a1a1a;margin-top:8px}
.help_box_bg .h_con .sstit{font-size:13px;line-height:15px;color:#1a1a1a;font-weight:700;margin-bottom:5px}
.help_box_bg .h_con p{padding-left:20px;color:#5e5e5e;margin-top:5px}

.hsub_con{position:relative;margin-right:20px}
.hsub_con .ic_star{width:10px;position:absolute;top:0px;margin-left:-10px}

.help_box_bg .h_con2{position:relative;padding-left:40px;color:#1a1a1a;margin-top:8px}
.help_box_bg .h_con2 p{padding:0px 15px 0 0;color:#5e5e5e;margin-top:5px}

.hsub_con2{position:relative;}
.hsub_con2 .ic_num{width:14px;position:absolute;top:0px;margin-left:-24px;font-weight:bold;color:#1a1a1a;}


/* icon */
.ic_notice{width:14px;height:14px;background-position:0px -17px;vertical-align:middle;margin:-3px 3px 0;}
.ic_down{width:13px;height:13px;background-position:0px 0px;vertical-align:middle;margin:-3px 3px 0;}
.ic_exedown{width:15px;height:13px;background-position:-17px 0px;vertical-align:middle;margin:-3px 0px 0 10px;}
.ic_lock{width:13px;height:15px;background-position:-18px -17px;vertical-align:middle;margin:-3px 0px 0 10px;}



/*버튼*/
.btn_cp{overflow:hidden;display:inline-block;background:#fff;font-size:12px;text-align:center;width:168px;height:28px;line-height:28px;border:1px solid #585858;color:#1a1a1a;padding:0}
.btn_cp:hover {border:1px solid #eb2525;color:#eb2525}
.btn_cp_nothing{width:168px;height:26px;line-height:28px;background:#f5f4f4;border:1px solid #c0bbbb;color:#5e5e5e;padding:0;text-align:center}

.btn_down{overflow:hidden;display:inline-block;font-size:15px;text-align:center;width:100%;height:38px;line-height:40px;border:1px solid #3cabf0;color:#fff;background:#3cabf0;padding:0;border-radius:3px}
.btn_down:hover {color:#fff;background:#07639d;border:1px solid #07639d;}
.btn_down a{color:#fff;}

.btn_area_pop{height:45px;text-align:center;margin-top:20px;position:absolute;left:0;right:0;bottom:30px;overflow:hidden;z-index:200;}
.btn_area_pop .btn_pop_size{width:118px;height:45px;}
.btn_area_pop .btn_pop_size_e2e{width:158px;height:45px}
.btn_gray,.btn_color{overflow:hidden;display:inline-block;color:#fff;font-size:15px;font-weight:700;text-align:center;border:none;}
.btn_gray {background:#8f8f8f;border-radius:3px;line-height:45px;}
.btn_gray:hover {background:#5a5a5a;}
.btn_color {background:#3b3b3b;line-height:45px;border-radius:3px;}
.btn_color:hover,.ic_plus_bg:hover {background:#000;}
.btn_con_gray {background:#585858;line-height:20px;border:1px solid #585858;overflow:hidden;display:inline-block;color:#fff;font-size:12px;border:none;}
.btn_con_gray:hover {background:#272727}
.btn_size_e2e{width:200px;height:34px;float:left;}

.btn_search{overflow:hidden;display:inline-block;background:#585858;border:1px solid #585858;font-size:12px;text-align:center;width:40px;height:18px;line-height:18px;color:#fff;padding:0;margin-left:5px;}
.btn_search:hover {background:#000;}

.btn_line{overflow:hidden;display:inline-block;background:#fff;font-size:12px;text-align:center;border:1px solid #585858;color:#1a1a1a;padding:0}
.btn_line:hover {border:1px solid #eb2525;color:#eb2525}

.btn_lang_ko{width:56px;height:23px;line-height:23px;position:absolute;top:25px;left:324px;cursor:pointer;}


/* 이용 한도 표 */
.tbl_default {width:500px;}
.tbl_default caption{display:none;}
.tbl_default th {width:50%; text-align:center; border:1px solid #747474;}
.tbl_default td {padding:10px; border:1px solid #747474;}


/*ie8*/
@media \0screen
{
  body,input,button,select,button{font-family:'돋움',dotum,arial,Helvetica,sans-serif;}
  input,button, select{line-height:28px !important;}/*180510*/

 .input_area .input_lbl{line-height:28px !important;}/*180510*/
 .input_txt{line-height:28px !important;}/*180510*/	
}
</style>
</body>
</html>