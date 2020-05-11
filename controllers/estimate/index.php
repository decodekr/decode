<?php

include 'views/header.html'
?>
<div class="sub-heading">
    <div class="container">
        쉽고 간편하게 단체복을 제작해보세요.
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="sub-container-default">
            <h3 class="second-sub-heading-default">
                <span>단체복 견적 문의</span>
            </h3>
            <div class="sub-explain">
                <p>아래의 양식을 채우신 후 ‘문의하기’를 눌러주세요!</p>
                <p>영업시간 기준 2시간 이내로 답변 드립니다.</p>
                <p>(영업시간 : 월 - 금, 09시 ~ 16시, 공휴일 제외)</p>
            </div>
            <table class="table-default uniform-request-table">
                <tr>
                    <th>품목</th>
                    <td>
                        <select>
                            <option>선택하기</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>색상</th>
                    <td>
                        <div class="select-colors">
                            <ul class="select-colors-list clear">
                                <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li>
                                <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li>
                                <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li>
                                <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li>
                                <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li>
                                <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li>
                                <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li> <li>
                                    <div class="select-color-circle"></div>
                                    <div class="select-color-checkbox">
                                        <input type="checkbox">
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>로고</th>
                    <td>
                        <div class="file-box">
                            <input type="file">
                        </div>
                        <div class="file-attach-guide">
                            <p>* 원활한 제작을 위해 .ai 파일만 첨부 가능합니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>로고 위치</th>
                    <td>
                        <div class="uniform-logo-position-select">
                            <ul>
                                <li>
                                    <input type="checkbox">
                                    <label>옆면 중앙</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>뒷면 중앙</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>오른쪽 가슴</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>왼쪽 가슴</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>오른쪽 소매 상단</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>왼쪽 소매 상단</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>오른쪽 소매 하단</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>왼쪽 소매 하단</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>기타</label>
                                    <input type="text" placeholder="직접입력">
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>로고 크기</th>
                    <td>
                        <div class="uniform-logo-size clear">
                            <div class="uniform-logo-size-horizontal">
                                <span>가로 :</span>
                                <input type="text" placeholder="직접입력">
                                <span>mm , </span>
                            </div>
                            <div class="uniform-logo-size-vertical">
                                <span>세로 :</span>
                                <input type="text" placeholder="직접입력">
                                <span>mm</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>프린트 / 자수</th>
                    <td>
                        <input type="checkbox">
                        <label>일반 나염</label>

                        <input type="checkbox">
                        <label>커팅지</label>

                        <input type="checkbox">
                        <label>자수</label>

                        <input type="checkbox">
                        <label>기타</label>

                        <input type="text" placeholder="직접입력">
                    </td>
                </tr>
                <tr>
                    <th>원단 두께</th>
                    <td>
                        <input type="checkbox">
                        <label>10수</label>

                        <input type="checkbox">
                        <label>20수</label>

                        <input type="checkbox">
                        <label>30수</label>

                        <input type="checkbox">
                        <label>기타</label>

                        <input type="text" placeholder="직접입력">
                    </td>
                </tr>
                <tr>
                    <th>사이즈별 수량</th>
                    <td>
                        <table class="uniform-size-amount-table">
                            <tr>
                                <th>사이즈</th>
                                <th>어깨단면</th>
                                <th>가슴단면</th>
                                <th>소매길이</th>
                                <th>총 기장</th>
                                <th>수량</th>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>
                                    <input type="text" placeholder="직접입력">
                                </td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>
                                    <input type="text" placeholder="직접입력">
                                </td>
                            </tr>
                            <tr>
                                <td>M</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>
                                    <input type="text" placeholder="직접입력">
                                </td>
                            </tr>
                            <tr>
                                <td>L</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>
                                    <input type="text" placeholder="직접입력">
                                </td>
                            </tr>
                            <tr>
                                <td>XL</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>
                                    <input type="text" placeholder="직접입력">
                                </td>
                            </tr>
                            <tr>
                                <td>2XL</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>
                                    <input type="text" placeholder="직접입력">
                                </td>
                            </tr>
                            <tr>
                                <td>3XL</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>00</td>
                                <td>
                                    <input type="text" placeholder="직접입력">
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr>
                    <th>수령 희망일</th>
                    <td>
                        <div class="input-calendar">
                            <input type="text" class="input-calendar-text" value="20XX. XX. XX">
                            <button class="input-calendar-button"></button>
                        </div>

                    </td>
                </tr>
            </table>
            <input type="submit" class="send-button request-button request-uniform-button" value="견적 요청하기">
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
include 'views/footer.html'
?>