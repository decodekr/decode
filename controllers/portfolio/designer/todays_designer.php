<?php
include 'views/header.html';
?>
    <div class="sub-heading">
        <div class="container">
            오늘의 디자이너
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="todays-designer-wrap">
                <div class="todays-designer">
                <div class="todays-designer-inner">
                    <div class="todays-designer-title">
                        <h3>제목제목제목제목제목</h3>
                        <div class="todays-designer-meta clear">
                            <p>
                                <span class="todays-designer-by">Designed by</span>
                                <span class="todays-designer-name">디자이너 이름</span>
                            </p>
                        </div>
                    </div>
                    <div class="todays-designer-portfolio">
                        <div class="todays-designer-portfolio-inner">
                        </div>
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