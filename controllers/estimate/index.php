<?php
$user=getItem('users',$session['login']);
include 'views/header.html'
?>
<?php
	if(!$user['virtual_account_number']){
?>
	<script>
		Swal.fire({
		  title: '사용자 추가 정보 입력이 필요합니다.',
	
		  icon: 'warning',
			 html:"구매자님의 사업자 정보를 입력 하시면, 견적 요청 및 구매 진행이 가능합니다. <br>  사업자 정보를 입력하시겠습니까?",
		width:700,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: '예',
		  cancelButtonText: '아니오'
		}).then((result) => {
		  if (result.value) {
			
				location.href='/user/mypage?type=buyer'
		  }
			else{
			history.back(-1);
			}
			
		})
	</script>
<?php
}	
?>
<main class="site-main site-login min-height" style="padding:60px 0;">
 <div class="container">

	<h3><strong style="color:#2c4fa3;">MOM의 엑셀 양식</strong>에 구입하실 자재의 상세 정보 및 관련 정보를 입력해 주시면, MOM이 찾아보겠습니다. 
</h3>
	<table class="table" id="order_list" style="margin-top:50px;">
			<tbody><tr>
			
				<td colspan="2">
					<a href="/sample.xlsx">
						
						<i class="fa fa-file-excel-o"></i> MOM 엑셀시트 다운받기
					</a>
<br>
<br>
					


				</td>
			</tr>
			<tr>
		
				<td>
					<form action="" method="post" enctype="multipart/form-data" id="excel_upload">
						
						<input type="file" name="excel">
					</form>
						
						
				


				</td>
			</tr>
			<tr>
				

			</tr>


	</tbody></table>
	<div class="row">
		<div class="col-md-4">
			<h4>상세정보 입력</h4>
			<p>정확한 견적을 위해 상세 정보를 입력해 주세요.</p>

		</div>
		<div class="col-md-6">
			<table class="table-bordered table">
				<tr>
					<th>
						대금 지급 일정

					</th>
					<td>
						
						<input type="text">
					</td>

				</tr>
				<tr>
					<th>
						희망 운송 일정

					</th>
					<td>
						
						<input type="text" class="datepicker">
					</td>

				</tr>
				<tr>
					<th>
						대금 지급 통화

					</th>
					<td>
						
						<select name="" id="" style="padding:8px;">
							<option value="">KRW</option>
							<option value="">USD</option>

						</select>
					</td>

				</tr>

			</table>

		</div>
		<div class="col-md-12">
			<h4>재고품 진행 가능 여부</h4>
			<label for=""><input type="checkbox" id="stock"> 재고품으로 거래 진행해도 괜찮습니다.</label>&nbsp;&nbsp;&nbsp;
			<label for=""><input type="checkbox"> 신규 제조한 자재의 거래만 가능합니다.</label>

			<div style="display:none;" id="allow_year">
				허용 가능한 제조연도는             <input type="text" style="width:60px;"> 년 이후           이후 제조품입니다.


			</div>
		
		</div>
		

	</div>
	

 </div>
</main><script>
$('#stock').click(function(){
	$('#allow_year').fadeIn();	
 });

</script>
<?php
include 'views/footer.html'
?>