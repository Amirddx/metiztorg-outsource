<?php
namespace Services;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../includes/config.php';

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsAPI {
    private $service;
    private $cacheFile = __DIR__ . '/../cache/cache.json'; // путь к кэшу

    public function __construct() {
        $client = new Client();
        $client->setScopes(Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(GOOGLE_KEY_PATH);
        $this->service = new Sheets($client);
    }

    public function getVacancies() {
        $cachedData = $this->readCache();
        if ($cachedData && !$this->isCacheExpired($cachedData['updated_at'])) {
            return $cachedData['vacancies']; // если кэш актуален, возвращаем из кэша
        }

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
                $vacancies[] = $vacancy;
            }

            $this->updateCache($vacancies);
            return $vacancies;
        } catch (\Exception $e) {
            return [];
        }
    }

    private function readCache() {
        if (!file_exists($this->cacheFile)) {
            return null;
        }
        $data = json_decode(file_get_contents($this->cacheFile), true);
        return $data ?: null;
    }

    private function updateCache($vacancies) {
        $cacheData = [
            'updated_at' => date('Y-m-d H:i:s'),
            'vacancies' => $vacancies
        ];
        file_put_contents($this->cacheFile, json_encode($cacheData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    private function isCacheExpired($timestamp) {
        $cacheTime = strtotime($timestamp);
        return (time() - $cacheTime) > 3600; // кэш актуален 1 час
    }
}
