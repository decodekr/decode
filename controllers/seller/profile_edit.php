<?php

	include'views/header.html';
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


<main class="site-main site-login">

<div class="container">
	<?php
	include'views/seller_tab.html';
?>

</div>

	

        <div class="container">
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
                                    <label>주소<span class="required"></span></label>
                                </p>
                                <div class="form-group form-row-wide">
                                    <label class="inline"><input type="checkbox" name="address_country"  value="국내" <?=attr($user['address_country']=='국내','checked')?>><span class="input"></span>국내</label>
                                    <label class="inline"><input type="checkbox" name="address_country" value="해외"  <?=attr($user['address_country']=='해외','checked')?>><span class="input"></span>해외</label>
                                </div>
                                <p class="form-row form-row-wide">
                                    <label>도로명 주소</label>
                                    <input type="text"  name="address" placeholder=""   value="<?=$user['address']?>"  class="input-text">
                                </p>
                                <p class="form-row form-row-wide">
                                    <label>상세 주소</label>
                                    <input type="text"  name="address_detail" placeholder=""     value="<?=$user['address_detail']?>" class="input-text">
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
                                </p><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


<script>
	$('.close_button').click(function(){
		$('#order_detail_layer,#fog').fadeOut();
		return false;
	});
	$('#order_list tr').click(function(){
	var no = $(this).data('no');
	postRequest({
		url : '',
		data: {cart_info:1,order_no:no},
		dataType:'HTML',
		success : function($data){
			$('#order_detail_layer,#fog').slideDown();
			$('#order_detail_layer tbody').html($data);
		}

	})
});

</script>
<?php
	include'views/footer.html';
?>