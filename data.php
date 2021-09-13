<?php
$pageTitle = "Дела в порядке";
if (isset($_GET['show_completed'])) {
    $_SESSION['show_completed'] = intval(filter_input(INPUT_GET, 'show_completed'));
} else {
    if (empty($_SESSION['show_completed'])) {
        $_SESSION['show_completed'] = 0;
    }
}




