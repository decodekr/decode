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
            <div class="message-box clear">
                <ul class="chat-list">
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                    <li>
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-list-meta">
                            <div class="chat-list-name">A A A</div>
                            <div class="chat-list-text">마지막 채팅 내용...</div>
                        </div>
                    </li>
                </ul>
                <div class="message-chat">
                    <div class="chat-name">
                        <img src="images/avatar.png" alt="" class="avatar">
                        <div class="chat-name-text">
                            A A A
                        </div>
                    </div>
                    <ul class="message-list">
                        <li class="message-box-left">
                            <div class="message-box-text-left">
                                1줄
                            </div>
                            <div class="message-box-date">
                                20XX.XX.XX  00:00
                            </div>
                        </li>
                        <li class="message-box-right">
                            <div class="message-box-text-right">
                                1줄
                            </div>
                            <div class="message-box-date">
                                20XX.XX.XX  00:00
                            </div>
                        </li>
                        <li class="message-box-left">
                            <div class="message-box-text-left">
                                1줄
                            </div>
                            <div class="message-box-date">
                                20XX.XX.XX  00:00
                            </div>
                        </li>
                        <li class="message-box-right">
                            <div class="message-box-text-right">
                                1줄
                            </div>
                            <div class="message-box-date">
                                20XX.XX.XX  00:00
                            </div>
                        </li>
                        <li class="message-box-left">
                            <div class="message-box-text-left">
                                1줄
                            </div>
                            <div class="message-box-date">
                                20XX.XX.XX  00:00
                            </div>
                        </li>
                        <li class="message-box-right">
                            <div class="message-box-text-right">
                                1줄
                            </div>
                            <div class="message-box-date">
                                20XX.XX.XX  00:00
                            </div>
                        </li>
                    </ul>
                    <div class="send-message clear">
                        <button class="message-attach-button">파일첨부</button>
                        <div class="send-message-input-box">
                            <input type="text" class="send-message-input">
                        </div>
                        <button class="send-messgae-button">전송</button>
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
