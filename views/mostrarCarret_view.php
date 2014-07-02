<?php
require_once(__DIR__.'/../index.php');
require_once 'common.inc.php';
require_once(__DIR__.'/../models/Producte_model.php');
require_once(__DIR__.'/../models/ventes_model.php');
require_once(__DIR__.'/../models/usuari_model.php');

if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
  
}

function mostrarCarr($id_producte, $unitats, $start) {
   // $productes = Producte::getProductes();
    
    list($productes, $totalFiles) = Producte_model::getProductesOrdre($start, FILES_PAG);
    ?>
    <dl>
        <?php
        $preuTotal = 0;
        // $cont=0;
        foreach ($_SESSION["carr"] as $producte) {
            (float)$preuTotal +=($producte->getValue('preu')) * ($producte->getValue('unitats'));
            ?>
            <dt><?php echo $producte->getValueEncoded('nomProducte') ?></dt>
            <dd>Unitats: <?php echo $producte->getValueEncoded('unitats') ?></dd>
            <dd>id_producte: <?php echo $producte->getValueEncoded('id_producte') ?></dd>
            <dd><?php echo number_format(($producte->getValueEncoded('preu')) * ($producte->getValueEncoded('unitats')), 2, ',', '.') ?>&#8364;
                <a href="<?php echo str_replace("/carretMVC/views", "", $_SERVER['PHP_SELF']); ?>?action=eliminarProd&amp;id_producte=<?php echo $producte->getValue('id_producte') ?>">
                    Eliminar</a></dd>
            <?php
        }
        ?>

        <dt> Compra total:</dt>
        <dd><strong><?php echo number_format($preuTotal, 2, ',', '.') ?>&#8364;</strong></dd>
    </dl>
    <?php
    if (isset($_POST['comprar'])) {
      
        foreach (($_SESSION["carr"]) as $producte) {
            $fecha_actual = localtime(time(), 1);
            $any_actual = $fecha_actual["tm_year"] + 1900;
            $mes_actual = $fecha_actual["tm_mon"] + 1;
            $dia_actual = $fecha_actual["tm_mday"];
            $data = $any_actual . '-' . $mes_actual . '-' . $dia_actual;

            if (isset($_SESSION['login'])) {
                $login = $_SESSION['login'];
               // $id = array();
                $id = usuari_model::getId($login);
                $id_usuari = $id["id_usuari"];
            }
            $preu_venta = $producte->getValue('preu') * $producte->getValue('unitats');
            

            ventes_model::setVenta($producte->getValue('id_producte'), $id_usuari, $producte->getValue('unitats'), $data, $preu_venta);
        }
    }

    if (isset($_SESSION['login'])) {
        ?>
        <form  name="comprar" method="post"  action=" <?php echo str_replace("/carretMVC/views", "", $_SERVER['PHP_SELF']); ?>" >
            <input type="submit" name="comprar" value="comprar" />
        </form>      
    <?php } ?>
<?php if((Producte_model::numProductes())>0){ ?>

    <h1>LLISTA DE PRODUCTES</h1>
    <dl>
        <!-- $ start inicialment val 0  per tant li sumem 1 per visulitzar com a numero inicial l'1
        visualitzem el minim de les files totals i després el màxim del número total de files.
        És a dir Treballadors del Club 1 - 4 de 4 -->
        <h2> <?php echo $start + 1 ?> - <?php echo min($start + FILES_PAG, $totalFiles) ?> de <?php echo $totalFiles ?> </h2> 

        <?php
        //23/01/14 He borrat la seguent fila
        // $producte = Producte::getProducte($id_producte);
        
       
        foreach ($productes as $producte) {
            ?>
        <div id="contenedorform">
            <form  name="carret" method="post"  action=" <?php echo str_replace("/carretMVC/views", "", $_SERVER['PHP_SELF']); ?>" >
                <dt><?php echo $producte->getValue('nomProducte') ?></dt>
               
                <dd> 
                    <?php
                    // id=foto és el que s'utilitza als estils css #foto
                    echo '<img id="foto" src="' .str_replace("./..","./",$producte->getValue('foto'))  . '"/>';
                    echo"  ";
                    ?>
                    
                </dd>
                 
                <dd><?php echo number_format($producte->getValue('preu'), 2, ',', '.') ?> &#8364;</dd>
                <dd>
                    <label for="unitats">Unitats</label>
                    <input type="text" name="unitats" size="2"   />
                    
                    <input type="submit" name="afegir" value="Afegir" />
                    <input type="hidden" name="id_producte" value="<?php echo $producte->getValue('id_producte'); ?>" />
                    
                </dd>
            </form>
       
        <?php
             if (isset($_SESSION['login'])) {

                   echo '<a href="controllers/modificarProducte_controller.php?id_producte='.$producte->getValue('id_producte').'">Modificar producte </a><br /> <br>';
             }  
                   ?>
             </div>
            <?php
             
        }
        ?>
       
    </dl>
    <div style="width: 30em; margin-top: 20px; text-align: center;" >
    <?php if ($start > 0) { ?>
        <!-- Es pagina cap enrera  $start conté l'última fila paginada i mostrada al navegador. També es pot triar l'ordre
        mitjançant el qual volem mostrar els usuaris a la taula -->
        <a href="index.php?start=<?php echo max($start - FILES_PAG, 0) ?> ">anterior</a>

    <?php } ?>
    &nbsp;
    <!--  Si no s'està al final a l'última fila de la taula paginem les FILES_PAG següents -->
    <?php if ($start + FILES_PAG < $totalFiles) { ?>
        <a href="index.php?start=<?php echo min($start + FILES_PAG, $totalFiles) ?> ">posterior</a>

    <?php } ?>
    </div>
    <?php
        }
        else{
            echo '<h2>Registrat, logejat i ingressa productes</h2>';
        }
    
    mostrarPeuPagina();
}
