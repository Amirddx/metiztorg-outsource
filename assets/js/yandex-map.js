document.addEventListener("DOMContentLoaded", () => {
    ymaps.ready(initMap);
});

function initMap() {

    const vacancies = JSON.parse(document.getElementById("vacancies-data").textContent);


    const map = new ymaps.Map("map", {
        center: [59.9342802, 30.3350986], // Санкт-Петербург
        zoom: 11,
        controls: ["zoomControl"]
    });


    vacancies.forEach(vacancy => {
        const [longitude, latitude] = vacancy.Coordinates || [];

        if (latitude && longitude) {
            const placemark = new ymaps.Placemark(
                [latitude, longitude],
                {
                    balloonContent: `
                        <div class="custom-balloon card shadow-sm border-0 p-3" style="max-width: 320px; font-family: Arial, sans-serif;">
                            <h5 class="card-title fw-bold text-primary mb-3">${vacancy.Position}</h5>
                            <ul class="list-unstyled text-muted mb-0">
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                                    <span><strong>Адрес:</strong> ${vacancy.Address}</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="bi bi-people-fill text-warning me-2"></i>
                                    <span><strong>Мест:</strong> ${vacancy.Headcount} чел.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="bi bi-cash-stack text-warning me-2"></i>
                                    <span><strong>Ставка(фикс):</strong> ${vacancy.HourlyPay} руб./час</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="bi bi-coin text-warning me-2"></i>
                                    <span><strong>За заказ:</strong> ${vacancy.OrderPay || '0'} руб.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="bi bi-wallet2 text-warning me-2"></i>
                                    <span><strong>Средний доход за смену:</strong> ${vacancy.ShiftPay || '0'} руб.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="bi bi-calendar3 text-warning me-2"></i>
                                    <span><strong>График:</strong> ${vacancy.Slots}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-gift-fill text-warning me-2"></i>
                                    <span><strong>Акции:</strong> ${vacancy.Promotions || "Нет"}</span>
                                </li>
                            </ul>
                            <a href="/join-us.php" class="btn btn-warning btn-sm mt-3 w-100">Подать заявку</a>
                        </div>
                    `
                },
                {
                    preset: "islands#blueCircleDotIcon",
                    balloonOffset: [0, -15],
                    hideIconOnBalloonOpen: false
                }
            );

            map.geoObjects.add(placemark);
        }
    });


    if (vacancies.length) {
        map.setBounds(map.geoObjects.getBounds(), { checkZoomRange: true, duration: 500 });
    }
}