<?php
session_start();
include("Connection.php");
include("config.php");

if (isset($_POST['button'])) :
    if (isset($_POST['g-recaptcha-response'])) :
        $captcha = $_POST['g-recaptcha-response'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
    endif;
    foreach ($fields as $field => $value) :
        if (empty($_POST[$field])) {
            $message = "Veuillez renseigner tous les champs";
        } else if (!preg_match("~" . $value['pattern'] . "~", $_POST[$field])) {
            $message = "Veuillez respecter le format requis";
        } else if (!isset($checkbox)) {
            $message = "Veuillez accepter les conditions générales d'utilisation";
        } else if (!$responseKeys["success"]) {
            $message = "Veuillez certifier que vous n'êtes pas un robot";
        }
    endforeach;

    if (!empty($message)) :
        $error = $message;
    else :
        $identifier = new Connection($server, $dbname, $user, $pwd);
        $connection = $identifier->connect();
        $request = $connection->prepare("insert into `people` values (null,:lastname,:firstname,:phone,:mail)");
        foreach ($fields as $field => $value) { $request->bindParam(':' . $field, $_POST[$field]); }
        $request->execute();
        $request->closeCursor();
        $connection = null;

        mail($mail, 'reply', $mail, 'From: John DOE');
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact us</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="main.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet"/>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body>
<div class="l-pattern">
    <div class="l-pattern__inner">
        <header class="l-header">
            <h1 class="l-header__title">Nous contacter</h1>
        </header>
        <main class="l-main">
            <?php if (!isset($_POST['button']) || !empty($error)): ?>
                <div class="o-form">
                    <form class="o-form__main" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <div class="o-form__field">
                            <?php foreach ($fields as $field => $value): ?>
                                <label class="o-form__label" for="<?= $field ?>"><?= $value['label'] ?> : </label>
                                <input class="o-form__input" type="<?= $value['type'] ?>"
                                       required="<?= $value['required'] ?>" pattern="<?= $value['pattern'] ?>"
                                       name="<?= $field ?>" id="<?= $field ?>"
                                       value="<?php if (isset($_POST[$field])) { echo $_POST[$field]; } ?>"/>
                            <?php endforeach; ?>
                        </div>
                        <div class="o-form__box">
                            <div class="o-form__rgpd">
                                <input class="o-form__checkbox" type="checkbox" id="checkbox" name="checkbox"/>
                                <label for="checkbox" class="o-form__label">
                                    J'ai lu et j'accepte les <a href="" class="c-link">conditions
                                        générales d'utilisation</a> ainsi que la <a href="" class="c-link">
                                        politique de protection des données personnelles</a>
                                </label>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LfEibYZAAAAAGm5-eIQMCRqhK7lOC6CtI5ida4S"
                                 data-theme="dark"></div>
                            <?php if (!empty($error)) : ?>
                                <span class="error"><?= $error; ?></span>
                            <?php endif; ?>
                        </div>
                        <button class="o-form__button" type="submit" name="button">Envoyer</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="c-thanks">
                    <p class="c-thanks__text c-text">Bonjour Mr/Mme
                        <strong><span class=u-cap><?= $_POST['lastname'] ?></span>
                            ,</strong>
                        <br/>votre demande a bien été prise en compte, nous vous remercions de nous aider à
                        améliorer
                        nos
                        services et
                        vous
                        contacterons aux coordonnées suivantes dans les plus brefs délais</p>
                    <div class="c-thanks__center c-center">
                        <p class="c-thanks__contact c-text">email: <?= $_POST['mail'] ?>
                            <br/>téléphone: <?= $_POST['phone'] ?></p>
                        <a class="c-link" href="index.php">Retour</a>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
</body>
</html>
