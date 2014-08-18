<?php
include_once "common.inc.php";

menu('registre');
mostrarCapssaleraPagina("Registre usuari");
?>
<form name="usuari" method="POST"   enctype="multipart/form-data" action="../controllers/registre_controller.php" onSubmit="return valida(this);">
    <ul>
        <li>Login<br /><input type="text" name="login" /></li>
        <li>Nom<br /><input type="text" name="nom" /></li>
        <li>Password<br /><input type="password" name="password" /></li>
        <li>Foto, Seleccionar:<br /><?php inputImatges(); ?>
        </li>
        <br> <br>
        <li><input type="submit" name="Submit" value="Enviar"></li>
    </ul>
</form>

<?php
mostrarPeuPagina();
?>
