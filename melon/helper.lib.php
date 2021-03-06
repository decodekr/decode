<?php

function getGrade($scratch,$dent,$rust,$certi,$date,$country){
		$grade=0;

		$goodCountries='
		KOREA
		한국
		대한민국
		GERMANY
		독일
		USA
		미국
		NETHERLANDS
		네덜란드
		SWEDEN
		스웨덴
		FRANCE
		프랑스
		ITALY
		이태리
		ITALIA
		이탈리아
		UNITED KINGDOM
		영국
		ENGLAND
		영국
		ICELAND
		아이슬란드
		아이슬랜드
		IRELAND
		아일랜드
		NORWAY
		노르웨이
		SPAIN
		스페인
		FINLAND
		핀란드
		CANADA
		캐나다
		DENMARK
		덴마크
		BELGIUM
		벨기에
		SWISS
		스위스
		JAPAN
		일본
		';
		$badCountries='
			INDIA
			인도
			CHINA
			중국
			';


		if($scratch=='Y'||$scratch=='y'){
			
		}
		else{
			$grade+=5;
		}
		if($dent=='Y'||$dent=='y'){
			
		}
		else{
			$grade+=25;
		}
		if($rust=='Y'||$rust=='y'){
			
		}
		else{
			$grade+=10;
		}
		if($certi=='Y'||$certi=='y'){
			$grade+=40;
		}
		else{
			
		}
		

		if($date!=''){
		$start = new DateTime(); // 20120101 같은 포맷도 잘됨


		$end = new DateTime($date);

		 

		// $차이 는 DateInterval 객체. var_dump() 찍어보면 대충 감이 옴.

		$diff    = date_diff($start, $end);
		if($diff<3){
			$grade+=5;
		}
		else if($diff<5){
			$grade+=3;
		}
		else if($diff<10){
			$grade+=1;
		}
		if($diff<3){
			$grade+=0;
		}

		}

		
		if(strpos($country,$goodCountry)!==FALSE){
			$grade+=15;
		}
		else if(strpos($country,$badeCountry)!==FALSE){
			$grade+=5;
		}
		else{
			$grade+=10;
		}

		if($grade>90){
			return 'A';
		}
		else if($grade>70){
			return 'B';
		}
		else if($grade>40){
			return 'C';
		}
		else{
			return 'D';
		}
		
	
	}

//===================================================================================//
// NAME		: lib.client.php
// MEMO		: 클라이언트 분석 기능
// AUTHOR	: DECODE
// EMAIL	: decode@decodelab.co.kr
// Copyright (c) 2012, DECODE Co., Ltd. All rights reserved.
//===================================================================================//


function dateFormatNew($dateString='',$format='',$interval=null){
	/*
		3S,3M,3H,3D,3M,3Y  등으로 입력

	*/
	$date = new dateTime($dateString);
	if(!$format){
		$format = 'Y-m-d';
	}

	
	
	if($interval){
		$prefix = 'P';
		if(strpos($interval,'H')!==FALSE||strpos($interval,'S')!==FALSE||strpos($interval,'M')!==FALSE){
			 $prefix = 'PT';
		}	
		$dateInterval = new dateInterval(str_replace('-','',$prefix.strtoupper($interval)));
		if(strpos($interval,'-')!==FALSE){
			$date->sub($dateInterval);
		}
		else{
			$date->add($dateInterval);
		}
	}


	return $date->format($format);;
}
/*
	Make Condition
	@value [STRING]: 비교 할 원본 값
	@strings [STRING]: 비교 할 문자열
	@type [STRING] : 타입
*/

function makeCondition($value,$strings,$type='OR'){
	$strings = explode('|',$strings);
	if($type='OR'){
		$result= false;
		foreach($strings as $string){
			if($value==$string){
				$result= true;
			
			}

		}
	
	}
	if($type=='AND'){
		$result= true;
		foreach($strings as $string){
			if($value!=$string){
				$result= false;
			}
		}
	}
	return $result;
}
/*
	saveToLibrary
	@name [STRING]: DB에 저장할 파일이름
	@path [STRING]: DB에 저장할 파일 경로
	@type [STRING]: DB에 저장할 파일 유형
*/

function saveToLibrary($name,$path,$type){
	$fileParam['name'] = $name;
	$fileParam['path'] = $path;
	$fileParam['type'] = $type;
	insertItem('files',$fileParam);
}
/*
	form
	@type [STRING]: 폼 생성할 유형[text,radio,select,checkbox,editor,textarea]
 	@name [STRING]: 폼 한글명
	@fieldName [STRING]: 폼 필드명
	@value [STRING]: 폼 값
	@options [STRING]:옵션 필요 유무
*/
function form($type,$name,$fieldName,$value,$options=false){
	switch($type){
		case 'text' : 
		echo '<tr>
				<th>'.$name.'</th>
				<td>
					
					<input type="text" name="'.$fieldName.'" value="'.$value.'" '.$options['attr'].'>
				
				</td>
			</tr>';
		break;
		case 'select' : 
			$optionTemplate = '<option value="">'.$name.' 선택</option>';
			foreach($options['options'] as $option){
				$option = explode('|',$option);
				if($option[1]==$value){
					$selected='selected';
				}
				else{
					$selected = '';
				}
				$optionTemplate.='<option value="'.$option[1].'" '.$selected.'>'.$option[0].'</option>';
			}	
			echo '<tr>
					<th>'.$name.'</th>
					<td>
						<select name="'.$fieldName.'"  '.$options['attr'].'>
						'.$optionTemplate.'
						</select>
					</td>
				</div>';

		break;
		case 'radio' : 
			$optionTemplate ='';
			foreach($options['options'] as $option){
				$option = explode('|',$option);
				if($option[1]==$value){
					$checked='checked';
				}
				else{
					$checked = '';
				}
				$optionTemplate.='<label style="margin-right:15px;"><input type="radio" name="'.$fieldName.'"  value="'.$option[1].'" '.$checked.'> '.$option[0].'</label>';
			}	
			echo '<tr>
					<th>'.$name.'</th>
					<td>
						'.$optionTemplate.'
					</td>
				</tr>';

		break;
		case 'checkbox' : 
			$optionTemplate ='';
			foreach($options['options'] as $option){
				$option = explode('|',$option);
				
			
				if(indexOf(','.$value.',',$option[1].',')!=-1){
					$checked='checked';
				}
				else{
					$checked = '';
				}
				$optionTemplate.='<label style="margin-right:15px;"><input type="checkbox" name="'.$fieldName.'"  value="'.$option[1].'" '.$checked.'> '.$option[0].'</label>';
			}	
			echo '<tr>
					<th>'.$name.'</th>
					<td>
						'.$optionTemplate.'
					</td>
				</tr>';

		break;
		case 'textarea' : 
		
			echo '<tr >
					<th>'.$name.'</th>
					<td>
						<textarea name="'.$fieldName.'"  '.$options['attr'].'>'.$value.'</textarea>
					</td>
				</div>';

		break;
		case 'editor' : 
		
			echo '<tr >
					<th>'.$name.'</th>
					<td>
						<textarea name="'.$fieldName.'"  class="ckeditor" >'.$value.'</textarea>
					</td>
				</tr>';

		break;
	}
}
/*
	jS indexof
*/
function indexOf($string,$find){
	if(strpos($string,$find)!==FALSE){
		return strpos($string,$find);
	}
	else{
		return -1;
	}
}
/*
	Simple Upload
	@file [STRING]: PHP 파일 변수의 키 값
	@path [STRING]: 업로드 할 경로
	@container : 변수 담을 전역변수
*/

