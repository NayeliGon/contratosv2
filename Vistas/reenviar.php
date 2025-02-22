<?php

require_once '../Backend/conexion_bd.php';

$filtroNombre = $_GET['nombre'] ?? '';
$filtroTipo = $_GET['tipo_contrato'] ?? '';


$registrosPorPagina = 8;
$paginaActual = $_GET['pagina'] ?? 1;
$offset = ($paginaActual - 1) * $registrosPorPagina;

$queryCount = "SELECT COUNT(*) FROM (
    SELECT id_contrato FROM contratos_a WHERE nombre_emisor LIKE :nombre AND (:tipo = '' OR 'A' = :tipo)
    UNION ALL
    SELECT id_contrato FROM contrato_b WHERE nombre_emisor LIKE :nombre AND (:tipo = '' OR 'B' = :tipo)
    UNION ALL
    SELECT id_contrato FROM contrato_c WHERE nombre_emisor LIKE :nombre AND (:tipo = '' OR 'C' = :tipo)
) AS all_contratos";

$params = [
    ':nombre' => "%$filtroNombre%",
    ':tipo' => $filtroTipo
];

$totalStmt = $pdo->prepare($queryCount);
$totalStmt->execute($params);
$totalRegistros = $totalStmt->fetchColumn();
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

$query = "(
    SELECT id_contrato, 'A' AS tipo, nombre_emisor, fecha_creacion FROM contratos_a WHERE nombre_emisor LIKE :nombre AND (:tipo = '' OR 'A' = :tipo)
    UNION ALL
    SELECT id_contrato, 'B' AS tipo, nombre_emisor, fecha_creacion FROM contrato_b WHERE nombre_emisor LIKE :nombre AND (:tipo = '' OR 'B' = :tipo)
    UNION ALL
    SELECT id_contrato, 'C' AS tipo, nombre_emisor, fecha_creacion FROM contrato_c WHERE nombre_emisor LIKE :nombre AND (:tipo = '' OR 'C' = :tipo)
) ORDER BY fecha_creacion DESC LIMIT :offset, :limit";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':nombre', $params[':nombre']);
$stmt->bindParam(':tipo', $params[':tipo']);
$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', (int)$registrosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$contratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>













<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de contratos - Gestión de Contratos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/sidebar.css">
</head>

<body>

<div class="sidebar closed" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
        <a href="Dashboard.php" class="active"><i class="fas fa-home"></i> <span>Inicio</span></a>
        <a href="reenviar_contratos.php"><i class="fas fa-file-contract"></i> <span>Contratos Generados</span></a>
        <a href="usuarios.php"><i class="fas fa-users"></i> <span>Usuarios</span></a>
        <a href="../Backend/logout.php"><i class="fas fa-sign-out-alt"></i> <span>Cerrar Sesión</span></a>
