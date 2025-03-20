<?php


if (!defined('GOOGLE_SPREADSHEET_ID')) {
    define('GOOGLE_SPREADSHEET_ID', '1M6WJwYjPCAPJhpovpbS-szkbAmBMNeR0AaOdE1eNAyE'); // ID Google Таблицы
}

if (!defined('GOOGLE_KEY_PATH')) {
    define('GOOGLE_KEY_PATH', __DIR__ . '/../config/google/google-key.json'); // Путь к API ключу
}

// Yandex API
$yandexConfigPath = __DIR__ . '/../config/yandex/yandex-key.php';
if (file_exists($yandexConfigPath)) {
    $yandexConfig = require $yandexConfigPath;
    if (!defined('YANDEX_API_KEY')) {
        define('YANDEX_API_KEY', $yandexConfig['YANDEX_API_KEY']);
    }
}

// Mailgun API
$mailgunConfigPath = __DIR__ . '/../config/mailgun/mailgun-key.php';
if (file_exists($mailgunConfigPath)) {
    $mailgunConfig = require $mailgunConfigPath;
    if (!defined('MAILGUN_API_KEY')) {
        define('MAILGUN_API_KEY', $mailgunConfig['MAILGUN_API_KEY']);
    }
    if (!defined('MAILGUN_DOMAIN')) {
        define('MAILGUN_DOMAIN', $mailgunConfig['MAILGUN_DOMAIN']);
    }
}
//  reCAPTCHA
$recaptchaConfigPath = __DIR__ . '/../config/google/recaptcha-keys.php';
if (file_exists($recaptchaConfigPath)) {
    $recaptchaConfig = require $recaptchaConfigPath;
    if (!defined('RECAPTCHA_SECRET_KEY')) {
        define('RECAPTCHA_SECRET_KEY', $recaptchaConfig['RECAPTCHA_SECRET_KEY']);
    }
}
