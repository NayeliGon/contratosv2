<?php
include 'conexion_bd.php'; // Incluye la conexión PDO

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $usuario = $_POST['Usuario'];
    $password = $_POST['password'];

    try {
        // Verificar si el correo ya está registrado
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '
                <script>
                    alert("Error: El correo ya está registrado.");
                    window.location="../index.php";
                </script>';
            exit;
        }

        // Verificar si el usuario ya está registrado
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '
                <script>
                    alert("Error: El nombre de usuario ya está registrado.");
                    window.location="../index.php";
                </script>';
            exit;
        }

        // Hashear la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, correo, usuario, password) 
                               VALUES (:nombre, :apellidos, :correo, :usuario, :password)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            echo '
                <script>
                    alert("Usuario registrado correctamente.");
                    window.location="../index.php";
                </script>';
        } else {
            echo '
                <script>
                    alert("Error al registrar el usuario.");
                    window.location="../index.php";
                </script>';
        }
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
?>
