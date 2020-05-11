<?php
	if($param['has_data']==1){
		$user = getItem('users','id="'.$param['id'].'" AND is_admin=1');
		if(!$user){
			printMessage('아이디 또는 비밀번호를 확인해주세요.');

		}
		else{
			if($user['password'] != $param['password']){
				printMessage('아이디 또는 비밀번호를 확인해주세요.');
			}
			else{
				$session['login'] = $user['no'];
				$session['id'] = $user['id'];
				$session['name'] = $user['name'];
				$session['is_admin'] = $user['is_admin'];
				$session['grade'] = $user['grade'];
				getBack('/admin/config');
			}

		}
		exit;
	}
	include 'views/admin/document.html';
?>
<div id="wrap">
	<div id="login_form">
		<form class="login-form" action="" method="post">
			<input type="hidden" name="has_data" value="1" />
			<div class="row">
				<img src="/images/admin/admin_login.gif" alt="" id="logo">
			</div>
			<div class="row">
				<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="관리자 아이디" name="id"/>
			</div>
			<div class="row">
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="비밀번호" name="password"/>
			</div>
			<div class="row">
				<input type="submit" id="login_button" value="LOGIN">
			</div>
			<div class="row" id="description">
				<p>
					본 화면은 관리자 전용 페이지입니다.
				</p>
			</div>
		</form>
	</div>
</div>

<style type="text/css">
body{
	background:#2a3954;
}
	#login_form{
		width:400px;
		height:350px;
		margin:100px auto;
		background:#fff;
		background:#ddd;
		padding:15px;
		border:5px solid #999;
		border-radius:7px;
	}
	#login_form #logo{
		width:200px;
		margin:20px 0;
	}
	#login_form .row{
		margin:8px 0;
		text-align:center;
	}
	#login_form .row input[type="text"],#login_form .row input[type="password"]{
		width:100%;
		height:20px;

		padding:10px 0;
		border:1px solid #eee;
		border-radius:7px;
	}
	#login_button{
		display:block;
		width:100%;
		height:40px;
		color:#fff;
		border-radius:7px;
		background:#111626;
	}
	#login_form #description{
		margin-top:20px;
		font-size:14px;
		color:#333;
	}
</style>

