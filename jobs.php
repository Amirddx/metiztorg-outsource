<?php
include __DIR__ . '/includes/navbar.php';
require __DIR__ . '/services/google-sheets.php';

$range = 'Vacancies!A2:I'; // брать только Город (A) и Адрес (I)
$data = getGoogleSheetData($range);


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Открытые Вакансии</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/metiztorg-style.css">
</head>
<body>


<main class="container my-5">
    <h3 class="text-center mb-4">Открытые Вакансии</h3>

    <?php if (!empty($data)): ?>
        <ul class="list-group">
            <?php foreach ($data as $row): ?>
                <li class="list-group-item">
                     <strong><?php echo htmlspecialchars($row[0] ?? '—'); ?></strong>,
                    <?php echo htmlspecialchars($row[8] ?? '—'); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-center text-muted">Вакансий пока нет.</p>
    <?php endif; ?>
</main>

<?php //include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>
