<?php
require_once '../models/listar.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Listado de Empleados</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  
  <!-- Bootstrap CSS v5.3.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body>
<div class="container">
      <div class="card mt-5">
        <div class="card-header bg-info text-center" >
        <h4 class="text-light-danger"  >Lista </h4>
        </div>
        
        
        <div class="card mb-3 ">
          <label for="buscar" class="form-label">Publicaciones:</label>
            <select name="buscar" id="buscar" class="form-select" required>
              <option value="">Seleccione</option>
            </select>
        </div>



  <div class="container my-4">
    <h2>Listado de superheroes</h2>
    <div class="mb-3">
      <table class="table table-striped" id="tablasup">
        <thead>
          <tr>
            <th>ID</th>
            <th>superhero_name</th>
            <th>full_name</th>
            <th>gender_id</th>
            <th>race_id</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($superhero)) : ?>
              <?php foreach ($superhero as $superhero) : ?>
                <tr>
                  <td><?php echo $superhero['id']; ?></td>
                  <td><?php echo $superhero['superhero_name']; ?></td>
                  <td><?php echo $superhero['full_name']; ?></td>
                  <td><?php echo $superhero['gender_id']; ?></td>
                  <td><?php echo $superhero['fechanac']; ?></td>
                  <td><?php echo $superhero['race_id']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="7">No hay empleados para mostrar.</td>
              </tr>
            <?php endif; ?>
          </tbody>
      </table>
    </div>

  </div>             
  <script> 
    document.addEventListener("DOMContentLoaded", () => {

        function $(id) {return document.querySelector(id)}

        //Funcion
        //
        (function (){
          fetch(`../controllers/public.controller.php?operacion=listar`)
            .then(respuesta => respuesta.json())
            .then(datos => {
              datos.forEach(element => {
                const tagOption = document.createElement("option")
                tagOption.value = element.id
                tagOption.innerHTML = element.publisher_name
                $("#buscar").appendChild(tagOption)
              });
            })
            .catch(e => {
              console.error(e)
            })
        })();
    })
    (function(){
        $('#tablasup').DataTable();
      });
    </script>





  

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Zv/1aZsIoMANBp8A8YC4vewNp6k6Po7UpyKpu7kw+065Qm10h1y5aTBFLPh2+jTl" crossorigin="anonymous"></script>
</body>
</html>
