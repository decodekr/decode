<?php	
	if($param['has_data']==1){

		updateItem('site_configs',$param,1);
		redirect('/admin/config');
		exit;
	}
	$config = getItem('site_configs');
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
			<i class="fa fa-users"></i> 사이트 기본정보
		</h3>
		<form action="" method="post" class="form-horizontal form-bordered ">
			<input type="hidden" name="has_data" value="1" />
			<table class="table horizontal" >
				<tr>
					<th>사이트명</th>
					<td>	
						<input type="text" name="site_name" class="form-control" value="<?=$config['site_name']?>" />
					</td>
				</tr>
				<tr>
					<th>사이트 타이틀</th>
					<td>
						<input type="text" name="title" class="form-control" value="<?=$config['title']?>" />
					</td>
				</tr>
				<tr>
					<th>개인정보 처리방침</th>
					<td>
						<textarea name="privacy_agreement" class="ckeditor"><?=$config['privacy_agreement']?></textarea>
					</td>
				</tr>
				<tr>
					<th>이용약관</th>
					<td>
						<textarea name="usage_agreement" class="ckeditor"><?=$config['usage_agreement']?></textarea>
					</td>
				</tr>
				<tr>
					<th>모바일 사용 여부</th>
					<td>
						<input type="radio" id="radio1" name="use_mobile" value="1"   <?=attr($config['use_mobile']==1,'checked')?>> 사용
						<input type="radio" id="radio2" name="use_mobile" value="0"  <?=attr($config['use_mobile']==0,'checked')?>> 사용안함
					</td>
				</tr>


				
			</table>
			<div class="buttons">
				<input type="submit" value="수정" class="btn btn-blue">
			</div>


		</form>
	
	</div>
	
</div>





<?php
	include'views/admin/footer.html';
?>