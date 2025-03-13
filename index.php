<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Метизторг – твой надёжный партнёр в поиске работы курьером или сборщиком для Самоката. Быстрое онлайн-трудоустройство и карта вакансий!">
    <meta name="author" content="">
    <title>Метизторг - Работа с Самокатом</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/magnific-popup.css" rel="stylesheet">
    <link href="assets/css/aos.css" rel="stylesheet">
    <link href="assets/css/metiztorg-style.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="assets/fonts/icons8-аутентификация-48.png">
</head>
<body>
<main>
    <!-- Hero Section -->
    <section class="hero position-relative text-white" id="hero">
        <div class="heroText position-absolute top-50 start-50 translate-middle text-center z-2">
            <h1 class="display-3 fw-bold mb-4" data-aos="zoom-in" data-aos-delay="800">Метизторг</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="1000">Онлайн-трудоустройство за 15 минут — стань курьером или сборщиком уже сегодня!</p>
            <a href="join-us.php" class="btn btn-warning btn-lg fw-bold mt-3" data-aos="zoom-in" data-aos-delay="1200">Присоединиться сейчас</a>
        </div>
        <div class="videoWrapper">
            <video autoplay loop muted class="custom-video" poster="assets/videos/poster_for_video.png">
                <source src="assets/videos/mixkit-banknotes-falling-on-a-dark-background-18305-full-hd.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="overlay"></div>
    </section>

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
                            <p class="card-text text-muted">Онлайн-трудоустройство за 15 минут — без очередей и бумаг!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="bi bi-geo-alt text-warning display-4 mb-3"></i>
                            <h5 class="card-title fw-bold">Выбор вакансий</h5>
                            <p class="card-text text-muted">Смотри открытые вакансии на карте и выбирай удобный адрес!</p>
                            <a href="jobs.php" class="btn btn-outline-warning btn-sm mt-2">Посмотреть карту</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="bi bi-cash-stack text-warning display-4 mb-3"></i>
                            <h5 class="card-title fw-bold">Стабильный доход</h5>
                            <p class="card-text text-muted">Зарабатывай до 120 000 ₽ в месяц с еженедельными выплатами!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Carousel Section -->
<!--    <section class="section-padding bg-dark text-white" id="team">-->
<!--        <div class="container">-->
<!--            <h2 class="text-center fw-bold mb-5" data-aos="fade-up">Выбери свою роль!</h2>-->
<!--            <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel">-->
<!--                <div class="carousel-inner">-->
<!--                    <div class="carousel-item active" data-aos="fade-up" data-aos-delay="200">-->
<!--                        <div class="row g-0 align-items-center">-->
<!--                            <div class="col-md-6">-->
<!--                                <img src="assets/images/people/фотка_1.jpg" class="img-fluid rounded-start w-100" alt="Кухня Самокат">-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div class="p-4 text-center text-md-start">-->
<!--                                    <h3 class="fw-bold">Кухня Самокат</h3>-->
<!--                                    <p class="text-secondary-white-color">Доход до 85 000 ₽ в месяц</p>-->
<!--                                    <a href="join-us.php" class="btn btn-warning mt-3">Стать сборщиком</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="carousel-item" data-aos="fade-up" data-aos-delay="400">-->
<!--                        <div class="row g-0 align-items-center">-->
<!--                            <div class="col-md-6">-->
<!--                                <img src="assets/images/people/фотка_3.jpg" class="img-fluid rounded-start w-100" alt="Курьер на электровелике">-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div class="p-4 text-center text-md-start">-->
<!--                                    <h3 class="fw-bold">Курьер на электровелике</h3>-->
<!--                                    <p class="text-secondary-white-color">Чем больше заказов — тем выше доход!</p>-->
<!--                                    <a href="join-us.php" class="btn btn-warning mt-3">Начать доставлять</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="carousel-item" data-aos="fade-up" data-aos-delay="600">-->
<!--                        <div class="row g-0 align-items-center">-->
<!--                            <div class="col-md-6">-->
<!--                                <img src="assets/images/people/фотка_5.jpg" class="img-fluid rounded-start w-100" alt="Пеший курьер">-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div class="p-4 text-center text-md-start">-->
<!--                                    <h3 class="fw-bold">Пеший курьер</h3>-->
<!--                                    <p class="text-secondary-white-color">Доход до 90 000 ₽ в месяц</p>-->
<!--                                    <a href="join-us.php" class="btn btn-warning mt-3">Присоединиться</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">-->
<!--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                    <span class="visually-hidden">Назад</span>-->
<!--                </button>-->
<!--                <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">-->
<!--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                    <span class="visually-hidden">Вперёд</span>-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->

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
                            <button class="carousel-control-prev" type="button" data-bs-target="#bonusCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Назад</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#bonusCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Вперёд</span>
                            </button>
                        </div>
                        <div class="card-body text-center d-flex flex-column flex-grow-1">
                            <h5 class="card-title fw-bold">Бонус за скорость</h5>
                            <p class="card-text text-muted flex-grow-1">Оформись онлайн до 1 апреля и получи +500 ₽ к первой выплате!</p>
                            <a href="join-us.php" class="btn btn-outline-warning btn-sm mt-2">Оформиться сейчас</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-0 shadow h-100 d-flex flex-column">
                        <div id="referralCarousel" class="carousel slide" data-bs-ride="carousel">
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
                                        echo '<img src="' . $dir . $file . '" class="card-img-top" alt="Приглашай друзей - ' . $file . '" style="height: 400px; object-fit: cover;">';
                                        echo '</div>';
                                        $first = false;
                                    }
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#referralCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Назад</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#referralCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Вперёд</span>
                            </button>
                        </div>
                        <div class="card-body text-center d-flex flex-column flex-grow-1">
                            <h5 class="card-title fw-bold">Приглашай друзей</h5>
                            <p class="card-text text-muted flex-grow-1">Зови друзей и получай бонусы за каждого — до 15 000 ₽!</p>
                            <button type="button" class="btn btn-outline-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#referralModal">Узнать о реферальной программе</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Referral Program -->
        <div class="modal fade" id="referralModal" tabindex="-1" aria-labelledby="referralModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="referralModalLabel">Как заработать до 15 000 ₽ за друга</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item border-0">Пригласи друга работать в нашу компанию — расскажи ему о крутых возможностях!</li>
                            <li class="list-group-item border-0">Напиши нам письмо, указав, кого ты пригласил. <a href="contact.php" class="text-warning fw-bold">Перейти к форме письма</a>.</li>
                            <li class="list-group-item border-0">Твой друг должен вступить в компанию как курьер или сборщик.</li>
                            <li class="list-group-item border-0">Другу нужно отработать не менее 100 часов доставки заказов.</li>
                            <li class="list-group-item border-0">Готово! Ты получаешь бонус до <strong>15 000 ₽</strong> на свой счёт!</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
<!--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>-->
                        <a href="contact.php" class="btn btn-warning fw-bold">Написать письмо</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Calculator Section -->
    <section class="section-padding" id="calculator">
    <?php include __DIR__ . '/includes/calculator.php'; ?>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.sticky.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/magnific-popup-options.js"></script>
<script src="assets/js/scrollspy.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>