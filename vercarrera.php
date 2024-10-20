<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home-ISFT 225</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<?php 
    require('./conexion.php');
    $msge = "<h5 style='color: #CA2E2E;'></h5>";
?>
<?php 
    // Obtener el ID del registro a editar
$id_carrera = $_GET['id_carrera'];

    if ($id_carrera === null || !is_numeric($id_carrera)) {
        header("Location: tablalistadocarreras.php");
        // Exit para detener la ejecución
        exit();
    }
   
// Obtener los datos del registro actual
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

$sql = "SELECT id_carrera, cod_carrera, nro_resolucion,  nombre_carrera, titulo_otorgado, estado_carrera, duracion, modalidad, carga_horaria 
        FROM carrera 
        WHERE id_carrera=$id_carrera";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// Cerrar la conexión
$conn->close();
include "headernosearch.php";
?>
<main>
    <!-- Contenedor principal -->
    <div class="d-flex flex-nowrap sidebar-height"> 
      <!-- Aside/Wardrobe/Sidebar Menu --> 
      <?php
      include "sidebar.php"; 
        ?>  
      <!-- Fin de sidebar/aside -->
      <!-- Contenedor de ventana de contenido -->
      <div class="col-9 offset-3 bg-light-subtle pt-5">
            <div class="d-block p-3 m-4 h-100 ">
                <h3 class="card-footer-text mt-2 mb-5 p-2">Carreras</h3>
                <div class="m-4">
                    <h2 class="text-dark-subtle title">Ver Carrera</h2>
                    <?=$msge?>
                    <!-- <h6 class="text-black-50">
                        *Dar de alta las Materias para la carrera correspondiente
                    </h6> -->
                </div>
                <div>
                    <form class="row g-3 m-4" action="vercarrera.php" method="POST">
                        <!-- 
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_carrera">Id de Carrera*:</label>
                            <input class="form-control" type="hidden" name="id_carrera" id="id_carrera" required>
                      </div>  -->

                        <div class="col-md-6 position-relative">
                            <input class="form-control" type="hidden" name="id_carrera" value="<?= $row['id_carrera'] ?>">
                            <label class="form-label text-black-50" for="cod_carrera">Código de  Carrera*:</label>
                            <input class="form-control" type="text" name="cod_carrera" id="cod_carrera" value="<?= $row['cod_carrera'] ?>">
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="nro_resolucion">Número de Resolución*:</label>
                            <input class="form-control" type="text" name="nro_resolucion" id="nro_resolucion" value="<?= $row['nro_resolucion'] ?>">
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="nombre_carrera">Nombre de carrera*:</label>
                            <input class="form-control" type="text" name="nombre_carrera" id="nombre_carrera" value="<?= $row['nombre_carrera'] ?>">
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="titulo_otorgado">Título que entrega*:</label>
                            <input class="form-control" type="text" name="titulo_otorgado" id="titulo_otorgado" value="<?= $row['titulo_otorgado'] ?>">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50 text-nowrap" for="estado_carrera">Estado de carrera*:</label>
                 
                            <select class="form-select form-select mb-3" name="estado_carrera" id="estado_carrera" aria-label="select estado_carrera" value="<?= $row['estado_carrera'] ?>">
                                <!-- <option selected>Activo</option> -->
                                <option value="1" <?php if ($row['estado_carrera'] == '1') echo 'selected'; ?>>Activo</option>
                                <option value="0" <?php if ($row['estado_carrera'] == '0') echo 'selected'; ?>>Inactivo</option>
                              </select>
                              
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50" for="duracion">Duración*:</label>
                            <input class="form-control" type="text" name="duracion" id="duracion" value="<?= $row['duracion'] ?>">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50" for="modalidad">Modalidad*:</label>
                            <input class="form-control" type="text" name="modalidad" id="modalidad" value="<?= $row['modalidad'] ?>">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50" for="carga_horaria">Carga horaria*:</label>
                            <input class="form-control" type="text" name="carga_horaria" id="carga_horaria" value="<?= $row['carga_horaria'] ?>">
                        </div>
                        
                        <div class="col-md-6 offset-2">
                            <div class="d-flex mb-5 gap-2 justify-content-between align-content-center">
                                <a href='tablalistadocarreras.php'><button type="button" class='btn btn-primary menu-icon border-0 px-4'>Volver</button></a>
                            </div>
                        </div>
                    </form>
                    <div class="row btn-group d-flex flex-sm-wrap justify-content-between text-center g-3 m-2">
                        <div class="col-md-6 mb-5 position-relative">
                                <div class="d-block mb-5 gap-2 align-content-start">
                                    <h6 class="text-black-50">*Asignar Materias ya existentes para la carrera correspondiente.</h6>
                                    <a class="" href='asignarmateriascarrera.php?id_carrera=<?=$id_carrera?>'><button class='btn btn-primary px-4 nav-bar border-0 text-wrap'>Asignar materias</button></a>

                                </div>
                        </div>
                        <div class="col-md-5 mb-5 position-relative">
                                <div class="d-block mb-5 gap-2 align-content-start">
                                    <h6 class="text-black-50">*Ver materias.</h6>
                                    <a class="" href='vermateriascarrera.php?id_carrera=<?=$id_carrera?>'><button type="button" class='btn btn-primary  px-4 menu-icon border-0'>Ver materias asociadas</button></a>
                                    
                                </div>
                        </div>
                    </div> 
                </div>
              </div>
        </div>
        <!-- Fin de contenido -->
      </div>
      <!-- Fin de contenedor principal -->
 </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
