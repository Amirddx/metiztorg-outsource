<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Устроиться к нам</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/metiztorg-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/includes/navbar.php'; ?>

<main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center mb-4">Отправить заявку</h2>
            <p class="text-center text-muted">Заполните форму и прикрепите необходимые документы.</p>

            <div class="shadow-lg p-4 bg-white rounded-3">
                <form action="forms/join-us-handler.php" method="POST" enctype="multipart/form-data" id="joinUsForm">
                    <div class="row g-3">
                        <!-- Общие поля -->
                        <div class="col-md-6">
                            <label class="form-label">Фамилия <span class="text-danger">*</span></label>
                            <input type="text" name="lastName" class="form-control" placeholder="Иванов" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Имя <span class="text-danger">*</span></label>
                            <input type="text" name="firstName" class="form-control" placeholder="Иван" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Отчество</label>
                            <input type="text" name="middleName" class="form-control" placeholder="Петрович">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Телефон <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control phone-mask" placeholder="+7 (900) 123-45-67" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Статус/Гражданство <span class="text-danger">*</span></label>
                            <select name="citizenship" class="form-select" id="citizenship" required>
                                <option value="" disabled selected>Выберите статус</option>
                                <option value="РФ (Россия)">РФ (Россия)</option>
                                <option value="ЕАЭС (Беларусь)">ЕАЭС (Беларусь)</option>
                                <option value="ЕАЭС (Армения, Киргизия, Казахстан)">ЕАЭС (Армения, Киргизия, Казахстан)</option>
                                <option value="ВНЖ">ВНЖ</option>
                                <option value="РВП">РВП</option>
                                <option value="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)">СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)</option>
                                <option value="Студент">Студент</option>
                                <option value="Лицо без гражданства">Лицо без гражданства</option>
                                <option value="Беженец">Беженец</option>
                                <option value="Временное убежище">Временное убежище</option>
                                <option value="ЛНР/ДНР/Украина">ЛНР/ДНР/Украина</option>
                            </select>
                        </div>

                        <!-- Контейнер для динамических документов -->
                        <div class="col-12 mt-3" id="documents">
                            <!-- Документы будут добавляться сюда через JS -->
                        </div>

                        <!-- Уведомления -->
                        <div class="col-12 mt-3" id="notices" style="display: none;">
                            <div class="alert alert-warning" data-notice="common"> <strong>ВАЖНО!</strong> Все документы должны быть оформлены на текущий действующий паспорт</div>
                            <div class="alert alert-warning" data-notice="age">Партнерство строго с 18 лет</div>
                            <div class="alert alert-warning" data-notice="region">Регистрация должна соответствовать субъекту оказания услуг</div>
                        </div>

                        <!-- Согласие и reCAPTCHA -->
                        <div class="col-12 mt-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="consent" name="consent" required>
                                <label class="form-check-label" for="consent">
                                    Я подтверждаю свое согласие на обработку персональных данных в соответствии с <a class="text-dark text-decoration-underline" href="/privacy-policy" target="_blank">Политикой конфиденциальности</a>.
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="g-recaptcha" data-sitekey="6LdNLOcqAAAAADmbUpUmrR_8IbURYvweX8Zoxjnz"></div>
                        </div>

                        <!-- Кнопка отправки -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-warning px-4 fw-bold">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<!-- Подключение скриптов -->
<script src="https://www.google.com/recaptcha/api.js?hl=ru" async defer></script>
<script src="https://unpkg.com/imask"></script> <!-- Библиотека для маски телефона -->
<script src="/assets/js/join-us-form.js"></script> <!-- Наш будущий JS-файл -->
</body>
</html>