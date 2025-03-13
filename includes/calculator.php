<!-- Калькулятор дохода -->
    <div class="container">

        <h2 class="fw-bold mb-5 fs-2 text-center" data-aos="fade-up">Калькулятор дохода</h2>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card border-0 shadow h-100">
                    <div class="card-body p-4 text-start">
                        <form id="calculatorForm">
                            <!-- Должность -->
                            <div class="mb-3">
                                <label for="position" class="form-label fw-bold fs-4">Выбери свою роль</label>
                                <p class="text-muted mb-2 fs-6">Начни зарабатывать уже сегодня!</p>
                                <select class="form-select" id="position" name="position" required>
                                    <option value="" selected disabled>Выбери роль...</option>
                                    <option value="collector">Сборщик заказов</option>
                                    <option value="courier_bike">Вело-курьер</option>
                                    <option value="courier_car">Авто-курьер</option>
                                </select>
                            </div>

                            <!-- Дни -->
                            <div class="mb-3">
                                <label for="days" class="form-label fw-bold fs-4">Сколько дней в месяце ты планируешь работать?</label>
                                <p class="text-muted mb-2 fs-6">Шаг к финансовой свободе!</p>
                                <input type="range" class="form-range custom-range" id="days" name="days" min="1" max="30" value="1">
                                <div class="d-flex justify-content-between text-muted small">
                                    <span>1</span>
                                    <span id="daysOutput" class="fw-bold"></span>
                                    <span>30</span>
                                </div>
                            </div>

                            <!-- Часы -->
                            <div class="mb-3">
                                <label for="hours" class="form-label fw-bold fs-4">Сколько часов в день ты планируешь работать?</label>
                                <p class="text-muted mb-2 fs-6">Время — твои деньги!</p>
                                <input type="range" class="form-range custom-range" id="hours" name="hours" min="3" max="16" value="3">
                                <div class="d-flex justify-content-between text-muted small">
                                    <span>3</span>
                                    <span id="hoursOutput" class="fw-bold"></span>
                                    <span>16</span>
                                </div>
                            </div>

                            <!-- Результат -->
                            <div id="result" class="alert alert-warning fw-bold fs-3 py-3 text-start" role="alert">
                                Твой доход: 0 руб.
                            </div>
                            <p class="text-muted fs-6">* Расчёт выполнен в среднем и может меняться в зависимости от города.</p>
                            <p class="text-muted fs-6">* Выплаты — каждую неделю!</p>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Стили  для ползунка (thumb) -->
<style>
    .custom-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #ffcd39;
        border: 2px solid #fff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .custom-range::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #ffcd39;
        border: 2px solid #fff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- JavaScript  -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('calculatorForm');
        const positionSelect = document.getElementById('position');
        const daysInput = document.getElementById('days');
        const hoursInput = document.getElementById('hours');
        const daysOutput = document.getElementById('daysOutput');
        const hoursOutput = document.getElementById('hoursOutput');
        const resultDiv = document.getElementById('result');

        // Инициализация значений по умолчанию
        daysOutput.textContent = daysInput.value;
        hoursOutput.textContent = hoursInput.value;

        // Обновление значений output при изменении слайдеров
        daysInput.addEventListener('input', function () {
            daysOutput.textContent = this.value;
            calculateTotal();
        });
        hoursInput.addEventListener('input', function () {
            hoursOutput.textContent = this.value;
            calculateTotal();
        });
        positionSelect.addEventListener('change', calculateTotal);

        // Функция расчёта итоговой суммы
        function calculateTotal() {
            const position = positionSelect.value;
            const days = parseInt(daysInput.value);
            const hours = parseInt(hoursInput.value);
            let hourlyRate = 0;

            if (position === 'collector') {
                hourlyRate = 290; // Средняя ставка для сборщиков
            } else if (position === 'courier_bike') {
                const fixedRate = 215;
                const orderRate = 40;
                const averageOrdersPerHour = 4;
                hourlyRate = fixedRate + (orderRate * averageOrdersPerHour);
            } else if (position === 'courier_car') {
                const fixedRate = 230;
                const orderRate = 45;
                const averageOrdersPerHour = 4;
                hourlyRate = fixedRate + (orderRate * averageOrdersPerHour);
            }

            if (hourlyRate && days && hours) {
                const total = hourlyRate * hours * days;
                resultDiv.textContent = `Твой доход: ${total.toLocaleString('ru-RU')} руб.`;
            } else {
                resultDiv.textContent = `Твой доход: 0 руб.`;
            }
        }

        // Изначальный расчёт
        calculateTotal();
    });
</script>