function simpleUpload($file,$path,&$container){
	if($_FILES[$file]['name']!=''){
		$uploaded =  uploadFile($_FILES[$file],$path,'','',$debug);
		$container = $uploaded['path'];
	}
	else{

		
		$container = null;
	}
}

function destroySession($sessions){	
	GLOBAL $session;
	$sessions = explode(',',$sessions);
	foreach($sessions as $sessionName){
		unset($session[$sessionName]);

	}
}
/*
	2016.06.03 Updated.
	플러그인을 불러옴.
*/
function loadPlugin($name){
	GLOBAL $param;
	GLOBAL $melon;
	GLOBAL $session;
	$pluginPath = 'plugins/'.$name;
	include'plugins/'.$name.'/index.php';
}
function alignArray ( $arr,$index) {
	$len = count($arr);

	$arrayAligned = array();
	for  ($bora=0;$bora<$len;$bora++ ){
	
		if(!$arr[$bora][$index]){
			continue;
		}
		if($arrayAligned[$arr[$bora][$index][0]]){
			array_push($arrayAligned[$arr[$bora][$index]],$arr[$bora]);
		
		}
		else{
		
			if($arrayAligned[$arr[$bora][$index]]){
				
				$arrayAligned[$arr[$bora][$index]] = array($arrayAligned[$arr[$bora][$index]],$arr[$bora]);
			}
			else{

				$arrayAligned[$arr[$bora][$index]] = $arr[$bora];
			}
		}

	}
	return $arrayAligned;

}
function caseDisplay($caseArray,$result){
	echo $caseArray[$result];
}
function br(){
	echo '<br>';
}
/*
$data = pageList('board_gallery','',2,10,$param['page'],array('first'=>'<a href="/page/$page">&lt;&lt;</a>','prev'=>'<a href="/page/$page">&lt;</a>','number'=>'<a href="/page/$page">$page</a>','next'=>'<a href="/page/$page">&gt;</a>','last'=>'<a href="/page/$page">&gt;&gt;</a>'));
*/
function pageList($table,$where,$order,$itemNumber,$pageNumber,$currentPage,$pagingTags){
	GLOBAL $melon;
	if(!$currentPage){
		$currentPage = 1;
	}
	$data=getList($table,$where,$itemNumber*($currentPage-1),$itemNumber,$order);
	
	$data['item_total']=getTotal($table,$where);
	$data['pageInfo'] = getPageInfo($data['item_total'],$itemNumber,$pageNumber,$currentPage);
	if(is_string($pagingTags)){
		$pagingTags = str_replace('[url]',$pagingTags,$melon['helper']['pagination']);
	}
	$pageInfo = $data['pageInfo'];
	$data['pagination'] = '';
	if($pagingTags['first']&&$pageInfo['isFirst']){
		$data['pagination'].=str_replace('$page',$pageInfo['firstPage'],$pagingTags['first']);
	}
	if($pagingTags['prev']&&$pageInfo['isPrev']){
		$data['pagination'].=str_replace('$page',$pageInfo['prevPage'],$pagingTags['prev']);
	}
	for($iu=$pageInfo['initPage'];$iu<=$pageInfo['finalPage'];$iu++){
		if($currentPage==$iu){
			$data['pagination'].=str_replace('$page',$iu,$pagingTags['current']);
		}
		else{
			
			$data['pagination'].=str_replace('$page',$iu,$pagingTags['number']);
		}
	}
	if($pagingTags['next']&&$pageInfo['isNext']){
		$data['pagination'].=str_replace('$page',$pageInfo['nextPage'],$pagingTags['next']);
	}
	if($pagingTags['last']&&$pageInfo['isLast']){
		$data['pagination'].=str_replace('$page',$pageInfo['lastPage'],$pagingTags['last']);
	}
	return $data;
}
function pageListSelect($table,$where,$order,$itemNumber,$pageNumber,$currentPage,$pagingTags,$select='*'){
	GLOBAL $melon;
	if(!$currentPage){
		$currentPage = 1;
	}
	$data=getList($table,$where,$itemNumber*($currentPage-1),$itemNumber,$order,$select);
	
	$data['item_total']=getTotal($table,$where);
	$data['pageInfo'] = getPageInfo($data['item_total'],$itemNumber,$pageNumber,$currentPage);
	if(is_string($pagingTags)){
		$pagingTags = str_replace('[url]',$pagingTags,$melon['helper']['pagination']);
	}
	$pageInfo = $data['pageInfo'];
	$data['pagination'] = '';
	if($pagingTags['first']&&$pageInfo['isFirst']){
		$data['pagination'].=str_replace('$page',$pageInfo['firstPage'],$pagingTags['first']);
	}
	if($pagingTags['prev']&&$pageInfo['isPrev']){
		$data['pagination'].=str_replace('$page',$pageInfo['prevPage'],$pagingTags['prev']);
	}
	for($iu=$pageInfo['initPage'];$iu<=$pageInfo['finalPage'];$iu++){
		if($currentPage==$iu){
			$data['pagination'].=str_replace('$page',$iu,$pagingTags['current']);
		}
		else{
			
			$data['pagination'].=str_replace('$page',$iu,$pagingTags['number']);
		}
	}
	if($pagingTags['next']&&$pageInfo['isNext']){
		$data['pagination'].=str_replace('$page',$pageInfo['nextPage'],$pagingTags['next']);
	}
	if($pagingTags['last']&&$pageInfo['isLast']){
		$data['pagination'].=str_replace('$page',$pageInfo['lastPage'],$pagingTags['last']);
	}
	return $data;
}
function pageListJoin($table,$joins,$field,$where,$order,$itemNumber,$pageNumber,$currentPage,$pagingTags){
	GLOBAL $melon;
	if(!$currentPage){
		$currentPage = 1;
	}
	$data=getListJoin($table,$joins,$field,$where,$itemNumber*($currentPage-1),$itemNumber,$order);
	
	$data['item_total']=getTotalJoin($table,$joins,$where);
	$data['pageInfo'] = getPageInfo($data['item_total'],$itemNumber,$pageNumber,$currentPage);
	if(is_string($pagingTags)){
		$pagingTags = str_replace('[url]',$pagingTags,$melon['helper']['pagination']);
	}
	$pageInfo = $data['pageInfo'];
	$data['pagination'] = '';
	
	if($pagingTags['first']&&$pageInfo['isFirst']){

		$data['pagination'].=str_replace('$page',$pageInfo['firstPage'],$pagingTags['first']);
	}
	if($pagingTags['prev']&&$pageInfo['isPrev']){
		$data['pagination'].=str_replace('$page',$pageInfo['prevPage'],$pagingTags['prev']);
	}
	for($iu=$pageInfo['initPage'];$iu<=$pageInfo['finalPage'];$iu++){
		if($currentPage==$iu){
			$data['pagination'].=str_replace('$page',$iu,$pagingTags['current']);
		}
		else{
			
			$data['pagination'].=str_replace('$page',$iu,$pagingTags['number']);
		}
	}
	if($pagingTags['next']&&$pageInfo['isNext']){
		$data['pagination'].=str_replace('$page',$pageInfo['nextPage'],$pagingTags['next']);
	}
	if($pagingTags['last']&&$pageInfo['isLast']){
		$data['pagination'].=str_replace('$page',$pageInfo['lastPage'],$pagingTags['last']);
	}
	return $data;
}
function generateCode($length,$options=''){  
	$characters  = "0123456789";  
	$characters .= "abcdefghijklmnopqrstuvwxyz";  
	//$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
	if($options!=''){
		$characters='';
		if(strpos($options,'shorthand')!==false){
			if(strpos($options,'number')!==false){
				$characters.='0123456789';
			}
			if(strpos($options,'lowercase')!==false){
				$characters.='abcdefghijklmnopqrstuvwxyz';
			}
			if(strpos($options,'uppercase')!==false){
				$characters.='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			}
			if(strpos($options,'special')!==false){
				$characters.='!@#$%^&*()';
			}
		}
		else{
			$characters = $options;
		}
	}

	  
	$string_generated = "";  
	$nmr_loops = $length;  
	$characterLen = strlen($characters);
	while ($nmr_loops--)  
	{  
		$string_generated .= $characters[mt_rand(0, $characterLen-1)];  
	}  
	  
	return $string_generated;  
} 
function conditionDisplay($condition,$result='',$opponentResult=''){
	if($result==''){
		$result = $condition;
	}
	if($condition){
		echo $result;
	}
	else{
		echo $opponentResult;
	}
}
function duplicatePage($path){
	include 'controllers/'.$path.'.php';
}
function getDateInfo($base=null){
	$dateInfo = array();
	if($base['year']){
		$dateInfo['year']=$base['year'];
	}
	else{
		$dateInfo['year']=date('Y');
	}
	if($base['month']){
		$dateInfo['month']=$base['month'];
	}
	else{
		$dateInfo['month']=date('m');
	}
	if($base['date']){
		$date=$base['date'];
	}
	else{
		$date=date('d');
	}
	$dateInfo['date'] = $date;
	$dateInfo['today'] = $dateInfo['year'].'-'.$dateInfo['month'].'-'.$date;
	$prevDateTime=mktime(0, 0, 0, $dateInfo['month']-1, 1, $dateInfo['year']); //이전월 객체
	$dateInfo['prevYear']=date('Y',$prevDateTime);
	$dateInfo['prevMonth']=date('m',$prevDateTime);
	$nextDateTime=mktime(0, 0, 0, $dateInfo['month']+1, 1, $dateInfo['year']); //다음월 객체
	$dateInfo['nextYear']=date('Y',$nextDateTime);
	$dateInfo['nextMonth']=date('m',$nextDateTime);
	$firstDateTime=mktime(0, 0, 0, $dateInfo['month'], 1, $dateInfo['year']);//현재월 객체
	$dateInfo['firstDate']= date("w", $firstDateTime);
	$dateInfo['lastDate']=date('t',$firstDateTime);
	$dateInfo['validDate']=$dateInfo['lastDate']+$dateInfo['firstDate'];//유효한 총 일수
	$dateInfo['emptyLength'] = (7-($dateInfo['validDate'])%7)%7;
	return $dateInfo;
}
/*
(
    [year] => 2014
    [month] => 03
    [prevYear] => 2014
    [prevMonth] => 02
    [nextYear] => 2014
    [nextMonth] => 04
    [firstDate] => 6
    [lastDate] => 31
    [validDate] => 37
    [emptyLength] => 5
)
$dateInfo = extract (getDateInfo($param) );
		<div id="buttons">
		<a href="?year=<?=$prevYear?>&month=<?=$prevMonth?>" id="prev_button">이전 달</a>
<a href="?year=<?=$nextYear?>&month=<?=$nextMonth?>" id="next_button">다음 달</a>
		</div>
		
<table id="calendar" >
	<caption>
		<?=$year?>년 <?=$month?>월
	</caption>
	<tr>
		<th>일</th>
		<th>월</th>
		<th>화</th>
		<th>수</th>
		<th>목</th>
		<th>금</th>
		<th>토</th>
	</tr>
	<tr>
		<?php
			
	
			$block1='';
			for($iu=0;$iu<$firstDate;$iu++){
				$block1='<td></td>'.$block1;
			}
			$block2='';
			for($iu=0;$iu<$emptyLength;$iu++){
				$block2='<td></td>'.$block2;
			}
			echo $block1;
			for($iu=$firstDate;$iu<$validDate;$iu++){	
				$currentDate = $iu+1-$firstDate;

		?>
			<td  <?=attr($currentDate==$date,'class="today"')?><?=attr($iu%7==0,'class="sunday"')?> <?=attr($iu%7==6,'class="saturday"')?>><?=$currentDate?></td>
		<?php	
			if($iu%7==6){
				echo '</tr><tr>';
			}
		
		}
		echo $block2; //마지막 빈블럭 출력
		?>
	</tr>
</table>
<style type="text/css">
	table th,td{
		border:1px solid black;
	}
	.sunday{
		color:red;
	}
	.saturday{
		color:blue;
	}
	.today{
		background:red;
	}
	#calendar th{
		height:40px;
	}
		#calendar caption{
			line-height:69px;
			font-size:22px;
		}
	#calendar{
		width:100%;
	}
	#calendar td{
		height:100px;
		font-size:17px;
	}
	#prev_button{
		font-size:20px;
		float:left;
	}
	#next_button{
		font-size:20px;
		float:right;
	}

</style>
*/
function progressiveDate($startDate,$endDate,$currentDate=null){
   if(!$currentDate){
      $currentDate=date('Y-m-d');
   }
   if(gettype($startDate)=='integer'){
      $startDate=date('Y-m-d',$startDate);
   }
   if(gettype($endDate)=='integer'){
      $endDate=date('Y-m-d',$endDate);
   }
   if($startDate>$currentDate){ //시작일보다 현재일이 작을경우
      return 0;//진행전
   }
   if($endDate>$currentDate&&$startDate<$currentDate){ //시작일보단 크지만 완료일보다 작을경우
      return 1; //진행중
   }
   if($endDate<$currentDate){ //현재일이 끝일보다 클경우
      return 2;//진행완료
   }
   
}
/**
 * 
 * 파일이 있을 경우 스크립트 파일을 로드함.
 */
function loadScript($path,$condition=true){
	if(is_file($_SERVER['DOCUMENT_ROOT'].$path)&&$condition){
		echo '<script type="text/javascript" src="'.$path.'"></script>';
	}
}
/**
 * 
 * 파일이 있을 경우 스타일 파일을 로드함.
 */
function loadStyle($path){
	if(is_file($_SERVER['DOCUMENT_ROOT'].$path)){
		echo '<link rel="stylesheet" href="'.$path.'">';
	}
}
/**
 * 
 * 자주쓰는 날짜형식을 차용함.
 */
function dateFormat($dateString,$dateFormat=null){
   if(!$dateFormat){
      $dateString = substr($dateString,0,11);
   }
   else{
	   if(strpos($dateFormat,'kw')!==FALSE){

		  $week = array("일", "월", "화", "수", "목", "금", "토");
		  $result = $week[date("w",strtotime($dateString))];
			
		 $dateFormat =  str_replace('kw',$result,$dateFormat);
	   }
      $dateString = date($dateFormat,strtotime($dateString));
   }
   return $dateString;
}

function benchmark($inittime=null,$endtime=null){
	GLOBAL $melon;
	if($inittime!=null && $endtime!=null){
		return getDifferenceMicrotime($inittime,$endtime);
	}else if($inittime!=null){
		$melon["benchmarktime"] = microtime();
		return getDifferenceMicrotime($inittime,$melon["benchmarktime"]);
	}else if(isset($melon["benchmarktime"])){
		$inittime = $melon["benchmarktime"];
		$melon["benchmarktime"] = microtime();
		return getDifferenceMicrotime($inittime,$melon["benchmarktime"]);
	}else{
		$melon["benchmarktime"] = microtime();
		return 0;
	}
}
/**
 * 입력한 시간 차이를 구합니다.
 * @param number $_start microtime()로 측정한 시작시간
 * @param number $_end microtime()로 측정한 끝시간
 * @return number 시간 차이를 계산해 반환합니다.
 */
function getDifferenceMicrotime($_start, $_end)
{
  $end = explode(' ', $_end);
  $start = explode(' ', $_start);

  return sprintf('%.4f', ($end[1]+$end[0])-($start[1]+$start[0]));
}


/**
 * 파일을 지정한 이름으로 다운로드하도록 강제합니다.
 * @param string $path 파일을 불러올 경로입니다.
 * @param string $name 강제로 다운로드하도록 지정할 이름입니다. 
 */
function forceDownload($path,$name=null){
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',getBaseName($name)).";");
	if(substr($path,0,1)=='/'){
		$path=$_SERVER["DOCUMENT_ROOT"].$path;
	}
	readfile($path);
	flush();
}
/**
 * 운영체제가 윈도우일 경우 경로를 적절히 바꿔준다.
 * @param string $path 원래의 경로
 * @return string 변환된 경로
 */
function getBasename($path) { 
	$pattern = (strncasecmp(PHP_OS, 'WIN', 3) ? '/([^\/]+)[\/]*$/' : '/([^\/\\\\]+)[\/\\\\]*$/'); 
	if (preg_match($pattern, $path, $matches)){
		return $matches[1];
	} 
	return ''; 
}
/**
 * 문단의 요약을 구한다.
 * @param string 문단 문자열.
 * @param int 요약문의 글자 바이트수.
 * @param string 요약문 문미에 붙을 추임새.
 * @return string 요약된 문단
 */
function getSummary($text, $len,$suffix="…",$newLine=true){
	$text = strip_tags($text);// htmlspecialchars_decode(strip_tags($text));
	if($newLine){
		preg_replace('/\r\n|\r|\n/','',$text); //개행제거
	}
	if(strlen($text)<=$len) {
		return $text;
	} else {
		$text = mb_strcut($text, 0, $len, 'utf-8');
		return $text.$suffix;
	}
}

/**
 * 문자열 날짜를 이용해서 상대시간을 구한다.
 * @param string 날짜 형식의 문자열
 * @param string 상대시간이 20초 이하의 시간일 때 출력 될 문자열
 * @return string 계산된 상대시간
 */
function getRelativeDate($date,$current="지금 막") {
 $dtDiff = time() - strtotime($date);
 if($dtDiff < 20) $rs =$current;
 else if($dtDiff < 60) $rs = intval($dtDiff) . "초전";
 else if($dtDiff < 60*60) $rs = intval($dtDiff / (60)) . "분전";
 else if($dtDiff < 60*60*24) $rs = intval($dtDiff / (60*60)) . "시간전";
 else if($dtDiff < 60*60*24*7) $rs = intval($dtDiff / (60*60*24)) . "일전";
 else if($dtDiff < 60*60*24*30) $rs = intval($dtDiff / (60*60*24*7)) . "주전";
 else if($dtDiff < 60*60*24*365) $rs = intval($dtDiff / (60*60*24*30)) . "달전";
 else $rs = intval($dtDiff / (60*60*24*365)) . "년전";
 return $rs;
}
/**
 * 자바스크립트 변수를 출력한다.
 * @param string 출력 할 자바스크립트 변수명 / array 출력 할 자바스크립트 변수의 키, 값 쌍
 * @param string 출력 할 자바스크립트 변수 값
 */
function printJsVariable($key,$value=null){
	echo "<script>";
	$variable="";
	if(is_array($key)){
		foreach($key as $name=>$value){
			$variable.="var $name='$value';";
		}
	}
	else{
		$variable.="var $key='$value';";
	}
	echo "$variable</script>";
}
/**
 * 변수를 멜론 콘솔에 출력한다.
 * @param * 출력 할 변수.
 * @param boolean 함수 실행 만으로 출력 할지 아닐지 여부. false 일 경우 단축키 t를 이용해서 출력. 
 */
function console($data,$display=false){
	$a=print_r($data,true);
	if($display){
		$display="block";
	}
	else{
		$display="none";
	}
	echo "<meta charset='utf-8'><pre id='melon_trace' style='z-index:5001;border-top:5px solid pink;border-bottom:5px solid pink;font-family:malgun gothic;display:$display;padding-left:5px;position:fixed;top:0;left:0;background:white;width:100%;height:100%;overflow-y:scroll'><h3 style='border:1px solid black;padding:2px 5px;margin-left:5px;float:left;'>MELON CONSOLE</h3><div style='clear:both'></div>$a</pre><script src='http://code.jquery.com/jquery-1.8.3.min.js'></script><script>$('#melon_trace').appendTo('body');$(document).keydown(function(e){if(e.keyCode==84){\$('#melon_trace').fadeToggle();}});</script>";
}
/**
 * 조건에 부합 할 시 HTML 속성을 출력한다.
 * @param boolean 출력 하고자 하는 조건.
 * @param string 속성의 이름. 기본값은 "selected".
 * @param string 속성의 값.
 */
function attr($condition,$attr="selected",$attrOpponent=''){
	if($condition){
		echo $attr;
	}
	else{
		echo $attrOpponent;
	}
}
/**
 * 배열의 내용을 <xmp>태그를 이용하여 출력
 *
 * @param array print_array						출력 배열
 */
function print_x($print_array) {
	echo('<xmp>');
	print_r($print_array);
	echo('</xmp>');
}
/**
 * 입력된 배열 
 *
 * @param array check_array					implode를 체크할 함수
 * @return boolean							가능/불가능 반환값
 */
function is_empty_array($array) {

	if (is_array($array) === TRUE && count($array) > 0) {
		return FALSE;
	}

	return TRUE;

}

/**
 * 해당 변수를 브라우저 경고창에 출력한다.
 * @param * 출력 할 변수.
 */

function alert($message){
	echo "<meta charset=\"utf-8\"><script>alert('$message')</script>";
}
/**
 * 페이지를 이동시킨다.
 * @param string 이동 할 URL. 입력 하지 않을 시 브라우저의 history 이용하여 이전 페이지로 이동.
 */

function getBack($url="")
{
	$result = "<meta charset=\"utf-8\"><script type=\"text/javascript\">";
	if($url=="")
	{
		$result .= "history.back(-1);";
	}
	else
	{
		$result .= "location.replace('".$url."');";
	}
	$result .= "</script>";
	echo $result;
}
/**
 * 변수가 비어있을 경우 채운다. 
 * @param * 변수명
 * @param * 비어있을 경우 채울 값. 기본 값은 1.
 */
function fillEmptyParam(&$value,$revised=1){
	if(empty($value)){
		$value=$revised;
	}
	return $value;
}
/**
 * 변수가 비어있을 경우 페이지를 이동시킨다.
 * @param * 변수명
 * @param * 이동시킬 페이지
 */
function emptyParam($value,$url="",$message="잘못된 접근입니다."){
	if(empty($value)){
		printMessage($message,$url);
		exit;
	}
}	
/**
 * 키, 값 쌍을 받아서 키를 값으로 전환한다.
 * @param * 변수명.
 * @param array 키에 대응되는 키, 값 쌍 배열.
 */
function stringFilter(&$item,$arr){
	$item=$arr[$item];
	return $item;
}
/**
 * 경로, 조건 문자열을 키 값 쌍에 알맞게 만든다.
 * @param String 경로 변수.
 * @param String 조건문 변수.
 * @param String 추가 할 key 값.
 * @param String 추가 할 value 값.
 * @param String 조건문에 사용 될 %의 위치. front, both, back,equal 중 하나 입력. 기본 값은 both.
 * @param String 추가 될 조건문의 성질. 이전에 작성 된 조건문과의 관계를 묻는다. AND, OR.
 * @param Boolean 앞에 붙을 문자를 강제로 &로
 * @param String 조건문 문자열 맨 앞에 추가 될 문자열. 괄호 등을 추가할수 있다.
 * @param String 조건문 문자열 맨 끝에 추가 될 문자열. 괄호 등을 추가할수 있다.
 * 사용 예)  
 * $where = ""
 * $path = "";
 * addCondition($where,$path,"name","enara");
 * $where-> "AND 
 */
/*function addCondition(&$path,&$where,$key,$value,$isLike="both",$whereType="AND",$absolute=null,$start="",$end=""){
	GLOBAL $melon;
	$parseURI=$melon['helper']['uri'];
	if($path==""&&!$absolute){
		$pathInitial="?";
	}
	else{
		$pathInitial='&';
	}
	
	if($where==""){
		$initial=$where;
	}
	else{
		if($whereType==""){
			$whereType="AND";
		}
		$initial=$whereType;
	}
		switch($isLike){
			default: $result="'%$value%'";break;
			case "both": $result="'%$value%'";break;
			case "front":$result="'%$value'";break;
			case "back": $result="'$value%'";break;
			case "equal":$result="'$value'";$equalType="=";break;
		}
	if($parseURI){
		$path.=('/'.$key.'/'.$value);
	}
	else{
		$path.=$pathInitial.$key.'='.$value;
	}
	$where.=(" $initial $start".$key." like ".$result.$end);
}*/
/**
 * 검색 조건을 위한 type, keyword를 이용한 경로, 조건 문자열을 만든다. 
 * @param String 경로 변수.
 * @param String 조건문 변수.
 * @param String 추가 할 type 값, 여러개 일 경우 ,(comma)를 통해 구분 가능.
 * @param String 추가 할 keyword 값.
 * @param String, Array 추가 할 type이 여러 개 일 경우 문자열하나로 치환 또는 배열을 이용해서 치환가능.
 * @param Boolean 경로에 무조건 &을 붙일지 여부. false 일 경우 이전 문자열을 보고 판단하여 ?인지 &인지 결정.
	ex)
			$where="";
			$path="";
			addKeywordPosition($path,$where,'이나라학생','name,contact',$return);
			

 */

 function addKeywordCondition(&$path,&$where,$searchType,$searchKeyword,$pathType=false){
	if($searchType&&$searchKeyword){
		if($pathType){
			$path.='/search_type/'.$searchType.'/search_keyword/'.$searchKeyword;
		}
		else{
			if($path==''){
				$path = '?';
			}
			else{
				$path .= '&';
			}
			$path.='search_type='.$searchType.'&search_keyword='.$searchKeyword;
		}
		if($where!=''){
			$where.=' AND ';
		}
		$where.=($searchType.' like "%'.$searchKeyword.'%"');
	}
}

// ※단순히 where문에 추가하는 것으로, $path 변경시 직접추가해주어야 한다.
function addCondition(&$where,$whereClause,$operator='AND'){
		if($where!=''){
			$where.=' '.$operator.' ';
		}
		$where.=$whereClause;
	}
/*
function addKeywordCondition(&$path,&$where,$type,$keyword,$return="all",$absolute=null){
	GLOBAL $melon;
	$parseURI=$melon['helper']['uri'];
	if(is_array($return)){
		$return=$return[$type];
	}
	if(strpos($type,",")){
		$type=explode(",",$type);
		$len=count($type);
		$multiple='(';
	}
	if($path==""){
		$pathInitial="?";
	}
	else{
		$pathInitial="&";
	}
	if($absolute){
		$pathInitial="&";
	}
	if($where==""){
		$initial=$multiple;
	}
	else{
		$initial=" AND ";
	}
	if($len>1){
		$count=0;
		$where=$where.$initial;
		for($iu=0;$iu<$len;$iu++){
			$typeEach=$type[$iu];
			if($count!=0){
				$where.=" OR ";
			}
			$where.="$typeEach like '%$keyword%'";
			$count++;
		}
		$where.=')';
		if($parseURI){
			$path.=('/type/'.$return.'/keyword/'.$keyword);
		}
		else{
			$path.=$pathInitial."type=$return&keyword=$keyword";
		}
	}
	else{
		if($parseURI){
			$path.=('/type/'.$type.'/keyword/'.$keyword);
		}
		else{
				$path.=$pathInitial."type=$type&keyword=$keyword";
		}
		$where.=$initial."$type like '%$keyword%'";
	}
}*/
/*
 * 현재 페이지에 대한 정보를 배열로 반환
 *
 * @param Integer $itemTotal 가져 오는 데이터의 총 갯수 (Essential)
 * @param Integer $itemNum 한 페이지 당 보여 줄 항목 갯수 (Essential)
 * @param Integer $pageNum 표시할 페이지네이션의 갯수 (Essential)
 * @param Integer $currentPage 현재 페이지의 값 (Essential)
 * @return Array 
	-currentPage - 현재 페이지
	-initPage - 페이지네이션의 시작 값
	-finalPage - 페이지네이션의 마지막 값
	-prevPage - 이전 페이지의 값
	-nextPage - 다음 페이지의 값
	-firstPage - 첫페이지의 값. 1
	-lastPage - 마지막 페이지의 값
	-isFirst - 첫 페이지로 가는 네비게이션 표시여부
	-isPrev - 이전페이지로 가는 네비게이션 표시여부
	-isNext- 다음 페이지로 가는 네비게이션 표시여부
	-isLast- 마지막 페이지로가는 네비게이션 표시여부
 */
function getPageInfo($itemTotal,$itemNum,$pageNum,$currentPage){
	$result = array(
		"currentPage"=>$currentPage,
		"initPage"=> (floor(($currentPage-1)/$pageNum)*$pageNum)+1,
		"finalPage"=>(floor(($currentPage-1)/$pageNum)+1)*$pageNum,
		"prevPage"=>((floor(($currentPage-1)/$pageNum))*$pageNum),
		"nextPage"=>(floor(($currentPage-1)/$pageNum)+1)*$pageNum+1,
		"firstPage"=>1,
		"lastPage"=>ceil($itemTotal/$itemNum)
	);
	if($result["currentPage"]<=$pageNum){
		$result["isPrev"]=false;
		$result["isFirst"]=false;
	}
	else{
		$result["isPrev"]=true;
		$result["isFirst"]=true;
	}
	if($result["currentPage"]>=floor(($result["lastPage"]-1)/$pageNum)*$pageNum+1){
		$result["isNext"]=false;
		$result["isLast"]=false;
	}
	else{
		$result["isNext"]=true;
		$result["isLast"]=true;
	}
	if($result["lastPage"]<=$result["finalPage"]){
		$result["finalPage"]=$result["lastPage"];
	}
	return $result;
}
/**
 * 브라우저 경고창에 문자열 출력후 페이지 이동.
 * @param String 출력 할 메세지.
 * @param String 이동 할 URL. 입력 하지 않을 시 브라우저의 history 이용하여 이전 페이지로 이동.
 */
 
function printMessage($message="",$url="")
{

	$result = "<meta charset=\"utf-8\"><script type=\"text/javascript\">";
	if($message!="")
	{
		$result .= "alert('".$message."');";
	}
	
	if($url=="")
	{
		$result .= "history.back(-1);";
	}
	else
	{
		$result .= "location.replace('".$url."');";
	}
	$result .= "</script>";
	
	echo $result;
}
/**
 * 브라우저 경고창에 문자열 출력하거나 하지 않고 페이지 이동.

 * @param String 이동 할 URL. 입력 하지 않을 시 브라우저의 history 이용하여 이전 페이지로 이동.
 * @param String 출력 할 메세지.
 */
 
function redirect($url="",$message="")
{

	$result = "<meta charset=\"utf-8\"><script type=\"text/javascript\">";
	if($message!="")
	{
		$result .= "alert('".$message."');";
	}
	
	if($url=="")
	{
		$result .= "history.back(-1);";
	}
	else
	{
		$result .= "location.replace('".$url."');";
	}
	$result .= "</script>";
	
	echo $result;
}
/**
 * 파일을 읽어들인다.
 * @param * 읽을 파일의 상대/절대 경로.
 * @return String 읽은 파일의 문자열.
 */
function readUTF8File($path){
	$fp = fopen($path,"r");
	$result = fread($fp,filesize($path));
	fclose($fp);
	
	return $result;
}
 /**
 * 파일을 열어서 작성한다.
 * @param String 쓸 파일의 상대/절대 경로.
 * @param String 작성 할 내용 문자열.
 */
function writeUTF8File($path,$content){
	$fp = fopen($path,"wb+");
	fwrite($fp,$content);
	fclose($fp);
}

function trace(){
	GLOBAL $melon;
	
	$result = "";
	if($melon['debug']=="DEBUG"){
		$trace = debug_backtrace();
		$len = count($trace);
		for($iu=$len-1;$iu>=0;$iu--){
			$item = $trace[$iu];
			if($item["function"]=="trace"){$item["function"]="";}
			else{$item["function"].="()";}
			$result .= " at ".$item["file"]." on <b>line ".$item["line"]."</b><br>".$item["function"];
		}
	}
	return $result;
}

/**
     * POST로 받은 $_FILES의 하나, 또는 복수를 저장한다.
     * @param Array $_FILES
	 * @param String 저장 경로, 루트절대경로로 입력한다. ex) /images/thumb
     * @return Array name=>원래 파일명, path=>저장된 파일명 
     */
//	 $data=array("table"=>"table_notice",array());

/*
	@file [STRING / OBJECT]: $_FILES 변수.
	@path [STRING]:업로드할 경로
	@whiteList [STRING] : 화이트리스트 사용시 기재, 컴마 등으로 구분 (ex : png,jpg)
	@message [STRING] : 화이트리스트 사용시 메세지.
	@debug [BOOLEAN] : 디버깅메세지 보기
*/
function uploadFile($file,$path,$whiteList='',$message='',$debug=false){
	GLOBAL $melon;
	$errors = array(
	 '','업로드한 파일이 php.ini upload_max_filesize 지시어보다 큽니다.',
		'업로드한 파일이 HTML 폼에서 지정한 MAX_FILE_SIZE 지시어보다 큽니다.',
		'파일이 일부분만 전송되었습니다.','파일이 전송되지 않았습니다.',
		'임시 폴더가 없습니다.','디스크에 파일 쓰기를 실패했습니다. ',
		'확장에 의해 파일 업로드가 중지되었습니다.');
	
	$len=count($file["name"]);
	$result=array();

	if(gettype($file)=='string'){
		$file = $_FILES[$file];
	}

	
	/*
		디렉토리 자동생성
	*/
	$pathCheckTotal = $_SERVER['document_root'];
	$pathChecks = explode('/',$path);
	foreach($pathChecks as $key=> $pathCheck){
		if($pathCheck!=''){
			$pathCheckTotal = $pathCheckTotal.'/'.$pathCheck;
			if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/'.$pathCheckTotal)){
				mkdir($_SERVER['DOCUMENT_ROOT'].$pathCheckTotal,0707);
				
			}
		}
	}


	if(is_array($file["name"])){  
		for($iu=0;$iu<$len;$iu++){
			$fileinfo = pathinfo($file['name'][$iu]);
			$extension=$fileinfo["extension"];
			
			if($file['name'][$iu]!=''){  //파일이 없으면 확장자 검사 할 필요 없음.
				if($whiteList&&strpos($whiteList,$extension)===FALSE){
					if(!$message){
						$message=$whiteList.' 파일만 업로드 하실 수 있습니다.';
					}
					printMessage($message);
					exit;
				}
				if(strpos($melon['upload']['filter'],$extension)!==FALSE){
					printMessage($extension.'파일은 업로드 하실 수 없습니다.');
					exit;
				}
			}
			$filename = md5(time().$data['0']['Auto_increment'].rand(0,10000)).".".strtolower($fileinfo["extension"]);
			move_uploaded_file($file["tmp_name"][$iu],$_SERVER['DOCUMENT_ROOT'].$path."/".$filename);
			if($file['error'][$iu]){
				if($debug){
					echo '<div>[Melon Error] <br> Location: Upload <br>Comment : Upload No '.($iu+1).' Error '.$file['error'][$iu].'=>'.$errors[$file['error'][$iu]].'</div>';
				}
				$result[$iu] = null;
			}
			else if($file['name'][$iu]){
				$result[$iu]['name']=$file['name'][$iu];
				$result[$iu]['path']=$filename;
				$result[$iu]['type']=$file['type'][$iu];
			}
		}
	}
	else{
		$fileinfo = pathinfo($file['name']);
		$extension=$fileinfo["extension"];
		if($file['name']!=''){ //파일이 없으면 확장자 검사 할 필요 없음.
			if($whiteList&&strpos($whiteList,$extension)===FALSE){
				if(!$message){
					$message=$whiteList.' 파일만 업로드 하실 수 있습니다.';
				}
				printMessage($message);
				exit;
			}
			if(strpos($melon['upload']['filter'],$extension)!==FALSE){
				printMessage($extension.'파일은 업로드 하실 수 없습니다.');
				exit;
			}
		}
		$filename = md5(time().$data['0']['Auto_increment'].rand(0,10000)).".".strtolower($fileinfo["extension"]);
		move_uploaded_file($file["tmp_name"],$_SERVER['DOCUMENT_ROOT'].$path."/".$filename);

		if($file['error']&&$debug){
			echo '<div>[Melon Error] <br> Location: Upload <br>Comment : Upload Error '.$file['error'].'=>'.$errors[$file['error']].'</div>';
			return false;
		}
		/*if(isset($data)){
			if(isset($data[1])){
				$param[$data[1]]=$filename;
			}
			if(isset($data[2])){
				$param[$data[2]]=$file['name'];
			}
			$no=insertItem($data[0],$param);
			$result['no']=$no;
		}*/
		$result['name']=$file['name'];
		$result['path']=$filename;
		$result['type']=$file['type'];
	}
	return $result;
}
//	createThumbnail("1.jpg",1500,1500,1,"images/3.jpg");
//$imageInfo=getImageInfo("1.jpg");
//stampImage($imageInfo[0],$imageInfo[1],$imageInfo[2],"test.jpg",8,100,150);
/**
 * 이미지 경로로부터 이미지의 리소스를 구한다.
 * @param 이미지의 경로
 * @return array 해당 이미지의 리소스, 넓이, 높이, 타입, 속성
 */