</div>


    <div class="content" style="margin-left: 220px;">
        <header class="text-center">
            <h1 class="header-title">Contratos Registrados</h1>
        </header>

        <div id="content-area">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Filtros de Búsqueda</h6>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" value="<?php echo htmlspecialchars($filtroNombre); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="tipo_contrato" class="form-label">Tipo de Contrato</label>
                            <select class="form-select form-select-sm" name="tipo_contrato" id="tipo_contrato">
                                <option value="">Todos</option>
                                <option value="A" <?php echo $filtroTipo === 'A' ? 'selected' : ''; ?>>Contrato para Sociedad Anonima</option>
                                <option value="B" <?php echo $filtroTipo === 'B' ? 'selected' : ''; ?>>Contrato con Patente</option>
                                <option value="C" <?php echo $filtroTipo === 'C' ? 'selected' : ''; ?>>Contrato con RTU</option>
                                <option value="A" <?php echo $filtroTipo === 'D' ? 'selected' : ''; ?>>Contrato de Punto de Venta y Restaurantes</option>
                                <option value="B" <?php echo $filtroTipo === 'E' ? 'selected' : ''; ?>>Contrato con Distribuidores</option>
 
                            </select>
                        </div>
                        <div class="col-md-4 align-self-end">
                            <button type="submit" class="btn btn-primary btn-sm w-100">Aplicar Filtro</button>
                        </div>
                    </form>
                </div>
             </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Resultados de Contratos</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tipo de Contrato</th>
                                <th>Nombre</th>
                                <th>Fecha de Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($contratos)): ?>
                                <tr>
                                    <td colspan="4" class="text-center">No se encontraron contratos con los filtros aplicados.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($contratos as $contrato): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($contrato['tipo']); ?></td>
                                        <td><?php echo htmlspecialchars($contrato['nombre_emisor']); ?></td>
                                        <td><?php echo htmlspecialchars($contrato['fecha_creacion']); ?></td>
                                        <td>
                                            <!-- Botón para reenviar el enlace temporal -->
                                            <form action="reenviar_enlace.php" method="post" class="d-inline">
                                            <input type="hidden" name="id_contrato" value="<?php echo $contrato['id_contrato']; ?>">
                                            <input type="hidden" name="tipo_contrato" value="<?php echo $contrato['tipo']; ?>">
                                            <button type="button" class="btn btn-primary btn-sm reenviar-btn" data-id="<?php echo $contrato['id_contrato']; ?>" data-tipo="<?php echo $contrato['tipo']; ?>"><i class="fas fa-share-square"></i> Reenviar</button><?php

                                                $tipoContrato = $contrato['tipo'];
                                                $ruta = '';

                                                switch ($tipoContrato) {
                                                    case 'A':
                                                        $ruta = "../Docs/Documentos/repoA.php?id_contrato=" . $contrato['id_contrato'];
                                                        break;
                                                    case 'B':
                                                        $ruta = "../Docs/Documentos/repoB.php?id_contrato=" . $contrato['id_contrato'];
                                                        break;
                                                    case 'C':
                                                        $ruta = "../Docs/Documentos/repoC.php?id_contrato=" . $contrato['id_contrato'];
                                                        break;
                                                    case 'D':
                                                        $ruta = "../Docs/Documentos/repoD.php?id_contrato=" . $contrato['id_contrato'];
                                                        break;
                                                    case 'E':
                                                        $ruta = "../Docs/Documentos/repoE.php?id_contrato=" . $contrato['id_contrato'];
                                                        break;
                                                    default:
                                                        // En caso de que no sea un tipo esperado
                                                        $ruta = "../Docs/Documentos/repoA.php?id_contrato=" . $contrato['id_contrato'];
                                                }
                                                ?>

                                                <a href="<?php echo $ruta; ?>" class="btn btn-info btn-sm" title="Descargar" target="_blank">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-sm justify-content-center" style="margin-top: 0.3rem;">
                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                <li class="page-item <?php echo $i == $paginaActual ? 'active' : ''; ?>">
                                    <a class="page-link" href="?pagina=<?php echo $i; ?>&nombre=<?php echo htmlspecialchars($filtroNombre); ?>&tipo_contrato=<?php echo htmlspecialchars($filtroTipo); ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div id="edit-container"></div>
    </div>

    <footer>
        <p>Sistema de Gestión de Contratos &copy; 2025</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.reenviar-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id_contrato = this.getAttribute('data-id');
                const tipo_contrato = this.getAttribute('data-tipo');

                // AJAX para generar token
                fetch('generar_token.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id_contrato=${id_contrato}&tipo_contrato=${tipo_contrato}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Enlace Generado',
                                text: 'Copia el enlace o envíalo por WhatsApp:',
                                input: 'text',
                                inputValue: data.enlace,
                                showCancelButton: true,
                                confirmButtonText: 'Copiar enlace',
                                cancelButtonText: 'Enviar por WhatsApp'
                            }).then(result => {
                                if (result.isConfirmed) {
                                    navigator.clipboard.writeText(data.enlace);
                                    Swal.fire('Enlace copiado', '', 'success');
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    const whatsappLink = `https://wa.me/?text=${encodeURIComponent('Aquí tienes el enlace para acceder al contrato: ' + data.enlace)}`;
                                    window.open(whatsappLink, '_blank');
                                }
                            });
                        } else {
                            Swal.fire('Error', 'No se pudo generar el enlace. Inténtalo de nuevo.', 'error');
                        }
                    });
            });
        });

    document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#table-body tr'); 

    rows.forEach(row => {
        const rowText = row.innerText.toLowerCase(); 

        if (rowText.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

<!-- Incluir SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>