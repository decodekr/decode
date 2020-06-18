<?php
	
	ini_set('memory_limit',-1);
	$sameWords=array();
	$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier');
	
	function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
	function checkMatching($keyword,$detail){
		
	}
	function samewords($word){
		
		$sameword=getItem('samewords','input_word like "%'.$word.'%"');

		

	

		return $sameword['result_words'];


	}
if($param['mode']=='product_list'){

	if($param['category']==''){
		exit;
	}
	$where=  '';;
	$select = '';
	
	
	//키워드 보정
	
	
	
	if($param['keyword']){
		$where.=' (';

		//컴마와 공백으로 쪼갠다.

		$param['keyword'] =  str_replace('\"','inch',$param['keyword']);
		$param['keyword'] =  str_replace('인치','inch',$param['keyword']);
		$param['keyword'] =  str_replace('#','lb',$param['keyword']);
		$param['keyword'] =  str_replace('pound','lb',$param['keyword']);
		$param['keyword'] = multiexplode(array(','),$param['keyword']);
		$param['keyword']=array_filter($param['keyword']);
		
		$keywords='';
		foreach($param['keyword'] as $keyword){
			if($keywords!=''){
				$keywords.=',';
			}
			//$keywords.=samewords($keyword);
			$keyword=trim($keyword);
			if(strpos($keyword,'inch')!==FALSE){
				$keyword = '"'.$keyword.'';
				
			}
			$keywords.=trim($keyword);
			
			
			
		}		

	

		$keywords = explode(',',$keywords);
		

		foreach($keywords as $index=>$keyword){
			if(trim($keyword)==''){
				continue;
			}
			if($index!=0){
				
				$select.=' + ';
			}
			if(strpos(sameWords($keyword),'|')!==FALSE){
				$samekeywords=explode('|',sameWords($keyword));
				$cond='';
				foreach($samekeywords as $keyword){
					array_push($sameWords,$keyword);
					if($cond!=''){
						$cond.=' OR ';
					
					}
					$cond.="details like '%".($keyword)."%'";
				}
				if($index!=0){
					$where.=' OR ';
				
				}
				$where.='('.$cond.')';

			}
			else{
				if($index!=0){
					$where.=' OR ';
				
				}
				
				if(strpos($keyword,'inch')!==FALSE){
					//$keyword = '"'.$keyword.'"';
				}
				$where.="details like '%".($keyword)."%'";
				$cond="details like '%".($keyword)."%'";
			}
		
			$select.="case when ".$cond." then 1 else 0 end";
		}
			$where.=')';
	}






//echo $where;
		/*
	select *
      ,((case when details like '%KTT%' then 1 else 0 end) +
      (case when details like '%삼한%' then 1 else 0 end) +
      (case when details like '%PIPE%' then 1 else 0 end) ) as priority
  from product_lists
 where details like '%KTT%'
    or details like '%삼한%'
    or details like '%PIPE%'
 order by priority desc
*/
	$keywordLen = count($param['keyword']);

	if($param['category']){
		if($where!=''){
			$where.=' AND ';
		}
		$where.='category like "%'.$param['category'].'%"';
	}
/*	if($param['details']){
		foreach($param['details'] as $detail){
			if($where!=''){
				$where.=' OR ';
			}
			$where.='details like "%'.$detail.'%"';
		}
	}*/
	$param['product_type'] =$param['category'];
	
	if($select!=''){
		$order='match_rate desc';
	$select = '*,('.$select.')/'.$keywordLen.' AS match_rate';
	}
	else{
	$order='';
	}




$products=pageListSelect('product_lists',$where,$order,10,10,$param['page'],'$page',$select);





/*
if($keywordLen>0&&$param['keyword']!=''){
foreach($products['list'] as $index=>$product){
	$match=0;
	foreach($param['keyword'] as $keyword){

		if(trim($keyword)!=''){

			if(strpos($product['details'],$keyword)!==FALSE |strpos($product['details'],strtolower($keyword))!==FALSE|strpos($product['details'],strtoupper($keyword))!==FALSE){
				$match++;
			}
		}
	}

	$matchRate = $match/$keywordLen;
	$products['list'][$index]['match_rate'] = $matchRate;
}

$matchRates=array();

foreach ($products['list'] as $key => $product)
{
    $matchRates[$key] = $product['match_rate'];
}
array_multisort($matchRates, SORT_DESC, $products['list']);
}
*/



if($keywords[0]!=''){

$strongKeywords=array();
$strongKeywordsSame=array();



foreach($sameWords as $keywordIndex=>$keyword){

	$strongKeywordsSame[$keywordIndex] = '<strong style=\'color:#2c4fa3\'>'.$keyword.'</strong>';
}


foreach($keywords as $keywordIndex=>$keyword){
	if(strpos($keyword,'inch')!==FALSE){
	$strongKeywords[$keywordIndex] = '"<strong style=\'color:#EE4123\'>'.strtoupper(str_replace('"','',$keyword)).'</strong>';
	}
	else{
	
	$strongKeywords[$keywordIndex] = '<strong style=\'color:#EE4123\'>'.strtoupper($keyword).'</strong>';
	}
	
}

foreach($products['list'] as $productIndex=>$product){
	$products['list'][$productIndex]['details']=str_ireplace($sameWords,$strongKeywordsSame,$products['list'][$productIndex]['details']);
}
foreach($products['list'] as $productIndex=>$product){

	$products['list'][$productIndex]['details']=str_ireplace($keywords,$strongKeywords,$products['list'][$productIndex]['details']);
}






}


//print_x($products['list']);




?>









				<?php
		if($param['category']=='pipe'){


					if($products['length']>0){
				$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
            <table class="search-list-table" >
                <thead>
               <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
					  <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
					<th>category</th>
					<th>seamless/welded</th>
					<th>welding_type</th>
					<th>material_grade</th>
					<th>zinc/galva</th>
					<th>size1</th>
					<th>sch1</th>
					<th>end</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                 <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					
					if($detail==''){
						echo '<td  data-category="'.$title.'">-</td>';
					}else{

				?>
				<td data-category="<?=$title?>"><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}
				}
			?>


				<?php
		if($param['category']=='valve'){
						if($products['length']>0){
							$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
            <table class="search-list-table" >
              <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
                                     	   <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
                                     	  <th>category</th>
					<th>item</th>
					<th>forged/casting</th>
					<th>type</th>
					<th>bore</th>
					<th>operating_type</th>
					<th>material_grade</th>
					<th>trim_material</th>
					<th>seat_material</th>
					<th>size1</th>
					<th>pressure_rating</th>
					<th>end</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>drawing_y/n</th>
					<th>pressure_test_report_y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                   <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					if($detail==''){
						echo '<td data-cate="'.$title.'">-</td>';
					}else{

				?>
				<td data-cate="<?=$title?>"><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}	
				}
			?>




						<?php
		if($param['category']=='fitting'){
								if($products['length']>0){
							$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
             <table class="search-list-table" >
               <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
					  <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
                                     	  <th>category</th>
					<th>item</th>
					<th>forged/pipe</th>
					<th>type</th>
					<th>material</th>
					<th>nace_y/n</th>
					<th>size1</th>
					<th>size2</th>
					<th>size3</th>
					<th>schedule_1</th>
					<th>schedule_2</th>
					<th>pressure__rating</th>
					<th>end1</th>
					<th>end2</th>
					<th>end3</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                   <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					if($detail==''){
						echo '<td>-</td>';
					}else{

				?>
				<td><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}	
						}
			?>

				
						<?php

		if($param['category']=='flange'){
								if($products['length']>0){
									$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
               <table class="search-list-table" >
               <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
					  <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
                                     	  <th>category</th>
					<th>type1</th>
					<th>reducing_y/n</th>
					<th>material</th>
					<th>size1</th>
					<th>size2</th>
					<th>sch1</th>
					<th>pressure</th>
					<th>end1</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>raw_material_certi._y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                   <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					if($detail==''){
						echo '<td data-cate="'.$title.'">-</td>';
					}else{

				?>
				<td><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}	
						}
			?>
				 <div id="pagination_wrap">
					<div class="pagination">
						<?=$products['pagination']?>
				</div>

				</div>
				
				
			
	<?php
				exit;
}
	include'views/header.html';
?>
<style type="text/css">

.search-list-table thead th, .search-list-table tbody td{
	width: 80px;;
	height: 46px;
}

#wrapper {
opacity:0;
	position: absolute;
	z-index: 1;
	top: 65px;
	bottom: 48px;
	left: 0;
	height:650px;
	width: 100%;

	overflow: hidden;
}

#scroller {
	position: absolute;
	z-index: 1;
	-webkit-tap-highlight-color: rgba(0,0,0,0);
	width: 2700px;
	height: 100%;

	-webkit-transform: translateZ(0);
	-moz-transform: translateZ(0);
	-ms-transform: translateZ(0);
	-o-transform: translateZ(0);
	transform: translateZ(0);
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-text-size-adjust: none;
	-moz-text-size-adjust: none;
	-ms-text-size-adjust: none;
	-o-text-size-adjust: none;
	text-size-adjust: none;
}



</style>
<style>
#search_wrap{
padding: 40px 0;
}
	#search_left{
	float: left;
	position: relative;

	width: 330px;
}
	#search_right{
	width: 900px;
	height: 800px;
	float: right;
	margin-left: 30px;
}
.block-search{
	margin: 10px;
	width: auto;
}
.form-search .form-control{
border: 0;
width: 786px;
}
.block-search .block-content{
text-align: left;
}
.filter-options .filter-options-title{
	
}
.filter-options-content .label{
margin-right: 10px;
}
#additional_category label{
	display: block;
	width: 50%;
	float: left;
	height: 30px;
}
</style>
<main class="site-main site-login">
<div class="container" id="search_wrap">
<div id="search_left">




	<div class="filter-options" id="additional_category">
		  <div class="block-content">
			<div class="filter-options-item filter-categori categories">
                  <div class="filter-options-title">자재 상태</div>
					<div class="filter-option-contents">
						<label class="inline">
							<input type="checkbox" name="scratch" value="1"  >
							<span class="input"></span> SCRATCH 

                         </label>
						 <label class="inline">
							<input type="checkbox" name="rust" value="1" >
							<span class="input"></span> RUST
                         </label><br>
						 <label class="inline">
							<input type="checkbox" name="dent" value="1" >
							<span class="input"></span> DENT
                         </label>
						 <label class="inline">
							<input type="checkbox" name="certi" value="1" >
							<span class="input"></span> CERTI
                         </label>

					</div>
					<br>
					<br>
					 <div class="filter-options-title">검색제외 국가</div>
					<div class="filter-option-contents">
						<input type="text" name="except_country">
					</div>
			</div>
		  </div>
	</div>
	<div id="product_filter">
			<div class="filter-options">
			  <div class="block-content">
				<div class="filter-options-item filter-categori categories">
					  <div class="filter-options-title">품목</div>
						<div class="filter-option-contents">
							<label class="inline">
								<input type="checkbox" name="product_type" value="pipe" data-next="pipe" data-type="pipe"  <?=attr($param['category']=='pipe','checked')?> >
								<span class="input"></span> Pipe
							 </label>&nbsp;&nbsp;
							 <label class="inline">
								<input type="checkbox" name="product_type" value="valve" data-next="valve" data-type="valve" <?=attr($param['category']=='valve','checked')?>>
								<span class="input"></span> Valve
							 </label>&nbsp;&nbsp;
							 <label class="inline">
								<input type="checkbox" name="product_type" value="fitting" data-next="fitting" data-type="fitting"  <?=attr($param['category']=='fitting','checked')?>>
								<span class="input"></span> Fitting
							 </label>
							 <label class="inline">
								<input type="checkbox" name="product_type" value="flange" data-next="type_for_flange" data-type="flange"  <?=attr($param['category']=='flange','checked')?>>
								<span class="input"></span> Flange
							 </label>

						</div>
				</div>
			  </div>
		</div>

	</div>
	



	<style>
	#search_layer{
		display: none;
		position: absolute;z-index: 10000;
		top: 0;
		left: 0;
		width: 330px;
		border-radius:10px;
		border: 1px solid #ddd;
			height: 440px;
			background: #fff;
	}
	#search_layer h3{
		position: relative;
		text-indent: 10px;
		line-height: 40px;
		font-size:20px;
		margin-bottom: 0;
		font-weight: bold;
	}
	#search_layer h3 .close_button{
		line-height: 25px;
		width: 25px;
		height: 25px;
		position: absolute;
		top: 10px;
		right: 10px;
		border: 1px solid #bdbfc3;
		border-radius:2px;
		text-align: center;
		font-family: arial;
		color: #bdbfc3;
		font-weight: normal;
		text-indent: 0;
	}
	#search_result{
		height: 330px;
		overflow-y: scroll;
	}
	#search_layer_input{
		background: #232a34;
		position: relative;
		padding: 11px 30px;
	}
	#search_layer_input input{
		width: 100%;
		height: 32px;
		padding: 10px 2px;
		border-radius:4px;
		border: 1px solid #5a626d;
		box-sizing:border-box;
		background: transparent;
	}
	#search_layer_input i{
		position: absolute;
		top: 17px;
		right: 40px;
	}
	#search_result li{
		list-style: none;
		line-height: 33px;
		padding: 5px;
		margin-bottom: 0;
		border-bottom: 1px solid #ddd;
	}
	.search-list-table thead th{
	border-bottom: 1px solid #dee2e6
	}
	.search-list-table thead th,.search-list-table tbody td{
	line-height: 17px;
	font-size:12px;
	}
	.search-list-table tbody td{
font-size:12px;
letter-spacing:-1px;
	}
	
