<?php

session_start();

include_once(__DIR__ . '/../views/common.inc.php');
include_once(__DIR__ . '/../models/Producte_model.php');
include_once(__DIR__ . '/../models/usuari_model.php');

$errflag = false;
$errmsg_arr = array();


if ($_POST['nomProducte'] == '') {
    $errmsg_arr[] = 'Tens que escriure el nom del producte';
    $errflag = true;
}
if ($_POST['preu'] == '') {
    $errmsg_arr[] = 'Tens que escriure el preu';
    $errflag = true;
}
//if (count($_FILES) == 0 and !isset($_FILES['foto']) and !isset($_FILES['foto']['name'])) {
if ($_FILES['foto']['name'] == "" || $_FILES['foto']['size'] == 0) {
    $errmsg_arr[] = 'Tens que ficar una foto';
    $errflag = true;
}
//}

if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: ../views/ingresProducte_view.php");
    exit();
}


if (count($_POST) > 0) {

    // In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.


    if ($_FILES['foto']['name'] != "" || $_FILES['foto']['size'] != 0) {
        $uploaddir = './../fotos/'; //<----This is all I changed
        $uploadfile = $uploaddir . basename($_FILES['foto']['name']);


        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile))
            $foto = $uploadfile;
        else
            echo "Possible file upload attack!\n";



        $dades = array(
            'nomProducte' => $_POST['nomProducte'],
            'preu' => $_POST['preu'],
            'foto' => $foto
        );

        Producte_model::setProducte($dades);
    }


    //require_once(__DIR__."/../views/ingresProducte_view.php");
    header("location: ../views/ingresProducte_view.php");
}else {
    // header('Location: ../index.php');
    header("location: ../views/ingresProducte_view.php");
}

mostrarPeuPagina();


