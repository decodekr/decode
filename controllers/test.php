<?php
	require_once 'models/PHPExcel/IOFactory.php';
	require_once 'models/PHPExcel/Writer/Excel2007.php';
	include'models/PHPExcel.php';


	$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
	$excel2 = $excel2->load('estimate.xlsx'); // Empty Sheet
	$excel2->setActiveSheetIndex(0);
	$excel2->getActiveSheet()->setCellValue('C6', '4')
		->setCellValue('C7', '5')
		->setCellValue('C8', '6')       
		->setCellValue('D10', 'test')       
		->setCellValue('C9', '7');

		$excel2->getActiveSheet()->insertNewRowBefore(36,3); 

		
	
	$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
	$objWriter->save('Nimit New.xlsx');
	?>