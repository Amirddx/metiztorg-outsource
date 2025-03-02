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
                <form action="forms/join-us-handler.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <!-- Основные данные -->
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

                        <!-- Выбор гражданства -->
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

                        <!-- Уведомления -->
                        <div class="col-12 notices" style="display: none;">
                            <div class="alert alert-warning" data-notice="common"> <strong>ВАЖНО!</strong> Все документы должны быть оформлены на текущий действующий паспорт</div>
                            <div class="alert alert-warning" data-notice="age">Партнерство строго с 18 лет</div>
                            <div class="alert alert-warning" data-notice="region">Регистрация должна соответствовать субъекту оказания услуг</div>
                        </div>

                        <!-- Документы -->
                        <!-- РФ (Россия) -->
                        <div class="col-md-12 doc-group" data-citizenship="РФ (Россия)" style="display: none;">
                            <label class="form-label">Паспорт <span class="text-danger">*</span></label>
                            <input type="file" name="passport_rf" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РФ (Россия)" style="display: none;">
                            <label class="form-label">Регистрация/Прописка</label>
                            <input type="file" name="registration_rf" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РФ (Россия)" style="display: none;">
                            <label class="form-label">СНИЛС</label>
                            <input type="file" name="snils_rf" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РФ (Россия)" style="display: none;">
                            <label class="form-label">ИНН</label>
                            <input type="file" name="inn_rf" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>

                        <!-- ЕАЭС (Беларусь) -->
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Беларусь)" style="display: none;">
                            <label class="form-label">Паспорт иностранного гражданина (со всеми штампами пересечений) <span class="text-danger">*</span></label>
                            <input type="file" name="passport_belarus" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Беларусь)" style="display: none;">
                            <label class="form-label">Регистрация/Прописка</label>
                            <input type="file" name="registration_belarus" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Беларусь)" style="display: none;">
                            <label class="form-label">Полис ОМС (с двух сторон, при наличии)</label>
                            <input type="file" name="oms_belarus" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Беларусь)" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_belarus" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Беларусь)" style="display: none;">
                            <label class="form-label">ИНН (при наличии, обязательно при оформлении на СМЗ)</label>
                            <input type="file" name="inn_belarus" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>

                        <!-- ЕАЭС (Армения, Киргизия, Казахстан) -->
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">Паспорт иностранного гражданина (со всеми штампами пересечений) <span class="text-danger">*</span></label>
                            <input type="file" name="passport_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">Перевод паспорта (если нет дублирования на русском)</label>
                            <input type="file" name="passport_translation_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">Полис ДМС или ОМС (с двух сторон, при наличии)</label>
                            <input type="file" name="insurance_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">Дактилоскопия (при наличии)</label>
                            <input type="file" name="dactyloscopy_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">ИНН (при наличии, обязательно при оформлении на СМЗ)</label>
                            <input type="file" name="inn_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">
                            <label class="form-label">Миграционная карта (цель въезда - любая, при наличии)</label>
                            <input type="file" name="migration_card_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="ЕАЭС (Армения, Киргизия, Казахстан)" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты</label>-->
<!--                            <input type="file" name="bank_details_eaes" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- ВНЖ -->
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">Паспорт иностранного гражданина (со всеми штампами пересечений) <span class="text-danger">*</span></label>
                            <input type="file" name="passport_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">Полис ОМС (с двух сторон, при наличии)</label>
                            <input type="file" name="oms_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">Дактилоскопия (при наличии)</label>
                            <input type="file" name="dactyloscopy_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">ИНН (при наличии)</label>
                            <input type="file" name="inn_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">Миграционная карта (при наличии)</label>
                            <input type="file" name="migration_card_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">
                            <label class="form-label">Вид на жительство (ВНЖ) <span class="text-danger">*</span></label>
                            <input type="file" name="vnj_document" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="ВНЖ" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты </label>-->
<!--                            <input type="file" name="bank_details_vnj" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- РВП -->
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">Паспорт иностранного гражданина (со всеми штампами пересечений) <span class="text-danger">*</span></label>
                            <input type="file" name="passport_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">Полис ДМС или ОМС (с двух сторон, при наличии)</label>
                            <input type="file" name="insurance_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">Дактилоскопия (при наличии)</label>
                            <input type="file" name="dactyloscopy_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">ИНН (при наличии)</label>
                            <input type="file" name="inn_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">Миграционная карта (при наличии)</label>
                            <input type="file" name="migration_card_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">
                            <label class="form-label">РВП <span class="text-danger">*</span></label>
                            <input type="file" name="rvp_document" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="РВП" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты </label>-->
<!--                            <input type="file" name="bank_details_rvp" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- СНГ -->
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Паспорт иностранного гражданина (со всеми штампами пересечений) <span class="text-danger">*</span></label>
                            <input type="file" name="passport_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Перевод паспорта (если нет дублирования на русском)</label>
                            <input type="file" name="passport_translation_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Полис ДМС (с двух сторон, при наличии)</label>
                            <input type="file" name="dms_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Дактилоскопия (при наличии)</label>
                            <input type="file" name="dactyloscopy_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">ИНН (при наличии)</label>
                            <input type="file" name="inn_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Миграционная карта (цель въезда - любая)</label>
                            <input type="file" name="migration_card_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Патент (с двух сторон) <span class="text-danger">*</span></label>
                            <input type="file" name="patent_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">
                            <label class="form-label">Чеки по патенту (читаемые или дубликаты)</label>
                            <input type="file" name="patent_checks_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты</label>-->
