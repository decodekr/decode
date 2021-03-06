<?php	
	if($param['has_data']==1){
		if($param['no']){
			updateItem('product_categories',$param,$param['no']);
		}
		else{
			insertItem('product_categories',$param,$param['no']);
		}
		
		redirect('/admin/product');
		exit;
	}
	if($param['no']){
		$product = getItem('product_categories',$param['no']);
	}
	include'views/admin/document.html';
	include'views/admin/header.html';
?>		
<h2 id="contents_title">
	<i class="fa fa-leaf"></i>
	상품 카테고리 관리
</h2>
<div class="contents">
	<div class="container">
		<h3 class="title">
			<i class="fa fa-users"></i> 카테고리 등록/수정
		</h3>
		<form action="" method="post" class="form-horizontal form-bordered ">
			<input type="hidden" name="has_data" value="1" />
			<input type="hidden" name="no" value="<?=$param['no']?>" />

			<input type="hidden" name="next_category_group">
			<input type="hidden" name="category_group">
			<table class="table horizontal">
				<tr>
					<th>
						카테고리명
					</th>
					<td>
						<input type="text" name="name" value="<?=$product['name']?>" />
					</td>			
				</tr>
				<tr>
					<th>
						검색 키워드
					</th>
					<td>
						<input type="text" name="keyword" value="<?=$product['keyword']?>" />
					</td>			
				</tr>
				<tr>
					<th>
						추가정보
					</th>
					<td>
						<input type="text" name="additional_info" value="<?=$product['additional_info']?>" />
					</td>			
				</tr>
				
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