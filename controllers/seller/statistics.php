<?php
if($param['cart_info']){
	$estimateCarts=getListQuery('SELECT estimate_cart_products.*,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name FROM estimate_cart_products LEFT JOIN product_lists ON product_lists.no = estimate_cart_products.product_no LEFT JOIN users AS product_user ON product_lists.user_no = product_user.no LEFT JOIN users AS cart_user ON estimate_cart_products.user_no = cart_user.no LEFT JOIN estimate_orders ON estimate_cart_products.order_no = estimate_orders.no WHERE product_lists.user_no='.$session['login'].' AND order_no='.$param['order_no'].'
	 ORDER BY estimate_cart_products.no DESC');
	foreach($estimateCarts['list'] as $estimateCart){

		$estimateCart['details']=json_decode( $estimateCart['details'],true);

?>
	<tr>
		<td><?=$estimateCart['details']['product_type']?></td>
		<td><?=$estimateCart['details']['pipe_type']?></td>
		<td><?=$estimateCart['details']['material_grade']?></td>
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

$estimateCarts=getListQuery('SELECT estimate_cart_products.*,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name FROM estimate_cart_products LEFT JOIN product_lists ON product_lists.no = estimate_cart_products.product_no LEFT JOIN users AS product_user ON product_lists.user_no = product_user.no LEFT JOIN users AS cart_user ON estimate_cart_products.user_no = cart_user.no LEFT JOIN estimate_orders ON estimate_cart_products.order_no = estimate_orders.no WHERE product_lists.user_no='.$session['login'].'
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
	
    <div class="sidx">
    <section id="anc_sidx_ord">
  
        <ul class="anchor sidx_anchor">
<li><a href="#anc_sidx_ord">주문현황</a></li>
<li><a href="#anc_sidx_rdy">입금완료미배송내역</a></li>
<li><a href="#anc_sidx_wait">미입금주문내역</a></li>
<li><a href="#anc_sidx_ps">사용후기</a></li>
<li><a href="#anc_sidx_qna">상품문의</a></li>
</ul>
        
        <div id="sidx_graph">
   
            <ul id="sidx_graph_area">
                                <li class="bg0" style="z-index:10">
				<span style="position:absolute;top:0px;left:0;background:white;padding:2px;">
					<span style="color:green"><?=date('m월 d일')?> 정산 :  0원</span>
					<br>

					
				</span>
                    <div class="graph order" title="3월 12일 주문: 313,000원" style="height:90%;">
	
                    </div>
                    <div class="graph cancel" title="3월 12일 취소: 0원" style="height: ;">

                    </div>
                </li>
                                <!-- <li class="bg1" style="z-index:9">
				<span style="position:absolute;top:0px;left:0;border:1px solid #222;background:white;padding:2px;">
					<span style="color:green">3월 13일 주문: 198,800원</span>
					<br>
					
					
				</span>
                    <div class="graph order" title="3월 13일 주문: 198,800원" style="height: 136px;">
	
                    </div>
                    <div class="graph cancel" title="3월 13일 취소: 0원" style="height: 0px;">

                    </div>
                </li>
                                <li class="bg0" style="z-index:8">
				<span style="position:absolute;top:0px;left:0;border:1px solid #222;background:white;padding:2px;">
					<span style="color:green">3월 14일 주문: 128,700원</span>
					<br>
			
					
				</span>
                    <div class="graph order" title="3월 14일 주문: 128,700원" style="height: 91px;">
	
                    </div>
                    <div class="graph cancel" title="3월 14일 취소: 0원" style="height: 0px;">

                    </div>
                </li>
                                <li class="bg1" style="z-index:7">
				<span style="position:absolute;top:0px;left:0;border:1px solid #222;background:white;padding:2px;">
					<span style="color:green">3월 15일 주문: 361,600원</span>
					<br>
				
					
				</span>
                    <div class="graph order" title="3월 15일 주문: 361,600원" style="height: 239px;">
	
                    </div>
                    <div class="graph cancel" title="3월 15일 취소: 0원" style="height: 0px;">

                    </div>
                </li>
                                <li class="bg0" style="z-index:6">
				<span style="position:absolute;top:0px;left:0;border:1px solid #222;background:white;padding:2px;">
					<span style="color:green">3월 16일 주문: 345,290원</span>
					<br>
				
					
				</span>
                    <div class="graph order" title="3월 16일 주문: 345,290원" style="height: 229px;">
	
                    </div>
                    <div class="graph cancel" title="3월 16일 취소: 0원" style="height: 0px;">

                    </div>
                </li>
                                <li class="bg1" style="z-index:5">
				<span style="position:absolute;top:0px;left:0;border:1px solid #222;background:white;padding:2px;">
					<span style="color:green">3월 17일 주문: 144,850원</span>
					<br>
	
					
				</span>
                    <div class="graph order" title="3월 17일 주문: 144,850원" style="height: 102px;">
	
                    </div>
                    <div class="graph cancel" title="3월 17일 취소: 0원" style="height: 0px;">

                    </div>
                </li>
                                <li class="bg0" style="z-index:4">
				<span style="position:absolute;top:0px;left:0;border:1px solid #222;background:white;padding:2px;">
					<span style="color:green">3월 18일 주문: 18,200원</span>
					<br>
				
					
				</span>
                    <div class="graph order" title="3월 18일 주문: 18,200원" style="height: 21px;">
	
                    </div>
                    <div class="graph cancel" title="3월 18일 취소: 0원" style="height: 0px;">

                    </div>
                </li> -->
                            </ul>
            <ul id="sidx_graph_date">
                                <!-- <li><span></span>03-12 (목)</li>
                                <li><span></span>03-13 (금)</li>
                                <li><span></span>03-14 (토)</li>
                                <li><span></span>03-15 (일)</li>
                                <li><span></span>03-16 (월)</li>
                                <li><span></span>03-17 (화)</li> -->
                                <li><span></span><?=date('m-d')?> (수)</li>
                            </ul>
   
        </div>
    </section>

   
</div>
	

 </div>
</main>

<div id="order_detail_layer">
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
		margin-left: 00px;
		margin-top: -300px;
		background: #fff;
		height: 600px;
	}
#order_detail_layer a.close_button{
	position: absolute;
	top: -50px;
	right: -50px;
}
#order_detail_layer tr{
cursor:pointer;
}
#sidx_graph{
height: 600px;
}

