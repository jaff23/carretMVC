<?php
session_start();

require_once 'common.inc.php';
if (!isset($_SESSION['login'])){
mostrarCapssaleraPagina('Iniciar sessió');
menu('logejarUsuari');




if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
    echo '<ul style="padding:0; color:red;">';
    foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
        echo '<li>', $msg, '</li>';
    }
    echo '</ul>';
    unset($_SESSION['ERRMSG_ARR']);
}




//echo'<br>';echo'<br>';

?>


<div id="formlogin">
<form name= "logejarUsuari" action="../controllers/loguejarUsuari_controller.php" method="post"enctype="multipart/form-data">
     Entra el teu login:
        <input name="login" type="text">
        <br>
        Entra el teu password:
        <input type="password" name="password" maxlength="12" size="12">
        <br>
        <input type="submit">
    
</form>
    </div>
<?php
}else{
     header('Location: ../index.php');
}
mostrarPeuPagina();

