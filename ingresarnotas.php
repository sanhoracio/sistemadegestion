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

$sql = "CREATE TABLE IF NOT EXISTS ingresarnotas(
    id_nota INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_profesor int(20) NOT NULL,
    id_materia int(20) NOT NULL,
    id_estudiante int(20) NOT NULL,
    id_cursada int(20) NOT NULL,
    primerfecha int(11) NOT NULL,
    nota_primer_parcial int(11) NOT NULL,
    segundafecha int(11) NOT NULL,
    nota_segundo_parcial int(11) NOT NULL,
    tercerfecha int(11) NOT NULL,
    nota_final int(11) NOT NULL

)";
/* CAmbiado de false a FALSE*/
if ($conn->query($sql) === FALSE ) {

    /* $msge="Error al crear la tabla:" . $conn->error; */
    $msge = "<h5 style='color: #CA2E2E;'>Error al crear la tabla: " . $conn->error . "</h5>";

}; 

// Obtener los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    
        //$id_nota_n = trim($_POST['id_nota']);
        $id_profesor_n = trim($_POST['id_profesor']);
        $id_materia_n = trim($_POST['id_materia']);
        $id_estudiante_n = trim($_POST['id_estudiante']);
        $id_cursada_n  = trim($_POST['id_cursada']);
        $primerfecha_n = trim($_POST['primerfecha']);
        $nota_primer_parcial_n = trim($_POST['nota_primer_parcial']);
        $segundafecha_n = trim($_POST['segundafecha']);
        $nota_segundo_parcial_n = trim($_POST['nota_segundo_parcial']);
        $tercerfecha_n = trim($_POST['tercerfecha']);
        $nota_final_n = trim($_POST['nota_final']);
        
        $errors=[];
        //Validacion de campos vacios:
        if (
            empty($id_nota_n ) ||
            empty($id_profesor_n ) ||
            empty($id_materia_n ) ||
            empty($id_estudiante_n) ||
            empty($id_cursada_n) ||
            empty($id_primerfecha_n ) ||
            empty($nota_primer_parcial_n) ||
            empty($id_segundafecha_n ) ||
            empty($nota_segundo_parcial_n) ||
            empty($id_tercerfecha_n ) ||
            empty($nota_final_n)
           
        ) {
            $errors['$id_nota_n'] = "Por favor, complete todos los campos antes de enviar el formulario.";
           
        }

         else {

        //Evitar inyeccion SQL

        // $id_nota = htmlspecialchars($id_nota_n, ENT_QUOTES, 'UTF-8');
        $id_profesor = htmlspecialchars($id_profesor_n, ENT_QUOTES, 'UTF-8');
        $id_materia = htmlspecialchars($id_materia_n, ENT_QUOTES, 'UTF-8');
        $id_estudiante = htmlspecialchars($id_estudiante_n, ENT_QUOTES, 'UTF-8');
        $id_cursada = htmlspecialchars($id_cursada_n, ENT_QUOTES, 'UTF-8');
        $id_primerfecha = htmlspecialchars($id_primerfecha_n, ENT_QUOTES, 'UTF-8');
        $nota_primer_parcial = htmlspecialchars($nota_primer_parcial_n, ENT_QUOTES, 'UTF-8');
        $id_segundafecha = htmlspecialchars($id_segundafecha_n, ENT_QUOTES, 'UTF-8');
        $nota_segundo_parcial = htmlspecialchars($nota_segundo_parcial_n, ENT_QUOTES, 'UTF-8');
        $id_tercerfecha = htmlspecialchars($id_tercerfecha_n, ENT_QUOTES, 'UTF-8');
        $nota_final = htmlspecialchars($nota_final_n, ENT_QUOTES, 'UTF-8');

        //Sentencia SQL para insertar los datos
        $sql = "INSERT INTO ingresarnotas( id_profesor, id_materia, id_estudiante, id_cursada, primerfecha, nota_primer_parcial, segundafecha, nota_segundo_parcial, tercerfecha, nota_final) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiiiiiii", $id_profesor, $id_materia, $id_estudiante, $id_cursada, $primerfecha, $nota_primer_parcial, $segundafecha, $nota_segundo_parcial, $tercerfecha, $nota_final);

        /*Si se puede ejecutar la consulta dependiendo del resultado se muestra un mensaje exitoso
        y si no se puede se muestra un mensaje de error al ejecutar*/
        if ($stmt->execute()){
            /*Si se hicieron cambios en la base, primero se muestra el mensaje de exito, 
            sino, se muestra un mensaje  de error*/
            if ($stmt->affected_rows > 0) {
                /* $msge="Registro insertado"; */
                $msge = "<h5 style='color: #2ECA6A;'>Registro insertado</h5>";
                echo "<meta http-equiv='refresh' content='1;url=notasinicio.php'>";
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
                    <h2 class="text-dark-subtle title">INGRESAR NOTAS</h2>
                    <?=$msge?>
                    <!-- <h6 class="text-black-50">
                        *Dar de alta las Materias para la carrera correspondiente
                    </h6> -->
                </div>
                    <div>
                    <form class="row g-3 mt-4 ms-4 me-4" method="post" action="notasinicio.php" >
                        <label for="personal"> Nombre del profesor/directivo : </label>
                            <select name="id_profesor" id="id_profesor" requiered>
                                <option value="Vacio"> </option>
                                <option value="carlosV">Carlos Velarde</option>
                                <option value="profeEmir">Profe Emir</option>
                                <option value="ayelenG">Ayelen G</option>
                                <option value="mariaL">Maria L</option>
                                <option value="pedroP">Pedro Picapiedra</option>
                                <option value="AlanT">Alan Trobiani</option>  
                    </div>
                    <br><br>


                      
                      
                        </select>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_materia">ID Materia*:</label>
                            <input class="form-control" type="text" name="id_materia" id="id_materia" maxlength="20" required>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_estudiante">ID Estudiante*:</label>
                            <input class="form-control" type="text" name="id_estudiante" id="id_estudiante" maxlength="100" required>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-black-50" for="id_cursada">ID Cursada*:</label>
                            <input class="form-control" type="text" name="id_cursada" id="id_cursada" maxlength="100" required>
                        </div>
                        <br><br>
                        <div class="col-md-3 position-relative">
                            <label for="primerfecha">Primer Fecha :</label>
                            <input type="date" id="primerfecha" name="primerfecha">
                        </div>    

                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-20" for="nota_primer_parcial">Nota Primer Parcial*:</label>
                            <input class="form-control" type="text" name="nota_primer_parcial" id="nota_primer_parcial" maxlength="10" required>
                        </div>
                        <br>
                        <div class="col-md-3 position-relative">
                            <label for="segundafecha">Segunda Fecha :</label>
                            <input type="date" id="segundafecha" name="segundafecha">
                        </div>

                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-20" for="nota_segundo_parcial">Nota Segundo Parcial*:</label>
                            <input class="form-control" type="text" name="nota_segundo_parcial" id="nota_segundo_parcial" maxlength="10" required>
                        </div>
                        <br>
                        <div class="col-md-3 position-relative">
                            <label for="tercerfecha">Tercer Fecha :</label>
                            <input type="date" id="tercerfecha" name="tercerfecha">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label text-black-20" for="nota_final">Nota Final*:</label>
                            <input class="form-control" type="text" name="nota_final" id="nota_final" maxlength="10" required>
                        </div>
                        <br>
                         <div class="col-md-6 offset-2 mb-5">
                            <div class="d-flex mb-5 gap-2 justify-content-between align-content-center">
                                <input class="btn btn-primary px-4 nav-bar border-0 text-wrap"  id="liveToastBtn" name="guardar" type="submit" value="Guardar">
                                <!-- <input class="btn btn-primary menu-icon border-0 px-4 text-wrap"  id="liveToastBtn" name="volver" type="button" value="Volver"> -->
                                <a class="" href="notasinicio.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">Volver</button></a>                     
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