<?php
$insertParam['name'] = 'test1';
$insertParam['subject'] = 'test2';
$insertParam['description'] = 'test3';
insertItem(hello_world,$insertParam);


$table_list = getList(hello_world,'*',1,1,'name desc');
print_x($table_list);
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
<table>
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>이름</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
</body>
</html>