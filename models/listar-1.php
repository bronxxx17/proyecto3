<?php
require_once 'Conexion.php';

class ListarSuper extends Conexion {
    private $pdo;

    public function __construct() {
        $this->pdo = parent:: getConexion();
    }

    public function obtenerEditores() {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM superhero.publisher");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerSuperheroesPorEditor($editorSeleccionado) {
        try {
            $consulta = $this->pdo->prepare("
                SELECT sh.id, sh.superhero_name, sh.full_name, sh.gender_id, sh.race_id
                FROM superhero.superhero sh
                JOIN superhero.publisher pub ON sh.publisher_id = pub.id
                WHERE pub.publisher_name = :editor
            ");
            $consulta->execute(array(':editor' => $editorSeleccionado));
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
