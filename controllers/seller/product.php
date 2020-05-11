<?php
$products=getList('product_lists','user_no='.$session['login']);
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
					등록일

				</th>	
				<th>
					상품명

				</th>
				<th>
					수량

				</th>
				<th>
					입금 후 납기일

				</th>
				<th>
						수정

				</th>
			

			</tr>
			<?php
			foreach($products['list'] as $product){
				$product['details']=json_decode( $product['details'],true);
			
			?>
			<tr data-no="<?=$product['order_no']?>">
					<td>
						<?=$product['create_date']?>

					</td>
					<td><?=$product['details']['pipe']?>
						<?=$product['details']['material_grade']?>
					

					</td>
					<td>
						1

					</td>
					<td>
						<?=$product['delivery_date']?>일 이내

					</td>
					<td>
						
					<a href="/product/add?no=<?=$product['no']?>" class="btn btn-default">수정</a>
					<a href="" class="btn btn-danger">삭제</a>
					</td>
				

			</tr>
			<?php
			}	
			?>

	</table>

 </div>
</main>




<?php
	include'views/footer.html';
?>