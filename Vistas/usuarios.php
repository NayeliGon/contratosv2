<?php
require '../backend/conexion_bd.php';

if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, apellidos, correo, usuario, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $correo, $usuario, $password]);
    header("Location: usuarios.php?mensaje=Usuario agregado");
}

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: usuarios.php?mensaje=Usuario eliminado");
}

if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $usuarioEditar = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['editar_usuario'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ?, usuario = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $correo, $usuario, $id]);
    header("Location: usuarios.php?mensaje=Usuario actualizado");
}


if (isset($_POST['cambiar_contraseña'])) {
    $id = $_POST['id_usuario'];
    $nueva_contraseña = password_hash($_POST['nueva_password'], PASSWORD_BCRYPT);

    $sql = "UPDATE usuarios SET password = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nueva_contraseña, $id]);
    header("Location: usuarios.php?mensaje=Contraseña cambiada");
}


$sql = "SELECT * FROM usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
require '../backend/conexion_bd.php';

if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, apellidos, correo, usuario, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $correo, $usuario, $password]);
    header("Location: usuarios.php?mensaje=Usuario agregado");
}

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: usuarios.php?mensaje=Usuario eliminado");
}

if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $usuarioEditar = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['editar_usuario'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ?, usuario = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $correo, $usuario, $id]);
    header("Location: usuarios.php?mensaje=Usuario actualizado");
}


if (isset($_POST['cambiar_contraseña'])) {
    $id = $_POST['id_usuario'];
    $nueva_contraseña = password_hash($_POST['nueva_password'], PASSWORD_BCRYPT);

    $sql = "UPDATE usuarios SET password = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nueva_contraseña, $id]);
    header("Location: usuarios.php?mensaje=Contraseña cambiada");
}


$sql = "SELECT * FROM usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contratos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/sidebar.css">
    <style>
        body {
            background-color: #d3d3d3;
        }
        .table th {
            background-color: #8B0000;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #b0b0b0;
        }
        .btn-add {
            background-color: #8B0000;
            color: white;
            border-radius: 5px;
            padding: 10px 15px;
        }
        .btn-add:hover {
            background-color: #A52A2A;
            color: white;
        }
        .btn-edit {
            background-color: #6c757d;
            color: white;
        }
        .btn-edit:hover {
            background-color: #5a6268;
            color: white;
        }
        .btn-password {
            background-color: #495057;
            color: white;
        }
        .btn-password:hover {
            background-color: #343a40;
            color: white;
        }
        .modal-header {
            background-color: #8B0000;
            color: white;
        }
        .btn-danger:hover {
            background-color: #a71d2a;
            color: white;
        }
    </style>
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

    
    <div class="content">
        <header class="text-center">
            <h1>Usuarios</h1>
        </header>

        <div class="container dashboard-container">
        <div class="container">
    <a href="#" class="btn btn-add mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Añadir Usuario</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= $usuario['nombre'] ?></td>
                <td><?= $usuario['apellidos'] ?></td>
                <td><?= $usuario['correo'] ?></td>
                <td><?= $usuario['usuario'] ?></td>
                <td>
                    <a href="usuarios.php?editar=<?= $usuario['id'] ?>" class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $usuario['id'] ?>">Editar</a>
                    <a href="usuarios.php?editar=<?= $usuario['id'] ?>" class="btn btn-password" data-bs-toggle="modal" data-bs-target="#changePasswordModal<?= $usuario['id'] ?>">Cambiar Contraseña</a>
                    <a href="usuarios.php?eliminar=<?= $usuario['id'] ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>

            <div class="modal fade" id="editUserModal<?= $usuario['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                <div class="mb-2">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" value="<?= $usuario['nombre'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label>Apellidos:</label>
                                    <input type="text" name="apellidos" class="form-control" value="<?= $usuario['apellidos'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label>Correo:</label>
                                    <input type="email" name="correo" class="form-control" value="<?= $usuario['correo'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label>Usuario:</label>
                                    <input type="text" name="usuario" class="form-control" value="<?= $usuario['usuario'] ?>" required>
                                </div>
                                <button type="submit" name="editar_usuario" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="changePasswordModal<?= $usuario['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cambiar Contraseña</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">
                                <div class="mb-2">
                                    <label>Nueva Contraseña:</label>
                                    <input type="password" name="nueva_password" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Confirmar Contraseña:</label>
                                    <input type="password" name="nueva_password" class="form-control" required>
                                </div>
                                <button type="submit" name="cambiar_contraseña" class="btn btn-warning">Cambiar Contraseña</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-2">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Apellidos:</label>
                        <input type="text" name="apellidos" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Correo:</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Usuario:</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Contraseña:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="agregar" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>

    <footer>
        <p>Sistema de Gestión de Contratos &copy; 2025</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('closed');
        }
    </script>
</body>

</html>





