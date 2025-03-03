<?php
require '../vendor/autoload.php'; // Автозагрузчик Composer для Mailgun
require '../includes/config.php'; // Конфигурация (MAILGUN_API_KEY, RECAPTCHA_SECRET_KEY)
use Mailgun\Mailgun;

header('Content-Type: application/json');

// Проверка наличия необходимых констант
if (!defined('MAILGUN_API_KEY') || !defined('RECAPTCHA_SECRET_KEY')) {
    http_response_code(500);
    echo json_encode(['errors' => ['Отсутствуют необходимые ключи API в конфигурации']]);
    exit;
}
// Проверка метода запроса
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(['errors' => ['Метод не разрешен']]);
    exit;
}

// Конфигурация обязательных файлов для каждого гражданства
$docRequirements = [
    'РФ (Россия)' => ['passport_rf' => true],
    'ЕАЭС (Беларусь)' => ['passport_belarus' => true],
    'ЕАЭС (Армения, Киргизия, Казахстан)' => ['passport_eaes' => true],
    'ВНЖ' => ['passport_vnj' => true, 'vnj_document' => true],
    'РВП' => ['passport_rvp' => true, 'rvp_document' => true],
    'СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)' => ['passport_sng' => true, 'patent_sng' => true],
    'Студент' => ['passport_student' => true, 'edu_certificate_student' => true],
    'Лицо без гражданства' => ['temp_id_lbg' => true],
    'Беженец' => ['refugee_id' => true],
    'Временное убежище' => ['temp_asylum' => true],
    'ЛНР/ДНР/Украина' => ['passport_ldnr' => true]
];

// Валидация данных
$errors = [];
$data = [
    'lastName' => filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '',
    'firstName' => filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '',
    'middleName' => filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '',
    'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '',
    'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?: '',
    'citizenship' => filter_input(INPUT_POST, 'citizenship', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '',
    'consent' => isset($_POST['consent'])
];

/// Основные проверки
if (!$data['lastName']) $errors[] = "Фамилия обязательна";
if (!$data['firstName']) $errors[] = "Имя обязательно";
if (!$data['phone']) {
    $errors[] = "Телефон обязателен";
} elseif (!preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $data['phone'])) {
    $errors[] = "Неверный формат телефона";
}
if (!$data['email'] || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Неверный формат email";
}
if (!$data['citizenship']) $errors[] = "Гражданство обязательно";
if (!$data['consent']) $errors[] = "Необходимо согласие на обработку данных";

// Валидация reCAPTCHA
$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
if (!$recaptchaResponse) {
    $errors[] = "Пройдите проверку reCAPTCHA";
} else {
    $secretKey = RECAPTCHA_SECRET_KEY; // Из config.php
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $response = file_get_contents($url . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
    $responseData = json_decode($response, true);
    if (!$responseData['success']) {
        $errors[] = "Ошибка проверки reCAPTCHA";
    }
}

// Валидация файлов
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
$maxSize = 10 * 1024 * 1024; // 10MB максимум
$attachments = [];

if (isset($docRequirements[$data['citizenship']])) {
    foreach ($docRequirements[$data['citizenship']] as $field => $required) {
        if ($required && empty($_FILES[$field]['tmp_name'])) {
            $errors[] = "Файл $field обязателен";
        } elseif (!empty($_FILES[$field]['tmp_name'])) {
            $file = $_FILES[$field];
            $fileType = mime_content_type($file['tmp_name']);
            if (!in_array($fileType, $allowedTypes)) {
                $errors[] = "Файл {$file['name']} должен быть JPG, PNG или PDF";
            }
            if ($file['size'] > $maxSize) {
                $errors[] = "Файл {$file['name']} превышает 10MB";
            }
            $attachments[] = [
                'filePath' => $file['tmp_name'],
                'filename' => $file['name']
            ];
        }
    }
}

// Дополнительно добавляем все необязательные файлы, если они загружены
foreach ($_FILES as $field => $file) {
    if (!empty($file['tmp_name']) && !in_array($field, array_keys($docRequirements[$data['citizenship']] ?? []))) {
        $fileType = mime_content_type($file['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Файл {$file['name']} должен быть JPG, PNG или PDF";
        }
        if ($file['size'] > $maxSize) {
            $errors[] = "Файл {$file['name']} превышает 10MB";
        }
        $attachments[] = [
            'filePath' => $file['tmp_name'],
            'filename' => $file['name']
        ];
    }
}

// Если есть ошибки, возвращаем их
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit;
}

// Формирование письма
$subject = "Новая заявка на трудоустройство.";
$message = "
    <h1>Курлык-Курлык! Прими почтового голубя..</h1>
    <h3><strong>ФИО:</strong> {$data['lastName']} {$data['firstName']} {$data['middleName']}</h3>
    <h3><strong>Телефон:</strong> {$data['phone']}</h3>
    <h3><strong>Email:</strong> {$data['email']}</h3>
    <h3><strong>Гражданство:</strong> {$data['citizenship']}</h3>
    <h1>Документы:</h1>
    <ul>" . implode('', array_map(fn($a) => "<li>{$a['filename']}</li>", $attachments)) . "</ul>
";

// Отправка через Mailgun
$mg = Mailgun::create(MAILGUN_API_KEY);
$domain = 'sandbox7ec456c8be9841d3b6133c7a43c9327b.mailgun.org';

try {
    $mg->messages()->send($domain, [
        'from' => 'Заявка <postmaster@24metiztorg-samokat.ru>',
        'to' => 'metiztorgtech@gmail.com',
        'subject' => $subject,
        'html' => $message,
        'attachment' => $attachments
    ]);

    http_response_code(200);
    echo json_encode(['redirect' => '/forms/success.php']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['errors' => ['Ошибка отправки письма: ' . $e->getMessage()]]);
}