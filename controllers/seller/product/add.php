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
	$columnMax=array('X'
,'AC'
,'Y'
,'AB');

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
		if($sheetIndex==4){
		break;
		}
		$sheet = $php_excel->getSheet($sheetIndex);           // 첫번째 시트
		$maxRow = $sheet->getHighestRow();          // 마지막 라인
		$maxColumn = $columnMax[$sheetIndex];//$sheet->getHighestColumn();    // 마지막 칼럼


		for ($row = 2; $row <= $maxRow; $row++){ 
			//  Read a row of data into an array
			
			
			
			// print_x($rowData);
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
						if($rowItem==''){
							$prevTitle=  $titleRow[0][$index-1];
							
							if($sheetIndex==0){
								$sheetName='pipe';
							}
							if($sheetIndex==1){
								$sheetName='fitting';
							}
							if($sheetIndex==2){
								$sheetName='flange';
							}
							if($sheetIndex==3){
								$sheetName='valve';
							}
							if(strtolower($prevValue)=='ball valve'){
							
							}
							if(strtolower($prevValue)!='seamless'){
							
							//	printMessage('엑셀 업로드 실패 : '.$sheetName.'시트 '.$row.'열 '.$titleRow[0][$index].' 값이 입력되지 않았습니다.','/seller/product/add');
							//		exit;
							}
						
						}
						if($rowItem==''&&($titleRow[0][$index]=='SCRATCH Y/N'||$titleRow[0][$index]=='RUST Y/N'||$titleRow[0][$index]=='DENT Y/N'||$titleRow[0][$index]=='HEAT NO. AND PRODUCT CERTI. Y/N'||$titleRow[0][$index]=='MANUFACTURED YEAR'||$titleRow[0][$index]=='COUNTRY')){
							printMessage('엑셀 업로드 실패 : '.$sheetName.'시트 '.$row.'열 '.$titleRow[0][$index].' 값은 필수로 입력해야 합니다.','/seller/product/add');
						}
						$data[str_replace(' ','_',strtolower($titleRow[0][$index]) )]=strtoupper(str_replace('"','inch',$rowItem));
					}
					else{
						
					}
					$prevValue=  $rowItem;
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
				$productParam['grade']='B'/*getGrade(
				$productParam['details']['scratch_y/n'],
				$productParam['details']['dent_y/n'],
				$productParam['details']['rust_y/n'],
				$productParam['details']['heat_no._and_product_certi._y/n'],
				$productParam['details']['manufactured_date'],
				$productParam['details']['country'])*/;
		
				
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
엑셀파일은 XLS( Excel 97 - 2003 통합 문서 ) 또는 XLSX 통합문서만 가능합니다.<br>

   **Excel 데이터를 기준으로 재고와 가격이 입력되지 않은 자재는 사이트에 바로 노출되지 않고,** <br>

   **별도 관리됩니다. 해당 자재는 수요자가 있을 경우 가격 및 관련 정보를 별도로 요청 드립니다.**<br>

   엑셀에 서식 또는 틀고정 등이 포함되어 있을 경우 정상적으로 처리되지 않을 수 있으니, <br>

   각 셀 값은 텍스트(TEXT)형식으로만 작성하여야 합니다.<br>

   등록 대상 데이터가 시작되는 행번호는 3행입니다.

</div>



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