<?php

require_once(__DIR__.'/../DataObject.class.php');

class Producte_model extends DataObject {

    protected $dades = array(
        'id_producte' => '',
        'nomProducte' => '',
        'preu' => '',
        'unitats' =>'',
        'foto' => ''
    );

    public static function getProductes() {
        $conn = parent::connect();
        // Retorna un nombre de registres limitat per la clausula limit
        //Podria ficar select * from taula_producte
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TAULA_PRODUCTE ;
        try {
            $st = $conn->prepare($sql);
           
            $st->execute();
            $Productes = array();

            $results = $st->fetchAll();
            //print_r($results);
            foreach ($results as $fila) {
                $Productes[] = new Producte_model($fila);
            }
            parent::desconnect($conn);
            return $Productes;
        } catch (PDOException $e) {
            echo"Error dins Producte (getProductes)";
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
    }
    
    public static function getProductesOrdre($startFila, $numFiles){
        $conn = parent::connect();
        // Retorna un nombre de registres limitat per la clausula limit
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TAULA_PRODUCTE . "  LIMIT :startFila, :numFiles";
        try{
             //Inicialitza l'objecte PDO amb l'string format anteriorment en la clausula select 
            $st = $conn->prepare($sql);
            //Substitueix la paraula clau :startFila pel valor de $startFila comprovant que sigui un enter
            $st->bindValue(":startFila", $startFila, PDO::PARAM_INT);
            $st->bindValue(":numFiles", $numFiles, PDO::PARAM_INT);
            $st->execute();
            $productes = array();
            $results = $st->fetchAll();
            
             // A l'array $productes a cada iteració li assignem un objecte que li passem l'array
             //$fila. $fila és un array associatiu que li passem al constructor de la classe MProducte, el qual
             // és heredat de la classe DataObject.Cada $fila representa cada un dels elemnts de l'array $results
            
            foreach ($results as $fila) {
                $productes[] = new Producte_model($fila);
            }
            $st = $conn->query("SELECT found_rows() AS totalFiles");
            $fila = $st->fetch();
            parent::desconnect($conn);
            return array($productes, $fila["totalFiles"]);
            
            
        } catch (Exception $ex) {
            echo"Error dins Producte (getProductesOrdre)";
            parent::desconnect($conn);
            die("Consulta Fallida: " . $ex->getMessage());

        }   
        
    }

    public static function getProducte($id_producte) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TAULA_PRODUCTE . "   WHERE id_producte = :id_producte ";
        try {
            $st = $conn->prepare($sql);
            $st->bindValue(":id_producte", $id_producte, PDO::PARAM_INT);
            $st->execute();
            $fila = $st->fetch();
            parent::desconnect($conn);
            if ($fila)
                return new Producte_model($fila);
        } catch (PDOException $e) {
            echo"Error dins Producte (getProducte)";
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
    }

    public static function setProducte($dades) {
        $conn = parent::connect();
        $sql = "INSERT INTO " . TAULA_PRODUCTE . " ( nomProducte, preu, foto) VALUES 
            (:nomProducte,:preu,:foto)";

        try {
         
            $st = $conn->prepare($sql);
            $st->bindParam(':nomProducte', $dades['nomProducte'], PDO::PARAM_STR);
            $st->bindParam(':preu', $dades['preu']);
            $st->bindParam(':foto', $dades['foto'], PDO::PARAM_STR);
            
            $st->execute();
            parent::desconnect($conn);
        } catch (PDOException $e) {
            echo 'catch';
            echo 'Error dins setProducte.php';
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
    }
    
    public static function updateProducte($dades){
        $conn = parent::connect();
         
        $sql = "UPDATE  " . TAULA_PRODUCTE . "  SET nomProducte = ?, preu = ?, foto = ?  WHERE id_producte = ?";
        try{
        // print_r($dades);
        $st = $conn->prepare($sql);
        
        $st->bindParam(1, $dades['nomProducte'] , PDO::PARAM_STR);
        $st->bindParam(2, $dades['preu']);
        $st->bindParam(3, $dades['foto'], PDO::PARAM_STR);
        $st->bindParam(4, $dades['id_producte'], PDO::PARAM_INT);
         
        $st->execute();            
        
        parent::desconnect($conn);
        } catch (PDOException $e) {
            echo 'catch';
            echo 'Error dins updateProducte.php';
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
        
    }
    
    public static function numProductes(){
         $conn = parent::connect();
          $sql = "SELECT count(*) FROM " . TAULA_PRODUCTE ;
         try{
             $st = $conn->prepare($sql);
             $numProductes=$st->execute();
             parent::desconnect($conn);
             return $numProductes;
             
         } catch (Exception $ex) {
              echo"Error dins Producte_model (numProductes)";
            parent::desconnect($conn);
            die("Consulta Fallida: " . $ex->getMessage());
         }
    
    }

}

?>
