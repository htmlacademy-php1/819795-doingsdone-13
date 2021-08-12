<?php
$pageTitle = "Дела в порядке";
$show_complete_tasks = rand(0, 1);
$projects = [ "Входящие", "Учеба", "Работа", "Домашние дела", "Авто" ];
$tasks = [
    [
        'task' => 'Собеседование в IT компании',
        'date' => '03.08.2021',
        'category' => $projects[2],
        'made' => false
    ],
    [
        'task' => 'Выполнить тестовое задание',
        'date' => '25.12.2021',
        'category' => $projects[2],
        'made' => false
    ],
    [
        'task' => 'Сделать задание первого раздела',
        'date' => '02.07.2021',
        'category' => $projects[1],
        'made' => true
    ],
    [
        'task' => 'Встреча с другом',
        'date' => '22.09.2021',
        'category' => $projects[0],
        'made' => false
    ],
    [
        'task' => 'Купить корм для кота',
        'date' => null,
        'category' => $projects[3],
        'made' => false
    ],
    [
        'task' => 'Заказать пиццу',
        'date' => null,
        'category' => $projects[3],
        'made' => false
    ],
];
