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
<main class="site-main site-login">
        <div class="box-center-3">
			<br>
			<form id="product_list_search_form" method="post">
<?php
if($param['product_type']!=''){
?>












            <div class="row row-filter" style="position:relative;">










				<div id="left_filter">
			<div class="category_list_wrap">
				<h3>Valve</h3>
				<ul class="category_list">
				
					<li class="active">
						<a href="">품목</a>
						<ul class="sub_category">
							<li>
									<a href="">Ball Balve</a>
									
							</li>
						
						</ul>

					</li>

			

<li>
						<a href="">Connect Type</a>
						

					</li>


				</ul>

			</div>
		

			

		</div>




		<style>
		li{
		list-style: none;
		}
#left_filter{
		position: absolute;
		left: -273px;
		-webkit-transition:0.5s;
		padding-left: 30px;
		top: 0;/*90*/
		width: 273px;
		background: #fff;
		height: 100%;
		padding-top: 35px;
		/*border-right: 1px solid #bdbdbd*/
		}
#left_filter h3{
	line-height: 50px;
	font-size:21px;
	font-weight: bold;
	color: #191919;
	border-bottom: 2px solid #6A55A8;
}
.category_list_wrap{
padding-right: 70px;margin-bottom: 25px;	
}
.category_list>li>a{
	font-size:17px;
	line-height: 38px;
	color: #191919;
	display: block;
	
}
.category_list>li.active>a{
	font-weight: bold;
}
 .sub_category{
	display: none;
 }

.category_list>li.active .sub_category{
padding-left: 25px;
display: block;
padding-top: 7px;
padding-bottom: 7px;
border-top: 1px solid #bcbcbc;
border-bottom: 1px solid #bcbcbc;
margin-bottom: 20px;
}
.sub_category>li>a{
	display: block;
	line-height: 30px;
	font-size:14px;
	
}
.category_list_wrap h4{
	line-height: 42px;
	font-weight: bold;
	font-size:17px;
}
.category_list_wrap .filter_wrap{

border-bottom: 1px solid #e3e3e3;
padding: 15px 0;
}
#left_filter .check_wrap{
	line-height: 24px;
}
.check_wrap input{
	margin-right: 5px;
}
footer{
position: relative;
z-index: 1000;
}
		</style>











                <div class="filter-options">
                    <div class="block-content">
                           <div class="filter-options-item filter-categori categories">
                            <div class="filter-options-title">품목</div>
                            <div class="filter-options-content">
                                <ul >
                                    <li><label class="inline"><input type="checkbox" name="product_type" value="pipe" data-next="pipe" data-type="pipe"><span class="input"></span> Pipe
                                    </label></li>
									 <li><label class="inline"><input type="checkbox" name="product_type" value="valve" data-next="valve" data-type="valve"><span class="input"></span> Valve
                                    </label></li>
									 <li><label class="inline"><input type="checkbox"  name="product_type" value="fitting" data-next="fitting" data-type="fitting"><span class="input"></span> Fitting
                                    </label></li>
                                  
                                </ul>
                            </div>
                        </div>

<script>
	$(document).on('click','#product_list_search_form input',function(){
	$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
});
	$(document).on('click','.categories li input',function(){
		var categoryGroup =  $(this).data('next');
		var type= $(this).data('type');
		var $this = $(this);
		var step=1;
		var $parent = $this.parent().parent().parent().parent().parent();
		var $check= $(this).prop('checked');

		if($(this).attr('name')=='product_type'){
			$('.chosen-single').text($(this).parent().text())
				
				$('#search_category').val($(this).val())
		}
	
		$parent.nextAll('.categories').remove();
	
	
		if($check&&categoryGroup!=''){
		//	alert('마지막 카테고리입니다.');
	
		
		//if($(this).parent().find('ul').size()==0){
			$(this).parent().siblings().hide();
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
					$parent.after(' <div class="filter-options-item filter-categori categories"><div class="filter-options-title">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+'</div><div class="filter-options-content"><ul >'+$template.join('')+'</ul></div></div>')
					

				}


			});
		}
		else{
			$(this).parent().find('ul').remove();
			$(this).parent().siblings().fadeIn();

		}
	
	});

	$('[name="product_type"][value="<?=$param['category']?>"]').eq(0).click()