function getImageInfo ($path_file){
	if(substr($path_file,0,1)=='/'){
		$path_file=$_SERVER["DOCUMENT_ROOT"].$path_file;
	}
	$size = @getimagesize($path_file);
	switch($size[2]){//image type에 따라 이미지 리소스를 생성한다.
		case 1 : //gif
			$image = @imagecreatefromgif($path_file);
			break;
		case 2 : //jpg
			$image = @imagecreatefromjpeg($path_file);
			break;
		case 3 : //png
			$image = @imagecreatefrompng($path_file);
			break;
	}
		$result = $size;
		$result[0] = $image;
		$result[1] = $size[0];//너비
		$result[2] = $size[1];//높이
		$result[3] = $size[2];//이미지타입
		$result[4] = $size[3];//이미지 attribute
		return $result;
}
/**
 * 이미지 리소스를 이용하여 이미지를 저장한다.
 * @param resource 이미지의 리소스
 * @param string 저장 하고자 하는 경로
 * @param string 이미지의 퀄리티. 기본 값은 100이다.
 * @return boolean 저장 성공 여부.
 */
function saveImage ($image, $path_save_file, $quality=100){
	if(substr($path_save_file,0,1)=='/'){
		$path_save_file=$_SERVER["DOCUMENT_ROOT"].$path_save_file;
	}
	$path_save_dir = dirname($path_save_file);//저장 파일 경로에서 상위 디렉토리 경로를 가져옴
	if (!is_writable($path_save_dir)){//해당 디렉토리에 파일을 저장할 권한이 없다면
	   echo 'Permission denied.';
		return false;
	}
	if (is_file($path_save_file)){//같은 이름의 파일이 존재하면
		$result_unlink = @unlink($path_save_file);
		if ($result_unlink === false) {//기존 이미지 삭제에 실패
			echo "Delete Permisition denied.";
			return false;
		}
	}
	//파일명에서 마지막 . 을 기준으로 확장자를 가져와서 소문자로 변환
	$extension = strtolower(substr($path_save_file, strrpos($path_save_file, '.') + 1));

	switch($extension){//확장자에 따라 이미지 저장 처리
		case 'gif' :
			$result_save = @imagegif($image, $path_save_file);
			break;
		case 'jpg' :
		case 'jpeg' :
			$result_save = @imagejpeg($image, $path_save_file, $quality);
			break;
		default : //확장자 png 또는 확장자가 없는 경우, 정의되지 않는 확장자인 경우는 모두 png로 저장
			$result_save = @imagepng($image, $path_save_file);
	}
	if ($result_save === false) {//이미지 저장에 실패
		echo "failed";
		return false;
	}
	else {//이미지 저장에 성공
		return true;
	}
}	
/**
 * 이미지 리소스를 이용하여 썸네일을 생성한다.
 * @param resource 이미지의 리소스
 * @param int 원본 이미지의 넓이.
 * @param int 원본 이미지의 높이.
 * @param int 생성하려는 썸네일의 넓이.
 * @param int 생성하려는 썸네일의 높이.
 * @param int 썸네일 생성 방식. 0=자르기 사용안함, 1=상단(왼쪽) 자름 2=중간자름 3=하단(오른쪽) 자름
 * @return resource 이미지의 리소스.
 */
