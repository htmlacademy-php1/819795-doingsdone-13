<?php
require ('data.php');
require ('functions.php');
require('helpers.php');
require('init.php');

$errors = [];

$allEmails = getAllEmails($link);

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $required = ['name', 'password', 'email'];

    $rules = [
        'name' => function ($value) {
            return validateLength($value, 1, 100);
        },
        'password' => function ($value)  {
            return password_hash($value, PASSWORD_DEFAULT);
        },
        'email' => function ($value) use ($allEmails) {
        return validateEmail($value, $allEmails);
    }
    ];

    $user = filter_input_array(INPUT_POST,
        ['name'=> FILTER_DEFAULT, 'password'=>FILTER_DEFAULT, 'email'=>FILTER_VALIDATE_EMAIL],
        true);

    foreach ($user as $key=>$value) {
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





$footer = include_template('footer.php');

$content = include_template('form-user.php');

$pageLayout = include_template('layout.php', [
    'pageTitle' => $pageTitle,
    'content' => $content,
    'footer' => $footer
]);

print_r($errors);
print ($pageLayout);
