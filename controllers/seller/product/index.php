<?php
if($param['del']){
	deleteItem('product_lists',$param['del']);
	printMessage('상품을 삭제했습니다.');
	exit;
}
$products=pageList('product_lists','user_no='.$session['login'],'',20,10,$param['page'],'?page=$page');
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
				<th  style="width:150px;">
					상품번호

				</th>	
				<th  style="width:150px;">
					등록일

				</th>	
				<th>
					상품명

				</th>
				<th style="width:80px;">
					수량

				</th>
				<th  style="width:150px;">
					입금 후 <br>납기일

				</th>
				<th  style="width:150px;">
						수정

				</th>
			

			</tr>
			<?php

			if($products['length']==0){
				echo '<tr><td colspan="5">등록된 상품이 없습니다. [상품등록]에서 상품을 등록해주세요.</td></tr>';
			}
			foreach($products['list'] as $product){
				
				
			
			?>
			<tr data-no="<?=$product['order_no']?>">
					<td>
						<?=$product['product_id']?>

					</td>
					<td>
						<?=dateFormat($product['create_date'])?>

					</td>
					<td>
					
				<?=$product['category']?>
					<?php
					if($product['details']!=''){	
				?>
					,
					<?=displayDetail($product['details'])?>
					<?php
				}	
				?>

					</td>
					<td>
						<?=$product['amount']?>

					</td>
					<td>
						<?=$product['delivery_date']?>일 이내

					</td>
					<td>
						
					<a href="/product/add?no=<?=$product['no']?>" class="btn btn-default">수정</a>
					<a href="?del=<?=$product['no']?>" class="btn btn-danger">삭제</a>
					</td>
				

			</tr>
			<?php
			}	
			?>

	</table>

	<div class="pagination">
		
		<?=$products['pagination']?>
	</div>

 </div>
</main>




<?php
	include'views/footer.html';
?>