<?php
require __DIR__ . '/services/GoogleSheetsAPI.php';

use Services\GoogleSheetsAPI;

$googleSheets = new GoogleSheetsAPI();
$vacancies = $googleSheets->getVacancies();
$mapData = json_encode($vacancies, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Открытые Вакансии</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/metiztorg-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        #map {
            width: 100%;
            height: 600px;
            border-radius: 10px;
            overflow: hidden;
        }
        .vacancy-item {
            transition: all 0.3s ease-in-out;
        }
        .vacancy-item:hover {
            background-color: #f8f9fa;
        }
        .badge-status {
            font-size: 0.9rem;
            padding: 0.4em 0.7em;
        }
    </style>
</head>
<body>
<?php include __DIR__ . '/includes/navbar.php'; ?>

<main class="container my-4">
    <h1 class="text-center mb-4">Открытые Вакансии</h1>

    <!-- Фильтры -->
    <div class="row mb-3">
        <div class="col-md-4">
            <select class="form-select" id="filter-city">
                <option value="">Выберите город</option>
                <?php
                $uniqueCities = array_unique(array_column($vacancies, 'City'));
                sort($uniqueCities);
                foreach ($uniqueCities as $city): ?>
                    <option value="<?php echo htmlspecialchars($city); ?>"><?php echo htmlspecialchars($city); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="filter-position">
                <option value="">Выберите должность</option>
                <?php
                $uniquePositions = array_unique(array_column($vacancies, 'Position'));
                sort($uniquePositions);
                foreach ($uniquePositions as $position): ?>
                    <option value="<?php echo htmlspecialchars($position); ?>"><?php echo htmlspecialchars($position); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-outline-secondary w-100" id="reset-filters" disabled>Сбросить фильтры</button>
        </div>
    </div>

    <div class="row">
        <!-- Список вакансий -->
        <div class="col-lg-5">
            <div class="list-group" id="vacancy-list">
                <?php foreach ($vacancies as $vacancy): ?>
                    <a href="#" class="list-group-item list-group-item-action vacancy-item"
                       data-city="<?php echo htmlspecialchars($vacancy['City']); ?>"
                       data-position="<?php echo htmlspecialchars($vacancy['Position']); ?>"
                       data-address="<?php echo htmlspecialchars($vacancy['Address']); ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <?php
                            $status = trim(mb_strtolower($vacancy['Status'], 'UTF-8'));
                            $badgeClass = ($status === 'открыта') ? 'success' : 'danger';
                            ?>
                            <span class="badge bg-<?php echo $badgeClass; ?> badge-status">
                    <?php echo htmlspecialchars($vacancy['Status']); ?>
                </span>
                            <span class="badge bg-secondary badge-status">ЦФЗ</span>
                        </div>
                        <strong class="d-block mt-2 text-primary">
                            <?php echo htmlspecialchars($vacancy['Address']); ?>
                        </strong>
                        <small class="text-muted"><?php echo htmlspecialchars($vacancy['District']); ?></small>
                        <div class="mt-2">
                            <span class="text-muted"><?php echo htmlspecialchars($vacancy['Position']); ?></span> |
                            <strong><?php echo htmlspecialchars($vacancy['Headcount']); ?></strong> чел. |
                            <span class="text-muted"><?php echo htmlspecialchars($vacancy['Slots']); ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <button id="show-more-vacancies" class="btn btn-outline-secondary w-100 mt-3">Показать все</button>
        </div>

        <!-- Карта -->
        <div class="col-lg-7">
            <div id="map"></div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<!-- Передаём JSON с вакансиями в скрытый тег -->
<script id="vacancies-data" type="application/json"><?php echo $mapData; ?></script>

<!-- Подключаем API Яндекс.Карт -->
<script src="https://api-maps.yandex.ru/2.1/?apikey=<?php echo YANDEX_API_KEY; ?>&lang=ru_RU"></script>
<script src="assets/js/yandex-map.js"></script>
<script src="assets/js/vacancy-filters.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
