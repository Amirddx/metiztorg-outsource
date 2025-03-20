document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("joinUsForm");
    const citizenshipSelect = document.getElementById("citizenship");
    const documentsContainer = document.getElementById("documents");
    const noticesContainer = document.getElementById("notices");

    const docConfig = {
        "РФ (Россия)": [
            { name: "passport_rf", label: "Паспорт", required: true },
            { name: "registration_rf", label: "Регистрация/Прописка", required: false },
            { name: "snils_rf", label: "СНИЛС", required: false },
            { name: "inn_rf", label: "ИНН", required: false }
        ],
        "ЕАЭС (Беларусь)": [
            { name: "passport_belarus", label: "Паспорт иностранного гражданина", required: true },
            { name: "registration_belarus", label: "Регистрация/Прописка", required: false },
            { name: "oms_belarus", label: "Полис ОМС (с двух сторон)", required: false },
            { name: "snils_belarus", label: "СНИЛС", required: false },
            { name: "inn_belarus", label: "ИНН", required: false }
        ],
        "ЕАЭС (Армения, Киргизия, Казахстан)": [
            { name: "passport_eaes", label: "Паспорт иностранного гражданина", required: true },
            { name: "passport_translation_eaes", label: "Перевод паспорта", required: false },
            { name: "registration_eaes", label: "Регистрация", required: false },
            { name: "insurance_eaes", label: "Полис ДМС или ОМС", required: false },
            { name: "dactyloscopy_eaes", label: "Дактилоскопия", required: false },
            { name: "snils_eaes", label: "СНИЛС", required: false },
            { name: "inn_eaes", label: "ИНН", required: false },
            { name: "migration_card_eaes", label: "Миграционная карта", required: false }
        ],
        "ВНЖ": [
            { name: "passport_vnj", label: "Паспорт иностранного гражданина", required: true },
            { name: "vnj_document", label: "Вид на жительство (ВНЖ)", required: true },
            { name: "registration_vnj", label: "Регистрация", required: false },
            { name: "oms_vnj", label: "Полис ОМС", required: false },
            { name: "dactyloscopy_vnj", label: "Дактилоскопия", required: false },
            { name: "snils_vnj", label: "СНИЛС", required: false },
            { name: "inn_vnj", label: "ИНН", required: false },
            { name: "migration_card_vnj", label: "Миграционная карта", required: false }
        ],
        "РВП": [
            { name: "passport_rvp", label: "Паспорт иностранного гражданина", required: true },
            { name: "rvp_document", label: "РВП", required: true },
            { name: "registration_rvp", label: "Регистрация", required: false },
            { name: "insurance_rvp", label: "Полис ДМС или ОМС", required: false },
            { name: "dactyloscopy_rvp", label: "Дактилоскопия", required: false },
            { name: "snils_rvp", label: "СНИЛС", required: false },
            { name: "inn_rvp", label: "ИНН", required: false },
            { name: "migration_card_rvp", label: "Миграционная карта", required: false }
        ],
        "СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)": [
            { name: "passport_sng", label: "Паспорт иностранного гражданина", required: true },
            { name: "patent_sng", label: "Патент", required: true },
            { name: "passport_translation_sng", label: "Перевод паспорта", required: false },
            { name: "registration_sng", label: "Регистрация", required: false },
            { name: "dms_sng", label: "Полис ДМС", required: false },
            { name: "dactyloscopy_sng", label: "Дактилоскопия", required: false },
            { name: "snils_sng", label: "СНИЛС", required: false },
            { name: "inn_sng", label: "ИНН", required: false },
            { name: "migration_card_sng", label: "Миграционная карта", required: false },
            { name: "patent_checks_sng", label: "Чеки по патенту", required: false }
        ],
        "Студент": [
            { name: "passport_student", label: "Паспорт иностранного гражданина", required: true },
            { name: "edu_certificate_student", label: "Справка из ВУЗа/СПО", required: true },
            { name: "passport_translation_student", label: "Перевод паспорта", required: false },
            { name: "registration_student", label: "Регистрация", required: false },
            { name: "visa_student", label: "Российская виза", required: false },
            { name: "dms_student", label: "Полис ДМС", required: false },
            { name: "dactyloscopy_student", label: "Дактилоскопия", required: false },
            { name: "snils_student", label: "СНИЛС", required: false },
            { name: "inn_student", label: "ИНН", required: false },
            { name: "migration_card_student", label: "Миграционная карта", required: false }
        ],
        "Лицо без гражданства": [
            { name: "temp_id_lbg", label: "Временное удостоверение личности", required: true },
            { name: "registration_lbg", label: "Регистрация", required: false },
            { name: "snils_lbg", label: "СНИЛС", required: false },
            { name: "inn_lbg", label: "ИНН", required: false },
            { name: "migration_card_lbg", label: "Миграционная карта", required: false }
        ],
        "Беженец": [
            { name: "refugee_id", label: "Удостоверение беженца", required: true },
            { name: "registration_refugee", label: "Регистрация", required: false },
            { name: "oms_refugee", label: "Полис ОМС", required: false },
            { name: "dactyloscopy_refugee", label: "Дактилоскопия", required: false },
            { name: "snils_refugee", label: "СНИЛС", required: false },
            { name: "inn_refugee", label: "ИНН", required: false },
            { name: "migration_card_refugee", label: "Миграционная карта", required: false }
        ],
        "Временное убежище": [
            { name: "temp_asylum", label: "Свидетельство о временном пребывании", required: true },
            { name: "registration_asylum", label: "Регистрация", required: false },
            { name: "oms_asylum", label: "Полис ОМС", required: false },
            { name: "dactyloscopy_asylum", label: "Дактилоскопия", required: false },
            { name: "snils_asylum", label: "СНИЛС", required: false },
            { name: "inn_asylum", label: "ИНН", required: false }
        ],
        "ЛНР/ДНР/Украина": [
            { name: "passport_ldnr", label: "Паспорт гражданина Украины/ДНР/ЛНР", required: true },
            { name: "migration_card_ldnr", label: "Миграционная карта", required: false },
            { name: "registration_ldnr", label: "Регистрация", required: false },
            { name: "dactyloscopy_ldnr", label: "Дактилоскопия", required: false },
            { name: "medical_ldnr", label: "Медицинское освидетельствование", required: false }
        ]
    };

    const phoneInput = document.querySelector(".phone-mask");
    if (phoneInput) {
        if (typeof IMask === "undefined") {
            console.error("IMask не загружен.");
        } else {
            IMask(phoneInput, { mask: "+{7} (000) 000-00-00", lazy: false, placeholderChar: "_" });
        }
    }


    function updateDocuments() {
        const selectedCitizenship = citizenshipSelect.value;
        documentsContainer.innerHTML = "";
        noticesContainer.style.display = "none";

        if (selectedCitizenship && docConfig[selectedCitizenship]) {
            docConfig[selectedCitizenship].forEach(doc => {
                const div = document.createElement("div");
                div.className = "col-md-12 mt-2 document-item";
                div.innerHTML = `
                <label class="form-label">${doc.label} ${doc.required ? '<span class="text-danger">*</span>' : ''}</label>
                <div class="input-group">
                    <input type="file" name="${doc.name}" class="form-control file-input" accept=".jpg,.jpeg,.png,.pdf" ${doc.required ? 'required' : ''}>
                    <button class="btn btn-outline-danger clear-file" type="button" style="display: none;">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <div class="preview mt-2" style="display: none;"></div>
            `;
                documentsContainer.appendChild(div);
            });

            noticesContainer.style.display = "block";
            const regionNotice = noticesContainer.querySelector('[data-notice="region"]');
            const regionRequired = ["РФ (Россия)", "ЕАЭС (Беларусь)", "ЕАЭС (Армения, Киргизия, Казахстан)", "ВНЖ", "РВП", "СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)", "Студент", "Лицо без гражданства", "Беженец"];
            regionNotice.style.display = regionRequired.includes(selectedCitizenship) ? "block" : "none";

            addFileListeners();
        }
    }

    function addFileListeners() {
        const MAX_FILE_SIZE = 10 * 1024 * 1024;

        documentsContainer.querySelectorAll(".file-input").forEach(input => {
            const clearButton = input.closest(".input-group").querySelector(".clear-file");
            const preview = input.closest(".document-item").querySelector(".preview");

            input.addEventListener("change", function () {
                const file = this.files[0];
                preview.innerHTML = "";
                preview.style.display = "none";
                clearButton.style.display = "none";

                if (file) {

                    if (file.size > MAX_FILE_SIZE) {
                        alert(`Загруженный файл слишком большой! Максимальный размер фото: 10 МБ.`);
                        this.value = "";
                        return;
                    }

                    clearButton.style.display = "block";

                    if (file.type.startsWith("image/")) {
                        const img = document.createElement("img");
                        img.src = URL.createObjectURL(file);
                        img.style.maxWidth = "200px";
                        img.className = "img-thumbnail";
                        preview.appendChild(img);
                    } else if (file.type === "application/pdf") {
                        preview.innerHTML = `<span>PDF: ${file.name}</span>`;
                    }
                    preview.style.display = "block";
                }
            });

            clearButton.addEventListener("click", () => {
                input.value = "";
                preview.innerHTML = "";
                preview.style.display = "none";
                clearButton.style.display = "none";
            });
        });
    }

