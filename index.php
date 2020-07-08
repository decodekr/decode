<?php

// HTTPS 체크 및 URL 리턴
if(!isset($_SERVER["HTTPS"])) {
header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
}



	include_once "melon/core.php";

