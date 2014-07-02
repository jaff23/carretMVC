<?php



require_once(__DIR__.'/../DataObject.class.php');

class ventes_model extends DataObject {

    protected $dades = array(
        'id_venta' => '',
        'id_producte' => '',
        'id_usuari' =>'',
        'unitats'=>'',
        'data_venta' => '',
        'preu_venta'=> ''
    );
    
    
    public static function getVentes() {
        $conn = parent::connect();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TAULA_VENTES ;
        try {
            $st = $conn->prepare($sql);
           
            $st->execute();
            $ventes = array();

            $results = $st->fetchAll();
            
            foreach ($results as $fila) {
                $ventes[] = new ventes_model($fila);
            }
            parent::desconnect($conn);
            return $ventes;
        } catch (PDOException $e) {
            echo"Error dins venta (getVentes)";
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
    }

    public static function getVenta($id_venta) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TAULA_VENTES . "   WHERE id_venta = :id_venta ";
        try {
            $st = $conn->prepare($sql);
            $st->bindValue(":id_venta", $id_venta, PDO::PARAM_INT);
            $st->execute();
            $fila = $st->fetch();
            parent::desconnect($conn);
            if ($fila)
                return new ventes_model($fila);
        } catch (PDOException $e) {
            echo"Error dins venta (getVenta)";
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
    }

    public static function setVenta($id_producte, $id_usuari, $unitats,$data_venta, $preu_venta) {
      //  $dades=array();
        $conn = parent::connect();
        $sql = "INSERT INTO " . TAULA_VENTES . " ( id_producte, id_usuari, unitats, data_venta, preu_venta) VALUES
            (:id_producte, :id_usuari, :unitats, :data_venta, :preu_venta) " ;

        try {
            $st = $conn->prepare($sql);
            $st->bindValue(':id_producte', $id_producte, PDO::PARAM_INT);
            $st->bindValue(':id_usuari', $id_usuari,PDO::PARAM_INT);
            $st->bindValue(':unitats', $unitats,PDO::PARAM_INT);
            
            $st->execute(array(
                ':id_producte' => $id_producte,
                ':id_usuari' => $id_usuari,
                ':unitats' => $unitats,
                ':data_venta' => $data_venta,
                ':preu_venta' => $preu_venta
            ));
            
            parent::desconnect($conn);
        } catch (PDOException $e) {
            echo 'catch';
            echo 'Error dins setVenta.php';
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
    }
}

