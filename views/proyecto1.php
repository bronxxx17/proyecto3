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
</head>
    <ul>
        <li><a href="proyecto1.php">Proyecto 1</a></li>
        <li><a href="proyecto2.php">Proyecto 2</a></li>
        <li><a href="proyecto3.php">Proyecto 3</a></li>
        <li><a href="proyecto4.php">Proyecto 4</a></li>
    </ul>
<body>
  <div class="container my-4">
    <h2>Listado de Superhéroes</h2>

    <div class="mb-3">
      <label for="selectEditor" class="form-label">Selecciona un Editor:</label>
      <select name="selectEditor" id="selectEditor" class="form-select" required>
        <option value="">Seleccione un Editor</option>
      </select>
    </div>

    <div class="mb-3">
      <table class="table table-striped" id="tablaDatos">
        <!-- Aquí se mostrarán los datos relacionados al editor seleccionado -->
      </table>
    </div>
  </div>

  <!-- Scripts de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      fetch('../controllers/buscar-1-controller.php?operacion=listar')
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
          fetch(`../controllers/buscar-1-controller.php?operacion=filtrar&editorSeleccionado=${editorSeleccionado}`)
            .then(response => response.json())
            .then(superheroes => {
              const tablaDatos = $('#tablaDatos');
              tablaDatos.empty();

              if (superheroes.length > 0) {
                tablaDatos.append(`<thead><tr><th>ID</th><th>Nombre Superhéroe</th><th>Nombre Completo</th><th>Género</th><th>Raza</th></tr></thead><tbody>`);
                superheroes.forEach(hero => {
                  tablaDatos.append(`<tr><td>${hero.id}</td><td>${hero.superhero_name}</td><td>${hero.full_name}</td><td>${hero.gender_id}</td><td>${hero.race_id}</td></tr>`);
                });
                tablaDatos.append(`</tbody>`);
              } else {
                tablaDatos.append(`<tr><td colspan="5">No hay superhéroes para mostrar.</td></tr>`);
              }
            })
            .catch(error => console.error(error));
        }
      });
    });
  </script>

</html>
