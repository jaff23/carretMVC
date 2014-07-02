
<?php

session_start();
require_once 'common.inc.php';
if (isset($_SESSION['login'])){
mostrarCapssaleraPagina("Ingressar un producte");
menu('ingres_producte');
}


if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
    echo '<ul style="padding:0; color:red;">';
    foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
        echo '<li>', $msg, '</li>';
    }
    echo '</ul>';
    unset($_SESSION['ERRMSG_ARR']);

}

?>
<div id="form">
<form name="ingresProducte_view" method="POST"   enctype="multipart/form-data" action="../controllers/ingresProducte_controller.php" onSubmit="return validaProducte(this);">
    <ul>
     
        <li>Nom<br /><input type="text" name="nomProducte" /></li>
        <li>Preu<br /><input type="text" name="preu" /></li>
        <li>Foto, Seleccionar:<br /> <?php  inputImatges();   ?>
        </li>
        <br> <br>
        <li><input type="submit" name="Submit" value="Enviar"></li>
    </ul>
</form>
</div>
<?php
    
    mostrarPeuPagina();
    
    


