

<?php

require_once (__DIR__.'/../DataObject.class.php');

class usuari_model extends DataObject {

    protected $dades = array(
        'id_usuari' => '',
        'login' => '',
        'nom' => '',
        'password' => '',
        'foto' => ''
    );

    

    public static function getUsuaris() {
        $conn = parent::connect();
        // Retorna un nombre de registres limitat per la clausula limit
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TAULA_USUARI;
        try {
            $st = $conn->prepare($sql);

            $st->execute();
            $usuaris = array();

            $results = $st->fetchAll();
            //print_r($results);

            foreach ($results as $fila) {
                $usuaris[] = new usuari_model($fila);
            }
            parent::desconnect($conn);
            return $usuaris;
        } catch (PDOException $e) {
            echo"Error dins Producte (getUsuaris)";
            parent::desconnect($conn);
            die("Consulta Fallid_usuaria: " . $e->getMessage());
        }
    }

    public static function getUsuari($id_usuari) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TAULA_USUARI . "   WHERE id_usuari = :id_usuari ";
        try {
            $st = $conn->prepare($sql);
            $st->bindValue(":id_usuari", $id_usuari, PDO::PARAM_INT);
            $st->execute();
            $fila = $st->fetch();
            parent::desconnect($conn);
            if ($fila)
                return new usuari_model($fila);
        } catch (PDOException $e) {
            echo"Error dins usuari (getUsuari)";
            parent::desconnect($conn);
            die("Consulta Fallid_usuaria: " . $e->getMessage());
        }
    }
    
    public static function getId($login){
         $conn = parent::connect();
         
         $sql= "SELECT id_usuari FROM " . TAULA_USUARI ."  WHERE login = :login ";
         try{
              $st = $conn->prepare($sql);
              $st->bindValue(":login", $login, PDO::PARAM_INT);
              $st->execute();
              $fila = $st->fetch(PDO::FETCH_ASSOC);
              parent::desconnect($conn);
              if ($fila)
                return $fila;
             
         } catch (PDOException $e) {
             echo"Error dins usuari (getId)";
             parent::desconnect($conn);
             die("Consulta Fallida: " . $e->getMessage());
         }
    }

    public static function setUsuari($dades) {

        $conn = parent::connect();

        $consulta = " SELECT COUNT(*) as total FROM  " . TAULA_USUARI . " WHERE login = ? ";
        $st = $conn->prepare($consulta);
        $st->bindValue(1, $dades['login'], PDO::PARAM_STR);
        $st->execute();
        if ($st->fetchColumn() == 0) {
            $sql = "INSERT INTO " . TAULA_USUARI . " ( login, nom, password, foto) VALUES 
            (:login, :nom, :password, :foto)";

            try {
                $st = $conn->prepare($sql);
                $st->bindParam(':login', $dades['login'], PDO::PARAM_STR);
                $st->bindParam('nom', $dades['nom'],PDO::PARAM_STR);
                $st->bindParam('password', $dades['password'],PDO::PARAM_STR);
                $st->bindParam('foto', $dades['foto'], PDO::PARAM_STR);
                $st->execute();
                parent::desconnect($conn);
                header("Location: ../index.php");
            } catch (PDOException $e) {
                echo 'catch';
                echo 'Error dins setUsuari';
                parent::desconnect($conn);
                die("Consulta Fallida: " . $e->getMessage());
            }
        } else {
            parent::desconnect($conn);
            header('Location: ../views/registre_view.php');
        }
    }

    public static function logejarUsuari($login, $password) {

      //  $errflag = false;
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TAULA_USUARI . "   WHERE login = :login AND password= :password ";
        try {
            $st = $conn->prepare($sql);
            $st->bindValue(":login", $login, PDO::PARAM_STR);
            $st->bindValue(":password", $password, PDO::PARAM_STR);
            $st->execute();
            $rows = $st->fetch(PDO::FETCH_NUM);

            parent::desconnect($conn);
            return $rows;
        } catch (PDOException $e) {
            echo"Error dins usuari (logejarUsuari)";
            parent::desconnect($conn);
            die("Consulta Fallida: " . $e->getMessage());
        }
    }

}
?>
