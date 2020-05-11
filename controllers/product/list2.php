<?php
	
	$where=  '';
	if($param['keyword']){
		if($where!=''){
			$where.=' AND ';
		}
		$where.='details like "%'.$param['keyword'].'%"';
	}
	if($param['category']){
		if($where!=''){
			$where.=' AND ';
		}
		$where.='details like "%'.$param['category'].'%"';
	}
		if($param['bottom_keywords'][0]!=''){	
			foreach($param['bottom_keywords'] as $bottomKeyword){
				if($where!=''){
					$where.=' AND ';
				}
				$where.='details like "%'.$bottomKeyword.'%"';
			}
		}
	$param['product_type'] =$param['category'];
	

$products=getList('product_lists',$where);
	include'views/header.html';
?>
<style>
#search_wrap{
padding: 40px 0;
}
	#search_left{
	float: left;
	position: relative;

	width: 330px;
}
	#search_right{
	width: 870px;
	float: right;
	margin-left: 30px;
}
.block-search{
	margin: 10px;
	width: auto;
}
.form-search .form-control{
border: 0;
width: 756px;
}
.block-search .block-content{
text-align: left;
}
.filter-options .filter-options-title{
	
}
.filter-options-content .label{
margin-right: 10px;
}
</style>
<main class="site-main site-login">
<div class="container" id="search_wrap">
<div id="search_left">




	<div class="filter-options">
		  <div class="block-content">
			<div class="filter-options-item filter-categori categories">
                  <div class="filter-options-title">품목</div>
					<div class="filter-option-contents">
						<label class="inline">
							<input type="checkbox" name="product_type" value="pipe" data-next="pipe" data-type="pipe">
							<span class="input"></span> Pipe
                         </label>&nbsp;&nbsp;
						 <label class="inline">
							<input type="checkbox" name="product_type" value="valve" data-next="valve" data-type="valve">
							<span class="input"></span> Valve
                         </label>&nbsp;&nbsp;
						 <label class="inline">
							<input type="checkbox" name="product_type" value="fitting" data-next="fitting" data-type="fitting">
							<span class="input"></span> Fitting
                         </label>
						 <label class="inline">
							<input type="checkbox" name="product_type" value="flange" data-next="flange" data-type="flange">
							<span class="input"></span> FLANGE
                         </label>

					</div>
			</div>
		  </div>
	</div>



	<style>
	#search_layer{
		display: none;
		position: absolute;z-index: 10000;
		top: 0;
		left: 0;
		width: 330px;
		border-radius:10px;
		border: 1px solid #ddd;
			height: 440px;
			background: #fff;
	}
	#search_layer h3{
		position: relative;
		text-indent: 10px;
		line-height: 40px;
		font-size:20px;
		margin-bottom: 0;
		font-weight: bold;
	}
	#search_layer h3 .close_button{
		line-height: 25px;
		width: 25px;
		height: 25px;
		position: absolute;
		top: 10px;
		right: 10px;
		border: 1px solid #bdbfc3;
		border-radius:2px;
		text-align: center;
		font-family: arial;
		color: #bdbfc3;
		font-weight: normal;
		text-indent: 0;
	}
	#search_result{
		height: 330px;
		overflow: auto;
	}
	#search_layer_input{
		background: #232a34;
		position: relative;
		padding: 11px 30px;
	}
	#search_layer_input input{
		width: 100%;
		height: 32px;
		padding: 10px 2px;
		border-radius:4px;
		border: 1px solid #5a626d;
		box-sizing:border-box;
		background: transparent;
	}
	#search_layer_input i{
		position: absolute;
		top: 17px;
		right: 40px;
	}
	#search_result li{
		list-style: none;
		line-height: 33px;
		padding: 5px;
		margin-bottom: 0;
		border-bottom: 1px solid #ddd;
	}
