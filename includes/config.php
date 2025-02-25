<?php

// Проверяем, объявлена ли уже константа перед ее созданием
if (!defined('GOOGLE_SPREADSHEET_ID')) {
    define('GOOGLE_SPREADSHEET_ID', '1M6WJwYjPCAPJhpovpbS-szkbAmBMNeR0AaOdE1eNAyE'); // ID Google Таблицы
}

if (!defined('GOOGLE_KEY_PATH')) {
    define('GOOGLE_KEY_PATH', __DIR__ . '/../config/google/google-key.json'); // Путь к API ключу
}

// Подключаем конфигурацию Yandex API, если она еще не была загружена
$yandexConfigPath = __DIR__ . '/../config/yandex/yandex-key.php';
if (file_exists($yandexConfigPath)) {
    $yandexConfig = require $yandexConfigPath;
    if (!defined('YANDEX_API_KEY')) {
        define('YANDEX_API_KEY', $yandexConfig['YANDEX_API_KEY']);
    }
}

// Подключаем конфигурацию Mailgun API, если она еще не была загружена
$mailgunConfigPath = __DIR__ . '/../config/mailgun/mailgun-key.php';
if (file_exists($mailgunConfigPath)) {
    $mailgunConfig = require $mailgunConfigPath;
    if (!defined('MAILGUN_API_KEY')) {
        define('MAILGUN_API_KEY', $mailgunConfig['MAILGUN_API_KEY']);
    }
}
