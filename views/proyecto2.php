<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Superhéroes</title>

    <!-- Estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
    <ul>
        <li><a href="proyecto1.php">Proyecto 1</a></li>
        <li><a href="proyecto2.php">Proyecto 2</a></li>
        <li><a href="proyecto3.php">Proyecto 3</a></li>
        <li><a href="proyecto4.php">Proyecto 4</a></li>
    </ul>
<body>
    <div class="container my-4">
        <h2>SABER SI ES BUENO O MALO EL SUPERHERO</h2>

        <div class="mb-3">
            <label for="selectEditor" class="form-label">Selecciona un Editor:</label>
            <select name="selectEditor" id="selectEditor" class="form-select" required>
                <option value="">Seleccione un Editor</option>
            </select>
        </div>

        <div class="mb-3">
            <!-- Contenedor para el gráfico -->
            <div id="chartContainer" style="width: 100%; height: 400px;">
                <!-- Aquí se generará el gráfico -->
                <canvas id="alignmentChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            fetch('../controllers/data-2-controller.php?operacion=listar')
                .then(response => response.json())
                .then(editores => {
                    const selectEditor = $('#selectEditor');
                    editores.forEach(editor => {
                        selectEditor.append(`<option value="${editor.publisher_name}">${editor.publisher_name}</option>`);
                    });
                })
                .catch(error => console.error(error));

            $('#selectEditor').change(function() {
                const editorSeleccionado = $(this).val();
                if (editorSeleccionado !== "") {
                    fetch(`../controllers/data-2-controller.php?operacion=filtrar&editorSeleccionado=${editorSeleccionado}`)
                        .then(response => response.json())
                        .then(alineaciones => {
                            // Limpiar el contenedor antes de actualizar el gráfico
                            $('#chartContainer').empty();
                            $('#chartContainer').append('<canvas id="alignmentChart"></canvas>');

                            if (alineaciones.length > 1) {
                                const alignmentLabels = alineaciones.map(alineacion => alineacion.alignment);
                                const alignmentCounts = alineaciones.map(alineacion => alineacion.alignment_count);
                                const backgroundColors = alineaciones.map(() => 'rgb(0, 255, 255)'); // Color fijo

                                // Crear el contexto del gráfico
                                const ctx = document.getElementById('alignmentChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: alignmentLabels,
                                        datasets: [{
                                            label: 'Recuento de Alineaciones',
                                            data: alignmentCounts,
                                            backgroundColor: backgroundColors,
                                            borderColor: 'rgb(0, 255, 0)',
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
                            } else {
                                // Mostrar un mensaje si no hay alineaciones para mostrar
                                $('#chartContainer').append('<p>No hay alineaciones para mostrar.</p>');
                            }
                        })
                        .catch(error => console.error(error));
                }
            });
        });
    </script>
</html>
