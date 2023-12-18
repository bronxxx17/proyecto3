<?php


require_once '../models/buscar.php';


//1.recibe la solicitud 
//2. Realiza proceso
//3. Entrega resultado

if (isset($_GET['operacion'])) {
  
  $publisher_name = new publicacion();

  if ($_GET['operacion'] == 'listar') {
    $resultado = $publisher_name->getAll();
    echo json_encode($resultado);
  }
}