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

<!-- Навигация -->
<?php include __DIR__ .'/includes/navbar.php'; ?>

<main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center mb-4">Присоединяйтесь к нашей команде</h2>
            <p class="text-center text-muted">Заполните форму и прикрепите необходимые документы.</p>

            <div class="shadow-lg p-4 bg-white rounded-3">
                <form class="contact-form" enctype="multipart/form-data">
                    <div class="row g-3">

                        <!-- ФИО -->
                        <div class="col-md-6">
                            <label class="form-label">Фамилия <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Иванов" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Имя <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Иван" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Отчество</label>
                            <input type="text" class="form-control" placeholder="Петрович">
                        </div>

                        <!-- Контакты -->
                        <div class="col-md-6">
                            <label class="form-label">Телефон <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control phone-mask" placeholder="+7 (900) 123-45-67" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="example@mail.com">
                        </div>

                        <!-- Гражданство -->
                        <div class="col-md-6">
                            <label class="form-label">Гражданство <span class="text-danger">*</span></label>
                            <select class="form-select" id="citizenship" required>
                                <option value="Россия" selected>Россия</option>
                                <option value="Беларусь">Беларусь</option>
                                <option value="Казахстан">Казахстан</option>
                                <option value="Другие">Другое</option>
                            </select>
                        </div>

                        <!-- Файлы (Россия) -->
                        <div class="document-fields doc-russia">
                            <div class="col-md-12">
                                <label class="form-label">Паспорт (1-я страница) <span class="text-danger">*</span></label>
                                <div class="file-upload">
                                    <input type="file" class="file-input d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <div class="file-preview-container"></div>
                                    <button type="button" class="btn file-btn">
                                        <i class="bi bi-paperclip"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Файлы (Иностранцы) -->
                        <div class="document-fields doc-foreign d-none">
                            <div class="col-md-12">
                                <label class="form-label">Загранпаспорт <span class="text-danger">*</span></label>
                                <div class="file-upload">
                                    <input type="file" class="file-input d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <div class="file-preview-container"></div>
                                    <button type="button" class="btn file-btn">
                                        <i class="bi bi-paperclip"></i>
                                    </button>
                                </div>
                            </div>
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

<!-- Подвал -->
<?php include __DIR__ .'/includes/footer.php'; ?>

<!-- Подключение внешнего JavaScript -->
<script src="/assets/js/form-handler.js"></script>

</body>
</html>
