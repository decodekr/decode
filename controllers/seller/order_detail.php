<?php
	$estimateCarts=getListQuery('
	SELECT sum(product_lists.price) AS price_total,estimate_orders.wish_date,estimate_cart_products.*,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name 
	FROM estimate_cart_products 
	LEFT JOIN product_lists ON product_lists.no = estimate_cart_products.product_no 
	LEFT JOIN users AS product_user ON product_lists.user_no = product_user.no
	LEFT JOIN users AS cart_user ON estimate_cart_products.user_no = cart_user.no 
	LEFT JOIN estimate_orders ON estimate_cart_products.order_no = estimate_orders.no 
	WHERE product_lists.user_no='.$session['login'].' AND order_no='.$param['order_no'].'
	 ORDER BY estimate_cart_products.no DESC');

	 $join=array('LEFT','users','users.no = estimate_orders.user_no');
	 $order=getItemJoin('estimate_orders',$join,'estimate_orders.*','estimate_orders.no = '.$param['order_no']);

	include'views/header.html';
?>

<main class="site-main site-login min-height" style="padding:60px 0;">
 <div class="container">
<?php
	include'views/seller_tab.html';
?>
	
    <div class="container">
	<h3>
		주문번호 : <?=str_replace(array(' ','-',':'),'',$order['create_date']).$order['no']?>

	</h3><br>
            <form action="#" class="checkout" method="post" name="checkout">
                <h4 class="title-checkout">주문자 정보</h4>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="title">주문자 명</label>
                        <input type="text" class="form-control" readonly id="forFName" value="<?php
						if($order['status']>3){	
					?>
						<?=$order['user_name']?>
					<?php
						}
						else{
						echo '***';
						}
					?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="title">주문일시</label>
                        <input type="text" class="form-control" id="forLName" readonly value="<?=$order['create_date']?>"  >
                    </div>
                    <div class="form-group col-md-6">
                        <label class="title">주문 총액</label>
                        <input type="email" class="form-control" id="forEmail" placeholder="<?=number_format($estimateCarts['list'][0]['price_total'])?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="title">구매자 배송 정보</label>
                        <input type="text" class="form-control" placeholder="<?php
						if($order['status']>3){	
					?>
						<?=$order['user_name']?>
					<?php
						}
						else{
						echo '***';
						}
					?>">
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <label class="title">Address:</label>
                        <input type="text" class="form-control" placeholder="Street at apartment number">
                    </div>
                 
					 -->
                  
                    
                </div>
				<h4 class="title-checkout">주문 상품</h4>
				<div class="row">
					<table class="table-bordered table">
					<thead>
						<tr>
						<th>
							CATEGORY

						</th>
						<th>
							DESCRIPTION

						</th>
						<th>
							MATERIAL GRADE

						</th>
						<th>
							QUANTITY

						</th>
						<th style="width:100px;">
							정보

						</th>
					</tr>

				<?php
				


	foreach($estimateCarts['list'] as $estimateCart){

	

?>
	<tr>
		<td><?=displayDetailEach($estimateCart['details'],'category')?></td>
		<td>	<?=displayDetail($estimateCart['details'])?></td>
		<td><?=displayDetailEach($estimateCart['details'],'material_grade')?></td>
		<td><?=$estimateCart['amount']?></td>
		<td>
			<a href="/product/detail?no=<?=$estimateCart['product_no']?>" class="btn btn-default">확인</a>

		</td>
	</tr>
	<?php
	}
	
?>

					</table>
				</div>
				<h4 class="title-checkout">주문 상태</h4>
				<div class="row">

				<div class="form-group col-md-12" id="order_process">
						<a href="" class="btn btn-lg <?=attr($order['status']==0,'btn-primary','btn-default')?> ">견적바구니</a> <i class="fa fa-arrow-right"></i>
						<a href="" class="btn btn-lg <?=attr($order['status']==1,'btn-primary','btn-default')?>">주문</a> <i class="fa fa-arrow-right"></i>
						<a href="" class="btn btn-lg <?=attr($order['status']==2,'btn-primary','btn-default')?>">제품 준비중</a> </i><br><br>
					<i class="fa fa-arrow-right"></i>	<a href="" class="btn btn-lg <?=attr($order['status']==3,'btn-primary','btn-default')?>">입금완료</a> <i class="fa fa-arrow-right"></i>
						<a href="" class="btn btn-lg <?=attr($order['status']==4,'btn-primary','btn-default')?>">계산서 발행 및 서류 등록 완료</a> <i class="fa fa-arrow-right"></i>
						<a href="" class="btn btn-lg <?=attr($order['status']==5,'btn-primary','btn-default')?>">구매자 최종 승인</a> <br><br>
						<i class="fa fa-arrow-right"></i> <a href="" class="btn btn-lg <?=attr($order['status']==6,'btn-primary','btn-default')?>">대금지급 완료</a> <i class="fa fa-arrow-right"></i>
						<a href="" class="btn btn-lg <?=attr($order['status']==7,'btn-primary','btn-default')?>">배송중</a> <i class="fa fa-arrow-right"></i>
						<a href="" class="btn btn-lg <?=attr($order['status']==8,'btn-primary','btn-default')?>">거래완료</a> 
					</div>

					<style>
						#order_process a{
					
					}
						#order_process a.btn-lg{
					width: 300px;
					height: 44px;
					}
					#order_process i,#order_process a{
						vertical-align: middle;
					}

					</style>
				</div>
				<h4 class="title-checkout">배송 및 서류 정보 입력</h4>
				 <div class="row">
                    <div class="form-group col-md-12">
                        <label class="title"> 운송정보 입력</label>
                        <input type="text" class="form-control" id="forFName" placeholder="운송정보 입력">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="title"> 서류 첨부 </label>
                        <input type="file" class="form-control">
<br>
						<ul>
								<li>
									<a href="">Sample.xlsx</a>

								</li>

						</ul>
                    </div>
				</div>
            </form>
        </div>


	
	
	
 </div>
</main>

<div id="order_detail_layer" class="layer">
<a href="" class="close_button"><img src="/images/best5_close_button.png" alt=""></a>
	<a href="" class="btn btn-default">출력 </a><br><br>
	<table class="table">
		<thead>
			<tr>
			<th>
				CATEGORY

			</th>
			<th>
				DESCRIPTION

			</th>
			<th>
				MATERIAL

			</th>
			<th>
				QUANTITY

			</th>
		</tr>

		</thead>
		<tbody></tbody>

	</table>
</div>
<style>
	#order_detail_layer{
	display: none;
		position: fixed;z-index: 9999;
		top: 50%;
		left: 50%;
		padding: 15px;
		box-shadow:1px 1px 6px #000;
		width: 800px;
		margin-left: -400px;
		margin-top: -300px;
		background: #fff;
		height: 600px;
		overflow: auto;
	}
#order_detail_layer a.close_button{
	position: absolute;
	top: -50px;
	right: -50px;
}
#order_detail_layer tr{
cursor:pointer;
}
</style>

<script>
	$('.close_button').click(function(){
		$('#order_detail_layer,#fog').fadeOut();
		return false;
	});
	$('#order_list tr').click(function(){
	var no = $(this).data('no');
	postRequest({
		url : '',
		data: {cart_info:1,order_no:no},
		dataType:'HTML',
		success : function($data){
			$('#order_detail_layer,#fog').slideDown();
			$('#order_detail_layer tbody').html($data);
		}

	})
});

</script>
<?php
	include'views/footer.html';
?>