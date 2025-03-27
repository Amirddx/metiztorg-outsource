<?php
require '../vendor/autoload.php';
require '../includes/config.php';
use Mailgun\Mailgun;

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit(json_encode(['errors' => ['Метод не разрешен']]));
}

if (!defined('MAILGUN_API_KEY') || !defined('MAILGUN_DOMAIN')) {
    http_response_code(500);
    exit(json_encode(['errors' => ['Mailgun ключи не настроены']]));
}

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS));

$errors = [];

if (!$name) $errors[] = "Укажите имя";
if (!$phone || !preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $phone)) $errors[] = "Укажите корректный номер телефона";
if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Некорректный email";
if (!$message || mb_strlen($message) < 10) $errors[] = "Сообщение должно содержать не менее 10 символов";

if ($errors) {
    http_response_code(400);
    exit(json_encode(['errors' => $errors]));
}

$mg = Mailgun::create(MAILGUN_API_KEY);
$domain = MAILGUN_DOMAIN;

$mg->messages()->send($domain, [
    'from' => "Сообщение с сайта <postmaster@$domain>",
    'to' => 'metiztorgtech@gmail.com',
    'subject' => "Новое сообщение с сайта от $name",
    'html' => "
        <div style='font-family: Arial, sans-serif; color: #333; max-width: 600px;'>
            <h2>Новое обращение через форму 'Свяжитесь с нами'</h2>
            <p><strong>Имя:</strong> $name</p>
            <p><strong>Телефон:</strong> $phone</p>
            <p><strong>Email:</strong> " . ($email ? "<a href='mailto:$email'>$email</a>" : "не указан") . "</p>
            <p><strong>Сообщение:</strong><br>" . nl2br($message) . "</p>
            <p style='font-size: 12px; color: #999;'>Отправлено: " . date('d.m.Y H:i') . "</p>
        </div>
    "
]);

http_response_code(200);
echo json_encode(['redirect' => '/forms/success.php']);