</style>
<div id="search_layer">
	<h3>
	<span class="title" id="product_title"></span>
		선택
		<a href="" class="close_button">X</a>
	</h3>
	<div id="search_layer_input">
			<input type="text" placeholder="검색어 입력"><i class=" fa fa-search"></i>

	</div>
	<ul id="search_result">
		

	</ul>
	
</div>



</div><!-- AND LEFT-->


	<div id="search_right">
	<div class="block-search" >
					<div class="block-content">
						
						<div class="form-search">
							
								<div class="box-group">
									<input type="text" name="keyword" id="search_keyword_input" placeholder="카테고리를 선택하고 검색어를 ,(컴마)로 구분하여 입력해주세요." class="form-control" value="<?=htmlspecialchars($_GET['keyword'])?>">
									<button class="btn btn-search" type="button" id="search_button"><span class="fa fa-search"></span></button>
								</div>
							
						</div>
					</div>
				</div>
				<form id="product_list_form" method="post" action="/user/estimate_cart">
					
<style>
	#product_list_form{
	position: relative;
}
#right_button{
	position: absolute;
	top: 0;
	right: 0;
	width: 30px;
	height:360px;
	text-align: center;
	line-height: 360px;
	background: rgba(0,0,0,0.6);
	color: #fff;
}
.slide_buttons{
display: none;
}
#left_button{
	position: absolute;
	top: 360px;;
	right: 0;
	width: 30px;
	height: 360px;
	text-align: center;
	border-top: 1px solid #fff;
	
	line-height: 360px;
	background: rgba(0,0,0,0.6);
	color: #fff;
}
#checker{
	position: absolute;z-index: 100;
	top: 65px;
	left: 0;
	background:#fff;
}
#checker #pagination_wrap{
display: none;
}
#checker table tr td{
display: none;
background: #fff;
}
#checker table tr td:nth-child(1){
	display: block;
}
#checker table tr th{
display: none;
background: #fff;
height: 52px;

}
.search-list-table thead th, .search-list-table tbody td{
height: 52px;
}
#checker table tr th:nth-child(1){
	display: block;
}
</style>
			<!-- <a href="" id="right_button" class="slide_buttons">
				<i class="fa fa-arrow-right"></i>

			</a>
			<a href="" id="left_button" class="slide_buttons">
					<i class="fa fa-arrow-left"></i>

			</a> -->
			<div id="no-result">품목을 선택해주세요.</div>
			<div id="checker">
				

			</div>
			<div id="wrapper">
	<div id="scroller">
		  <div class="search-list-table_wrap" >
				
		  </div>
		  </div>
		 </div>
		  <div class="pagination">
						
				</div>
		  	</form>
		         <div class="clearfix">
		
                <a href="/user/estimate_cart" id="to_estimate_cart_button" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select">선택한 제품 견적 바구니에 담기</a>
            </div>

	</div>   
	
	<script>
	var scroll=0;
		$('#right_button').click(function(){
		var cur=$('.search-list-table_wrap').scrollLeft();
		$('.search-list-table_wrap').scrollLeft(cur+100);
		return false;
	});
		$('#left_button').click(function(){
		var cur=$('.search-list-table_wrap').scrollLeft();
		$('.search-list-table_wrap').scrollLeft(cur-300);
		return false;
	});

	</script>





