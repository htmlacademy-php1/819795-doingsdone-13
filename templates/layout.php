<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/flatpickr.min.css">
</head>

<body <?= $guest ?>>
<h1 class="visually-hidden">Дела в порядке</h1>

<div class="page-wrapper">

<?= $content ?>

</div>

<?= $footer ?>

<script src="flatpickr.js"></script>
<script src="script.js"></script>
</body>
</html>