function getThumbnail($image,$width,$height,$thumbWidth,$thumbHeight,$cut){
	$thumb=imagecreatetruecolor($thumbWidth,$thumbHeight);
	$tempWidth=($height/$thumbHeight)*$thumbWidth; // 썸네일이 원본이었을 경우 가로 길이 계산.
	$tempHeight=($width/$thumbWidth)*$thumbHeight;//썸네일이 원본 이었을 경우 세로의 길이 계산.
	if($cut!=0){
		if($tempHeight>$height){ //임시 높이가 실 원본보다 큰 경우,  가로를 잘라야함.
			$y=0;
			switch($cut){
				case 1: $x=0;
						break;
				case 2:$x=($width-$tempWidth)/2;
						break;
				case 3:$x=$width-$tempWidth;
						break;
			}
			$thumbWidth=($thumbHeight/$height)*$width;
		}
		else if($tempHeight<$height){//임시높이가 실 원본보다 작은 경우, 세로를 잘라야함.
			$x=0;
			switch($cut){
				case 1: $y=0;
						break;
				case 2:$y=($height-$tempHeight)/2;
						break;
				case 3:$y=$height-$tempHeight;
						break;
			}
			$thumbHeight=($thumbWidth/$width)*$height;
		}
	}
	else{
		$x=0;
		$y=0;
	}
	$result = imagecopyresampled ($thumb , $image, 0 , 0 , $x , $y , $thumbWidth ,$thumbHeight, $width , $height);
	return $thumb;
}
/**

 * 이미지 리소스를 이용하여 워터마크를 찍는다.
 * @param Resource 원본 이미지 리소스.
 * @param int 원본 이미지의 넓이.
 * @param int 원본 이미지의 높이.
 * @param String 워터마크 이미지의 경로.
 * @param int 기준, 3,5,6,7,8의 경우 x좌표 및 y좌표는 하단부터 적용될수 있다.
 *            ┌────┐
			  │ 1 2 3  │
			  │ 4 0 5  │
			  │ 6 7 8  │
			  └────┘
 * @param int 기준으로부터의 x좌표.
 * @param int 기준으로부터의 y좌표.`
 * @return resource 워터마크 처리된 이미지의 리소스.
 */
