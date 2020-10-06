<?php

use model\Manage;


function captcha(String $key): array
{
	$responseKeys = '';
	if (isset($_POST['g-recaptcha-response'])) :
		$captcha = $_POST['g-recaptcha-response'];
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($key) . '&response=' . urlencode($captcha);
		$response = file_get_contents($url);
		$responseKeys = json_decode($response, true);
	endif;
	return $responseKeys;
}

function fieldsVerif(array $fields): bool
{
	$error = false;

	foreach ($fields as $field => $value) :
		if (empty($_POST[$field])) {
			$error = true;
		} else if (!preg_match("~" . $value['pattern'] . "~", $_POST[$field])) {
			$error = true;
		}
	endforeach;
	return $error;
}

function captchaVerif(array $response): string
{
	$captchamessage = "";
	if (!$response["success"]) {
		$captchamessage = "Veuillez certifier que vous n'êtes pas un robot";
	}
	return $captchamessage;
}

function checkVerif(String $checkbox): string
{
	$checkmessage = "";
	if (empty($checkbox)) {
		$checkmessage = "Veuillez accepter les conditions générales d'utilisation";
	}
	return $checkmessage;
}

function verif(bool $error, String $captchamessage, String $checkmessage): bool
{
	if ($error === false && empty($captchamessage) && empty($checkmessage)) {
		$verif = true;
	} else {
		$verif = false;
	}
	return $verif;
}

