<?php
// показывать или нет выполненные задачи
require_once ('data.php');
require_once ('functions.php');
require_once ('helpers.php');
require_once ('init.php');


$sqlProjects = "SELECT * FROM projects WHERE user_id = '1'";
$result = mysqli_query($link, $sqlProjects);
$projects1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sqlTasks = "SELECT * FROM tasks WHERE user_id = '1'";
$result = mysqli_query($link, $sqlTasks);
$tasks1 = mysqli_fetch_all($result, MYSQLI_ASSOC);


$pageProject = include_template('project.php', [
               'projects'=> $projects1,
               'tasks'=>$tasks1,
]);

$pageTask = include_template('_task.php', [
                'tasks'=>$tasks1,
                'show_complete_tasks'=>$show_complete_tasks,


]);

$pageContent = include_template('main.php',[
               'project'=>  $pageProject,
               'tasks'=>$pageTask,
               'show_complete_tasks'=>$show_complete_tasks
           ]);
$pageLayout = include_template('layout.php', [
    'pageTitle' => $pageTitle,
    'content' => $pageContent,
]);


print ($pageLayout);





