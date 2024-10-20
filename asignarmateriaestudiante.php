<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISFT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/styletablas.css">
</head>

<body>
    <?php
    require('./conexion.php');

    if (isset($_POST["asignar_materia"]) && ctype_digit($_POST["asignar_materia"]) && is_numeric($id_personal) ) {
        
      
        $up_materia = 
        "UPDATE estudiante_materia 
         SET id_materia = ?
         WHERE id_estudiante = ?";

        $stmt_up_materia = $conn->prepare($up_materia);

        if (!$stmt_up_materia) {
            throw new Exception("Error al preparar la consulta preparada para actualizar materias.");
        }

        // Vincular los parámetros con los valores
        $stmt_up_materia->bind_param("i", $id_materia);

        header("Location: tablasprofesor.php");
        // Exit para detener la ejecución
        exit();
    }

    $msge = "";

    // Verificar si se ha enviado un ID de estudiante de referencia
    if (isset($_GET['id_estudiante'])) {
        $id_estudiante = $_GET['id_estudiante'];
    } else {
        /* echo "ID de materia no especificado."; */
        $msge = "<h5 style='color: #CA2E2E;'>ID de estudiante no especificado.</h5>";
        $conn->close();
        exit();
    }

    // Verificar si se ha enviado el formulario de edición
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos editados
        $id_alumno = $_POST['id_estudiante'];
        $id_newmateria = $_POST['asignar_materia'];

        // Actualizar la materia en la base de datos
        $sql = "INSERT INTO estudiante_materia (id_estudiante, id_materia) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ii",
            $id_alumno,
            $id_newmateria
        );

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $msge = "<h5 style='color: #2ECA6A;'>Materia asignada exitosamente.<h5>";
            } else {
                $msge = "<h5 style='color: #CA2E2E;'>No se insertó materia alguna..</h5>";
            }
        } else {
            $msge = "<h5 style='color: #CA2E2E;'>Error al ejecutar la consulta: " . $stmt->error . "</h5>";
        }

        // Cerrar la consulta
        $stmt->close();
        $conn->close();
    }
    ?>

    <?php
       //Traigo las materias de la carrera que cursa el estudiante
       $sql_estudiante = "SELECT
       e.dni_estudiante,
       e.nro_legajo,
       CONCAT(e.apellidos, ', ', e.nombres) AS 'Apellidos y Nombres',
       c.id_carrera,
       c.nombre_carrera,
       m.id_materia,
       m.denominacion_materia
       FROM estudiantes e
       INNER JOIN estudiante_carrera ec ON ec.id_estudiante = e.id_estudiante  -- Tomar id de la carrera que cursa el estudiante mediante su id del estudiante
       INNER JOIN carrera c ON c.id_carrera = ec.id_carrera                    -- Tomar datos de la carrera que cursa el estudiante mediante id_carrera
       INNER JOIN materia_carrera mc ON mc.id_carrera = c.id_carrera           -- Tomar ides de las materias de la carrera que cursa el estudiante por id_carrera 
       INNER JOIN materia m ON m.id_materia = mc.id_materia                    -- Tomar datos de las materias que hay en la carrera que cursa el estudiante por id_materia
       WHERE e.id_estudiante = $id_estudiante";

       $result_sql = $conn->query($sql_estudiante);

    include "header.php";
    ?>

    <main>
        <!-- Contenedor principal -->
        <div class="d-flex flex-nowrap sidebar-height">
            <!-- Aside/Wardrobe/Sidebar Menu -->
            <?php include "sidebar.php"; ?>

            <div class="col-9 offset-3 bg-light-subtle pt-1">
                <div class="d-block p-3 m-4 h-100 ">
                    <h3 class="card-footer-text mt-2 p-2">Asignar materia al estudiante</h3>
                    <div class="m-4 mb-0">
                        <h4 class="text-dark-subtle title">Datos del estudiante</h4>
                        <?=$msge?>
                    </div>

                    <form class="row m-2" action="asignarmateriaestudiante.php" method="POST">                      
                      <div class="col-md-8">                           
                        <table class="table table-bordered table-striped mt-3 space-between">
                          <thead>
                           <tr>
                            <th style='display:none' name="id_estudiante" value="<?=$id_estudiante?>">ID estudiante</th>
                            <th>DNI</th>
                            <th>Nro. Legajo</th>
                            <th>Apellidos y Nombres</th>
                            <th>Carrera</th> 
                           </tr>
                          </thead>
                          <tbody>                    
                            <?php
                               // Verifica si hay resultados
                               if ($result_sql->num_rows > 0) {
                                   $fila = $result_sql->fetch_assoc();     

                                   echo "<tr>";
                                   echo "<td>" . $fila['dni_estudiante'] . "</td>";
                                   echo "<td>" . $fila['nro_legajo'] . "</td>";
                                   echo "<td>" . $fila['Apellidos y Nombres'] . "</td>";
                                   echo "<td>" . $fila['nombre_carrera'] . "</td>";
                                   echo "</tr>";  
                               } else {
                                   echo "No se encontraron materias para este estudiante.";
                               }

                               $sql_materias = "SELECT id_materia FROM estudiante_materia WHERE id_estudiante = $id_estudiante";
                               $result_materias = $conn->query($sql_materias);

                               // Almacena los IDs de las materias en un array
                               $materias_cursadas = array();
                               if ($result_materias->num_rows > 0) {
                                 while ($row = $result_materias->fetch_assoc()) {
                                     if ($id_estudiante != null) {
                                       $materias_cursadas[] = $row['id_materia'];
                                     }
                                     // var_dump($materias_cursadas); 
                                     // exit();
                                 }
                               }
                            ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-md-5">      
                        <label class="form-label text-black-50 text-nowrap" for="asignar_materia">Asignar materia:</label>
                       
                        <?php
                        $result_sql->data_seek(0); // Reinicia el puntero interno
                        if ($result_sql->num_rows > 0) {
                            while ($rowm = $result_sql->fetch_assoc()) {
                                // Si el estudiante no está cursando esta materia, agrega las opciónes 
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='checkbox' name='asignar_materia[]' id='asignar_materia_" . $rowm['id_materia'] . "' value='" . $rowm['id_materia'] . "'";
                                    
                                    if (in_array($rowm['id_materia'], $materias_cursadas)) { // Si el usuario ya ha seleccionado esta materia, marca el checkbox como seleccionado
                                        echo " checked disabled";
                                    }
                                    
                                    echo ">";
                                    echo "<label class='form-check-label' for='asignar_materia_" . $rowm['id_materia'] . "'>";
                                    echo $rowm['denominacion_materia'];
                                    echo "</label>";
                                    echo "</div>";
                            }
                        }
                        ?>

                      </div>  

                      <div class="d-flex mb-5 gap-5 justify-content-center">
                          <a href='tablaestudiantes.php' class='btn btn-primary menu-icon border-0 px-4'>Volver</a>
                          <input class="btn btn-primary px-4 nav-bar border-0 text-wrap" type="submit" value="Guardar">
                      </div>
      
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>