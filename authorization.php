<?php
require ('data.php');
require ('functions.php');
require('helpers.php');
require('init.php');

$errors = [];

$allEmails = getAllEmails($link);

$footer = include_template('footer.php', [
    'button'=>''
]);

$content = include_template('form-authorization.php');

$pageLayout = include_template('layout.php', [
    'pageTitle' => $pageTitle,
    'content' => $content,
    'footer' => $footer
]);


print ($pageLayout);
