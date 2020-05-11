<?php
	include'views/header.html';
?>

<style>
	#main_slide_left{
	position: fixed;
	left: 10px;
	top: 400px;
	background: rgba(0,0,0,0.5);
	padding: 15px;
	text-align: center;
}

	#main_slide_right{
	position: fixed;
	right: 10px;
	top: 400px;
	background: rgba(0,0,0,0.5);
	padding: 15px;
	text-align: center;
}

.main-sliding-1,.main-sliding-2{
	z-index: 6000;
}
</style>
<?php
			if($session['login']){
		?>

<a href="#" class="btn-arrow btn-arrow-left"  id="main_slide_left">
    <span class="svg-icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="analytics" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-analytics fa-w-18 fa-3x"><path fill="currentColor" d="M510.62 92.63C516.03 94.74 521.85 96 528 96c26.51 0 48-21.49 48-48S554.51 0 528 0s-48 21.49-48 48c0 2.43.37 4.76.71 7.09l-95.34 76.27c-5.4-2.11-11.23-3.37-17.38-3.37s-11.97 1.26-17.38 3.37L255.29 55.1c.35-2.33.71-4.67.71-7.1 0-26.51-21.49-48-48-48s-48 21.49-48 48c0 4.27.74 8.34 1.78 12.28l-101.5 101.5C56.34 160.74 52.27 160 48 160c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-4.27-.74-8.34-1.78-12.28l101.5-101.5C199.66 95.26 203.73 96 208 96c6.15 0 11.97-1.26 17.38-3.37l95.34 76.27c-.35 2.33-.71 4.67-.71 7.1 0 26.51 21.49 48 48 48s48-21.49 48-48c0-2.43-.37-4.76-.71-7.09l95.32-76.28zM400 320h-64c-8.84 0-16 7.16-16 16v160c0 8.84 7.16 16 16 16h64c8.84 0 16-7.16 16-16V336c0-8.84-7.16-16-16-16zm160-128h-64c-8.84 0-16 7.16-16 16v288c0 8.84 7.16 16 16 16h64c8.84 0 16-7.16 16-16V208c0-8.84-7.16-16-16-16zm-320 0h-64c-8.84 0-16 7.16-16 16v288c0 8.84 7.16 16 16 16h64c8.84 0 16-7.16 16-16V208c0-8.84-7.16-16-16-16zM80 352H16c-8.84 0-16 7.16-16 16v128c0 8.84 7.16 16 16 16h64c8.84 0 16-7.16 16-16V368c0-8.84-7.16-16-16-16z" class=""></path></svg></span>
    <h3>현재 시세</h3>
</a>
<a href="#" class="btn-arrow btn-arrow-right"  id="main_slide_right">
    <span class="svg-icon">
        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="newspaper" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-newspaper fa-w-18 fa-3x"><path fill="currentColor" d="M552 64H88c-13.234 0-24 10.767-24 24v8H24c-13.255 0-24 10.745-24 24v280c0 26.51 21.49 48 48 48h504c13.233 0 24-10.767 24-24V88c0-13.233-10.767-24-24-24zM32 400V128h32v272c0 8.822-7.178 16-16 16s-16-7.178-16-16zm512 16H93.258A47.897 47.897 0 0 0 96 400V96h448v320zm-404-96h168c6.627 0 12-5.373 12-12V140c0-6.627-5.373-12-12-12H140c-6.627 0-12 5.373-12 12v168c0 6.627 5.373 12 12 12zm20-160h128v128H160V160zm-32 212v-8c0-6.627 5.373-12 12-12h168c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12H140c-6.627 0-12-5.373-12-12zm224 0v-8c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0-64v-8c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0-128v-8c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0 64v-8c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12z" class=""></path></svg>
    </span>
    <h3>플랜드 업계 동향</h3>
</a>
<?php
}	
?>