function stampImage($image,$width,$height,$path,$standard,$x=0,$y=0){
	$mark=getImageInfo($path);
	list($mark,$markWidth,$markHeight)=$mark;
	switch($standard){
		case 0 :
			$x=$x+($width-$markWidth)/2;
			$y=$y+($height-$markHeight)/2;
			break;
		case 1 : break;
		case 2 : $x=$x+($width-$markWidth)/2;
				 break;
		case 3 : $x=$width-$markWidth-$x;
				 break;
		case 4 : $y=$y+($height-$markHeight)/2;
				 break;
		case 5 : $x=$width-$markWidth-$x;
				 $y=$y+($height-$markHeight)/2;
				 break;
		case 6 : $y=$height-$markHeight-$y;
				 break;
		case 7 : $x=$x+($width-$markWidth)/2;
				 $y=$height-$markHeight-$y;
				 break;
		case 8 : $x=$width-$markWidth-$x;
				 $y=$height-$markHeight-$y;
				 break;
		
	}
	imagecopymerge ( $image , $mark ,$x,$y, 0,0, $markWidth,$markHeight, 100);
	return $image;
}
/**
 * 경로, 넓이, 높이를 이용하여 썸네일을 저장한다.
 * @param String 원본 이미지의 경로.
 * @param int 썸네일의 넓이.
 * @param int 썸네일의 높이.
 * @param int 썸네일 생성 방식.  0=자르기 사용안함, 1=상단(왼쪽) 자름 2=중간자름 3=하단(오른쪽) 자름
 * @param String 저장 경로.
 * @return Boolean 저장 성공 여부.
 */
