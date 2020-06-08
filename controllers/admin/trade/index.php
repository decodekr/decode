	<?php
	if($param['status']){
		$cartParam['status'] = $param['status'];
			updateItem('estimate_cart_products',$cartParam,$param['no']);


			if($param['status']==1){
				getUserList($page, $size);
				calcItem('users',$userParam);
			}

			jsonMessage(1,'거래 상태 변경');
		exit;
	}
	$join=array(
	array('LEFT','users','estimate_orders.user_no = users.no')
);

$estimateOrders=pageListJoin('estimate_orders',$join,'estimate_orders.*,users.name AS user_name','','',10,10,$param['page'],'?page=$page');
	include'views/admin/document.html';
	include'views/admin/header.html';
?>
<h2 id="contents_title">
	<i class="fa fa-leaf"></i>
	판매 관리
</h2>
<div class="contents">
	<div class="container">
		<table class="table" id="order_list">
	<thead>
		
	<tr>
				<th style="width:100px;">
					구매일

				</th>	
				<th  style="width:100px;">
					구매자명

				</th>
				<th style="width:900px;">
					주문내용

				</th>
				<th  style="width:100px;">
					배송일정

				</th>
			
				<th  style="width:170px;">
						합계

				</th>
				<!-- <th>
					상태

				</th> -->
				<th  style="width:100px;">
					관리

				</th>

			</tr>
	</thead>
		
		<tbody>
				<?php
				if($estimateOrders['length']==0){
			echo '<tr><td colspan="6">주문 목록이 없습니다.</td></tr>';
		}
			foreach($estimateOrders['list'] as $estimateOrder){
				$estimateOrder['details']=json_decode( $estimateOrder['details'],true);
				$estimateCarts=getListQuery('
				SELECT estimate_cart_products.*,product_user.name as product_user_name,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name FROM estimate_cart_products
				LEFT JOIN product_lists ON product_lists.no = estimate_cart_products.product_no
				LEFT JOIN users AS product_user ON product_lists.user_no = product_user.no 
				LEFT JOIN users AS cart_user ON estimate_cart_products.user_no = cart_user.no 
				LEFT JOIN estimate_orders ON estimate_cart_products.order_no = estimate_orders.no 
				Where estimate_cart_products.order_no='.$estimateOrder['no'].'
				ORDER BY estimate_cart_products.no DESC');
			?>
			<tr data-no="<?=$estimateOrder['order_no']?>">
					<td>
						<?=$estimateOrder['create_date']?>

					</td>
					<td>
						<?=$estimateOrder['user_name']?>

					</td>
					<td>
					<table class="table">
					<tr>
							<th>
								주문내용

							</th>
							<th>
								판매자명

							</th>
							<th>
								상태

							</th>
							</tr>
					<?php
						foreach($estimateCarts['list'] as $cart){
			
					?>
						
							

							<tr>
								<td>

									<?=displayDetail($cart['details'])?>

								</td>
								<td>
							

									
									
						<select name="status" data-no="<?=$cart['no']?>" data-selected="<?=$cart['status']?>">
								
								<option value="0" <?=attr($cart['status']==0)?>>견적바구니</option>
								<option value="1"  <?=attr($cart['status']==1)?>>주문접수</option>
								<option value="2"  <?=attr($cart['status']==2)?>>구매자정보확인</option>
								<option value="3"  <?=attr($cart['status']==3)?>>입금대기중</option>
								<option value="4"  <?=attr($cart['status']==4)?>>입금확인</option>
								<option value="5"  <?=attr($cart['status']==5)?>>계약서 및 서류 확인</option>
								<option value="6"  <?=attr($cart['status']==6)?>>배송중</option>
								<option value="9"  <?=attr($cart['status']==9)?>>주문취소</option>
								<option value="10"  <?=attr($cart['status']==10)?>>판매완료</option>
						</select>
					
								</td>
							<td><?=$cart['product_user_name']?></td>
							</tr>

					

					<?php
					}	
					?>
	</table>
					</td>
					<td>
						2020.04.01 까지

					</td>
				
					<td>
							<?=number_format($estimateOrder['product_price'])?>\

					</td>
					<!-- <td>
						
					</td> -->
					<td>
						<a href="" class="btn btn-default">수정</a>
						 <a href="" class="btn btn-red">삭제</a>

					</td>

			</tr>
			<?php
			}	
			?>


		</tbody>
		
	</table>
	<div class="pagination">
		
		<?=$estimateOrders['pagination']?>
	</div>
	<script>
		
		$('[name="status"]').change(function(){
			var status = $(this).val();
			var no =  $(this).data('no');
			
			postRequest({
				url : '/admin/trade',
				data : {status:status,no:no},
				success : function(){
					alert('거래 상태를 변경했습니다.');

				}

			});
		});
	</script>
	</div>
</div>


<?php
	include'views/admin/footer.html';
?>