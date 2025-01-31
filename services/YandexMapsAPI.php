<?php

namespace Services;

class YandexMapsAPI {
    public static function getVacanciesForMap($vacancies) {
        $points = [];

        foreach ($vacancies as $vacancy) {
            $points[] = [
                'city'    => $vacancy['City'],
                'address' => $vacancy['Address']
            ];
        }

        return json_encode($points);
    }
}