function createThumbnail($path,$width,$height,$type,$savePath){
	$imageInfo=getImageInfo($path);
	$image=getThumbnail($imageInfo[0],$imageInfo[1],$imageInfo[2],$width,$height,$type);
	return saveImage($image,$savePath);
}       
/**
 * 비율이 같은 작아진 썸네일을 저장한다.
 * @param String 원본 이미지의 경로.
 * @param string/float 줄이는 비율 또는 크기. 비율시 0.5 / 가로시 width = 500, 세로시 height =300 같은 식으로 사용.
 * @param String 저장 경로.
 * @return Boolean 저장 성공 여부.
 */
function createResizedImage($path,$size,$savePath){
	$imageInfo=getImageInfo($path);

	if(gettype($size)=='string'){
		if(strpos($size,'width')!==FALSE){
			$width = str_replace('width=','',$size);
			$height = $width*$imageInfo[2]/$imageInfo[1];
		
		}
		else{
			
			$height = str_replace('height=','',$size);
			$width = $height*$imageInfo[1]/$imageInfo[2];
		}
	}
	else{
		$width = $imageInfo[1] * $size;
		$height = $imageInfo[2] * $size;
	}
	$image=getThumbnail($imageInfo[0],$imageInfo[1],$imageInfo[2],$width,$height,0);
	return saveImage($image,$savePath);
}  
/**
 * JSON API 형태로 성공 메세지를 출력한다.
 * @param string $result 출력 메세지
 * @param string $message 메세지 유형
 * @return string 성공메세지를 JSON으로 엮은 문자열
 */
