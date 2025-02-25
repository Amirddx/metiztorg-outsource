<?php

namespace Services;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../includes/config.php';

class YandexMapsAPI {
    private static $apiKey = YANDEX_API_KEY;

    // Метод для пакетного запроса координат
    public static function getCoordinatesBatch($addresses) {
        $coordinates = [];
        foreach ($addresses as $address) {
            $coords = self::getSingleCoordinate($address);
            if ($coords) {
                $coordinates[$address] = $coords;
            }
        }
        return $coordinates;
    }

    // Запрос к геокодеру Яндекса (один адрес)
    private static function getSingleCoordinate($address) {
        $url = "https://geocode-maps.yandex.ru/1.x/?apikey=" . self::$apiKey . "&geocode=" . urlencode($address) . "&format=json";

        $response = file_get_contents($url);
        if (!$response) {
            return null;
        }

        $data = json_decode($response, true);
        if (isset($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'])) {
            $pos = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
            return explode(" ", $pos); // Координаты в формате [долгота, широта]
        }
        return null;
    }
}
