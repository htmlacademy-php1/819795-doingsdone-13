<?php
// показывать или нет выполненные задачи
require_once ('data.php');
require_once ('functions.php');
require_once ('helpers.php');
require_once ('init.php');

$project_id = filter_input(INPUT_GET, 'project_id');


$userId = 1;

$projects = getProjectsByUserId($link, $userId);

$tasksForProjects = getTasksByUserId($link,  $userId);

$tasks = getTasksByProjectId($link, $userId, $project_id);


$pageProject = include_template('project.php', [
               'projects'=> $projects,
               'tasks'=>$tasksForProjects,

]);

$pageTask = include_template('_task.php', [
                'tasks'=>$tasks,
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





