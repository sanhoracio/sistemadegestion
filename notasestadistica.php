<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
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
$validacion="";

$sql = "CREATE TABLE IF NOT EXISTS estadisticanotas(
    id_nota INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_materia int(20) NOT NULL,
    id_estudiante int(20) NOT NULL,
    id_cursada int(20) NOT NULL,
    nota_primer_parcial int NOT NULL,
    nota_segundo_parcial int NOT NULL,
    nota_final int NOT NULL

)";
/* CAmbiado de false a FALSE*/
if ($conn->query($sql) === FALSE ) {

    /* $msge="Error al crear la tabla:" . $conn->error; */
    $msge = "<h5 style='color: #CA2E2E;'>Error al crear la tabla: " . $conn->error . "</h5>";

}; 

// Obtener los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    
        $id_nota_n = trim($_POST['id_nota']);
        $id_materia_n = trim($_POST['id_materia']);
        $id_estudiante_n = trim($_POST['id_estudiante']);
        $id_cursada_n  = trim($_POST['id_cursada']);
        $nota_primer_parcial_n = trim($_POST['nota_primer_parcial']);
        $nota_segundo_parcial_n = trim($_POST['nota_segundo_parcial']);
        $nota_final_n = trim($_POST['nota_final']);
        
        $errors=[];
        //Validacion de campos vacios:
        if (
            empty($id_nota_n ) ||
            empty($id_materia_n ) ||
            empty($id_estudiante_n) ||
            empty( $id_cursada_n) ||
            empty( $nota_primer_parcial_n) ||
            empty( $nota_segundo_parcial_n) ||
            empty( $nota_final_n) 
        ) {
            $errors['$id_nota_n'] = "Por favor, complete todos los campos antes de enviar el formulario.";
           
        }
















         else {

        //Evitar inyeccion SQL

        $id_nota = htmlspecialchars($id_nota_n, ENT_QUOTES, 'UTF-8');
        $id_materia = htmlspecialchars($id_materia_n, ENT_QUOTES, 'UTF-8');
        $id_estudiante = htmlspecialchars($id_estudiante_n, ENT_QUOTES, 'UTF-8');
        $id_cursada = htmlspecialchars($id_cursada_n, ENT_QUOTES, 'UTF-8');
        $nota_primer_parcial = htmlspecialchars($nota_primer_parcial_n, ENT_QUOTES, 'UTF-8');
        $nota_segundo_parcial = htmlspecialchars($nota_segundo_parcial_n, ENT_QUOTES, 'UTF-8');
        $nota_final = htmlspecialchars($nota_final_n, ENT_QUOTES, 'UTF-8');

        //Sentencia SQL para insertar los datos


        $sql = "INSERT INTO Nota( id_nota, id_materia, id_estudiante, id_cursada, nota_primer_parcial, nota_segundo_parcial, nota_final) VALUES (?, ?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiiii", $id_nota, $id_materia, $id_estudiante, $id_cursada, $nota_primer_parcial, $nota_segundo_parcial, $nota_final);





        /*Si se puede ejecutar la consulta dependiendo del resultado se muestra un mensaje exitoso
        y si no se puede se muestra un mensaje de error al ejecutar*/
        if ($stmt->execute()){
            /*Si se hicieron cambios en la base, primero se muestra el mensaje de exito, 
            sino, se muestra un mensaje  de error*/

            if ($stmt->affected_rows > 0) {
                /* $msge="Registro insertado"; */
                $msge = "<h5 style='color: #2ECA6A;'>Registro insertado</h5>";
                echo "<meta http-equiv='refresh' content='1;url=ingresarnota.php'>";
            }else{
                /* $msge="Error al insertar el registro"; */
                $msge = "<h5 style='color: #CA2E2E;'>Error al insertar el registro</h5>";

            }
        } else{
                //Muestra mensaje de error si no se puede ejecutar la consulta
                /* $msge="Error al ejecutar la consulta: " . $stmt->error; */
                $msge = "<h5 style='color: #CA2E2E;'>Error al ejecutar la consulta: " . $stmt->error . "</h5>";
        }
        $stmt->close();
    }







    if (isset($_POST["volver"])) {
        header("Location: tablalistadonotas.php"); /*Jesi: le puse tablalistanotas.php para rellenar pero aun no esta creada, tenemos que crearla 
      */  exit();
    }

    }




/* if (isset($_POST["volver"])) {
    header("Location: tablalistanotas.php");
    exit();
} */

}catch(Exception $e){
    echo "<h5 style='color: #CA2E2E;'>Error conectando a la base de datos: " . $e->getMessage() . "</h5>";
}
finally{
    $conn->close();
  }
include 'headernosearch.php';
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
                <h3 class="card-footer-text mt-2 mb-5 p-2">Notas</h3>
                <div class="m-4">
                    <h2 class="text-dark-subtle title">ESTADISTICAS :</h2>
                    <?=$msge?>
                    <!-- <h6 class="text-black-50">
                        *Dar de alta las Materias para la carrera correspondiente
                    </h6> -->
                </div>
                <div>
                    <form class="row g-3 mt-4 ms-4 me-4" method="post" action="notasinicio.php" >
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_nota">ID Notas*:</label>
                            <input class="form-control" type="text" name="id_nota" id="id_nota" maxlength="20" required>
                            <?php if (isset($errors['cod_carrera_n'])) { ?>
                                <h5 style='color: #CA2E2E;'><?= $errors['cod_carrera_n'] ?></h5>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_estudiante"> Estudiante*:</label>
                            <input class="form-control" type="text" name="id_estudiante" id="id_estudiante" maxlength="100" required>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_cursada">ID Cursada*:</label>
                            <input class="form-control" type="text" name="id_cursada" id="id_cursada" maxlength="100" required>
                        </div>

                        <label for="Alumno">Alumno (v/f):</label>
                        <input type="radio" name="respuesta" value="verdadero"> Verdadero
                        <input type="radio" name="respuesta" value="falso"> Falso
                        
                       <!--  <div class="col-md-6 offset-1 mb-5">
                            <div class="d-block mb-5 gap-2 align-content-start">
                                <h6 class="text-black-50">*Dar de alta las Materias para la carrera correspondiente.</h6>
                                <a class="" href=asignarmaterias.php><button class='btn btn-primary btn-lg px-4 menu-icon border-0'>Dar de alta materias</button></a>
                            </div>
                        </div> --> 
                         <div class="col-md-6 offset-2 mb-5">
                            <div class="d-flex mb-5 gap-2 justify-content-between align-content-center">
                                <input class="btn btn-primary px-4 nav-bar border-0 text-wrap"  id="liveToastBtn" name="guardar" type="submit" value="Guardar">
                                <!-- <input class="btn btn-primary menu-icon border-0 px-4 text-wrap"  id="liveToastBtn" name="volver" type="button" value="Volver"> -->
                                <a class="" href="notasinicio.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">Volver</button></a>                     
                            </div>
                        </div>
                    </form>
                     
                </div>

                <!-- linea divisoria -->
                <br><br><hr><br>

                <!-- botones finales de direccionamiento -->
                <div class="col-md-6 offset-2 mb-5">
                <div class="d-flex mb-5 gap-2 justify-content-between align-content-center">
                <a class="" href="ingresarnotas.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">INGRESAR</button></a>                     
                <a class="" href="buscanotas.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">BUSQUEDA</button></a>                     
                <a class="" href="estadisticanotas.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">ESTADÍSTICA</button></a>                                                     
                <a class="" href="index.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">INICIO</button></a>                     
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