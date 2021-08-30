<?php
require ('data.php');
require ('functions.php');
require('helpers.php');
require('init.php');


$userId = 1;

$project_id = filter_input(INPUT_GET, 'project_id');

$projects = getProjectsByUserId($link, $userId);

$projectsId = array_column($projects, 'id');

$errors = [];





if ($_SERVER['REQUEST_METHOD']=='POST'){
    $required = ['name', 'project'];

    $rules = [
        'name' => function ($value) {
            return validateLength($value, 2, 500);
        },
        'project' => function ($value) use ($projectsId) {
            return validateProject($value, $projectsId);
        },
        'data' => function ($value) {
            return is_date_valid(strval($value));
        }
    ];

    $task = filter_input_array(INPUT_POST,
        ['name'=> FILTER_DEFAULT, 'project'=>FILTER_DEFAULT, 'data'=>FILTER_DEFAULT],
        true);

    foreach ($task as $key=>$value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key]=$rule($value);
        }
        if (in_array($key, $required)&&empty($value)) {
            $errors[$key] = "Поле надо заполнить";
        }
    }

    $errors = array_filter($errors);

}





if ($_SERVER['REQUEST_METHOD']=='POST'&&empty($errors)){
    $taskAdd=$_POST;

    if ($_FILES['file']['tmp_name']) {
        $filename = $_FILES['file']['name'] ;
        $taskAdd['path'] = $filename;
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename);
    } else {
        $taskAdd['path'] = null;
    };

    if (empty($taskAdd['date'])){

        $taskAdd['date']=null;

    };

    addTask($link, $taskAdd, $userId);

    header('Location: /index.php');
    exit;
}

$button = include_template('button-footer.php');

$tasksForProjects = getTasksByUserId($link,  $userId);


$header = include_template('header.php');

$footer = include_template('footer.php', [
    'button'=>$button
]);

$pageProject = include_template('project.php', [
    'projects'=> $projects,
    'tasks'=>$tasksForProjects

]);

$pageFormTask = include_template('form-task.php', [
    'projects'=> $projects,
    'errors' => $errors,
    '_POST' => $_POST
]);

$pageContent = include_template('main.php', [
    'project' => $pageProject,
    'content' => $pageFormTask,
    'header' => $header,
]);




$pageLayout = include_template('layout.php', [
    'pageTitle' => $pageTitle,
    'content' => $pageContent,
    'footer' => $footer
]);


print ($pageLayout);