/*! CSS Used from: https://hamzzi.net/adm/css/admin.css?date=1584470948 */
h2{margin:0;padding:0;border:0;}
h2{font-size:1em;font-family:'맑은 고딕';}
section{display:block;}
a{color:#000;text-decoration:none;}
a:focus,a:hover,a:active{text-decoration:underline;}
h2{margin:0 0 10px;padding:0 20px;font-size:1.2em;}
.anchor{margin:0 20px 10px 21px;padding:0;zoom:1;}
.anchor:after{display:block;visibility:hidden;clear:both;content:"";}
.anchor li{float:left;margin-left:-1px;list-style:none;}
.anchor a{display:inline-block;padding:5px 10px;border:1px solid #c8ced1;background:#d6dde1;text-decoration:none;}
.anchor a:focus,.anchor a:hover{background:#c8d2d8;}
table{clear:both;width:100%;border-collapse:collapse;border-spacing:0;}
tbody td{border:1px solid #ececec;}
.tbl_wrap{margin:0 0 10px;padding:0 20px;}
.tbl_head01 table{clear:both;width:100%;border-collapse:collapse;border-spacing:0;}
.tbl_head01 thead th,.tbl_head01 tbody th{padding:10px 0;border:1px solid #d1dee2;background:#e5ecef;color:#383838;letter-spacing:-0.1em;}
.tbl_head01 thead th{font-size:0.95em;}
.tbl_head01 tbody td{padding:10px 5px;line-height:1.4em;word-break:break-all;}
.bg0{background:#fff;}
.bg1{background:#f2f5f9;}
.td_mng{width:100px;font-size:0.95em;text-align:center;letter-spacing:-0.1em;}
.td_numbig{width:100px;text-align:center;}
.td_price{text-align:right;}
.sidx{padding:20px 0 30px;zoom:1;}
.sidx:after{display:block;visibility:hidden;clear:both;content:"";}
.sidx_anchor{position:absolute;margin:0;padding:0;width:1px;height:1px;font-size:0;line-height:0;overflow:hidden;}

#sidx_graph{position:relative;}
#sidx_graph_price{position:absolute;top:10px;left:20px;margin:0;padding:0;width:12%;list-style:none;}
#sidx_graph_price li{position:relative;padding:0 10% 0 0;height:48px;font-family:tahoma;text-align:right;}
#sidx_graph_price li span{position:absolute;top:7px;right:-10%;width:10px;height:1px;background:#e9e9e9;}
#sidx_graph_area{top:0;left:15%;margin:0;padding:0;width:100%;height:500px;border:1px solid #e9e9e9;list-style:none;}
#sidx_graph_area li{position:relative;float:left;padding:0 1% 0 0;width:14%;height:100%;}
#sidx_graph_area .graph{position:absolute;bottom:0;width:40%;height:0;}
#sidx_graph_area .order{background:#2c4fa3;left:30%;}
#sidx_graph_area .cancel{background:#ff8db6;right:7%;}
#sidx_graph_date{top:510px;left:15%;margin:0;padding:0;width:100%;border:1px solid #fff;list-style:none;}
#sidx_graph_date li{position:relative;float:left;width:14%;font-family:tahoma;text-align:center;}
#sidx_graph_date li span{position:absolute;top:-19px;right:0;width:1px;height:10px;background:#e9e9e9;}
#sidx_graph_legend{position:absolute;top:-25px;left:15%;}
#sidx_graph_legend span{display:inline-block;width:13px;height:13px;vertical-align:middle;}
#sidx_graph_legend #legend_order{background:#a0ca30;}
#sidx_graph_legend #legend_cancel{margin:0 0 0 10px;background:#ff8db6;}
#sidx_stat{float:right;width:32%;}
#sidx_stat h2{padding:0 20px 0 0;}
#sidx_stat .tbl_wrap{padding:0 20px 0 0;}
@media print{
.anchor{display:none!important;}
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