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
$email = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];
##### FIM DA PARTE BÁSICA ######

#########################
##### FAZER O LOGIN #####
#########################


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.vivo.com.br/loginmarca/br/com/vivo/marca/portlets/loginunificado/doLoginConvergente.do");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Host: login.vivo.com.br',
  'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
  'Content-Type: application/x-www-form-urlencoded',
  'Accept: application/json, text/javascript, */*; q=0.01',
  'X-Requested-With: XMLHttpRequest',
  'Origin: https://login.vivo.com.br',
  'Referer: https://login.vivo.com.br/loginmarca/appmanager/marca/publico?acesso=paravoce'
  ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'cpf=37413006839&senha=448448&origem=null&associaMobileConnect=false'); 
$login = curl_exec($ch);

#"message": "SUCCESS",
$token2 = trazer($login, 'oam-oauth-token=',';');



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.vivo.com.br/saml2/idp/sso/initiator");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: login.vivo.com.br',
'Origin: https://login.vivo.com.br',
'Content-Type: application/x-www-form-urlencoded',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: https://login.vivo.com.br/loginmarca/appmanager/marca/publico?acesso=paravoce'
  ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'SPName=sp_mv&RequestURL=null'); 
$resp1 = curl_exec($ch);


$SAMLResponse = urlencode(trazer($resp1, '"SAMLResponse" value="','"'));


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://meuvivo.vivo.com.br/saml2/sp/acs/post");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: meuvivo.vivo.com.br',
'Origin: https://login.vivo.com.br',
'Content-Type: application/x-www-form-urlencoded',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: https://login.vivo.com.br/'
  ));
curl_setopt($ch, CURLOPT_POSTFIELDS, "RelayState=null&SAMLResponse=$SAMLResponse&SPName=sp_mv"); 
$resp1 = curl_exec($ch);


curl_setopt($ch, CURLOPT_URL, "https://meuvivo.vivo.com.br/meuvivo/appmanager/portal/tv?_nfpb=true&_nfls=false&_pageLabel=vcMeuVivoTVVivo2Book&pFlutua=true");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: meuvivo.vivo.com.br',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: https://login.vivo.com.br/'
  ));
$resp2 = curl_exec($ch);

$token = trazer($resp2, 'token=','&');
$productId = trazer($resp2, "productId=","'");



curl_setopt($ch, CURLOPT_URL, "https://legado.vivo.com.br/portal/site/meuvivo/meuvivohome?token=$token&productId=$productId");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: legado.vivo.com.br',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: https://meuvivo.vivo.com.br/'
  ));
$resp3 = curl_exec($ch);

$jsessionid = trazer($resp3, 'JSESSIONID=',';');
$VGN_NONCE = trazer($resp3, 'VGN_NONCE" value="','"');

curl_setopt($ch, CURLOPT_URL, "https://legado.vivo.com.br/portal/site/meuvivo/template.LOGIN/action.process/;jsessionid=$jsessionid");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: legado.vivo.com.br',
'Origin: https://legado.vivo.com.br',
'Content-Type: application/x-www-form-urlencoded',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: https://legado.vivo.com.br/portal/site/meuvivo/meuvivohome?token='.$token.'&productId='.$productId.''
  ));
curl_setopt($ch, CURLOPT_POSTFIELDS, "ckcTipoLogin=2&txtLoginCPFCNPJ=&txtLoginTelefone=$productId&pswSenha=&VGN_NONCE=$VGN_NONCE&token=$token&product=$productId&dependent=&redirect=%2Fportal%2Fsite%2Fmeuvivo%2Fmeuvivohome&logon=&password=&realm=realm1");
$resp4 = curl_exec($ch);


curl_setopt($ch, CURLOPT_URL, "https://legado.vivo.com.br/portal/site/meuvivo/meuvivohome");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: legado.vivo.com.br',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: https://legado.vivo.com.br/portal/site/meuvivo/meuvivohome?token='.$token.'&productId='.$productId.''
  ));
$resp5 = curl_exec($ch);



curl_setopt($ch, CURLOPT_URL, "https://appstore.vivo.com.br/sc/br/tfixa?token=$token2");
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: appstore.vivo.com.br',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: https://meuvivo.vivo.com.br/'
  ));
$resp6 = curl_exec($ch);

#5822b5f19dd9ebd6417b246b908d9be1

curl_setopt($ch, CURLOPT_URL, "https://appstore.vivo.com.br/sc/br/vivostore/e502f38e8a53984dde15e84ca8f66d0d/cst/?w=internal&p=flow");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: appstore.vivo.com.br',
'Connection: keep-alive',
'Accept: */*',
'X-Requested-With: XMLHttpRequest',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36',
'Content-Type: application/json',
'Sec-GPC: 1',
'Origin: https://appstore.vivo.com.br',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-Mode: cors',
'Sec-Fetch-Dest: empty',
'Referer: https://appstore.vivo.com.br/sc/br/tfixa?token='.$token2,
'Accept-Language: pt-BR,pt;q=0.9'));

curl_setopt($ch, CURLOPT_POSTFIELDS, '{"action":"tsc.as.token","data":{"s":8076,"idustype":2,"pno":62633},"dometrics":false}');
echo $resp7 = curl_exec($ch);



?>