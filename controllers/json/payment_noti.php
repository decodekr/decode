<?php
header('Content-Type: application/json; charset=UTF-8');

if(!in_array('application/json',explode(';',$_SERVER['CONTENT_TYPE']))){
    echo json_encode(array('result_code' => '400'));
    exit;
}

$__rawBody = file_get_contents("php://input");

$data= json_decode($__rawBody,true);

/*$param['image'] = $__rawBody;
insertItem('banners',$param);*/



echo json_encode('SUCCESS');
