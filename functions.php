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
