<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home-ISFT 225</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/styletablas.css">
</head>

<body>

  <?php
  require('./conexion.php');
 
  try {
	  
	// Obtener los datos del formulario
	// Consultar los datos    
	$searchTerm = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
	$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
  
    // Crear una conexión a la base de datos aquí y asignarla a la variable $conn.
    $sql_estudiantes = "SELECT
        e.id_estudiante,
        e.dni_estudiante,
        e.nro_legajo,
        CONCAT(e.apellidos, ', ', e.nombres) AS 'Apellido y Nombre',
        e.estado_estudiante,
        e.documentacion_completa,
        e.repositorio_documentacion
        FROM estudiantes e";

        /* $sql_estudiantes = "SELECT
        e.id_estudiante,
        e.dni_estudiante,
        e.nro_legajo,
        CONCAT(e.apellidos, ', ', e.nombres) AS 'Apellido y Nombre',
        e.estado_estudiante,
        e.documentacion_completa,
        e.repositorio_documentacion
        c.id_carrera,
        c.nombre_carrera,
        m.id_materia,
        m.denominacion_materia 
        FROM estudiantes e
        INNER JOIN estudiante_carrera ec ON e.id_estudiante = ec.id_estudiante
        INNER JOIN carrera c ON ec.id_carrera = c.id_carrera
        INNER JOIN estudiante_materia em ON e.id_estudiante = em.id_estudiante
        INNER JOIN materia m ON em.id_materia = m.id_materia"; */
		
	if ($filter !== 'all' && !empty($searchTerm)) {
      $sql_estudiantes .= " WHERE $filter LIKE '%$searchTerm%' ";
    }

    $result = $conn->query($sql_estudiantes);

    if (!$result) {
      throw new Exception("Error de consulta SQL: " . $conn->error);
    }

    // Aquí recorrer y mostrar los resultados de la consulta.

  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }

  include 'header.php';
  ?>

  <main>
    <!-- Contenedor principal -->
    <div class="d-flex flex-nowrap sidebar-height">

      <!-- Aside/Wardrobe/Sidebar Menu -->
      <?php include "sidebar.php"; ?>
      <!-- Fin de sidebar/aside -->
      
      <!-- Contenedor de ventana de contenido -->
      <div class="col-9 offset-3 bg-light-subtle pt-5">
        <div class="d-block p-3 m-4 h-100 ">
          <h3 class="card-footer-text mt-2 mb-5 p-2">Estudiante</h3>
		  
		  
          <form action="" method="GET" class="mb-3">
              <div class="input-group">
                  <select class="form-select" name="filter">
                      <option value="all" <?php echo ($filter === 'all') ? 'selected' : ''; ?>>Todos los campos</option>
                      <option value="apellidos" <?php echo ($filter === 'apellido') ? 'selected' : ''; ?>>Apellidos</option>
                      <option value="nro_legajo" <?php echo ($filter === 'nro_legajo') ? 'selected' : ''; ?>>Nro. Legajo</option>
                      <option value="dni_estudiante" <?php echo ($filter === 'dni_estudiante') ? 'selected' : ''; ?>>DNI</option>
                      <option value="estado_estudiante" <?php echo ($filter === 'estado_estudiante') ? 'selected' : ''; ?>>Estado</option>
                  </select>
                  <input type="text" class="form-control" placeholder="Buscar" name="buscar" value="<?php echo $searchTerm; ?>">
                  <button class="btn btn-outline-secondary" type="submit">Buscar</button>
              </div>
          </form>

          <div class="container">

            <a href="ingresarestudiantes.php" class="btn btn-primary custom-button mt-3">Ingresar estudiante</a>
            <table class="table table-bordered table-striped mt-3 space-between">
              <thead>

                <tr>
                  <th style='display:none'>ID estudiante</th>
                  <th>DNI</th>
                  <th>Nro. Legajo</th>
                  <th>Apellido y Nombre</th>
                  <!-- <th>Carrera</th> 
                  <th>Materia</th>-->
                  <th>Estado</th>
                  <th>Documentacion</th>

                  <!-- <th>Declaración Jurada</th> -->
                  <th>Editar</th>
                  <th>Ver</th>
                  <th>Asignar materia</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result->num_rows > 0) {
                  // $datos = array();
                  // Generar filas de la tabla
                  while ($fila = $result->fetch_assoc()) {
                    $valor_documentacion = $fila['documentacion_completa'];
                    $icono = ($valor_documentacion == 1) ? '<i class="checkmark fa-solid fa-check fa-lg" style="color: #0FA958;"></i>' : '<i class="checkmark fa-solid fa-x" style="color: #000;"></i>';

                    echo "<tr>";
                    echo "<td style='display:none'>" . $fila['id_estudiante'] . "</td>";
                    echo "<td>" . $fila['dni_estudiante'] . "</td>";
                    echo "<td>" . $fila['nro_legajo'] . "</td>";
                    echo "<td>" . $fila['Apellido y Nombre'] . "</td>";
                    // echo "<td>" . $fila['nombre_carrera'] . "</td>";
                    // echo "<td>" . $fila['denominacion_materia'] . "</td>";
                    echo "<td>" . $fila['estado_estudiante'] . "</td>";
                    echo "<td><div class='cencell'>$icono</div></td>";
                    //echo "<td>" . $fila['repositorio_documentacion'] . "</td>";

                    // enlace a  editar  pagina de edicion
                    echo "<td><a href='formeditarestudiantes.php?id_estudiante=" . $fila["id_estudiante"] . "' class='btn btn-custom-edit'><i class='fas fa-pencil-alt'></i></a></td>";
                    // enlace a  pagina de vista del estudiante
                    echo "<td><a href='listarestudiante.php?id_estudiante=" . $fila["id_estudiante"] . "' class='btn btn-custom-view'><i class='fas fa-eye'></i></a></td>";
                    // asignar materias al estudiante
                    echo "<td><div class='cencell'><a href='asignarmateriaestudiante.php?id_estudiante=" . $fila["id_estudiante"] . "' class='btn btn-custom-view'><i class='fas fa-book' style='font-size:20px; color:#523497'</i></a></div></td>";

                    echo "</tr>";
                  }

                } else {
                    echo "<h4>No hay datos para mostrar</h4>";
                }
                $conn->close()
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"> 
</script>

</html>