<?php
// Incluir el archivo de conexión a la base de datos
require_once 'Conexion.php';

try {
    // Crear la instancia de la conexión a la base de datos
    $pdo = new Conexion();

    // Preparar la consulta SQL para obtener los nombres y contar su frecuencia
    $consulta = $pdo->getConexion()->prepare("SELECT gender, COUNT(*) AS gender_count FROM superhero.gender GROUP BY gender");

    // Ejecutar la consulta
    $consulta->execute();

    // Obtener los resultados como un array asociativo
    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados como JSON
    echo json_encode($resultados);
} catch (PDOException $e) {
    // En caso de error, mostrar el mensaje de error
    die('Error al obtener datos: ' . $e->getMessage());
}
?>
