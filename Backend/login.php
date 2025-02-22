<?php
session_start();
include 'conexion_bd.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    try {

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar la contraseña
            if (password_verify($contrasena, $usuario['password'])) {
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['usuario'] = $usuario['usuario'];

                // Redirigir al dashboard
                header("location: ../Vistas/Dashboard.php");
                exit;
            } else {
                echo '
                    <script>
                        alert("Contraseña incorrecta. Inténtalo de nuevo.");
                        window.location = "../index.php";
                    </script>';
            }
        } else {
            echo '
                <script>
                    alert("El correo no está registrado.");
                    window.location = "../index.php";
                </script>';
        }
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
?>
