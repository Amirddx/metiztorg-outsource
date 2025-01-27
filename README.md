# metiztorg-outsource
Web application for an outsourcing company. A platform for managing job openings, employment applications, and referral programs. Includes features such as a bonus calculator and a map of available positions.

/                   # Корень проекта
├── index.php       # Главная страница
├── vacancies.php   # Страница "Открытые вакансии"
├── apply.php       # Страница "Заполнить анкету"
├── refer.php       # Страница "Приведи друга"
├── includes/       # Подключаемые части (header, footer, конфигурация)
│   ├── navbar.php  # Шапка
│   ├── footer.php  # Подвал
│   └── config.php  # Конфигурация (например, параметры базы данных, ключи API)
├── assets/         # Статические файлы (CSS, JS, изображения)
│   ├── css/        # Стили
│   │   ├── bootstrap.min.css
│   │   ├── metiztorg-style.css
│   ├── js/         # Скрипты JavaScript
│   │   ├── main.js
│   ├── images/     # Изображения
│   │   ├── icon-delivery.png
├── uploads/        # Загруженные файлы (например, резюме, фотографии)
├── forms/          # Обработка форм
│   ├── apply-handler.php  # Обработка анкеты
│   ├── refer-handler.php  # Обработка формы "Приведи друга"
├── api/            # Работа с внешними API
│   ├── google-sheets.php  # Получение данных из Google Таблиц
│   ├── smtp-mailer.php    # SMTP библиотека или настройки
│   └── helpers.php        # Вспомогательные функции
└── .htaccess       # Конфигурация сервера