</script>

                     

                        <!-- <div class="filter-options-item filter-price">
                            <div class="filter-options-title">Price</div>
                            <div class="filter-options-content filter-options-price">
                                <div class="price_slider_wrapper">
                                    <div data-label-reasult="Price:" data-min="0" data-max="3000" data-unit="$" class="slider-range-price  ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="0" data-value-max="3000">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 2.83333%; width: 51.2333%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 42.5667%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 88.9%;"></span><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 42.5667%; width: 46.3333%;"></div></div>
                                    <div class="price_slider_amount">Price: <span>$0 </span> - <span> $3000</span></div>
                                </div>
                            </div>
                        </div> -->

                        <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">희망 운송 일정
                            </div>
                            <div class="filter-options-content">
                                <div class="filter-date">
                                  <input type="text" class="datepicker" name="end_date" value="<?=$param['end_date']?>" autocomplete="off"> 까지
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
			<?php
}	
					?>



            <!-- <div class="search-list-bar clearfix">
                <div class="search-list-bar-input">
                    <input type="text" id="todo-input-text" name="keyword" value="<?=$param['keyword']?>" placeholder="검색어 입력" class="form-control">
                </div>
                <div class="search-list-bar-button">
                    <button class="btn-primary btn-md btn-block btn waves-effect waves-light" type="button" id="todo-btn-submit">검색</button>
                </div>
            </div> -->


<!-- block search -->

<div id="search_wrap" <?=attr($param['product_type']=='','style="padding:100px 0"')?>>
	
	 <div class="block-search" style="margin:20px auto 0;">
					<div class="block-content">
						<div class="categori-search">
							<select data-placeholder="All Categories" name="category" id="search_category"
									class="chosen-select categori-search-option">
								<option value="" >카테고리 선택</option>
							   
									<option value="pipe" <?=attr($param['category']=='pipe','selected')?>>Pipe</option>
									<option value="valve"  <?=attr($param['category']=='valve','selected')?>>Valve</option>
									<option value="fitting"  <?=attr($param['category']=='fitting','selected')?>>Fitting</option>
					  
							</select>
						</div>
						<div class="form-search">
							
								<div class="box-group">
									<input type="text" name="keyword" id="search_keyword_input" placeholder="카테고리를 선택하고 검색어를 ,(컴마)로 구분하여 입력해주세요." class="form-control" value="<?=$param['keyword']?>">
									<button class="btn btn-search" type="button" id="search_button"><span
											class="fa fa-search"></span></button>
								</div>
							
						</div>
					</div>
				</div><!-- block search -->
				<div id="search_keywords" <?=attr($param['bottom_keywords'][0]!='','style="display:block;"')?>>
					<?php
						if($param['bottom_keywords'][0]!=''){	
					foreach($param['bottom_keywords'] as $bottomKeyword){
					?>
						<a href=""><?=$bottomKeyword?><input type="hidden" name="bottom_keywords[]" value="<?=$bottomKeyword?>"><span>x</span></a>
						<?php
					}
				}	
					?>

				</div>

</div><!--END SEARCH_WRAP-->

<style>
	#search_keywords{
	display: none;
	width: 800px;
	margin: 0 auto;
	line-height: 32px;
	    border: 1px solid #e0e0e0;
    border-top: 0;
	text-indent: 5px;
	font-size:14px;
    background-color: #f9f9f9;
}
#search_keywords a{
	margin-right: 25px;
}
#search_keywords span{
	color: red;margin-left: 5px;
}

</style>



      <script>
		$('#search_keyword_input').keyup(function($event){
	if($event.keyCode==188){
		var keyword = $(this).val().replace(/,/gi,"");

		if(keyword==''){
			return false;
		}
		$('#search_keywords').fadeIn();
		$(this).val('');
		$('#search_keywords').append('<a href="">'+keyword+'<input type="hidden" name="bottom_keywords[]" value="'+keyword+'"><span>x</span></a>')


	}
	  });
	  $(document).on('click','#search_keywords a span',function(){
		$(this).parent().remove();
		return false;
			
	  });
	  $('#search_button').click(function(){
		  var category= $.trim($('.chosen-single').text());
			if(category=='카테고리 선택'){
				alert('카테고리를 선택해주세요.');
				return false;
			}
			$('#product_list_search_form').submit();
	  });

      </script>     


			</form>
<style>
	#product_list_wrap{
				margin-top: 20px;
			}

</style>
			<div id="product_list_wrap" <?=attr($param['product_type']=='','style="display:none;"')?>>
				


			<form id="product_list_form" method="post" action="/user/estimate_cart">

			</form>

		
            <div class="clearfix">
		
                <a href="/user/estimate_cart" id="to_estimate_cart_button" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select">선택한 제품 견적 바구니에 담기</a>
            </div>

					</div>
        </div>
    </main>
<script>
	$('#todo-btn-submit').click(function(){
	$('#product_list_search_form').submit();
		});

$('#to_estimate_cart_button').click(function(){
	$('#product_list_form').submit();
	return false;
});

$('#check_all').click(function(){
	var checked = $(this).prop('checked')
		$('#product_list_form input[type="checkbox"]').prop({checked:checked});
});
</script>



	<?php

	include'views/footer.html';
?>