<?php


require('functions.php');
require('helpers.php');
require('init.php');
require('data.php');




$footer = include_template('footer.php');

$content = include_template('form-guest.php');

$pageLayout = include_template('layout.php', [
    'guest'=>'class="body-background"',
    'pageTitle' => $pageTitle,
    'content' => $content,
    'footer' => $footer
]);


print ($pageLayout);
