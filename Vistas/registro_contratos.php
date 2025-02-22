<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de contratos - Gestión de Contratos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--Este es el CDN del sweet alert 2-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../Assets/css/sidebar.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include "./side/sidebar_gs.php"; ?>

    <!-- Main Content -->
    <div class="content">
        <header class="text-center">
            <h1>Registro de contratos - Gestión de Contratos</h1>
        </header>

        <div id="content-area" class="mt-4">
            <div class="alert alert-info" role="alert">
                <h5 class="alert-heading">Instrucciones para seleccionar y gestionar contratos</h5>
                <p>Sigue los pasos a continuación para ver, editar o descargar un contrato:</p>
                <ol>
                    <li>Busca el contrato que deseas administrar en la tabla mostrada a continuación.</li>
                    <li>Puedes utilizar las opciones de <strong>Descargar</strong> <i class="fas fa-download"></i>, <strong>Editar</strong> <i class="fas fa-edit"></i>, o <strong>Eliminar</strong> <i class="fas fa-trash-alt"></i> según corresponda.</li>
                    <li>Para eliminar un contrato, asegúrate de que deseas proceder, ya que esta acción no se puede deshacer.</li>
                </ol>
                <hr>
                <p class="mb-0">Si necesitas ayuda adicional, contacta al soporte técnico.</p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.btn-editar', function() {
            var idContrato = $(this).data('id'); // Obtener el ID del contrato

            // Cargar el formulario de edición dinámicamente
            $.ajax({
                url: './cards/Contrato_C/Edit_ContraC.php',
                type: 'GET',
                data: {
                    id_contrato: idContrato
                }, // Enviar ID del contrato
                success: function(response) {
                    $('#contenido-principal').html(response); // Insertar contenido
                },
                error: function(err) {
                    console.error('Error al cargar la vista de edición:', err);
                }
            });
        });
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('closed');
        }


        $(document).ready(function() {
            // Interceptar el clic solo en los enlaces relacionados con contratos
            $('.sidebar-link').on('click', function(e) {
                e.preventDefault(); // Prevenir la recarga de página

                const target = $(this).data('target'); // Obtener el archivo objetivo

                if (target) {
                    // Usar AJAX para cargar el contenido dinámicamente en el área principal
                    $.ajax({
                        url: target,
                        type: 'GET',
                        success: function(response) {
                            $('#content-area').html(response); // Reemplazar el contenido
                        },
                        error: function() {
                            alert('Error al cargar el contenido.');
                        }
                    });
                } else {
                    alert('No se ha definido un archivo objetivo.');
                }
            });
        });
    </script>
</body>

</html>

