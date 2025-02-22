<?php
header('Content-Type: application/json'); // Asegura que la respuesta sea JSON
error_reporting(0); // Temporalmente desactiva la visualización de errores
include './conexion_bd.php';

$response = [];

if (isset($_POST['id_contrato'])) {
    try {
        // Recibe los datos del formulario
        $id_contrato = $_POST['id_contrato'];
        $nombre_emisor = $_POST['nombre_emisor'];
        $edad_emisor = $_POST['edad_emisor'];
        $dpi_emisor = $_POST['dpi_emisor'];
        $nombre_receptor = $_POST['nombre_receptor'];
        $edad_receptor = $_POST['edad_receptor'];
        $domicilio_receptor = $_POST['domicilio_receptor'];
        $dpi_receptor = $_POST['dpi_receptor'];
        $departamento_emision = $_POST['departamento_emision'];
        $municipio_emision = $_POST['municipio_emision'];
        $nombre_contratante = $_POST['nombre_contratante'];
        $fecha_patente = $_POST['fecha_patente'];
        $numero_inscripcion = $_POST['numero_inscripcion'];
        $folio_registro = $_POST['folio_registro'];
        $libro_registro = $_POST['libro_registro'];
        $actividad_economica = $_POST['actividad_economica'];
        $nit = $_POST['nit'];
        $tarifa_mensual = $_POST['tarifa_mensual'];
        $rango_documentos = $_POST['rango_documentos'];
        $cobro_unico = $_POST['cobro_unico'];
        $fecha_validez = $_POST['fecha_validez'];
        $direccion_contratante = $_POST['direccion_contratante'];

        // Consulta SQL para actualizar el contrato (omitimos `fecha_creacion`)
        $sql = "UPDATE contratos_a SET 
                    nombre_emisor = :nombre_emisor, 
                    edad_emisor = :edad_emisor, 
                    dpi_emisor = :dpi_emisor, 
                    nombre_receptor = :nombre_receptor, 
                    edad_receptor = :edad_receptor, 
                    domicilio_receptor = :domicilio_receptor, 
                    dpi_receptor = :dpi_receptor, 
                    departamento_emision = :departamento_emision, 
                    municipio_emision = :municipio_emision, 
                    nombre_contratante = :nombre_contratante, 
                    fecha_patente = :fecha_patente, 
                    numero_inscripcion = :numero_inscripcion, 
                    folio_registro = :folio_registro, 
                    libro_registro = :libro_registro, 
                    actividad_economica = :actividad_economica, 
                    nit = :nit, 
                    tarifa_mensual = :tarifa_mensual, 
                    rango_documentos = :rango_documentos, 
                    cobro_unico = :cobro_unico, 
                    fecha_validez = :fecha_validez, 
                    direccion_contratante = :direccion_contratante
                WHERE id_contrato = :id_contrato";

        // Preparar la declaración SQL
        $stmt = $pdo->prepare($sql);
        
        // Ejecutar la declaración con los parámetros
        $stmt->execute([
            ':nombre_emisor' => $nombre_emisor,
            ':edad_emisor' => $edad_emisor,
            ':dpi_emisor' => $dpi_emisor,
            ':nombre_receptor' => $nombre_receptor,
            ':edad_receptor' => $edad_receptor,
            ':domicilio_receptor' => $domicilio_receptor,
            ':dpi_receptor' => $dpi_receptor,
            ':departamento_emision' => $departamento_emision,
            ':municipio_emision' => $municipio_emision,
            ':nombre_contratante' => $nombre_contratante,
            ':fecha_patente' => $fecha_patente,
            ':numero_inscripcion' => $numero_inscripcion,
            ':folio_registro' => $folio_registro,
            ':libro_registro' => $libro_registro,
            ':actividad_economica' => $actividad_economica,
            ':nit' => $nit,
            ':tarifa_mensual' => $tarifa_mensual,
            ':rango_documentos' => $rango_documentos,
            ':cobro_unico' => $cobro_unico,
            ':fecha_validez' => $fecha_validez,
            ':direccion_contratante' => $direccion_contratante,
            ':id_contrato' => $id_contrato
        ]);

        // Respuesta de éxito
        $response['status'] = 'success';
        $response['message'] = 'Contrato actualizado correctamente';
    } catch (PDOException $e) {
        // Respuesta de error con el mensaje de la excepción
        $response['status'] = 'error';
        $response['message'] = 'Error en la actualización: ' . $e->getMessage();
    }
} else {
    // Respuesta en caso de que no se proporcione el ID del contrato
    $response['status'] = 'error';
    $response['message'] = 'Error: No se proporcionó el ID del contrato.';
}

// Devolver la respuesta en formato JSON y terminar el script
echo json_encode($response);
exit;
?>
