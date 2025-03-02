document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const citizenshipSelect = document.getElementById("citizenship");
    const docGroups = document.querySelectorAll(".doc-group");
    const notices = document.querySelector(".notices");
    const noticeElements = notices.querySelectorAll(".alert");

    // Маска для телефона
    const phoneInput = document.querySelector(".phone-mask");
    if (phoneInput) {
        phoneInput.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\D/g, "");
            if (value.length > 11) value = value.slice(0, 11);

            let formatted = "";
            if (value.length > 0) {
                formatted = "+7";
                if (value.length > 1) {
                    formatted += " (" + value.slice(1, Math.min(4, value.length));
                    if (value.length > 4) {
                        formatted += ") " + value.slice(4, Math.min(7, value.length));
                        if (value.length > 7) {
                            formatted += "-" + value.slice(7, Math.min(9, value.length));
                            if (value.length > 9) {
                                formatted += "-" + value.slice(9, 11);
                            }
                        }
                    }
                }
            }
            e.target.value = formatted;
        });
    }

    // Обновление формы
    function updateForm() {
        const selectedCitizenship = citizenshipSelect.value;
        docGroups.forEach(group => {
            group.style.display = "none";
            const input = group.querySelector("input");
            if (input) input.required = false;
        });
        notices.style.display = "none";
        noticeElements.forEach(notice => notice.style.display = "none");

        if (selectedCitizenship) {
            const relevantDocs = document.querySelectorAll(`.doc-group[data-citizenship="${selectedCitizenship}"]`);
            relevantDocs.forEach(group => {
                group.style.display = "block";
                const input = group.querySelector("input");
                if (input && group.querySelector(".text-danger")) input.required = true;
            });
            notices.style.display = "block";
            showNotices(selectedCitizenship);
        }
    }

    function showNotices(citizenship) {
        const commonNotice = notices.querySelector('[data-notice="common"]');
        commonNotice.style.display = "block";
        const ageNotice = notices.querySelector('[data-notice="age"]');
        ageNotice.style.display = "block";
        const regionNotice = notices.querySelector('[data-notice="region"]');
        const regionRequired = [
            "РФ (Россия)", "ЕАЭС (Беларусь)", "ЕАЭС (Армения, Киргизия, Казахстан)",
            "ВНЖ", "РВП", "СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)",
            "Студент", "Лицо без гражданства", "Беженец"
        ];
        regionNotice.style.display = regionRequired.includes(citizenship) ? "block" : "none";
    }

    // Клиентская валидация
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let errors = [];
        const lastName = form.querySelector('[name="lastName"]').value.trim();
        const firstName = form.querySelector('[name="firstName"]').value.trim();
        const phone = form.querySelector('[name="phone"]').value.trim();
        const email = form.querySelector('[name="email"]').value.trim();
        const citizenship = citizenshipSelect.value;
        const consent = form.querySelector('[name="consent"]').checked;

        if (!lastName) errors.push("Фамилия обязательна");
        if (!firstName) errors.push("Имя обязательно");
        if (!phone || !/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/.test(phone)) {
            errors.push("Неверный формат телефона. Используйте: +7 (XXX) XXX-XX-XX");
        }
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errors.push("Неверный формат email");
        }
        if (!citizenship) errors.push("Выберите статус/гражданство");
        if (!consent) errors.push("Необходимо согласиться на обработку персональных данных");

        const requiredFiles = {
            'РФ (Россия)': ['passport_rf'],
            'ЕАЭС (Беларусь)': ['passport_belarus'],
            'ЕАЭС (Армения, Киргизия, Казахстан)': ['passport_eaes'],
            'ВНЖ': ['passport_vnj', 'vnj_document'],
            'РВП': ['passport_rvp', 'rvp_document'],
            'СНГ (Азербайджан, Молдова, Таджикистан, Узбекистан)': ['passport_sng', 'patent_sng'],
            'Студент': ['passport_student', 'edu_certificate_student'],
            'Лицо без гражданства': ['temp_id_lbg'],
            'Беженец': ['refugee_id'],
            'Временное убежище': ['temp_asylum'],
            'ЛНР/ДНР/Украина': ['passport_ldnr']
        };

        if (requiredFiles[citizenship]) {
            requiredFiles[citizenship].forEach(field => {
                const input = form.querySelector(`[name="${field}"]`);
                if (!input.files.length) {
                    errors.push(`Файл "${input.previousElementSibling.textContent.trim()}" обязателен`);
                } else {
                    const file = input.files[0];
                    const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    const maxSize = 5 * 1024 * 1024;
                    if (!allowedTypes.includes(file.type)) {
                        errors.push(`Файл "${file.name}" имеет неверный формат. Используйте JPG, PNG или PDF`);
                    }
                    if (file.size > maxSize) {
                        errors.push(`Файл "${file.name}" превышает 5MB`);
                    }
                }
            });
        }

        if (errors.length > 0) {
            alert("Ошибки:\n" + errors.join("\n"));
        } else {
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        alert("Ошибки сервера:\n" + data.errors.join("\n"));
                    } else {
                        window.location.href = "/success.php";
                    }
                })
                .catch(error => alert("Ошибка: " + error));
        }
    });

    updateForm();
    citizenshipSelect.addEventListener("change", updateForm);
});