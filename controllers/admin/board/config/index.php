<?php	
	
	$path = '';
	$where = '';
	
	addKeywordCondition($path,$where,$param['search_type'],$param['search_keyword'],true);
	$pagingTags = $melon['dir'].'/page/$page'.$path;
	
	$boards = pageList('boards',$where,'',20,10,$param['page'],$pagingTags);
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
			<i class="fa fa-users"></i> 회원 리스트
		</h3>
		<table class="table need-result">
				<thead>
					<tr>
						<th style="width:60px;">
							No
						</th>
						<th>
							게시판 그룹 이름
						</th>
						<th>
							 게시판 아이디
						</th>
						<th>
							 게시판명
						</th>
				
						<th>
							 스킨
						</th>
				
						<th>
							등록일
						</th>
					
						<th style="width:300px;">
							관리
						</th>
					
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($boards['list'] as $board){
				?>
					<tr class="table-row-link" data-href="/admin/board/config/write/no/<?=$board['no']?>">
						<td>
							 <?=$board['no']?>
						</td>
						<td>
							 <?=$board['group_name']?>
						</td>
						<td>
							 <?=$board['id']?>
						</td>
						<td>
							 <?=$board['name']?>
						</td>
						<td>
							 <?=$board['skin']?>
						</td>
						<td>
							  <?=$board['create_date']?>
						</td>
						<td class="admin_buttons" style="width:300px;">
							<a href="/board/<?=$board['id']?>" class="btn btn-sm blue" target="_blank">
							 <i class="fa fa-link"></i> 바로가기
							</a>
							<a href="/admin/board/config/write/no/<?=$board['no']?>" class="btn btn-sm green">
							<i class="fa fa-pencil"></i> 수정 
							</a>
							<a href="/admin/board/config/delete/no/<?=$board['no']?>" class="btn btn-sm btn-danger delete-button">
							<i class="fa fa-trash-o"></i> 삭제 
							</a>
			
						</td>
					
					
					</tr>
				<?php
					}
				?>
			
				</tbody>
			</table>
			
		
		<div class="pagination">
			<?=$boards['pagination']?>
		</div>
		<div id="buttons">
			<a href="/admin/board/config/write" class="btn">등록</a>
		</div>
	</div>
</div>
	


		
<?php
	include'views/admin/footer.html';
?>