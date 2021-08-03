<?php
// показывать или нет выполненные задачи
require_once ('data.php');
require_once ('functions.php');
require_once ('helpers.php');

$pageContent = include_template('main.php',[
               'categories'=>  $categories,
               'tasks'=>$tasks,
               'show_complete_tasks'=>$show_complete_tasks
           ]);
$pageLayout = include_template('layout.php', [
    'pageTitle' => $pageTitle,
    'content' => $pageContent,
]);

print ($pageLayout);




