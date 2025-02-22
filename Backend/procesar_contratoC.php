<?php
// Incluir la configuración de la conexión a la base de datos
include "conexion_bd.php";

// Asegurarse de que $pdo esté disponible en este archivo
global $pdo;

// Variable para almacenar el mensaje de alerta
$alertMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
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
    $departamentoEmisionDistribuidor = $_POST['departamentoDistribuidor'];
    $municipioEmisionDistribuidor = $_POST['municipioDistribuidor'];
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
    // Obtener los datos de dirección del formulario

    $direccionDistribuidor = $_POST['direccionDistribuidor'];

    // Consulta SQL de inserción
    $sql = "INSERT INTO contrato_c (
    edad_corpo, nombre_emisor, edad_emisor, dpi_emisor, 
    departamento_emision_emisor, municipio_emision_emisor, 
    representante_emisor, entidad_emisor, acredita_emisor, 
    notario_emisor, fecha_acredita_emisor, registro_mercantil_emisor, folio_emisor, libro_emisor, 
    direccion_emisor,  -- Nuevo campo
    nombre_distribuidor, edad_distribuidor, dpi_distribuidor, 
    departamento_emision_distribuidor, municipio_emision_distribuidor, 
    representante_distribuidor, entidad_distribuidor, acredita_distribuidor, 
    notario_distribuidor, fecha_acredita_distribuidor, registro_mercantil_distribuidor, folio_distribuidor, 
    libro_distribuidor, direccion_distribuidor,  -- Nuevo campo
    actividad_economica, nit_distribuidor, 
    fecha_vigencia
) VALUES (
    :edadCorpo, :nombreEmisor, :edadEmisor, :dpiEmisor, 
    :departamentoEmisionEmisor, :municipioEmisionEmisor, 
    :representanteEmisor, :entidadEmisor, :acreditaEmisor, 
    :notarioEmisor, :fechaAcreditaEmisor, :registroMercantilEmisor, :folioEmisor, :libroEmisor, 
    :direccionEmisor,  -- Nuevo campo
    :nombreDistribuidor, :edadDistribuidor, :dpiDistribuidor, 
    :departamentoEmisionDistribuidor, :municipioEmisionDistribuidor, 
    :representanteDistribuidor, :entidadDistribuidor, :acreditaDistribuidor, 
    :notarioDistribuidor, :fechaAcreditaDistribuidor, :registroMercantilDistribuidor, :folioDistribuidor, 
    :libroDistribuidor, :direccionDistribuidor,  -- Nuevo campo
    :actividadEconomica, :nitDistribuidor, 
    :fechaVigencia
)";


    $stmt = $pdo->prepare($sql);

    // Asignar los valores a los parámetros
    $stmt->bindParam(':edadCorpo', $edadCorpo);
    $stmt->bindParam(':nombreEmisor', $nombreEmisor);
    $stmt->bindParam(':edadEmisor', $edadEmisor);
    $stmt->bindParam(':dpiEmisor', $dpiEmisor);
    $stmt->bindParam(':departamentoEmisionEmisor', $departamentoEmisionEmisor);
    $stmt->bindParam(':municipioEmisionEmisor', $municipioEmisionEmisor);
    $stmt->bindParam(':representanteEmisor', $representanteEmisor);
    $stmt->bindParam(':entidadEmisor', $entidadEmisor);
    $stmt->bindParam(':acreditaEmisor', $acreditaEmisor);
    $stmt->bindParam(':notarioEmisor', $notarioEmisor);
    $stmt->bindParam(':fechaAcreditaEmisor', $fechaAcreditaEmisor);
    $stmt->bindParam(':registroMercantilEmisor', $registroMercantilEmisor);
    $stmt->bindParam(':folioEmisor', $folioEmisor);
    $stmt->bindParam(':libroEmisor', $libroEmisor);
    $stmt->bindParam(':direccionEmisor', $direccionEmisor);  // Nuevo campo
    $stmt->bindParam(':nombreDistribuidor', $nombreDistribuidor);
    $stmt->bindParam(':edadDistribuidor', $edadDistribuidor);
    $stmt->bindParam(':dpiDistribuidor', $dpiDistribuidor);
    $stmt->bindParam(':departamentoEmisionDistribuidor', $departamentoEmisionDistribuidor);
    $stmt->bindParam(':municipioEmisionDistribuidor', $municipioEmisionDistribuidor);
    $stmt->bindParam(':representanteDistribuidor', $representanteDistribuidor);
    $stmt->bindParam(':entidadDistribuidor', $entidadDistribuidor);
    $stmt->bindParam(':acreditaDistribuidor', $acreditaDistribuidor);
    $stmt->bindParam(':notarioDistribuidor', $notarioDistribuidor);
    $stmt->bindParam(':fechaAcreditaDistribuidor', $fechaAcreditaDistribuidor);
    $stmt->bindParam(':registroMercantilDistribuidor', $registroMercantilDistribuidor);
    $stmt->bindParam(':folioDistribuidor', $folioDistribuidor);
    $stmt->bindParam(':libroDistribuidor', $libroDistribuidor);
    $stmt->bindParam(':direccionDistribuidor', $direccionDistribuidor);  // Nuevo campo
    $stmt->bindParam(':actividadEconomica', $actividadEconomica);
    $stmt->bindParam(':nitDistribuidor', $nitDistribuidor);
    $stmt->bindParam(':fechaVigencia', $fechaVigencia);
    // Ejecutar la consulta y mostrar mensaje de éxito o error
    if ($stmt->execute()) {
        $alertMessage = "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>¡Éxito!</strong> El contrato ha sido creado con éxito Reinprime en el dashboard.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    } else {
        $alertMessage = "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>¡Error!</strong> Ocurrió un problema al crear el contrato.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }
}
?>

<!-- HTML para mostrar la alerta -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Contrato C</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php if (!empty($alertMessage)) {
            echo $alertMessage;
            echo "<script>setTimeout(() => { window.location.href = '../Vistas/ContratoA.php'; }, 3000);</script>";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>