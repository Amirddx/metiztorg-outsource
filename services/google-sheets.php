<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../includes/config.php';

use Google\Client;
use Google\Service\Sheets;

function getGoogleSheetData($range) {
    $client = new Client();
    $client->setApplicationName('Google Sheets API');
    $client->setScopes(Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig(GOOGLE_KEY_PATH);

    $service = new Sheets($client);

    try {
        $response = $service->spreadsheets_values->get(GOOGLE_SPREADSHEET_ID, $range);
        return $response->getValues();
    } catch (Exception $e) {
        return 'Ошибка: ' . $e->getMessage();
    }
}
?>
