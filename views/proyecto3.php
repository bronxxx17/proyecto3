<!DOCTYPE html>
<html lang="es">
<head>
  <title>Gráfico de Recuento de Alineaciones</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      margin-top: 20px;
    }
    canvas {
      max-width: 400px;
      max-height: 200px;
    }
  </style>
</head>
    <ul>
        <li><a href="proyecto1.php">Proyecto 1</a></li>
        <li><a href="proyecto2.php">Proyecto 2</a></li>
        <li><a href="proyecto3.php">Proyecto 3</a></li>
        <li><a href="proyecto4.php">Proyecto 4</a></li>
    </ul>
<body>
  <div class="container">
    <h2>Gráfico de Recuento de Alineaciones de Superhéroes</h2>
    <canvas id="alignmentChart" width="400" height="200"></canvas>
  </div>

  <div class="container">
    <h2>Cuadro de Resultados</h2>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>Alineación</th>
          <th>Recuento</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Include the database connection file
        require_once '../models/Conexion.php';

        try {
            // Establish database connection
            $pdo = new Conexion();

            // Prepare SQL query to get alignment data
            $consulta = $pdo->getConexion()->prepare(
              "SELECT a.alignment, COUNT(s.alignment_id) AS alignment_count 
              FROM superhero.superhero s 
              INNER JOIN superhero.alignment a ON s.alignment_id = a.id 
              GROUP BY s.alignment_id");

            // Execute the query
            $consulta->execute();

            // Get results as an associative array
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

            // Display results in the table
            foreach ($resultados as $resultado) {
                echo "<tr>";
                echo "<td>{$resultado['alignment']}</td>";
                echo "<td>{$resultado['alignment_count']}</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            // Error handling
            die('Error al obtener datos: ' . $e->getMessage());
        }
        ?>
      </tbody>
    </table>
  </div>

  <script>
    // Use PHP data to generate Chart
    const nombresAlineaciones = <?php echo json_encode(array_column($resultados, 'alignment')); ?>;
    const valoresAlineaciones = <?php echo json_encode(array_column($resultados, 'alignment_count')); ?>;

    // Create Chart using processed data
    const ctx = document.getElementById('alignmentChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: nombresAlineaciones,
        datasets: [{
          label: 'Recuento de Alineaciones',
          data: valoresAlineaciones,
          backgroundColor: [
            'rgba(173, 255, 47, 0.5)', // Verde limón transparente
            'rgba(255, 140, 0, 0.5)', // Rojo tipo naranja transparente
            'rgba(255, 255, 0, 0.5)' // Amarillo transparente
          ],
          borderColor: [
            'rgba(173, 255, 47, 1)', // Verde limón con borde
            'rgba(255, 140, 0, 1)', // Rojo tipo naranja con borde
            'rgba(255, 255, 0, 1)' // Amarillo con borde
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>
