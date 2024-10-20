
<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home-ISFT 225</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<?php 
try{
    require('./conexion.php');
    $msge="";
    // Obtener el ID del registro a editar
$id_carrera = $_GET['id_carrera'];

    if ($id_carrera === null || !is_numeric($id_carrera)) {
        header("Location: tablalistadocarreras.php");
        // Exit para detener la ejecución
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los valores de los campos del formulario
        $new_cod_carrera = htmlspecialchars($_POST['cod_carrera'], ENT_QUOTES, 'UTF-8');
        $new_nro_resolucion = htmlspecialchars($_POST['nro_resolucion'], ENT_QUOTES, 'UTF-8');
        $new_nombre_carrera = htmlspecialchars($_POST['nombre_carrera'], ENT_QUOTES, 'UTF-8');
        $new_titulo_otorgado = htmlspecialchars($_POST['titulo_otorgado'], ENT_QUOTES, 'UTF-8');
        $new_estado_carrera = htmlspecialchars($_POST['estado_carrera'], ENT_QUOTES, 'UTF-8');
        $new_duracion = htmlspecialchars($_POST['duracion'], ENT_QUOTES, 'UTF-8');
        $new_modalidad = htmlspecialchars($_POST['modalidad'], ENT_QUOTES, 'UTF-8');
        $new_carga_horaria = htmlspecialchars($_POST['carga_horaria'], ENT_QUOTES, 'UTF-8');

       // Consulta SQL con parámetros
        $sql = "UPDATE carrera SET cod_carrera=?, 
                nro_resolucion=?, 
                nombre_carrera=?, 
                titulo_otorgado=?, 
                estado_carrera=?, 
                duracion=?, 
                modalidad=?, 
                carga_horaria=? 
                WHERE id_carrera=?";
    
        // Preparar la consulta
        $stmt = $conn->prepare($sql);
    
       // Vincular los parámetros
       $stmt->bind_param("sssssisii", $new_cod_carrera, 
                                    $new_nro_resolucion, 
                                    $new_nombre_carrera, 
                                    $new_titulo_otorgado, 
                                    $new_estado_carrera, 
                                    $new_duracion, 
                                    $new_modalidad, 
                                    $new_carga_horaria, 
                                    $id_carrera);

    
 // Ejecutar la consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            //header("Location: tablalistadocarreras.php");
            $msge="<h5 style='color: #2ECA6A;'>Actualización exitosa.<h5>";
            echo "<meta http-equiv='refresh' content='1;url=tablalistadocarreras.php'>";
            
        } else {
            /* $msge="No se realizó ninguna actualización"; */
            $msge="<h5 style='color: #CA2E2E;'>No se realizó ninguna actualización.<h5>";
            echo "<meta http-equiv='refresh' content='1;url=tablalistadocarreras.php'>";
            //header("Location: tablalistadocarreras.php");
        }
    } else {
            /* $msge="Error al ejecutar la consulta: " . $stmt->error; */
            $msge="<h5 style='color: #CA2E2E;'>Error al ejecutar la consulta: " . $stmt->error ."<h5>";
    }

    // Cerrar la consulta
    $stmt->close();
    }
$conn->close();

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
}catch(Exception $e){
    echo "<h5 style='color: #CA2E2E;'>Error conectando a la base de datos: " . $e->getMessage() . "</h5>";
}
finally{
    $conn->close();
  }
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
                    <h2 class="text-dark-subtle title">Editar Carrera</h2>
                    <?=$msge?>
                    <!-- <h6 class="text-black-50">
                        *Dar de alta las Materias para la carrera correspondiente
                    </h6> -->
                </div>
                <div>
                    
                    <form class="row g-3 m-4" action="modificarcarrera.php?id_carrera=<?=$id_carrera?>" method="POST">
                        <!-- 
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_carrera">Id de Carrera*:</label>
                            <input class="form-control" type="hidden" name="id_carrera" id="id_carrera" required>
                      </div>  -->

                        <div class="col-md-6 position-relative">
                            <input class="form-control" type="hidden" name="id_carrera" value="<?= $row['id_carrera'] ?>">
                            <label class="form-label text-black-50" for="cod_carrera">Código de  Carrera*:</label>
                            <input class="form-control" type="text" name="cod_carrera" id="cod_carrera" value="<?= $row['cod_carrera'] ?>" maxlength="20" required>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="nro_resolucion">Número de Resolución*:</label>
                            <input class="form-control" type="text" name="nro_resolucion" id="nro_resolucion" value="<?= $row['nro_resolucion'] ?>" maxlength="20" required>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="nombre_carrera">Nombre de carrera*:</label>
                            <input class="form-control" type="text" name="nombre_carrera" id="nombre_carrera" value="<?= $row['nombre_carrera'] ?>" maxlength="100" required>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="titulo_otorgado">Título que entrega*:</label>
                            <input class="form-control" type="text" name="titulo_otorgado" id="titulo_otorgado" value="<?= $row['titulo_otorgado'] ?>" maxlength="100" required>
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50 text-nowrap" for="estado_carrera">Estado de carrera*:</label>
                            <select class="form-select form-select mb-3" name="estado_carrera" id="estado_carrera" aria-label="select estado_carrera" value="<?= $row['estado_carrera'] ?>" required>
                                <!-- <option selected>Activo</option> -->
                                <option value="activo" <?php if ($row['estado_carrera'] == 'activo') echo 'selected'; ?>>Activo</option>
                                <option value="inactivo" <?php if ($row['estado_carrera'] == 'inactivo') echo 'selected'; ?>>Inactivo</option>
                              </select>
                              
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50" for="duracion">Duración*:</label>
                            <input class="form-control" type="number" name="duracion" id="duracion" min="0" maxlength="2" value="<?= $row['duracion'] ?>" required>
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50" for="modalidad">Modalidad*:</label>
                            <input class="form-control" type="text" name="modalidad" id="modalidad" value="<?= $row['modalidad'] ?>" maxlength="10" required>
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-50" for="carga_horaria">Carga horaria*:</label>
                            <input class="form-control" type="number" name="carga_horaria" id="carga_horaria" min="0" maxlength="4" value="<?= $row['carga_horaria'] ?>" required>
                        </div>
                        
                        <div class="col-md-6 offset-1 mb-5">
                            <div class="d-block mb-5 gap-2 align-content-start">
                                 <h6 class="text-black-50">*Dar de alta las Materias para la carrera correspondiente.</h6> 
                                 <a class="" href='asignarmateriascarrera.php?id_carrera=<?=$id_carrera?>'><button typ="button" class='btn btn-primary btn-lg px-4 menu-icon border-0'>Dar de alta materias</button></a>
                                
                            </div>
                        </div>
                        <div class="col-md-6 offset-2 mb-5">
                            <div class="d-flex mb-5 gap-2 justify-content-between align-content-center">
                                <a href="tablalistadocarreras.php"><button type="button" class='btn btn-primary menu-icon border-0 px-4'>Volver</button></a>
                                <!-- Agregué el name="submit" -->
                                <a class="" href='modificarcarrera.php?id_carrera=<?=$id_carrera?>'><button class="btn btn-primary px-4 nav-bar border-0 text-wrap">Guardar cambios</button></a>            
                            </div>
                        </div>
                    </form>
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
