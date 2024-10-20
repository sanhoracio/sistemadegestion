
<!DOCTYPE html>
<html>
<head>
    <title>Formulario con Pop-up</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    

    <script>


        // Simulación de envío de datos (reemplaza con tu lógica real)
        // Aquí realizarías la acción de guardar los datos

        Swal.fire({
            title: '¡Datos guardados!',
            text: 'Tus datos se han guardado correctamente.',
            icon: 'success',
            confirmButtonText: 'Continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "pagina_destino.php"; // Redirige a la página deseada
            }
        });
    });
</script>

</script>
</body>
</html>