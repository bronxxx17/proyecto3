<?php
require_once 'Conexion.php';

class formulario extends Conexion {

  private $pdo;

  public function __construct() {
    $this->pdo = parent::getConexion();
  }

  public function getAllPublishers() {
    try {
      $consulta = $this->pdo->prepare("CALL spu_listar_hero()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
?>
