<?php

namespace Services;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/Cache.php';
require_once __DIR__ . '/YandexMapsAPI.php';

use Google\Client;
use Google\Service\Sheets;
use Services\YandexMapsAPI;
class GoogleSheetsAPI {
    private $service;
    private $cache;

    public function __construct() {
        $client = new Client();
        $client->setScopes(Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(GOOGLE_KEY_PATH);
        $this->service = new Sheets($client);
        $this->cache = new Cache(); // Используем кэш
    }

    public function getVacancies() {
        // Загружаем кэш
        $cachedData = $this->cache->getCache();
        if (!$this->cache->isCacheExpired()) {
            return $cachedData['vacancies']; // Возвращаем, если кэш актуален
        }

        // Загружаем данные из Google Sheets
        $range = "'Вакансии'!A:Z";
        try {
            $response = $this->service->spreadsheets_values->get(GOOGLE_SPREADSHEET_ID, $range);
            $values = $response->getValues();
            if (empty($values)) {
                return [];
            }

            // Определяем нужные столбцы
            $columns = [
                'City' => 'A',
                'Date' => 'C',
                'Position' => 'E',
                'Status' => 'F',
                'Headcount' => 'G',
                'District' => 'H',
                'Address' => 'I',
                'HourlyPay' => 'J',
                'OrderPay' => 'K',
                'ShiftPay' => 'L',
                'Slots' => 'M',
                'Promotions' => 'P',
            ];

            $headerRow = array_shift($values);
            $columnIndexes = [];
            foreach ($columns as $key => $col) {
                $colIndex = array_search($col, range('A', 'Z'));
                $columnIndexes[$key] = $colIndex;
            }

            // Собираем вакансии
            $vacancies = [];
            $addressesToGeocode = []; // Адреса, у которых нет координат

            foreach ($values as $row) {
                $vacancy = [];
                foreach ($columnIndexes as $key => $index) {
                    $vacancy[$key] = $row[$index] ?? '';
                }

                // Проверяем, есть ли координаты в кэше
                $coords = $this->cache->getCoordinates($vacancy['Address']);
                if (!$coords) {
                    $addressesToGeocode[] = $vacancy['Address'];
                } else {
                    $vacancy['Coordinates'] = $coords;
                }

                $vacancies[] = $vacancy;
            }

            // Если есть адреса без координат → пакетный запрос
            if (!empty($addressesToGeocode)) {
                $newCoordinates = YandexMapsAPI::getCoordinatesBatch($addressesToGeocode);
                foreach ($newCoordinates as $address => $coords) {
                    $this->cache->saveCoordinates($address, $coords);
                }

                // **Добавляем координаты к вакансиям**
                foreach ($vacancies as &$vacancy) {
                    if (isset($newCoordinates[$vacancy['Address']])) {
                        $vacancy['Coordinates'] = $newCoordinates[$vacancy['Address']];
                    }
                }
            }

            // Сохраняем вакансии в кэш
            $this->cache->updateCache($vacancies);
            return $vacancies;
        } catch (\Exception $e) {
            return [];
        }
    }


}
