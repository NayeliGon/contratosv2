<?php
// Configuración de la conexión a la base de datos usando PDO
$db_host = '34.203.242.2:3306';
$db_name = 'corpo_contratos';
$db_username = 'corpo';
$db_password = 'CorpoS24#'; 

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta para obtener los contratos de la tabla contrato_c
$sql = "SELECT id_contrato, nombre_emisor, dpi_emisor, 
               nombre_distribuidor, dpi_distribuidor, fecha_vigencia, 
               fecha_creacion 
        FROM contrato_c";

try {
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<div class="card mt-4" style="max-width: 720px; margin: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
    <div class="card-header text-center py-2 bg-primary text-white">
        <h6 class="mb-0">Listado de Contratos - Clientes y Distribuidores</h6>
    </div>
    <div class="card-body p-4">
        <!-- Campo de búsqueda -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por emisor, distribuidor, DPI, etc...">
        </div>

        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emisor</th>
                    <th>DPI Emisor</th>
                    <th>Distribuidor</th>
                    <th>DPI Distribuidor</th>
                    <th>Fecha Vigencia</th>
                    <th>Fecha Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>
                            <td>' . $row['id_contrato'] . '</td>
                            <td>' . $row['nombre_emisor'] . '</td>
                            <td>' . $row['dpi_emisor'] . '</td>
                            <td>' . $row['nombre_distribuidor'] . '</td>
                            <td>' . $row['dpi_distribuidor'] . '</td>
                            <td>' . $row['fecha_vigencia'] . '</td>
                            <td>' . $row['fecha_creacion'] . '</td>
                            <td class="d-flex justify-content-between">
                                <a href="../Docs/Documentos/repoC.php?id_contrato=' . $row['id_contrato'] . '" 
                                   class="btn btn-sm btn-info" title="Descargar" target="_blank">
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="btn btn-sm btn-warning me-1 btn-editar" 
                                        title="Editar" 
                                        data-id="' . $row['id_contrato'] . '">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" 
                                        onclick="eliminarContrato(' . $row['id_contrato'] . ')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="8" class="text-center">No se encontraron contratos.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<div id="contenido-principal"></div>

<script>
    // Filtrar filas de la tabla en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase(); // Convertir el valor de búsqueda a minúsculas
        const rows = document.querySelectorAll('#table-body tr'); // Seleccionar todas las filas de la tabla

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase(); // Convertir el texto de cada fila a minúsculas
            // Mostrar la fila si incluye el valor de búsqueda; de lo contrario, ocultarla
            row.style.display = rowText.includes(searchValue) ? '' : 'none';
        });
    });

    function guardarCambiosContrato() {
        const formData = new FormData(document.getElementById('editFormC'));

        $.ajax({
            url: '../Backend/editC.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire(
                        'Éxito',
                        response.message,
                        'success'
                    ).then(() => {
                        location.reload(); // Recargar la página para actualizar la lista de contratos
                    });
                } else {
                    Swal.fire(
                        'Error',
                        response.message,
                        'error'
                    );
                }
            },
            error: function() {
                Swal.fire(
                    'Error',
                    'Hubo un problema al actualizar el contrato.',
                    'error'
                );
            }
        });
    }

    // Manejo de la edición
    $(document).on('click', '.btn-editar', function() {
        var idContrato = $(this).data('id'); // Obtener el ID del contrato

        // Cargar la vista de edición en el div "contenido-principal"
        $.ajax({
            url: '../Backend/obtener_contratosC.php',
            type: 'GET',
            data: {
                id_contrato: idContrato
            }, // Pasar el ID del contrato
            success: function(response) {
                // Cargar el contenido en el div principal
                $('#contenido-principal').html(response);
            },
            error: function(err) {
                console.error('Error al cargar la página de edición:', err);
            }
        });
    });

    // Función para eliminar un contrato con SweetAlert y AJAX
    function eliminarContrato(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar solicitud AJAX para eliminar el contrato
                $.ajax({
                    url: '../Backend/eliminar_contrato.php',
                    type: 'POST',
                    data: {
                        id: id,
                        tipo: 'C'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Eliminado',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload(); // Recargar la página
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'Hubo un problema al eliminar el contrato.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>