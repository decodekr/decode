<?php
include 'views/header.html';
	$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier');
$carts = getListJoin('estimate_cart_products',array('LEFT','product_lists','estimate_cart_products.product_no=product_lists.no'),'estimate_cart_products.*,product_lists.details,product_lists.price','estimate_cart_products.status=0 AND estimate_cart_products.user_no='.$session['login']);

$user=getItem('users',$_SESSION['login']);
if($param['order']==1){
	$orderParam['user_no']=$session['login'];
	$cartParam['status']=1;
	$cartParam['order_no']=insertItem('estimate_orders',$orderParam);
	updateItem('estimate_cart_products',$cartParam,'user_no='.$session['login'].' AND status=0');
	printMessage('주문이 완료되었습니다.','/user/order');
exit;
}
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

<?php
	if($param['test']==''){
?>
	<style>
		.form_row.card{
	display: none;
}

	</style>
<div id="contentsWrap" class="wrap" tabindex="0" style="display:none;">
	
		
		<div id="all_layout_masking_div" aria-hidden="true" style="opacity: 0.5; position: absolute; background-color: rgb(255, 255, 255); z-index: 200; top: 0px; left: 0px; width: 760px; height: 570px; display: none;"></div>
		
		
		





	<div class="header header_color">
		<span aria-hidden="true">웰컴페이먼츠 결제 페이지</span>   
			<div class="help">
			
				
								
					<a href="javascript:;" id="header_lang">
					
					</a>
							
				
				
				
					<span class="sp ir dot" id="header_dot_flag"></span> 
					<a href="javascript:;" id="webAcessInfo" aria-label="스크린리더 사용고객은 반드시 읽어주세요. 새창">웹접근성안내</a>
				
				
				
				
<!-- 				<span class="sp ir dot"></span> -->

			</div>
	</div>

	<div id="kcp_spay_logo" class="logo">
	
		
			
			
				<span id="spay_logo_t" class="logo_t">&nbsp;</span>
			
		

		
		
			
			
			
			<div class="location" id="layout_header_loc">
				
					
						
					
								
			</div>
					
		
		
		
	</div>

		
	    
		






	
	
	
	<div id="directNOS" style="display: none;">
		<div class="skip"><a id="nosInstPopup" href="javascript:;" aria-label="고객님의 안전한 거래를 위하여 보안프로그램의 설치가 필요합니다. Enter키를 누르면 설치페이지로 이동됩니다. 새창"> 보안프로그램 설치 바로가기</a></div>
	</div>	
	
	
	<div id="spin_container" class="spin_container"></div>

	
	<form id="frmObj" name="frmObj" method="POST" data-nppfs-form-id="d42ef95293f7fe36e"><div class="nppfs-elements" style="display:none;"><input type="hidden" name="__E2E_KEYPAD__" value="0ae98fd928fad1b37a8b7ba7d65a6aab445fea1a8338fe9bfce8b9d3f938faab6d272eb86e2fe97c727311ecbee8bb3ab252f7087416bf6d6b6583605c93d08432065e64493091594886f67ec03066a056977429933d34c952dba4a0e0d50ce5fa6ea802b100def7a4e5f109c4348ec7abfb12647d832f295da31b37b1f531612b10a9dc807dd4e182577b3e4f88fbe2af5e15fbc949a8e503e142aa37e457cfb79e22e57972183b929339ca02f20a0a1c40b057811e03898da22a2f924d7864271aaf93f57dff673c00a22eeae40d46ef6493d80d8f26c70a064c1c75b5bf94965dc74dba82e29f9adbe00ad288e439596f432901a3a8906c3063f510882f6d">
<input type="hidden" name="__E2E_UNIQUE__" value="158767557188872"><input type="hidden" name="__KH_9f904c58d009" value=""><input type="hidden" name="__KI_card_num3" value="be73aa7c14394fbb763edd39b88154076d940bfc2f0df4619a4ff0b6a04f10c244131213b3729d2c1baf837c840004be12a25ebe417e605eaab407c616168c8b968813724df9ccb8bbbe5541b5417f0a08625c73253600958977e16472d5f055"><input type="hidden" name="__KU_9f904c58d009" value="Y" class="nppfs-dynamic-field"><input type="hidden" name="__KH_c84a5c7a97db" value=""><input type="hidden" name="__KI_card_num4" value="7aeb7ce675f0f1fb398e050e7e8c165602a817a156c922458ddff7c3e8deb8a27219367f90282335390779b550955b668b405ffbeee40d9a4aae2ba433c4c51e8ac815cbd3802116036082e6d27ea9f15754d5781cb8fb24b9bf079f7714a9c6"><input type="hidden" name="__KU_c84a5c7a97db" value="Y" class="nppfs-dynamic-field"></div>    
	
		
		
		

		<!--contents-->
		<div class="content">
		
			<div class="price" tabindex="0" aria-label="상품명 및 상품금액을 자세히 확인하시려면 아래 방향키로 확인하세요.">
				<span title="결제내역은다음과같습니다"></span>
				<div class="p_w1">
					
					<span class="form_row p_row">
						<span class="col_tit">상품명</span><span class="col_cont t_over" id="pname"></span>
					</span>
					
					<span class="form_row p_row">
						<span class="col_tit">제공기간</span><span class="col_cont">[ 별도 제공기간 없음 ]</span>
					</span>
				</div>
				<div class="p_w2">
					
					<span class="form_row p_row">
						<span class="col_tit">상품금액</span>
						<span class="con_price" id="pprice">
						
	           				
	           					
	           						69,000원
	           					
	           					
	           					
	           										
						</span>
					</span>
					
			
			
				
				
				
					
				
			
				
				</div>
				
				
				
				
								
				<div class="last_price">
					최종결제금액
					<br>
					<span class="txt_price" id="pay_price">
					
						
							
								<em>69,000</em>원
							
							
		        			
		        		
					</span>
				</div>
			</div>

			<div class="con">
			
				
				<div class="agree_new form_row">
					<h1 id="con" class="tit">약관 및 이용동의</h1>  
					<div class="view_agree"><a href="javascript:;" id="cardAgree" title="이용약관 전체보기 새창">보기<span class="sp ic_view"></span></a></div>
					
					<div class="agree_chk_bg">
						<div class="chk_box chk_agree_all">
							<input type="checkbox" id="chk_all" name="chk_all" aria-label="체크하면 한 번에 동의가 됩니다">
							<label for="chk_all"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>전체동의</label>
						</div>
						
						<div class="chk_box chk_agree">
							<input type="checkbox" id="chk_agree1" name="chk_agree1">
							<label for="chk_agree1"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>전자금융거래 이용약관</label>
						</div>
						<div class="chk_box chk_agree">
							<input type="checkbox" id="chk_agree2" name="chk_agree2">
							<label for="chk_agree2"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>개인정보 수집 및 이용동의</label>
						</div>
					</div>
				</div>

				<h1 class="blind">카드 및 할부 선택</h1>
				<div class="icon2">
					<span title="카드에 따라서 할인쿠폰은 상단의 할인받기를 확인하여, 포인트는 하단의 포인트사용 체크상자 선택하여, 무이자 할부는 하단의 할부선택 콤보상자를 선택하여 혜택을 사용합니다. KB국민, BC, 그외의 카드를 선택하게 되면 무이자 할부는 다음 버튼을 클릭하여 나타나는 새창에서 선택해야 합니다"></span>

										
					
				
										 
				</div>

				<span id="selectCardTitle" title="카드를 선택하세요"></span>
				
				
				
				
				<div class="card form_row">
				
					
					
					
					
						
						
							
							
													
							
						
							
												
					
					
					
						
	
					
					 
								
					
	
						<div class="form_row b2b_bn">
						
							
							
								
								<div class="bn_pay1">	
								
									
									
										<span class="b2b_w1 btnCard">
											<a href="javascript:;" id="PAYCO" title="선택" class="linkArea btnInfo">
												<span class="b2b_w1_table">
													<span class="card_bn_logo">
														<img src="img/card_logo/logo_payco.png" alt="페이코간편결제" aria-hidden="false">
													</span>
													
													
														
															
															
														
														
													
													
													
													<span class="card_bn_txt" style="display:visible">페이코 결제 시 2만원 이상 4천원 할인!<br>(생애 첫 결제 및 90일 휴면 대상)<br></span>
													
													<i class="area_icon">
														<img src="img/ic_coupon.png" alt="쿠폰" class="ic_icon1">
														<img src="img/ic_point.png" alt="포인트" class="ic_icon1">
														<img src="img/ic_month.png" alt="무이자할부" class="ic_icon1">
													</i>
												</span>		
											</a>
										</span>								
									
									
									
									
																	
									
								
								</div>		
								
							
							
							
							
							
								
								<div class="bn_card">
									
										
										
										
										
										<span class="btnCard b2b_w3"> 	
											<a href="javascript:;" id="CCBC" title="선택" class="linkArea btnInfo">
												<span class="b2b_w3_table">
											
													
													
														
															
														
														
													
													
													<span class="card_bn_logo">비씨카드</span>
													<span class="card_bn_txt">2~6개월 무이자할부(법인/체크/GIFT제외)</span>
													
													
													
														<i class="area_icon">
															<img src="img/ic_month.png" alt="무이자할부" class="ic_icon1">
														</i>
													
													
												</span>
											</a>
										</span>										
										
									
										
										
										
										
										<span class="btnCard b2b_w3"> 	
											<a href="javascript:;" id="CCDI" title="선택" class="linkArea btnInfo">
												<span class="b2b_w3_table">
											
													
													
														
															
														
														
													
													
													<span class="card_bn_logo">현대카드</span>
													<span class="card_bn_txt">2~6개월 무이자 (코스트코,스마일카드 포함)</span>
													
													
													
														<i class="area_icon">
															<img src="img/ic_month.png" alt="무이자할부" class="ic_icon1">
														</i>
													
													
												</span>
											</a>
										</span>										
										
																
								</div>
								
							
							
						
						</div>		
						
					
					
					 
					

					
					
							
								
													    
														
													
					
													    
					
					
					
					
						<ul class="form_row">
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCLG" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCLG.png" aria-hidden="true" alt="신한">
														<em>신한</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCKM" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCKM.png" aria-hidden="true" alt="KB국민">
														<em>KB국민</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCNH" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCNH.png" aria-hidden="true" alt="NH채움">
														<em>NH채움</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCSS" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCSS.png" aria-hidden="true" alt="삼성">
														<em>삼성</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCLO" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCLO.png" aria-hidden="true" alt="롯데">
														<em>롯데</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="CCPH" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_CCPH.png" aria-hidden="true" alt="우리">
														<em>우리</em>
													</span>
													
														<i class="area_icon" title="제공">
															 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2" style="display:visible"> 
														</i>
													
												</a>
											</li>
											
										
										
									
								
							
								
									
										
										
											
										
									
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
								
							
						</ul>
						
						
							
							
							<ul class="form_row">
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
												
												
												
												<li class="w1 btnCard">
													<a href="javascript:;" id="CCHN" title="카드 선택" class="btnInfo">
														<span class="bank_logo">
															<img src="img/card_logo/logo_CCHN.png" aria-hidden="true" alt="하나">
															<em>하나</em>
														</span>
														
															<i class="area_icon" title="제공">
																 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2"> 
															</i>
														
													</a>
												</li>
											
																				
									
									
								
								
									
										
											
												
												
												
												<li class="w1 btnCard">
													<a href="javascript:;" id="CCKE" title="카드 선택" class="btnInfo">
														<span class="bank_logo">
															<img src="img/card_logo/logo_CCKE.png" aria-hidden="true" alt="하나(외환)">
															<em>하나(외환)</em>
														</span>
														
															<i class="area_icon" title="제공">
																 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2"> 
															</i>
														
													</a>
												</li>
											
																				
									
									
								
								
									
										
											
												
												
												
												<li class="w1 btnCard">
													<a href="javascript:;" id="CCUF" title="카드 선택" class="btnInfo">
														<span class="bank_logo">
															<img src="img/card_logo/logo_CCUF.png" aria-hidden="true" alt="은련(해외카드)">
															<em>은련(해외카드)</em>
														</span>
														
													</a>
												</li>
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
									
										
											
																				
									
									
								
								
								
								
												
								
					
									<li class="sel_w2">
										<div id="etcCard" class="sel_w2_bg">
											<a href="javascript:;">그외 카드<img src="img/sel_arrow_off.gif" class="ic_arrow" alt="카드 선택"></a>
											<ul style="display:none;">
												<li class="etcCardList">
													<a href="javascript:;" id="etcTitle">그외 카드</a>
												</li>
												
													
												
													
												
													
												
													
												
													
												
													
												
													
												
													
												
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCPB" title="카드 선택" class="btnInfo">
																우체국
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCSU" title="카드 선택" class="btnInfo">
																수협
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCSM" title="카드 선택" class="btnInfo">
																MG새마을
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCCJ" title="카드 선택" class="btnInfo">
																제주
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCJB" title="카드 선택" class="btnInfo">
																전북
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCCT" title="카드 선택" class="btnInfo">
																씨티
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCCU" title="카드 선택" class="btnInfo">
																신협
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKJ" title="카드 선택" class="btnInfo">
																광주
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKD" title="카드 선택" class="btnInfo">
																KDB산업
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCSB" title="카드 선택" class="btnInfo">
																저축은행
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="BC81" title="카드 선택" class="btnInfo">
																하나BC
																
																	<i class="area_icon" title="제공">
																		 <img src="img/ic_month.png" alt="무이자할부" class="ic_icon2"> 
																	</i>
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCHS" title="카드 선택" class="btnInfo">
																KB증권
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKA" title="카드 선택" class="btnInfo">
																카카오뱅크
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCKK" title="카드 선택" class="btnInfo">
																케이뱅크
																
															</a>
														</li>		
													
												
													
														<li class="etcCardList">
															<a href="javascript:;" id="CCMD" title="카드 선택" class="btnInfo">
																미래에셋대우
																
															</a>
														</li>		
													
												
											</ul>
										</div>
									</li>
											
								
								
																
							</ul>
							
								
						
					
					
					
					
					
					
					
						
						
					    
					    
						
					
							
					
						<ul class="form_row">
							
							
								
									
										
											
											
											
											<li class="w1 btnCard">
												<a href="javascript:;" id="SSSG" title="카드 선택" class="btnInfo">
													<span class="bank_logo">
														<img src="img/card_logo/logo_SSSG.png" aria-hidden="true" alt="SSGPAY">
														<em>SSGPAY</em>
													</span>
												</a>
											</li>
										
																			
								
								
							
							
							
							
											
										
							
							
															
						</ul>
												
					
					
					
										
				</div>

				
				
					<div id="ssAppCard" class="chk_box chk_txt">

						<label for="chk_sm">
							<span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>
							<span>무통장 입금</span>
						</label>
						<div>
							<br>
							<div style="padding-left:10px;">
							<table class="table table-bordered"> 
								<tr>
									
									<th>은행명</th>
									<td>
										상호 저축은행

									</td>
								</tr>
								<tr>
									<th>계좌번호</th>
	<td><?=$user['virtual_account_number']?></td>
								</tr>
								<tr>
										<th>
											예금주

										</th>
										<td>
											
<?=$_SESSION['name']?>
										</td>

								</tr>

							</table>

					
							</div>

					
						</div>
					</div>
				

				
				<div id="selCard_opt" class="sel_box form_row" style="display:none">
								
					
					<label id="select-monthLabel" style="display:none" for="select-month" class="blind">할부선택</label>
					<select id="select-month" style="display:none" name="select-month" class="select_month">
						<option value="00">일시불</option>
					</select>

					
					<div id="supportAppCard" class="chk_box chk_txt" style="display:none;">
						<input type="checkbox" id="chkApp" name="chkApp" value="Y" onclick="javascript:;">
						<label for="chkApp"><span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span><span id="appCardMsg"></span></label>
					</div>

					
					<div id="supportPoint" class="chk_box chk_txt" style="display:none;">
						<input type="checkbox" id="chkPoint" name="chkPoint" value="Y">
						<label for="chkPoint">
							<span class="chk_ico"><img src="img/chk/ico_chk_default.png" alt=""></span>
							<span id="pointCardMsg"></span>
						</label>
					</div>
						
				</div>  
				
				
				
				
				<div id="oseaUI" class="form_row ma_t15" style="display:none;">
					<div class="account_w fl_l">
						<div id="ONLY_CCXX" class="txt_foreign overseaCardField" style="display:none;">* VISA / MASTER / JCB만 가능</div>
					

						<label for="card_num1" class="account_tit overseaCardField">
							카드번호
							<span class="sp ic_required">필수입력</span>
							<span class="blind">앞자리</span> 
						</label>
						
						<div class="input_col4 overseaCardField">
							<span class="input_area">
								<input type="text" id="card_num1" name="card_num1" class="input_txt oseaCardNum" value="" maxlength="4" placeholder="4자리" title="카드번호 필수입력 첫번째자리">
							</span>
							<span class="input_area">
								<input type="text" id="card_num2" name="card_num2" class="input_txt oseaCardNum" value="" maxlength="4" placeholder="4자리" title="카드번호 두번째자리">
							</span>
							<span class="input_area">
								<span class="ic_slock"><img src="img/ic_slock.png" alt="보안키패드" aria-hidden="true"></span>
								<input type="password" id="card_num3" name="card_num3" npkencrypt="on" data-keypad-type="num" class="input_txt oseaCardNum nppfs-npv" value="" maxlength="4" placeholder="* * * *" title="카드번호 세번째자리" readonly="readonly" nppfs-keypad-uuid="nppfs-keypad-card_num3" data-input-useyn-type="toggle" data-keypad-useyn-input="__KU_9f904c58d009">
							</span>
							<span class="input_area">
								<span class="ic_slock"><img src="img/ic_slock.png" alt="보안키패드" aria-hidden="true"></span>
								<input type="password" id="card_num4" name="card_num4" npkencrypt="on" data-keypad-type="num" class="input_txt oseaCardNum nppfs-npv" value="" maxlength="4" placeholder="* * * *" title="카드번호 네번째자리" readonly="readonly" nppfs-keypad-uuid="nppfs-keypad-card_num4" data-input-useyn-type="toggle" data-keypad-useyn-input="__KU_c84a5c7a97db">
							</span>
						</div>
						<div id="OSEA_INFO" class="account_r overseaCardField"><a href="javascript:;" title="새창"><span class="sp ic_notice">주의사항</span>해외카드 3D 인증안내</a></div>
						
						<!-- PGAPP-9002 은련카드 카드번호 검증 start  -->
						<label for="card_num5" class="account_tit unionpayField">
							카드번호
							<span class="sp ic_required">필수입력</span>
							<span class="blind">16자리 에서 19자리</span>
						</label>
						<div class="input_area unionpayField">
							<input type="text" id="card_num5" name="card_num5" class="input_txt input_w1 unionPayNum" value="" placeholder="16자리 ~ 19자리" maxlength="19" title="카드번호 필수입력 16자리 에서 19자리">
						</div>
						<!-- PGAPP-9002 은련카드 카드번호 검증 end  -->
						
					</div>

					<div class="account_w fl_r">
						<label for="sel_card_month" class="account_tit">유효기간
							<span class="sp ic_required">필수입력</span>
							<span class="blind">월 선택</span>
						</label>
						<select id="sel_card_month" name="sel_card_month" class="sel_card_month2">
							<option value="">월 선택</option>
							
								<option value="1">1</option>
							
								<option value="2">2</option>
							
								<option value="3">3</option>
							
								<option value="4">4</option>
							
								<option value="5">5</option>
							
								<option value="6">6</option>
							
								<option value="7">7</option>
							
								<option value="8">8</option>
							
								<option value="9">9</option>
							
								<option value="10">10</option>
							
								<option value="11">11</option>
							
								<option value="12">12</option>
													
						</select>
						
						
						
						
						<label for="sel_card_year" class="blind">년 선택</label>
						<select id="sel_card_year" name="sel_card_year" class="sel_card_month3">
							<option value="">년 선택</option>
							
								<option value="2020">2020</option>
							
								<option value="2021">2021</option>
							
								<option value="2022">2022</option>
							
								<option value="2023">2023</option>
							
								<option value="2024">2024</option>
							
								<option value="2025">2025</option>
							
								<option value="2026">2026</option>
							
								<option value="2027">2027</option>
							
								<option value="2028">2028</option>
							
								<option value="2029">2029</option>
							
								<option value="2030">2030</option>
							
								<option value="2031">2031</option>
							
								<option value="2032">2032</option>
							
								<option value="2033">2033</option>
							
								<option value="2034">2034</option>
							
								<option value="2035">2035</option>
							
								<option value="2036">2036</option>
							
								<option value="2037">2037</option>
							
								<option value="2038">2038</option>
							
								<option value="2039">2039</option>
							
								<option value="2040">2040</option>
							
								<option value="2041">2041</option>
							
								<option value="2042">2042</option>
							
								<option value="2043">2043</option>
							
								<option value="2044">2044</option>
							
								<option value="2045">2045</option>
							
								<option value="2046">2046</option>
							
								<option value="2047">2047</option>
							
								<option value="2048">2048</option>
							
								<option value="2049">2049</option>
							
								<option value="2050">2050</option>
													
						</select>
					</div>
				</div>
				
				
				
				
				
			</div>	

			<div class="bn1">
				
				
								
			</div>
		</div>
		<!--//contents-->

		
		<div class="footer">
		
			
			
			
			
            
            
            

            
			
				
					
				
				
			<style>
			.content,.footer{
			display: none;
			}
				.loading{
			
			text-align: center;
			padding: 170px;
			}

			</style>
			
            <span class="notice_check blind" tabindex="0" style="display:none;">다음 버튼 이후에 공지사항이 있으니 들어주세요.</span>
			
			
			<div class="btn_area">
				
				<button type="button" class="btn_gray ma_r5" id="usrCancel" onclick="cancelPayplus(this.form)">취소</button>
				
				<button type="button" class="btn_color disable" id="cardNext" aria-label="카드사 새창에서 결제정보를 입력하면 결제내역화면으로 넘어갑니다.">다음</button>
			</div>
		</div>
		<!--//footer-->
		
		<div class="loading">
			
			<img src="/images/loading_blue.gif" alt=""><br>
			잠시만 기다려 주십시오.
		</div>
		
		<div id="CARD_CERT_DIV" class="layerCon_elsepay" role="dialog" style="display:none;">
			<div id="CARD_CERT_IFR_BAR" class="popComTitle" style="background-color: rgb(12, 12, 12);">
				<a href="javascript:;" class="btn_close" id="btnClose_pay_ifr">카드사창 닫기</a>
			</div>
		</div>
		
		
		<div id="KCP_TERMS_DIV" class="layerCon_elsepay" role="dialog" style="display:none;">
		</div>
		
		<div id="CARD_COUP_DIV" aria-hidden="true" style="width:0px;height:0px;display:none;"></div>		
		
		
		

    
    <div class="nppfs-keypad-div"><div id="nppfs-keypad-card_num3" class="nppfs-keypad" data-width="259" data-height="172" style="display: none;">
<style type="text/css">
	#nppfs-keypad-card_num3 .kpd-wrap { position:relative; width:259px; height:172px; }
	#nppfs-keypad-card_num3 .kpd-image { background-image:url('https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=5312e46984120a14ddcbe12e945d027ce172efce3ff87568ae9581a81bed4decc1905763c3b04afbbbd1312f5f938dcd653e5448cc87aef731880231f4cb1818ddb2ecd4fd3c4721c732792bcacea35ba2db75d2052d1949767195d356890b80&pi=N'); background-repeat:no-repeat; background-position:0px 0px; }
	#nppfs-keypad-card_num3 .kpd-button { position:absolute; width:undefinedpx; height:undefinedpx; overflow:hidden; /* border:1px solid #f88; */ }
</style>
<div class="kpd-wrap kpd-image">
<div class="kpd-group number">
<div class="kpd-button kpd-image kpd-cmd " data-action="action:delete" data-left="23" data-top="122" data-width="34" data-height="34" data-pos-x="0" data-pos-y="210" style=" left:23px; top:122px; width: 34px; height: 34px; background-position: -0px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:clear" data-left="58" data-top="122" data-width="34" data-height="34" data-pos-x="36" data-pos-y="210" style=" left:58px; top:122px; width: 34px; height: 34px; background-position: -36px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:refresh" data-left="128" data-top="122" data-width="34" data-height="34" data-pos-x="72" data-pos-y="210" style=" left:128px; top:122px; width: 34px; height: 34px; background-position: -72px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:close" data-left="217" data-top="3" data-width="34" data-height="34" data-pos-x="108" data-pos-y="210" style=" left:217px; top:3px; width: 34px; height: 34px; background-position: -108px -210px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:f782b8952117ad3336881e5427becdbf9ac6f204:1" data-left="23" data-top="52" data-width="34" data-height="34" data-pos-x="0" data-pos-y="174" style=" left:23px; top:52px; width: 34px; height: 34px; background-position: -0px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:2e8923d4e2b51713656e673ba1d031ce17a062f2:1" data-left="58" data-top="52" data-width="34" data-height="34" data-pos-x="36" data-pos-y="174" style=" left:58px; top:52px; width: 34px; height: 34px; background-position: -36px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:adf92b0e9c393632633cbbac9bcc1ecd282c250d:1" data-left="93" data-top="52" data-width="34" data-height="34" data-pos-x="72" data-pos-y="174" style=" left:93px; top:52px; width: 34px; height: 34px; background-position: -72px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:74ac05cbf1773949753a23532980c96b65c27cdf:1" data-left="163" data-top="52" data-width="34" data-height="34" data-pos-x="108" data-pos-y="174" style=" left:163px; top:52px; width: 34px; height: 34px; background-position: -108px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:19eeb16c8f45c8ba2326fccca2a24b32273f8a88:1" data-left="198" data-top="52" data-width="34" data-height="34" data-pos-x="144" data-pos-y="174" style=" left:198px; top:52px; width: 34px; height: 34px; background-position: -144px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:7ae000c330b24fed2cb866629719c87addfd5df2:1" data-left="23" data-top="87" data-width="34" data-height="34" data-pos-x="180" data-pos-y="174" style=" left:23px; top:87px; width: 34px; height: 34px; background-position: -180px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:12cd30ef1b0458af12557d276cac4956d4f8d18d:1" data-left="58" data-top="87" data-width="34" data-height="34" data-pos-x="216" data-pos-y="174" style=" left:58px; top:87px; width: 34px; height: 34px; background-position: -216px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:69e16d231cae81362ba662be1896121fe73e6690:1" data-left="93" data-top="87" data-width="34" data-height="34" data-pos-x="252" data-pos-y="174" style=" left:93px; top:87px; width: 34px; height: 34px; background-position: -252px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:d396e483a07dace8c6cb611cced9c242431f2b15:1" data-left="163" data-top="87" data-width="34" data-height="34" data-pos-x="288" data-pos-y="174" style=" left:163px; top:87px; width: 34px; height: 34px; background-position: -288px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:3ead7f09f0792b9f799914d8caa7ff97824260b3:1" data-left="198" data-top="87" data-width="34" data-height="34" data-pos-x="324" data-pos-y="174" style=" left:198px; top:87px; width: 34px; height: 34px; background-position: -324px -174px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:enter" data-left="163" data-top="122" data-width="69" data-height="33" data-pos-x="0" data-pos-y="246" style=" left:163px; top:122px; width: 69px; height: 33px; background-position: -0px -246px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="128" data-top="52" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:128px; top:52px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="128" data-top="87" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:128px; top:87px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="93" data-top="122" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:93px; top:122px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
</div>
</div>
</div><div id="nppfs-keypad-card_num4" class="nppfs-keypad" data-width="259" data-height="172" style="display: none;">
<style type="text/css">
	#nppfs-keypad-card_num4 .kpd-wrap { position:relative; width:259px; height:172px; }
	#nppfs-keypad-card_num4 .kpd-image { background-image:url('https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=b0e2bc9a8546471fc2219163461ec0762c0ac244d3d5dd199f8385cb36b70cbaf7d8d6e6af40ef181555a89de50d78b84218bee0e139fcd4675f60b50838d6cbef7faa6197c255b1bea53a4a7b06996a719b655bcc8e61877b610f719f115c0d&pi=N'); background-repeat:no-repeat; background-position:0px 0px; }
	#nppfs-keypad-card_num4 .kpd-button { position:absolute; width:undefinedpx; height:undefinedpx; overflow:hidden; /* border:1px solid #f88; */ }
</style>
<div class="kpd-wrap kpd-image">
<div class="kpd-group number">
<div class="kpd-button kpd-image kpd-cmd " data-action="action:delete" data-left="23" data-top="122" data-width="34" data-height="34" data-pos-x="0" data-pos-y="210" style=" left:23px; top:122px; width: 34px; height: 34px; background-position: -0px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:clear" data-left="93" data-top="122" data-width="34" data-height="34" data-pos-x="36" data-pos-y="210" style=" left:93px; top:122px; width: 34px; height: 34px; background-position: -36px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:refresh" data-left="128" data-top="122" data-width="34" data-height="34" data-pos-x="72" data-pos-y="210" style=" left:128px; top:122px; width: 34px; height: 34px; background-position: -72px -210px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:close" data-left="217" data-top="3" data-width="34" data-height="34" data-pos-x="108" data-pos-y="210" style=" left:217px; top:3px; width: 34px; height: 34px; background-position: -108px -210px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:86e91e6932f2b76e7dded1e952a00d80cf8c97ad:1" data-left="23" data-top="52" data-width="34" data-height="34" data-pos-x="0" data-pos-y="174" style=" left:23px; top:52px; width: 34px; height: 34px; background-position: -0px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:4cbb661554f7ed685b6bef54b17601bc14ccc7bf:1" data-left="58" data-top="52" data-width="34" data-height="34" data-pos-x="36" data-pos-y="174" style=" left:58px; top:52px; width: 34px; height: 34px; background-position: -36px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:3214a96aa27bf66e05c5ced17ff6d76be61a5fec:1" data-left="93" data-top="52" data-width="34" data-height="34" data-pos-x="72" data-pos-y="174" style=" left:93px; top:52px; width: 34px; height: 34px; background-position: -72px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:a732155cfd2b452b0bd74912105c05f494f8e77c:1" data-left="163" data-top="52" data-width="34" data-height="34" data-pos-x="108" data-pos-y="174" style=" left:163px; top:52px; width: 34px; height: 34px; background-position: -108px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:f70d60eeb0291e1c6e2972ff2311ac6364ae0490:1" data-left="198" data-top="52" data-width="34" data-height="34" data-pos-x="144" data-pos-y="174" style=" left:198px; top:52px; width: 34px; height: 34px; background-position: -144px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:b5255e157cffe815a5f086d096d7e3cb42deafdd:1" data-left="23" data-top="87" data-width="34" data-height="34" data-pos-x="180" data-pos-y="174" style=" left:23px; top:87px; width: 34px; height: 34px; background-position: -180px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:d99d3c92ac5e1455bfbe52cc483d2b9470cf9cf3:1" data-left="58" data-top="87" data-width="34" data-height="34" data-pos-x="216" data-pos-y="174" style=" left:58px; top:87px; width: 34px; height: 34px; background-position: -216px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:00feebf5dafd55a9c39b794760fad01a08610091:1" data-left="128" data-top="87" data-width="34" data-height="34" data-pos-x="252" data-pos-y="174" style=" left:128px; top:87px; width: 34px; height: 34px; background-position: -252px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:b10516da2f4b991ceadad67eff5b61495562a9be:1" data-left="163" data-top="87" data-width="34" data-height="34" data-pos-x="288" data-pos-y="174" style=" left:163px; top:87px; width: 34px; height: 34px; background-position: -288px -174px; "></div>
<div class="kpd-button kpd-image kpd-data " data-action="data:bd5e84ca6f88e870c640a8572433493b908e15dd:1" data-left="198" data-top="87" data-width="34" data-height="34" data-pos-x="324" data-pos-y="174" style=" left:198px; top:87px; width: 34px; height: 34px; background-position: -324px -174px; "></div>
<div class="kpd-button kpd-image kpd-cmd " data-action="action:enter" data-left="163" data-top="122" data-width="69" data-height="33" data-pos-x="0" data-pos-y="246" style=" left:163px; top:122px; width: 69px; height: 33px; background-position: -0px -246px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="128" data-top="52" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:128px; top:52px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="93" data-top="87" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:93px; top:87px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
<div class="kpd-button kpd-image kpd-blank " data-left="58" data-top="122" data-width="34" data-height="34" data-pos-x="360" data-pos-y="174" style=" left:58px; top:122px; width: 34px; height: 34px; background-position: -360px -174px; "></div>
</div>
</div>
</div></div>

</form>
		
		
		
		





				
	</div>

<script>
	
	$('#chk_all').click(function(){
		$('.chk_agree input').prop({checked:$(this).prop('checked')});
		
	});
	setInterval(function(){
		if($('#chk_agree2').prop('checked')&&$('#chk_agree1').prop('checked')){
			$('#cardNext').removeClass('disable')
		}
			else{
			$('#cardNext').addClass('disable')
			}
	});

	$('#cardNext').click(function(){
		if($(this).hasClass('disable')){
			alert('약관 및 이용에 동의해주십시오.');
			return false;
		}
		if($('#upgu').val()==''){
			/*alert('입금자명을 입력해주십시오.');
			return false;*/
		}
		openLoading();
		setTimeout(function(){
	
		 location.href='/user/estimate?order=1'
	},2500);
 
 
	});

	

	function openLoading(){
		$('.content,.footer').hide();
		$('.loading').show();
	}
	function closeLoading(){
		$('.content,.footer').show();
		$('.loading').hide();
	}
</script>
	<style>

	#contentsWrap{
		position: fixed;z-index: 9999;
		top: 50%;;
		left: 50%;
		margin-left: -380px;
		margin-top: -250px;;
	}
		/*! CSS Used from: https://spay.kcp.co.kr/css/kcp_common.css?version=20200407 */