</div>

 </main>

<style>

#loading{
	position: fixed;
	z-index: 9099;
	top: 50%;
	left: 50%;
	margin-left: -100px;
	margin-top: -100px;
}
	/*.search-list-table_wrap{
	overflow-x: hidden;
	min-height:760px;
}*/

</style>
<script>

	var currentSelect = 0;
	var serach  = [];
		$(document).on('click','#product_list_search_form input',function(){
	$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
});

$('#search_keyword_input').on('change keyup paste',function(){
		//$('#search_left .filter-options:gt(0)').remove()
		$('.detail_category').remove();
});
	$(document).on('click','#product_filter .filter-option-contents input',function(){
		//	$('.filter-options:gt(0).filter-options').remove()
		$('#search_keyword_input').val('')
		
			currentSelect=0;
		search(this);

	
		
	

			//$(this).parent().parent().parent().nextAll('.filter-options').remove();

	
	});


jQuery.expr[':'].contains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};


	$(document).on('click','.search_button',function(){
		currentSelect  =$(this).closest('.filter-options').index();
		$('#search_layer').slideDown().find('#search_result').html($(this).next().html());
		return false;

	});
	$(document).on('click','#search_result input',function(){
		var value  = $(this).val();
		if($('#search_keyword_input').val()!=''){
			value= $('#search_keyword_input').val()+','+value;
		}
		
		$('#search_keyword_input').val(value)
		search(this);
	
		$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
		

	});
	$('.close_button').click(function(){
		$('#search_layer').slideUp();
		return false;
	});
	$('#search_layer_input input').keyup(function(){
		var keyword = $(this).val();
		$('#search_result li').hide();
		$('#search_result li:contains("'+keyword.toUpperCase()+'")').show();
	});

	function search($elem){
		
		var categoryGroup =  $($elem).data('next');
		$('#product_title').text(categoryGroup)
		var type= $($elem).data('type');
		var $this = $($elem);

		var $parent = $('#product_filter  .filter-options').eq(currentSelect);
		var $check= $($elem).prop('checked');

		if($($elem).attr('name')=='product_type'){
			$('.chosen-single').text($($elem).parent().text())
				
				$('#search_category').val($($elem).val())
		}
		

		$('#product_filter .filter-options').eq(currentSelect).find('.filter-options-content .label').text($($elem).val());
		
		$parent.nextAll('.filter-options').remove();

	
		
		if(categoryGroup&&$check){//다음그룹이 있고 체크됬을때만
		//if($(this).parent().find('ul').size()==0){
			$($elem).parent().siblings().find('input').prop({checked:false});
			postRequest({
				url : '/product/add',
				data : {category_group:categoryGroup,has_data : 'next_category',type:type},
				success : function($data){
					
					var  $template=  [];
					for(var iu=0;iu<$data.list.length;iu++){
						if($data.list[iu].additional_info==''){
							additional = ''
						}
						else{
							additional = '('+$data.list[iu].additional_info+')'
						}
						$template.push('<li><label class="inline"><input type="checkbox" name="'+$data.list[iu].category_group+'" value="'+$data.list[iu].keyword.replace('"','&quot;')+'" data-next="'+$data.list[iu].next_category_group+'" data-type="'+$data.list[iu].product_type+'"><span class="input"></span>'+$data.list[iu].name+additional+' </label></li>');
					}
					if($data.length>0){
						$parent.after(' <div class="filter-options"><div class="block-content"><div class="filter-options-item filter-categori categories"><div class="filter-options-title">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+'</div><div class="filter-options-content"><span class="label label-default detail_category"></span><a href="" class="btn btn-default search_button">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+' 선택</a><ul style="display:none;" >'+$template.join('')+'</ul></div></div></div></div>')
					}
				$('#search_layer').slideUp()
				//	$('#search_layer').slideDown().find('#search_result').html($template.join(''));
					
				$('#product_filter .filter-options').eq(currentSelect).next().find('.search_button').click();
				}


			});
		}
		else{
			$('#search_layer').slideUp()
		}

	var keyword =$('#search_keyword_input').val();
		getList(1,keyword);
	}



	function getList($page,$keyword){
var category = $('[name="product_type"]:checked').val()

	
openLoading();


			var details= [];


			$('.detail_category').each(function(){
			
				details.push($(this).text());
			});
			
			

				if(category==undefined){
					$('.slide_buttons').hide();
				}
				else{
					$('.slide_buttons').show();
				}

			
			var scratch =0;
			var rust =0;
			var dent =0;
			var certi =0;
			var except_country =$('[name="except_country"]').val();
			if($('[name="rust"]').size()>0){
				rust=1;
			}
			if($('[name="scratch"]').size()>0){
				scratch=1;
			}
			if($('[name="dent"]').size()>0){
				dent=1;
			}
			if($('[name="certi"]').size()>0){
				certi=1;
			}
			postRequest({
				url : '/product/list',
				data:  {mode : 'product_list',category: category,details:details,page:$page,keyword:$keyword,scratch:scratch,rust:rust,dent:dent,certi:certi,except_country:except_country},
				dataType:'HTML',
				success : function($data){
						closeLoading()
					if($data!=''){
					$('#wrapper').css({opacity:1});
					$('#no-result').hide();
					}
					else{
							$('#no-result').show();
						$('#wrapper').css({opacity:0});
				}
					$('.search-list-table_wrap').html($data)
					$('#checker').html($data)
					if($('#no-result').size()>0){
					$('.slide_buttons').hide();
				}
					
				 itemTotal = $('.search-list-table tbody tr').size()
					//paginationLoad(itemTotal,1,15,10);
					$('.search-list-table tbody tr:lt(15)').show();
				}

			})
	}

