<?php

error_reporting(0);
class getConnection {

	public function getStr($string, $start, $end)
	{
		$str = explode($start, $string);
		$str = explode($end, $str[1]);
		return $str[0];
	}

	
	public function detectCPF($cpf){
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => "https://www.qualidoc.com.br/ccstorex/custom/occ-intera-business/v1/ecommerce/profiles/$cpf",			
			#CURLOPT_HEADER => true,
			CURLOPT_RETURNTRANSFER => true,
			$headers = array(
				'user-agent: Mozilla/5.0 (Linux; Android 10; moto g(7) play Build/QPYS30.52-22-2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.149 Mobile Safari/537.36',
				'content-type: application/json; charset=utf-8',
				'accept: application/json, text/javascript, */*; q=0.01',
				'sec-fetch-dest: empty',
				'x-requested-with: XMLHttpRequest',
				'sec-fetch-site: same-origin',
				'sec-fetch-mode: cors',
				'referer: https://www.qualidoc.com.br/cadastro',
				'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7'
			),
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_ENCODING => "gzip, deflate",
		]);
		$response = curl_exec($ch);
		#$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		return $response;
	}


	public function profile($cpf, $nome, $sobre, $email){
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => "https://www.qualidoc.com.br/ccstoreui/v1/profiles",			
			#CURLOPT_HEADER => true,
			CURLOPT_RETURNTRANSFER => true,
			$headers = array(
				'origin: https://www.qualidoc.com.br',
				'x+-ccpricelistgroup: precoAssociadoApp',
				'sec-fetch-dest: empty',
				'x-requested-with: XMLHttpRequest',
				'x-ccsite: siteUS',
				'x-cc-meteringmode: CC-NonMetered',
				'user-agent: Mozilla/5.0 (Linux; Android 10; moto g(7) play Build/QPYS30.52-22-2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.149 Mobile Safari/537.36',
				'content-type: application/json',
				'accept: application/json, text/javascript, */*; q=0.01',
				'x-ccprofiletype: storefrontUI',
				'sec-fetch-site: same-origin',
				'sec-fetch-mode: cors',
				'referer: https://www.qualidoc.com.br/cadastro',
			),
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => '{"firstName":"'.$nome.'","lastName":"'.$sobre.'","email":"'.$email.'","password":"*Pugno.123","x_document_tmp":"'.$cpf.'","x_celphone":"11998378188","x_medicamento_continuo":"no","x_termos":true,"x_gender":"male","receiveEmail":"yes","dateOfBirth":"1998-01-01T00:00:00.000Z","shippingAddresses":[{"alias":"","prefix":"","firstName":"'.$nome.'","middleName":"","lastName":"'.$sobre.'","suffix":"","country":"BR","postalCode":"86710145","address1":"Avenida Taperaçu Cinza","address2":"147","address3":"","city":"Arapongas","state":"PR","county":"Jardim Interlagos","phoneNumber":"11998378188","email":"'.$email.'","jobTitle":"","companyName":"","faxNumber":"","addressType":[],"type":"","repositoryId":"","isDefaultBillingAddress":false,"isDefaultShippingAddress":false,"predefinedAddressTypes":[],"isTypeModified":false,"computedDefaultBilling":false,"computedDefaultShipping":false,"selectedState":"PR","state_ISOCode":"","selectedAddressTypes":[],"isDefaultAddress":false,"dynamicProperties":[],"computedAddressType":[],"computedCountry":[],"computedState":["PR"],"types":[]}]}',
			CURLOPT_ENCODING => "gzip, deflate",
		]);
		$response = curl_exec($ch);
		#$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		return $response;
	}

	public function login($email, $senha){
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => "https://www.qualidoc.com.br/ccstoreui/v1/login",			
			#CURLOPT_HEADER => true,
			CURLOPT_RETURNTRANSFER => true,
			$headers = array(
				'origin: https://www.qualidoc.com.br',
				'x+-ccpricelistgroup: precoAssociadoApp',
				'sec-fetch-dest: empty',
				'x-requested-with: XMLHttpRequest',
				'x-ccsite: siteUS',
				'x-cc-meteringmode: CC-NonMetered',
				'user-agent: Mozilla/5.0 (Linux; Android 10; moto g(7) play Build/QPYS30.52-22-2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.149 Mobile Safari/537.36',
				'content-type: application/json',
				'accept: application/json, text/javascript, */*; q=0.01',
				'x-ccprofiletype: storefrontUI',
				'sec-fetch-site: same-origin',
				'sec-fetch-mode: cors',
				'referer: https://www.qualidoc.com.br/cadastro',
			),
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => 'grant_type=password&username='.$email.'&password='.$senha,
			CURLOPT_ENCODING => "gzip, deflate",
		]);
		$response = curl_exec($ch);
		#$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		return $response;
	}

}

$auth = new getConnection();

$tipo = $_GET['tipo'];
if ($tipo == "autocadastrador") {

	exit();	
}elseif ($tipo == "login") {
	
	$detect = $auth->detectCPF($cpf);
	exit();
}elseif ($tipo == "detect") {
	
}else{
	echo "O TIPO é um paramentro obrigatorio"; 
}
$cpf = $_GET['cpf'];
$cpf = preg_replace('/[\@\.\;\-\" "]+/', '', $cpf);


$detect = $auth->detectCPF($cpf);

if (strpos($detect, 'profile":{"firstName')) {
	$obj = json_decode($detect);

	$firstName = $obj->profile->firstName;
	$lastName = $obj->profile->lastName;
	$x_celphone = $obj->profile->x_celphone;
	$email = $obj->profile->email;

	echo "$cpf|$firstName $lastName|$x_celphone|$email";
}elseif(strpos($detect, 'profile":false')){
	$nome = $_GET['nome'];
	$sobre = $_GET['sobre'];
	$email = $_GET['email'];

	$autocadastrador = $auth->profile($cpf, $nome, $sobre, $email);
	if (strpos($autocadastrador, '"id":"')) {
		echo "Cadastrado com sucesso";
	}else{
		$message = $auth->getStr($autocadastrador,'message":"','"');
		echo "$message";
	}
}else{
	echo "erro desconhecido";
}