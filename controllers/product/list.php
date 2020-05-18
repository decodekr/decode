<?php
	
	ini_set('memory_limit',-1);
	$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier');
	
	function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
	function checkMatching($keyword,$detail){
		
	}
	function samewords($word){
	
		if($word=='CS' || $word=='Carbon Steel'){
			
			return 'CS,Carbon Steel';
		}
	
		if($word=='A120'||$word=='A283-A'||$word=='SPP'||$word=='SPP'||$word=='SB41'||$word=='FSGP or SGP'||$word=='SGP(STPY400)'||$word=='SS400'||$word=='1387-M'||$word=='2440-ST33-1'){return 'A120,A283-A,SPP,SPP,SB41,FSGP or SGP,SGP(STPY400),SS400,1387-M,2440-ST33-1';}if($word=='A53-B'||$word=='A284'||$word=='PS38(W),PS38,PT38(W),PT38'||$word=='SPPS38'||$word=='SWS41B'||$word=='PG370(W),PS370(W),PT370(W),PT370'||$word=='STPG370'||$word=='SM41B'||$word=='3602-ERW 23'||$word=='1626-ST37'){return 'A53-B,A284,PS38(W),PS38,PT38(W),PT38,SPPS38,SWS41B,PG370(W),PS370(W),PT370(W),PT370,STPG370,SM41B,3602-ERW 23,1626-ST37';}if($word==''||$word=='A53-B'||$word=='A284'||$word=='PS42(W),PS42,PT42(W),PT42'||$word=='SPPS42'||$word=='SWS41B'||$word=='PG410(W),PS410(W),PT410(W),PT410'||$word=='STPG410'||$word=='SM41B'||$word=='3602-ERW 27'){return 'A53-B,A284,PS42(W),PS42,PT42(W),PT42,SPPS42,SWS41B,PG410(W),PS410(W),PT410(W),PT410,STPG410,SM41B,3602-ERW 27';}if($word==''||$word==''||$word==''||$word==''||$word=='HT38,HT38(W)'||$word=='SPHT38'||$word=='SBB42'||$word==''||$word=='STPT370'||$word=='SB42'||$word=='3602-Steel 23'||$word=='17175-ST35.8'){return 'HT38,HT38(W),SPHT38,SBB42,,STPT370,SB42,3602-Steel 23,17175-ST35.8';}if($word=='WPB'||$word=='A106-B'||$word=='A515-60 or 70'||$word=='A105'||$word=='HT42,HT42(W)'||$word=='SPHT42'||$word=='SBB42'||$word=='PS370,PT370(W)'||$word=='STPT410'||$word=='SB42'||$word=='3602-Steel 27'||$word=='17175-ST45.8'){return 'WPB,A106-B,A515-60 or 70,A105,HT42,HT42(W),SPHT42,SBB42,PS370,PT370(W),STPT410,SB42,3602-Steel 27,17175-ST45.8';}if($word=='WPB'||$word=='A106-B'||$word=='A516-60 or 70'||$word=='A516-60 or 70'||$word==''||$word==''||$word==''||$word=='PS410,PT410(W)'||$word==''||$word==''||$word==''||$word==''){return 'WPB,A106-B,A516-60 or 70,A516-60 or 70,,,,PS410,PT410(W),,,,';}if($word=='WPC'||$word=='A106-C'||$word=='A515-70'||$word=='A105'||$word=='HT49,HT49(W)'||$word=='SPHT49'||$word=='SBB49'||$word==''||$word=='STPT480'||$word=='SB49'||$word=='3602-Steel 35'){return 'WPC,A106-C,A515-70,A105,HT49,HT49(W),SPHT49,SBB49,,STPT480,SB49,3602-Steel 35';}if($word=='WPC'||$word=='A106-C'||$word=='A516-70'||$word=='A516-70'||$word==''||$word==''||$word==''||$word=='PS480,PT480(W)'||$word==''||$word==''||$word==''||$word==''){return 'WPC,A106-C,A516-70,A516-70,,,,PS480,PT480(W),,,,';}if($word=='WPL6'||$word=='A333 & A334-6'||$word=='A516-60'||$word=='A350-LF2'||$word=='PL39'||$word=='STPL39'||$word=='SLAL39'||$word=='PL380(W)'||$word=='STPL380'||$word=='3603-Steel 27 LT 30'){return 'WPL6,A333 & A334-6,A516-60,A350-LF2,PL39,STPL39,SLAL39,PL380(W),STPL380,3603-Steel 27 LT 30';}if($word=='WPL3'||$word=='A333 & A334-3'||$word=='A203-D'||$word=='A350-LF3'||$word=='PL450(W)'||$word=='STPL450'||$word=='3603-Steel 503 LT 100'){return 'WPL3,A333 & A334-3,A203-D,A350-LF3,PL450(W),STPL450,3603-Steel 503 LT 100';}if($word=='WPL9'||$word=='A333 & A334-9'||$word=='A203-A'||$word=='A350-LF9'||$word=='PL690(W)'||$word=='STPL690'){return 'WPL9,A333 & A334-9,A203-A,A350-LF9,PL690(W),STPL690';}if($word=='WP1'||$word=='A335-P1'||$word=='A204-B'||$word=='A182-F1'||$word=='PA12,FA12'||$word=='SPA12'||$word=='SBB46M'||$word=='PA12(W),FA12'||$word=='STPA12'||$word=='17175-15 Mo3'){return 'WP1,A335-P1,A204-B,A182-F1,PA12,FA12,SPA12,SBB46M,PA12(W),FA12,STPA12,17175-15 Mo3';}if($word=='WP12'||$word=='A335-P12'||$word=='A387-12'||$word=='A182-F12'||$word=='PA22,FA22'||$word=='SPA22'||$word=='SCMV2'||$word=='PA22(W),FA22'||$word=='STPA22'||$word=='3603-HF620'||$word=='17175-13 Cr Mo44'){return 'WP12,A335-P12,A387-12,A182-F12,PA22,FA22,SPA22,SCMV2,PA22(W),FA22,STPA22,3603-HF620,17175-13 Cr Mo44';}if($word=='WP11'||$word=='A335-P11'||$word=='A387-11'||$word=='A182-F11'||$word=='PA23,FA23'||$word=='SPA23'||$word=='SCMV3'||$word=='PA23(W),FA23'||$word=='STPA23'||$word=='3603-HF621'){return 'WP11,A335-P11,A387-11,A182-F11,PA23,FA23,SPA23,SCMV3,PA23(W),FA23,STPA23,3603-HF621';}if($word=='WP22'||$word=='A335-P22'||$word=='A387-22'||$word=='A182-F22'||$word=='PA24,FA24'||$word=='SPA24'||$word=='SCMV4'||$word=='PA24(W),FA24'||$word=='STPA24'||$word=='SCMV4'||$word=='3603-HF622,27'||$word=='17175-10 Cr Mo910'){return 'WP22,A335-P22,A387-22,A182-F22,PA24,FA24,SPA24,SCMV4,PA24(W),FA24,STPA24,SCMV4,3603-HF622,27,17175-10 Cr Mo910';}if($word=='WP5'||$word=='A335-P5'||$word=='A387-5'||$word=='A182-F5'||$word=='PA25,FA25'||$word=='SPA25'||$word=='SCMV6'||$word=='PA25(W),FA25'||$word=='STPA25'||$word=='3603-HF625'){return 'WP5,A335-P5,A387-5,A182-F5,PA25,FA25,SPA25,SCMV6,PA25(W),FA25,STPA25,3603-HF625';}if($word=='WP7'||$word=='A335-P7'||$word=='A387-7'||$word=='A182-F7'){return 'WP7,A335-P7,A387-7,A182-F7';}if($word=='WP9'||$word=='A335-P9'||$word=='A387-9'||$word=='A182-F9'||$word=='PA26(W),FA26'||$word=='STPA26'){return 'WP9,A335-P9,A387-9,A182-F9,PA26(W),FA26,STPA26';}if($word=='WP91'||$word=='A335-P91'||$word=='A387-F91'||$word=='A182-F91'||$word==''||$word==''||$word==''||$word==''||$word==''||$word==''){return 'WP91,A335-P91,A387-F91,A182-F91,,,,,,';}if($word=='WP304'||$word=='A312-TP304'||$word=='A240-Type 304'||$word=='A182-F304'||$word=='STS304,STS304W,STS304F'||$word=='STS304TP'||$word=='STS304'||$word=='SUS304,SUS304W,SUS304F'||$word=='SUS304TP'||$word=='SUS304'||$word=='3605-801'||$word=='17440-X5 Cr Ni189'){return 'WP304,A312-TP304,A240-Type 304,A182-F304,STS304,STS304W,STS304F,STS304TP,STS304,SUS304,SUS304W,SUS304F,SUS304TP,SUS304,3605-801,17440-X5 Cr Ni189';}if($word=='WP304H'||$word=='A312-TP304H'||$word=='A240-Type 304H'||$word=='A182-F304H'||$word=='SUS304HTP'||$word=='3605-811'){return 'WP304H,A312-TP304H,A240-Type 304H,A182-F304H,SUS304HTP,3605-811';}if($word=='WP304L'||$word=='A312-TP304L'||$word=='A240-Type 304L'||$word=='A182-F304L'||$word=='STS304L,STS304LW,STS304LF'||$word=='STS304LTP'||$word=='STS304L'||$word=='SUS304L,SUS304LW,SUS304LF'||$word=='SUS304LTP'||$word=='SUS304L'||$word=='3605-811L'||$word=='17440-X2 Cr Ni189'){return 'WP304L,A312-TP304L,A240-Type 304L,A182-F304L,STS304L,STS304LW,STS304LF,STS304LTP,STS304L,SUS304L,SUS304LW,SUS304LF,SUS304LTP,SUS304L,3605-811L,17440-X2 Cr Ni189';}if($word=='WP309'||$word=='A312-TP309'||$word=='A240-Type 309S'||$word=='STS309S,STS309SW,STS309SF'||$word=='STS309TP'||$word=='STS309S'||$word=='SUS309S,SUS309SW,SUS309SF'||$word=='SUS309STP'||$word=='SUS309S'){return 'WP309,A312-TP309,A240-Type 309S,STS309S,STS309SW,STS309SF,STS309TP,STS309S,SUS309S,SUS309SW,SUS309SF,SUS309STP,SUS309S';}if($word=='WP310'||$word=='A312-TP310'||$word=='A240-Type 310S'||$word=='A182-F310'||$word=='STS310S,STS310SW,STS310SF'||$word=='STS310TP'||$word=='STS310S'||$word=='SUS310S,SUS310SW,SUS310SF'||$word=='SUS310STP'||$word=='SUS310S'||$word=='3605-805S'){return 'WP310,A312-TP310,A240-Type 310S,A182-F310,STS310S,STS310SW,STS310SF,STS310TP,STS310S,SUS310S,SUS310SW,SUS310SF,SUS310STP,SUS310S,3605-805S';}if($word=='WP316'||$word=='A312-TP316'||$word=='A240-Type 316'||$word=='A182-F316'||$word=='STS316,STS316W,STS316F'||$word=='STS316TP'||$word=='STS316'||$word=='SUS316,SUS316W,SUS316F'||$word=='SUS316TP'||$word=='SUS316'||$word=='3605-845'||$word=='17440-X5 Cr Ni Mo1810'){return 'WP316,A312-TP316,A240-Type 316,A182-F316,STS316,STS316W,STS316F,STS316TP,STS316,SUS316,SUS316W,SUS316F,SUS316TP,SUS316,3605-845,17440-X5 Cr Ni Mo1810';}if($word=='WP316H'||$word=='A312-TP316H'||$word=='A240-Type 316H'||$word=='A182-F316H'||$word=='STS316H,STS316HF'||$word=='STS316HTP'||$word=='SUS316H,SUS316HF'||$word=='SUS316HTP'||$word=='3605-855'){return 'WP316H,A312-TP316H,A240-Type 316H,A182-F316H,STS316H,STS316HF,STS316HTP,SUS316H,SUS316HF,SUS316HTP,3605-855';}if($word=='WP316L'||$word=='A312-TP316L'||$word=='A240-Type 316L'||$word=='A182-F316L'||$word=='STS316L,STS316LW,STS316LF'||$word=='STS316LTP'||$word=='STS316L'||$word=='SUS316L,SUS316LW,SUS316LF'||$word=='SUS316LTP'||$word=='SUS316L'||$word=='3605-845L'||$word=='17440-X2 Cr Ni Mo1810'){return 'WP316L,A312-TP316L,A240-Type 316L,A182-F316L,STS316L,STS316LW,STS316LF,STS316LTP,STS316L,SUS316L,SUS316LW,SUS316LF,SUS316LTP,SUS316L,3605-845L,17440-X2 Cr Ni Mo1810';}if($word=='WP317L'||$word=='A312-TP317L'||$word=='A240-Type 317L'||$word=='A182-F317L'||$word=='STS317L,STS317LW'||$word=='STS317LTP'||$word=='STS317L'||$word=='SUS317L,SUS317LW'||$word=='SUS317LTP'||$word=='SUS317L'){return 'WP317L,A312-TP317L,A240-Type 317L,A182-F317L,STS317L,STS317LW,STS317LTP,STS317L,SUS317L,SUS317LW,SUS317LTP,SUS317L';}if($word=='WP321'||$word=='A312-TP321'||$word=='A240-Type 321'||$word=='A182-F321'||$word=='STS321,STS321W,STS321F'||$word=='STS321TP'||$word=='STS321'||$word=='SUS321,SUS321W,SUS321F'||$word=='SUS321TP'||$word=='SUS321'||$word=='3605-822Ti'||$word=='17440-X10 Cr Ni Ti189'){return 'WP321,A312-TP321,A240-Type 321,A182-F321,STS321,STS321W,STS321F,STS321TP,STS321,SUS321,SUS321W,SUS321F,SUS321TP,SUS321,3605-822Ti,17440-X10 Cr Ni Ti189';}if($word=='WP321H'||$word=='A312-TP321H'||$word=='A240-Type 321H'||$word=='A182-F321H'||$word=='SUS321HTP'||$word=='3605-832Ti'){return 'WP321H,A312-TP321H,A240-Type 321H,A182-F321H,SUS321HTP,3605-832Ti';}if($word=='WP347'||$word=='A312-TP347'||$word=='A240-Type 347'||$word=='A182-F347'||$word=='STS347,STS347W,STS347F'||$word=='STS347TP'||$word=='STS347'||$word=='SUS347,SUS347W,SUS347F'||$word=='SUS347TP'||$word=='SUS347'||$word=='3605-822Nb'||$word=='17440-X1 Cr Ni Nb189'){return 'WP347,A312-TP347,A240-Type 347,A182-F347,STS347,STS347W,STS347F,STS347TP,STS347,SUS347,SUS347W,SUS347F,SUS347TP,SUS347,3605-822Nb,17440-X1 Cr Ni Nb189';}if($word=='WP347H'||$word=='A312-TP347H'||$word=='A240-Type 347H'||$word=='A182-F347H'||$word=='STS347H,STS347HF'||$word=='STS347HTP'||$word=='SUS347H,SUS347HF'||$word=='SUS347HTP'||$word=='3605-832Nb'){return 'WP347H,A312-TP347H,A240-Type 347H,A182-F347H,STS347H,STS347HF,STS347HTP,SUS347H,SUS347HF,SUS347HTP,3605-832Nb';}if($word==''){return '';}

		return $word;


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
		$param['keyword'] = multiexplode(array(',',' '),$param['keyword']);
		$param['keyword']=array_filter($param['keyword']);
		
		$keywords='';
		foreach($param['keyword'] as $keyword){
			if($keywords!=''){
				$keywords.=',';
			}
			//$keywords.=samewords($keyword);
			$keywords.=$keyword;
		}		


		$keywords = explode(',',$keywords);
		
		foreach($keywords as $index=>$keyword){
			if(trim($keyword)==''){
				continue;
			}
		if($index!=0){
			$where.=' OR ';
			$select.=' + ';
		}
		$where.="details like '%".'"'.$keyword.''."%'";
		$select.="case when details like '%".$keyword."%' then 1 else 0 end";
		}
			$where.=')';
	}


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
		$order='priority desc';
	$select = '*,('.$select.') AS priority';
	}
	else{
	$order='';
	}


