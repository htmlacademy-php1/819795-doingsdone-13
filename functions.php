<?php
function  countCategory($tasks, $category): int
{
    $count = 0;
    foreach ($tasks as $value) {
        if ($value['category'] == $category) {
            $count++;
        }
    }
    return $count;
}

function countHours ( $data)  {
    $cur_date = strtotime("now");
    $task_date = strtotime($data);
    $diff = $cur_date - $task_date;
    $hours = $diff/(60*60);

  return floor($hours);
}
