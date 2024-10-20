<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home-ISFT 225</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/personal.css">
</head>

<body>
    <!--Enlace de conexion-->
    <?php

    require('./conexion.php');

    // Obtener el ID del registro a editar
    if (isset($_GET['id_personal'])) {
        $id_personal = $_GET['id_personal'];

        // Consultar la materia existente
        $sql = "SELECT * FROM personal WHERE id_personal=?";
        //    $sql = "SELECT * FROM personal WHERE id_personal = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_personal);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "Personal no encontrado.";
            exit();
        }
    } else {
        echo "ID de materia no especificado.";
        exit();
    }
    // Obtener los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $new_nombre_personal_n = $_POST['nombre_personal'];
        $new_apellido_personal_n = $_POST['apellido_personal'];
        $new_email_personal_n = $_POST['email_personal'];
        $new_tipodoc_personal_n = $_POST['tipodoc_personal'];

        $new_nrodni_personal_n = $_POST['nrodni_personal'];
        $new_nrocuil_personal_n = $_POST['nrocuil_personal'];
        $new_sexo_personal_n = $_POST['sexo_personal'];
        $new_fechanac_personal_n = $_POST['fechanac_personal'];
        $new_paisnac_personal_n = $_POST['paisnac_personal'];

        $new_lugarnac_personal_n = $_POST['lugarnac_personal'];
        $new_fecha_designacion_n = $_POST['fecha_designacion'];
        $new_paisdomic_personal_n = $_POST['paisdomic_personal'];
        $new_provdomic_personal_n = $_POST['provdomic_personal'];

        $new_calle_personal_n = $_POST['calle_personal'];
        $new_depto_personal_n = $_POST['depto_personal'];
        $new_edificio_personal_n = $_POST['edificio_personal'];

        $new_localidad_personal_n = $_POST['localidad_personal'];
        $new_partido_personal_n = $_POST['partido_personal'];
        $new_titulo_n = $_POST['titulo'];
        $new_titulo_institucion_n = $_POST['titulo_institucion'];

        $new_tipo_titulo_n = $_POST['tipo_titulo'];
        $new_carr1_n = $_POST['carr1'];
        $new_carr1_institucion_n = $_POST['carr1_institucion'];
        $new_carr1_estado_n = $_POST['carr1_estado'];

        $new_carr1_titulo_n = $_POST['carr1_titulo'];
        $new_carr2_n = $_POST['carr2'];
        $new_carr2_institucion_n = $_POST['carr2_institucion'];
        $new_carr2_estado_n = $_POST['carr2_estado'];


        $new_carr2_titulo_n = $_POST['carr2_titulo'];
        $new_estado_personal_n = $_POST['estado_personal'];
        $new_observaciones_n = $_POST['observaciones'];
        // $repo_documentos = $_POST['repo_documentos'];
        $new_telefono_personal = $_POST['telefono_personal'];
        $new_nro_designacion = $_POST['nro_designacion'];
        $nro_personal = $_POST['nro_personal'];
        $new_piso_personal = $_POST['piso_personal'];
        $new_cp_personal = $_POST['cp_personal'];
        $new_anio_egreso = $_POST['anio_egreso'];
        $new_carr1_anioegreso = $_POST['carr1_anioegreso'];
        $carr2_anioegreso = $_POST['carr2_anioegreso'];
        $new_DNIchecked = $_POST['DNIchecked'];
        $new_CUILchecked = $_POST['CUILchecked'];
        $new_CVchecked = $_POST['CVchecked'];
        $new_TITchecked = $_POST['TITchecked'];
         //Sentencia SQL para insertar los datos
    
        $sql = "UPDATE personal SET
    nombre_personal=?,
    apellido_personal=?,
    email_personal=?,
    telefono_personal=?,
    tipodoc_personal=?,
    
    nrodni_personal=?,
    nrocuil_personal=?,
    sexo_personal=?,
    fechanac_personal=?,
    paisnac_personal=?,
    
    lugarnac_personal=?,
    fecha_designacion=?,
    nro_designacion=?,
    paisdomic_personal=?,
    provdomic_personal=?,
    
    calle_personal=?,
    nro_personal=?,
    piso_personal=?,
    depto_personal=?,
    edificio_personal=?,
    
    localidad_personal=?,
    partido_personal=?,
    cp_personal=?,
    titulo=?,
    titulo_institucion=? ,
    
    anio_egreso=?,
    tipo_titulo=?,
    carr1=?,
    carr1_institucion=?,
    carr1_estado=?,
    
    carr1_anioegreso=?,
    carr1_titulo=?,
    carr2=?,
    carr2_institucion=?,
    carr2_estado=?,
    
    carr2_anioegreso=?,
    carr2_titulo=?,
    estado_personal=?,
    observaciones=?,
    DNIchecked=?,
    CUILchecked=?,
    CVchecked=?,
    TITchecked=?
    WHERE id_personal=?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sssis sssss ssiss siiss ssiss issss issss issss ii",
            $new_nombre_personal,
            $new_apellido_personal,
            $new_email_personal,
            $new_telefono_personal,
            $new_tipodoc_personal,

            $new_nrodni_personal,
            $new_nrocuil_personal,
            $new_sexo_personal,
            $new_fechanac_personal,
            $new_paisnac_personal,

            $new_lugarnac_personal,
            $new_fecha_designacion,
            $new_nro_designacion,
            $new_paisdomic_personal,
            $new_provdomic_personal,

            $new_calle_personal,
            $new_nro_personal,
            $new_piso_personal,
            $new_depto_personal,
            $new_edificio_personal,

            $new_localidad_personal,
            $new_partido_personal,
            $new_cp_personal,
            $new_titulo,
            $new_titulo_institucion,

            $new_anio_egreso,
            $new_tipo_titulo,
            $new_carr1,
            $new_carr1_institucion,
            $new_carr1_estado,

            $new_carr1_anioegreso,
            $new_carr1_titulo,
            $new_carr2,
            $new_carr2_institucion,
            $new_carr2_estado,

            $new_carr2_anioegreso,
            $new_carr2_titulo,
            $new_estado_personal,
            $new_observaciones,
            $new_DNIchecked,
            $new_CUILchecked,
            $new_CVchecked,
            $new_TITchecked,
            $id_personal
        );

        if ($stmt->execute()) {

            if ($stmt->affected_rows > 0) {
                header("Location: tablasprofesor.php");

                exit();
            } else {
                echo "No se realizó ninguna actualización.";

            }
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();

    // Obtener los datos del registro actual

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }

    $sql = "SELECT *
    FROM personal
    WHERE id_personal =$id_personal";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $conn->close();

    // Header sin buscador
    include 'headernosearch.php';

    ?>

    <main>
        <!-- Contenedor principal -->
        <div class="d-flex flex-nowrap sidebar-height">
            <!-- Aside/Wardrobe/Sidebar Menu -->
            <?php
            // include "sidebar.php";
            ?>
            <!-- Fin de sidebar/aside -->
            <!-- Contenedor de ventana de contenido -->
            <div class="col-9 offset-3 bg-light-subtle pt-3">
                <div class="d-block p-3 m-2 h-100 ">
                    <h3 class="card-footer-text mt-2 mb-3 p-2">Personal</h3>
                    <div class="m-4">
                        <h2 class="text-dark-subtle title">Editar personal</h2>

                        <div class="col-md-4 position-relative">

                            <a href="asignarmateriapersonal.php"><button type="button"
                                    class='btn btn-primary menu-icon border-0 px-4 '>Asignar materia</button></a>

                        </div>
                    </div>

                    <div>
                        <h3 class="card-footer-text mt-2 mb-2 p-2 ">Datos personales</h3>

                        <!--Datos personales-->
                        <form class="row g-3 m-4" method="post"
                            action="edicionpersonal.php?id_personal=<?= $id_personal ?>">

                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="nombre_personal">Nombre completo*</label>
                                <input class="form-control" type="text" name="nombre_personal" id="nombre_personal"
                                    value="<?= $row['nombre_personal'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="apellido_personal">Apellido
                                    completo*</label>
                                <input class="form-control" type="text" name="apellido_personal" id="apellido_personal"
                                    value="<?= $row['apellido_personal'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="email_personal">Correo electrónico*</label>
                                <input class="form-control" type="text" name="email_personal" id="email_personal"
                                    placeholder="ejemplo@ejemplo.com" value="<?= $row['email_personal'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="telefono_personal">Número de
                                    teléfono*</label>
                                <input class="form-control" type="text" name="telefono_personal" id="telefono_personal"
                                    value="<?= $row['telefono_personal'] ?>">
                            </div>
                            <div class="col-md position-relative">
                                <label class="form-label text-black-50 text-nowrap" for="tipodoc_personal">Tipo de
                                    documento</label>
                                <input class="form-control" type="text" name="tipodoc_personal" id="tipodoc_personal"
                                    value="<?= $row['tipodoc_personal'] ?>">

                            </div>
                            <div class="col-md-4  position-relative">
                                <label class="form-label text-black-50" for="nrodni_personal">Número de DNI*</label>
                                <input class="form-control" type="text" name="nrodni_personal" id="nrodni_personal"
                                    value="<?= $row['nrodni_personal'] ?>">
                            </div>
                            <div class="col-md-4  position-relative">
                                <label class="form-label text-black-50" for="nrocuil_personal">Número de CUIL
                                    (xx-xxxxxxxx-x)*</label>
                                <input class="form-control" type="text" name="nrocuil_personal" id="nrocuil_personal"
                                    value="<?= $row['nrocuil_personal'] ?>">
                            </div>
                            <div class="col-md position-relative">
                                <label class="form-label text-black-50 text-nowrap" for="sexo_personal">Sexo</label>
                                <input class="form-control" type="text" name="sexo_personal" id="sexo_personal"
                                    value="<?= $row['sexo_personal'] ?>">

                            </div>

                            <div class="col-md-4  position-relative">
                                <label class="form-label text-black-50" for="fechanac_personal">Fecha de nacimiento
                                    (xx-xx-xxxx)*</label>
                                <input class="form-control" type="text" name="fechanac_personal" id="fechanac_personal"
                                    value="<?= $row['fechanac_personal'] ?>">
                            </div>
                            <div class="col-md-4  position-relative">
                                <label class="form-label text-black-50" for="paisnac_personal">País de
                                    nacimiento*</label>
                                <input class="form-control" type="text" name="paisnac_personal" id="paisnac_personal"
                                    value="<?= $row['paisnac_personal'] ?>">
                            </div>
                            <div class="col-md-4  position-relative">
                                <label class="form-label text-black-50" for="lugarnac_personal">Lugar de
                                    nacimiento</label>
                                <input class="form-control" type="text" name="lugarnac_personal" id="lugarnac_personal"
                                    value="<?= $row['lugarnac_personal'] ?>">
                            </div>
                            <div class="col-md-5  position-relative">
                                <label class="form-label text-black-50" for="fecha_designacion">Fecha de designacion
                                    (xx-xx-xxxx)*</label>
                                <input class="form-control" type="text" name="fecha_designacion" id="fecha_designacion"
                                    value="<?= $row['fecha_designacion'] ?>">
                            </div>
                            <div class="col-md-4  position-relative">
                                <label class="form-label text-black-50" for="nro_designacion">Número de
                                    designacion</label>
                                <input class="form-control" type="text" name="nro_designacion" id="nro_designacion"
                                    value="<?= $row['nro_designacion'] ?>">
                            </div>
                            <!--Fin Datos personales-->
                            <!--Domicilio-->
                            <h3 class="card-footer-text mt-2 mb-2 p-2 ">Domicilio</h3>

                            <div class="col-md-6  position-relative">
                                <label class="form-label text-black-50" for="paisdomic_personal">País</label>
                                <input class="form-control" type="text" name="paisdomic_personal"
                                    id="paisdomic_personal" value="<?= $row['paisdomic_personal'] ?>">
                            </div>
                            <div class="col-md-6  position-relative">
                                <label class="form-label text-black-50" for="provdomic_personal">Provincia</label>
                                <input class="form-control" type="text" name="provdomic_personal"
                                    id="provdomic_personal" value="<?= $row['provdomic_personal'] ?>">
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="calle_personal">Calle</label>
                                <input class="form-control" type="text" name="calle_personal" id="calle_personal"
                                    value="<?= $row['calle_personal'] ?>">
                            </div>
                            <div class="col-md position-relative">
                                <label class="form-label text-black-50" for="nro_personal">Número </label>
                                <input class="form-control" type="text" name="nro_personal" id="nro_personal"
                                    value="<?= $row['nro_personal'] ?>">
                            </div>

                            <div class="col-md position-relative">
                                <label class="form-label text-black-50" for="piso_personal">Piso</label>
                                <input class="form-control" type="text" name="piso_personal" id="piso_personal"
                                    value="<?= $row['piso_personal'] ?>">
                            </div>
                            <div class="col-md position-relative">
                                <label class="form-label text-black-50" for="depto_personal">Dpto</label>
                                <input class="form-control" type="text" name="depto_personal" id="depto_personal"
                                    value="<?= $row['depto_personal'] ?>">
                            </div>


                            <div class="col-md position-relative">
                                <label class="form-label text-black-50" for="edificio_personal">Edificio</label>
                                <input class="form-control" type="text" name="edificio_personal" id="edificio_personal"
                                    value="<?= $row['edificio_personal'] ?>">
                            </div>
                            <div class="col-md-5 position-relative">
                                <label class="form-label text-black-50" for="localidad_personal">Localidad</label>
                                <input class="form-control" type="text" name="localidad_personal"
                                    id="localidad_personal" value="<?= $row['localidad_personal'] ?>">
                            </div>

                            <div class="col-md-5 position-relative">
                                <label class="form-label text-black-50" for="partido_personal">Partido</label>
                                <input class="form-control" type="text" name="partido_personal" id="partido_personal"
                                    value="<?= $row['partido_personal'] ?>">
                            </div>
                            <div class="col-md position-relative">
                                <label class="form-label text-black-50" for="cp_personal">C.P.</label>
                                <input class="form-control" type="text" name="cp_personal" id="cp_personal"
                                    value="<?= $row['cp_personal'] ?>">
                            </div>
                            <!--Fin Domicilio-->
                            <!--Titulos académicos-->
                            <h3 class="card-footer-text mt-2 mb-2 p-2 ">Títulos</h3>


                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="titulo">Título de grado*</label>
                                <input class="form-control" type="text" name="titulo" id="titulo"
                                    value="<?= $row['titulo'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="titulo_institucion">Nombre de la
                                    Institucion</label>
                                <input class="form-control" type="text" name="titulo_institucion"
                                    id="titulo_institucion" value="<?= $row['titulo_institucion'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="anio_egreso">Año de egreso (xxxx) *</label>
                                <input class="form-control" type="text" name="anio_egreso" id="anio_egreso"
                                    value="<?= $row['anio_egreso'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="tipo_titulo">Tipo de título docente</label>
                                <input class="form-control" type="text" name="tipo_titulo" id="tipo_titulo"
                                    value="<?= $row['tipo_titulo'] ?>">
                            </div>
                            <!--Fin Titulos académicos-->
                            <!--Otros recorridos académicos-->
                            <h3 class="card-footer-text mt-2 mb-2 p-2 ">Otro recorrido académico</h3>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="carr1">Carrera</label>
                                <input class="form-control" type="text" name="carr1" id="carr1"
                                    value="<?= $row['carr1'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="carr1_institucion">Institucion</label>
                                <input class="form-control" type="text" name="carr1_institucion" id="carr1_institucion"
                                    value="<?= $row['carr1_institucion'] ?>">
                            </div>
                            <div class="col-md-3 position-relative">
                                <label class="form-label text-black-50 text-nowrap" for="carr1_estado">Estudio
                                    finalizado</label>
                                <input class="form-control" type="text" name="carr1_estado" id="carr1_estado"
                                    value="<?= $row['carr1_estado'] ?>">

                            </div>

                            <div class="col-md-3 position-relative">
                                <label class="form-label text-black-50" for="carr1_anioegreso">Año de egreso
                                    (xxxx)</label>
                                <input class="form-control" type="text" name="carr1_anioegreso" id="carr1_anioegreso"
                                    value="<?= $row['carr1_anioegreso'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="carr1_titulo">Titulo académico</label>
                                <input class="form-control" type="text" name="carr1_titulo" id="carr1_titulo"
                                    value="<?= $row['carr1_titulo'] ?>">
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="carr2">Carrera</label>
                                <input class="form-control" type="text" name="carr2" id="carr2"
                                    value="<?= $row['carr2'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="carr2_institucion">Institucion</label>
                                <input class="form-control" type="text" name="carr2_institucion" id="carr2_institucion"
                                    value="<?= $row['carr2_institucion'] ?>">
                            </div>
                            <div class="col-md-3 position-relative">
                                <label class="form-label text-black-50 text-nowrap" for="carr2_estado">Estudio
                                    finalizado</label>
                                <input class="form-control" type="text" name="carr2_estado" id="carr2_estado"
                                    value="<?= $row['carr2_estado'] ?>">

                            </div>

                            <div class="col-md-3 position-relative">
                                <label class="form-label text-black-50" for="carr2_anioegreso">Año de egreso
                                    (xxxx)</label>
                                <input class="form-control" type="text" name="carr2_anioegreso" id="carr2_anioegreso"
                                    value="<?= $row['carr2_anioegreso'] ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-black-50" for="carr2_titulo">Titulo académico</label>
                                <input class="form-control" type="text" name="carr2_titulo" id="carr2_titulo"
                                    value="<?= $row['carr2_titulo'] ?>">
                            </div>
                            <!--Otros recorridos académicos-->
                            <!--Documentacion-->
                            <h3 class="card-footer-text mt-2 mb-2 p-2 ">Documentación requerida</h3>
                            <div class="col-md-6  position-relative">
                                <h6 class="text-black-50">Documentacion requerida</h6><br>
                                <h6>Sólo seleccionar en caso de información incompleta</h6><br>
                                <label >DNI</label>
                                <?php

                                $DNICheckedValue = $row['DNIchecked'];
                                if ($DNICheckedValue != 1)
                                    echo " incompleto ";
                                ?>

                                <input type="checkbox" name="checkdni[]" value="<? $row['DNIchecked'] ?>"> <br>


                                <label >CV</label> 
                                <?php

                                $CVCheckedValue = $row['CVchecked'];
                                if ($CVCheckedValue != 1)
                                    echo " incompleto ";
                               
                                ?>
                                <input type="checkbox" name="check_lista[]" value="<? $row['CVchecked'] ?>"> <br>

                               <label >CUIL</label>
                                <?php

                                $CUILCheckedValue = $row['CUILchecked'];
                                if ($CUILCheckedValue != 1)
                                    echo " incompleto ";
                                ?>
                                <input type="checkbox" name="check_lista[]" value="<? $row['CUILchecked'] ?>"> <br>
                                <label >TITULO</label>
                                <?php

                                $TITCheckedValue = $row['TITchecked'];
                                if ($TITCheckedValue != 1)
                                    echo " incompleto ";
                                ?>

                                <input type="checkbox" name="check_lista[]" value="<? $row['TITchecked'] ?>"> <br>

                             

                            </div>

                            <div class="col-md-4 checks position-relative">
                                <div class="d-block mb-5 gap-2 align-content-start">
                                    <h6 class="text-black-50">Ingresar archivos</h6><br>
                                    <p class="text-black-50 ">Adjuntar documentación del docente</p>
                                    <a class="" href=#><button
                                            class="btn btn-primary px-4 nav-bar border-0 text-wrap">Adjuntar</button></a>
                                    <br><br>


                                    <a href=#><button
                                            class='btn btn-primary btn-lg menu-icon border-0 px-4'>Ver</button></a>
                                </div>
                            </div>
                            <!--Fin Documentacion-->
                            <!--Situación laboral-->
                            <div class="col-md-4 position-relative">
                                <label class="form-label text-black-50 text-nowrap" for="estado_personal">Estado
                                    Profesor*:</label>
                                <input class="form-control" type="text" name="estado_personal" id="estado_personal"
                                    value="<?= $row['estado_personal'] ?>">

                            </div>
                            <div class="col-md-4 position-relative">

                                <label class="form-label text-black-50" for="desde">Desde (xx/xx/xxxx)</label>
                                <input class="form-control" type="text" name="desde" id="desde">
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label text-black-50" for="hasta">Hasta (xx/xx/xxxx)</label>
                                <input class="form-control" type="text" name="hasta" id="hasta">
                            </div>
                            <!--Fin Situación laboral-->
                            <!--Observaciones-->
                            <div class="col-md-12 position-relative">
                                <label class="form-label text-black-50" for="observaciones">Observaciones</label><br>
                                <textarea name="observaciones" rows="2" cols="130" id="observaciones"></textarea>
                            </div>

                            <!--Fin Observaciones-->


                            <!-- </div> -->

                            <div class="col-md-6 offset-3 mb-5">
                                <div class="d-flex mb-5 gap-2 justify-content-between align-content-center">
                                    <a href="tablaspersonal.php"><button type="button"
                                            class='btn btn-primary menu-icon border-0 px-4'>Volver</button></a>
                                    <input class="btn btn-primary px-4 nav-bar border-0 text-wrap" type="submit"
                                        value="Editar">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>