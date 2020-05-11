<?php
include 'views/header.html';
?>
<div class="sub-heading">
    <div class="container">
        라잇루트 브리지의 공지사항을 확인해주세요!
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="sub-container-default">
            <h3 class="second-sub-heading">
                <span>주문내역</span>
            </h3>
            <div class="table-box">
                <table class="table-default">
                    <tr>
                        <th>주문일</th>
                        <th>품목</th>
                        <th>색상</th>
                        <th>로고 위치</th>
                        <th>총 수량</th>
                        <th>배송 현황</th>
                        <th>주문서</th>
                        <th>재주문</th>
                    </tr>
                    <tr>
                        <td>19.11.07</td>
                        <td>
                            후드집업
                        </td>
                        <td>검정</td>
                        <td>왼쪽 가슴</td>
                        <td>100개</td>
                        <td>배송중</td>
                        <td>주문서 보기</td>
                        <td>재주문 하기</td>
                    </tr>
                </table>
                <ul class="pagin">
                    <li class="pagin-prev"><a href="#">이전</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li class="pagin-next"><a href="#">다음</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="contact">
    <div class="container">
        <form method="get" action="">
            <h3>Contact</h3>
            <p class="explain">협업(콜라보) 및 기타 문의 사항이 있으시면 아래에 남겨주세요.</p>

            <table class="contact-form-table">
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text">
                    </td>
                    <th>Email</th>
                    <td>
                        <input type="text">
                    </td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td colspan="3">
                        <input type="text">
                    </td>
                </tr>
                <tr>
                    <th class="message-title">Message</th>
                    <td colspan="3">
                        <textarea></textarea>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Send" class="send-button">

        </form>
    </div>
</div>
<?php
include 'views/footer.html';
?>