function jsonMessage($result,$message=null)
{
	if($message){
		echo "{\"result\":\"".$result."\",\"message\":\"".$message."\"}";
	}
	else{
		echo "{\"result\":\"".$result."\"}";
	}
}
/**
 * 메일 발송
 *
 * @param string email							받는사람 email
 * @param string html							보낼 내용
 * @return bool									성공/실패
 */
function mailSend($title, $to_name, $to_email, $from_name, $from_email, $html) {

	//기본적으로 문자열을 UTF-8로 보냄
	$encode_title = "=?UTF-8?B?".base64_encode($title)."?=\n"; 
	$encode_to = "\"=?UTF-8?B?".base64_encode($to_name)."?=\" <".$to_email.">";
	$encode_from = "\"=?UTF-8?B?".base64_encode($from_name)."?=\" <".$from_email.">" ;
	$encode_header = "MIME-Version: 1.0\n"."Content-Type: text/html; charset=UTF-8; format=flowed\n"."To:".$encode_to."\n"."From:".$encode_from."\n"."Content-Transfer-Encoding: 8bit\n"; 

	$mail = mail($to_email, $encode_title, $html, $encode_header, '-f'.$from_email);
	return $mail;
}

/**
 * 입력받은 배열을 JSON으로 변환하여 출력한다.
 * @param mixed $data JSON으로 변환할 객체
 * @return string JSON 형태의 문자열
 */
