<?php
// показывать или нет выполненные задачи
require_once ('data.php');
require_once ('functions.php');
require_once ('helpers.php');
require_once ('init.php');

if (isset($_GET['project_id'])) {
    $project_id = "AND  project_id =" . $_GET['project_id'];
}else {
    $project_id = '';
}


$projects = getAllByUserId($link,'projects', 1);

$tasksForProjects = getAllByUserId($link, 'tasks', 1);

$tasks = getTasksByProjectId($link, 1, $project_id);

$projectsId = getPoleFromBase($link, 'id', 'projects');

$pageProject = include_template('project.php', [
               'projects'=> $projects,
               'tasks'=>$tasksForProjects,
               'projectsId' => $projectsId
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





