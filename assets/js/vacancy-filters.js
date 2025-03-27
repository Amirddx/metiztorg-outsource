document.addEventListener("DOMContentLoaded", function () {
    const cityFilter = document.getElementById("filter-city");
    const positionFilter = document.getElementById("filter-position");
    const vacancies = Array.from(document.querySelectorAll(".vacancy-item"));
    const showMoreButton = document.getElementById("show-more-vacancies");
    const resetButton = document.getElementById("reset-filters");

    let visibleCount = 7;


    function applyFilters() {
        const selectedCity = cityFilter.value.trim().toLowerCase();
        const selectedPosition = positionFilter.value.trim().toLowerCase();

        const filteredVacancies = vacancies.filter(vacancy => {
            const city = vacancy.getAttribute("data-city")?.toLowerCase() || "";
            const position = vacancy.getAttribute("data-position")?.toLowerCase() || "";
            return (!selectedCity || city === selectedCity) && (!selectedPosition || position === selectedPosition);
        });

        updateVacancyList(filteredVacancies);
        updateResetButtonState();
    }


    function updateVacancyList(filteredVacancies) {
        vacancies.forEach(vacancy => vacancy.style.display = "none");
        filteredVacancies.slice(0, visibleCount).forEach(vacancy => vacancy.style.display = "block");
        showMoreButton.style.display = filteredVacancies.length > visibleCount ? "block" : "none";
    }


    function updateResetButtonState() {
        const cityValue = cityFilter.value;
        const positionValue = positionFilter.value;
        const isCitySelected = cityValue !== "" && cityValue !== null;
        const isPositionSelected = positionValue !== "" && positionValue !== null;
        const shouldEnable = isCitySelected || isPositionSelected;


        console.log("City:", cityValue, "Position:", positionValue, "Enable Reset:", shouldEnable);

        resetButton.disabled = !shouldEnable;
    }

    // Сброс фильтров
    function resetFilters() {
        cityFilter.value = "";
        positionFilter.value = "";
        visibleCount = 7;
        applyFilters(); // Обновляем список и состояние кнопки
    }

    // Обработчики событий
    cityFilter.addEventListener("change", () => {
        visibleCount = 7;
        applyFilters();
    });

    positionFilter.addEventListener("change", () => {
        visibleCount = 7;
        applyFilters();
    });

    showMoreButton.addEventListener("click", () => {
        visibleCount += 10;
        applyFilters();
    });

    resetButton.addEventListener("click", () => {
        resetFilters();
    });

    // Инициализация
    applyFilters();
});