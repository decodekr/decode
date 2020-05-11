<?php

/*$estimateCarts=getListJoin(
'estimate_cart_products,viewQuery',
$join,
'estimate_cart_products.*,product_lists.user_no AS product_user_no,product_lists.details,product_lists.delivery_date,product_lists.price as product_price,cart_user.name AS user_name',
'product_lists.user_no='.$session['login']);*/

	include'views/header.html';
?>

<style>
	#public_tab{

	margin:10px;
	margin-bottom: 40px;
	
}
#public_tab:after{
display: block;
content:'';
clear: both;
}
#public_tab>li {
position: relative;
	float:left;
	list-style: none;
	margin-right:1px;
}
#public_tab>li>a{
	display:block;
	width:120px;
	height:40px;
	line-height:40px;
	font-size:19px;
	background:#e3e3e3;
	color:#171717;
	font-size:17px;
	text-align:center;
	text-decoration:none;
}
#public_tab>li.active>a{
	background:#2c4fa3;
	color:#fff;
}
#tab_sub{
position: absolute;
top: 47px;
padding: 0;
left: 0;
width: 1000px;

overflow: hidden;
margin-bottom: 25px;
}
#tab_sub li{
	float: left;
	list-style: none;
	padding: 0 5px;
	margin-left: 10px;
	height: 24px;
	line-height: 24px;
	font-size:15px;
	border-right: 1px solid #ddd;
}
#tab_sub li:last-child{
border-right: 0;
}

#seller_notice{
	float: left;
	width: 45%;
}
#sller_status{
	width: 45%;
	float: left;
	margin-left: 5%;
}
	
</style>
<main class="site-main site-login min-height" style="padding:60px 0;">
 <div class="container">
<?php
	include'views/seller_tab.html';
?>
	
	
	<div id="seller_notice">
	<h3>
		Q&amp;A

	</h3>

	<?php
	$notices=getList('board_seller_notice');
	?>
		<table class="table">
			<tr>
				<th>
					
					No.
				</th>
				<th>
					제목

				</th>
				<th>
					등록일
			
				</th>

			</tr>
			<?php
				foreach($notices['list'] as $notice){
			?>
			<tr>
				<td>
					
<?=$notice['no']?>
				</td>
				<td>
					
<a href="/board/seller_notice/view/no/<?=$notice['no']?>">사전 질문입니다</a>
				</td>
				<td>
					
<?=$notice['create_date']?>
				</td>

			</tr>
			<?php
			}	
			?>
			

		</table>

	</div>

	<div id="sller_status">
	<h3>
		FAQ

	</h3>
	<?php
	$order1=getTotal('estimate_orders','status=0');
	$order2=getTotal('estimate_orders','status>0 AND status<7');
	$order3=getTotal('estimate_orders','status=10');
	?>
			<table class="table">
			<tr>
				<th>
					
					No.
				</th>
				<th>
					제목

				</th>
				<th>
					등록일
			
				</th>

			</tr>
			<?php
				foreach($notices['list'] as $notice){
			?>
			<tr>
				<td>
					
<?=$notice['no']?>
				</td>
				<td>
					
<a href="/board/seller_notice/view/no/<?=$notice['no']?>">자주묻는 질문 1</a>
				</td>
				<td>
					
<?=$notice['create_date']?>
				</td>

			</tr>
			<?php
			}	
			?>
			

		</table>

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
		margin-left: -400px;
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
</style>

<script>
	$('.close_button').click(function(){
		$('#order_detail_layer,#fog').fadeOut();
		return false;
	});
	$('#order_list tbody tr').click(function(){
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