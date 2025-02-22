<?php
header('Content-Type: application/json');
include './conexion_bd.php';

$response = [];

if (isset($_POST['id_contrato'])) {
    try {
        $id_contrato = $_POST['id_contrato'];
        $nombre_emisor = $_POST['nombre_emisor'];
        $edad_emisor = $_POST['edad_emisor'];
        $dpi_emisor = $_POST['dpi_emisor'];
        $nombre_distribuidor = $_POST['nombre_distribuidor'];
        $edad_distribuidor = $_POST['edad_distribuidor'];
        $domicilio_distribuidor = $_POST['domicilio_distribuidor'];
        $dpi_distribuidor = $_POST['dpi_distribuidor'];
        $municipio = $_POST['municipio'];
        $departamento = $_POST['departamento'];
        $representante_legal = $_POST['representante_legal'];
        $entidad = $_POST['entidad'];
        $tipo_documento = $_POST['tipo_documento'];
        $notario = $_POST['notario'];
        $registro_mercantil = $_POST['registro_mercantil'];
        $folio = $_POST['folio'];
        $libro = $_POST['libro'];
        $nit = $_POST['nit'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $direccion_distribuidora = $_POST['direccion_distribuidora'];

        $sql = "UPDATE contrato_b SET 
                    nombre_emisor = :nombre_emisor,
                    edad_emisor = :edad_emisor,
                    dpi_emisor = :dpi_emisor,
                    nombre_distribuidor = :nombre_distribuidor,
                    edad_distribuidor = :edad_distribuidor,
                    domicilio_distribuidor = :domicilio_distribuidor,
                    dpi_distribuidor = :dpi_distribuidor,
                    municipio = :municipio,
                    departamento = :departamento,
                    representante_legal = :representante_legal,
                    entidad = :entidad,
                    tipo_documento = :tipo_documento,
                    notario = :notario,
                    registro_mercantil = :registro_mercantil,
                    folio = :folio,
                    libro = :libro,
                    nit = :nit,
                    fecha_inicio = :fecha_inicio,
                    fecha_fin = :fecha_fin,
                    direccion_distribuidora = :direccion_distribuidora
                WHERE id_contrato = :id_contrato";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre_emisor' => $nombre_emisor,
            ':edad_emisor' => $edad_emisor,
            ':dpi_emisor' => $dpi_emisor,
            ':nombre_distribuidor' => $nombre_distribuidor,
            ':edad_distribuidor' => $edad_distribuidor,
            ':domicilio_distribuidor' => $domicilio_distribuidor,
            ':dpi_distribuidor' => $dpi_distribuidor,
            ':municipio' => $municipio,
            ':departamento' => $departamento,
            ':representante_legal' => $representante_legal,
            ':entidad' => $entidad,
            ':tipo_documento' => $tipo_documento,
            ':notario' => $notario,
            ':registro_mercantil' => $registro_mercantil,
            ':folio' => $folio,
            ':libro' => $libro,
            ':nit' => $nit,
            ':fecha_inicio' => $fecha_inicio,
            ':fecha_fin' => $fecha_fin,
            ':direccion_distribuidora' => $direccion_distribuidora,
            ':id_contrato' => $id_contrato
        ]);

        $response['status'] = 'success';
        $response['message'] = 'Contrato actualizado correctamente';
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error en la actualización: ' . $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: No se proporcionó el ID del contrato.';
}

echo json_encode($response);
?>
