<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact us</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="css/style.css"/>
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
			<?php if (!isset($_POST['button']) || !$verif): ?>
                <div class="o-form">
                    <form class="o-form__main" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <div class="o-form__field">
							<?php foreach (fields as $field => $value): ?>
                                <label class="o-form__label" for="<?= $field ?>"><?= $value['label'] ?> : </label>
                                <input class="o-form__input" type="<?= $value['type'] ?>"
                                       required="<?= $value['required'] ?>" pattern="<?= $value['pattern'] ?>"
                                       name="<?= $field ?>" id="<?= $field ?>"
                                       value="<?php if (isset($_POST[$field])) {
										   echo $_POST[$field];
									   } ?>"/>
								<?php if (isset($_POST['button'])) {
									if (empty($_POST[$field])) { ?>
                                        <span class="error">Veuillez renseigner votre <?= $value['label']; ?> <br/></span>
									<?php } else if (!preg_match("~" . $value['pattern'] . "~", $_POST[$field])) { ?>
                                        <span class="error">Veuillez respecter le format requis <br/></span>
									<?php }
								} ?>
							<?php endforeach; ?>
                        </div>
                        <div class="o-form__box">
                            <div class="o-form__rgpd">
                                <input class="o-form__checkbox" type="checkbox" id="checkbox" name="checkbox"/>
                                <label for="checkbox" class="o-form__label c-label--check">
                                    J'ai lu et j'accepte les <a href="" class="c-link">conditions
                                        générales d'utilisation</a> ainsi que la <a href="" class="c-link">
                                        politique de protection des données personnelles</a>
                                </label>
                            </div>
							<?php if (!empty($check)) : ?>
                                <span class="error"><?= $check; ?></span>
							<?php endif; ?>
                            <div class="g-recaptcha" data-sitekey="6LfEibYZAAAAAGm5-eIQMCRqhK7lOC6CtI5ida4S"
                                 data-theme="dark"></div>
                        </div>
						<?php if (!empty($captcha)) : ?>
                            <span class="error"><?= $captcha; ?></span>
						<?php endif; ?>
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