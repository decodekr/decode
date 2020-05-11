<?php

ini_set('memory_limit','-1');

if(count($_FILES['images'])>0){
	$images=uploadFile($_FILES['images'],'/files');
	


foreach($images as $image){
	$imageParam['product_id']= substr($image['name'],0,12);
	$imageParam['path']= $image['path'];
	$imageParam['name']= $image['name'];
	insertItem('files',$imageParam);
	
}
printMessage('이미지를 성공적으로 업로드 했습니다.','/seller/product/add');
exit;
}

$cnt['pipe']=0;
$cnt['fitting']=0;
$cnt['flange']=0;
$cnt['valve']=0;


if($_FILES['excel']['name']){
	$total=getTotal('product_lists','create_date like "%'.date('Y-m-d').'%"')+1;

	$file=uploadFile($_FILES['excel'],'/files');
	include'models/PHPExcel.php';
	$filepath = "files/".$file['path'];
	$filetype = PHPExcel_IOFactory::identify($filepath);
	$reader = PHPExcel_IOFactory::createReader($filetype);
	$php_excel = $reader->load($filepath);
	 $worksheets = $php_excel->getSheetNames();
	
	

	$target = "A"."1".":"."$maxColumn"."$maxRow";
	foreach($worksheets as $sheetIndex=>$worksheet){ 
		$sheet = $php_excel->getSheet($sheetIndex);           // 첫번째 시트
		$maxRow = $sheet->getHighestRow();          // 마지막 라인
		$maxColumn = $sheet->getHighestColumn();    // 마지막 칼럼
		for ($row = 2; $row <= $maxRow; $row++){ 
			//  Read a row of data into an array
			
			
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $maxColumn . $row,
											NULL,
											TRUE,	   FALSE);
	
			$data=array();
	
			if($row==2){
				$titleRow=$rowData;
				
			}
			else{
				
				foreach($rowData[0] as $index=>$rowItem){
					
					if($titleRow[0][$index]!=''){
						$data[str_replace(' ','_',strtolower($titleRow[0][$index]) )]=$rowItem;
					}
				}

				
				
				$productParam['product_id']=date('Ymd').str_pad($total,4,'0',STR_PAD_LEFT);
		
				$productParam['details']=jsonEncode($data);
				$productParam['category']=strtolower($worksheet);
				$productParam['price']=$data['unit_price'];
				$productParam['amount']=$data['quantity'];
				$productParam['user_no']=$session['login'];
				$productParam['delivery_type']=$data['delivery_type'];
				$productParam['delivery_date']=$data['available_delivery_date'];
				$productParam['package_type']=$data['package_type'];
		
				
			//	if($productParam['price']&&$productParam['amount']){
					$total++;
					insertItem('product_lists',$productParam);
					$cnt[strtolower($worksheet)]++;
				//}
			}

		}
	}

printMessage('제품을 성공적으로 업로드 했습니다.','/seller/product/add');

}

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
	
    
	<style>
		#order_list td{
		padding: 10px;
		}

	</style>
	<table class="table" id="order_list">
			<tr>
			
				<td colspan="2">
					<a href="/sample.xlsx">
						
						<i class="fa fa-file-excel-o"></i> 양식 엑셀시트 다운로드
					</a>
<br>
<br>
					<div class="alert alert-info" role="alert">
엑셀파일은 XLS( Excel 97 - 2003 통합 문서 ) 또는 XLSX 통합문서만 가능합니다.<br><b>Excel 데이터를 기준으로 재고와 가격이 입력되지 않은 행은 등록되지 않습니다.</b><br><br>엑셀에 서식 또는 틀고정 등이 포함되어 있을 경우 정상적으로 처리되지 않을 수 있으니, 각 셀 값은 텍스트(TEXT)형식으로만 작성하여야 합니다.<br>등록 대상 데이터가 시작되는 행번호는 3행입니다.</div>



				</td>
			</tr>
			<tr>
			<th>
				
				엑셀 상품 등록
			</th>
				<td>
					<form action="" method="post" enctype="multipart/form-data" id="excel_upload">
						
						<input type="file" name="excel">
					</form>
						
						
				


				</td>
			</tr>
			<tr>
				<td  colspan="2">
					
					<div class="alert alert-warning" role="alert">

상품 이미지 명을 상품 번호와 일치시켜서 올려주세요.<br>
<b>예를들어 상품 번호가 20150505001이면 20150505001_test.jpg 와 같이 맞추면 됩니다.</b>
</div>

				</td>

			</tr>
			<tr>
				<th>
					상품 이미지 등록

				</th>
				<td>
					<form action="" method="post" enctype="multipart/form-data" id="image_upload">
							<input type="file"  name="images[]" multiple>
				
					</form>
					



				</td>

			</tr>

	</table>

 </div>
</main>

<script>
	$('#excel_upload').change(function(){
	
		$('#excel_upload').submit();

});
	$('#image_upload [name="images[]"]').change(function(){
	
		$('#image_upload').submit();

});

</script>




<?php
	include'views/footer.html';
?>