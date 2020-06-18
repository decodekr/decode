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
if($param['delete']){
	
	jsonMessage(1,'삭제 완료');
	deleteItem('estimate_cart_products','no in ('.$param['delete'].')');
	exit;
}
if($param['amount']){
$cartParam['amount'] =$param['amount'];
$cartParam['no'] =$param['no'];
updateItem('estimate_cart_products',$cartParam,$param['no']);
	exit;
	}
$carts = getListJoin('estimate_cart_products',array('LEFT','product_lists','estimate_cart_products.product_no=product_lists.no'),'estimate_cart_products.*,product_lists.details','status =0 AND estimate_cart_products.user_no='.$session['login'].' AND product_lists.details!=""');
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
					<th><input type="checkbox" id="check_all"></th>
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
                <tr>
					<td>
						<input type="checkbox" class="checkbox" data-no="<?=$cart['no']?>">

					</td>
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
	

		</th>
		<td>
			<i class="fa fa-calendar"></i>
<input type="text" class="datepicker" name="wish_date" style="width:150px;">

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

				
<style>
.btn-list-select2{
	position: relative;
    cursor: pointer;
    display: block;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    /* color: #323a46; */
    /* background-color: #f1f5f7; */
    padding: 5px 10px;
	margin-left: 10px;
    font-size: 14px;
    border-radius: 3px;
}
</style>


            <div class="clearfix">
                <a href="#" class="float-right btn btn-danger btn-xs waves-effect waves-light btn-list-select2" id="selected_delete">선택 삭제</a>
                <a href="#" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select" id="estimate_request">견적서 요청</a>
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

			$('#estimate_request').click(function(){
				if($('[name="wish_date"]').val()==''){
				alert('희망 운송 일정을 입력해주세요.');
				return false;
				}
				location.href='/user/estimate?wish_date='+$('[name="wish_date"]').val();
				return false;
			});

		$('#selected_delete').on('click',function(){
			var no  ='';
			$('.checkbox:checked').each(function(){
				if(no!=''){
					no+=',';
				}
				no+=$(this).data('no');
			});
			if(no==''){
				alert('삭제할 항목을 선택해주세요.');
				return false;
			}
			$.get('/user/estimate_cart?delete='+no,function($data){
				location.reload();
			})
				return false;
		});

			$('#check_all').click(function(){
				var checked =  $(this).prop('checked');
				$('.search-list-table input[type="checkbox"]').prop({checked:checked});
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