<div class="main-sliding-3" style="left:-100%;">
<span class="btn-close-common " style="float:right;"><i class="fa fa-times" aria-hidden="true"></i></span>
    <h2 class="slide-heading heading-bar">기자재 현재 시세 </h2>


    <div class="card-box">
        <h4 class="header-title mb-3">Carbon Steel Piping</h4>
        <p class="header-title-sub">ASTM A106 Gr. A Bevel End기준</p>
        <div class="table-responsive">
            <table class="table table-borderless table-hover table-centered m-0 price-table">
                <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>SCH 10</th>
                    <th>SCH 20</th>
                    <th>SCH 30</th>
                    <th>SCH 40</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        ~2”
                    </td>
                    <td>
                        20$
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        3”~5”
                    </td>
                    <td>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        6”~8”
                    </td>
                    <td>
                        200$
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        8”~12”
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td></td>
                    <td>
                        300$
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-box">
        <h4 class="header-title mb-3">Carbon Steel Piping</h4>
        <p class="header-title-sub">ASTM A106 Gr. A Bevel End기준</p>
        <div class="table-responsive">
            <table class="table table-borderless table-hover table-centered m-0 price-table">
                <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>SCH 10</th>
                    <th>SCH 20</th>
                    <th>SCH 30</th>
                    <th>SCH 40</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        ~2”
                    </td>
                    <td>
                        20$
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        3”~5”
                    </td>
                    <td>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        6”~8”
                    </td>
                    <td>
                        200$
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        8”~12”
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td></td>
                    <td>
                        300$
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
	$news=getList('board_news');
?>
<div class="main-sliding-2" style="right:-100%;">
 <span class="btn-close-common " style="float:right;"><i class="fa fa-times" aria-hidden="true"></i></span>
    <h2 class="slide-heading heading-bar">플랜드 업계 동향</h2>
    <ul class="cards-list">
	<?php
		foreach($news['list'] as $newsItem){
	?>
        <li>
            <h3><?=$newsItem['title']?></h3>
            <p class="cards-list-article"><?=$newsItem['contents']?></p>
        </li>
	<?php
		}
	?>
        
    </ul>
</div>

    <!-- MAIN -->
    <main class="site-main">

        <div class="nav-mind main-search">
            <div class="block-search-explain">
                제품을 찾으실 때는 MOM에게 물어보세요!<br>
			
            </div>
            <!-- block search -->
            <div class="block-search">
                <div class="block-content">
                    <div class="categori-search">
					   <form method="get" action="/product/list" id="main_search_form">
                        <select data-placeholder="All Categories" name="category"
                                class="chosen-select categori-search-option">
                            <option value="">카테고리 선택</option>
                           
                                <option value="pipe">PIPE</option>
                                <option value="valve">VALVE</option>
                                <option value="fitting">FITTING</option>
                                <option value="flange">FLANGE</option>
                  
                        </select>
                    </div>
                    <div class="form-search">
                     
                            <div class="box-group">
                                <input type="text" name="keyword" class="form-control input-search">
                                <button class="btn btn-search" type="button"><span
                                        class="fa fa-search"></span></button>
                            </div>
                        
                    </div>
					
					</form>
                </div>

            </div><!-- block search -->
			<div class="container" style=";width: 800px;margin:10px auto;font-size:12px;">
				* 카테고리를 선택 한 후에 검색해주세요.

			</div>
				
        </div>
<?php
			if($session['login']){
		?>
        <!-- <div class="block-section-1 main-file-upload">
            <div class="container">
                <div class="promotion-banner promotion-banner-2 box-single style-2">
                    <div class="promotion-banner-inner">
                        <h4>구매를 희망하는 물량이 많으신가요? 엑셀 파일을 올려주세요</h4>
                        <div class="form-group">
                            <label class="title">파일업로드</label>
                            <input type="file" class="form-control" id="forWebsite">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
<?php
		}	
		?>
	
	
		<br>
		<br>
		<br>
		<br>
		
        <!-- <div class="block-section-3">
            <div class="container">
                <div class="block-up-to main-block-up-to">
                    <div class="up-to-content">간편하고 빠른 플랜트 구매 플랫폼</span></div>
                </div>
                <div class="main-buy-buttons">
                    <a href="/product/list" class="btn-add-to-cart">구매하기</a>
                    <a href="/product/add" class="btn-add-to-cart">판매하기</a>
                </div>
            </div>
        </div> -->

        <div class="main-banners">
        <div class="container">
            <div class="promotion-banner-inner">
                <h4>MOM이 제공하는 서비스</h4>
            </div>
        <div class="section-content relative">
