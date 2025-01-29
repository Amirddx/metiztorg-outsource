<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Устроиться к нам</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/metiztorg-style.css">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- navbar -->
<?php include __DIR__ .'/includes/navbar.php'; ?>


<main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="text-center mb-4">Устроиться к нам</h1>
                    <p class="text-center">Заполните анкету ниже для отправки заявки.</p>

                    <!-- начало формы -->
                    <form action="/forms/apply-handler.php" method="POST" class="form-group">
                        <!-- имя -->
                        <label for="name" class="form-label">Имя:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Введите ваше имя" required>

                        <!-- фамилия -->
                        <label for="surname" class="form-label mt-3">Фамилия:</label>
                        <input type="text" id="surname" name="surname" class="form-control" placeholder="Введите вашу фамилию" required>

                        <!-- еmail -->
                        <label for="email" class="form-label mt-3">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="example@mail.com" required>

                        <!--телефон -->
                        <label for="phone" class="form-label mt-3">Телефон:</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="+7 (123) 456-78-90" required>

                        <!-- город выпадающий список -->
                        <label for="city" class="form-label mt-3">Город:</label>
                        <select id="city" name="city" class="form-select" required>
                            <option value="" disabled selected>Выберите ваш город</option>
                            <option value="moscow">Москва</option>
                            <option value="spb">Санкт-Петербург</option>
                            <option value="ekb">Екатеринбург</option>
                            <option value="kazan">Казань</option>
                        </select>

                        <!-- ЦФЗ  -->
                        <label for="cfz" class="form-label mt-3">ЦФЗ:</label>
                        <select id="cfz" name="cfz" class="form-select" required>
                            <option value="" disabled selected>Выберите ЦФЗ</option>
                            <option value="north">Северный</option>
                            <option value="south">Южный</option>
                            <option value="east">Восточный</option>
                            <option value="west">Западный</option>
                        </select>

                        <!-- сообщение -->
                        <label for="message" class="form-label mt-3">Сообщение:</label>
                        <textarea id="message" name="message" class="form-control" rows="5" placeholder="Расскажите немного о себе"></textarea>

                        <!-- кнопка отправки -->
                        <button type="submit" class="btn btn-primary mt-4">Отправить анкету</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER-->
<?php include __DIR__ .'/includes/footer.php'; ?>
</body>
</html>
