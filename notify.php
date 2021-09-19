<?php
require('vendor/autoload.php');
require('init.php');
require('mail_settings.php');
require('functions.php');


$usersArray = checkAlarm($link);


if (isset($usersArray)) {

    foreach ($usersArray as $key => $value) {
        $message = (new Swift_Message(' Уведомление от сервиса «Дела в порядке»'))
            ->setFrom(['keks@phpdemo.ru' => 'keks'])
            ->setTo([$value['email'] => $value['name']])
            ->setBody('Уважаемый, ' . $value['name'] . '. У вас запланирована задача ' . $value['content'] . ' на ' . $value['dt_end']);


        $mailer->send($message);

    }
}


