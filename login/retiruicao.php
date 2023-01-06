<?php
/*
* @𝓐𝓾𝓽𝓱𝓸𝓻   𝓟 𝓾 𝓰 𝓷 𝓸
*
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓦𝓱𝓪𝓽𝓼𝓪𝓹𝓹  >> (61) 9603-7036 
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓣𝓮𝓵𝓮𝓰𝓻𝓪𝓶  >> 𝓽.𝓶𝓮/𝓹𝓾𝓰𝓷𝓸_𝓯𝓬
*
*/
error_reporting(0);

if (file_exists("cookie.txt")!== false) {unlink("cookie.txt");fopen
("cookie.txt", 'w+');fclose
("cookie.txt");}else{fopen
  ("cookie.txt", 'w+');fclose
  ("cookie.txt");}

  function getStr($string, $start, $end) {
     $str = explode($start, $string);
     $str = explode($end, $str[1]);  
     return $str[0];
 }

 function multiexplode($string) {
    $delimiters = array("|");
     #$delimiters = array("|", ";", ":", "/", "»", "«", ">", "<");
     $one = str_replace($delimiters, $delimiters[0], $string);
     $two = explode($delimiters[0], $one);
     return $two;
 }

 $lista = $_GET['lista'];



 $cpf = multiexplode($lista)[0];
 $data= multiexplode($lista)[1];

$timestamp = strtotime($data); 
$newDate = date("Y-m-d", $timestamp);



#Remover caracteres especiais do CPF
 function RemoveSpecialChar($str){
    $res = preg_replace('/[-\@\.\;\" "]+/', '', $str);
    return $res;
}

$cpf = RemoveSpecialChar($cpf);



$url = 'https://valoresareceber.bcb.gov.br/publico/rest/valoresAReceber/'.$cpf.'/'.$newDate;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
#curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookie.txt");
#curl_setopt($ch, CURLOPT_COOKIEFILE , getcwd()."/cookie.txt");
//curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="98", "Google Chrome";v="98"',
'accept: application/json, text/plain, */*',
'sec-ch-ua-mobile: ?0',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'sec-ch-ua-platform: "Windows"',
'sec-fetch-site: same-origin',
'sec-fetch-mode: cors',
'sec-fetch-dest: empty',
'referer: https://valoresareceber.bcb.gov.br/publico/',
));

$p1 = curl_exec($ch);
if (strpos($p1,'temValorAReceber":true')) {
    echo "#Aprovada $lista";
}else{
    echo "Reprovado $lista";
}
