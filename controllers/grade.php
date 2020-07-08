<?php
	
	$products=getList('product_lists','',50);
	
 

//echo $차이->days; // 284

foreach($products['list'] as $product){
	$detail=jsonDecode($product['details']);


echo '<br>';
echo $product['no'].': '.getGrade($detail['scratch_y/n'],$detail['dent_y/n'],$detail['rust_y/n'],$detail['heat_no._and_product_certi._y/n'],$detail['manufactured_year'],$detail['country']);

}

echo getGrade('y','y','y','y','2015-05-05','korea');
	
	
?>