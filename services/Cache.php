<?php

namespace Services;

class Cache
{
    private $cacheFile;

    public function __construct($file = __DIR__ . '/../cache/cache.json')
    {
        $this->cacheFile = $file;
        if (!file_exists($this->cacheFile)) {
            $this->initializeCache(); // Создаём файл, если его нет
        }
    }

    // Читаем данные из кэша
    public function getCache()
    {

        $data = json_decode(file_get_contents($this->cacheFile), true);


        return $data ?: ['updated_at' => '', 'vacancies' => [], 'coordinates' => []];

    }

    // Обновляем кэш (вакансии + координаты)
    public function updateCache($vacancies, $coordinates = null)
    {
        $data = $this->getCache();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['vacancies'] = $vacancies;

        if ($coordinates) {
            $data['coordinates'] = array_merge($data['coordinates'], $coordinates); // Добавляем новые координаты
        }

        file_put_contents($this->cacheFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    // Проверяем, устарел ли кэш
    public function isCacheExpired($hours = 1)
    {
        $data = $this->getCache();
        $cacheTime = strtotime($data['updated_at']);
        return (time() - $cacheTime) > ($hours * 3600);
    }

    // Получаем координаты из кэша
    public function getCoordinates($address)
    {
        $data = $this->getCache();
        return $data['coordinates'][$address] ?? null;
    }

    // Добавляем координаты в кэш
    public function saveCoordinates($address, $coords)
    {
        $data = $this->getCache();
        $data['coordinates'][$address] = $coords;
        file_put_contents($this->cacheFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    // Инициализируем пустой кэш
    private function initializeCache()
    {
        $emptyData = ['updated_at' => '', 'vacancies' => [], 'coordinates' => []];
        file_put_contents($this->cacheFile, json_encode($emptyData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}
