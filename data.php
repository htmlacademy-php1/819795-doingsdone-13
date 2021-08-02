<?php
$cur_date = date_create("now"); // создаёт экземпляр даты на основе формата
$next_mon = date_create("first day of next month");

// получает экземпляр временного промежутка на основе разницы между двумя датами
$diff = date_diff($cur_date, $next_mon);

// Приводит временной интервал к нужному формату
$days_count = date_interval_format($diff, "%d");

$pageTitle = "Дела в порядке";
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$categories = [ "Входящие", "Учеба", "Работа", "Домашние дела", "Авто" ];
$tasks = [
    [
        'task' => 'Собеседование в IT компании',
        'date' => '02.08.2021',
        'category' => $categories[2],
        'made' => false
    ],
    [
        'task' => 'Выполнить тестовое задание',
        'date' => '25.12.2019',
        'category' => $categories[2],
        'made' => false
    ],
    [
        'task' => 'Сделать задание первого раздела',
        'date' => '21.12.2019',
        'category' => $categories[1],
        'made' => true
    ],
    [
        'task' => 'Встреча с другом',
        'date' => '22.12.2019',
        'category' => $categories[0],
        'made' => false
    ],
    [
        'task' => 'Купить корм для кота',
        'date' => null,
        'category' => $categories[3],
        'made' => false
    ],
    [
        'task' => 'Заказать пиццу',
        'date' => null,
        'category' => $categories[3],
        'made' => false
    ],
];
