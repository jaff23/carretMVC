<?php


include_once(__DIR__.'/../views/common.inc.php');


session_start();
session_destroy();

header('Location: ../index.php');
?>

