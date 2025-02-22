<?php
// Incluir la configuración de la conexión a la base de datos
include "conexion_bd.php";

// Asegurarse de que $pdo esté disponible en este archivo
global $pdo;

// Variable para almacenar el mensaje de alerta
$alertMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombreEmisor = $_POST['nombreEmisor'];
    $edadEmisor = $_POST['edadEmisor'];
    $dpiEmisor = $_POST['dpiEmisor'];

    $nombreDistribuidor = $_POST['nombreDistribuidor'];
    $edadDistribuidor = $_POST['edadDistribuidor'];
    $domicilioDistribuidor = $_POST['domicilioDistribuidor'];
    $dpiDistribuidor = $_POST['dpiDistribuidor'];
    $municipio = $_POST['municipio'];
    $departamento = $_POST['departamento'];

    $representanteLegal = $_POST['representante'];
    $entidad = $_POST['entidad'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $notario = $_POST['notario'];

    $registroMercantil = $_POST['registroMercantil'];
    $folio = $_POST['folio'];
    $libro = $_POST['libro'];
    $nit = $_POST['nit'];

    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $direccionDistribuidora = $_POST['direccionDistribuidora'];

    // Consulta SQL de inserción
    $sql = "INSERT INTO contrato_b (
                nombre_emisor, edad_emisor, dpi_emisor,
                nombre_distribuidor, edad_distribuidor, domicilio_distribuidor, dpi_distribuidor,
                municipio, departamento, representante_legal, entidad, tipo_documento, notario,
                registro_mercantil, folio, libro, nit, fecha_inicio, fecha_fin, direccion_distribuidora
            ) VALUES (
                :nombreEmisor, :edadEmisor, :dpiEmisor,
                :nombreDistribuidor, :edadDistribuidor, :domicilioDistribuidor, :dpiDistribuidor,
                :municipio, :departamento, :representanteLegal, :entidad, :tipoDocumento, :notario,
                :registroMercantil, :folio, :libro, :nit, :fechaInicio, :fechaFin, :direccionDistribuidora
            )";

    $stmt = $pdo->prepare($sql);

    // Asignar los valores a los parámetros
    $stmt->bindParam(':nombreEmisor', $nombreEmisor);
    $stmt->bindParam(':edadEmisor', $edadEmisor);
    $stmt->bindParam(':dpiEmisor', $dpiEmisor);
    $stmt->bindParam(':nombreDistribuidor', $nombreDistribuidor);
    $stmt->bindParam(':edadDistribuidor', $edadDistribuidor);
    $stmt->bindParam(':domicilioDistribuidor', $domicilioDistribuidor);
    $stmt->bindParam(':dpiDistribuidor', $dpiDistribuidor);
    $stmt->bindParam(':municipio', $municipio);
    $stmt->bindParam(':departamento', $departamento);
    $stmt->bindParam(':representanteLegal', $representanteLegal);
    $stmt->bindParam(':entidad', $entidad);
    $stmt->bindParam(':tipoDocumento', $tipoDocumento);
    $stmt->bindParam(':notario', $notario);
    $stmt->bindParam(':registroMercantil', $registroMercantil);
    $stmt->bindParam(':folio', $folio);
    $stmt->bindParam(':libro', $libro);
    $stmt->bindParam(':nit', $nit);
    $stmt->bindParam(':fechaInicio', $fechaInicio);
    $stmt->bindParam(':fechaFin', $fechaFin);
    $stmt->bindParam(':direccionDistribuidora', $direccionDistribuidora);

    // Ejecutar la consulta y preparar el mensaje de alerta
    if ($stmt->execute()) {
        $alertMessage = "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>¡Éxito!</strong> El contrato ha sido creado con éxito.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    } else {
        $alertMessage = "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>¡Error!</strong> Ocurrió un problema al crear el contrato. Inténtelo de nuevo.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }
}
?>

<!-- HTML para mostrar la alerta de Bootstrap -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Contratos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php 
        // Mostrar el mensaje de alerta si está definido
        if (!empty($alertMessage)) {
            echo $alertMessage;
            echo "<script>setTimeout(() => { window.location.href = '../Vistas/ContratoB.php'; }, 3000);</script>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
