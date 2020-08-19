<?php
if($param['status']==''){
	$param['status']=0;
}
if($param['status']==1){
	$param['status']='1,2,3,4,5,6,7,8,9';

}

if($param['update_status']){
	$cartParam['status'] = $param['update_status'];
	updateItem('estimate_cart_products,viewQuery',$cartParam,'order_no='.$param['order_no']);
	
	$orderParam['status']= $param['update_status'];
	updateItem('estimate_orders',$orderParam,$param['order_no']);

		getBack();
	exit;
}

if($param['cart_info']){
	$estimateCarts=getListQuery('
	SELECT estimate_orders.wish_date,estimate_cart_products.*,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name 
	FROM estimate_cart_products 
	LEFT JOIN product_lists ON product_lists.no = estimate_cart_products.product_no 
	LEFT JOIN users AS product_user ON product_lists.user_no = product_user.no
	LEFT JOIN users AS cart_user ON estimate_cart_products.user_no = cart_user.no 
	LEFT JOIN estimate_orders ON estimate_cart_products.order_no = estimate_orders.no 
	WHERE product_lists.user_no='.$session['login'].' AND order_no='.$param['order_no'].'
	 ORDER BY estimate_cart_products.no DESC');
	foreach($estimateCarts['list'] as $estimateCart){

	

?>
	<tr>
		<td><?=displayDetailEach($estimateCart['details'],'category')?></td>
		<td>	<?=displayDetail($estimateCart['details'])?></td>
		<td><?=displayDetailEach($estimateCart['details'],'material_grade')?></td>
		<td><?=$estimateCart['amount']?></td>

	</tr>
	<?php
	}
	exit;
}
$join=array(
	array('LEFT','product_lists','product_lists.no = estimate_cart_products.product_no'),
	array('LEFT','users AS product_user','product_lists.user_no = product_user.no'),
	array('LEFT','users AS cart_user','estimate_cart_products.user_no = cart_user.no'),
	array('LEFT',' estimate_orders','estimate_cart_products.order_no =  estimate_orders.no')
);

$estimateCarts=getListQuery('
SELECT estimate_orders.wish_date,estimate_cart_products.*,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name 
FROM estimate_cart_products 
LEFT JOIN product_lists ON product_lists.no = estimate_cart_products.product_no
LEFT JOIN users AS product_user ON product_lists.user_no = product_user.no 
LEFT JOIN users AS cart_user ON estimate_cart_products.user_no = cart_user.no 
LEFT JOIN estimate_orders ON estimate_cart_products.order_no = estimate_orders.no WHERE estimate_cart_products.status in ('.$param['status'].') AND product_lists.user_no='.$session['login'].'
GROUP BY order_no  ORDER BY estimate_cart_products.no DESC');
/*$estimateCarts=getListJoin(
'estimate_cart_products,viewQuery',
$join,
'estimate_cart_products.*,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name',
'product_lists.user_no='.$session['login']);*/

	include'views/header.html';
?>

<main class="site-main site-login min-height" style="padding:60px 0;">
 <div class="container">
<?php
	include'views/seller_tab.html';
?>
	
    
	
	<table class="table" id="order_list">
			<tr>
				<th>
					구매일

				</th>	
				<th>
					구매자명

				</th>
				<th>
					주문내용

				</th>
				<?php
					if($param['status']==1){
				?>
				<th>
					배송일정

				</th>
				<?php
				}	
				?>
				<th>
						수량

				</th>
				<th>
						합계

				</th>
				<?php
					if($param['status']==1){
				?>
				<th>
					상태

				</th>
				<th>
					처리

				</th>
				<?php
				}	
				?>

			</tr>
			<?php
				if($estimateCarts['length']==0){
			echo '<tr><td colspan="6">주문 목록이 없습니다.</td></tr>';
		}
			foreach($estimateCarts['list'] as $estimateCart){
				
				$estimateCart['details']=json_decode( $estimateCart['details'],true);
			
			?>
			<tr data-no="<?=$estimateCart['order_no']?>">
					<td>
						<?=$estimateCart['create_date']?>

					</td>
					<td>
					<?php
						if($estimateCart['status']>3){	
					?>
						<?=$estimateCart['user_name']?>
				<?php
					}
					else{
					echo '***';
					}
					?>
					</td>
					<td>
						<?=$estimateCart['details']['pipe']?>
						<?=$estimateCart['details']['material_grade']?>

					</td>
					<?php
					if($param['status']==1){
				?>
					<td>
					<?=$estimateCart['wish_date']?>까지

					</td>
					<?php
					}
					?>
					<td>
						
						<?=$estimateCart['amount']?>
					</td>
					<td>
<?php


	?>
			
							<?=number_format($estimateCart['product_price'])?>\

					</td>
					
						<?php
					if($param['status']==1){
				?>
				<td>
			
					<?=displayStatus($estimateCart['status'])?>

				</td>
				<td>	
				<?php
					if($estimateCart['status']==2){	
				?>
			
					<a href="?update_status=3&order_no=<?=$estimateCart['order_no']?>" class="btn btn-primary">입금 확인 및 계산서 발행 예정</a>
				<?php
				}	
					?>
				<?php
					if($estimateCart['status']==3){	
				?>
			
					<a href="?update_status=4&order_no=<?=$estimateCart['order_no']?>" class="btn btn-primary">계산서 발행완료</a>
				<?php
				}	
					?>
				<?php
					if($estimateCart['status']==4){	
				?>
			
					<a href="?update_status=5&order_no=<?=$estimateCart['order_no']?>" class="btn btn-primary">발송처리</a>
				<?php
				}	
					?>
				<?php
					if($estimateCart['status']==6){	
				?>
			
					<a href="" class="btn btn-warning">출금신청</a>
				<?php
				}	
					?>
				</td>
				<?php
				}	
				?>

			</tr>
			<?php
			}	
			?>

	</table>
	<form action="">
		<input type="text" class="datepicker" placeholder="시작일 선택"> ~ <input type="text" class="datepicker"  placeholder="종료일 선택">
	<a href="" class="btn btn-default">검색</a>

	</form>
	<div style="float:right;">
		 <a href="" class="btn btn-success"><i class="fa fa-xls"></i> 엑셀 다운로드</a>

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
#order_list tr{
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
	location.href='/seller/order_detail?order_no='+no
});

</script>
<?php
	include'views/footer.html';
?>