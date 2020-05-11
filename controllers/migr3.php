<?php
	$data=getList('hamzzi_stocks');
	$param['note'] ='초기 수량';
	foreach($data['list'] as $item){
		$param['amount'] = $item['stock'];
		$param['stock_no'] = $item['no'];
		insertItem('hamzzi_stock_histories',$param);
	}
?>