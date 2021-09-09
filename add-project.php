<?php
require('init.php');
require('data.php');
require('functions.php');
require('helpers.php');


checkSession();

$userId = $_SESSION['userId'];
$userName = $_SESSION['name'];

$projects = getProjectsByUserId($link, $userId);

$projectsContent = array_column($projects, 'content');

$errors = null;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty ($_POST['project_name'])) {
        $errors = "Поле надо заполнить";
    } else {
        $errors = validateProjectName($projectsContent, $_POST['project_name']);
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {


    addProject($link, $_POST, $userId);

    header('Location: /index.php');
    exit;
}


$tasksForProjects = getTasksByUserId($link, $userId);


$header = include_template('header.php', [
    'userName' => $userName
]);

$footer = include_template('footer.php');

$pageProject = include_template('project.php', [
    'projects' => $projects,
    'tasks' => $tasksForProjects

]);


$pageformProject = include_template('form-project.php', [
    'errors' => $errors,
    '_POST' => $_POST
]);

$pageContent = include_template('main.php', [
    'project' => $pageProject,
    'content' => $pageformProject,
    'header' => $header,
]);


$pageLayout = include_template('layout.php', [
    'guest' => '',
    'pageTitle' => $pageTitle,
    'content' => $pageContent,
    'footer' => $footer
]);


print ($pageLayout);
