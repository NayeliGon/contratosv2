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

    $nombreReceptor = $_POST['nombreReceptor'];
    $edadReceptor = $_POST['edadReceptor'];
    $domicilioReceptor = $_POST['domicilioReceptor'];
    $dpiReceptor = $_POST['dpiReceptor'];
    $departamentoEmision = $_POST['departamentoEmision'];
    $municipioEmision = $_POST['municipioEmision'];
    $nombreContratante = $_POST['nombreContratante'];

    $fechaPatente = $_POST['fechaPatente'];
    $numeroInscripcion = $_POST['numeroInscripcion'];
    $folioRegistro = $_POST['folioRegistro'];
    $libroRegistro = $_POST['libroRegistro'];

    $actividadEconomica = $_POST['actividadEconomica'];
    $nit = $_POST['nit'];
    $tarifaMensual = $_POST['tarifaMensual'];

    $cobroUnico = $_POST['cobroUnico'];
    $fechaValidez = $_POST['fechaValidez'];

    $rango_documentos = $_POST['rango_documentos'];
    $direccionContratante = $_POST['direccionContratante'];


    // Consulta SQL de inserción
    $sql = "INSERT INTO contratos_a (
        nombre_emisor, edad_emisor, dpi_emisor,
        nombre_receptor, edad_receptor, domicilio_receptor, dpi_receptor, nombre_contratante, rango_documentos, direccion_contratante,
        numero_inscripcion, folio_registro, libro_registro,
        actividad_economica, nit, tarifa_mensual,
        cobro_unico, fecha_validez
    ) VALUES (
        :nombreEmisor, :edadEmisor, :dpiEmisor,
        :nombreReceptor, :edadReceptor, :domicilioReceptor, :dpiReceptor,
        :departamentoEmision, :municipioEmision, :nombreContratante, :rango_documentos, :direccionContratante,
        :fechaPatente, :numeroInscripcion, :folioRegistro, :libroRegistro,
        :actividadEconomica, :nit, :tarifaMensual,
        :cobroUnico, :fechaValidez
    )";
    

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nombreEmisor', $nombreEmisor);
    $stmt->bindParam(':edadEmisor', $edadEmisor);
    $stmt->bindParam(':dpiEmisor', $dpiEmisor);
    $stmt->bindParam(':nombreReceptor', $nombreReceptor);
    $stmt->bindParam(':edadReceptor', $edadReceptor);
    $stmt->bindParam(':domicilioReceptor', $domicilioReceptor);
    $stmt->bindParam(':dpiReceptor', $dpiReceptor);
    $stmt->bindParam(':departamentoEmision', $departamentoEmision);
    $stmt->bindParam(':municipioEmision', $municipioEmision);
    $stmt->bindParam(':nombreContratante', $nombreContratante);
    $stmt->bindParam(':rango_documentos', $rango_documentos);
    $stmt->bindParam(':direccionContratante', $direccionContratante);
    $stmt->bindParam(':fechaPatente', $fechaPatente);
    $stmt->bindParam(':numeroInscripcion', $numeroInscripcion);
    $stmt->bindParam(':folioRegistro', $folioRegistro);
    $stmt->bindParam(':libroRegistro', $libroRegistro);
    $stmt->bindParam(':actividadEconomica', $actividadEconomica);
    $stmt->bindParam(':nit', $nit);
    $stmt->bindParam(':tarifaMensual', $tarifaMensual);
    $stmt->bindParam(':cobroUnico', $cobroUnico);
    $stmt->bindParam(':fechaValidez', $fechaValidez);
    

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
            echo "<script>setTimeout(() => { window.location.href = '../Vistas/ContratoA.php'; }, 3000);</script>";
        }
        ?>
        <!-- Aquí va el resto de tu formulario -->
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>