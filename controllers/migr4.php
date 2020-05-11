<?php
	$data =addSlashes('1/8"			6
1/4"			8
3/8"			10
1/2"			15
3/4"			20
1"			25
1 1/4"			32
1 1/2"			40
2"			50
2 1/2"			65
3"			80
3 1/2"			90
4"			100
5"			125
6"			150
8"			200
10"			250
12"			300
14"			350
16"			400
18"			450
22"			550
24"			600
26"			650
28"			700
30"			750
32"			800
34"			850
36"			900
38"			950
40"			1000
42"			1050
44"			1100
48"			1200
52"			1300
56"			1400
60"			1500
64"			1600
68"			1700
72"			1800
76"			1900
80"			2000



');
$data= explode('
',$data);


foreach($data as $key=>$value){

	$value=explode('			',$value);

	
	$name = $value[0];
	$param['name']= $name;
	if($name==''){
		continue;
	}
	$param['additional_info']= $value[1];
	$param['next_category_group']='size';
	$param['category_group']='manufacturer';
	$param['product_type']='flange';
	echo $name;
	br();
	insertItem('product_categories',$param);
//	$item = getItem('hamzzi_stocks','product_code="'.$name.'"');

	
	//updateItem('hamzzi_stocks,viewQuery',$param,'product_code="'.$name.'"');
}
?>