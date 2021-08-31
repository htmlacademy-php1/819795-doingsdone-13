<?php
session_start();
$_SESSION['username']=null;
header('Location: /guest.php');
exit;
