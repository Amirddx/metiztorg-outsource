
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявка отправлена</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/metiztorg-style.css">

    <link rel="icon" type="image/png" href="/assets/fonts/icons8-аутентификация-48.png">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="mb-4">Успешно отправлено!</h2>
            <p class="text-muted">Спасибо за вашу заявку. Мы свяжемся с вами в ближайшее время.</p>
            <a href="/main" class="btn btn-warning mt-3">На главную страницу</a>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>