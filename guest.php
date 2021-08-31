<?php
// показывать или нет выполненные задачи
require('data.php');
require('functions.php');
require('helpers.php');
require('init.php');







$footer = include_template('footer.php', [
    'button'=>''
]);


$pageLayout = include_template('form-guest.php', [
    'pageTitle' => $pageTitle,
    'footer' => $footer
]);



print ($pageLayout);






