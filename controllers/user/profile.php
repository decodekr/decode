<?php
include 'views/header.html';
?>
    <div class="sub-heading">
        <div class="container">
            M Y    P A G E
        </div>
    </div>
<div id="content">
    <div class="container">
        <ul class="tab-menu">
            <li><a href="">프로필</a></li>
            <li><a href="/user/portfolio/list">포트폴리오</a></li>
            <li><a href="/user/message">메시지</a></li>
            <li><a href="/user/like">좋아요</a></li>
            <li><a href="/user/order_list">주문 내역</a></li>
            <li><a href="#">회원 정보 수정</a></li>
        </ul>
        <div class="sub-container-default">
            <h3 class="second-sub-heading">
                <span>기본정보</span>
            </h3>
            <table class="profile-default-info-table">
                <tr>
                    <th>이름</th>
                    <td colspan="2"><input type="text"></td>
                </tr>
                <tr>
                    <th>프로필 사진</th>
                    <td colspan="2">
                        최적 사이즈 : 100X100 px
                    </td>
                </tr>
                <tr>
                    <th>한 줄 소개</th>
                    <td colspan="2"><input type="text"></td>
                </tr>
                <tr>
                    <th>생년월일</th>
                    <td>
                        <select>
                            <option></option>
                        </select>년
                        <select>
                            <option></option>
                        </select>월
                        <select>
                            <option></option>
                        </select>일
                    </td>
                    <td>
                        <input type="checkbox">비공개
                    </td>
                </tr>
                <tr>
                    <th>지역</th>
                    <td>
                        <select>
                            <option>서울</option>
                            <option>경기</option>
                        </select>
                    </td>
                    <td>
                        <input type="checkbox">비공개
                    </td>
                </tr>
            </table>
            <h3 class="second-sub-heading">
                <span>주요경력</span>
            </h3>
            <div class="table-box-second">
                <table class="table-default table-career">
                    <tr>
                        <th class="number-heading">번호</th>
                        <th>기간</th>
                        <th>회사/기관 명</th>
                        <th>활 동 내 용</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="table-box-second">
                <h3 class="second-sub-heading">
                    <span>자기소개</span>
                </h3>
                <div style="height:815px;" class="profile-editor"></div>
                <input type="submit" value="저장하기" class="profile-save-button">
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