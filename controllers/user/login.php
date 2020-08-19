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
				// printMessage('아이디 또는 비밀번호를 확인해주세요');
                //exit;
				}
               $session['login']=$user['no'];
               $session['id']=$user['id'];
               $session['name']=$user['name'];
               $session['user_type']=$user['user_type'];
				if($param['page']){
					 getBack($param['page']);
				}
				else{
					if( $session['user_type']=='seller'){
						 getBack('/seller?now_login=1');
					}
					else{
						 getBack('/');
					}
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
						<input type="hidden" name="page" value="<?=$_SERVER["HTTP_REFERER"]?>">
							<input type="hidden" name="has_data" value="1">
							 <!-- <p class="form-row" id="user_type">
							   <label>회원유형<span class="required"></span></label><br>
                              <a href="" class="btn btn-default" data-value="seller">판매자 회원</a>
                              <a href="" class="btn btn-default" data-value="buyer">구매자 회원</a>
                            </p> -->
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
                                <button type="button" class="button-join">회원가입</button>
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

		$('.button-submit').click(function(){
			var id = $('[name="id"]').val();
			var password = $('[name="password"]').val();
			postRequest({
				url : '/user/valid_user',
				data: {id : id,password:password},
				success : function($data){
					
					if($data.result==1){
						Swal.fire({
						  title: '',
						  text: '아이디 또는 비밀번호를 확인해주세요.',
						  icon: 'error',
						  confirmButtonText: '확인'
						})
					}
						else{
						$('#login_form').submit();
						}
				}
			})
			/*if($('#user_type a.btn-primary').size()==0){
				Swal.fire({
		  title: '',
		  text: '회원 유형을 선택해주세요.',
		  icon: 'error',
		  confirmButtonText: '확인'
		})
			return false;
			}*/
			return false;
		})


	
  $(".forgot-password").on("click", function(e){
                    e.preventDefault();

                    var pop_url = '/user/find';
                    var newWin = window.open(
                        pop_url, 
                        "social_sing_on", 
                        "location=0,status=0,scrollbars=1,width=600,height=500"
                    );

                    if(!newWin || newWin.closed || typeof newWin.closed=='undefined')
                         alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

                    return false;
                });


		$('.button-join').click(function () {

		    location.href = "/user/join_send_mail";

		    return false;

        });

</script>
<?php
include 'views/footer.html';
?>