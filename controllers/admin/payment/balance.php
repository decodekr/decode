<?php

/*$path = '';
$where = 'is_admin = 0';

addKeywordCondition($path,$where,$param['search_type'],$param['search_keyword'],true);
$pagingTags = $melon['dir'].'/page/$page'.$path;

$users = pageList('users',$where,'',10,10,$param['page'],$pagingTags);*/
include'views/admin/document.html';
include'views/admin/header.html';


?>

    <style>
        #search_table input {
            width: 80%;
        }
    </style>


    <h2 id="contents_title">
        <i class="fa fa-money"></i>
        머천트 잔액 조회
    </h2>
    <div class="contents">

        <div class="container">
            <h3 class="title">
                <i class="fa fa-money"></i> 머천트 잔액 조회 (API)
            </h3>
            <div class="row">
                <table class="table" id="search_table">
                    <tr>
                        <td>
                            <a href="#none" id="search_button" class="btn btn-default">조회</a>
                        </td>
                    </tr>
                </table>
            </div>


            <table class="table">
                <thead>
                <tr>
                    <th>
                        잔액총액
                    </th>
                    <th>
                        대기거래금액
                    </th>
                    <th>
                        통화
                    </th>
                    <th>
                        잔액변경시간
                    </th>

                </tr>
                </thead>
                <tbody id="table_list">


                </tbody>

            </table>

            <div class="pagination">
                <?/*=$users['pagination']*/?>
            </div>

        </div>

    </div>

    <script>

        function leadingZeros(n, digits) {
            var zero = '';
            n = n.toString();

            if (n.length < digits) {
                for (i = 0; i < digits - n.length; i++)
                    zero += '0';
            }
            return zero + n;
        }

        function getTimeStamp(time) {
            var d = new Date(time);
            var s =
                leadingZeros(d.getFullYear(), 4) + '-' +
                leadingZeros(d.getMonth() + 1, 2) + '-' +
                leadingZeros(d.getDate(), 2) + ' ' +

                leadingZeros(d.getHours(), 2) + ':' +
                leadingZeros(d.getMinutes(), 2) + ':' +
                leadingZeros(d.getSeconds(), 2);

            return s;
        }



        $('#search_button').click(function () {


            postRequest({
                url : '/json/payment',
                data : {mode: 'getMerchantBalance'},

                success : function ($result) {
                    
                    var $data = $result.data;

                    var tableData = "";


                        tableData += '<tr>';
                        tableData += '<td>' + number_format($data.balanceTotAmt) + '</td>';
                        tableData += '<td>' + number_format($data.pendingTrnsfrAmt) + '</td>';
                        tableData += '<td>' + $data.crrncyType + '</td>';
                        tableData += '<td>' + getTimeStamp($data.changeDttm) + '</td>';
                        tableData += '</tr>';


                    $('#table_list').append(tableData);

                    return false;
                }

            });

        });
    </script>





<?php
include'views/admin/footer.html';
?>