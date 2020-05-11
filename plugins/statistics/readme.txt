//-----------------------------------------------------
// 방문자 통계 플러그인
//-----------------------------------------------------


※ 본 플러그인은 관리자 전용 플러그인임.

================================================================


1.플러긴 폴더에 복사

2. mono param -> mode 추가

3.

유저 모델에 하단 코드 추가

/*
	방문자 플러긴 코드
*/

$visitorParam['ip'] = $_SERVER['REMOTE_ADDR'];
$visitorParam['refferer'] = $_SERVER['HTTP_REFERER'];
$visitorParam['useragent'] = $_SERVER['HTTP_USER_AGENT'];
$visitors = getItem('visitors','ip="'.$visitorParam['ip'].'" AND refferer="'.$visitorParam['refferer'].'"');
if(!$visitors){
	insertItem('visitors',$visitorParam);	
}

4.관리자 메뉴에 링크 추가(선택적)

