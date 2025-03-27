document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    if (!form) return;

    const phoneInputs = document.querySelectorAll('.phone-mask');

    phoneInputs.forEach(function (input) {
        input.addEventListener('input', onPhoneInput);
        input.addEventListener('focus', onPhoneInput);
        input.addEventListener('blur', onPhoneBlur);
        input.addEventListener('keydown', onPhoneKeyDown);
    });

    function onPhoneInput(e) {
        let input = e.target;
        let value = input.value.replace(/\D/g, '');
        let formatted = '+7 (';

        if (value.length > 1) value = value.slice(1);

        if (value.length > 0) formatted += value.substring(0, 3);
        if (value.length >= 4) formatted += ') ' + value.substring(3, 6);
        if (value.length >= 7) formatted += '-' + value.substring(6, 8);
        if (value.length >= 9) formatted += '-' + value.substring(8, 10);

        input.value = formatted;
    }

    function onPhoneBlur(e) {
        const input = e.target;
        if (input.value.length < 18) {
            input.setCustomValidity("Введите полный номер телефона");
            input.reportValidity();
        } else {
            input.setCustomValidity("");
        }
    }

    function onPhoneKeyDown(e) {
        const allowed = [8, 9, 37, 39, 46];
        if (!/\d/.test(e.key) && !allowed.includes(e.keyCode)) {
            e.preventDefault();
        }
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const phoneInput = form.querySelector('[name="phone"]');
        const messageInput = form.querySelector('[name="message"]');
        const submitButton = form.querySelector("button[type='submit']");
        const phoneValue = phoneInput.value;
        const messageValue = messageInput.value.trim();

        if (!/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/.test(phoneValue)) {
            phoneInput.setCustomValidity("Введите корректный номер телефона");
            phoneInput.reportValidity();
            return;
        } else {
            phoneInput.setCustomValidity("");
        }

        if (messageValue.length < 10) {
            messageInput.setCustomValidity("Сообщение должно содержать не менее 10 символов");
            messageInput.reportValidity();
            return;
        } else {
            messageInput.setCustomValidity("");
        }

        const formData = new FormData(form);
        submitButton.disabled = true;
        submitButton.textContent = "Отправка...";

        fetch(form.action, {
            method: "POST",
            body: formData
        })
            .then(response => {
                if (!response.ok) throw new Error("Ошибка сервера");
                return response.json();
            })
            .then(data => {
                if (data.errors && data.errors.length > 0) {
                    alert(data.errors.join("\n"));
                } else if (data.redirect) {
                    window.location.href = data.redirect;
                }
            })
            .catch(error => {
                alert("Ошибка отправки: " + error.message);
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = "Отправить сообщение";
            });
    });
});
