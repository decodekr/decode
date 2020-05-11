<?php
	include'models/PHPExcel.php';
$filepath = "test.xlsx";
$filetype = PHPExcel_IOFactory::identify($filepath);
$reader = PHPExcel_IOFactory::createReader($filetype);
$php_excel = $reader->load($filepath);

$sheet = $php_excel->getSheet(0);           // 첫번째 시트
$maxRow = $sheet->getHighestRow();          // 마지막 라인
$maxColumn = $sheet->getHighestColumn();    // 마지막 칼럼

$target = "A"."1".":"."$maxColumn"."$maxRow";

for ($row = 2; $row <= $maxRow; $row++){ 
    //  Read a row of data into an array

    $rowData = $sheet->rangeToArray('A' . $row . ':' . $maxColumn . $row,
                                    NULL,
                                    TRUE,
						           FALSE);
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
		print_x($data);
		$productParam['details']=jsonEncode($data);
		$productParam['category']='pipe';
		$productParam['price']=$data['unit_price'];
		$productParam['amount']=$data['quantity'];
	}

}


?>