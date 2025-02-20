<?php

require '../vendor/autoload.php'; // Подключаем зависимости mailgun SDK
require '../includes/config.php';
use Mailgun\Mailgun;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  API mailgun
    $apiKey = MAILGUN_API_KEY;
    $domain = 'sandbox7ec456c8be9841d3b6133c7a43c9327b.mailgun.org';
    $mg = Mailgun::create($apiKey);

    //  Данные из формы
    $lastName = $_POST['lastName'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $middleName = $_POST['middleName'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $citizenship = $_POST['citizenship'] ?? '';

    //  Формируем тело письма
    $subject = "Новая заявка на трудоустройство";
    $message = "
        <h2>Новая заявка на работу</h2>
        <p><strong>Фамилия:</strong> $lastName</p>
        <p><strong>Имя:</strong> $firstName</p>
        <p><strong>Отчество:</strong> $middleName</p>
        <p><strong>Телефон:</strong> $phone</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Гражданство:</strong> $citizenship</p>
    ";

    //  Настраиваем отправку
    $attachments = [];
    if (!empty($_FILES['passport']['tmp_name'])) {
        $attachments[] = ['filePath' => $_FILES['passport']['tmp_name'], 'filename' => $_FILES['passport']['name']];
    }

    if (!empty($_FILES['foreign_passport']['tmp_name'])) {
        $attachments[] = ['filePath' => $_FILES['foreign_passport']['tmp_name'], 'filename' => $_FILES['foreign_passport']['name']];
    }

    //  Отправляем письмо
    $mg->messages()->send($domain, [
        'from'    => 'HR Метизторг <noreply@' . $domain . '>',
        'to'      => 'amirgafurovv@mail.ru',
        'subject' => $subject,
        'html'    => $message,
        'attachment' => $attachments
    ]);
// Если письмо отправлено успешно – перенаправляем пользователя
    header("Location: success.php");
    exit();

}
?>
