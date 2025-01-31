<?php
require __DIR__ . '/services/GoogleSheetsAPI.php';
require __DIR__ . '/services/YandexMapsAPI.php';



use Services\GoogleSheetsAPI;
use Services\YandexMapsAPI;

$googleSheets = new GoogleSheetsAPI();
$vacancies = $googleSheets->getVacancies();
$mapData = YandexMapsAPI::getVacanciesForMap($vacancies);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Открытые Вакансии</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/metiztorg-style.css">
</head>
<body>
<?php include __DIR__ . '/includes/navbar.php'; ?>

<main class="container my-5">
    <h1 class="text-center mb-4">Открытые Вакансии</h1>

    <div class="row">
        <!-- блок для адресов -->
        <div class="col-md-6">
            <ul class="list-group" id="vacancy-list">
                <?php foreach ($vacancies as $index => $vacancy): ?>
                    <li class="list-group-item vacancy-item" data-index="<?php echo $index; ?>">
                        📍 <strong><?php echo htmlspecialchars($vacancy['City']); ?></strong>,
                        <?php echo htmlspecialchars($vacancy['Address']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- карта -->
        <div class="col-md-6">
            <div id="map" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<!-- Подкл апи яндекс карт -->
<script src="https://api-maps.yandex.ru/2.1/?apikey=<?php echo YANDEX_API_KEY;?>&lang=ru_RU"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var map;
        var mapData = <?php echo $mapData; ?>;
        var placemarks = [];

        ymaps.ready(function () {
            map = new ymaps.Map("map", {
                center: [55.751244, 37.618423], //по умолчанию Москва
                zoom: 10
            });

            // Доб. все точки сразу
            mapData.forEach((item, index) => {
                ymaps.geocode(item.address).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    if (firstGeoObject) {
                        var coords = firstGeoObject.geometry.getCoordinates();
                        var placemark = new ymaps.Placemark(coords, {
                            balloonContent: `<strong>${item.city}</strong><br>${item.address}`
                        });

                        map.geoObjects.add(placemark);
                        placemarks[index] = placemark;
                    }
                });
            });

            // При клике на вакансию  приближение карту к точке
            document.querySelectorAll(".vacancy-item").forEach((item) => {
                item.addEventListener("click", function () {
                    var index = this.getAttribute("data-index");
                    if (placemarks[index]) {
                        map.setCenter(placemarks[index].geometry.getCoordinates(), 15, { duration: 500 });
                    }
                });
            });
        });
    });
</script>
</body>
</html>
