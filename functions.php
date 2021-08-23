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

function getAllByUserId ($link, $baseName, int $userId) : array {
    $sql = "SELECT * FROM " . $baseName . " WHERE user_id = " . $userId . " ";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

function getPoleFromBase($link, $pole,  $base) : array {
    $sql = "SELECT " . $pole . " FROM " . $base . "";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

function getTasksByProjectId ($link, $user_id, $project_id) : array  {
    $sql = "SELECT * FROM tasks WHERE user_id = ". $user_id . " " . $project_id . " ";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

