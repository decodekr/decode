<?php
include 'views/header.html';
?>
    <div class="sub-heading">
        <div class="container">
            디자이너 커뮤니티
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="comment-write-btn-wrap">
                <a href="#" class="comment-write-btn">글쓰기</a>
            </div>
            <div class="community-list-box">
                <div class="community-list-box-inner">
                    <div class="community-list-title clear">
                        <h3>제목제목제목제목제목제목제목제목제목</h3>
                        <p class="community-list-author">
                            <img src="/images/profile_avatar.png" class="avatar">
                            작성자 이름
                        </p>
                    </div>
                    <div class="community-list-article">
                        <p>내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용 내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용.</p>
                    </div>
                    <div class="community-list-comment clear">
                        <div class="community-comment-input-wrap">
                            <input type="text">
                            <div class="image-attach">
                                <a href="#">
                                    <img src="/images/image_attach_icon.png" alt="사진첨부">
                                </a>
                            </div>
                        </div>
                        <div class="community-comment-reg">
                            <input type="submit" value="등록" class="community-comment-btn-reg">
                        </div>
                    </div>
                    <ul class="community-comment-list clear">
                        <li>
                            <div class="community-comment-name">
                                <img src="/images/profile_avatar.png" class="avatar">
                                <h4>댓글작성자이름</h4>
                            </div>
                            <div class="community-comment-article">
                                <p>댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글</p>
                            </div>
                        </li>
                        <li>
                            <div class="community-comment-name">
                                <img src="/images/profile_avatar.png" class="avatar">
                                <h4>댓글작성자이름</h4>
                            </div>
                            <div class="community-comment-article">
                                <p>댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="community-list-box">
                <div class="community-list-box-inner">
                    <div class="community-list-title clear">
                        <h3>제목제목제목제목제목제목제목제목제목</h3>
                        <p class="community-list-author">
                            <img src="/images/profile_avatar.png" class="avatar">
                            작성자 이름
                        </p>
                    </div>
                    <div class="community-list-article">
                        <p>내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용 내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용.</p>
                    </div>
                    <div class="community-list-comment clear">
                        <div class="community-comment-input-wrap">
                            <input type="text">
                            <div class="image-attach">
                                <a href="#">
                                    <img src="/images/image_attach_icon.png" alt="사진첨부">
                                </a>
                            </div>
                        </div>
                        <div class="community-comment-reg">
                            <input type="submit" value="등록" class="community-comment-btn-reg">
                        </div>
                    </div>
                    <ul class="community-comment-list clear">
                        <li>
                            <div class="community-comment-name">
                                <img src="/images/profile_avatar.png" class="avatar">
                                <h4>댓글작성자이름</h4>
                            </div>
                            <div class="community-comment-article">
                                <p>댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글</p>
                            </div>
                        </li>
                        <li>
                            <div class="community-comment-name">
                                <img src="/images/profile_avatar.png" class="avatar">
                                <h4>댓글작성자이름</h4>
                            </div>
                            <div class="community-comment-article">
                                <p>댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글내용댓글</p>
                            </div>
                        </li>
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