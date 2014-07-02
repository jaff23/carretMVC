
<?php
//require_once 'mostrarCarret.php';


//require_once ("../DataObject.class.php");
//require_once("common.inc.php");
require_once('common.inc.php');
require_once(__DIR__.'/../models/Producte_model.php');
//require_once ("../models/Producte_model.php");



menu('productes');
mostrarCapssaleraPagina("Modificar Producte");
?>
<form name="updateProducte_view" method="post" enctype="multipart/form-data"  action="../controllers/modificarProducte_controller.php">
    <label for="nomProducte">Nom del Producte</label>

    <?php
    echo '<input name="nomProducte" type="text" size"30" value="' . $producte->getValue('nomProducte') . '">';
    ?>
    <br><br>

    <label for="preu">Preu del Producte</label>

    <?php
    echo '<input name="preu" type="text" size"30" value="' . $producte->getValue('preu') . '">';
    ?>
    <br><br>
    <label for="foto"> Foto </label>
    <?php
    echo '<img id="foto" src="' . $producte->getValue('foto') . '" /><br />';
    ?>
</div>

<label for="foto">
    Foto,
    Seleccionar:
</label>

<?php
    inputImatges();
?>
<?php
echo '<input type="hidden" name="id_producte"  value="'.$id_producte.'">';
?>
<input type="submit" name="Modificar" value="Modificar">

</form>
<?php
mostrarPeuPagina();
?>



