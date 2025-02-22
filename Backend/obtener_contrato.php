<?php
include 'conexion_bd.php';

if (isset($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];
    $query = "SELECT * FROM contratos_a WHERE id_contrato = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_contrato]);
    $contrato = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($contrato) {
        ?>
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <h5>Editar Contrato</h5>
            </div>
            <div class="card-body">
                <form id="editForm">
                    <input type="hidden" name="id_contrato" value="<?php echo $contrato['id_contrato']; ?>">

                    <!-- Datos del Emisor -->
                    <h4 class="mb-3">Datos del Emisor</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre_emisor" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre_emisor" value="<?php echo $contrato['nombre_emisor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edad_emisor" class="form-label">Edad:</label>
                            <input type="number" class="form-control" name="edad_emisor" value="<?php echo $contrato['edad_emisor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dpi_emisor" class="form-label">DPI:</label>
                            <input type="text" class="form-control" name="dpi_emisor" value="<?php echo $contrato['dpi_emisor']; ?>" required>
                        </div>
                    </div>

                    <!-- Datos del Receptor -->
                    <h4 class="mb-3">Datos del Receptor</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_receptor" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre_receptor" value="<?php echo $contrato['nombre_receptor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edad_receptor" class="form-label">Edad:</label>
                            <input type="number" class="form-control" name="edad_receptor" value="<?php echo $contrato['edad_receptor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dpi_receptor" class="form-label">DPI:</label>
                            <input type="text" class="form-control" name="dpi_receptor" value="<?php echo $contrato['dpi_receptor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="domicilio_receptor" class="form-label">Domicilio:</label>
                            <input type="text" class="form-control" name="domicilio_receptor" value="<?php echo $contrato['domicilio_receptor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="departamento_emision" class="form-label">Departamento de Emisión:</label>
                            <input type="text" class="form-control" name="departamento_emision" value="<?php echo $contrato['departamento_emision']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="municipio_emision" class="form-label">Municipio de Emisión:</label>
                            <input type="text" class="form-control" name="municipio_emision" value="<?php echo $contrato['municipio_emision']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nombre_contratante" class="form-label">Nombre del Contratante:</label>
                            <input type="text" class="form-control" name="nombre_contratante" value="<?php echo $contrato['nombre_contratante']; ?>" required>
                        </div>
                    </div>

                    <h4 class="mb-3">Patente de Comercio</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fecha_patente" class="form-label">Fecha de Autorización:</label>
                            <input type="date" class="form-control" name="fecha_patente" value="<?php echo $contrato['fecha_patente']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="numero_inscripcion" class="form-label">Número de Inscripción:</label>
                            <input type="text" class="form-control" name="numero_inscripcion" value="<?php echo $contrato['numero_inscripcion']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="folio_registro" class="form-label">Folio:</label>
                            <input type="text" class="form-control" name="folio_registro" value="<?php echo $contrato['folio_registro']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="libro_registro" class="form-label">Libro:</label>
                            <input type="text" class="form-control" name="libro_registro" value="<?php echo $contrato['libro_registro']; ?>" required>
                        </div>
                    </div>

                    <!-- Información Económica -->
                    <h4 class="mb-3">Información Económica</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="actividad_economica" class="form-label">Actividad Económica:</label>
                            <input type="text" class="form-control" name="actividad_economica" value="<?php echo $contrato['actividad_economica']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nit" class="form-label">NIT:</label>
                            <input type="text" class="form-control" name="nit" value="<?php echo $contrato['nit']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="tarifa_mensual" class="form-label">Tarifa Mensual:</label>
                            <input type="number" class="form-control" name="tarifa_mensual" value="<?php echo $contrato['tarifa_mensual']; ?>" required>
                        </div>
                    </div>

                    <!-- Información del Contrato -->
                    <h4 class="mb-3">Información del Contrato</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cobro_unico" class="form-label">Cobro Único:</label>
                            <input type="number" class="form-control" name="cobro_unico" value="<?php echo $contrato['cobro_unico']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_validez" class="form-label">Fecha de Validez:</label>
                            <input type="date" class="form-control" name="fecha_validez" value="<?php echo $contrato['fecha_validez']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="rango_documentos" class="form-label">Rango del Contratante:</label>
                            <input type="text" class="form-control" name="rango_documentos" value="<?php echo $contrato['rango_documentos']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccion_contratante" class="form-label">Dirección del Contratante:</label>
                            <input type="text" class="form-control" name="direccion_contratante" value="<?php echo $contrato['direccion_contratante']; ?>" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-4">Guardar Cambios</button>
                </form>
            </div>
        </div>
        <?php
    } else {
        echo "<p>No se encontró el contrato.</p>";
    }
} else {
    echo "<p>ID de contrato no proporcionado.</p>";
}
?>
