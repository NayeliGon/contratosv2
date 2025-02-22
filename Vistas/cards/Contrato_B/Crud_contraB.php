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

// Consulta para obtener los contratos de tipo B
$sql = "SELECT id_contrato, nombre_distribuidor, entidad, tipo_documento, 
               nit, fecha_inicio, fecha_fin, direccion_distribuidora, 
               fecha_creacion, fecha_actualizacion 
        FROM contrato_b";

try {
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<div class="card mt-4" style="max-width: 720px; margin: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
    <div class="card-header text-center py-2 bg-primary text-white">
        <h6 class="mb-0">Listado de Contratos - Distribuidores</h6>
    </div>
    <div class="card-body p-4">
        <!-- Campo de búsqueda -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por distribuidor, entidad, tipo de documento, etc...">
        </div>

        <!-- Tabla de contratos -->
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Distribuidor</th>
                    <th>Entidad</th>
                    <th>Tipo Documento</th>
                    <th>NIT</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>
                            <td>' . $row['id_contrato'] . '</td>
                            <td>' . $row['nombre_distribuidor'] . '</td>
                            <td>' . $row['entidad'] . '</td>
                            <td>' . $row['tipo_documento'] . '</td>
                            <td>' . $row['nit'] . '</td>
                            <td>' . $row['fecha_inicio'] . '</td>
                            <td>' . $row['fecha_fin'] . '</td>
                            <td class="d-flex justify-content-between">
                                <a href="../Docs/Documentos/repoB.php?id_contrato=' . $row['id_contrato'] . '" 
                                   class="btn btn-sm btn-info" title="Descargar" target="_blank">
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="btn btn-sm btn-warning me-1 btn-editar" data-id="' . $row['id_contrato'] . '" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" 
                                    onclick="eliminarContrato(' . $row['id_contrato'] . ', \'B\')">
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


<div id="edit-container" class="container mt-4"></div>



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

    $(document).on('click', '.btn-editar', function() {
        const idContrato = $(this).data('id');
        $.ajax({
            url: '../Backend/obtener_contratosB.php',
            type: 'GET',
            data: {
                id_contrato: idContrato
            },
            success: function(response) {
                $('#edit-container').html(response);
            },
            error: function(xhr) {
                console.error('Error al cargar el formulario de edición:', xhr.responseText);
                Swal.fire('Error', 'Hubo un problema al cargar el formulario de edición.', 'error');
            }
        });
    });

    //edicion de los contratos 
    $(document).on('submit', '#editFormB', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '../Backend/editB.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                try {
                    const result = typeof response === 'object' ? response : JSON.parse(response);

                    if (result.status === 'success') {
                        Swal.fire({
                            title: 'Guardado',
                            text: 'El contrato ha sido actualizado correctamente.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Recargar la página después de cerrar el diálogo de éxito
                        });
                    } else {
                        Swal.fire('Error', result.message || 'No se pudo actualizar el contrato.', 'error');
                    }
                } catch (e) {
                    console.error("JSON Parse Error:", e, response);
                    Swal.fire('Error', 'Error inesperado en el servidor. La respuesta no es JSON válido.', 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', 'Ocurrió un error al guardar los cambios.', 'error');
                console.error('Error en la actualización:', xhr.responseText);
            }
        });
    });


    // Función para eliminar un contrato tipo B utilizando AJAX y SweetAlert
    function eliminarContrato(id, tipo) {
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
                $.ajax({
                    url: '../Backend/eliminar_contrato.php',
                    type: 'POST',
                    data: {
                        id: id,
                        tipo: tipo
                    },
                    success: function(response) {
                        Swal.fire(
                            'Eliminado',
                            'El contrato ha sido eliminado.',
                            'success'
                        ).then(() => {
                            location.reload(); // Recargar la página para actualizar la lista
                        });
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