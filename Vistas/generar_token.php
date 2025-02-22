<?php
require_once '../Backend/conexion_bd.php';

// Validar que los datos necesarios están presentes
$id_contrato = $_POST['id_contrato'] ?? null;
$tipo_contrato = $_POST['tipo_contrato'] ?? null;

if (!$id_contrato || !$tipo_contrato) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit;
}

// Generar un token único y fecha de expiración
$token = bin2hex(random_bytes(16));
$fecha_expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Insertar el token en la base de datos
$query = "INSERT INTO contrato_tokens (id_contrato, tipo_contrato, token, fecha_expiracion, usado) 
          VALUES (:id_contrato, :tipo_contrato, :token, :fecha_expiracion, 0)";
$stmt = $pdo->prepare($query);
$stmt->execute(compact('id_contrato', 'tipo_contrato', 'token', 'fecha_expiracion'));

// Crear enlace dinámico adaptable al servidor y estructura de carpetas
$protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$baseUrl = $protocolo . '://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF']));
$enlace = "{$baseUrl}/Vistas/ver_contrato.php?token=$token";

// Enviar respuesta en JSON
echo json_encode(['status' => 'success', 'enlace' => $enlace]);
?>
