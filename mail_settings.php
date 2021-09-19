<?php
require('vendor/autoload.php');

$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
    ->setUsername('da64c9145bcf2d')
    ->setPassword('dc087cb8c52a89')// ->setEncryption('SSL')
;

$mailer = new Swift_Mailer($transport);
