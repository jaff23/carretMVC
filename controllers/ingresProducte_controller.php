<?php

include_once(__DIR__.'/../views/common.inc.php');
include_once(__DIR__.'/../models/Producte_model.php');
include_once(__DIR__.'/../models/usuari_model.php');


session_start();

$errflag = false;

if (isset($_SESSION['login'])) {
   
 
if (count($_POST) > 0 ) {

    // In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
    
 if (count($_FILES) > 0 and isset($_FILES['foto']) and isset($_FILES['foto']['name'])) {
     if ($_FILES['foto']['name'] != "") {
$uploaddir = './../fotos/';//<----This is all I changed
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
 }else{
      $errmsg_arr= 'Tens que introduir una foto';
      $errflag = true;
    
 }
}
if($errflag){
    echo '<ul style="padding:0; color:red;">';
    
        echo '<li>', $errmsg_arr , '</li>';
    
    
    echo '</ul>';
}



require_once(__DIR__."/../views/ingresProducte_view.php");
 
 }
 else{
     header('Location: ../index.php');
     
 }
 
 mostrarPeuPagina();


