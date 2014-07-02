<?php

/**
 * Description of DataObject
 *
 * @author javier
 */
require_once(__DIR__.'/config.php');

abstract class DataObject {

    protected $dades = array();

    // Constructor de la classe DataObject
    public function __construct($dades) {
        foreach ($dades as $key => $value) {
            // Comprova que el valor de la clau ($key) existeix en l'objecte dades i si existeix li assigna un valor
            if (array_key_exists($key, $this->dades))
                $this->dades[$key] = $value;
        }
    }

    // Recull el nom del camp ($field). El busca en la taula dades i si existeix retorna el seu contingut.
    public function getValue($field) {
        if (array_key_exists($field, $this->dades))
            return $this->dades[$field];
        else
            die("Camp no trobat getValue");
    }
    
     public function setValue($name, $data) {
        if (array_key_exists($name, $this->dades))
            $this->dades[$name] = $data;
        else
            die("Camp no trobat setValue");
    }
    
    

    // Retorna el valor d'un camp amb els caracters codificats
    public function getValueEncoded($field) {
        return htmlspecialchars($this->getValue($field));
    }

    protected static function connect() {
        try {
            $conn = new PDO(BD_DSN, BD_USUARI, BD_CLAU);
            $conn->setAttribute(PDO::ATTR_PERSISTENT, true);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connexio fallida: " . $e->getMessage());
        }
        return $conn;
    }

    protected static function desconnect($conn) {
        $conn = "";
    }

}

?>
