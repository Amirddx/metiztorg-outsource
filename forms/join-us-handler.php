<?php
require '../vendor/autoload.php';
require '../includes/config.php';
require 'join-us-validate.php';
use Mailgun\Mailgun;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apiKey = MAILGUN_API_KEY;
    $domain = 'sandbox6ec456c8be9841d3b6133c7a43c9327b.mailgun.org';
    $mg = Mailgun::create($apiKey);

    $validationResult = validateJoinUsForm($_POST, $_FILES);

    if (!empty($validationResult['errors'])) {
        http_response_code(400);
        echo json_encode(['errors' => $validationResult['errors']]);
        exit();
    }

    $data = $validationResult['data'];
    $attachments = $validationResult['attachments'];

    $subject = "Новая заявка на трудоустройство";
    $message = "
        <h1>Курлык-Курлык!</h1>
        <h2>Прими почтового голубя! {$data['lastName']} {$data['firstName']} {$data['middleName']} загрузил документы на трудоустройство!</h2>
        <p><strong>Фамилия:</strong> {$data['lastName']}</p>
        <p><strong>Имя:</strong> {$data['firstName']}</p>
        <p><strong>Отчество:</strong> {$data['middleName']}</p>
        <p><strong>Телефон:</strong> {$data['phone']}</p>
        <p><strong>Email:</strong> {$data['email']}</p>
        <p><strong>Гражданство:</strong> {$data['citizenship']}</p>
        <p><strong>Согласие на обработку данных:</strong> Да</p>
        <h3>Прикрепленные документы:</h3>
        <ul>
    ";

    foreach ($attachments as $attachment) {
        $message .= "<li>{$attachment['filename']}</li>";
    }
    $message .= "</ul>";

    try {
        $mg->messages()->send($domain, [
            'from'    => 'Заявка <noreply@' . $domain . '>',
            'to'      => 'metiztorg@gmail.com',
            'subject' => $subject,
            'html'    => $message,
            'attachment' => $attachments
        ]);

        header("Location: /success.php");
        exit();
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка при отправке письма: ' . $e->getMessage()]);
        exit();
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Метод не разрешен']);
    exit();
}
?>