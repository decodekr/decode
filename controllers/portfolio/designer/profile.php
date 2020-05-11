<?php
include 'views/header.html';
?>
    <div class="sub-heading">
        <div class="container">
            디자이너 프로필
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="profile-wrap">
                <div class="profile-info">
                    <div class="profile-info-head clear">
                        <div class="profile-info-avatar">
                            <img src="http://rightroute.decodelab.co.kr/images/profile_avatar.png">
                        </div>
                        <h3 class="profile-designer-name">디자이너 이름</h3>
                        <p class="profile-designer-date">0000/00/00</p>
                        <p class="profile-designer-region">지역</p>
                        <a href="#" class="contact-btn">contact</a>
                    </div>
                    <p class="profile-introduce">프로필에서 설정한 한 줄 소개글</p>
                </div>
                <div class="profile-inner">
                    <ul class="tab-menu">
                        <li class="active"><a href="#">프로필</a></li>
                        <li><a href="#">포트폴리오</a></li>
                    </ul>
                    <div class="profile-inner-box">
                            <div class="table-box-second">
                                <h3 class="second-sub-heading">
                                    <span>주요경력</span>
                                </h3>
                                <table class="table-default table-career-inner">
                                    <tbody><tr>
                                        <th>기간</th>
                                        <th>회사/기관 명</th>
                                        <th>활 동 내 용</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody></table>
                            </div>
                        <div class="table-box-second">
                            <h3 class="second-sub-heading">
                                <span>자기소개</span>
                            </h3>
                            <div class="profile-box"></div>
                        </div>
                    </div>
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
                    <tbody><tr>
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
                    </tbody></table>
                <input type="submit" value="Send" class="send-button">
            </form>
        </div>
    </div>
<?php
include 'views/footer.html';
?>