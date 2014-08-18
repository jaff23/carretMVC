<?php

include_once(__DIR__."/../DataObject.class.php");
include_once(__DIR__."/../views/common.inc.php");
include_once(__DIR__."/../models/Producte_model.php");



if (count($_GET) > 0 and isset($_GET['id_producte'])) {
    
    $id_producte = filter_input(INPUT_GET,'id_producte',FILTER_SANITIZE_NUMBER_INT);
    $producte = Producte_model::getProducte($id_producte);
    require_once(__DIR__ . '/../views/updateProducte_view.php');
    
} else if (count($_POST) > 0 and isset($_POST['id_producte']) and isset($_POST['nomProducte']) and isset($_POST['preu'])) {
    
    $id_producte = filter_input(INPUT_GET,'id_producte',FILTER_SANITIZE_NUMBER_INT);
    $nomProducte = $_POST['nomProducte'];
    $preu = (float) $_POST['preu'];
    
    $producte = Producte_model::getProducte($id_producte);

    if (count($_FILES) > 0 and isset($_FILES['foto']) and isset($_FILES['foto']['name'])) {

        if ($_FILES['foto']['name'] != "") {
            $uploaddir = './../fotos/'; //<----This is all I changed
            $uploadfile = $uploaddir . basename($_FILES['foto']['name']);

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
                $foto = $uploadfile;
            }
        }
    }

    $dades = array(
        'id_producte' => $id_producte,
        'nomProducte' => $nomProducte,
        'preu' => $preu,
        'foto' => $foto
    );

    $producte = Producte_model::updateProducte($dades);
    header("Location: ../index.php");
    //header("Location: ../views/mostrarCarret_view.php");
} else {
     header("Location: ../index.php");
}
?>

