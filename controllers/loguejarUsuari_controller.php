<?php

session_start();

require_once(__DIR__.'/../views/common.inc.php');
require_once(__DIR__.'/../models/usuari_model.php');

$errmsg_arr = array();
$errflag = false;

if ($_POST['login'] == '') {
    $errmsg_arr[] = 'Tens que escriure el teu Login';
    $errflag = true;
}
if ($_POST['password'] == '') {
    $errmsg_arr[] = 'Tens que escriure el teu Password';
    $errflag = true;
}
$password = md5($_POST['password']);

$rows = usuari_model::logejarUsuari($_POST['login'], $password);

if ($rows > 0) {
     $_SESSION['login'] = $_POST['login'];
     
    header("location: ../index.php");
} else {
    $errmsg_arr[] = 'Usuari i  Password incorrectes';
    $errflag = true;
}
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: ../views/logejarUsuari_view.php");
    exit();
}

