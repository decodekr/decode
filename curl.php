<?php
// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://www.bank-i.co.kr/product2_result.asp?trigger=%B0%E6%B1%E2%B5%B5&sigugun=%B0%ED%BE%E7%BD%C3%20%C0%CF%BB%EA%B5%BF%B1%B8&dong=%B9%E9%BC%AE%B5%BF&danji=%B4%EB%BF%EC%C0%CC%BE%C8&pyung=137.61%A7%B3&bankcode=&bondhigh=&houseAmount=0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Connection: keep-alive';
$headers[] = 'Pragma: no-cache';
$headers[] = 'Cache-Control: no-cache';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
$headers[] = 'Accept: image/webp,image/apng,image/*,*/*;q=0.8';
$headers[] = 'Referer: http://www.bank-i.co.kr/product2_result.asp?trigger=%B0%E6%B1%E2%B5%B5&sigugun=%B0%ED%BE%E7%BD%C3%20%C0%CF%BB%EA%B5%BF%B1%B8&dong=%B9%E9%BC%AE%B5%BF&danji=%B4%EB%BF%EC%C0%CC%BE%C8&pyung=137.61%A7%B3&bankcode=&bondhigh=&houseAmount=0';
$headers[] = 'Accept-Language: ko,zh;q=0.9,en;q=0.8,en-US;q=0.7';
$headers[] = 'Cookie: ASPSESSIONIDSAQBQRSR=OGLNBONDHBOBDDONEFLMJJKP; __utma=131807644.1570595372.1588589646.1588589646.1588589646.1; __utmc=131807644; __utmz=131807644.1588589646.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __utmt=1; __utmb=131807644.4.10.1588589646';
$headers[] = 'Authority: www.google.co.kr';
$headers[] = 'X-Client-Data: CJe2yQEIo7bJAQjBtskBCKmdygEI0K/KAQi8sMoBCO21ygEIjrrKARi8usoB';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'Sec-Fetch-Mode: no-cors';
$headers[] = 'Sec-Fetch-Dest: image';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
echo $result;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);