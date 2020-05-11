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
        <div class="sub-container-wide">
            <div class="designer-list-box">
                <div class="designer-list-title clear">
                    <h3>디자이너 이름</h3>
                    <div class="designer-list-like">
                        <span class="like-icon"></span>
                    </div>
                </div>
                <div class="designer-slide">
                    <a href="#" class="designer-slide-left-button">왼쪽 슬라이드</a>
                    <div class="designer-slide-box">
                        <ul class="designer-slide-list">
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <a href="#" class="designer-slide-right-button">오른쪽 슬라이드</a>
                </div>
            </div>
            <div class="designer-list-box">
                <div class="designer-list-title clear">
                    <h3>디자이너 이름</h3>
                    <div class="designer-list-like">
                        <span class="like-icon"></span>
                    </div>
                </div>
                <div class="designer-slide">
                    <a href="#" class="designer-slide-left-button">왼쪽 슬라이드</a>
                    <div class="designer-slide-box">
                        <ul class="designer-slide-list">
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <a href="#" class="designer-slide-right-button">오른쪽 슬라이드</a>
                </div>
            </div>
            <div class="designer-list-box">
                <div class="designer-list-title clear">
                    <h3>디자이너 이름</h3>
                    <div class="designer-list-like">
                        <span class="like-icon"></span>
                    </div>
                </div>
                <div class="designer-slide">
                    <a href="#" class="designer-slide-left-button">왼쪽 슬라이드</a>
                    <div class="designer-slide-box">
                        <ul class="designer-slide-list">
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <a href="#" class="designer-slide-right-button">오른쪽 슬라이드</a>
                </div>
            </div>
        </div>
        <ul class="pagin">
            <!--
            <li class="pagin-prev"><a href="#">이전</a></li>
            -->
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <!--
            <li class="pagin-next"><a href="#">다음</a></li>
            -->
        </ul>
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