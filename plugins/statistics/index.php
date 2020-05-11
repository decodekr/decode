<?php
sqlQuery('CREATE TABLE IF NOT EXISTS `visitors` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  ip varchar(255) not null default "" comment "아이피",
  useragent varchar(255) not null default "" comment "유저에이전트",
  refferer varchar(255) not null default "" comment "리퍼러",
  `create_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  `modify_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
');

switch($param['mode']){
	case 'daily' :
		$visitors =  getListQuery('SELECT count(*) AS count, MID( create_date, 1, 10 ) date
		FROM visitors
		GROUP BY date');
		break;
	case 'site' :
		$visitors = getListQuery('SELECT refferer, COUNT( * ) AS count, SUBSTRING_INDEX( SUBSTRING_INDEX( REPLACE( REPLACE( LOWER( refferer ) ,  "https://",  "" ) ,  "http://",  "" ) ,  "/", 1 ) ,  "?", 1 ) AS domain
		FROM visitors
		WHERE refferer !=  ""
		GROUP BY domain
		ORDER BY count DESC LIMIT 30 ');
			
		break;
	 default : 
		$param['mode'] = 'index';
			$visitors = pageList('visitors','','',10,10,$param['page'],'/admin/statistics/page/$page');
	break;
}

	include 'views/'.$param['mode'].'.html';
	
?>