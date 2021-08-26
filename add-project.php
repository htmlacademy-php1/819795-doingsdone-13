<?php
require ('data.php');
require ('functions.php');
require('helpers.php');
require('init.php');


$userId = 1;

$project_id = filter_input(INPUT_GET, 'project_id');

$projects = getProjectsByUserId($link, $userId);

$projectsId = array_column($projects, 'id');

$projectsContent = array_column($projects, 'content');

$errors = null;





if ($_SERVER['REQUEST_METHOD']=='POST'){

    if (empty ($_POST['project_name'])){
        $errors = "Поле надо заполнить";
    } else {
        $errors =  validateProjectName( $projectsContent, $_POST['project_name']);
    }
}





if ($_SERVER['REQUEST_METHOD']=='POST'&&empty($errors)){

    $projectAdd=$_POST;

    $projectAdd['project_name'] = mb_strtoupper($projectAdd['project_name']);

    $sql = "INSERT INTO projects (user_id, content)
            VALUES (1, ?)";

    $stmt = db_get_prepare_stmt($link, $sql, $projectAdd);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
        die('Неверный запрос: ' . mysqli_error());
    }

    header('Location: /index.php');
    exit;
}



$tasksForProjects = getTasksByUserId($link,  $userId);


$header = include_template('header.php');

$footer = include_template('footer.php');

$pageProject = include_template('project.php', [
    'projects'=> $projects,
    'tasks'=>$tasksForProjects

]);


$pageformProject = include_template('form-project.php', [
    'errors' => $errors,
]);

$pageContent = include_template('main.php', [
    'project' => $pageProject,
    'content' => $pageformProject,
    'header' => $header,
]);




$pageLayout = include_template('layout.php', [
    'pageTitle' => $pageTitle,
    'content' => $pageContent,
    'footer' => $footer
]);


print ($pageLayout);
