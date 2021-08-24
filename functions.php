<?php
function  countProjects($tasks, $project): int
{
    $count = 0;
    foreach ($tasks as $value) {
        if ($value['project_id'] == $project['id']&&$value['complete']!=1) {
            $count++;
        }
    }
    return $count;
}



function checkTime ($date) {
    if ($date==null) {
        return 0;
    }

    $date1 = new DateTime('now');
    $date2 = new DateTime($date);
    $difference = $date2->diff($date1);
    return $difference->days<=1||$difference->invert==0;
}

function getProjectsByUserId ($link,  int $userId) : array {
    $sql = "SELECT * FROM projects WHERE user_id = " . $userId . " ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error());
    }
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

function getTasksByUserId ($link, int $userId) : array {
    $sql = "SELECT * FROM tasks WHERE user_id = " . $userId . " ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error());
    }
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}


function getTasksByProjectId ($link, int $user_id,  $project ) : array  {
 if ($project) {
     $id = intval($project);
     $sql = "SELECT * FROM tasks WHERE user_id = ". $user_id . " AND  project_id =" . $id . " ";
 }else{
     $sql = "SELECT * FROM tasks WHERE user_id = ". $user_id . " ";
 }
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

