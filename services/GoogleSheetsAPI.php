<?php
namespace Services; // ну это просто для удобства, типа пространство имён, чтобы потом подключать без путаницы

require __DIR__ . '/../vendor/autoload.php'; // подключаем composer, потому что google api без него не работает
require __DIR__ . '/../includes/config.php';

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsAPI {
    private $service; // тут будет сам сервис google sheets через него будем дергать данные

    public function __construct() {
        // создаём   клиент google api
        $client = new Client();
        $client->setApplicationName('Google Sheets API'); // просто название
        $client->setScopes(Sheets::SPREADSHEETS_READONLY); // ставим права читатьеля чтобы запрос был с нужными правами.
        $client->setAuthConfig(GOOGLE_KEY_PATH); //  путь к ключам
        $this->service = new Sheets($client); // создаём объект google sheets api и сохраняем в переменную, будем через него работать
    }

    public function getVacancies() {
        $range = 'Вакансии!A:Z'; // вытаскиваем все данные из столбцов от A до Z (на всякий случай, чтобы ничего не потерять)

        try {
            // отправляем запрос к google таблице и получаем данные
            $response = $this->service->spreadsheets_values->get(GOOGLE_SPREADSHEET_ID, $range);
            $values = $response->getValues(); // тут лежат все данные из таблицы

            if (empty($values)) {
                return []; // если таблица пустая, просто возвращаем пустой массив, чтобы ничего не сломалось
            }

            // тут мы указываем, какие данные нас интересуют, если что-то надо добавить — просто вписываешь новый столбец
            $columns = [
                'City' => 'A',
                'Date' => 'C',  // дата открытия вакансии
                'Address' => 'I',
                'Salary' => 'J' // ставка в час (зп)
            ];

            // находим индексы нужных нам столбцов (например, A=0, B=1, C=2 и так далее)
            $headerRow = array_shift($values); // убираем заголовки (первую строку таблицы), они нам не нужны
            $columnIndexes = [];
            foreach ($columns as $key => $col) {
                $colIndex = array_search($col, range('A', 'Z')); // смотрим какой у столбца номер (типа A — это 0, B — это 1 и тд..)
                $columnIndexes[$key] = $colIndex; // сохраняем индексы, потом будем их использовать
            }

            // теперь собираем данные по вакансиям в удобный массив
            $vacancies = [];
            foreach ($values as $row) {
                $vacancy = [];
                foreach ($columnIndexes as $key => $index) {
                    $vacancy[$key] = $row[$index] ?? ''; // если данных нет,  просто ставим пустую строку, чтобы ошибок не было
                }
                $vacancies[] = $vacancy; // добавляем вакансию в массив
            }

            return $vacancies; // возвращаем список вакансий в виде массива, чтобы потом легко с ним работать
        } catch (Exception $e) {
            return []; // если случится ошибка (например, гугл заблокировал доступ), просто вернём пустой массив, чтобы не уронить сайт
        }
    }
}
