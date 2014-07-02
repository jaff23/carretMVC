
<?php
/**
 * Description of Producte
 *
 * @author Javier Marin 
 * @since 09/11/2013
 * 
 */
//require_once("views/common.inc.php");
//require_once ("models/Producte_model.php");
require_once(__DIR__."/views/mostrarCarret_view.php");

require_once "DataObject.class.php";
//require_once ("../DataObject.class.php");
//require_once("common.inc.php");
require_once(__DIR__.'/views/common.inc.php');
require_once(__DIR__.'/models/Producte_model.php');
//require_once ("../models/Producte_model.php");



//session_set_cookie_params(0,"/"); 
session_start();


$unitats = isset($_POST['unitats']) ? (int) $_POST['unitats'] : 0;
$id_producte = isset($_POST['id_producte']) ? $_POST['id_producte'] : 0;
$start = isset($_GET["start"]) ? (int) $_GET["start"] : 0;

if (!isset($_SESSION["carr"]))
    $_SESSION["carr"] = array();

//menu('productes');
// if (isset($_SESSION['login'])) {echo($login); }
mostrarCapssaleraPagina("Llista dels Productes de la BD carret");
menu('productes');

function afegirProd($id_producte, $unitats) {

    $productes = Producte_model::getProductes();


    if ($id_producte >= 1) {

        // quan no existeix cap unitat del producte e qüestió
        if (!isset($_SESSION['carr'][$id_producte])) {

            // desem a la variable temporal l'objecte del producte en qüestió
            $temporal = $productes[$id_producte - 1];
                
            // desem les unitats seleccionades al formulari
            $temporal->setValue('unitats', $unitats);
           
            // desem al carret l'objecte resultant
            $_SESSION['carr'][$id_producte] = $temporal;

            // si el producte ja existeix al carret
        } else {
            // desem a una variable temporal l'objecte 
            $temporal = $_SESSION['carr'][$id_producte];

            // actualitzem les unitats del producte existent
            $temporal->setValue('unitats', $temporal->getValue('unitats') + $unitats);

            // No desem $temporal al carret ($_SESSION['carr']) per que en realitat
            // des de la variable $temporal estem accedint a traves d'un punter a aquesta   
        }

        // Tanquem la sessió i guardem les dades de sessió
        session_write_close();

        // Redireccionem a la mateixa pàgina
        header('Location: index.php');
    }
}

function eliminarProd() {
    $productes = Producte_model::getProductes();

    if (isset($_GET["id_producte"]) and $_GET["id_producte"] >= 1 and $_GET["id_producte"] <= 100) {
        $id_producte = (int) $_GET["id_producte"];
        if (isset($_SESSION["carr"][$id_producte]))
            unset($_SESSION["carr"][$id_producte]);
    }
    session_write_close();
    header('Location: index.php');
}



if (isset($_POST['afegir']) && $unitats > 0)
    afegirProd($id_producte, $unitats);
elseif (isset($_GET["action"]) and $_GET["action"] == "eliminarProd")
    eliminarProd();
else
    mostrarCarr($id_producte, $unitats, $start);











