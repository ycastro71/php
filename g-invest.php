<?php
error_reporting(0);

if (file_exists("cookie.txt")!== false) {unlink("cookie.txt");fopen
  ("cookie.txt", 'w+');fclose
  ("cookie.txt");}else{fopen
  ("cookie.txt", 'w+');fclose
  ("cookie.txt");}

function trazer($string, $start, $end) {
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
$cc = multiexplode($lista)[0];
$mes = multiexplode($lista)[1];

##### FIM DA PARTE BÁSICA ######


#########################
##### FAZER O LOGIN #####
#########################

#teclado
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://plataforma-api.production.api.genial.systems/api/v1/Login/teclado-virtual');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
#curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookie.txt");
#curl_setopt($ch, CURLOPT_COOKIEFILE , getcwd()."/cookie.txt");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: plataforma-api.production.api.genial.systems',
'Connection: keep-alive',
'x-Origin-ID: 39ba1b3d87f042459f8ec982e5eae355b59b1e05b9e4422ea7a7967eb98ca94f',
'Accept: application/json, text/plain, */*',
'Authorization: null',
'X-Web-Version: 1.3.14',
'Origin: https://app.genialinvestimentos.com.br',
'Referer: https://app.genialinvestimentos.com.br/'
  ));
#curl_setopt($ch, CURLOPT_POSTFIELDS,'{"email":"andrielly.floresantos2205@outlook.com","sequenciaLetras":"cadcbb","hash":"ac037779-92c4-4546-a945-a05db153e7ec"}');
 $p1 = curl_exec($ch);

#letra
$letras = trazer($p1,'"a"','}');
$hash = trazer($p1,'hashSequencia":"','"');




echo $letraA = trazer($letras,'a":','],').']';
 $letraB = trazer($letras,'b":','],').']';
 $letraC = trazer($letras,'c":','],').']';
 $letraD = trazer($letras,'d":','],').']';
 $letraE = trazer($letras,'e":','],');


echo "<br>";






exit();



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://plataforma-api.production.api.genial.systems/api/v1/login');
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
#curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookie.txt");
#curl_setopt($ch, CURLOPT_COOKIEFILE , getcwd()."/cookie.txt");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: plataforma-api.production.api.genial.systems',
'Connection: keep-alive',
'Accept: application/json, text/plain, */*',
'Authorization: null',
'X-Web-Version: 1.3.14',
'Content-Type: application/json;charset=UTF-8',
'Origin: https://app.genialinvestimentos.com.br',
'Referer: https://app.genialinvestimentos.com.br/'
  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,'{"email":"andrielly.floresantos2205@outlook.com","sequenciaLetras":"null","hash":"'.$hash.'"}');
echo  $p1 = curl_exec($ch);

?>