</style>
<div id="search_layer">
	<h3>
	<span class="title">Flicker</span>
		선택
		<a href="" class="close_button">X</a>
	</h3>
	<div id="search_layer_input">
			<input type="text" placeholder="검색어 입력"><i class=" fa fa-search"></i>

	</div>
	<ul id="search_result">
		

	</ul>
	
</div>



</div><!-- AND LEFT-->


	<div id="search_right">
	<div class="block-search" >
					<div class="block-content">
						
						<div class="form-search">
							
								<div class="box-group">
									<input type="text" name="keyword" id="search_keyword_input" placeholder="카테고리를 선택하고 검색어를 ,(컴마)로 구분하여 입력해주세요." class="form-control" value="">
									<button class="btn btn-search" type="button" id="search_button"><span class="fa fa-search"></span></button>
								</div>
							
						</div>
					</div>
				</div>
		  <table class="search-list-table" >
				 <thead>
                <tr>
                    <th><input type="checkbox" id="check_all"></th>
                    <th>Matching</th>
                    <th>CATEGORY</th>
                    <th>PRESSURE RATING</th>
                    <th>MATERIAL GRADE</th>
                    <th>SIZE</th>
             
                    
                    <th>MANUFACTURER</th>
           
                </tr>
                </thead>
                <tbody>
				<tr>

					<td colspan="7">선택 목록이 없습니다.</td>
				</tr>
				</tbody>
		  </table>

	</div>   
	



</div>

 </main>


<script>

	var currentSelect = 0;
	var serach  = [];
		$(document).on('click','#product_list_search_form input',function(){
	$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
});
	$(document).on('click','.filter-option-contents input',function(){
		search(this);
	
	});

	$(document).on('click','.search_button',function(){
		currentSelect  =$(this).closest('.filter-options').index();
		$('#search_layer').slideDown().find('#search_result').html($(this).next().html());
		return false;

	});
	$(document).on('click','#search_result input',function(){
		search(this);
		$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
		

	});
	$('.close_button').click(function(){
		$('#search_layer').slideUp();
		return false;
	});
	$('#search_layer_input input').keyup(function(){
		var keyword = $(this).val();
		$('#search_result li').hide();
		$('#search_result li:contains("'+keyword+'")').show();
	});

	function search($elem){
		var categoryGroup =  $($elem).data('next');
		var type= $($elem).data('type');
		var $this = $($elem);

		var $parent = $('.filter-options').eq(currentSelect);
		var $check= $($elem).prop('checked');

		if($($elem).attr('name')=='product_type'){
			$('.chosen-single').text($($elem).parent().text())
				
				$('#search_category').val($($elem).val())
		}
		

		$('.filter-options').eq(currentSelect).find('.filter-options-content .label').text($($elem).val());
	
		$parent.nextAll('.filter-options').remove();
	
	
		
		if(categoryGroup){
		//if($(this).parent().find('ul').size()==0){
			$($elem).parent().siblings().hide();
			postRequest({
				url : '/product/add',
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
						$template.push('<li><label class="inline"><input type="checkbox" name="'+$data.list[iu].category_group+'" value="'+$data.list[iu].name+additional+'" data-next="'+$data.list[iu].next_category_group+'" data-type="'+$data.list[iu].product_type+'"><span class="input"></span>'+$data.list[iu].name+additional+' </label></li>');
					}
					$parent.after(' <div class="filter-options"><div class="block-content"><div class="filter-options-item filter-categori categories"><div class="filter-options-title">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+'</div><div class="filter-options-content"><span class="label label-default"></span><a href="" class="btn btn-default search_button">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+' 선택</a><ul style="display:none;" >'+$template.join('')+'</ul></div></div></div></div>')
				$('#search_layer').slideUp()
				//	$('#search_layer').slideDown().find('#search_result').html($template.join(''));
					

				}


			});
		}
		else{
			$('#search_layer').slideUp()
		}
	}



	$(window).scroll(function(){
		var top = $(this).scrollTop();
		console.log(top);
		$('#search_layer').css({top : top})
	});
</script>



	<?php

	include'views/footer.html';
?>