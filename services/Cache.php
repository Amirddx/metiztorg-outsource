<?php

namespace Services;

class Cache
{
    private $cacheFile;
    private $logFile;

    public function __construct($file = __DIR__ . '/../cache/cache.json')
    {
        $this->cacheFile = $file;
        $this->logFile = __DIR__ . '/../cache/log.txt';
        if (!file_exists($this->cacheFile)) {
            $this->initializeCache(); // Создаём файл, если его нет
        }
    }

    // Читаем данные из кэша
    public function getCache()
    {
        if (!file_exists($this->cacheFile)) {
            return ['updated_at' => '', 'vacancies' => [], 'coordinates' => []];
        }

        $data = json_decode(file_get_contents($this->cacheFile), true) ?: ['updated_at' => '', 'vacancies' => [], 'coordinates' => []];

        $this->writeLog(__METHOD__, "Кэш загружен: данные получены из cache.json.");
        return $data;
    }

    // Обновляем кэш (вакансии + координаты)
    public function updateCache($vacancies, $coordinates = [])
    {
        $data = $this->getCache();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['vacancies'] = $vacancies;

        if (!empty($coordinates)) {
            $data['coordinates'] = array_merge($data['coordinates'], $coordinates); // Добавляем новые координаты
        }

        file_put_contents($this->cacheFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $this->writeLog(__METHOD__, "Кэш обновлен: сохранены свежие данные.");
        $this->writeSeparator();
    }

    // Проверяем, устарел ли кэш
    public function isCacheExpired($hours = 1)
    {
        $data = $this->getCache();
        if (empty($data['updated_at'])) {
            return true;
        }
        $cacheTime = strtotime($data['updated_at']);
        $expired = (time() - $cacheTime) > ($hours * 7200);
        $this->writeLog(__METHOD__, "Проверка срока действия кэша: " . ($expired ? "Устарел" : "Актуален"));
        $this->writeSeparator();
        return $expired;

    }

    // Получаем координаты из кэша
    public function getCoordinates($address)
    {
        $data = $this->getCache();
        $coords = $data['coordinates'][$address] ?? null;
        $this->writeLog(__METHOD__, "Получены координаты для адреса: $address -> " . ($coords ? json_encode($coords) : "Нет в кэше"));
        return $coords;
    }

    // Добавляем координаты в кэш
    public function saveCoordinates($address, $coords) {
        $data = $this->getCache();

        // Проверяем, есть ли уже координаты в кэше
        if (!isset($data['coordinates'][$address])) {
            $data['coordinates'][$address] = $coords;
            file_put_contents($this->cacheFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            // Теперь передаем два параметра: сам лог и контекст (метод и класс)
            $this->writeLog("Добавлены координаты для адреса: $address -> " . json_encode($coords), 'Services\Cache::saveCoordinates');
        }
    }


    // Инициализируем пустой кэш
    private function initializeCache()
    {
        $emptyData = ['updated_at' => '', 'vacancies' => [], 'coordinates' => []];
        file_put_contents($this->cacheFile, json_encode($emptyData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $this->writeSeparator();
        $this->writeLog(__METHOD__, "Создан новый файл кэша.");
    }



    // Логирование запросов с указанием метода
    private function writeLog($message, $context = '') {
        $logFile = __DIR__ . '/../cache/log.txt'; // Путь к файлу логов
        $timestamp = date('Y-m-d H:i:s'); // Текущее время

        // Если передан контекст (например, метод или класс), добавляем его в лог
        $logEntry = "[$timestamp] [$context] $message" . PHP_EOL;

        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }


    // Разделитель в логах для визуального разделения блоков запросов
    private function writeSeparator()
    {
        $timestamp = date('Y-m-d H:i:s'); // Текущее время
        $separatorLength = 80; // Общая длина сепаратора
        $timestampLength = strlen($timestamp); // Длина строки с временем

        // Рассчитываем количество символов "=" с каждой стороны
        $equalsCount = (int)(($separatorLength - $timestampLength) / 2);

        // Создаем строку с символами "=" и временем по центру
        $separator = str_repeat("=", $equalsCount) . $timestamp . str_repeat("=", $equalsCount) . PHP_EOL;

        // Записываем в файл
        file_put_contents($this->logFile, $separator, FILE_APPEND | LOCK_EX);
    }
}
