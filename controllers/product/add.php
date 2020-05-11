<?php
	if($param['has_data']=='next_category'){
		$nextCategories=getList('product_categories','category_group="'.str_replace('&quot;','"',$param['category_group']).'" AND product_type="'.$param['type'].'"','','','no asc');
		echo json_encode($nextCategories);
		exit;
	}
	if($param['has_data']=='1'){
		$param['details']= jsonEncode($param);
		$param['user_no'] = $session['login'];
		insertItem('product_lists',$param);
		printMessage('매물이 등록되었습니다.','/product/list');
	exit;
	}

	include'views/header.html';
?>
<?php
	if(!$session['login']){
?>
	<script>
		
			Swal.fire({
			  title: '',
			  text: '로그인 후 이용해주세요.',
			  icon: 'error',
	
				  onAfterClose:function(){
	location.href='/user/login'
			  },
			  confirmButtonText: '확인'
			});
		
		

	</script>
	<?php
}	
?>
<form method="post" action="">
<input type="hidden" name="has_data" value="1">
<main class="site-main site-login">
        <div class="box-center box-center-2">

            <div class="row row-filter reg-filter">
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
	$(document).on('click','form input',function(){
	$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
});
	$(document).on('click','.categories li input',function(){
		var categoryGroup =  $(this).data('next');
		var type= $(this).data('type');
		var $this = $(this);
		var step=1;
		var $parent = $this.parent().parent().parent().parent().parent();
		var $check= $(this).prop('checked');
	
		$parent.nextAll('.categories').remove();
	
	
		if($check&&categoryGroup!=''){
		//	alert('마지막 카테고리입니다.');
	
		
		//if($(this).parent().find('ul').size()==0){
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

</script>
                   
                        <!-- <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">길이</div>
                            <div class="filter-options-content">
                                <div class="filter-date">
                                    <input type="text">
                                </div>
                            </div>
                        </div> -->

                        <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">포장 관련 옵션</div>
                            <div class="filter-options-content">
                                <ul>
                                    <li><label class="inline"><input type="checkbox"  name="package_type" value="직접"><span class="input"></span>직접 포장</label></li>
                                    <li><label class="inline"><input type="checkbox"  name="package_type" value="직접 안함"><span class="input"></span>직접 안함</label></li>
                                </ul>
                                <!-- <p class="option-message">예상 포장 가격 : KRW</p> -->
                            </div>
                        </div>

                        <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">운송 관련 옵션</div>
                            <div class="filter-options-content">
                                <ul>
                                    <li><label class="inline"><input type="checkbox" name="delivery_type" value="직접"><span class="input"></span>직접</label></li>
                                    <li><label class="inline"><input type="checkbox" name="delivery_type" value="직접안함"><span class="input"></span>직접안함</label></li>
                                </ul>
                                <!-- <p class="option-message">현재 제품 소재자:  울산 ---</p> -->
                            </div>
                        </div>

                        <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">가격</div>
                            <div class="filter-options-content">
                                <div class="filter-date">
                                    <input type="text" name="price"> USD
                                </div>
                            </div>
                        </div>

                        <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">운송가능일정
                            </div>
                            <div class="filter-options-content">
                                <div class="filter-date">
                                    <input type="text" name="delivery_date" class="datepicker">  일 이내
                                </div>
                            </div>
                        </div>

                        <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">상세 Spec. 업로드</div>
                            <div class="filter-options-content">
                                <div class="filter-date">
                                    <input type="file" name="attach" style="width:400px;">
                                </div>
                            </div>
                        </div>

                        <div class="filter-options-item filter-categori">
                            <div class="filter-options-title">매물 사진 등록</div>
                            <div class="filter-options-content">
                                <button  type="button" value="" class="button-submit button-add-image"> 이미지 추가
								<iframe src="/common/upload_file?callback=upload_image" frameborder="0"></iframe>
								</button>
								<img src="" id="uploaded_image" alt="">
								<input type="hidden" id="uploaded_image_path">
                            </div>
<!-- 
                            <div class="img-box-wrap">
                                <div class="imgbox active" data-role="imageView"><label class="imgbox-cover">
                                    <span class="product-image">매물사진 01</span></label>
                                </div>
                                <span class="file-name">파일 이름.jpg</span>
                            </div>

                            <div class="img-box-wrap">
                                <div class="imgbox active" data-role="imageView"><label class="imgbox-cover">
                                    <span class="product-image">매물사진 02</span></label>
                                </div>
                                <span class="file-name">파일 이름2.jpg</span>
                            </div>

                            <div class="img-box-wrap">
                                <div class="imgbox active" data-role="imageView"><label class="imgbox-cover">
                                    <span class="product-image">매물사진 03</span></label>
                                </div>
                                <span class="file-name">파일 이름3.jpg</span>
                            </div> -->

                        </div>

                    </div>
                </div>
            </div>

            <p class="form-row reg-form-row">
                <input type="submit" value="매물 등록" name="Submit" class="button-submit">
                <input type="submit" value="내 매물" name="Submit" class="button-submit">
            </p>

        </div>
    </main>
	</form>


	<style>
	#uploaded_image{
	display: none;
		width: 200px;
		
	}
	.button-add-image{
		position: relative;
		overflow: hidden;
	}
		.button-add-image iframe{
		position: absolute;
		top: 0;
		left: 0;
		opacity:0;
	}

	</style>
<script>
	function upload_image($image){
		$('#uploaded_image_path').val($image.path);
		$('#uploaded_image').attr({src: '/files/'+$image.path}).css({display:'block'});
	}

</script>
	


	<?php
	include'views/footer.html';
?>