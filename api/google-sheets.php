<?php
require __DIR__ . '/../vendor/autoload.php'; // подкл Google API

use Google\Client;
use Google\Service\Sheets;

function getGoogleSheetData($spreadsheetId, $range) {
    $client = new Client();
    $client->setApplicationName('Google Sheets API Access');
    $client->setScopes(Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig(__DIR__ . '/../config/google-key.json');

    $service = new Sheets($client);

    try {
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        return $response->getValues();
    } catch (Exception $e) {
        return 'Ошибка: ' . $e->getMessage();
    }
}
?>
