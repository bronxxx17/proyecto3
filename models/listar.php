<?php
require_once 'Conexion.php';

class ListarSuper {

    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerHero() {
        try {
            $conn = $this->conexion->getConexion();

            $sql = "SELECT * FROM superhero.superhero";
            $result = $conn->query($sql);

            $superhero = array();

            if ($result) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $superhero[] = $row;
                }
            }

            return $superhero;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
