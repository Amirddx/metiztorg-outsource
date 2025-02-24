<?php

namespace Services;

class YandexMapsAPI
{
    private static $apiKey = YANDEX_API_KEY;
    private static $geocodeUrl = "https://geocode-maps.yandex.ru/1.x/?format=json";

    public static function getCoordinates($city, $address)
    {
        $fullAddress = $city . ', ' . $address;

        // Подключаем кэш
        $cache = new Cache();

        // Проверяем, есть ли координаты в кэше
        $cachedCoords = $cache->getCoordinates($fullAddress);
        if ($cachedCoords) {
            return $cachedCoords; // Если координаты уже есть, просто возвращаем их
        }


        // Если координат нет, делаем запрос к Яндекс Геокодеру
        $coords = self::fetchCoordinates($fullAddress);

        // Сохраняем координаты в кэш
        if ($coords) {
            $cache->saveCoordinates($fullAddress, $coords);
        }

        return $coords;
    }

    private static function fetchCoordinates($address)
    {
        $url = self::$geocodeUrl . "&apikey=" . self::$apiKey . "&geocode=" . urlencode($address);

        // Отправляем запрос к API
        $response = file_get_contents($url);
        if (!$response) {
            return null; // Если нет ответа, возвращаем null
        }

        $data = json_decode($response, true);
        if (!isset($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'])) {
            return null; // Если не нашли координаты, возвращаем null
        }

        // Извлекаем координаты и форматируем их
        $pos = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
        $coords = explode(" ", $pos);
        return [$coords[1], $coords[0]]; // Переворачиваем порядок (Широта, Долгота)
    }
}
