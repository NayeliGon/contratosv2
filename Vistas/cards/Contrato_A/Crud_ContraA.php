<?php
// Configuración de la conexión a la base de datos usando PDO
$db_host = '34.203.242.2:3306';
$db_name = 'corpo_contratos';
$db_username = 'corpo';
$db_password = 'CorpoS24#'; 

try {
    // Crear la conexión usando PDO
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8"); // Asegura la codificación UTF-8
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta SQL para obtener los contratos de la tabla contratos_a
$sql = "SELECT id_contrato, nombre_receptor, tarifa_mensual, rango_documentos, fecha_validez, fecha_creacion FROM contratos_a";

try {
    $result = $pdo->query($sql); // Ejecutar la consulta
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<div class="card mt-3" style="max-width: 800px; margin: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <!-- Formulario de búsqueda -->
    <div class="p-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por receptor, tarifa, rango o fecha...">
    </div>

    <!-- Tabla de contratos -->
    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Receptor</th>
                <th>Tarifa Mensual</th>
                <th>Rango</th>
                <th>Fecha de Validez</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>
                    <td>' . $row['id_contrato'] . '</td>
                    <td>' . $row['nombre_receptor'] . '</td>
                    <td>Q' . number_format($row['tarifa_mensual'], 2) . '</td>
                    <td>' . $row['rango_documentos'] . '</td>
                    <td>' . $row['fecha_validez'] . '</td>
                    <td>' . $row['fecha_creacion'] . '</td>
                    <td>
                        <a href="../Docs/Documentos/repoA.php?id_contrato=' . $row['id_contrato'] . '" class="btn btn-info btn-sm" title="Descargar" target="_blank">
                            <i class="fas fa-download"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-editar" data-id="' . $row['id_contrato'] . '">
                            <i class="fas fa-edit"></i> 
                        </button>
                        <button class="btn btn-danger btn-sm btn-eliminar" data-id="' . $row['id_contrato'] . '" data-tipo="A">
                            <i class="fas fa-trash-alt"></i> 
                        </button>
                    </td>
                </tr>';
                }
            } else {
                echo '<tr><td colspan="7" class="text-center">No se encontraron contratos.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>


<!-- Contenedor donde se cargará el formulario de edición -->
<div id="edit-container" class="container mt-4"></div>

<div class="d-flex justify-content-end mt-3">
    <button class="btn btn-success" onclick="agregarRegistro()">
        <i class="fas fa-plus"></i> Agregar Registro
    </button>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase(); // Convierte el valor de búsqueda a minúsculas
    const rows = document.querySelectorAll('#table-body tr'); // Selecciona todas las filas de la tabla

    rows.forEach(row => {
        const rowText = row.innerText.toLowerCase(); // Convierte el texto de cada fila a minúsculas

        // Muestra la fila si incluye el valor de búsqueda, de lo contrario, ocúltala
        if (rowText.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

    // Función para manejar el evento de agregar un nuevo registro
    function agregarRegistro() {
        window.location.href = './ContratoA.php';
    }

    // Event listener para el botón de eliminación
    $(document).on('click', '.btn-eliminar', function() {
        const id = $(this).data('id');
        const tipo = $(this).data('tipo');
        eliminarContrato(id, tipo);
    });

    // Función para eliminar un contrato con SweetAlert y AJAX
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
                        try {
                            const result = typeof response === 'object' ? response : JSON.parse(response);
                            if (result.success) {
                                Swal.fire('Eliminado', result.message, 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', result.message, 'error');
                            }
                        } catch (e) {
                            console.error('Error parsing JSON:', e, response);
                            Swal.fire('Error', 'Respuesta del servidor no válida.', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Hubo un problema al eliminar el contrato.', 'error');
                        console.error('Error en la eliminación:', xhr.responseText);
                    }
                });
            }
        });
    }

    // Cargar el formulario de edición en el contenedor edit-container
    $(document).on('click', '.btn-editar', function() {
        const idContrato = $(this).data('id');
        $.ajax({
            url: '../Backend/obtener_contrato.php',
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

    // Manejar el evento de guardado en el formulario de edición
    $(document).on('submit', '#editForm', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        
        $.ajax({
            url: '../Backend/editA.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log("Server Response:", response); // Verificar la respuesta antes de analizarla
                try {
                    // Verifica si la respuesta ya es un objeto, si no, intenta parsearlo
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
</script>

<!-- Incluir SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
