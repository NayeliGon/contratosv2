<?php
header('Content-Type: application/json');
include 'conexion_bd.php';

$response = [];

if (isset($_POST['id_contrato'])) {
    try {
        // Variables de entrada de los campos
        $id_contrato = $_POST['id_contrato'];
        $edadCorpo = $_POST['edadCorpo'];
        $nombreEmisor = $_POST['nombreEmisor'];
        $edadEmisor = $_POST['edadEmisor'];
        $dpiEmisor = $_POST['dpiEmisor'];
        $departamentoEmisionEmisor = $_POST['departamentoEmisor'];
        $municipioEmisionEmisor = $_POST['municipioEmisor'];
        $representanteEmisor = $_POST['representanteEmisor'];
        $entidadEmisor = $_POST['entidadEmisor'];
        $acreditaEmisor = $_POST['acreditaEmisor'];
        $notarioEmisor = $_POST['notarioEmisor'];
        $fechaAcreditaEmisor = $_POST['fechaAcreditaEmisor'];
        $registroMercantilEmisor = $_POST['registroMercantilEmisor'];
        $folioEmisor = $_POST['folioEmisor'];
        $libroEmisor = $_POST['libroEmisor'];
        $direccionEmisor = $_POST['direccionEmisor'];
        $nombreDistribuidor = $_POST['nombreDistribuidor'];
        $edadDistribuidor = $_POST['edadDistribuidor'];
        $dpiDistribuidor = $_POST['dpiDistribuidor'];
        $departamentoDistribuidor = $_POST['departamentoDistribuidor'];
        $municipioDistribuidor = $_POST['municipioDistribuidor'];
        $representanteDistribuidor = $_POST['representanteDistribuidor'];
        $entidadDistribuidor = $_POST['entidadDistribuidor'];
        $acreditaDistribuidor = $_POST['acreditaDistribuidor'];
        $notarioDistribuidor = $_POST['notarioDistribuidor'];
        $fechaAcreditaDistribuidor = $_POST['fechaAcreditaDistribuidor'];
        $registroMercantilDistribuidor = $_POST['registroMercantilDistribuidor'];
        $folioDistribuidor = $_POST['folioDistribuidor'];
        $libroDistribuidor = $_POST['libroDistribuidor'];
        $actividadEconomica = $_POST['actividadEconomica'];
        $nitDistribuidor = $_POST['nitDistribuidor'];
        $fechaVigencia = $_POST['fechaVigencia'];
        $direccionDistribuidor = $_POST['direccionDistribuidor'];

        // Consulta para actualizar el contrato
        $sql = "UPDATE contrato_c SET 
                    edad_corpo = :edadCorpo,
                    nombre_emisor = :nombreEmisor,
                    edad_emisor = :edadEmisor,
                    dpi_emisor = :dpiEmisor,
                    departamento_emision_emisor = :departamentoEmisionEmisor,
                    municipio_emision_emisor = :municipioEmisionEmisor,
                    representante_emisor = :representanteEmisor,
                    entidad_emisor = :entidadEmisor,
                    acredita_emisor = :acreditaEmisor,
                    notario_emisor = :notarioEmisor,
                    fecha_acredita_emisor = :fechaAcreditaEmisor,
                    registro_mercantil_emisor = :registroMercantilEmisor,
                    folio_emisor = :folioEmisor,
                    libro_emisor = :libroEmisor,
                    direccion_emisor = :direccionEmisor,
                    nombre_distribuidor = :nombreDistribuidor,
                    edad_distribuidor = :edadDistribuidor,
                    dpi_distribuidor = :dpiDistribuidor,
                    departamento_emision_distribuidor = :departamentoDistribuidor,
                    municipio_emision_distribuidor = :municipioDistribuidor,
                    representante_distribuidor = :representanteDistribuidor,
                    entidad_distribuidor = :entidadDistribuidor,
                    acredita_distribuidor = :acreditaDistribuidor,
                    notario_distribuidor = :notarioDistribuidor,
                    fecha_acredita_distribuidor = :fechaAcreditaDistribuidor,
                    registro_mercantil_distribuidor = :registroMercantilDistribuidor,
                    folio_distribuidor = :folioDistribuidor,
                    libro_distribuidor = :libroDistribuidor,
                    actividad_economica = :actividadEconomica,
                    nit_distribuidor = :nitDistribuidor,
                    fecha_vigencia = :fechaVigencia,
                    direccion_distribuidor = :direccionDistribuidor
                WHERE id_contrato = :id_contrato";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':edadCorpo' => $edadCorpo,
            ':nombreEmisor' => $nombreEmisor,
            ':edadEmisor' => $edadEmisor,
            ':dpiEmisor' => $dpiEmisor,
            ':departamentoEmisionEmisor' => $departamentoEmisionEmisor,
            ':municipioEmisionEmisor' => $municipioEmisionEmisor,
            ':representanteEmisor' => $representanteEmisor,
            ':entidadEmisor' => $entidadEmisor,
            ':acreditaEmisor' => $acreditaEmisor,
            ':notarioEmisor' => $notarioEmisor,
            ':fechaAcreditaEmisor' => $fechaAcreditaEmisor,
            ':registroMercantilEmisor' => $registroMercantilEmisor,
            ':folioEmisor' => $folioEmisor,
            ':libroEmisor' => $libroEmisor,
            ':direccionEmisor' => $direccionEmisor,
            ':nombreDistribuidor' => $nombreDistribuidor,
            ':edadDistribuidor' => $edadDistribuidor,
            ':dpiDistribuidor' => $dpiDistribuidor,
            ':departamentoDistribuidor' => $departamentoDistribuidor,
            ':municipioDistribuidor' => $municipioDistribuidor,
            ':representanteDistribuidor' => $representanteDistribuidor,
            ':entidadDistribuidor' => $entidadDistribuidor,
            ':acreditaDistribuidor' => $acreditaDistribuidor,
            ':notarioDistribuidor' => $notarioDistribuidor,
            ':fechaAcreditaDistribuidor' => $fechaAcreditaDistribuidor,
            ':registroMercantilDistribuidor' => $registroMercantilDistribuidor,
            ':folioDistribuidor' => $folioDistribuidor,
            ':libroDistribuidor' => $libroDistribuidor,
            ':actividadEconomica' => $actividadEconomica,
            ':nitDistribuidor' => $nitDistribuidor,
            ':fechaVigencia' => $fechaVigencia,
            ':direccionDistribuidor' => $direccionDistribuidor,
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
