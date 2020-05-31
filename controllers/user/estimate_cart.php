<?php
	$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier');
if($param['no']){
	
	foreach($param['no'] as $no){
		$cartParam['user_no'] =$session['login'];
		$cartParam['amount'] =1;
		$cartParam['product_no'] =$no;
		$check = getItem('estimate_cart_products','status=0 AND product_no='.$no.' AND user_no='.$session['login']);
		if(!$check){
			insertItem('estimate_cart_products',$cartParam);
		}
	}
}
if($param['amount']){
$cartParam['amount'] =$param['amount'];
$cartParam['no'] =$param['no'];
updateItem('estimate_cart_products',$cartParam,$param['no']);
	exit;
	}
$carts = getListJoin('estimate_cart_products',array('LEFT','product_lists','estimate_cart_products.product_no=product_lists.no'),'estimate_cart_products.*,product_lists.details','status =0 AND estimate_cart_products.user_no='.$session['login']);
include 'views/header.html';

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
<main class="site-main site-login">

        <div class="box-center box-center-2">
		<h2 class="sub_title  ">견적바구니</h2>

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
                    <th>CATEGORY</th>
                    <th>DESCRIPTION</th>
            
                    <th>QUANTITY</th>
                    <th>성적서<br>
					써티 도면 테스트 소재
					</th>
                </tr>
                </thead>
                <tbody>
                <?php
					foreach($carts['list'] as $cart){
						$cart['details']=json_decode( $cart['details'],true);
						$cart['details']['package_type']=null;
						$cart['details']['delivery_type']=null;
						$cart['details']['Submit']=null;
					//	$cart['details']['product_type']=null;
						$cart['details']['has_data']=null;
				?>
                <tr>
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
                   
                    <td><input data-no="<?=$cart['no']?>" type="number"  style="width:80px;" name="amount" value="<?=$cart['amount']?>"></td>
					<td id="attaches">
						<a href="#" class="attach_icon"><i class="fa fa-file"></i></a>
						<a href="#" class="attach_icon"><i class="fa fa-file"></i></a>
						<a href="#" class="attach_icon"><i class="fa fa-file"></i></a>
						<a  href="#"class="attach_icon"><i class="fa fa-file"></i></a>

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


<table class="table table-bordered" style="width:800px;">
	
	<tr>
		
		<th style="width:140px;">
			희망운송 일정<br>
		(대금 입금일 기준 + 2day)

		</th>
		<td>
			<i class="fa fa-calendar"></i>
<input type="text" class="datepicker" style="width:100px;">

		</td>
		<th  style="width:140px;">
			
			사용 통화
		</th>
		<td>
			<select name="">
				
				<option value="">통화 선택</option>
				<option value="">
						KRW

				</option>
				<option value="">
						USD

				</option>
			</select>

		</td>
	</tr>
</table>

				



            <div class="clearfix">
                <a href="/user/estimate" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select">견적서 요청</a>
            </div>
        </div>
    </main>

	<script>
		
		$('[type="number"]').on('keydown keyup change paste',function(){
			var no  = $(this).data('no');
			var value = $(this).val();
			if(value<1){
				value=1;
				$(this).val(1);
				return false;
				
			}
			$.get('/user/estimate_cart?amount='+value+'&no='+no,function($data){
				
			})
		});
	</script>
	<style>
		#attaches a{
		margin-right: 18px;
		color: #2c4fa3;
	}
	#attaches a:first-child{
		margin-left: 5px;
	}

	</style>
	<?php
include 'views/footer.html';
?>