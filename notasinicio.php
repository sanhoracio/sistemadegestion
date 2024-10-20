<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home-ISFT 225</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<main>
    <!-- Contenedor principal -->
    <div class="d-flex flex-nowrap sidebar-height"> 
      <!-- Aside/Wardrobe/Sidebar Menu --> 
      <?php
      include "sidebar.php"; 
        ?>  
      <div class="col-9 offset-3 bg-light-subtle pt-5">
            <div class="d-block p-3 m-4 h-100 ">
                <h3 class="card-footer-text mt-2 mb-5 p-2">Notas</h3>
                <div class="m-4">
                    <h2 class="text-dark-subtle title">MENÚ DEL "MÓDULO NOTAS"</h2>
                </div>

                <div>
                   
                        <!-- linea divisoria -->
                        <br><hr><br><br>

                        <!-- Botones de direccionamiento -->
                         <div class="col-md-6 offset-2 mb-5">
                            <div class="d-flex mb-5 gap-2 justify-content-between align-content-center">
                                <a class="" href="ingresarnotas.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">INGRESAR</button></a>                     
                                <a class="" href="buscanotas.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">BUSQUEDA</button></a>                     
                                <a class="" href="estadisticanotas.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">ESTADÍSTICA</button></a>                                                     
                                <a class="" href="index.php"><button type="button" class="btn btn-primary menu-icon border-0 px-4">INICIO</button></a>                     
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