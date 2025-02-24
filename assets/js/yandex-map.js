document.addEventListener("DOMContentLoaded", function () {
    ymaps.ready(initMap);
});

function initMap() {
    let vacanciesData = document.getElementById("vacancies-data").textContent;
    let vacancies = JSON.parse(vacanciesData);

    let map = new ymaps.Map("map", {
        center: [59.9342802, 30.3350986], // Санкт-Петербург по умолчанию
        zoom: 10
    });

    vacancies.forEach((vacancy) => {
        let coords = vacancy.Coordinates;

        if (coords && coords.length === 2) {
            let placemark = new ymaps.Placemark(coords, {
                balloonContentHeader: `<strong style="font-size: 16px; color: #0056b3;">${vacancy.Position}</strong>`,
                balloonContentBody: `
                    <p><b>Адрес:</b> ${vacancy.Address}</p>
                    <p><b>Кол-во мест:</b> ${vacancy.Headcount} чел.</p>
                    <p><b>Ставка:</b> ${vacancy.HourlyPay} руб./час</p>
                    <p><b>График:</b> ${vacancy.Slots}</p>
                    <p><b>Акции:</b> ${vacancy.Promotions || 'Нет'}</p>
                `,
                balloonContentFooter: '<small style="color: #888;">Кликните, чтобы закрыть</small>'
            }, {
                preset: 'islands#blueDotIcon',
                openBalloonOnClick: true
            });

            map.geoObjects.add(placemark);
        }
    });
}
