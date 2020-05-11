<?php	
	
	$path = '';
	$where = 'is_admin = 0';
	
	addKeywordCondition($path,$where,$param['search_type'],$param['search_keyword'],true);
	$pagingTags = $melon['dir'].'/page/$page'.$path;
	
	$users = pageList('users',$where,'',10,10,$param['page'],$pagingTags);
	include'views/admin/document.html';
	include'views/admin/header.html';
?>		


<h2 id="contents_title">
	<i class="fa fa-leaf"></i>
	회원관리
</h2>
<div class="contents">
	
	<div class="container">
		<h3 class="title">
			<i class="fa fa-users"></i> 회원 리스트
		</h3>
		<div class="row">
			<table class="table horizontal">
				<tr>
					<th>
						검색
					</th>
					<td>
						<select name="">
							<option value="">아이디</option>
							<option value="">이름</option>
						</select>
						<input type="text" />
					</td>
				</tr>
			</table>
		</div>
		<table class="table">
			<tr>
				<th>
					No
				</th>
				<th>
					 아이디
				</th>
				<th>
					 이름
				</th>
		
				<th>
					가입일
				</th>
			
				<th>
					관리
				</th>
			
			</tr>
			<?php
				foreach($users['list'] as $user){
			?>
				<tr class="table-row-link" data-href="/admin/user/view/no/<?=$user['no']?>">
					<td>
						 <?=$user['no']?>
					</td>
					<td>
						 <?=$user['id']?>
					</td>
					<td>
						 <?=$user['name']?>
					</td>
					<td>
						  <?=$user['create_date']?>
					</td>
					<td class="admin_buttons">
						<a href="/admin/user/write/no/<?=$user['no']?>" class="btn btn-sm green">
						<i class="fa fa-pencil"></i> 수정 
						</a>
						<a href="/admin/user/delete/no/<?=$user['no']?>" class="btn btn-sm btn-danger delete-button">
						<i class="fa fa-trash-o"></i> 삭제 
						</a>
		
					</td>
				
				
				</tr>
			<?php
				}
			?>
			
		</table>
		<div class="pagination">
			<?=$users['pagination']?>
		</div>
	
	</div>
	
</div>




		
<?php
	include'views/admin/footer.html';
?>