/*
function paginationLoad($total,$page,$itemNum,$pageNum) {
	var template = '';
	var totalPage = Math.ceil($total / $itemNum);
	var firstPage = Math.floor(($page - 1) / $pageNum) * $pageNum + 1;
	if(firstPage < 1) firstPage = 1;
	var lastPage = firstPage - 1 + $pageNum;
	if(lastPage > totalPage) lastPage = totalPage;
	if(totalPage > $pageNum) {
		template+='<li><a href="" data-page="1">&lt;&lt;</a></li>'
	}
	if($page > $pageNum) {
		var prevPageGroup = firstPage-1;
		template+='<li><a href="" data-page="'+prevPageGroup+'">&lt;</a></li>'
	}
	for(var iu=firstPage;iu<=lastPage;iu++) {
		if(iu==$page){
			active='class="active" ';
		} else {
				active='';
		}
		template+='<li  '+active+'><a href="" data-page="'+iu+'">'+iu+'</a></li>';
	}
	if(lastPage < totalPage) {
		var nextPageGroup = lastPage + 1;
		template+='<li><a href="" data-page="'+nextPageGroup+'">&gt;</a></li>'
	}
	if(totalPage > $pageNum) {
		template+='<li><a href=""  data-page="'+totalPage+'">&gt;&gt;</a></li>'
	}
	$('.pagination').html(template);
}
*/