div,ul,li,h1,form,input,select,button,span{margin:0;padding:0;}
input,button,select{overflow:hidden;font-family:'나눔바른고딕','NanumBarunGothic',NanumBarunGothic,'돋움',dotum,Helvetica,sans-serif;font-size:12px;color:#5e5e5e;-webkit-text-size-adjust:none;font-weight:400;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}
img{border:0 none;vertical-align:top;}
ul,li{list-style:none;}
button{overflow:visible;border:0 none;background-color:transparent;cursor:pointer;}
input,select{width:100%;max-width:100%;padding:2px 10px;margin-right:0;height:28px;line-height:auto;border:1px solid #b2b1b1;border-radius:0;}
button{-webkit-appearance:none;margin-right:0;border-radius:0;}
button::-moz-focus-inner{padding:0;border:0;}
em{font-style:normal;}
a,a:focus,a:active,a:hover{color:#000;text-decoration:none;}
input[type="text"]::-webkit-input-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]:-moz-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]::-moz-placeholder{color:#828282;letter-spacing:1px;}
input[type="text"]:-ms-input-placeholder{color:#828282;letter-spacing:1px;}
input::-ms-clear{display:none;}
input:focus,select:focus{border:1px solid #000;position:relative;z-index:9;color:#000;}

.chk_box input[type="checkbox"]{position:absolute;width:15px;height:15px;overflow:hidden;margin:0;padding:0;;;z-index:5;}
.chk_box label{display:inline-block;padding-left:18px;line-height:18px;}
.chk_box{position:relative;}
.chk_box input[type="checkbox"] + label .chk_ico{display:inline-block;position:absolute;left:0;top:2px;width:16px;height:15px;vertical-align:middle;color:#5e5e5e;z-index:-1;}
.input_area{position:relative;display:block;}
.input_txt{font-size:12px;font-weight:500;line-height:auto;vertical-align:top;background:#fff;color:#5e5e5e;}
.input_w1{width:325px;}
.input_area .ic_slock{width:11px;height:11px;position:absolute;top:9px;right:6px;}
.input_col4 .input_area{float:left;}
.input_col4 .input_area{width:86px;}
.input_col4 .input_area:first-child{width:87px;}
.input_col4 .input_txt{padding:0;text-align:center;height:32px;}
select{-webkit-appearance:none;-moz-appearance:none;appearance:none;background:url(https://spay.kcp.co.kr/img/sel_arrow_off.gif) no-repeat 95% 50%;background-color:#fff;color:#5e5e5e;}
select::-ms-expand{display:none;}
select:focus{background:url(https://spay.kcp.co.kr/img/sel_arrow_on.gif) no-repeat 95% 50%;background-color:#fff;}
.blind{overflow:hidden;position:absolute;top:0;left:0;width:1px;height:1px;font-size:0;line-height:100px;white-space:nowrap;}
.sp{overflow:hidden;display:inline-block;line-height:200px;text-indent:-9999em;vertical-align:top;background:url(https://spay.kcp.co.kr/img/sp.png) no-repeat;}
.ir{overflow:hidden;text-indent:-9999em;}
.ma_t15{margin-top:15px!important;}
.ma_r5{margin-right:5px!important;}
.fl_l{float:left;}
.fl_r{float:right;}
.t_over{-webkit-text-overflow:ellipsis;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.col_cont,.form_row{*zoom:1;position:relative;}
.col_cont:after,.form_row:after,.price:after{display:block;clear:both;content:'';}
.form_row{position:relative;clear:both;width:100%;}
.skip{height:0;}
.skip a{display:block;position:absolute;left:0;top:-100px;width:100%;height:1px;text-align:center;}
.skip a:focus,.skip a:active{position:absolute;top:0;z-index:120;height:35px;padding:10px 0 0;background:#5e5e5e;color:#fff;font-size:1.4em;font-weight:700;}
.wrap{width:760px;height:570px;border-radius:4px;background:#fff;position:absolute;z-index:2;}
.header{height:25px;border-radius:4px 4px 0 0;font-size:12px;line-height:17px;color:#fff;padding:4px 25px 2px;position:relative;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
.content{padding:0 25px;width:710px;height:434px;position:relative;}
.footer{width:100%;min-height:55px;position:relative;background:#f3f3f4;border-radius:0 0 4px 4px;text-align:center;}
.help{position:absolute;right:25px;top:5px;}
.help a{color:#fff;text-decoration:none;}
.dot{width:2px;height:2px;background-position:-15px 0px;margin:7px 2px 0 3px;}
.logo{margin:10px 25px 0;position:relative;height:36px;line-height:36px;font-size:12px;font-weight:700;color:#1a1a1a;}
.logo_t{width:180px;display:inline-block;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.location{line-height:36px;font-size:12px;height:20px;position:absolute;right:0px;top:0px;}
.location a{padding-left:10px;color:#5e5e5e;font-weight:normal;}
.location a:hover{color:#1a1a1a;}
.price{border:1px solid #ebeaea;max-height:50px;margin-top:10px;position:relative;font-size:12px;line-height:17px;overflow:hidden;}
.price .p_w1{width:310px;float:left;padding:6px 0 4px;}
.price .p_w2{width:175px;float:left;padding:6px 0 4px;}
.last_price{position:absolute;right:0;width:204px;height:44px;text-align:center;background:#f5f4f4;border-left:1px solid #ebeaea;color:#1a1a1a;padding-top:6px;}
.txt_price{color:#eb2525;font-weight:bold;font-size:13px;}
.txt_price em{font-size:20px;line-height:22px;position:relative;top:0px;margin-right:2px;}
.price .p_w1 .col_tit{float:left;color:#5e5e5e;margin:0 5px 0 20px;width:83px;}
.price .p_w2 .col_tit{float:left;color:#5e5e5e;margin:0 5px 0 0px;width:60px;}
.price .col_cont{width:192px;padding-right:10px;color:#1a1a1a;display:inline-block;float:left;}
.con_price{color:#1a1a1a;font-weight:700;width:102px;text-align:right;display:inline-block;float:right;}
.p_row{height:20px;line-height:20px;}
.con{position:relative;margin-top:15px;}
.con .tit{font-size:15px;color:#000000;padding-top:5px;padding-bottom:13px;display:block;font-weight:700;}
.sel_box{font-size:12px;line-height:20px;margin-top:10px;}
.icon2{font-size:12px;position:absolute;left:0;top:320px;margin-top:3px;}
.bn1{position:absolute;bottom:0px;right:25px;}
.link_month{display:inline-block;text-decoration:underline;color:#5e5e5e;}
.link_month a{color:#5e5e5e;}
.card{text-align:center;font-size:12px;color:#707070;margin-top:-4px;}
.card a{color:#707070;}
.sel_w2{width:117px;height:32px;line-height:32px;border:1px solid #ebeaea;display:inline-block;float:left;margin-top:-1px;margin-left:-1px;z-index:3;text-align:left;}
.sel_w2 .sel_w2_bg{width:117px;height:32px;position:relative;}
.sel_w2 .sel_w2_bg a{padding-left:8px;}
.sel_w2_bg ul{width:117px;position:relative;top:0px;right:1px;z-index:30;max-height:150px;background:#fff;overflow-y:scroll;}
.sel_w2_bg li{line-height:30px;background:#fff;z-index:30;}
.sel_w2_bg li a{display:block;}
.sel_w2_bg li a:hover{display:block;background:#f3f3f4;}
.sel_w2_bg .area_icon{margin-left:1px;position:relative;top:-2px;}
.w1{width:117px;height:32px;line-height:32px;border:1px solid #ebeaea;display:inline-block;float:left;margin-top:-1px;margin-left:-1px;z-index:3;}
.w1:first-child{width:118px;margin-left:0px;}
.area_icon{margin-left:1px;}
.w1 a,.sel_w2_bg a{display:block;}
.b2b_bn{width:100%;}
.bn_pay1,.bn_card{width:100%;height:100%;display:block;clear:both;}
.b2b_w1,.b2b_w3{display:table;}
.bn_pay1 .b2b_w1{width:708px;height:50px;border:1px solid #ebeaea;text-align:left;float:left;position:relative;margin-top:-1px;margin-left:0px;z-index:3;display:block;}
.bn_pay1 .b2b_w1 .b2b_w1_table{width:708px;height:50px;display:table-cell;vertical-align:middle;position:relative;}
.bn_pay1 .b2b_w1 .linkArea{display:block;}
.bn_pay1 .b2b_w1 .card_bn_logo{display:inline-block;margin:3px 0 0px 12px;color:#1a1a1a;font-size:13px;font-weight:bold;line-height:24px;float:left;position:relative;}
.bn_pay1 .b2b_w1 .card_bn_txt{display:inline-block;width:300px;float:left;margin:6px 0 0px 10px;color:#f91313;font-size:12px;line-height:17px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.b2b_w1_table .area_icon{position:absolute;top:19px;right:10px;height:14px;}
.bn_card .b2b_w3{width:353px;height:40px;border:1px solid #ebeaea;text-align:left;float:left;position:relative;margin-top:-1px;margin-left:-1px;z-index:3;display:block;overflow:hidden;}
.bn_card .b2b_w3:first-child{width:354px;margin-left:0px;}
.bn_card .b2b_w3 .b2b_w3_table{width:354px;height:40px;display:table-cell;vertical-align:middle;position:relative;}
.bn_card .b2b_w3 .linkArea{display:block;}
.bn_card .b2b_w3 .card_bn_logo{display:inline-block;margin:2px 0 0px 12px;color:#1a1a1a;font-size:12px;font-weight:bold;line-height:24px;float:left;position:relative;}
.bn_card .b2b_w3 .card_bn_txt{display:inline-block;width:254px;float:left;margin:5px 0 0px 4px;color:#707070;font-size:12px;line-height:20px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}
.b2b_w3_table .area_icon{position:absolute;top:14px;right:10px;height:14px;}
.bn_pay1 .b2b_w1 .linkArea:focus,.bn_card .b2b_w3 .linkArea:focus{background:none;opacity:100;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";}
.ic_icon{position:relative;top:0px;padding-right:3px;}
.ic_icon1{padding-left:3px;float:left;}
.ic_icon2{position:relative;top:10px;}
.ic_notice{width:12px;height:12px;background-position:0px -17px;vertical-align:middle;margin:-3px 2px 0;z-index:9;}
.ic_arrow{position:absolute;top:2px;right:4px;}
.ic_required{width:5px;height:5px;background-position:-59px -17px;vertical-align:middle;margin:-3px 3px 0;}
.ic_slock{width:11px;height:11px;position:absolute;top:9px;right:4px;}
.bank_logo em{display:inline-block;}
.bank_logo img{display:none;}
.w1:hover .bank_logo em{display:none;}
.w1:hover .bank_logo img{display:inline-block;height:16px;margin-top:7px;}
.select_month{height:34px;width:120px;float:left;border:1px solid #959595;margin-right:20px;}
.sel_card_month2{width:170px;height:34px;border:1px solid #b2b1b1;color:#707070;font-size:12px;margin-right:7px;float:left;}
.sel_card_month3{width:170px;height:34px;border:1px solid #b2b1b1;color:#707070;font-size:12px;float:left;}
.chk_txt{margin-top:8px;margin-right:20px;float:left;}
.chk_agree{color:#1a1a1a;font-weight:700;font-size:13px;line-height:18px;padding-top:2px;}
.ic_view{width:3px;height:7px;background-position:-54px -17px;vertical-align:middle;margin:-3px 3px 0;}
.agree_new{border:1px solid #ebeaea;height:42px;width:708px;margin-top:-5px;margin-bottom:15px;}
.agree_new .tit{font-size:13px;line-height:42px;margin-left:18px;height:20px;padding-top:0;float:left;}
.agree_new .agree_chk_bg{position:absolute;top:0px;right:10px;}
.agree_new .chk_agree_all{color:#1a1a1a;font-weight:700;font-size:11px;line-height:18px;float:left;margin:12px 4px 11px 10px;}
.agree_new .view_agree{color:#5e5e5e;font-size:11px;float:left;line-height:18px;margin:13px 20px 0 5px;}
.agree_new .view_agree a{color:#5e5e5e;}
.agree_new .chk_agree{color:#707070;font-weight:normal;font-size:11px;line-height:18px;float:left;margin:12px 5px 11px 8px;}
.account_w{width:347px;margin-bottom:10px;position:relative;}
.account_tit{color:#1a1a1a;font-size:13px;display:block;margin-bottom:4px;}
.account_r{position:absolute;top:0;right:0px;color:#5e5e5e;font-size:12px;}
.account_r a{color:#5e5e5e;}
.txt_foreign{color:#ff0000;font-size:11px;width:170px;text-align:right;position:absolute;top:1px;left:540px;z-index:3;}
.btn_area{position:absolute;top:0px;right:0px;padding:10px 25px 11px 0;width:426px;height:35px;text-align:right;}
.btn_area:after{display:block;clear:both;content:'';}
.btn_gray,.btn_color{overflow:hidden;display:inline-block;color:#fff;font-size:15px;font-weight:700;text-align:center;border:none;}
.disable{background:#585858;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=15)";filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=15);opacity:0.15;}
.disable:focus{-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=100);opacity:1;}
.btn_gray,.btn_color{background:#8f8f8f;width:158px;height:35px;border-radius:3px;}
.btn_gray:hover{background:#5a5a5a;}
.layerCon_elsepay{background:#fff;padding:0px 0px 4px;z-index:500;position:relative;border:1px solid #000;border-radius:4px;}
.popComTitle{position:relative;top:0px;height:30px;background:#000;border-radius:4px 4px 0 0px;}
.popComTitle a.btn_close{cursor:pointer;position:absolute;right:7px;top:6px;display:inline-block;width:18px;height:18px;line-height:17px;color:#fff;text-align:center;overflow:hidden;text-indent:-9999em;vertical-align:top;background:url(https://spay.kcp.co.kr/img/btn_pop_close2_on.png) no-repeat 0 0;}
.popComTitle a.btn_close:hover{cursor:pointer;background:url(https://spay.kcp.co.kr/img/btn_pop_close2_off.png) no-repeat;background-color:#fff;}
.notice_check{display:none;}
@media \0screen{
input,button,select{font-family:'돋움',dotum,arial,Helvetica,sans-serif;}
img{-ms-interpolation-mode:bicubic;}
input,select{line-height:28px!important;}
.input_txt{line-height:28px!important;}
select{background:none;background-color:#fff;padding:3px 3px 5px;}
select::-ms-expand{display:none;}
select:focus{background:none;background-color:#fff;}
.ic_icon{position:relative;top:0px;padding-top:0px;padding-right:2px;}
.agree_new .tit{line-height:42px;margin-left:18px;float:left;font-size:12px;letter-spacing:-1px;}
.agree_new .agree_chk_bg{float:right;margin-right:15px;letter-spacing:-1px;font-size:11px;}
.chk_box input[type="checkbox"]{width:16px;height:15px;}
}
@media screen and (-ms-high-contrast:active), (-ms-high-contrast:none){
.content{padding:0 24px;height:434px;position:relative;}
}
/*! CSS Used from: https://spay.kcp.co.kr/css/skin/color_blue.css */
.header_color{background:#207bba;}
.location .on,.location .on:hover{color:#207bba;font-weight:bold;}
.b2b_w1:hover,.b2b_w3:hover,.w1:hover{border:1px solid #207bba;background:#e8fcff;color:#333;position:relative;z-index:10;}
.sel_w2_bg:hover{border:1px solid #207bba;background:#e8fcff;color:#333;position:relative;z-index:10;top:-1px;left:-1px;}
.sel_w2_bg ul{border:1px solid #207bba;}
.btn_color{background:#207bba;}
.btn_color:hover,.disable:focus{background:#1a5d8c;}
/*! CSS Used from: Embedded */
div.nppfs-keypad-div{position:absolute;display:none;width:0px;height:0px;}
div.nppfs-keypad{position:relative;margin:0px;z-index:9999;}
div.nppfs-keypad .kpd-group{width:0px;height:0px;}
div.nppfs-keypad .kpd-button{cursor:pointer;}
div.nppfs-keypad .kpd-blank{cursor:default;}
/*! CSS Used from: Embedded */
#nppfs-keypad-card_num3 .kpd-wrap{position:relative;width:259px;height:172px;}
#nppfs-keypad-card_num3 .kpd-image{background-image:url(https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=5312e46984120a14ddcbe12e945d027ce172efce3ff87568ae9581a81bed4decc1905763c3b04afbbbd1312f5f938dcd653e5448cc87aef731880231f4cb1818ddb2ecd4fd3c4721c732792bcacea35ba2db75d2052d1949767195d356890b80&pi=N);background-repeat:no-repeat;background-position:0px 0px;}
#nppfs-keypad-card_num3 .kpd-button{position:absolute;width:undefinedpx;height:undefinedpx;overflow:hidden;}
/*! CSS Used from: Embedded */
#nppfs-keypad-card_num4 .kpd-wrap{position:relative;width:259px;height:172px;}
#nppfs-keypad-card_num4 .kpd-image{background-image:url(https://spay.kcp.co.kr/pluginfree/jsp/nppfs.keypad.jsp?m=i&k=b0e2bc9a8546471fc2219163461ec0762c0ac244d3d5dd199f8385cb36b70cbaf7d8d6e6af40ef181555a89de50d78b84218bee0e139fcd4675f60b50838d6cbef7faa6197c255b1bea53a4a7b06996a719b655bcc8e61877b610f719f115c0d&pi=N);background-repeat:no-repeat;background-position:0px 0px;}
#nppfs-keypad-card_num4 .kpd-button{position:absolute;width:undefinedpx;height:undefinedpx;overflow:hidden;}
/*! CSS Used fontfaces */
@font-face{font-family:'NanumBarunGothic';font-style:normal;font-weight:400;src:local(※),          url(https://cdn.kcp.co.kr/font/NanumBarunGothic.woff) format('woff');}
@font-face{font-family:'NanumBarunGothic';font-style:normal;font-weight:700;src:local(※),          url(https://cdn.kcp.co.kr/font/NanumBarunGothicBold.woff) format('woff');}

	</style>
	<?php
}	
?>
 <main class="site-main site-login">
        <div class="box-center box-center-2">
            <div class="toolbar-products">
                <h4 class="title-product">견적서</h4>
            </div>
            <table class="search-list-table">
                <thead>
                <tr>
                    <th>CATEGORY</th>
                    <th>DESCRIPTION</th>
                 
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                </tr>
                </thead>
                <tbody>
			  <?php
			  $totalPrice=0;
					foreach($carts['list'] as $cart){
						$cart['details']=json_decode( $cart['details'],true);
						$cart['details']['package_type']=null;
						$cart['details']['delivery_type']=null;
						$cart['details']['Submit']=null;
					//	$cart['details']['product_type']=null;
						$cart['details']['has_data']=null;
						$totalPrice = $totalPrice+$cart['price']*$cart['amount'];
				?>
                <tr>
                    <th scope="row"><?=$cart['details']['category']?></th>
                    <th class="product_detail">
						<?php
					$detailIndex=0;
					foreach($cart['details'] as $title=>$detail){	
	
					if($detail==''){
						continue;
					}
					if(in_array($title,$omit)){
						continue;
					}
					if($detailIndex!=0){
						echo ',';
					}
				?>
					<?=$detail?>
					<?php
										$detailIndex++;
				}	
				?>

                    </th>
                  
                    <td><?=$cart['amount']?></td>
                    <td><?=number_format($cart['price']*$cart['amount'])?></td>
                </tr>
				<?php
}	
				?>
              
                </tbody>
            </table>
            <p class="estimate-cart-guide">* 상기 테이블에서 다운로드 가능한 성적서는 결제 진행 후, 등록하신 메일로 한 번에
                보내 드립니다.</p>
            <div class="cart-tooltip">
                <p>가장 빠른 운송 일정을 제공해 드렸습니다!
                    모든 제품이 동일한 일정으로 운송되는 것이 더 편하신가요?</p>
            </div>

            <div class="estimate-sheet-amount">
                <div class="box-price"><span class="text-label">총액</span>
                    <span class="box-format-amount"> <strong class="text-value" id="tprice"><?=number_format($totalPrice)?></strong>
                        <span class="text-unit">원</span></span>
                </div>
            </div>
            <button type="submit" class="btn-checkout estimate-sheet-buy">
                <span>구매하기</span>
            </button>
        </div>
    </main>
<script>
/*
	var doc = new jsPDF();
doc.text(20, 20, 'Hello world!');
doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
doc.addPage();
doc.text(20, 20, 'Do you like that?');

doc.save('Test.pdf');
*/
$('.estimate-sheet-buy').click(function(){
Swal.fire({
  title: '<strong>견적서 내용대로 주문하시겠습니까?</strong>',
  icon: 'info',
  html:
    '',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a href="#"  style="color:white;">확인</a>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '취소',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {
	
  if (result.value) {
	  $('#fog,#contentsWrap').fadeIn();
	setTimeout(function(){
		closeLoading();
		$('#pname').text($.trim($('.product_detail').eq(0).text()).substr(0,25)+'외 '+($('.product_detail').size()-1)+'건');
		$('#pay_price').text($('#tprice').text()+'원')
	},2500);
 // location.href='/user/estimate?order=1'
  }
})
});


$('#usrCancel').click(function(){
$('#fog,#contentsWrap').fadeOut();
		return false;
	});
</script>


<?php
include 'views/footer.html';
?>