<?php 
error_reporting(0);
$k_google = '6LcySMAUAAAAAKAtDqnrkEQ2XlzoruVI_wd2IRrz';
$url = 'https://recargapay.com.br';
$key_2cap = 'a5f40bbde854bc9eaa6eccfe32ce365f';


class getConnection {


	public function filtro($string){
		return $v1 = explode("|", $string)[1];
	}

		public function enviar($k_google, $key_2cap, $url)
	{
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => "http://2captcha.com/in.php?key=$key_2cap&method=userrecaptcha&googlekey=$k_google&pageurl=$url",
			CURLOPT_RETURNTRANSFER => true,	
			$headers = array(
			),
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_CUSTOMREQUEST => "GET"
		]);
		return $response = curl_exec($ch);
		
	}

	public function resolvido($key_2cap, $id)
	{
		while (true) {
			usleep(200);			
			$ch = curl_init();
			curl_setopt_array($ch, [
				CURLOPT_URL => "https://2captcha.com/res.php?key=$key_2cap&action=get&id=$id&json=1",
				CURLOPT_RETURNTRANSFER => true,	
				$headers = array(
				),
				CURLOPT_HTTPHEADER => $headers,
				CURLOPT_CUSTOMREQUEST => "GET"
			]);
			$response = curl_exec($ch);
			$resposta = json_decode($response, true)['request'];

			if ($resposta != 'CAPCHA_NOT_READY') {
				return $resposta;
				break;
			}
		}
	}
}

$authenticate = new getConnection();
$enviar = $authenticate->enviar($k_google, $key_2cap, $url);
$id = $authenticate->filtro($enviar);
$resolvido = $authenticate->resolvido($key_2cap, $id);

