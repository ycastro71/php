<?php

set_time_limit(610);

require(__DIR__ . '/../src/autoloader.php');

$solver = new \TwoCaptcha\TwoCaptcha('a5f40bbde854bc9eaa6eccfe32ce365f');

try {
    $result = $solver->recaptcha([
        'sitekey' => '6LcySMAUAAAAAKAtDqnrkEQ2XlzoruVI_wd2IRrz',
        'url'     => 'https://recargapay.com.br',
    ]);
} catch (\Exception $e) {
    die($e->getMessage());
}

die('Captcha solved: ' . $result->code);
