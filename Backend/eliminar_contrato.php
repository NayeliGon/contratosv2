<?php
// Configuración de la conexión a la base de datos usando PDO
$db_host = '34.203.242.2:3306';
$db_name = 'corpo_contratos';
$db_username = 'corpo';
$db_password = 'CorpoS24#'; // Cambia si tienes contraseña configurada

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8"); // Asegura la codificación UTF-8
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se ha recibido el ID y el tipo de contrato
if (isset($_POST['id']) && isset($_POST['tipo'])) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    // Determinar la tabla en función del tipo de contrato
    switch ($tipo) {
        case 'A':
            $tabla = 'contratos_a';
            break;
        case 'B':
            $tabla = 'contrato_b';
            break;
        case 'C':
            $tabla = 'contrato_c';
            break;
        default:
            die("Tipo de contrato no válido.");
    }

    // Ejecutar la consulta de eliminación
    $sql = "DELETE FROM $tabla WHERE id_contrato = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([':id' => $id]);
        echo json_encode(['success' => true, 'message' => 'Contrato eliminado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el contrato: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
