<?php

function validateJoinUsForm($postData, $filesData) {
    $errors = [];
    $validatedData = [];

    // Валидация текстовых полей
    $validatedData['lastName'] = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '';
    $validatedData['firstName'] = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '';
    $validatedData['middleName'] = filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '';
    $validatedData['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '';
    $validatedData['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?: '';
    $validatedData['citizenship'] = filter_input(INPUT_POST, 'citizenship', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: '';
    $validatedData['consent'] = isset($postData['consent']) && $postData['consent'] === "on";

    if (empty($validatedData['lastName'])) $errors[] = "Фамилия обязательна";
    if (empty($validatedData['firstName'])) $errors[] = "Имя обязательно";
    if (empty($validatedData['phone']) || !preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $validatedData['phone'])) {
        $errors[] = "Неверный формат телефона. Используйте: +7 (XXX) XXX-XX-XX";
    }
    if (empty($validatedData['email']) || !filter_var($validatedData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email";
    }
    if (empty($validatedData['citizenship'])) $errors[] = "Гражданство обязательно";
    if (!$validatedData['consent']) $errors[] = "Необходимо согласие на обработку персональных данных";

    // Список возможных файлов
    $fileFields = [
        'РФ (Россия)' => ['passport_rf', 'registration_rf', 'snils_rf', 'inn_rf'],
        'ЕАЭС (Беларусь)' => ['passport_belarus', 'registration_belarus', 'oms_belarus', 'snils_belarus', 'inn_belarus'],
        'ЕАЭС (Армения, Киргизия, Казахстан)' => [
            'passport_eaes', 'passport_translation_eaes', 'registration_eaes', 'insurance_eaes',
            'dactyloscopy_eaes', 'snils_eaes', 'inn_eaes', 'migration_card_eaes'
        ],
        'ВНЖ' => [
            'passport_vnj', 'registration_vnj', 'oms_vnj', 'dactyloscopy_vnj',
            'snils_vnj', 'inn_vnj', 'migration_card_vnj', 'vnj_document'
        ],
        'РВП' => [
            'passport_rvp', 'registration_rvp', 'insurance_rvp', 'dactyloscopy_rvp',
            'snils_rvp', 'inn_rvp', 'migration_card_rvp', 'rvp_document'
        ],
        'СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)' => [
            'passport_sng', 'passport_translation_sng', 'registration_sng', 'dms_sng',
            'dactyloscopy_sng', 'snils_sng', 'inn_sng', 'migration_card_sng',
            'patent_sng', 'patent_checks_sng'
        ],
        'Студент' => [
            'passport_student', 'passport_translation_student', 'registration_student',
            'visa_student', 'dms_student', 'dactyloscopy_student', 'snils_student',
            'inn_student', 'migration_card_student', 'edu_certificate_student'
        ],
        'Лицо без гражданства' => [
            'temp_id_lbg', 'registration_lbg', 'snils_lbg', 'inn_lbg', 'migration_card_lbg'
        ],
        'Беженец' => [
            'refugee_id', 'registration_refugee', 'oms_refugee', 'dactyloscopy_refugee',
            'snils_refugee', 'inn_refugee', 'migration_card_refugee'
        ],
        'Временное убежище' => [
            'temp_asylum', 'registration_asylum', 'oms_asylum', 'dactyloscopy_asylum',
            'snils_asylum', 'inn_asylum'
        ],
        'ЛНР/ДНР/Украина' => [
            'passport_ldnr', 'migration_card_ldnr', 'registration_ldnr',
            'dactyloscopy_ldnr', 'medical_ldnr'
        ]
    ];

    $requiredFiles = [
        'РФ (Россия)' => ['passport_rf'],
        'ЕАЭС (Беларусь)' => ['passport_belarus'],
        'ЕАЭС (Армения, Киргизия, Казахстан)' => ['passport_eaes'],
        'ВНЖ' => ['passport_vnj', 'vnj_document'],
        'РВП' => ['passport_rvp', 'rvp_document'],
        'СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)' => ['passport_sng', 'patent_sng'],
        'Студент' => ['passport_student', 'edu_certificate_student'],
        'Лицо без гражданства' => ['temp_id_lbg'],
        'Беженец' => ['refugee_id'],
        'Временное убежище' => ['temp_asylum'],
        'ЛНР/ДНР/Украина' => ['passport_ldnr']
    ];

    // Валидация файлов
    $attachments = [];
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $maxSize = 5 * 1024 * 1024;

    if (isset($fileFields[$validatedData['citizenship']])) {
        foreach ($fileFields[$validatedData['citizenship']] as $fileField) {
            if (!empty($filesData[$fileField]['tmp_name'])) {
                $file = $filesData[$fileField];
                $fileType = mime_content_type($file['tmp_name']);
                $fileSize = $file['size'];

                if (!in_array($fileType, $allowedTypes)) {
                    $errors[] = "Файл {$fileField} имеет недопустимый формат. Используйте JPG, PNG или PDF.";
                }
                if ($fileSize > $maxSize) {
                    $errors[] = "Файл {$fileField} превышает максимальный размер в 5MB.";
                }

                $attachments[] = [
                    'filePath' => $file['tmp_name'],
                    'filename' => $file['name']
                ];
            } elseif (isset($requiredFiles[$validatedData['citizenship']]) && in_array($fileField, $requiredFiles[$validatedData['citizenship']])) {
                $errors[] = "Файл {$fileField} обязателен для выбранного гражданства.";
            }
        }
    }

    return [
        'errors' => $errors,
        'data' => $validatedData,
        'attachments' => $attachments
    ];
}
?>