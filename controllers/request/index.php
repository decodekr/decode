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
                <h3 class="second-sub-heading-default">
                    <span>생산 의뢰</span>
                </h3>
                <div class="sub-explain">
                    <p>아래의 양식을 채우신 후 ‘문의하기’를 눌러주세요!</p>
                    <p>영업시간 기준 2시간 이내로 답변 드립니다.</p>
                    <p>(영업시간 : 월 - 금, 09시 ~ 16시, 공휴일 제외)</p>
                </div>
                <div class="table-box-second">
                    <table class="table-default produce-request-table">
                        <tr>
                            <th>품목</th>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <th>예산</th>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <th>수량</th>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <th>설명</th>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <th>디자이너 선택</th>
                            <th>
                                <div class="produce-request-select">
                                    <select>
                                        <option>
                                            한 디자이너 선택
                                        </option>
                                    </select>
                                </div>
                                <input type="checkbox">
                                <label>없음</label>
                            </th>
                        </tr>
                        <tr>
                            <th>예시 사진</th>
                            <td>
                                <div class="file-box">
                                    <input type="file">
                                </div>
                                <div class="file-attach-guide">
                                    <p>*원하는 느낌이 잘 드러나는 구체적인 사진을 업로드해주세요.</p>
                                    <p>예시 사진이 많을수록 좋습니다!</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" class="send-button request-button" value="문의하기">
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