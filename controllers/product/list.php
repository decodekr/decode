<?php
	$user=getItem('users',$session['login']);
	ini_set('memory_limit',-1);
	$sameWords=array();
	$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier','scratch_y/n','dent_y/n','rust_y/n','heat_no._and_product_certi._y/n','manufactured_year','manufacturer','drawing_y/n','pressure_test_report_y/n','raw_material_certi._y/n');
	
	function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
	function checkMatching($keyword,$detail){
		
	}
	function samewords($word){	
		$sameword=getItem('samewords',"input_word like '%".$word."%'");
		return $sameword['result_words'];
	}
if($param['mode']=='product_list'){

	if($param['category']==''){
		exit;
	}
	$where=  'amount > 0  ';;
	$select = '';
	
	
	//키워드 보정
	
	
	
	if($param['keyword']){
		$where.='AND (';

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


	
	if($param['certi']){
		$where.=' AND details like '.'\'%"heat_no._and_product_certi._y/n":"'.$param['certi'].'"%\''.'';
	}
	if($param['scratch']){
		$where.=' AND details like '.'\'%"scratch_y/n":"'.$param['scratch'].'"%\''.'';
	}
	if($param['dent']){
		$where.=' AND details like '.'\'%"dent_y/n":"'.$param['dent'].'"%\''.'';
	}
	if($param['rust']){
		$where.=' AND details like '.'\'%"rust_y/n":"'.$param['rust'].'"%\''.'';
	}
	if($param['except_country']){
		$where.=' AND details not like '.'\'%'.$param['except_country'].'"%\''.'';
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
                    <th>Matching<br>매칭률</th>             
					<?php
					}	
					?>
				
					<th>seamless/welded<br>심리스/용접</th>
					<th>welding_type<br>용접 종류</th>
					<th>material_grade<br>재질</th>
					<th>zinc/galva<br>코팅 형태</th>
					<th>size1<br>사이즈1</th>
					<th>sch1<br>스케쥴</th>
					<th>end<br>엔드 타입</th>
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
					   <tr class="detail_info_parent">
					
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                 <td >
						
					<?=$product['details']['seamless/welded']?>
					<div class="detail_info_layer">
					  <?php if($param['keyword']){?> 
					<h3>찾으시는 자재와 <strong><?=round(($product['match_rate']*100))?></strong>% 일치합니다.</h3>
					<?php
					}else{
					?>
							<h3>Pipe</h3>
						<?php
					}	
					?>
						<table class="table table-bordered">
							<tr>
								<th>
									SEAMLESS/WELDED

								</th>
								<td>
									<?=$product['details']['seamless/welded']?>
									
								</td>
								<th>
									
									LENGTH
								</th>
								<td>
									<?=$product['details']['length']?>
								</td>
								<th>SCRATCH</th>
								<td>
									<?=$product['details']['scratch_y/n']?>
								</td>
							</tr>
							<tr>
								<th>
									MATERIAL GRADE

								</th>
								<td>
									<?=$product['details']['material_grade']?>
									
								</td>
								<th>
									CODE
									
								</th>
								<td>
									<?=$product['details']['code']?>

								</td>
								<th>DENT</th>
								<td>
									<?=$product['details']['dent_y/n']?>
								</td>
							</tr>
							<tr>
								<th>
									SIZE

								</th>
								<td>
									<?=$product['details']['size1']?>
									
								</td>
								<th>
									
									MANUFACTURED YEAR
								</th>
								<td>
									<?=$product['details']['manufactured_year']?>

								</td>
								<th>RUST</th>
								<td>
									<?=$product['details']['rust_y/n']?>
								</td>
							</tr>
							<tr>
								<th>
SCH1

								</th>
								<td>
									
									<?=$product['details']['sch1']?>
								</td>
								<th>
									
									MANUFACTURER
								</th>
								<td>
									<?=$product['details']['manufacturer']?>

								</td>
								<th>HEAT NO. AND PRODUCT CERTI.
</th>
								<td>
									<?=$product['details']['heat_no._and_product_certi._y/n']?>
								</td>
							</tr>
							<tr>
								<th>
						WELDING TYPE


								</th>
								<td>
									<?=$product['details']['welding_type']?>
									
								</td>
								<th>
									
									COUNTRY

								</th>
								<td>
									<?=$product['details']['country']?>

								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>
									END

								</th>
								<td>
									<?=$product['details']['end']?>
									
								</td>
								<th>
									AVAILABLE DELIVERY DATE

								</th>
								<td>
									
<?=$product['details']['available_delivery_date']?>d
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>
									ZINC/GALVA


								</th>
							
								<td><?=$product['details']['zinc/galva']?></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							
							</tr>

						</table>

					</div>
				 </td>
                 <td><?=$product['details']['welding_type']?></td>
                 <td><?=$product['details']['material_grade']?></td>
                 <td><?=$product['details']['zinc/galva']?></td>
                 <td><?=$product['details']['size1']?></td>
                 <td><?=$product['details']['sch1']?></td>
                 <td><?=$product['details']['end']?></td>
               
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
print_x($detailTitle);
	
	?>
            <table class="search-list-table" >
              <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
                                     	   <?php if($param['keyword']){?>
                    <th>Matching<br>매칭률</th>             
					<?php
					}	
					?>
                  
					<th>item<br>밸브 종류</th>
					<th>forged/casting<br>단조/주조</th>
					<th>type<br>밸브 종류 상세</th>
			
				
					<th>material_grade<br>재질</th>
					<th>trim_material<br>트림 재질</th>
					<th>seat_material<br>시트 재질</th>
					<th>size1<br>사이즈</th>
					<th>pressure_rating<br>압력</th>
					<th>end<br>엔드 타입</th>

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
                    <td><?=$product['details']['item']?></td>
                    <td><?=$product['details']['forged/casting']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
                    <td><?=$product['details']['seamless/welded']?></td>
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
                    <th>Matching<br>매칭률</th>             
					<?php
					}	
					?>
					<th>item <br>피팅 종류</th>
					<th>forged/pipe<br>단조 피팅/파이프 피팅</th>
					<th>type<br>피팅 종류 상세</th>
					<th>material<br>재질</th>
					<th>size1<br>사이즈1</th>
					<th>size2<br>사이즈2</th>
					<th>schedule_1<br>스케쥴1</th>
					<th>pressure_rating<br>압력</th>
					<th>end1<br>엔드 타입1</th>
					<th>end2<br>엔드 타입2</th>       
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
                    <th>Matching<br>매칭률</th>             
					<?php
					}	
					?>
					  <th>material grade</th>
					<th>type<br>플렌지 타입</th>
					<th>reducing_y/n<br>리듀싱 유/무</th>
					<th>material<br>재질</th>
					<th>size1<br>사이즈1</th>
					<th>size2<br>사이즈2</th>
					<th>sch1 <br>스케쥴1</th>
					<th>pressure<br>압력</th>
					<th>end1 <br>엔드타입 1</th>
					
					<!-- <th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>raw_material_certi._y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th> -->
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                  
                    
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
	vertical-align: middle;
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




	<!-- <div class="filter-options" id="additional_category">
		  <div class="block-content">
			<div class="filter-options-item filter-categori categories">
                  <div class="filter-options-title">자재 상태</div>
					<div class="filter-option-contents">
					<div class="filter-row">
							<label class="inline">
							<input type="checkbox" name="scratch" value="1"  >
							<span class="input"></span> SCRATCH Y

                         </label>
						<label class="inline">
							<input type="checkbox" name="scratch" value="0"  >
							<span class="input"></span> SCRATCH N

                         </label>

					</div>
					<div class="filter-row">
						 <label class="inline">
							<input type="checkbox" name="rust" value="1" >
							<span class="input"></span> RUST Y
                         </label>
						 <label class="inline">
							<input type="checkbox" name="rust" value="0" >
							<span class="input"></span> RUST N
                         </label>
						</div>
						<div class="filter-row">
						 <label class="inline">
							<input type="checkbox" name="dent"  value="1" >
							<span class="input"></span> DENT Y
                         </label>
						 <label class="inline">
							<input type="checkbox" name="dent" value="0" >
							<span class="input"></span> DENT N
                         </label>
						</div>
						<div class="filter-row">
						 <label class="inline">
							<input type="checkbox" name="certi" value="1" >
							<span class="input"></span> CERTI Y
                         </label>
						 <label class="inline">
							<input type="checkbox" name="certi" value="0" >
							<span class="input"></span> CERTI N
                         </label>
						 </div>

					</div>
				
					<br>
					 <div class="filter-options-title">검색제외 국가</div>
					<div class="filter-option-contents">
						<input type="text" name="except_country">
					</div>
			</div>
		  </div>
	</div> -->
	<div id="product_filter">
			<div class="filter-options">
			  <div class="block-content">
				<div class="filter-options-item filter-categori categories" >
					  <div class="filter-options-title">품목</div>
					
					  <strong>  <?=$param['category']?></strong>
						<div class="filter-option-contents" style="display:none;" >
							<label class="inline" >
								<input type="checkbox"  name="product_type" value="pipe" data-next="welding_type" data-type="pipe"  <?=attr($param['category']=='pipe','checked')?> >
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
				<table class="table table-bordered" style="margin:10px;width:880px;">
							<tr>
								<th style="width:80px;">SCRATCH</th>
								<td>
									<label class="btn btn-xs btn-default scratch" class="scratch" data-value="y">YES</label>
									<label class="btn btn-xs btn-default scratch"  class="" data-value="n">NO</label>

								</td>
						
								<th style="width:80px;">RUST</th>
								<td>
									<label class="btn btn-xs btn-default rust"  class="" data-value="y">YES</label>
									<label class="btn btn-xs btn-default rust"  class="rust" data-value="n">NO</label>

								</td>
								<th colspan="2" >
									
										검색제외국가
								</th>
							</tr>
							<tr>
								<th>DENT</th>
								<td>
									<label class="btn btn-xs btn-default dent"  class="dent" data-value="y">YES</label>
									<label class="btn btn-xs btn-default dent"  class="dent" data-value="n">NO</label>

								</td>
						
								<th>CERTI</th>
								<td>
									<label class="btn btn-xs btn-default certi"  class="certi" data-value="y">YES</label>
									<label class="btn btn-xs btn-default certi"  class="certi" data-value="n">NO</label>

								</td>
								<td colspan="2" >
									
										<input type="text" style="width:100%;height:25px;" id="except_country">
								</td>

							</tr>

						</table>
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
		
		
   <a href="/user/estimate_cart" id="to_estimate_cart_button" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select">선택한 제품 견적 바구니에 담기</a><br><br>
		  <div class="search-list-table_wrap" >
				
		  </div>

		  <div class="pagination">
						
				</div>
		  	</form>
		         <div class="clearfix">
		
             
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


	search('#product_filter .filter-option-contents input[value="<?=$param['category']?>"]');

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

			
			var scratch ='';
			var rust ='';
			var dent ='';
			var certi ='';
			var except_country =$('#except_country').val();
			if($('.rust.active').size()>0){
				rust=$('.rust.active').data('value');
			}
			if($('.scratch.active').size()>0){
				scratch=$('.scratch.active').data('value');
			}
			if($('.dent.active').size()>0){
				dent=$('.dent.active').data('value');
			}
			if($('.certi.active').size()>0){
				certi=$('.certi.active').data('value');
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

		<?php
	if(!$user['virtual_account_number']){
?>

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
			return false;

<?php
}	
?>




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

$('.scratch,.certi,.dent,.rust').click(function(){
	if($(this).hasClass('active')){
		$(this).removeClass('active');;
	}
	else{
		$(this).addClass('active').siblings().removeClass('active');;
	}
	getList(1,keyword);
	return false;
});
$('#except_country').on('keyup paste change',function(){
	clearTimeout(searchRun);
	
	searchRun=setTimeout(function(){
		
		getList(1,keyword)

		
	},850);
	
})

$(document).on('click','#check_all',function(){
	var checked = $(this).prop('checked')
		$('#product_list_form input[type="checkbox"]').prop({checked:checked});
});
</script>

<script src="/scripts/iscroll.js"></script>




<div id="loading" style="display:none;">
	<img src="/images/smalllogo.png" alt="">

</div>
	<?php

	include'views/footer.html';
?>