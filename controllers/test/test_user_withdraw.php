<?php
include'views/admin/document.html';

?>

<div>

    <h3>출금신청</h3>

    guid <input name="guid" id="guid" type="text" />

    <br>

    출금금액 <input name="orgCrrncy" id="orgCrrncy" type="text" />

    <br>

    <input type="button" id="widthdraw_application_button" value="출금신청">


</div>

<br>

<div>
    <h4>응답값</h4>
    <div id="widthdraw_application_response">

    </div>
</div>

<br>
<br>


<div>

    <h3>출금인증</h3>

    tid <input name="tid" id="tid" type="text" />

    <br>

    인증번호 <input name="verifyWord" id="verifyWord" type="text" />

    <br>

    <input type="button" id="widthdraw_verify_button" value="출금인증">


</div>

<br>

<div>
    <h4>응답값</h4>
    <div id="widthdraw_verify_response">

    </div>
</div>




<script>
    $('#widthdraw_application_button').click(function () {

        var guid = $('#guid').val();
        var orgCrrncy = $('#orgCrrncy').val();


        postRequest({

            url : '/json/payment',
            data : {mode: 'sellerWithdraw', guid: guid, orgCrrncy: orgCrrncy},
            success : function ($result) {

                $data = $result.data;


                $('#widthdraw_application_response').text(JSON.stringify($data));



                $('#tid').val($data.tid);

                return false;
            }
        });
    });


    $('#widthdraw_verify_button').click(function () {

        var tid = $('#tid').val();
        var verifyWord = $('#verifyWord').val();


        postRequest({

            url : '/json/payment',
            data : {mode: 'certifySellerWithdraw', tid: tid, verifyWord: verifyWord},
            success : function ($result) {

                $data = $result.data;

                $('#widthdraw_verify_response').text(JSON.stringify($data));

                return false;

            }
        });
    });

</script>
