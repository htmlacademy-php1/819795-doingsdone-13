<?php

require('data.php');
require('functions.php');
require('helpers.php');
require('init.php');


$_SESSION['userId']=null;
$_SESSION['name']=null;

$footer = include_template('footer.php', [
    'button' => ''
]);

$content = include_template('form-guest.php');

$pageLayout = include_template('layout.php', [
    'guest'=>'class="body-background"',
    'pageTitle' => $pageTitle,
    'content' => $content,
    'footer' => $footer
]);


print ($pageLayout);
