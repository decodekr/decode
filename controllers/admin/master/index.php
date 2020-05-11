<?php	

	$path = '';
	$where = 'is_admin = 1';
	
	addKeywordCondition($path,$where,$param['search_type'],$param['search_keyword'],true);
	$pagingTags = $melon['dir'].'/page/$page'.$path;
	
	$users = pageList('users',$where,'',10,10,$param['page'],$pagingTags);
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
		<table class="table need-result">
					<thead>
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
					</thead>
					<tbody>
					<?php
						foreach($users['list'] as $user){
					?>
						<tr class="table-row-link" data-href="/admin/master/view/no/<?=$user['no']?>">
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
								<a href="/admin/master/write/no/<?=$user['no']?>" class="btn btn-sm green">
								수정 <i class="fa fa-pencil"></i>
								</a>
								<?php
									if($siteConfig['admin_id']!=$user['id']){			
								?>
								<a href="/admin/master/delete/no/<?=$user['no']?>" class="btn btn-sm btn-danger delete-button">
								삭제 <i class="fa fa-trash-o"></i>
								</a>
								<?php
									}
								?>
				
							</td>
						
						
						</tr>
					<?php
						}
					?>
					<!-- <?=attr($users['length']==0,'<tr><td colspan="5">조회 결과가 없습니다.</td></tr>')?>
			 -->
					</tbody>
				</table>
				
			
			<div class="pagination">
				<?=$users['pagination']?>
			</div>
	</div>
</div>
		
		
<?php
	include'views/admin/footer.html';
?>