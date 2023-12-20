<?php
require_once 'Conexion.php';

class ListarSuper extends Conexion {
    private $pdo;

    public function __construct() {
        $this->pdo = parent::getConexion();
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
                SELECT a.alignment
                FROM superhero.superhero s
                INNER JOIN superhero.alignment a ON s.alignment_id = a.id
                INNER JOIN superhero.publisher p ON s.publisher_id = p.id
                WHERE p.publisher_name = :editor
            ");
            $consulta->execute(array(':editor' => $editorSeleccionado));
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
}
?>
