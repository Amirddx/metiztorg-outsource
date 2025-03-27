<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Метизторг – твой надёжный партнёр в поиске работы курьером или сборщиком для Самоката. Быстрое онлайн-трудоустройство и карта вакансий!">
    <meta name="author" content="">
    <title>Метизторг - Работа с Самокатом</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;700;900&display=swap"
          rel="stylesheet">
    <link href="assets/css/bootstrap.min.css?v=2" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/magnific-popup.css?v=2" rel="stylesheet">
    <link href="assets/css/aos.css?v=2" rel="stylesheet">
    <link href="assets/css/metiztorg-style.css?v=2" rel="stylesheet">

    <link rel="icon" type="image/png" href="assets/fonts/icons8-аутентификация-48.png">
</head>
<body>
<main>
    <!-- Hero -->
    <?php include __DIR__ . '/includes/hero.php'; ?>
    <!-- Navbar -->
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <!-- Advantages Section -->
    <section class="section-padding bg-light" id="about">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="fade-up">Почему работать с нами выгодно?</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="bi bi-rocket-takeoff text-warning display-4 mb-3"></i>
                            <h5 class="card-title fw-bold">Быстрое оформление</h5>
                            <p class="card-text text-muted">Онлайн-трудоустройство за 15 минут — без очередей и
                                бумаг!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="bi bi-geo-alt text-warning display-4 mb-3"></i>
                            <h5 class="card-title fw-bold">Выбор вакансий</h5>
                            <p class="card-text text-muted">Смотри открытые вакансии на карте и выбирай удобный
                                адрес!</p>
                            <a href="/jobs" class="btn btn-outline-warning btn-sm mt-2">Посмотреть карту</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="bi bi-cash-stack text-warning display-4 mb-3"></i>
                            <h5 class="card-title fw-bold">Стабильный доход</h5>
                            <p class="card-text text-muted">Зарабатывай до 120 000 ₽ в месяц с еженедельными
                                выплатами!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotions Section -->
    <section class="section-padding" id="promotions">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="fade-up">Акции и бонусы в нашей компании</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow h-100 d-flex flex-column">
                        <div id="bonusCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $dir = 'assets/images/people/';
                                $files = scandir($dir);
                                $first = true;
                                foreach ($files as $file) {
                                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
                                        $activeClass = $first ? ' active' : '';
                                        echo '<div class="carousel-item' . $activeClass . '">';
//                                        размер фото
                                        echo '<img src="' . $dir . $file . '" class="card-img-top" alt="Бонус за скорость - ' . $file . '" style="height: 400px; object-fit: cover;">';
                                        echo '</div>';
                                        $first = false;
                                    }
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#bonusCarousel"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Назад</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#bonusCarousel"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Вперёд</span>
                            </button>
                        </div>
                        <div class="card-body text-center d-flex flex-column flex-grow-1">
                            <h5 class="card-title fw-bold">Бонус за скорость</h5>
                            <p class="card-text text-muted flex-grow-1">Оформись онлайн до 1 апреля и получи +500 ₽ к
                                первой выплате!</p>
                            <a href="/join-us" class="btn btn-outline-warning btn-sm mt-2">Оформиться сейчас</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-0 shadow h-100 d-flex flex-column">
                        <div id="referralCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $dir = 'assets/images/';
                                $files = scandir($dir);
                                $first = true;
                                foreach ($files as $file) {
                                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
                                        $activeClass = $first ? ' active' : '';
                                        echo '<div class="carousel-item' . $activeClass . '">';
//                                        размер фото
                                        echo '<img src="' . $dir . $file . '" class="card-img-top" alt="Приглашай друзей - ' . $file . '" style="height: 400px; object-fit: cover;">';
                                        echo '</div>';
                                        $first = false;
                                    }
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#referralCarousel"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Назад</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#referralCarousel"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Вперёд</span>
                            </button>
                        </div>
                        <div class="card-body text-center d-flex flex-column flex-grow-1">
                            <h5 class="card-title fw-bold">Приглашай друзей</h5>
                            <p class="card-text text-muted flex-grow-1">Зови друзей и получай бонусы за каждого — до 15
                                000 ₽!</p>
                            <button type="button" class="btn btn-outline-warning btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#referralModal">Узнать о реферальной программе
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Referral Program -->
        <div class="modal fade" id="referralModal" tabindex="-1" aria-labelledby="referralModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="referralModalLabel">Как заработать до 15 000 ₽ за друга</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item border-0">Пригласи друга работать в нашу компанию — расскажи ему
                                о крутых возможностях!
                            </li>
                            <li class="list-group-item border-0">Напиши нам письмо, указав, кого ты пригласил. <a
                                        href="contact.php" class="text-warning fw-bold">Перейти к форме письма</a>.
                            </li>
                            <li class="list-group-item border-0">Твой друг должен вступить в компанию как курьер или
                                сборщик.
                            </li>
                            <li class="list-group-item border-0">Другу нужно отработать не менее 100 часов доставки
                                заказов.
                            </li>
                            <li class="list-group-item border-0">Готово! Ты получаешь бонус до <strong>15 000 ₽</strong>
                                на свой счёт!
                            </li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <!--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>-->
                        <a href="/contact" class="btn btn-warning fw-bold">Написать письмо</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Calculator Section -->
    <section class="section-padding" id="calculator">
        <?php include __DIR__ . '/includes/calculator.php'; ?>
    </section>

    <!-- FAQ Section -->
    <section class="section-padding bg-light" id="faq">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="fade-up">Часто задаваемые вопросы</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h3 class="accordion-header" id="faqHeading1">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                            Как быстро я могу начать работать?
                        </button>
                    </h3>
                    <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Вы можете начать работать уже в день оформления! Процесс занимает всего 15 минут — заполните
                            <a href="/join-us.php" class="text-decoration-underline text-dark">заявку онлайн</a>, и мы свяжемся с вами для подтверждения.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h3 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                            Какие документы нужны для трудоустройства?
                        </button>
                    </h3>
                    <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Вам понадобится паспорт, СНИЛС и ИНН. Всё можно загрузить онлайн через наш сайт — никаких
                            лишних звонков!
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h3 class="accordion-header" id="faqHeading3">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                            Сколько я буду зарабатывать?
                        </button>
                    </h3>
                    <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Зарплата зависит от графика и должности. Курьеры зарабатывают от 250 до 350 руб./час,
                            сборщики — от 200 до 350 руб./час.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h3 class="accordion-header" id="faqHeading4">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                            Могу ли я выбрать график работы?
                        </button>
                    </h3>
                    <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Да, мы предлагаем гибкие графики: 2/2, 5/2 или частичная занятость. Вы сами выбираете
                            удобное время в процессе оформления.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 shadow-sm">
                    <h3 class="accordion-header" id="faqHeading5">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                            Есть ли бонусы для новых сотрудников?
                        </button>
                    </h3>
                    <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Конечно! Оформитесь до конца месяца и получите бонус 500 руб. к первой выплате. Также есть
                            реферальная программа — приглашайте друзей и зарабатывайте до 15 000 руб.!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script src="assets/js/jquery.min.js?v=2"></script>
<script src="assets/js/bootstrap.bundle.min.js?v=2"></script>
<script src="assets/js/jquery.sticky.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js?v=2"></script>
<script src="assets/js/magnific-popup-options.js?v=2"></script>
<script src="assets/js/scrollspy.min.js?v=2"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>