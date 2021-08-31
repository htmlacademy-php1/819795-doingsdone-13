<?php
// показывать или нет выполненные задачи
require('data.php');
require('functions.php');
require('helpers.php');
require('init.php');


session_start();

if (empty($_SESSION['username']))
{
    header('Location: /logout.php');
    exit;
}

$userId = $_SESSION['username'];



$project_id = filter_input(INPUT_GET, 'project_id');

$projects = getProjectsByUserId($link, $userId);

$projectsId = array_column($projects, 'id');

$button = include_template('button-footer.php');

$header = include_template('header.php');

$footer = include_template('footer.php', [
    'button'=>$button
]);


$tasksForProjects = getTasksByUserId($link, 1);

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





