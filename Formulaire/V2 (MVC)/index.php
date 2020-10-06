<?php
include 'controller/Main.php';
include('Config.php');
use model\Manage;
$input = false;
$check = "";
$captcha = "";
$verif = false;
$identifier = new Manage(server, dbname, user, pwd);
if (isset($button)):

    $key = captcha(secretKey);
    $input = fieldsVerif(fields);
    $captcha = captchaVerif($key);
    $check = checkVerif($_POST['checkbox']);
    $verif = verif($input, $captcha, $check);
    if ($verif == true) {
        $identifier->insert(fields);
        mail($_POST['mail'], 'reply', message, 'From: John DOE');
    }
endif;
include 'C:/laragon/www/exo/form_mvc/view/Form.php';