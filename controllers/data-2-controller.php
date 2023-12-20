<?php
require_once '../models/graficar-2.php';

if (isset($_GET['operacion'])) {
    if ($_GET['operacion'] === 'listar') {
        $listarSuper = new ListarSuper();
        $resultado = $listarSuper->obtenerEditores();
        echo json_encode($resultado);
    } elseif ($_GET['operacion'] === 'filtrar' && isset($_GET['editorSeleccionado'])) {
        $editorSeleccionado = $_GET['editorSeleccionado'];
        $listarSuper = new ListarSuper();
        $superheroes = $listarSuper->obtenerSuperheroesPorEditor($editorSeleccionado);
        echo json_encode($superheroes);
    }
}
?>
