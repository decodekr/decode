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
        <?php
        include 'views/mypage_menu.html';
        ?>
        <div class="sub-container-default">
            <h3 class="second-sub-heading">
                <span>등록하기</span>
            </h3>
            <table class="table-default portfolio-reg-table">
                <tr>
                    <th>대표사진</th>
                    <td>
                        * 대표 사진은 600 x 480 사이즈로 올려주세요.
                    </td>
                </tr>
                <tr>
                    <th>기간</th>
                    <td>
                    </td>
                </tr>
                <tr>
                    <th>분류</th>
                    <td>
                        <span class="portfolio-reg-table-check-box">
                            <input type="checkbox">
                            <label>유니섹스</label>
                        </span>
                        <span class="portfolio-reg-table-check-box">
                            <input type="checkbox">
                            <label>여성복</label>
                        </span>
                        <span class="portfolio-reg-table-check-box">
                            <input type="checkbox">
                            <label>남성복</label>
                        </span>
                        <span class="portfolio-reg-table-check-box">
                            <input type="checkbox">
                            <label>아동복</label>
                        </span>
                        <span class="portfolio-reg-table-check-box">
                            <input type="checkbox">
                            <label>기타</label>
                        </span>
                    </td>
                </tr>
            </table>
            <div class="editor-section" style="border-bottom: 1px solid #000;border-left:1px solid #000; border-right: 1px solid #000;height:771px;"></div>
            <input type="submit" class="send-button portfoilo-save-button" value="저장하기">
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
