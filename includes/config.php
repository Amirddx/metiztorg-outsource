<?php

define('GOOGLE_SPREADSHEET_ID', '1M6WJwYjPCAPJhpovpbS-szkbAmBMNeR0AaOdE1eNAyE'); // ID google Таблицы
define('GOOGLE_KEY_PATH', __DIR__ . '/../config/google/google-key.json'); // путь к API ключу

//config/yandex/
$yandexConfig = require __DIR__ . '/../config/yandex/yandex-key.php';
define('YANDEX_API_KEY', $yandexConfig['YANDEX_API_KEY']);

//config/mailgun/
$mailgunConfig = require __DIR__ . '/../config/mailgun/mailgun-key.php';
define('MAILGUN_API_KEY', $mailgunConfig['MAILGUN_API_KEY']);