function openLoading(){
	$('#loading,#fog').show()
	
	}


function closeLoading(){
	$('#loading,#fog').hide()
	
	}



var keyword =$('#search_keyword_input').val();
		getList(1,keyword);

$('.btn-search').click(function(){
	if($('[name="product_type"]:checked').size()==0){
		alert('품목을 선택해주세요.');	
		return false;
	
	}
	var keyword =$('#search_keyword_input').val();
getList(1,keyword);

});

var searchRun=null;
$('#search_keyword_input').on('keyup change paste',function($event){
	var keyword =$('#search_keyword_input').val();
	clearTimeout(searchRun);
	
	searchRun=setTimeout(function(){
		
		getList(1,keyword)

		
	},850);
})
$(document).on('click','.pagination a',function(){
		var keyword =$('#search_keyword_input').val();
var page = $(this).attr('href');

//$('.search-list-table tbody tr').hide();
//paginationLoad(itemTotal,page,15,10);
//$('.search-list-table tbody tr').slice((page-1)*15,page*15).show()
getList(page,keyword);
return false;
});

	$(window).scroll(function(){
		var top = $(this).scrollTop();

		$('#search_layer').css({top : top})
	});

		$('#to_estimate_cart_button').click(function(){

				if('<?=$_SESSION['login']?>'==''){

			Swal.fire({
  title: '<strong>로그인 후 이용해주세요.</strong>',
  icon: 'warning',
  html:
    '로그인 화면으로 이동하시겠습니까?.',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a href="#"  style="color:white;">확인</a>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '취소',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {
  if (result.value) {
 	location.href='/user/login';
  }
})

	return false;
		}


		var checked=[];
		$('.search-list-table tbody input[type="checkbox"]:checked').each(function(){
			
			checked.push($(this).val());
			
		});
	if(checked==''){
			Swal.fire({
		  title: '<strong>견적 바구니에 담을 상품을 선택해주세요..</strong>',
		  icon: 'warning',
		 
		  showCloseButton: true,

		  focusConfirm: false,
		  confirmButtonText:
			'<a href="#"  style="color:white;">확인</a>',
		  confirmButtonAriaLabel: 'Thumbs up, great!',
		 
		  cancelButtonAriaLabel: 'Thumbs down'
		})
			return false;
	}
	$.ajax({
		url : '/user/estimate_cart',
		data :  {no : checked},
		type:'POST',
		dataType:'HTML',
		success : function($data){
			
		}
		
	})

		$('.search-list-table input[type="checkbox"]').prop({checked:false})
	
Swal.fire({
  title: '<strong>견적 바구니로 이동하시겠습니까?</strong>',
  icon: 'info',
  html:
    '선택한 제품을 견적 바구니에 담았습니다.',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a href="#"  style="color:white;">확인</a>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '취소',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {
  if (result.value) {
 	$('#product_list_form').submit();
  }
})




	return false;
});
$(document).on('click','#check_all',function(){
	var checked = $(this).prop('checked')
		$('#product_list_form input[type="checkbox"]').prop({checked:checked});
});
</script>

<script src="/scripts/iscroll.js"></script>
<script type="text/javascript">

var myScroll;


	myScroll = new IScroll('#wrapper', {scrollbars: true, scrollX: true, scrollY: false, mouseWheel: true });



</script>



<div id="loading" style="display:none;">
	<img src="/images/smalllogo.png" alt="">

</div>
	<?php

	include'views/footer.html';
?>