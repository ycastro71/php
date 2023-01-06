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
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓦𝓱𝓪𝓽𝓼𝓪𝓹𝓹  >> (61) 9603-7036 
* 𝓒𝓸𝓷𝓽𝓪𝓬𝓽   𝓣𝓮𝓵𝓮𝓰𝓻𝓪𝓶  >>  @pugno_fc
*
*/

#############################################
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
##### FIM DA PARTE BÁSICA ######


#########################
##### FAZER O LOGIN #####
#########################

#  G E T    D A S     V E R I F I C A Ç Õ E S
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.sistemaup.app/v1/search/cnh20codseg/cpf');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'accept: application/json, text/plain, */*',
  'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36',
  'content-type: application/json;charset=UTF-8',
  'sec-gpc: 1',
  'origin: https://sistemaup.app',
  'sec-fetch-site: same-site',
  'sec-fetch-mode: cors',
  'sec-fetch-dest: empty',
  'referer: https://sistemaup.app/',
  'accept-language: pt-BR,pt;q=0.9',
  'cookie: auth.token=s%3AeyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2MWM5Mzk2ZGJiZWUyNGZhMmI5NmIxZTAiLCJ1c2VybmFtZSI6InNoYWRvd2J6MyIsImxldmVsIjoxLCJkdWVEYXRlIjoiIiwicGxhbiI6IjVmZDk3YzRhNTEzY2JiMDliZjgxYTEwZCIsInVzZXJJcCI6IjQ1LjIyNi42Mi42NSIsImlhdCI6MTY0OTU0NjUyNSwiZXhwIjoxNjQ5NTc1MzI1fQ.ekkgphVM-1daHB-xPgW6cd9luKVQg7JFMQxSV80swDE.4WQDsrdBER%2F%2BBBUSreo9oj2mtCQSr2RIE%2Fi57SlGucM',
));
curl_setopt($ch, CURLOPT_POSTFIELDS,'{"cpf":"'.$cpf.'"}');
$r1 = curl_exec($ch);

if (strpos($r1, "limits")) {
  $limite = getStr($r1,'"remaining":',',');
  if ($limite > 0) {
    if (strpos($r1,'CNH não encontrada.')) {
      echo "#Aprovada $cpf | Retorno: CNH não encontrada. | Limite: $limite";
    }elseif (strpos($r1,'numeroRegistro')) {
      echo "Reprovada $cpf | Retorno: CNH encontrada | Limite: $limite";
    } else {
     echo "Erro na consulta";
    }

  }else{
    echo "Seu limite acabou";
  }
}else{
  echo "Erro desconhecido fala com @pugno";
}
?>