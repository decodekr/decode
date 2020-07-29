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

    #guid {
        width: 250px;
    }

    #startDate, #endDate {
        width: 100px;
        margin: 0 15px;
    }

</style>


<h2 id="contents_title">
	<i class="fa fa-money"></i>
	멤버 입출금 내역 조회
</h2>
<div class="contents">
	
	<div class="container">
		<h3 class="title">
			<i class="fa fa-money"></i> 멤버 입출금 내역 조회 (API)
		</h3>
		<div class="row">
			<table class="table" id="search_table">
				<tr>
					<th>
						유저 GUID
					</th>
					<td>
						<input name="guid" id="guid" type="text" />
					</td>
                </tr>
                <tr>
                    <th>
                        검색 날짜
                    </th>
                    <td>
                        <input type="text" name="startDate" id="startDate" class="datepicker" autocomplete="off" placeholder="검색 시작일"> ~ <input type="text" name="endDate" id="endDate" class="datepicker" autocomplete="off" placeholder="검색 종료일">
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <a href="#none" id="search_button" class="btn btn-default">검색</a>
                    </td>
                </tr>
			</table>
		</div>


		<table class="table">
            <thead>
                <tr>
                    <th>
                        번호
                    </th>
                    <th>
                        잔액
                    </th>
                    <th>
                        입출금유형
                    </th>
                    <th>
                        입출금금액
                    </th>
                    <th>
                        통화
                    </th>


                    <th>
                        거래ID
                    </th>

                    <th>
                        거래유형
                   </th>
                    <th>
                        거래상태
                    </th>
                    <th>
                        거래시간
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


            var guid = $('#guid').val();
            var startDate = $('#startDate').val().replace(/\-/g,'');
            var endDate = $('#endDate').val().replace(/\-/g,'');

            if (!guid || !startDate || !endDate) {
                alert('검색조건을 모두 입력해주세요');
                return false;
            }


            postRequest({
                url : '/json/payment',
                data : {mode: 'getMemberBalanceInOut', guid: guid, startDate: startDate, endDate: endDate},

                success : function ($result) {

                    console.log($result);


                    $('#table_list').html('');


                    if ($result.error) {

                        $('#table_list').append('<tr><td colspan="8">조회 결과가 없습니다.</td></tr>');

                        return false;

                    }

                    var $data = $result.data.wpBalanceLogList;

                    var tableData = "";


                    $.each($data, function (index, value) {

                        var inoutType = '';

                        if (value.inoutType == "IN") {
                            value.inoutType = "입금"
                        } else if (value.inoutType == "OUT") {
                            value.inoutType = "출금"

                        }

                        if (value.trnsctnType == "MEMBER_DEPOSIT") {
                            value.trnsctnType = '회원 예치금 입금';
                        } else if (value.trnsctnType == "USER_WITHDRAW") {
                            value.trnsctnType = '회원 예치금 출금';
                        } else if (value.trnsctnType == "USER_TRANSFER") {
                            value.trnsctnType = '유저 송금';
                        } else if (value.trnsctnType == "MERCHANT_WITHDRAW") {
                            value.trnsctnType = '머천트 출금';
                        } else if (value.trnsctnType == "MERCHANT_TRANSFER") {
                            value.trnsctnType = '머천트 송금';
                        }

                        tableData += '<tr>';
                            tableData += '<td>' + (++index) + '</td>';
                            tableData += '<td>' + number_format(value.balanceAmt) + '</td>';
                            tableData += '<td>' + value.trnsctnType + '</td>';
                            tableData += '<td>' + number_format(value.changeAmt) + '</td>';
                            tableData += '<td>' + value.crrncyType + '</td>';
                            tableData += '<td>' + value.inoutType + '</td>';
                            tableData += '<td>' + value.tid + '</td>';
                            tableData += '<td>' + value.trnsctnState + '</td>';
                            tableData += '<td>' + getTimeStamp(value.createDttm) + '</td>';
                            tableData += '</tr>';
                    });

                    $('#table_list').append(tableData);

                    return false;
                }

            });

        });
    </script>




		
<?php
	include'views/admin/footer.html';
?>