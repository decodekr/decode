# CREATE TABLE IF NOT EXISTS table_(
DROP TABLE `table`;
CREATE TABLE `table` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `site_configs` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  site_name varchar(255) not null default '' comment '사이트명',
  usage_agreement TEXT not null default '' comment '이용 약관',
  privacy_agreement TEXT not null default '' comment '개인정보 약관',
  title  varchar(255) not null default '' comment '유저 페이지 타이틀',
  visit_count int unsigned  not null default 0 comment '방문자수',
  use_mobile int unsigned not null default 0 comment '모바일 사용여부',
  admin_id varchar(255) not null default '' comment '관리자 아이디',
`create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO
`site_configs` (`no`, `site_name`, `usage_agreement`, `privacy_agreement`, `title`,  `use_mobile`, `create_date`, `modify_date`) 
VALUES (NULL, 'Water Melon', '이용 약관 테스트', '개인 정보 약관 테스트', '워터 멜론 | 게시판 솔루션',  '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');



CREATE TABLE `users` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  id varchar(255) not null default '' comment '아이디',
  password varchar(255) not null default '' comment '비밀번호',
  name varchar(255) not null default '' comment '이름',
  grade int not null default 0 comment '등급',
  is_admin int not null default 0 comment '관리자여부',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `boards` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  name varchar(63) not null default '' comment '게시판명',
  id varchar(63) not null default '' comment '아이디',
  group_name varchar(63) not null default '' comment '게시판그룹',
  item_count int unsigned not null default 10 comment '항목수',
  paging_count int unsigned not null default 10 comment '페이징수',
  comment_count int unsigned not null default 10 comment '댓글항목수',
  comment_paging_count int unsigned not null default 10 comment '댓글페이징',
  skin varchar(63) not null default '' comment '사용스킨',
  write_grade int unsigned not null default 0 comment '작성권한',
  modify_grade int unsigned not null default 0 comment '수정권한',
  list_grade int unsigned not null default 0 comment '목록권한',
  read_grade int unsigned not null default 0 comment '보가권한',
  delete_grade int unsigned not null default 0 comment '삭제권한',
  delete_type int unsigned not null default 0 comment '삭제유형, 0이면 임시삭제',
  user_type int unsigned not null default 0 comment '유저사용 타입, 0이면 사용안함',
  use_secret int unsigned not null default 0 comment '비밀글 사용여부, 0이면 사용안함',
  list_user_field varchar(255) not null default '' comment '리스트에서 가져올 유저 필드',
  view_user_field varchar(255) not null default '' comment '뷰에서 가져올 유저 필드',
  write_user_field varchar(255) not null default '' comment '글쓰기에서 가져올 유저 필드',
  comment_user_field varchar(255) not null default '' comment '댓글에서 가져올 유저 필드',
  comment_list_grade int unsigned not null default 0 comment '댓글 목록 권한',
  comment_write_grade int unsigned not null default 0 comment '댓글 작성권한',
  comment_modify_grade int unsigned not null default 0 comment '댓글수정권한',
  comment_delete_grade int unsigned not null default 0 comment '댓글 삭제권한',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `files` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
   name varchar(255) not null default '' comment '파일명',
   path varchar(255) not null default '' comment '경로',
   type varchar(255) not null default '' comment '파일유형',
   location varchar(255) not null default '' comment '위치',
    parent_no int unsigned not null default 0 comment '부모 번호',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `board_sample` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) not null default '' comment '제목',
  contents varchar(255) not null default '' comment '내용',
  hit int unsigned not null default 0 comment '조회수',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `board_sample_comment` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  contents varchar(255) not null default '' comment '내용',
  reply_no int unsigned not null default 0 comment '댓글용 번호',
  sort int unsigned not null default 0 comment '댓글용  같은 번호 내 정렬',
  depth int unsigned not null default 0 comment '깊이',
  parent_no int unsigned not null default 0 comment '부모번호',
  board_no int unsigned not null default 0 comment '부모 게시글 번호',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `latest_boards` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) not null default ' ' comment '제목',
  board_no int unsigned not null default 0 comment '게시판 번호',
  board_id varchar(255) not null default '' comment '게시판 아이디',
  board_name varchar(255) not null default '' comment '게시판명',
 
  user_no int unsigned not null default 0 comment '회원번호',
  writer_name varchar(255) not null default '' comment '작성자명',
    comments int unsigned not null default 0 comment '댓글갯수',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `latest_comments` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  contents varchar(255) not null default ' ' comment '내요',
  board_no int unsigned not null default 0 comment '게시판 번호',
  comment_no int unsigned not null default 0 comment '게시물번호',
  board_id varchar(255) not null default '' comment '게시판 아이디',
  board_name varchar(255) not null default '' comment '게시판명',
  user_no int unsigned not null default 0 comment '회원번호',
  writer_name varchar(255) not null default '' comment '작성자명',
   relies int unsigned not null default 0 comment '대댓글 갯수',

  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `banners` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) not null default '' comment '제목',
  image varchar(255) not null default '' comment '이미지',
  location varchar(63) not null default '' comment '위치',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `visitors` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  ip varchar(255) not null default "" comment "아이피",
  useragent varchar(255) not null default "" comment "유저에이전트",
  refferer varchar(255) not null default "" comment "리퍼러",
  `create_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  `modify_date` datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `product_categories` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL DEFAULT '',
  next_category varchar(255) NOT NULL DEFAULT '',
  category_group VARCHAR(255) NOT NULL DEFAULT '',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `product_lists` (
  `no` int(11) NOT NULL AUTO_INCREMENT,

   price INT unsigned NOT NULL DEFAULT 0 comment '가격',
   delivery_type VARCHAR(255) NOT NULL DEFAULT '',
   package_type VARCHAR(255) NOT NULL DEFAULT '',
   delivery_start_date DATETIME  NOT NULL DEFAULT '0000-00-00 00:00:00' comment '희망배송',
   delivery_end_date DATETIME  NOT NULL DEFAULT '0000-00-00 00:00:00' comment '희망배송',
   details TEXT,
  images TEXT NOT NULL DEFAULT '',
  attach VARCHAR(255) NOT NULL DEFAULT '',
  user_no INT unsigned NOT NULL DEFAULT 0,
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `estimate_cart_products` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  product_no INT unsigned NOT NULL DEFAULT 0,
  user_no INT unsigned NOT NULL DEFAULT 0,
  amount  INT unsigned NOT NULL DEFAULT 0,
  status  INT unsigned NOT NULL DEFAULT 0,
  order_no INT unsigned NOT NULL DEFAULT 0,
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `estimate_orders` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  user_no INT unsigned NOT NULL DEFAULT 0,
  status  INT unsigned NOT NULL DEFAULT 0,
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `coverstories` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL DEFAULT '',
  description TEXT NOT NULL DEFAULT '',
  url VARCHAR(255) NOT NULL DEFAULT '',
  thumbnail1 VARCHAR(255) NOT NULL DEFAULT '',
  thumbnail2 VARCHAR(255) NOT NULL DEFAULT '',
  target VARCHAR(255) NOT null DEFAULT '',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `mail_certif_codes` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL DEFAULT '',
  code VARCHAR(255) NOT NULL DEFAULT '',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `samewords` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  input_word TEXT NOT NULL DEFAULT '',
  result_words TEXT NOT NULL DEFAULT '',
 `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '등록일',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' comment '수정일',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

