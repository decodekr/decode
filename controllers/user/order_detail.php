<?php
if($param['complete']==1){
	$cartParam['status']=6;
	updateItem('estimate_cart_products',$cartParam,$param['cart_no']);


	//$orderParam['status']= 6;
	//updateItem('estimate_orders',$orderParam,$param['order_no']);
}

$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier');
$order=getItem('estimate_orders',$param['no']);
$carts = getListJoin('estimate_cart_products',array('LEFT','product_lists','order_no='.$param['no'].' AND estimate_cart_products.product_no=product_lists.no'),'estimate_cart_products.*,product_lists.details',' estimate_cart_products.user_no='.$session['login'].' AND product_lists.details!=""');


	include'views/header.html';
?>

<main class="site-main site-login">

        <div class="box-center box-center-2">
		<h2 class="sub_title  ">주문번호 <?=str_replace(array(' ','-',':'),'',$order['create_date']).$order['no']?></h2>

            <!-- <div class="search-list-bar clearfix">
                <div class="search-list-bar-input">
                    <input type="text" id="todo-input-text" name="todo-input-text" class="form-control">
                </div>
                <div class="search-list-bar-button">
                    <button class="btn-primary btn-md btn-block btn waves-effect waves-light" type="button" id="todo-btn-submit">검색</button>
                </div>
            </div> -->
            <table class=" table table-bordered">
           
    <thead>
    <tr>
        <th scope="col" style="width:120px;">주문일</th>
        <td><?=$order['create_date']?></td>
    </tr>
	  <tr>
        <th scope="col">주문총액</th>
        <td><?=number_format($order['total_price'])?>원</td>
    </tr>
	  <tr>
        <th scope="col">희망배송일</th>
        <td><?=$order['wish_date']?></td>
    </tr>


	<tr>
		
		<td colspan="2">
			 <table class="search-list-table table table-bordered">
                <thead>
                <tr>
			
                    <th>CATEGORY</th>
                    <th>DESCRIPTION</th>
            
                    <th>QUANTITY</th>
                    <th>성적서<br>
					써티 도면 테스트 소재
					</th>
					<th>
						STATUS

					</th>
                </tr>
                </thead>
                <tbody>
                <?php
					foreach($carts['list'] as $cart){
						if($cart['details']==''){
						continue;
						}
						$cart['details']=json_decode( $cart['details'],true);
						$cart['details']['package_type']=null;
						$cart['details']['delivery_type']=null;
						$cart['details']['Submit']=null;
					//	$cart['details']['product_type']=null;
						$cart['details']['has_data']=null;
						if($cart['details']['category']==''){
							continue;
						}
						
				?>
                <tr class="product_row">
					
                    <th scope="row"><?=$cart['details']['category']?></th>
                    <th>
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
					<td id="attaches">
						<a href="#" class="attach_icon"><i class="fa fa-file"></i></a>
						<a href="#" class="attach_icon"><i class="fa fa-file"></i></a>
						<a href="#" class="attach_icon"><i class="fa fa-file"></i></a>
						<a  href="#"class="attach_icon"><i class="fa fa-file"></i></a>

					</td>
					<td>

					<?php
						$status=array('견적바구니','입금대기','입금완료','계산서 발행중','결제완료','운송중','거래완료');
			
				
	
				

						if($cart['status']==6){
						?>
						<strong style="color:green">거래 완료</strong>
					<?php
					}
						else{
						echo $status[$cart['status']];

						}
				?>
					<?php
	
					if($cart['status']==5){	
				?>
						<a href="?complete=1&cart_no=<?=$cart['no']?>&order_no=<?=$cart['order_no']?>" class="btn btn-success btn-xs">물품 수령</a>
					<?php
				}	
				?>
						
					</td>
				</tr>
				<?php
}			
					if($carts['length']==0){
					echo '<tr><td>견적 내역이 없습니다.</td></tr>';
					}
				?>
                </tbody>
            </table>
		</td>
	</tr>

    </thead>
    
  
            </table>
            <div class="clearfix">
                <!-- <a href="/user/estimate" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select">견적서 요청</a> -->
            </div>
        </div>
    </main>

<?php
	include'views/footer.html';
?>
