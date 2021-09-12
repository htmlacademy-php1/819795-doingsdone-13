<?php
require('vendor/autoload.php');

require ('mail_settings.php');





$message = (new Swift_Message('Wonderful Subject'))
    ->setFrom(['keks@phpdemo.ru' => 'keks'])
    ->setTo(['basay1980@gmail.com'=>'Basay'])
    ->setBody('Here is the message itself')
;


$mailer->send($message);
