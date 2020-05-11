<?php

	for($iu=0;$iu<100;$iu++){
	$type='fitting';

$productParam['price']=rand(100,500)* 1000;
$productParam['delivery_type']='직접';
$productParam['package_type']='직접';
$productParam['user_no']=6;
$productParam['category']='fitting';;

$detailParam['product_type']='fitting';

$detailParam['fitting']=getItem('product_categories','category_group="fitting" AND product_type="fitting"','rand()');


$detailParam['pressure_rating']=getItem('product_categories','category_group="pressure_rating" AND product_type="fitting"','rand()');
$detailParam['size']=getItem('product_categories','category_group="size" AND product_type="fitting"','rand()');
$detailParam['material_grade']=getItem('product_categories','category_group="material_grade" AND product_type="fitting"','rand()');
$detailParam['manufacturer']=getItem('product_categories','category_group="manufacturer" AND product_type="fitting"','rand()');
$detailParam['seat_material']=getItem('product_categories','category_group="seat_material" AND product_type="fitting"','rand()');


$detailParam['fitting']=$detailParam['fitting']['name'];


if($detailParam['fitting']=='ELBOW'){
	$detailParam['type_for_elbow']=getItem('product_categories','category_group="type_for_elbow" AND product_type="fitting"','rand()');
	$detailParam['type_for_elbow']=$detailParam['type_for_elbow']['name'];


}
if($detailParam['fitting']=='REDUCER'){
	$detailParam['type_for_reducer']=getItem('product_categories','category_group="type_for_reducer" AND product_type="fitting"','rand()');
	$detailParam['type_for_reducer']=$detailParam['type_for_reducer']['name'];


}
if($detailParam['fitting']=='TEE'){
	$detailParam['type_for_tee']=getItem('product_categories','category_group="type_for_tee" AND product_type="fitting"','rand()');
	$detailParam['type_for_tee']=$detailParam['type_for_tee']['name'];


}

$detailParam['pressure_rating']=$detailParam['pressure_rating']['name'];

$detailParam['size']=addslashes($detailParam['size']['name']);
$detailParam['material_grade']=$detailParam['material_grade']['name'];
$detailParam['manufacturer']=$detailParam['manufacturer']['name'];
$detailParam['seat_material']=$detailParam['seat_material']['name'];
$detailParam['trim_material']=$detailParam['trim_material']['name'];
$detailParam['end_connection']=$detailParam['end_connection']['name'];
$detailParam['bonnet']=$detailParam['bonnet']['name'];
$detailParam['operating_type']=$detailParam['operating_type']['name'];



$productParam['details']= jsonEncode($detailParam);


insertItem('product_lists',$productParam);

	}

