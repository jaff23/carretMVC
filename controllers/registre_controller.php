<?php

require_once 'config.php';
require_once (__DIR__ . "/../views/common.inc.php");
require_once (__DIR__ . "/../models/usuari_model.php");


if (count($_POST) > 0) {

    // In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

    $uploaddir = './../fotos/'; //<----This is all I changed
    $uploadfile = $uploaddir . basename($_FILES['foto']['name']);


    if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile))
        $foto = $uploadfile;
    else
        echo "Possible file upload attack!\n";

    $dades = array(
        'login' => $_POST['login'],
        'nom' => $_POST['nom'],
        'password' => md5($_POST['password']),
        'foto' => $foto
    );
    usuari_model::setUsuari($dades);
} else {
    echo 'hola';
}




