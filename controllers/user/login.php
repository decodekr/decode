<?php
include 'views/header.html';
?>
<?php

    if($param['has_data']==1){

       if($param['id']==''){
          printMessage('아이디를 입력해주세요');
          exit;
       }
        if($param['password']==''){
            printMessage('비밀번호를 입력해주세요');
            exit;
        }
        $password = $param['password'];
        $id = $param['id'];
        $user=getItem('users','id="'.$id.'"');

        if(!$user) {
            printMessage('아이디 또는 비밀번호를 확인해주세요');
            exit;
        }
        else {
            if($user['password']!=$param['password']){
                printMessage('아이디 또는 비밀번호를 확인해주세요');
                exit;
            }
            else{
				if($user['user_type']!=$param['user_type']){
				 printMessage('아이디 또는 비밀번호를 확인해주세요');
                exit;
				}
               $session['login']=$user['no'];
               $session['id']=$user['id'];
               $session['name']=$user['name'];
               $session['user_type']=$user['user_type'];

				if( $session['user_type']=='seller'){
					 getBack('/seller');
				}
				else{
					 getBack('/');
				}

               
            }
        }

        exit;
    }
?>
 <main class="site-main site-login min-height" style="padding:60px 0;">
    <div class="box-center">
        <div class="customer-login">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="title-login">로그인</h5>
                        <p class="p-title-login">로그인을 하시면 MOM의 모든 서비스를 이용하실 수 있습니다.</p>
                        <form class="login" method="post" id="login_form">
						<input type="hidden" name="user_type">
							<input type="hidden" name="has_data" value="1">
							 <p class="form-row" id="user_type">
							   <label>회원유형<span class="required"></span></label><br>
                              <a href="" class="btn btn-default" data-value="seller">판매자 회원</a>
                              <a href="" class="btn btn-default" data-value="buyer">구매자 회원</a>
                            </p>
                            <p class="form-row form-row-wide">
                                <label>이메일<span class="required"></span></label>
                                <input type="text" value="" name="id"
                                       placeholder="이메일" class="input-text">
                            </p>
                            <p class="form-row form-row-wide">
                                <label>비밀번호:<span class="required"></span></label>
                                <input type="password" name="password" placeholder="************" class="input-text">
                            </p>
                            <a href="#" class="forgot-password">비밀번호 재설정</a>
                            <p class="form-row">
                                <input type="submit" value="로그인" name="Login" class="button-submit">
                            </p>
                           
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
	</main>

	<script>
		
		$('#user_type a').click(function(){
			$(this).addClass('btn-primary').removeClass('btn-default');
			$(this).siblings().addClass('btn-default').removeClass('btn-primary')
			
			$('[name="user_type"]').val($(this).data('value'));
			return false;

		});

		$('#login_form').submit(function(){
			if($('#user_type a.btn-primary').size()==0){
				Swal.fire({
		  title: '',
		  text: '회원 유형을 선택해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
			}
		})


	</script>
<?php
include 'views/footer.html';
?>