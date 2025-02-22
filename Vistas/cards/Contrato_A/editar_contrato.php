<?php
require '../../../Backend/conexion_bd.php';

$id_contrato = $_POST['id_contrato'];
$nombre_receptor = $_POST['nombre_receptor'];
$tarifa_mensual = $_POST['tarifa_mensual'];
$rango_documentos = $_POST['rango_documentos'];
$fecha_validez = $_POST['fecha_validez'];

$sql = "UPDATE contratos_a SET nombre_receptor = :nombre_receptor, tarifa_mensual = :tarifa_mensual, rango_documentos = :rango_documentos, fecha_validez = :fecha_validez WHERE id_contrato = :id_contrato";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        ':nombre_receptor' => $nombre_receptor,
        ':tarifa_mensual' => $tarifa_mensual,
        ':rango_documentos' => $rango_documentos,
        ':fecha_validez' => $fecha_validez,
        ':id_contrato' => $id_contrato
    ]);
    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
