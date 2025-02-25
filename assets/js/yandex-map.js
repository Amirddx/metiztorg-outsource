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
            let latitude = parseFloat(coords[1]); // Широта
            let longitude = parseFloat(coords[0]); // Долгота

            let placemark = new ymaps.Placemark(
                [latitude, longitude],
                {
                    balloonContent: `
                        <div style="
                            max-width: 270px; 
                            font-family: Arial, sans-serif; 
                            position: relative;
                            padding: 5px;
                        ">
                         

                            <strong style="font-size: 16px; color: #0056b3; display: block; margin-bottom: 5px;">
                                ${vacancy.Position}
                            </strong>
                            
                            <p style="margin: 5px 0;"><b>Адрес:</b> ${vacancy.Address}</p>
                            <p style="margin: 5px 0;"><b>Кол-во мест:</b> ${vacancy.Headcount} чел.</p>
                            <p style="margin: 5px 0;"><b>Ставка:</b> ${vacancy.HourlyPay} руб./час</p>
                            <p style="margin: 5px 0;"><b>График:</b> ${vacancy.Slots}</p>
                            <p style="margin: 5px 0;"><b>Акции:</b> ${vacancy.Promotions || 'Нет'}</p>
                        </div>
                    `
                },
                {
                    preset: 'islands#blueDotIcon',
                    openBalloonOnClick: true
                }
            );

            map.geoObjects.add(placemark);
        }
    });
}
