<?php	
	if($param['has_data']==1){
		$param['is_admin'] = 1;
		if($param['no']){
			updateItem('users',$param,$param['no']);
		}
		else{
			insertItem('users',$param,$param['no']);
		}	
		redirect('/admin/master');
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
		<form action="" method="post" class="form-horizontal form-bordered ">
			
			<input type="hidden" name="has_data" value="1" />
			<table class="table horizontal">
	
				<tr>
					<th>이름</th>
					<td>
						
						<input type="text" name="name" value="<?=$user['name']?>">
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</td>
				</tr>
				<tr>
					<th>아이디</th>
					<td>
						<input type="text" name="id" value="<?=$user['id']?>" <?=attr($user['id']==$siteConfig['admin_id'],'disabled')?>>
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</td>
				</tr>
				<tr>
					<th>비밀번호</th>
					<td>
						<input type="text" name="password" value="<?=$user['password']?>">
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</td>
				</tr>
				<tr>
					<th>회원등급</th>
					<td>
						<input type="text" name="grade" value="<?=$user['grade']?>">
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</td>
				</tr>
				<?php
					if ($param['no']) {
				?>
				<tr>
					<th>가입일</label>
					<td>
				
						<input type="text" name="create_date" class="datepicker" readonly value="<?=$user['create_date']?>">
					</td>
				</tr>
					
				<?php
					}
				?>
				
			</table>
			<div class="buttons">
					<input type="submit" class="btn btn-large btn-blue" value="<?=attr($param['no'],'수정','등록')?>">
					<a href="/admin/master/delete/no/<?=$param['no']?>" class="btn btn-large btn-red delete-button">
					삭제 <i class="fa fa-trash-o"></i>
					</a>
					<a href="" class="btn btn-large">
					
					목록
					<i class="fa fa-arrow-left"></i>
					</a>
			</div>
		</form>
	</div>
</div>
   


<?php
	include'views/admin/footer.html';
?>