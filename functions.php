<?php
function  countProjects($tasks, $project): int
{
    $count = 0;
    foreach ($tasks as $value) {
        if ($value['project_id'] == $project['id']) {
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
