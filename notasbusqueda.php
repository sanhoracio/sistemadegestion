<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home-ISFT 225</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/styletablas.css">
</head>
<body>

    <?php
    require('./conexion.php');
    include "header.php";

        // Obtener los datos del formulario
    $searchTerm = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

    // Construir la consulta SQL
    $sql = "SELECT personal.id_personal, personal.nrocuil_personal, CONCAT(personal.apellido_personal, ' ', personal.nombre_personal) AS nombrecompleto, personal.nro_designacion, personal.estado_personal, 
        personal.DNIchecked, personal.CVchecked, personal.CUILchecked, personal.TITchecked,
        materia.denominacion_materia, carrera.nombre_carrera 
        FROM personal 
        LEFT JOIN materia_profesor ON personal.id_personal = materia_profesor.id_personal 
        LEFT JOIN materia ON materia_profesor.id_materia = materia.id_materia 
        LEFT JOIN materia_carrera ON materia.id_materia = materia_carrera.id_materia 
        LEFT JOIN carrera ON materia_carrera.id_carrera = carrera.id_carrera";

    if ($filter !== 'all' && !empty($searchTerm)) {
        $sql .= " WHERE $filter LIKE '%$searchTerm%'";
    }

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Error de consulta SQL: " . $conn->error);
    }

  
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
                    <h2 class="text-dark-subtle title">Buscar por filtro :</h2>
                    <h5 style='color: #9b9b9b;'>Ingrese solo el filtro que desea buscar</h5>
                    <!-- <?=$msge?> -->
                </div>

                    <div class="container">
                    <!-- Formulario de búsqueda y filtro -->
                    <form action="" method="GET" class="mb-3">
                        <div class="input-group">
                            <select class="form-select" name="filter">
                                <option value="all" <?php echo ($filter === 'all') ? 'selected' : ''; ?>>Todos los campos</option>
                                <option value="personal.nombre_personal" <?php echo ($filter === 'personal.nombre_personal') ? 'selected' : ''; ?>>Nombre</option>
                                <option value="personal.apellido_personal" <?php echo ($filter === 'personal.apellido_personal') ? 'selected' : ''; ?>>Apellido</option>
                                <option value="personal.nrocuil_personal" <?php echo ($filter === 'personal.nrocuil_personal') ? 'selected' : ''; ?>>CUIL</option>
                                <option value="materia.denominacion_materia" <?php echo ($filter === 'materia.denominacion_materia') ? 'selected' : ''; ?>>Materia</option>
                                <option value="carrera.nombre_carrera" <?php echo ($filter === 'carrera.nombre_carrera') ? 'selected' : ''; ?>>Carrera</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Buscar" name="buscar" value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </form>

                    <div class="container">

                        <a href="ingresarnotas.php" class="btn btn-primary custom-button mt-3">Ingresar a Notas</a>
                        <table class="table table-bordered table-striped mt-3 space-between">
                            <thead>

                                <tr>
                                    <th style='display:none'>ID personal</th>
                                    <th>CUIL</th>
                                    <th>Apellido y Nombre</th>
                                    <th>Materia</th>
                                    <th>Carrera</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                             
                                if ($result->num_rows > 0) {
                                    $datos = array();
                                    while ($row = $result->fetch_assoc()) {
                                        $datos[] = $row;

                                    }
                                    // Generar filas de la tabla
                                    foreach ($datos as $fila) {
                                        echo "<tr>";
                                        echo "<td style='display:none'>" . $fila['id_personal'] . "</td>";
                                        echo "<td>" . $fila['nrocuil_personal'] . "</td>";
                                        echo "<td>" . $fila['nombrecompleto'] . "</td>";
                                        echo "<td>" . $fila['denominacion_materia'] . "</td>";
                                        echo "<td>" . $fila['nro_designacion'] . "</td>";
                                        echo "<td>" . $fila['nombre_carrera'] . "</td>";
                                        echo "<td>" . $fila['estado_personal'] . "</td>";
                                        
                                    }
                                    
                                     //  echo "<td>" . $fila['repo_documentos'] . "</td>";
                                        // echo "<td>"."dj"."</td>";
                                
                                       

                                        echo "</tr>";
                                    

                                } else {
                                    echo "<h4>No hay datos para mostrar</h4>";

                                }
                                $conn->close()
                                    ?>
                            </tbody>


                        </table>
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

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-oer..."></script>
</body>

</html>