$products=pageListSelect('product_lists',$where,$order,10,10,$param['page'],'$page',$select);



$keywordLen = count($param['keyword']);


if($keywordLen>0&&$param['keyword']!=''){
foreach($products['list'] as $index=>$product){
	$match=0;
	foreach($param['keyword'] as $keyword){

		if(trim($keyword)!=''){

			if(strpos($product['details'],$keyword)!==FALSE ||strpos($product['details'],strtolower($keyword))!==FALSE||strpos($product['details'],strtoupper($keyword))!==FALSE){
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




?>









				<?php
		if($param['category']=='pipe'){


					if($products['length']>0){
				$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
            <table class="search-list-table" >
                <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
                   <?php if($param['keyword']){?> <th>Matching</th> <?php } ?>
                  	  <?php
					foreach($detailTitle as $title=>$detail){
						if(in_array($title,$omit)){
						continue;
					}
				?>
<th><?=$title?></th>
					<?php
					}	
				?>
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
		if($param['category']=='valve'){
						if($products['length']>0){
							$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
            <table class="search-list-table" >
                <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
                   <?php if($param['keyword']){?> <th>Matching</th> <?php } ?>
                  	  <?php
					foreach($detailTitle as $title=>$detail){
						if(in_array($title,$omit)){
						continue;
					}
				?>
<th><?=$title?></th>
					<?php
					}	
				?>
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
		if($param['category']=='fitting'){
								if($products['length']>0){
							$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
             <table class="search-list-table" >
                <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
                   <?php if($param['keyword']){?> <th>Matching</th> <?php } ?>
                  	  <?php
					foreach($detailTitle as $title=>$detail){
						if(in_array($title,$omit)){
						continue;
					}
				?>
<th><?=$title?></th>
					<?php
					}	
				?>
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
                   <?php if($param['keyword']){?> <th>Matching</th> <?php } ?>
                  	  <?php
					foreach($detailTitle as $title=>$detail){
						if(in_array($title,$omit)){
						continue;
					}
				?>
<th><?=$title?></th>
					<?php
					}	
				?>
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
</style>
<main class="site-main site-login">
<div class="container" id="search_wrap">
<div id="search_left">




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
							<input type="checkbox" name="product_type" value="flange" data-next="flange" data-type="flange"  <?=attr($param['category']=='flange','checked')?>>
							<span class="input"></span> FLANGE
                         </label>

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
		overflow: hidden;
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
	.search-list-table thead th,.search-list-table tbody td{
	line-height: 17px;
	font-size:12px;
	}
	.search-list-table tbody td{
font-size:12px;
letter-spacing:-1px;
	}
	.search-list-table tbody tr{
	display: none;
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
</style>
			<!-- <a href="" id="right_button" class="slide_buttons">
				<i class="fa fa-arrow-right"></i>

			</a>
			<a href="" id="left_button" class="slide_buttons">
					<i class="fa fa-arrow-left"></i>

			</a> -->
			<div id="no-result">품목을 선택해주세요.</div>
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
	$(document).on('click','.filter-option-contents input',function(){
		//	$('.filter-options:gt(0).filter-options').remove()
		$('#search_keyword_input').val('')
		
			currentSelect=0;
		search(this);

	
		
	

			//$(this).parent().parent().parent().nextAll('.filter-options').remove();

	
	});

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
		$('#search_result li:contains("'+keyword+'")').show();
	});

	function search($elem){
		
		var categoryGroup =  $($elem).data('next');
		$('#product_title').text(categoryGroup)
		var type= $($elem).data('type');
		var $this = $($elem);

		var $parent = $('.filter-options').eq(currentSelect);
		var $check= $($elem).prop('checked');

		if($($elem).attr('name')=='product_type'){
			$('.chosen-single').text($($elem).parent().text())
				
				$('#search_category').val($($elem).val())
		}
		

		$('.filter-options').eq(currentSelect).find('.filter-options-content .label').text($($elem).val());
		
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
						$template.push('<li><label class="inline"><input type="checkbox" name="'+$data.list[iu].category_group+'" value="'+$data.list[iu].name.replace('"','&quot;')+'" data-next="'+$data.list[iu].next_category_group+'" data-type="'+$data.list[iu].product_type+'"><span class="input"></span>'+$data.list[iu].name+additional+' </label></li>');
					}
					if($data.length>0){
						$parent.after(' <div class="filter-options"><div class="block-content"><div class="filter-options-item filter-categori categories"><div class="filter-options-title">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+'</div><div class="filter-options-content"><span class="label label-default detail_category"></span><a href="" class="btn btn-default search_button">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+' 선택</a><ul style="display:none;" >'+$template.join('')+'</ul></div></div></div></div>')
					}
				$('#search_layer').slideUp()
				//	$('#search_layer').slideDown().find('#search_result').html($template.join(''));
					
				$('.filter-options').eq(currentSelect).next().find('.search_button').click();
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
	
			var details= [];


			$('.detail_category').each(function(){
			
				details.push($(this).text());
			});
			
			var category = $('[name="product_type"]:checked').val()

				if(category==undefined){
					$('.slide_buttons').hide();
				}
				else{
					$('.slide_buttons').show();
				}

			
			
			postRequest({
				url : '/product/list',
				data:  {mode : 'product_list',category: category,details:details,page:$page,keyword:$keyword},
				dataType:'HTML',
				success : function($data){
					if($data!=''){
					$('#wrapper').css({opacity:1});
					$('#no-result').hide();
					}
					else{
							$('#no-result').show();
						$('#wrapper').css({opacity:0});
				}
					$('.search-list-table_wrap').html($data);
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

var keyword =$('#search_keyword_input').val();
		getList(1,keyword);

$('.btn-search').click(function(){
	var keyword =$('#search_keyword_input').val();
getList(1,keyword);

});

$('#search_keyword_input').on('keyup change paste',function($event){
	var keyword =$('#search_keyword_input').val();
getList(1,keyword)
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


		var checked='';
		$('.search-list-table tbody input[type="checkbox"]:checked').each(function(){
			checked=[];
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


	<?php

	include'views/footer.html';
?>