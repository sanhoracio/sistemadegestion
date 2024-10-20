<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulario Edicion de Estudiante</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <link rel="stylesheet" href="./styles/style.css" type="text/css">
  <link rel="stylesheet" href="./styles/estudiantes.css" type="text/css">
</head>

<body>

  <?php include "header.php"; ?>

  <!-- Inicio del contenido -->
  <div class="d-flex flex-nowrap sidebar-height">

    <!--Aside Sidebar Menu -->
    <?php include "sidebar.php"; ?>

    <!-- Contenedor principal -->
    <?php
    // Configuración de la conexión a la base de datos
    require("conexion.php");

try {

    // Obtener el ID del registro a editar
    $id = $_GET['id_estudiante'];
    $id_estudiante = intval($id);

    // Preparar la consulta SELECT Consultar los datos
    $sql_estudiantes = "SELECT * FROM estudiantes WHERE id_estudiante=?";
    $stmt_estudiantes = $conn->prepare($sql_estudiantes);
    $stmt_estudiantes->bind_param("i", $id_estudiante);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$stmt_estudiantes) {
        throw new Exception("Error al preparar las consultas para acceder a los datos del estudiante.");
    } else {
        if (!$stmt_estudiantes->execute()) {
            throw new Exception("Error al ejecutar las consultas preparadas.");
        }
        // Obtener los resultados
        $res_estudiante = $stmt_estudiantes->get_result();
        // Obtener variables desde datos de la tabla estudiantes
        while ($fila_e = $res_estudiante->fetch_assoc()) {
            $nombres = $fila_e["nombres"];
            $apellido = $fila_e["apellidos"];
            $email = $fila_e["email"];
            $telefono = $fila_e["telefono"];
            $tipo_documento = $fila_e["tipo_documento"];
            $nro_documento = $fila_e["dni_estudiante"];
            $nro_legajo = $fila_e["nro_legajo"];
            $genero = $fila_e["genero"];
            $fecha_nac = $fila_e["fecha_nacimiento"];
            $pais_nac = $fila_e["pais_nacimiento"];
            $lugar_nac = $fila_e["lugar_nacimiento"];
            $familia_cargo = $fila_e["familiares_a_cargo"];
            $hijos = $fila_e["hijos"];
            $trabaja = $fila_e["trabaja"];

            // Domicilio de contacto (10 campos)
            $pais_dom = $fila_e["pais_dom"];
            $provincia = $fila_e["provincia"];
            $localidad = $fila_e["localidad"];
            $partido = $fila_e["partido"];
            $calle = $fila_e["calle"];
            $numero = $fila_e["numero"];
            $edificio = $fila_e["edificio"];
            $piso = $fila_e["piso"];
            $departamento = $fila_e["departamento"];
            $codigo_postal = $fila_e["codigo_postal"];

            // Estudios Secundarios (6 campos)
            $titulo_secundario = $fila_e["titulo_secundario"];
            $nombre_escuela = $fila_e["nombre_escuela"];
            $anio_egreso = $fila_e["anio_de_egreso"];
            $titulo_certificado = $fila_e["titulo_certificado"];
            $titulo_tecnico = $fila_e["titulo_tecnico"];
            $titulo_hab = $fila_e["titulo_hab"];

            // Documentación Requerida (2 booleanos y 4 campos)
            $doc_si = $fila_e["documentacion_completa"];
            $archivos = $fila_e["repositorio_documentacion"];
            $plan_carrera = $fila_e["plan_carrera"];
            $estado_inscripcion = $fila_e["estado_inscripcion"];
            $estado_estudiante = $fila_e["estado_estudiante"];
            $observaciones = $fila_e["observaciones"];
        }
    }

    // Preparar la consulta SELECT Consultar los datos
    $sql_carreras = "SELECT * FROM carreras_adicionales WHERE id_estudiante=?";
    $stmt_carreras = $conn->prepare($sql_carreras);
    $stmt_carreras->bind_param("i", $id_estudiante);

    if (!$stmt_carreras) {
        throw new Exception("Error al preparar las consultas para acceder a los datos del estudiante.");
    } else {
        if (!$stmt_carreras->execute()) {
            throw new Exception("Error al ejecutar las consultas preparadas.");
        }
        // Obtener los resultados
        $res_carreras = $stmt_carreras->get_result();

        $filasArray = array();
        $filas_c = array();
        
        // Obtener variables desde datos de la tabla carreras fetch_row() en vez de fetch_assoc() para que no sea un array asociativo
        while ($fila_c = $res_carreras->fetch_row()) {
            // Estudios Adicionales - Otro Recorrido Académico (5 campos opcionales)
            $carrera_1 = $fila_c[1]; // carrera 
            $institucion_1 = $fila_c[2]; // institucion 
            $estudio_finalizado_1 = $fila_c[3]; // estudio_finalizado
            $anio_egreso_1 = $fila_c[4]; // anio_egreso
            $titulo_academico_1 = $fila_c[5]; // titulo_academico
            $carrera_2 = $fila_c[6]; // carrera_2
            $institucion_2 = $fila_c[7]; // institucion_2 
            $estudio_finalizado_2 = $fila_c[8]; // estudio_finalizado_2  
            $anio_egreso_2 = $fila_c[9]; // anio_egreso_2
            $titulo_academico_2 = $fila_c[10]; //  titulo_academico_2 
            $filas_c = $fila_c;
        }

        $filasAJson = json_encode($filas_c, JSON_HEX_QUOT | JSON_HEX_APOS | JSON_UNESCAPED_UNICODE);
        
        // Verificar si la columna 'carrera' existe y no es null
        $c1 = is_null($carrera_1) ? true : false;

        // Verificar si la columna 'carrera2' existe y no es null
        $c2 = is_null($carrera_2) ? true : false;
    }

    if($c1 == false) {
      echo "<script>
        document.addEventListener('DOMContentLoaded', function(){
       	 agregarNuevaCarrera();
        });

        var carreraJson = '$filasAJson';
        var carreraArray = JSON.parse(carreraJson);
        
        //var carrera_1 = '$carrera_1';
      </script>"; 
    } else {
      echo "<script>
         var carreraJson ='';  
         let carreraArray = [];
      </script>";
    }

    if($c2 == false) {
      echo "<script> 
	document.addEventListener('DOMContentLoaded', function(){
       	 agregarNuevaCarrera();
        });
      </script>";
    }

    // Preparar la consulta SELECT Consultar los datos
    $sql_checkbox = "SELECT * FROM doc_check WHERE id_estudiante=?";
    $stmt_checkbox = $conn->prepare($sql_checkbox);
    $stmt_checkbox->bind_param("i", $id_estudiante);

    if (!$stmt_checkbox) {
        throw new Exception("Error al preparar las consultas para acceder a los datos del estudiante.");
    } else {
        if (!$stmt_checkbox->execute()) {
            throw new Exception("Error al ejecutar las consultas preparadas.");
        }

        // Obtener los resultados
        $res_checkbox = $stmt_checkbox->get_result();
        // Obtener variables desde datos de la tabla checkbox
        while ($fila_cb = $res_checkbox->fetch_assoc()) {
            // Documentacion necesaria
            $doc_dni = (bool)$fila_cb["doc_dni"];
            $doc_medica = (bool)$fila_cb["doc_medica"];
            $doc_analitico = (bool)$fila_cb["analitico"];
            $doc_nacimiento = (bool)$fila_cb["doc_nacimiento"];
        }

    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>

    <div class="col-9 offset-3 bg-light-subtle">
      <div class="d-block p-3 m-4 h-100">
        <main class="main">
          <div class="rect">
            <!-- Encabezado -->
            <!-- Titulo -->
            <div class="titulo">
              <h4>Ingreso estudiante</h4>
            </div>
            <h5 class="subtitulo">Ingresar nuevo estudiante Estudiante</h5>
          </div>

          <!-- Formulario -->
          <form class="formulario" name="formulario" method="POST" enctype="multipart/form-data" autocomplete="on"
            action="updateestudiantes.php?id_estudiante=<?php echo $id_estudiante; ?>">
            <!-- novalidate ESTA SECCION ES PARA PRODUCCION -->
            <div class="form">
              <div class="filas">
                <!-- Titulo -->
                <div class="titulo">
                  <h5>Datos Personales</h5>
                </div>
                <!-- Fila 1 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Nombre completo *</label>
                    <input type="text" class="form-control upLetra" id="nombres" name="nombres" placeholder="Nombres" value="<?php echo $nombres; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Apellido completo *</label>
                    <input type="text" class="form-control upLetra" id="apellido" name="apellido" placeholder="Apellido"
                      value="<?php echo $apellido; ?>" required />
                  </div>
                </div>

                <!-- Fila 2 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Correo electrónico *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="juan@ejemplo.com"
                      value="<?php echo $email; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Número de teléfono *</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono"
                      value="<?php echo $telefono; ?>" required />
                  </div>
                </div>

                <!-- Fila 3 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Tipo documento *</label>
                    <select class="form-control select" id="tipo_documento" name="tipo_documento" required>
                      <option <?php if ($tipo_documento == 'DNI') {
                                      echo 'selected';
                                    } ?> value="DNI" >DNI
                      </option>
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Número de documento *</label>
                    <input type="text" class="form-control" id="nro_documento" name="nro_documento"
                      placeholder="12345678" value="<?php echo $nro_documento; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Número de legajo *</label>
                    <input type="text" class="form-control" id="nro_legajo" name="nro_legajo"
                      <?php echo "value='$nro_legajo' placeholder='$nro_legajo'" ?> readonly/>
                  </div>
                </div>

                <!-- Fila 4 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Género *</label>
                    <select class="form-control select" id="genero" name="genero" required>
                      <option <?php if ($genero == 'Femenino') {
                                      echo 'selected';
                                    } ?> value="Femenino" >Femenino
                      </option>
                      <option <?php if ($genero == 'Masculino') {
                                      echo 'selected';
                                    } ?> value="Masculino" >Masculino
                      </option>
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Fecha de Nacimiento *</label>
                    <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="<?php echo $fecha_nac; ?>" required />
                      
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">País de Nacimiento *</label>
                    <input type="text" class="form-control" id="pais_nac" name="pais_nac" placeholder="País de Nacimiento" value="<?php echo $pais_nac; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Lugar de Nacimiento *</label>
                    <input type="text" class="form-control" id="lugar_nac" name="lugar_nac" placeholder="Lugar de Nacimiento" value="<?php echo $lugar_nac; ?>" required />
                  </div>
                </div>

                <!-- Fila 5 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Familia a Cargo *  <?php echo $familia_cargo?> </label>
                    <select class="form-control select" id="familia_cargo" name="familia_cargo" required>
                      <option <?php if ($familia_cargo == 1) {
                                        echo 'selected';
                                    } ?> value="Si" >Si
                      </option>
                      <option <?php if ($familia_cargo == 0) {
                                        echo 'selected';
                                    } ?> value="No" >No
                      </option>
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Hijos *</label>
                    <select class="form-control select" id="hijos" name="hijos" required>
                      <option <?php if ($hijos == '0') {
                                        echo 'selected';
                                    } ?> value="0" >0
                      </option>
                      <option <?php if ($hijos == '1') {
                                        echo 'selected';
                                    } ?> value="1" >1
                      </option>
                      <option <?php if ($hijos == '2') {
                                        echo 'selected';
                                    } ?> value="2" >2
                      </option>
                      <option <?php if ($hijos == '3') {
                                        echo 'selected';
                                    } ?> value="3" >3
                      </option>
                      <option <?php if ($hijos == '4 o más') {
                                        echo 'selected';
                                    } ?> value="4 o más" >4 o más
                      </option>
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Trabaja actualmente *</label>
                    <select class="form-control select" id="trabaja" name="trabaja" required>
                      <option <?php if ($trabaja == 1) {
                                      echo 'selected';
                                    } ?> value="Si" >Si
                      </option>
                      <option <?php if ($trabaja == 0) {
                                      echo 'selected';
                                    } ?> value="No" >No
                      </option>
                    </select>
                  </div>
                </div>

                <!-- Titulo -->
                <div class="titulo">
                  <h5>Domicilio</h5>
                </div>
                <!-- Fila 6 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">País *</label>
                    <input type="text" class="form-control upLetra" id="pais_dom" name="pais_dom" placeholder="País" value="<?php echo $pais_dom; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Provincia *</label>
                    <input type="text" class="form-control upLetra dnone" id="provincias" name="provincia" placeholder="Provincia" value="<?php echo $provincia; ?>" required />
                    <select class="form-control select" id="provincias_select" name="provincia" value="<?php echo $provincia; ?>" required ></select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Partido *</label>
                    <input type="text" class="form-control upLetra dnone" id="partido" name="partido" placeholder="Partido" value="<?php echo $partido; ?>" required />
                    <select class="form-control select" id="municipios_select" name="partido" value="<?php echo $partido; ?>" required ></select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Localidad *</label>
                    <input type="text" class="form-control upLetra dnone" id="localidad" name="localidad" placeholder="Localidad" value="<?php echo $localidad; ?>" required />
                    <select class="form-control select" id="localidad_select" name="localidad" value="<?php echo $localidad; ?>" required></select>
                  </div>
                </div>

                <!-- Fila 7 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Calle *</label>
                    <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" value="<?php echo $calle; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Número *</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Número 123" value="<?php echo $numero; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Piso</label>
                    <input type="text" class="form-control" id="piso" name="piso" placeholder="1" value="<?php echo $piso; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Departamento</label>
                    <input type="text" class="form-control" id="departamento" name="departamento"
                      placeholder="Departamento A" value="<?php echo $departamento; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Edificio</label>
                    <input type="text" class="form-control" id="edificio" name="edificio" 
                      placeholder="Edificio ABC" value="<?php echo $edificio; ?>" required />
                  </div>
                </div>

                <!-- Fila 8 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Código Postal *</label>
                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal"
                      placeholder="CP 1234" value="<?php echo $codigo_postal; ?>" required />
                  </div>
                </div>

                <!-- Titulo -->
                <div class="titulo">
                  <h5>Estudios Secundarios</h5>
                </div>
                <!-- Fila 9 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Escuela secundaria *</label>
                    <input type="text" class="form-control" id="nombre_escuela" name="nombre_escuela"
                      placeholder="Escuela Secundaria N° 123" value="<?php echo $nombre_escuela; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Título nivel secundario *</label>
                    <input type="text" class="form-control" id="titulo_secundario" name="titulo_secundario"
                      placeholder="Título nivel secundario" value="<?php echo $titulo_secundario; ?>" required />
                  </div>
                </div>

                <!-- Fila 10 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Año de egreso *</label>
                    <input type="number" class="form-control" id="anio_egreso" name="anio_egreso" min="1900" max="2050"
                      placeholder="2023" value="<?php echo $anio_egreso; ?>" required />
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Certificado del título</label>
                    <select class="form-control select" id="titulo_certificado" name="titulo_certificado" required>
                      <option <?php if ($titulo_certificado == 'Título legalizado') {
                                        echo 'selected';
                                    } ?> value="Título legalizado" >Título legalizado
                      </option>
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Título Técnico*</label>
                    <select class="form-control select" id="titulo_tecnico" name="titulo_tecnico" required>
                      <option <?php if ($titulo_tecnico == 1) {
                                      echo 'selected';
                                    } ?> value="Si" >Si
                      </option>
                      <option <?php if ($titulo_tecnico == 0) {
                                      echo 'selected';
                                    } ?> value="No" >No
                      </option>
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Título técnico habilitante*</label>
                    <select class="form-control select" id="titulo_hab" name="titulo_hab" required>
                      <option <?php if ($titulo_hab == 1) {
                                      echo 'selected';
                                    } ?> value="Si" >Si
                      </option>
                      <option <?php if ($titulo_hab == 0) {
                                      echo 'selected';
                                    } ?> value="No" >No
                      </option>
                    </select>
                  </div>
                </div>

                <!-- Continuación del formulario -->

                <!-- Titulo -->
                <div class="titulo">
                  <h5>Otro Recorrido Académico</h5>
                </div>

                <!-- Fila 11 -->
                <!-- Agrega un contenedor donde se insertarán los nuevos divs -->
                <div id="contenedorEstudiosFinalizados">
                <!-- Aquí se insertarán los campos de estudio adicional si es necesario -->
                </div>

                <!-- Fila 12 -->
                <div class="fila">
                  <!-- Agrega este botón al final de tu formulario -->
                  <button id="addEstudioBtn" class="btnf btn-agregar btn-bg btn btn-primary" type="button">Agregar Nuevo Estudio
                    Finalizado
                  </button>
                </div>

                <!-- Titulo -->
                <div class="titulo">
                  <h5>Documentación Requerida</h5>
                </div>

                <!-- Fila 13 -->
                <!-- Lista de checkboxes -->
                <div class="fila">
                  <div class="divf-btn w50 centrarflex">
                    <div class="btn-form">
                      <ul>
                        <li><input type="checkbox" id="dni" name="doc_dni" <?php if ($doc_dni) { 
                                                                                    echo 'checked';
                                                                                  } ?> > DNI (frente y dorso)
                        </li>
                        <li><input type="checkbox" id="certificado_medico" name="doc_medica" <?php if ($doc_medica) {
                                                                                                     echo 'checked';
                                                                                                    } ?> > Certificado Médico
                        </li>
                        <li><input type="checkbox" id="analitico" name="doc_analitico" <?php if ($doc_analitico) {
                                                                                                echo 'checked';
                                                                                              } ?> > Analítico
                        </li>
                        <li><input type="checkbox" id="partida" name="doc_nacimiento" <?php if ($doc_nacimiento) {
                                                                                              echo 'checked';
                                                                                             } ?> > Partida Nacimiento
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- Botones adjuntar/ver -->
                  <div class="divf-btn w50">
                    <div class="div-adj w50 centrarbox">
                      <h6>Adjuntar Documentación</h6>
                      <button type="button" id="btn-adj" class="btnf btn-adj btn-width btn btn-primary">Adjuntar</button>
                      <!-- Multiple Archivos RECORDAR AGREGAR required-->
                      <input type="file" name="adjunto[]" class="btnf btn-adj btn-width dnone" id="adjunto" multiple >
                      <button type="button" class="btnf btn-ver btn-bg btn-width btn btn-primary" id="ver" onclick="location.href='https://drive.google.com/drive/folders/1MG8j4iMAMCsXirLqyHkPY3qqjWxwD6IR'">Ver</button>
                    </div>
                  </div>
                </div>
             
                <!-- Fila 14 -->
                <div class="fila">
                  <div class="columna">
                    <label class="form-label text-black-50">Plan de Carrera *</label>
                    <select class="form-control select" id="plan_carrera" name="plan_carrera" required>
                      <option <?php if ($plan_carrera == 'Seleccione') {
                                      echo 'selected';
                                    } ?> value="Seleccione" >Seleccione
                      </option>
                      <!-- Agrega las opciones de tu plan de carrera aquí -->
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Estado Inscripción *</label>
                    <select class="form-control select" id="estado_inscripcion" name="estado_inscripcion" required>
                      <option <?php if ($estado_inscripcion == 'Completo') {
                                      echo 'selected';
                                    } ?> value="Completo" >Completo
                      </option>
                      <option <?php if ($estado_inscripcion == 'Incompleto') {
                                      echo 'selected';
                                    } ?> value="Incompleto" >Incompleto
                      </option>
                      <!-- Agrega las opciones de estado de inscripción aquí -->
                    </select>
                  </div>

                  <div class="columna">
                    <label class="form-label text-black-50">Estado estudiante *</label>
                    <select class="form-control select" id="estado_estudiante" name="estado_estudiante" required>
                      <option <?php if ($estado_estudiante == 'Activo') {
                                      echo 'selected';
                                    } ?> value="Activo" >Activo
                      </option>
                      <option <?php if ($estado_estudiante == 'Inactivo') {
                                      echo 'selected';
                                    } ?> value="Inactivo" >Inactivo
                      </option>
                      <!-- Agrega las opciones de estado de estudiante aquí -->
                    </select>
                  </div>
                </div>

                <!-- Fila 15 -->
                <div class="fila">
                  <div class="columna" id="div-observaciones">
                    <label class="form-label text-black-50">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" value="<?php echo $observaciones; ?>" ></textarea>
                  </div>
                </div>

                <!-- Botones -->
                <div class="btn-form centrarflex">
                <div class="div-btn w50 centrarflex">
                    <a class="btn-width btn btn-primary nav-bar border-0" href="https://app.isft225.edu.ar/tablaestudiantes.php">VOLVER</a>  
                  </div>
                  <div class="div-btn w50 centrarflex">
                    <button class="btn-width btn-bg btn btn-primary border-0" id="guardarDatos" type="submit">GUARDAR</button>
                  </div>
                </div>
              </div>
            </div> 
          </form>
        </main>
      </div>
    </div>

    <!-- Fin de contenido -->
  </div>
  <!-- Fin de contenedor principal -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
  </script>

  <script type='text/javascript' src='./scripts/carrerasadicionales.js'></script>
  <script type="text/javascript" src="./scripts/estudiantes.js"></script>

</body>
</html>