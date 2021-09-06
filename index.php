<?php
// показывать или нет выполненные задачи
require('data.php');
require('functions.php');
require('helpers.php');
require('init.php');



checkSession();



$userId = $_SESSION['userId'];
$userName = $_SESSION['name'];




$project_id = filter_input(INPUT_GET, 'project_id');

$projects = getProjectsByUserId($link, $userId);

$projectsId = array_column($projects, 'id');



$header = include_template('header.php', [
    'userName'=>$userName
] );

$footer = include_template('footer.php');


$tasksForProjects = getTasksByUserId($link, $userId);

$tasks = getTasksByProjectId($link, $userId, $project_id);


$pageProject = include_template('project.php', [
    'projects' => $projects,
    'tasks' => $tasksForProjects,

]);


$pageTask = include_template('_task.php', [
    'tasks' => $tasks,
    'show_complete_tasks' => $show_complete_tasks,
]);

$pageContent = include_template('main.php', [
    'project' => $pageProject,
    'content' => $pageTask,
    'header' => $header,
]);

$pageLayout = include_template('layout.php', [
    'guest'=>'',
    'pageTitle' => $pageTitle,
    'content' => $pageContent,
    'footer' => $footer
]);



print ($pageLayout);