<!--                            <input type="file" name="bank_details_sng" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- Студент -->
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Паспорт иностранного гражданина со всеми штампами пересечений <span class="text-danger">*</span></label>
                            <input type="file" name="passport_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Перевод паспорта (если нет дублирования на русском)</label>
                            <input type="file" name="passport_translation_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Российская виза (для визовых стран)</label>
                            <input type="file" name="visa_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Полис ДМС (с двух сторон, при наличии)</label>
                            <input type="file" name="dms_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Дактилоскопия (при наличии)</label>
                            <input type="file" name="dactyloscopy_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">ИНН (при наличии)</label>
                            <input type="file" name="inn_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Миграционная карта (цель въезда - учеба)</label>
                            <input type="file" name="migration_card_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">
                            <label class="form-label">Справка из ВУЗа/СПО (оригинал с печатью) <span class="text-danger">*</span></label>
                            <input type="file" name="edu_certificate_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="Студент" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты</label>-->
<!--                            <input type="file" name="bank_details_student" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- Лицо без гражданства -->
                        <div class="col-md-12 doc-group" data-citizenship="Лицо без гражданства" style="display: none;">
                            <label class="form-label">Временное удостоверение личности <span class="text-danger">*</span></label>
                            <input type="file" name="temp_id_lbg" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Лицо без гражданства" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_lbg" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Лицо без гражданства" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_lbg" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Лицо без гражданства" style="display: none;">
                            <label class="form-label">ИНН (при наличии)</label>
                            <input type="file" name="inn_lbg" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Лицо без гражданства" style="display: none;">
                            <label class="form-label">Миграционная карта (при наличии)</label>
                            <input type="file" name="migration_card_lbg" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="Лицо без гражданства" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты</label>-->
<!--                            <input type="file" name="bank_details_lbg" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- Беженец -->
                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">
                            <label class="form-label">Удостоверение беженца <span class="text-danger">*</span></label>
                            <input type="file" name="refugee_id" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_refugee" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">
                            <label class="form-label">Полис ОМС (с двух сторон, при наличии)</label>
                            <input type="file" name="oms_refugee" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">
                            <label class="form-label">Дактилоскопия (при наличии)</label>
                            <input type="file" name="dactyloscopy_refugee" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_refugee" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">
                            <label class="form-label">ИНН (при наличии)</label>
                            <input type="file" name="inn_refugee" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">
                            <label class="form-label">Миграционная карта (при наличии)</label>
                            <input type="file" name="migration_card_refugee" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="Беженец" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты</label>-->
<!--                            <input type="file" name="bank_details_refugee" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- Временное убежище -->
                        <div class="col-md-12 doc-group" data-citizenship="Временное убежище" style="display: none;">
                            <label class="form-label">Свидетельство о временном пребывании <span class="text-danger">*</span></label>
                            <input type="file" name="temp_asylum" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Временное убежище" style="display: none;">
                            <label class="form-label">Регистрация</label>
                            <input type="file" name="registration_asylum" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Временное убежище" style="display: none;">
                            <label class="form-label">Полис ОМС (с двух сторон, при наличии)</label>
                            <input type="file" name="oms_asylum" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Временное убежище" style="display: none;">
                            <label class="form-label">Дактилоскопия (при наличии)</label>
                            <input type="file" name="dactyloscopy_asylum" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Временное убежище" style="display: none;">
                            <label class="form-label">СНИЛС (при наличии)</label>
                            <input type="file" name="snils_asylum" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="Временное убежище" style="display: none;">
                            <label class="form-label">ИНН (при наличии)</label>
                            <input type="file" name="inn_asylum" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="Временное убежище" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты</label>-->
<!--                            <input type="file" name="bank_details_asylum" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->

                        <!-- ЛНР/ДНР/Украина -->
                        <div class="col-md-12 doc-group" data-citizenship="ЛНР/ДНР/Украина" style="display: none;">
                            <label class="form-label">Паспорт гражданина Украины/ДНР/ЛНР <span class="text-danger">*</span></label>
                            <input type="file" name="passport_ldnr" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЛНР/ДНР/Украина" style="display: none;">
                            <label class="form-label">Миграционная карта (при наличии)</label>
                            <input type="file" name="migration_card_ldnr" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЛНР/ДНР/Украина" style="display: none;">
                            <label class="form-label">Регистрация (при наличии)</label>
                            <input type="file" name="registration_ldnr" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЛНР/ДНР/Украина" style="display: none;">
                            <label class="form-label">Дактилоскопия (зеленая карта, при наличии)</label>
                            <input type="file" name="dactyloscopy_ldnr" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="col-md-12 doc-group" data-citizenship="ЛНР/ДНР/Украина" style="display: none;">
                            <label class="form-label">Медицинское освидетельствование</label>
                            <input type="file" name="medical_ldnr" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
<!--                        <div class="col-md-12 doc-group" data-citizenship="ЛНР/ДНР/Украина" style="display: none;">-->
<!--                            <label class="form-label">Полные банковские реквизиты </label>-->
<!--                            <input type="file" name="bank_details_ldnr" class="form-control" accept=".jpg,.jpeg,.png,.pdf">-->
<!--                        </div>-->


                        <!-- Согласие на обработку данных -->
                        <div class="col-12 mt-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="consent" name="consent" required>
                                <label class="form-check-label" for="consent">
                                    Я подтверждаю свое согласие на обработку персональных данных в целях трудоустройства в соответствии с <a class="text-dark text-decoration-underline" href="/privacy-policy" target="_blank">Политикой конфиденциальности</a>.
                                </label>
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

<?php include __DIR__ . '/includes/footer.php'; ?>

<script src="/assets/js/join-us-form-validate.js"></script>
</body>
</html>