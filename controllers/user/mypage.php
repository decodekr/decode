<?php
include 'views/header.html';
?>
<?php

	if(strpos($param['type'],'판매')!==FALSE){
		$param['user_type']='seller';
		$session['user_type']='seller';
		updateItem('users',$param,$session['login']);
		
	}
	if(strpos($param['type'],'구매')!==FALSE){
		$param['user_type']='buyer';
		$session['user_type']='buyer';
	updateItem('users',$param,$session['login']);
	
	}
      if($param['has_data']){
		$param['expect_product'] = implode('|',$param['expect_product']);
		updateItem('users',$param,$session['login']);
		  
		getBack('/user/mypage?complete=1');
		exit;
	  }
	$user=getItem('users',$session['login']);
	$user['expect_product'] = explode('|',$user['expect_product']);
	if($param['user_type']){
	$user['user_type']=$param['user_type'];
	}
?>

<?php

	if($user['user_type']=='seller'){
?>

<main class="site-main site-login">
        <div class="box-center">
            <div class="customer-login">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="title-login">판매자 계정 추가 정보</h5>
                            <p class="p-title-login"></p>
                            <form class="register" method="post">
								<input type="hidden" name="has_data" value="1">
                                <p class="form-row form-row-wide">
                                    <label>회사명<span class="required">*</span></label>
                                    <input type="text" name="company" placeholder="" value="<?=$user['company']?>" class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>사업자번호<span class="required">*</span></label>
                                    <input type="text"  name="business_code" placeholder=""  value="<?=$user['business_code']?>" class="input-text">
                                </p>
								 <p class="form-row form-row-wide">
                                    <label>사업자 등록증 사본<span class="required"></span></label>
                                    <input type="file">
									<!-- <p style="color:red;">TEST.php</p> -->
                                </p>
								 <p class="form-row form-row-wide">
                                    <label>사업자 통장 사본<span class="required"></span></label>
                                    <input type="file">
										<!-- <p style="color:red;">TEST.php</p> -->
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>주소<span class="required"></span></label>
                                </p>
                                <div class="form-group form-row-wide">
                                    <label class="inline"><input type="checkbox" name="address_country"  value="국내" <?=attr($user['address_country']=='국내','checked')?>><span class="input"></span>국내</label>
                                    <label class="inline"><input type="checkbox" name="address_country" value="해외"  <?=attr($user['address_country']=='해외','checked')?>><span class="input"></span>해외</label>
                                </div>
                                <p class="form-row form-row-wide">
                                    <label>도로명 주소</label><br>
                                    <input type="text"  name="address" id="address" readonly placeholder="주소를 검색하여 입력하세요"   value="<?=$user['address']?>"  class="input-text right_button">
								<a href="" class="btn btn-default" style="height:40px;vertical-align: middle;line-height: 28px;" id="address_search_button">주소 검색</a>
                                </p>
                                <p class="form-row form-row-wide">
                                   <div id="address_wrap" style="display:none;border:1px solid;width:100%;height:300px;margin:5px 0;position:relative">
								<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
								</div>
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>상세 주소</label>
                                    <input type="text"   id="address_detail" name="address_detail" placeholder=""     value="<?=$user['address_detail']?>" class="input-text">
                                </p>

						



                                <h5 class="title-login">계좌 정보 입력</h5>
                                <p class="form-row form-row-wide">
                                    <label>BANK NAME</label>
                                    <input type="text"  name="bank_name" placeholder=""   value="<?=$user['bank_name']?>"  class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>ACCOUNT NO</label>
                                    <input type="text"  name="bank_account_number"   value="<?=$user['bank_account_number']?>"  placeholder="" class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>SWIFT CODE</label>
                                    <input type="text"  name="swift_code" placeholder=""    value="<?=$user['swift_code']?>"  class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>BANK ADDRE</label>
                                    <input type="text"  name="bank_address" placeholder=""   value="<?=$user['bank_address']?>"  class="input-text">
                                </p>
                                <ul>
                                    <li><label class="inline"><input type="checkbox" checked><span class="input"></span>본인은 이용약관, 개인정보 수집 및 이용,
                                        제공에 동의합니다.</label></li>
                                </ul>
                                <p class="form-row">
                                    <input type="submit" value="상세 정보 입력 완료" name="Submit" class="button-submit">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
}
else{
?>
	<main class="site-main site-login">
        <div class="box-center">
            <div class="customer-login">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="title-login">구매자 계정 추가 정보</h5>
                            <p class="p-title-login"></p>
                            <form class="register" method="post">
								<input type="hidden" name="has_data" value="1">
                                <p class="form-row form-row-wide">
                                    <label>회사명<span class="required">*</span></label>
                                    <input type="text" name="company" placeholder="" value="<?=$user['company']?>" class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>사업자번호<span class="required">*</span></label>
                                    <input type="text"  name="business_code" placeholder=""  value="<?=$user['business_code']?>" class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>주소<span class="required"></span></label>
                                </p>
                                <div class="form-group form-row-wide">
                                    <label class="inline"><input type="checkbox" name="address_country"  value="국내" <?=attr($user['address_country']=='국내','checked')?>><span class="input"></span>국내</label>
                                    <label class="inline"><input type="checkbox" name="address_country" value="해외"  <?=attr($user['address_country']=='해외','checked')?>><span class="input"></span>해외</label>
                                </div>
                                <p class="form-row form-row-wide">
                                    <label>도로명 주소</label><br>
                                    <input type="text"  name="address" id="address" readonly placeholder="주소를 검색하여 입력하세요"   value="<?=$user['address']?>"  class="input-text right_button">
								<a href="" class="btn btn-default" style="height:40px;vertical-align: middle;line-height: 28px;" id="address_search_button">주소 검색</a>
                                </p>
                                <p class="form-row form-row-wide">
                                   <div id="address_wrap" style="display:none;border:1px solid;width:100%;height:300px;margin:5px 0;position:relative">
								<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
								</div>
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>상세 주소</label>
                                    <input type="text"   id="address_detail" name="address_detail" placeholder=""     value="<?=$user['address_detail']?>" class="input-text">
                                </p>
                                <h5 class="title-login">예상 주요 거래 품목</h5>
                                <p class="form-row form-row-wide">
                                    <label>예상가래품목1</label>
                                    <input type="text"  name="expect_product[]" value="<?=$user['expect_product'][0]?>" placeholder="" class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>예상가래품목2</label>
                                    <input type="text"  name="expect_product[]"  value="<?=$user['expect_product'][1]?>"placeholder="" class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>예상가래품목3</label>
                                    <input type="text"  name="expect_product[]"  value="<?=$user['expect_product'][2]?>"placeholder="" class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>예상가래품목4</label>
                                    <input type="text" name="expect_product[]"  value="<?=$user['expect_product'][3]?>"placeholder="" class="input-text">
                                </p>
                                <ul>
                                    <li><label class="inline"><input type="checkbox" checked><span class="input"></span>본인은 이용약관, 개인정보 수집 및 이용,
                                        제공에 동의합니다.</label></li>
                                </ul>
                                <p class="form-row">
                                    <input type="submit" value="상세 정보 입력 완료" checked name="Submit" class="button-submit">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<?php
}
if($param['complete']==1){
?>
<script>
	Swal.fire({
 
  text: '수정완료',
  icon: 'success',
  confirmButtonText: '확인'
})

</script>
<?php
}	
?>




<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
$('#address_search_button').click(function(){
  /*  new daum.Postcode({
        oncomplete: function(data) {
			//console.log(data);
			$('#address').val(data.address);
			$('#address_detail').focus();
        }
    }).open();*/
	getpost();
	return false;
});
</script>







<!-- <input type="text" id="sample3_address" placeholder="주소"><br>
<input type="text" id="sample3_postcode" placeholder="우편번호">
<input type="text" id="sample3_detailAddress" placeholder="상세주소">
<input type="text" id="sample3_extraAddress" placeholder="참고항목"> -->



<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    // 우편번호 찾기 찾기 화면을 넣을 element
    var element_wrap = document.getElementById('address_wrap');

    function foldDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_wrap.style.display = 'none';
    }

    function getpost() {
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                  //  document.getElementById("sample3_extraAddress").value = extraAddr;
                
                } else {
                    //document.getElementById("sample3_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
              //  document.getElementById('sample3_postcode').value = data.zonecode;
                document.getElementById("address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("address_detail").focus();

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = 400+'px'//size.height+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    }
</script>

<?php
include 'views/footer.html';
?>