exit;
	for($iu=0;$iu<50000;$iu++){
	$type='valve';

$productParam['price']=rand(100,500)* 1000;
$productParam['delivery_type']='직접';
$productParam['package_type']='직접';
$productParam['user_no']=6;
$productParam['category']='valve';;

$detailParam['product_type']='valve';

$detailParam['valve']=getItem('product_categories','category_group="valve" AND product_type="valve"','rand()');


$detailParam['pressure_rating']=getItem('product_categories','category_group="pressure_rating" AND product_type="valve"','rand()');
$detailParam['size']=getItem('product_categories','category_group="size" AND product_type="valve"','rand()');
$detailParam['material_grade']=getItem('product_categories','category_group="material_grade" AND product_type="valve"','rand()');
$detailParam['manufacturer']=getItem('product_categories','category_group="manufacturer" AND product_type="valve"','rand()');
$detailParam['seat_material']=getItem('product_categories','category_group="seat_material" AND product_type="valve"','rand()');

$detailParam['trim_material']=getItem('product_categories','category_group="trim_material" AND product_type="valve"','rand()');
$detailParam['end_connection']=getItem('product_categories','category_group="end_connection" AND product_type="valve"','rand()');
$detailParam['bonnet']=getItem('product_categories','category_group="bonnet" AND product_type="valve"','rand()');
$detailParam['operating_type']=getItem('product_categories','category_group="operating_type" AND product_type="valve"','rand()');


$detailParam['valve']=$detailParam['valve']['name'];

if($detailParam['valve']=='Ball valve'){
	$detailParam['type_for_ball_valve']=getItem('product_categories','category_group="type_for_ball_valve" AND product_type="valve"','rand()');
	$detailParam['type_for_ball_valve']=$detailParam['type_for_ball_valve']['name'];
	$detailParam['bore_for_ball_valve']=getItem('product_categories','category_group="bore_for_ball_valve" AND product_type="valve"','rand()');
	$detailParam['bore_for_ball_valve']=$detailParam['bore_for_ball_valve']['name'];

}
if($detailParam['valve']=='Check valve'){
	$detailParam['type_for_check_valve']=getItem('product_categories','category_group="type_for_check_valve" AND product_type="valve"','rand()');
	$detailParam['type_for_check_valve']=$detailParam['type_for_check_valve']['name'];


}
if($detailParam['valve']=='Butterfly Valve'){
	$detailParam['type_for_butterfly_valve']=getItem('product_categories','category_group="type_for_butterfly_valve" AND product_type="valve"','rand()');
	$detailParam['type_for_butterfly_valve']=$detailParam['type_for_butterfly_valve']['name'];


}
if($detailParam['valve']=='MOV (Motor Operated Valve)'){
	$detailParam['type_for_mo_valve']=getItem('product_categories','category_group="type_for_mo_valve" AND product_type="valve"','rand()');
	$detailParam['type_for_mo_valve']=$detailParam['type_for_mo_valve']['name'];


}
if($detailParam['valve']=='Cylinder Operated Valve'){
	$detailParam['type_for_cylinder_operated_valve']=getItem('product_categories','category_group="type_for_cylinder_operated_valve" AND product_type="valve"','rand()');
	$detailParam['type_for_cylinder_operated_valve']=$detailParam['type_for_cylinder_operated_valve']['name'];


}
$detailParam['pressure_rating']=$detailParam['pressure_rating']['name'];

$detailParam['size']=addslashes($detailParam['size']['name']);
$detailParam['material_grade']=$detailParam['material_grade']['name'];
$detailParam['manufacturer']=$detailParam['manufacturer']['name'];
$detailParam['seat_material']=$detailParam['seat_material']['name'];
$detailParam['trim_material']=$detailParam['trim_material']['name'];
$detailParam['end_connection']=$detailParam['end_connection']['name'];
$detailParam['bonnet']=$detailParam['bonnet']['name'];
$detailParam['operating_type']=$detailParam['operating_type']['name'];



$productParam['details']= jsonEncode($detailParam);


insertItem('product_lists',$productParam);

	}
/*
	getParams($type,array());
	function getParams($type,$array){
		
		$item=getItem(' product_categories','category_group = "'.$type.'"','rand()');
		if($item){
			return getParams($item['next_category_group'],array());
		}
		else{
			return $array;
		}
		
	}*/
exit;
	for($iu=0;$iu<500;$iu++){
	$type='pipe';

$productParam['price']=rand(100,500)* 1000;
$productParam['delivery_type']='직접';
$productParam['package_type']='직접';
$productParam['user_no']=6;
$productParam['category']='pipe';;

$detailParam['product_type']='pipe';

$detailParam['pipe']=getItem('product_categories','category_group="pipe" AND product_type="pipe"','rand()');
$detailParam['pipe_type']=getItem('product_categories','category_group="pipe_type" AND product_type="pipe"','rand()');
$detailParam['size']=getItem('product_categories','category_group="size" AND product_type="pipe"','rand()');
$detailParam['material_grade']=getItem('product_categories','category_group="material_grade" AND product_type="pipe"','rand()');
$detailParam['manufacturer']=getItem('product_categories','category_group="manufacturer" AND product_type="pipe"','rand()');


$detailParam['pipe']=$detailParam['pipe']['name'];
$detailParam['pipe_type']=$detailParam['pipe_type']['name'];

$detailParam['size']=addslashes($detailParam['size']['name']);
$detailParam['material_grade']=$detailParam['material_grade']['name'];
$detailParam['manufacturer']=$detailParam['manufacturer']['name'];


$productParam['details']= jsonEncode($detailParam);


insertItem('product_lists',$productParam);

	}
/*
	getParams($type,array());
	function getParams($type,$array){
		
		$item=getItem(' product_categories','category_group = "'.$type.'"','rand()');
		if($item){
			return getParams($item['next_category_group'],array());
		}
		else{
			return $array;
		}
		
	}*/
?>