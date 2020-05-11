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
        <div class="mypage-portfolio">
            <a href="#" class="btn-default btn-mypage-portfolio-reg">등록하기</a>
            <ul class="mypage-portfolio-list">
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
                <li>
                    <img src="/images/portfolio_thumb.png" alt="" class="thumb">
                </li>
            </ul>
        </div>
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