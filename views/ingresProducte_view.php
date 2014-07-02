
<?php
include_once "common.inc.php";


 menu('ingres_producte');
mostrarCapssaleraPagina("Ingressar un producte");
?>
<form name="ingresProducte_view" method="POST"   enctype="multipart/form-data" action="../controllers/ingresProducte_controller.php">
    <ul>
     
        <li>Nom<br /><input type="text" name="nomProducte" /></li>
        <li>Preu<br /><input type="text" name="preu" /></li>
        <li>Foto, Seleccionar:<br /> <?php  inputImatges();   ?>
        </li>
        <br> <br>
        <li><input type="submit" name="Submit" value="Enviar"></li>
    </ul>
</form>


