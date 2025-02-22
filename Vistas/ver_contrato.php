<?php
require_once '../Backend/conexion_bd.php';

// Obtener el token de la URL
$token = $_GET['token'] ?? null;

if (!$token) {
    die('Enlace inválido.');
}

// Consultar el token en la base de datos
$query = "SELECT * FROM contrato_tokens WHERE token = :token";
$stmt = $pdo->prepare($query);
$stmt->execute([':token' => $token]);
$tokenData = $stmt->fetch();

// Verificar si el token existe, no ha sido usado y no ha expirado
if (!$tokenData || $tokenData['usado'] == 1 || new DateTime() > new DateTime($tokenData['fecha_expiracion'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Enlace expirado o ya utilizado',
                text: 'El enlace que estás intentando acceder ha expirado o ya ha sido utilizado.',
                confirmButtonText: 'Cerrar'
            }).then(() => {
                window.close();
            });
        });
    </script>";
    exit;
}

// Marcar el token como usado para que el enlace expire después de abrirlo
$updateTokenQuery = "UPDATE contrato_tokens SET usado = 1 WHERE token = :token";
$updateTokenStmt = $pdo->prepare($updateTokenQuery);
$updateTokenStmt->execute([':token' => $token]);

// Aviso con SweetAlert antes de abrir el PDF
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'info',
            title: 'Aviso Importante',
            text: 'Al cerrar esta pestaña, el enlace no podrá abrirse de nuevo.',
            confirmButtonText: 'Abrir Contrato'
        }).then(() => {
            // Redirigir al PDF del contrato específico
            let tipoContrato = '{$tokenData['tipo_contrato']}';
            let idContrato = '{$tokenData['id_contrato']}';

            switch (tipoContrato) {
                case 'A':
                    window.location.href = '../Docs/Documentos/repoA.php?id_contrato=' + idContrato;
                    break;
                case 'B':
                    window.location.href = '../Docs/Documentos/repoB.php?id_contrato=' + idContrato;
                    break;
                case 'C':
                    window.location.href = '../Docs/Documentos/repoC.php?id_contrato=' + idContrato;
                    break;
                default:
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Tipo de contrato inválido.',
                        confirmButtonText: 'Cerrar'
                    }).then(() => {
                        window.close();
                    });
            }
        });
    });
</script>";
?>