//*
    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const consent = form.querySelector('[name="consent"]').checked;
        const recaptchaResponse = grecaptcha.getResponse();
        const submitButton = form.querySelector('button[type="submit"]');
        const phoneValue = form.querySelector('[name="phone"]').value;
        const originalButtonText = submitButton.textContent;

        if (!consent) return alert("Необходимо согласиться на обработку персональных данных");
        if (!recaptchaResponse) return alert("Пройдите проверку reCAPTCHA");
        const phoneDigitsOnly = phoneValue.replace(/[^\d]/g, "");
        if (phoneDigitsOnly.length < 11 || !/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/.test(phoneValue)) {
            return alert("Введите полный номер телефона в формате +7 (XXX) XXX-XX-XX");
        }

        submitButton.disabled = true;
        submitButton.textContent = "Отправка...";

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, { method: "POST", body: formData });
            if (!response.ok) throw new Error("Сетевая ошибка");
            const data = await response.json();

            if (data.errors) {
                alert("Ошибки:\n" + data.errors.join("\n"));
            } else if (data.redirect) {
                window.location.href = data.redirect;
            }
        } catch (error) {
            console.error("Ошибка отправки:", error);
            alert("Ошибка: " + error.message);
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = originalButtonText;
        }
    });


    updateDocuments();
    citizenshipSelect.addEventListener("change", updateDocuments);
});