<?php

namespace Services;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/Cache.php';
require_once __DIR__ . '/YandexMapsAPI.php';

use Google\Client;
use Google\Service\Sheets;
use Services\YandexMapsAPI;

class GoogleSheetsAPI
{
    private $service;
    private $cache;

    public function __construct()
    {
        $client = new Client();
        $client->setScopes(Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(GOOGLE_KEY_PATH);
        $this->service = new Sheets($client);

        $this->cache = new Cache(); // Подключаем кэш
    }

    public function getVacancies()
    {
        // Читаем кэш
        $cachedData = $this->cache->getCache();

        // Если вакансии в кэше актуальны, возвращаем их
        if (!empty($cachedData['vacancies']) && !$this->cache->isCacheExpired()) {
            return $cachedData['vacancies'];
        }


        // Если кэш устарел или пуст, запрашиваем данные из Google Sheets
        $range = "'Вакансии'!A:Z";
        try {
            $response = $this->service->spreadsheets_values->get(GOOGLE_SPREADSHEET_ID, $range);
            $values = $response->getValues();

            if (empty($values)) {
                return [];
            }

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

            $vacancies = [];
            foreach ($values as $row) {
                $vacancy = [];
                foreach ($columnIndexes as $key => $index) {
                    $vacancy[$key] = $row[$index] ?? '';
                }

                // Получаем координаты, если они отсутствуют в кэше
                $cachedCoords = $this->cache->getCoordinates($vacancy['City'] . ', ' . $vacancy['Address']);
                if ($cachedCoords) {
                    $vacancy['Coordinates'] = $cachedCoords;
                } else {
                    $coords = YandexMapsAPI::getCoordinates($vacancy['City'], $vacancy['Address']);
                    if ($coords) {
                        $vacancy['Coordinates'] = $coords;
                        $this->cache->saveCoordinates($vacancy['City'] . ', ' . $vacancy['Address'], $coords);
                    }
                }

                $vacancies[] = $vacancy;
            }

            // Обновляем кэш
            $this->cache->updateCache($vacancies);
            return $vacancies;
        } catch (\Exception $e) {
            return [];
        }
    }
}
