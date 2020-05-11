<?php
	sqlQuery('CREATE TABLE  IF NOT EXISTS  `banners` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) not null default "" comment "제목",
  image varchar(255) not null default "" comment "이미지",
  location varchar(63) not null default "" comment "위치",
  `create_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  `modify_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
');

	include $pluginPath.'/models/index.php';


?>