<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulario Estudiante</title>
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
    
    <!-- Complementos -->
    <?php include "creartablaestudiantes.php"; ?>  <!--si no se incluye no aparece el legajo en el input-->
    
    <!-- Contenedor principal -->
    <?php include "formingresarestudiantes.php"; ?>
  
    <!-- Fin de contenido -->
  </div>
  <!-- Fin de contenedor principal -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
  </script>

  <script type="text/javascript" src="./scripts/estudiantes.js"></script> 

</body>

</html>