<style>
.last-reset h5{
			font-size:22px;
			
		}
	.last-reset strong{
			font-weight: bold;
			display: block;
			margin-top: 4px;
			color: #2c4fa3;
		}

</style>
            <div class="row row-large align-center row-divided" id="row-1890218472">
                <div class="col medium-4 large-4"><div class="col-inner">

                        <div class="icon-box featured-box icon-box-center text-center" style="margin:0px 0px 0px 0px;">
                            <div class="icon-box-img has-icon-bg" style="width: 60px">
                                <div class="icon">
                                    <div class="icon-inner" style="border-width:2px;">
                                       <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box-text last-reset">
                                <h5 class="uppercase">키워드로  <br><strong>빠르게</strong></h5>
                               
                            </div>
                        </div><!-- .icon-box -->


                    </div></div>
                <div class="col medium-4 large-4"><div class="col-inner">

                        <div class="icon-box featured-box icon-box-center text-center" style="margin:0px 0px 0px 0px;">
                            <div class="icon-box-img has-icon-bg" style="width: 60px">
                                <div class="icon">
                                    <div class="icon-inner" style="border-width:2px;">
                                        <i class="fa fa-file"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box-text last-reset">
                                <h5 class="uppercase">견적을 <strong>한번에</strong></h5>
                         
                            </div>
                        </div><!-- .icon-box -->


                    </div></div>

                <div class="col medium-4 large-4"><div class="col-inner">

                        <div class="icon-box featured-box icon-box-center text-center" style="margin:0px 0px 0px 0px;">
                            <div class="icon-box-img has-icon-bg" style="width: 60px">
                                <div class="icon">
                                    <div class="icon-inner" style="border-width:2px;">
                                           <i class="fa fa-th"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box-text last-reset">
                                <h5 class="uppercase">Category로 <strong>상세하게</strong></h5>
                         
                            </div>
                        </div><!-- .icon-box -->


                    </div></div>

                <style scope="scope">

                </style>
            </div>
        </div>
        </div>
        </div>

    </main><!-- end MAIN -->

	<script>
	$('#main_slide_left').click(function(){
		TweenMax.to('.main-sliding-3',0.5,{left:0});
		$('#fog').fadeIn();
		return false;

	});
	
	$('#main_slide_right').click(function(){
		TweenMax.to('.main-sliding-2',0.5,{right:0});
		$('#fog').fadeIn();
		return false;

	});

$('.input-search').keyup(function($event){
	if($event.keyCode==13){
	
	$('.btn-search').click();
	}


});

			TweenMax.to('#main_slide_left',0.5,{repeat:-1,left:30,yoyo:true})
			TweenMax.to('#main_slide_right',0.5,{repeat:-1,right:30,yoyo:true})


			$('.btn-search').click(function(){

				if('<?=$session['login']?>'==''&&false){
				Swal.fire({
					  title: '',
					  text: '로그인 후 이용 가능합니다.',
					  icon: 'error',
					  confirmButtonText: '확인'
					})
						return false;
				}


				if($('.form-control').val()==''){
					Swal.fire({
					  title: '',
					  text: '검색어를 입력해주세요.',
					  icon: 'error',
					  confirmButtonText: '확인'
					})
						return false;
				}
				
					if($('[name="category"]').val()==''){
						Swal.fire({
					  title: '',
					  text: '카테고리를 선택해주세요.',
					  icon: 'error',
					  confirmButtonText: '확인'
					})
						return false;
					}
					else{
						$('#main_search_form').submit();
					}
				
				
			});
	</script>


<?php
	include'views/footer.html';
?>