<?php
$orders=getList('estimate_orders','user_no='.$session['login']);

	include'views/header.html';
?>

<main class="site-main site-login">

        <div class="box-center box-center-2">
		<h2 class="sub_title  ">주문내역</h2>

            <!-- <div class="search-list-bar clearfix">
                <div class="search-list-bar-input">
                    <input type="text" id="todo-input-text" name="todo-input-text" class="form-control">
                </div>
                <div class="search-list-bar-button">
                    <button class="btn-primary btn-md btn-block btn waves-effect waves-light" type="button" id="todo-btn-submit">검색</button>
                </div>
            </div> -->
            <table class="search-list-table">
           
    <thead>
    <tr>
        <th scope="col">주문서번호</th>
        <th scope="col">주문일시</th>
        <th scope="col">상품수</th>
        <th scope="col">주문금액</th>
       
  
        <th scope="col">상태</th>
    </tr>
    </thead>
    <tbody>
    

    <?php
		foreach($orders['list'] as $order){
			$carts = getListJoin('estimate_cart_products',array('LEFT','product_lists','estimate_cart_products.product_no=product_lists.no'),'estimate_cart_products.*,product_lists.details,product_lists.price','order_no='.$order['no']);
			$total=0;
			foreach($carts['list'] as $cart){
				$total= $total+$cart['price'];
			}
	?>
    <tr>
        <td>
            <input type="hidden" name="ct_id[2]" value="">
            <a href="#"><?=str_replace(array(' ','-',':'),'',$order['create_date']).$order['no']?></a>
        </td>
        <td><?=$order['create_date']?></td>
        <td class="td_num"><?=$carts['length']?></td>
        <td class="td_numbig"><?=number_format($total)?>원</td>
       
 
        <td>접수</td>
    </tr>

<?php
	}	
?>


        </tbody>
  
            </table>
            <div class="clearfix">
                <!-- <a href="/user/estimate" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select">견적서 요청</a> -->
            </div>
        </div>
    </main>

<?php
	include'views/footer.html';
?>
