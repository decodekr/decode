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
        <div class="filter clear">
            <div class="sort">
                <ul>
                    <li>
                        <div class="btn-sort-item">
                            <div class="btn-sort-name">필터</div>
                            <a href="#" class="btn-sort-arrow"></a>
                        </div>
                    </li>
                    <li>
                        <div class="btn-sort-item">
                            <div class="btn-sort-name">최신순</div>
                            <a href="#" class="btn-sort-arrow"></a>
                        </div>
                    </li>
                    <li>
                        <div class="btn-sort-item">
                            <div class="btn-sort-name">8개씩</div>
                            <a href="#" class="btn-sort-arrow"></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="portfolio-list clear">
            <li>
                <a href="#">
                    <h3>디자이너 이름</h3>
                    <div class="portfolio-list-item">작품 제목</div>
                    <div class="portfolio-list-detail">자세히 보기</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>디자이너 이름</h3>
                    <div class="portfolio-list-item">작품 제목</div>
                    <div class="portfolio-list-detail">자세히 보기</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>디자이너 이름</h3>
                    <div class="portfolio-list-item">작품 제목</div>
                    <div class="portfolio-list-detail">자세히 보기</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>디자이너 이름</h3>
                    <div class="portfolio-list-item">작품 제목</div>
                    <div class="portfolio-list-detail">자세히 보기</div>
                </a>
            </li>
        </ul>
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