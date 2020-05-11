<?php	
	if($param['has_data']==1){
		if($param['no']){
			updateItem('users',$param,$param['no']);
		}
		else{
			insertItem('users',$param,$param['no']);
		}
		
		redirect('/admin/user');
		exit;
	}
	if($param['no']){
		$user = getItem('users',$param['no']);
	}
	include'views/admin/document.html';
	include'views/admin/header.html';
?>		
<h2 id="contents_title">
	<i class="fa fa-leaf"></i>
	기본설정
</h2>
<div class="contents">
	<div class="container">
		<h3 class="title">
			<i class="fa fa-users"></i> 회원정보
		</h3>
		<form action="" method="post" class="form-horizontal form-bordered ">
			<input type="hidden" name="has_data" value="1" />
			<input type="hidden" name="no" value="<?=$param['no']?>" />
			<table class="table horizontal">
				<tr>
					<th>
						이름
					</th>
					<td>
						<input type="text" name="name" value="<?=$user['name']?>" />
					</td>			
				</tr>
				<tr>
					<th>
						아이디
					</th>
					<td>
						<input type="text" name="id" value="<?=$user['id']?>" />
					</td>			
				</tr>
				<tr>
					<th>
						비밀번호
					</th>
					<td>
						<input type="text" name="password" value="<?=$user['password']?>" />
					</td>			
				</tr>
				<tr>
					<th>
						회원등급
					</th>
					<td>
						<input type="text" name="grade" value="<?=$user['grade']?>" />
					</td>			
				</tr>
				<?php
					if ($param['no']) {
				?>
				<tr>
					<th>
						가입일
					</th>
					<td>
						<input type="text" name="create_date" ㅊ value="<?=$user['create_date']?>" class="datepicker">
					</td>			
				</tr>
				<?php
					}
				?>
			</table>
			<div class="buttons">
				<input value="수정" type="submit" class="btn btn-blue btn-large"></a>
				<a href="/admin/user/delete/no/<?=$param['no']?>" class="btn btn-red btn-large delete-button">삭제</a>
				<a href="/admin/user" class="btn btn-gray btn-large">목록</a>
			</div>
		</form>
	</div>
</div>
	

<?php
	include'views/admin/footer.html';
?>