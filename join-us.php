<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Стань частью команды Самоката!</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css?v=2">
    <link rel="stylesheet" href="/assets/css/metiztorg-style.css?v=2">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="assets/fonts/icons8-аутентификация-48.png">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/includes/navbar.php'; ?>

<main class="container my-5 flex-grow-1">


    <!-- Инструкция -->
    <section class="row justify-content-center mb-5">
        <div class="col-lg-10 text-center">
            <h1 class="display-4 fw-bold text-dark mb-4">Стань курьером или сборщиком Самоката за 3 шага!</h1>
            <p class="lead text-muted mb-5">Работай с нами, получай стабильный доход и бонусы от лидера доставки!</p>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-person-check display-4 text-warning mb-3"></i>
                            <h3 class="card-title fw-bold">1. Расскажи о себе</h3>
                            <p class="card-text">Заполни простую форму за 2 минуты — никаких сложных анкет!</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-arrow-up display-4 text-warning mb-3"></i>
                            <h3 class="card-title fw-bold">2. Прикрепи документы</h3>
                            <p class="card-text">Загрузи пару файлов — мы всё проверим быстро и без лишних вопросов.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-cash-stack display-4 text-warning mb-3"></i>
                            <h3 class="card-title fw-bold">3. Начинай зарабатывать</h3>
                            <p class="card-text">Получи доступ к заказам Самоката и стабильному доходу уже завтра!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="#joinUsForm" class="btn btn-warning btn-lg fw-bold">Начать прямо сейчас!</a>
                <p class="text-muted mt-3">После заполнения анкеты жди звонка от нашего менеджера — твоя первая смена
                    уже на подходе!</p>
            </div>

            <div class="mt-5 bg-light p-4 rounded-3 shadow-sm">
                <h4 class="fw-bold text-dark mb-4">Как проходит твое трудоустройство онлайн?</h4>
                <div class="accordion" id="hiringProcess">
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <i class="bi bi-file-earmark-plus text-warning fs-2 me-2"></i> Отправка анкеты
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                             data-bs-parent="#hiringProcess">
                            <div class="accordion-body text-muted">
                                Ты заполняешь анкету и загружаешь документы — они моментально поступают в наш отдел
                                кадров.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="bi bi-file-earmark-medical text-warning fs-2 me-2"></i> Проверка документов
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#hiringProcess">
                            <div class="accordion-body text-muted">
                                Мы быстро проверяем твои данные — никаких долгих ожиданий, всё онлайн!
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-telephone text-warning fs-2 me-2"></i> Уточнение смены
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                             data-bs-parent="#hiringProcess">
                            <div class="accordion-body text-muted">
                                Наш менеджер позвонит, чтобы согласовать удобное время твоей первой смены и адрес —
                                выбирай из <a href="/jobs.php" class="text-decoration-underline text-dark">открытых
                                    вакансий на карте</a>!
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="bi bi-check2-circle text-warning fs-2 me-2"></i> Готово!
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                             data-bs-parent="#hiringProcess">
                            <div class="accordion-body text-muted">
                                Всё готово — ты в команде! Выходи на смену и начинай зарабатывать с Самокатом.
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- Форма -->
    <section class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center mb-4">Отправить заявку</h2>
            <p class="text-center text-muted">Заполните форму и прикрепите необходимые документы.</p>

            <div class="shadow-lg p-4 bg-white rounded-3">
                <form action="forms/join-us-handler.php" method="POST" enctype="multipart/form-data" id="joinUsForm">
                    <div class="row g-3">
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
                            <input type="tel" name="phone" class="form-control phone-mask"
                                   placeholder="+7 (900) 123-45-67" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="example@mail.com"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Статус/Гражданство <span class="text-danger">*</span></label>
                            <select name="citizenship" class="form-select" id="citizenship" required>
                                <option value="" disabled selected>Выберите статус</option>
                                <option value="РФ (Россия)">РФ (Россия)</option>
                                <option value="ЕАЭС (Беларусь)">ЕАЭС (Беларусь)</option>
                                <option value="ЕАЭС (Армения, Киргизия, Казахстан)">ЕАЭС (Армения, Киргизия,
                                    Казахстан)
                                </option>
                                <option value="ВНЖ">ВНЖ</option>
                                <option value="РВП">РВП</option>
                                <option value="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)">СНГ (Азербайджан,
                                    Молдова, Таджикистан, Узбекистан)
                                </option>
                                <option value="Студент">Студент</option>
                                <option value="Лицо без гражданства">Лицо без гражданства</option>
                                <option value="Беженец">Беженец</option>
                                <option value="Временное убежище">Временное убежище</option>
                                <option value="ЛНР/ДНР/Украина">ЛНР/ДНР/Украина</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3" id="documents"></div>

                        <div class="col-12 mt-3" id="notices" style="display: none;">
                            <div class="alert alert-warning" data-notice="common"><strong>ВАЖНО!</strong> Все документы
                                должны быть оформлены на текущий действующий паспорт
                            </div>
                            <div class="alert alert-warning" data-notice="age">Партнерство строго с 18 лет</div>
                            <div class="alert alert-warning" data-notice="region">Регистрация должна соответствовать
                                субъекту оказания услуг
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="consent" name="consent" required>
                                <label class="form-check-label" for="consent">
                                    Я подтверждаю свое согласие на обработку персональных данных в соответствии с <a
                                            class="text-dark text-decoration-underline" href="/privacy-policy.php"
                                            target="_blank">Политикой конфиденциальности</a>.
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="g-recaptcha" data-sitekey="6LdNLOcqAAAAADmbUpUmrR_8IbURYvweX8Zoxjnz"></div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-warning px-4 fw-bold">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script src="https://www.google.com/recaptcha/api.js?hl=ru" async defer></script>
<script src="https://unpkg.com/imask"></script>
<script src="/assets/js/join-us-form.js?v=2"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>