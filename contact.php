<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Связаться с нами - Метизторг</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/css/metiztorg-style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<?php include __DIR__ . '/includes/navbar.php'; ?>

<main class="container my-5 flex-grow-1">
    <section class="row justify-content-center">
        <div class="col-lg-7 col-12">
            <h2 class="mb-4 text-center fw-bold" data-aos="fade-up">Свяжитесь с нами</h2>
            <p class="text-center text-muted mb-5" data-aos="fade-up" data-aos-delay="200">Мы всегда на связи и готовы помочь!</p>

            <form action="#" method="post" class="shadow p-4 bg-white rounded-3" role="form" data-aos="fade-up" data-aos-delay="400">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label for="name" class="form-label">Имя <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Иван" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="email" class="form-label">Электронная почта <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="ivanov@mail.ru" required>
                    </div>
                    <div class="col-12">
                        <label for="message" class="form-label">Как мы можем помочь?</label>
                        <textarea name="message" rows="6" class="form-control" id="message" placeholder="Напишите что-нибудь..." required></textarea>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-warning fw-bold px-4">Отправить сообщение</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/jquery.sticky.js"></script>
<script src="/assets/js/aos.js"></script>
<script src="/assets/js/scrollspy.min.js"></script>
<script src="/assets/js/custom.js"></script>
</body>
</html>