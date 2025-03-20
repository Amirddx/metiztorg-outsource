<?php
require '../vendor/autoload.php';
require '../includes/config.php';
use Mailgun\Mailgun;

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit(json_encode(['errors' => ['Метод не разрешен']]));
}

if (!defined('MAILGUN_API_KEY') || !defined('MAILGUN_DOMAIN') || !defined('RECAPTCHA_SECRET_KEY')) {
    http_response_code(500);
    exit(json_encode(['errors' => ['Отсутствуют ключи API']]));
}

$docRequirements = [
    'РФ (Россия)' => ['passport_rf'],
    'ЕАЭС (Беларусь)' => ['passport_belarus'],
    'ЕАЭС (Армения, Киргизия, Казахстан)' => ['passport_eaes'],
    'ВНЖ' => ['passport_vnj', 'vnj_document'],
    'РВП' => ['passport_rvp', 'rvp_document'],
    'СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)' => ['passport_sng', 'patent_sng'],
    'Студент' => ['passport_student', 'edu_certificate_student'],
    'Лицо без гражданства' => ['temp_id_lbg'],
    'Беженец' => ['refugee_id'],
    'Временное убежище' => ['temp_asylum'],
    'ЛНР/ДНР/Украина' => ['passport_ldnr']
];

$errors = [];
$data = [
    'lastName' => filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS) ?: '',
    'firstName' => filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS) ?: '',
    'middleName' => filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_SPECIAL_CHARS) ?: '',
    'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS) ?: '',
    'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?: '',
    'citizenship' => filter_input(INPUT_POST, 'citizenship', FILTER_SANITIZE_SPECIAL_CHARS) ?: '',
    'consent' => isset($_POST['consent']),
];

if (!$data['lastName']) $errors[] = "Укажите фамилию";
if (!$data['firstName']) $errors[] = "Укажите имя";
if (!$data['phone'] || !preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $data['phone'])) $errors[] = "Укажите корректный телефон";
if (!$data['email'] || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Укажите корректный email";
if (!$data['citizenship']) $errors[] = "Укажите гражданство";
if (!array_key_exists($data['citizenship'], $docRequirements)) $errors[] = "Неверное гражданство";
if (!$data['consent']) $errors[] = "Требуется согласие";

$recaptcha = $_POST['g-recaptcha-response'] ?? '';
if (!$recaptcha) $errors[] = "Пройдите reCAPTCHA";
else {
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=" . $recaptcha);
    if (!json_decode($response, true)['success']) $errors[] = "Ошибка reCAPTCHA";
}

$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
$maxSize = 100 * 1024 * 1024; // 100MB
$attachments = [];

if (isset($docRequirements[$data['citizenship']])) {
    foreach ($docRequirements[$data['citizenship']] as $field) {
        if (empty($_FILES[$field]['tmp_name'])) {
            $errors[] = "Загрузите обязательный документ: $field";
        } else {
            $file = $_FILES[$field];
            if (!in_array(mime_content_type($file['tmp_name']), $allowedTypes)) $errors[] = "Недопустимый тип файла: {$file['name']}";
            if ($file['size'] > $maxSize) $errors[] = "Файл {$file['name']} превышает 30MB";
            $attachments[] = ['filePath' => $file['tmp_name'], 'filename' => $file['name']];
        }
    }
}

foreach ($_FILES as $field => $file) {
    if (!empty($file['tmp_name']) && !in_array($field, $docRequirements[$data['citizenship']] ?? [])) {
        if (!in_array(mime_content_type($file['tmp_name']), $allowedTypes)) $errors[] = "Недопустимый тип файла: {$file['name']}";
        if ($file['size'] > $maxSize) $errors[] = "Файл {$file['name']} превышает 30MB";
        $attachments[] = ['filePath' => $file['tmp_name'], 'filename' => $file['name']];
    }
}

if ($errors) {
    http_response_code(400);
    exit(json_encode(['errors' => $errors]));
}

$mg = Mailgun::create(MAILGUN_API_KEY, 'https://api.mailgun.net');
$domain = MAILGUN_DOMAIN;

$mg->messages()->send($domain, [
    'from' => "Заявка на вакансию <postmaster@$domain>",
    'to' => 'metiztorgtech@gmail.com',
    'subject' => "Новый кандидат: {$data['firstName']} {$data['lastName']}",
    'html' => "
        <div style='font-family: Arial, sans-serif; color: #333; max-width: 600px;'>
            <h2 style='font-size: 20px; color: #2c3e50;'>У нас новый кандидат!</h2>
            <p style='font-size: 16px;'>{$data['firstName']} хочет стать частью команды. Вот подробности:</p>
            <p style='font-size: 16px;'><strong>ФИО:</strong> {$data['lastName']} {$data['firstName']} " . ($data['middleName'] ? $data['middleName'] : '') . "</p>
            <p style='font-size: 16px;'><strong>Телефон:</strong> {$data['phone']}</p>
            <p style='font-size: 16px;'><strong>Email:</strong> <a href='mailto:{$data['email']}' style='color: #1a73e8; text-decoration: none;'>{$data['email']}</a></p>
            <p style='font-size: 16px;'><strong>Гражданство:</strong> {$data['citizenship']}</p>
            <p style='font-size: 16px;'><strong>Документы:</strong><br>" .
        (empty($attachments) ? "Ничего не приложили." :
            implode('<br>', array_map(fn($a) => $a['filename'], $attachments))) .
        "</p>
            <p style='font-size: 12px; color: #666;'>Отправлено: " . date('d.m.Y H:i') . "</p>
        </div>
    ",
    'attachment' => $attachments
]);


http_response_code(200);
echo json_encode(['redirect' => '/forms/success.php']);