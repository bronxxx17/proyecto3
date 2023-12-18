<?php

require_once 'Conexion.php';

class publicacion extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function getAll() {
    try {
      $consulta = $this->pdo->prepare("CALL BuscarSuperheroes ()");
          $consulta->execute();
          return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
     catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
