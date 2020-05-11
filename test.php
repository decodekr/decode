<?php

$param[0]['test']= 'ㅇㅇ';
$param[1]['test']= 'ㅇㅇ';
$param[1]['test']= 'ㅇㅇ';
$param=my_json_encode($param);

echo $param;
function my_json_encode($arr)
{
        //convmap since 0x80 char codes so it takes all multibyte codes (above ASCII 127). So such characters are being "hidden" from normal json_encoding
        array_walk_recursive($arr, function (&$item, $key) { if (is_string($item)) $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); });
        return mb_decode_numericentity(json_encode($arr), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');

}
?>