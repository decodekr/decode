<?php	
	
	$path = '';
	$where = 'is_admin = 0';
	
	if($param['has_data']=='next_category'){
		$nextCategories=getList('product_categories','category_group="'.$param['category_group'].'" AND product_type="'.$param['type'].'"','','','no asc');
		echo jsonEncode($nextCategories);
		exit;
	}

	include'views/admin/document.html';
	include'views/admin/header.html';
?>		


<h2 id="contents_title">
	<i class="fa fa-gear"></i>
	제품관리
</h2>
<div class="contents">
	
	<div class="container">
		<h3 class="title">
			<i class="fa fa-gear"></i> 상품 카테고리 리스트
			<!-- <a href="" id="back_button">
					<i class="fa fa-arrow-left"></i>
					뒤로

			</a> -->
		</h3>
	
		<ul id="categories">
				<li>
					<a href="" data-next="pipe" data-type="pipe">
						PIPE

					</a>
					<div class="btns">
							<a href="/admin/category/add?parent_category_group=pipe" class="btn">추가</a>
				

					</div>
				
					

				</li>
				<li>
					<a href=""  data-next="valve" data-type="valve">
						VALVE

					</a>
					<div class="btns">
							<a href="/admin/category/add?parent_category_group=valve" class="btn">추가</a>
				

					</div>
					

				</li>
				<li>
					<a href=""  data-next="fitting" data-type="fitting">
						FITTING

					</a>
					<div class="btns">
							<a href="/admin/category/add?parent_category_group=fitting" class="btn">추가</a>
				

					</div>
					

				</li>
				<li>
					<a href=""  data-next="flange" data-type="flange">
						FITTING

					</a>
					<div class="btns">
							<a href="/admin/category/add?parent_category_group=flange" class="btn">추가</a>
				

					</div>
					

				</li>
				

		</ul>
		
	</div>
	
</div>


<style>
	
	#back_button{
		display: block;

		margin-left: 250px;
		font-size:22px;
		color: #222;
		width: 110px;
		border: 2px solid #ddd;
		border-radius:22px;;
		padding: 15px;
	}
#categories li {
	width: 130px;
	
	line-height: 33px;
	border: 1px solid #ddd;
	text-align: center;
}
#categories li a{
	color: #222;
	
}
</style>

<script>
	$(document).on('click','#categories li a:not(.btn)',function(){
		var categoryGroup =  $(this).data('next');
		var type= $(this).data('type');
		var $this = $(this);
		var step=1;
		if(categoryGroup==''){
			alert('마지막 카테고리입니다.');
			return false;
		}
		if($(this).parent().find('ul').size()==0){
			$(this).parent().siblings().hide();
			postRequest({
				url : '',
				data : {category_group:categoryGroup,has_data : 'next_category',type:type},
				success : function($data){
					var  $template=  [];
					for(var iu=0;iu<$data.list.length;iu++){
						if($data.list[iu].additional_info==''){
							additional = ''
						}
						else{
							additional = '('+$data.list[iu].additional_info+')'
						}
						$template.push('<li style="margin-left : '+(step * 132)+'px"><a href="" data-next="'+$data.list[iu].next_category_group+'" data-type="'+$data.list[iu].product_type+'">'+$data.list[iu].name+additional+'</a><div class="btns"><a href="" class="btn">추가</a><a href="" class="btn">수정</a></div></li>');
					}
					$this.parent().append('<ul>'+$template.join('')+'</ul>')
					

				}


			});
		}
		else{
			$(this).parent().find('ul').remove();
			$(this).parent().siblings().fadeIn();

		}
		return false;
	});

</script>


		
<?php
	include'views/admin/footer.html';
?>