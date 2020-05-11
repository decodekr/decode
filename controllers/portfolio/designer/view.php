<?php
include 'views/header.html';
?>
    <div class="sub-heading">
        <div class="container">
            디자이너들의 포트폴리오를 확인해보세요.
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="view-full">
                <a href="#">
                    <div class="view-title">디자이너별</div>
                    <div>포 트 폴 리 오  보 기</div>
                </a>
                <a href="#">
                    <div class="view-title">작품별</div>
                    <div>포 트 폴 리 오  보 기</div>
                </a>
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