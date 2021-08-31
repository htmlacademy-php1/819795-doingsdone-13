<?php

require('data.php');
require('functions.php');
require('helpers.php');
require('init.php');

$errors = [];

$allEmails = getAllEmails($link);



if ($_SERVER['REQUEST_METHOD']=='POST'){


    $required = ['email'];

    $rules = [
        'email' => function ($value) use ($allEmails) {
            return checkEmail($value, $allEmails);
        }
    ];

    $user = filter_input_array(INPUT_POST,
        [ 'email'=>FILTER_DEFAULT, 'password'=>FILTER_DEFAULT],
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
    if (in_array(strtolower($user['email']), $allEmails)){
        $password = getPasswordByEmail($user['email'], $link);
        password_verify($user['password'],$password)? $errors['password'] = null : $errors['password'] =  "Указан неверный пароль" ;
    }
    $errors = array_filter($errors);

}

$footer = include_template('footer.php', [
    'button' => ''
]);

$content = include_template('form-auth.php',[
    'errors' => $errors
]);

$pageLayout = include_template('layout.php', [
    'guest'=>'',
    'pageTitle' => $pageTitle,
    'content' => $content,
    'footer' => $footer
]);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {

    session_start();
    $_SESSION['username'] = getUserIdByEmail($link, $user['email']);

    header('Location: /index.php');

}
print ($pageLayout);