function jsonEncode( &$data )
{
	$result = "";
	
	if(is_array($data))
	{

		$is_array = false;
		$is_object = false;

		if(is_empty_array($data)){
			$result = '[]';
		}
		foreach($data as $key=>$value)
		{
			if(!is_numeric($key) && $key!="length")
			{
				$is_object = true;
			}else{
				$is_array = true;
			}
		}
		
		if($is_object){
			foreach($data as $key=>$value){
				if(!is_numeric($key) && $key!="length"){
					if($result!=""){$result .= ",";}
					$result .= "\"".$key."\":".jsonEncode( $value );
				}
			}
			$result = "{".$result."}";
		}else if($is_array){
			foreach($data as $key=>$value){
				if(is_numeric($key)){
					if($result!=""){$result .= ",";}
					$result .= jsonEncode($value);
				}
			}
			$result = "[".$result."]";
		}
	}
	else
	{
		if(strlen($data)>0 && substr($data,0,1)=="{" && preg_match('/^\{([\'"][^\n\r]{0,}[\'"]:[\'"\{\[]{1,}[^\n\r]{0,}[\'"\}\]]{1,}){0,}\}$/', $data)){
			$result = $data;
		}else{
				$result = "\"".str_replace(array("\r","\n","\"",'','	',''),array("\\r","\\n","\\\"",'','',''), $data)."\"";
		}
	}
	
	return $result;
}

/**
 * JSON문자열을 PHP배열로 변환한다.
 * @param string $str 해석할 JSON 문자열
 * @return mixed 해석되면 array로 구성해서 반환, 해석안되면 받은 문자열 그대로 반환
 */

 function jsonDecode($json, $assoc = true, $depth = 512, $options = 0) {
    // search and remove comments like /* */ and //
    $json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json);
    
    if(version_compare(phpversion(), '5.4.0', '>=')) {
        $json = json_decode($json, $assoc, $depth, $options);
    }
    elseif(version_compare(phpversion(), '5.3.0', '>=')) {
        $json = json_decode($json, $assoc, $depth);
    }
    else {
        $json = json_decode($json, $assoc);
    }

    return $json;
}


function jsonDecodeLegacy($str){
	if(!is_string($str)){return $str;}
	if(substr($str,0,1)=="{"){$str = substr($str,1,strlen($str)-2);}
	$str = trim($str);$strlen = strlen($str);
	$q_open = false;$dq_open = false;$comments_open = false;
	$comments = array();
	$ciu = 0;$object_depth = 0;$array_depth = 0;$s = 0;
	$result = array();
	$key = "";$value = "";
	for($iu=0;$iu<$strlen;$iu++){
		switch($str[$iu]){
		case "'":
			if($object_depth==0 && $array_depth==0){if(!$q_open){$s = $iu;$q_open = true;}else{$q_open = false;$value = substr($str,$s+1,$iu-$s-1);}}
		break;
		case "\"":
			if($object_depth==0 && $array_depth==0){if(!$dq_open){$s = $iu;$dq_open = true;}else{$dq_open = false;$value = substr($str,$s+1,$iu-$s-1);}}
		break;
		case "{":
			if($object_depth==0){$s = $iu;}$object_depth++;
		break;
		case "}":
			$object_depth--;if($object_depth==0){$value = jsonDecode(str_replace($comments,"",substr($str,$s+1,$iu-$s-1)));$s = $iu;}
		break;
		case "[":
			if($array_depth==0){$s = $iu;}$array_depth++;
		break;
		case "]":
			$array_depth--;if($array_depth==0){$value = jsonDecode(str_replace($comments,"",substr($str,$s+1,$iu-$s-1)));$s = $iu;}
		break;
		case ":":
			if(!$q_open && !$dq_open && $object_depth==0 && $array_depth==0){
				if($value==""){$value = substr($str,$s,$iu-$s);}
				$value = str_replace($comments,"",$value);
				$key = $value;$value = "";$s = $iu+1;
			}
		break;
		case ",":
			if(!$q_open && !$dq_open && $object_depth==0 && $array_depth==0){
				if($value==""){
					$value = substr($str,$s,$iu-$s);
					$value = str_replace($comments,"",$value);
					if(isset($GLOBALS[$value])){$value = &$GLOBALS[$value];}
				}else{$value = str_replace($comments,"",$value);}
				if($key==""){$key = count($result);}
				$result[$key] = $value;$value = "";$key = "";$s = $iu+1;
			}
		break;
		case "/":
			if(!$q_open && !$dq_open && $str[$iu+1]=="*"){
				$comments[$ciu] = $iu;
				$comments_open = true;
			}
		break;
		case "*":
			if(!$q_open && !$dq_open && $str[$iu+1]=="/"){
				$comments[$ciu] = substr($str,$comments[$ciu],$iu-$comments[$ciu]+2);
				$comments_open = false;
				$ciu++;
			}
		break;
		}
	}
	if($value==""){
		$value = substr($str,$s,$iu-$s);
		$value = str_replace($comments,"",$value);
		if(isset($GLOBALS[$value])){$value = &$GLOBALS[$value];}
	}else{$value = str_replace($comments,"",$value);}
	if($key==""){$key = count($result);}
	$result[$key] = $value;
	
	if(count($result)==1 && $key=="0"){$result = $str;}
	
	return $result;
}
?>