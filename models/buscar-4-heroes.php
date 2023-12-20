<?php

require_once 'Conexion.php';

class formulario extends Conexion {

    private $pdo;

    public function __CONSTRUCT() {
        $this->pdo = parent::getConexion();
    }

    public function getAllPublishers() {
        try {
            $consulta = $this->pdo->prepare("SELECT publisher_name FROM superhero.publisher");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return array('error' => $e->getMessage());
        }
    }
}
?>
