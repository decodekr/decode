<?php	
	$user = getItem('users',$param['no']);
	include'views/admin/document.html';
	include'views/admin/header.html';
?>		
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-user font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">회원 관리</span>
		</div>

	</div>
	<div class="portlet-body form">
	<div class="form-horizontal form-bordered ">
			<div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3">이름</label>
					<div class="col-md-4">
						<?=$user['name']?>
						
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">아이디</label>
					<div class="col-md-4">
						<?=$user['id']?>
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">비밀번호</label>
					<div class="col-md-4">
						<?=$user['password']?>
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">회원등급</label>
					<div class="col-md-4">
						<?=$user['grade']?>
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</div>
				</div>
				<?php
					if ($param['no']) {
				?>
				<div class="form-group">
					<label class="control-label col-md-3">가입일</label>
					<div class="col-md-4">
						<?=$user['create_date']?>
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</div>
				</div>
				<?php
					}
				?>
				
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-5 col-md-9">
						<a href="/admin/user/write/no/<?=$user['no']?>" class="btn green">
						수정 <i class="fa fa-pencil"></i>
						</a>
						<a href="/admin/user/delete" class="btn btn-danger delete-button">
						삭제 <i class="fa fa-trash-o"></i>
						</a>
						<a href="" class="btn btn-default cancel-button">
						
						목록
						<i class="fa fa-arrow-left"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include'views/admin/footer.html';
?>