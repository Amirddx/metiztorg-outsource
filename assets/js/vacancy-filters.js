document.addEventListener("DOMContentLoaded", function () {
    const cityFilter = document.getElementById("filter-city");
    const positionFilter = document.getElementById("filter-position");
    const vacancies = Array.from(document.querySelectorAll(".vacancy-item"));
    const showMoreButton = document.getElementById("show-more-vacancies");

    let visibleCount = 7; // кол-во вакансий при загрузке

    function applyFilters() {
        let selectedCity = cityFilter.value.trim().toLowerCase();
        let selectedPosition = positionFilter.value.trim().toLowerCase();

        let filteredVacancies = vacancies.filter(vacancy => {
            let city = vacancy.getAttribute("data-city")?.toLowerCase() || "";
            let position = vacancy.getAttribute("data-position")?.toLowerCase() || "";

            let cityMatch = !selectedCity || city === selectedCity;
            let positionMatch = !selectedPosition || position === selectedPosition;

            return cityMatch && positionMatch;
        });

        updateVacancyList(filteredVacancies);
    }

    function updateVacancyList(filteredVacancies) {
        vacancies.forEach(vacancy => vacancy.style.display = "none"); // Скрываем всё

        // показ только 7 вакансий сначала
        filteredVacancies.slice(0, visibleCount).forEach(vacancy => {
            vacancy.style.display = "block";
        });

        // показывать/скрывать кнопку "Показать все"
        showMoreButton.style.display = (filteredVacancies.length > visibleCount) ? "block" : "none";
    }

    // нажатие на "Показать все"
    showMoreButton.addEventListener("click", function () {
        visibleCount += 10; // увелич-ем лимит на 10 вакансий
        applyFilters();
    });

    // При изменении фильтра сбрасываем пагинацию
    function resetPagination() {
        visibleCount = 7;
        applyFilters();
    }

    cityFilter.addEventListener("change", resetPagination);
    positionFilter.addEventListener("change", resetPagination);

    applyFilters(); // Запуск фильтр при загрузке
});
