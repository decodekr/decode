<?php
include'models/payment.php';

if($param['virtual_account_nunber']){
	insertItem('users',$param);
	}
$banks= jsonDecode(getBankList());
$user=getItem('users',$_SESSION['login']);



include 'views/header.html';
?>
<?php
	
	if($_FILES['business_licence_file']['name']){
		$business_licence_file = uploadFile($_FILES['business_licence_file'],'/files');
		$param['business_licence_file']= $business_licence_file['path'].'|'.$business_licence_file['name'];
	}
	if($_FILES['business_account_file']['name']){
		$business_account_file = uploadFile($_FILES['business_account_file'],'/files');
		$param['business_account_file']= $business_account_file['path'].'|'.$business_account_file['name'];
	}
	
	
	

	if(strpos($param['type'],'seller')!==FALSE){
		$param['user_type']='seller';
	//	$session['user_type']='seller';
	//	updateItem('users',$param,$session['login']);
//		$type='first';
		
	}
	if(strpos($param['type'],'buyer')!==FALSE){
		$param['user_type']='buyer';
	//	$session['user_type']='buyer';
//	updateItem('users',$param,$session['login']);
//	$type='first';
	}
      if($param['has_data']){
		if(is_array($param['expect_product'])){
			$param['expect_product'] = implode('|',$param['expect_product']);
		}
		$session['user_type']=$param['user_type'];
		updateItem('users',$param,$session['login']);
	  
		printMessage('수정 완료');
		exit;
	  }
	  
		$user=getItem('users',$session['login']);
		if($user['user_type']=='buyer'){
			$user['expect_product'] = explode('|',$user['expect_product']);
		}
	  
?>

<?php

if($user['user_type']=='seller'){
	include'views/seller_mypage.html';
}
else{
	include'views/buyer_mypage.html';
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


<script>
						

</script>
<?php
include 'views/footer.html';
?>