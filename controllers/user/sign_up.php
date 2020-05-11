<?php
include 'views/header.html';
?>
<?php

if($param['has_data']==1){

    if($param['id']==''){
        printMessage('아이디를 입력해주세요');
        exit;
    }
    if($param['password']==''){
        printMessage('비밀번호를 입력해주세요');
        exit;
    }
    $password = $param['password'];
    $id = $param['id'];
    $user=getItem('users','id="'.$id.'"');

    if(!$user) {
        printMessage('아이디 또는 비밀번호를 확인해주세요');
        exit;
    }
    else {
        if($user['password']!=$param['password']){
            printMessage('아이디 또는 비밀번호를 확인해주세요');
            exit;
        }
        else{
            $session['login']=$user['no'];
            $session['id']=$user['id'];
            $session['name']=$user['name'];
            getBack('/');
        }
    }

    exit;
}
?>
    <div class="sub-heading">
        <div class="container">
            환영합니다! 라잇루트 브리지입니다.
        </div>
    </div>
    <div id="content">
        <div class="container">
            <ul class="tab-menu">
                <li><a href="#">로그인</a></li>
                <li class="active"><a href="#">회원가입</a></li>
            </ul>
            <div class="sign-up-wrap">
            <h3 class="sign-up-heading">필수 정보 입력</h3>
            <table class="sign-up-table">
                <tr>
                    <th>회원 구분</th>
                    <td>
                        <input type="checkbox"><label>디자이너</label>
                        <input type="checkbox"><label>기업</label>
                        <input type="checkbox"><label>일반</label>
                    </td>
                </tr>
                <tr>
                    <th>아이디 (이메일)</th>
                    <td>
                        <input type="text">@<input type="text">사용 가능한 아이디입니다.
                    </td>
                </tr>
                <tr>
                    <th>비밀번호</th>
                    <td>
                        <input type="text">
                    </td>
                </tr>
                <tr>
                    <th>비밀번호 확인</th>
                    <td>
                        <input type="text">
                    </td>
                </tr>
                <tr>
                    <th>소속</th>
                    <td>
                        <input type="text">
                        <input type="checkbox"><label>프리랜서</label>
                        <input type="checkbox"><label>없음</label>
                    </td>
                </tr>
                <tr>
                    <th>휴대전화</th>
                    <td>
                        <input type="text">
                    </td>
                </tr>
            </table>
            <div class="sign-up-legal">
                <h3 class="sign-up-legal-heading">약관 동의</h3>
                <table class="sign-up-legal-table">
                    <tr>
                        <th>
                            <input type="checkbox"><label>라잇루트 브리지 이용약관 동의 (필수)</label>
                        </th>
                        <th>
                            <input type="checkbox"><label>개인정보 수집 및 이용 동의 (필수)</label>
                        </th>
                    </tr>
                    <tr>
                        <td class="sign-up-legal-cell"></td>
                        <td class="sign-up-legal-cell"></td>
                    </tr>
                    <tr>
                        <th><input type="checkbox"><label>마케팅 정보 수신 동의 (선택)</label></th>
                        <th rowspan="2" class="sign-up-confirm-cell"><input type="submit" class="sign-up-confirm-btn" value="가입하기"></th>
                    </tr>
                    <tr>
                        <td class="sign-up-legal-cell"></td>
                    </tr>
                </table>
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