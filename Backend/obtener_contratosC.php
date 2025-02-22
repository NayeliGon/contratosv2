<?php
include 'conexion_bd.php';

if (isset($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];
    $query = "SELECT * FROM contrato_c WHERE id_contrato = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_contrato]);
    $contrato = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($contrato) {
        ?>
        <div class="card mt-3" style="max-width: 700px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h5>Editar Contrato C - Clientes y Distribuidores</h5>
            </div>
            <div class="card-body">
                <form id="editFormC">
                    <input type="hidden" name="id_contrato" value="<?php echo $contrato['id_contrato']; ?>">

                    <!-- Datos del Emisor -->
                    <h4 class="mb-3">Datos del Emisor</h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="edadCorpo" class="form-label">Edad Corporativa:</label>
                            <input type="number" class="form-control" name="edadCorpo" value="<?php echo $contrato['edad_corpo']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nombreEmisor" class="form-label">Nombre del Emisor:</label>
                            <input type="text" class="form-control" name="nombreEmisor" value="<?php echo $contrato['nombre_emisor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edadEmisor" class="form-label">Edad del Emisor:</label>
                            <input type="number" class="form-control" name="edadEmisor" value="<?php echo $contrato['edad_emisor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dpiEmisor" class="form-label">DPI del Emisor:</label>
                            <input type="text" class="form-control" name="dpiEmisor" value="<?php echo $contrato['dpi_emisor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departamentoEmisor" class="form-label">Departamento de Emisión:</label>
                            <input type="text" class="form-control" name="departamentoEmisor" value="<?php echo $contrato['departamento_emision_emisor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="municipioEmisor" class="form-label">Municipio de Emisión:</label>
                            <input type="text" class="form-control" name="municipioEmisor" value="<?php echo $contrato['municipio_emision_emisor']; ?>" required>
                        </div>
                    </div>

                    <!-- Información Legal del Emisor -->
                    <h5 class="mb-3">Información Legal del Emisor</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="representanteEmisor" class="form-label">Propietario o Representante Legal:</label>
                            <input type="text" class="form-control" name="representanteEmisor" value="<?php echo $contrato['representante_emisor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entidadEmisor" class="form-label">Entidad:</label>
                            <input type="text" class="form-control" name="entidadEmisor" value="<?php echo $contrato['entidad_emisor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="acreditaEmisor" class="form-label">Acredita:</label>
                            <input type="text" class="form-control" name="acreditaEmisor" value="<?php echo $contrato['acredita_emisor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notarioEmisor" class="form-label">Notario:</label>
                            <input type="text" class="form-control" name="notarioEmisor" value="<?php echo $contrato['notario_emisor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaAcreditaEmisor" class="form-label">Fecha Acreditación Emisor:</label>
                            <input type="date" class="form-control" name="fechaAcreditaEmisor" value="<?php echo $contrato['fecha_acredita_emisor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="registroMercantilEmisor" class="form-label">No. Registro Mercantil:</label>
                            <input type="number" class="form-control" name="registroMercantilEmisor" value="<?php echo $contrato['registro_mercantil_emisor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="folioEmisor" class="form-label">Folio:</label>
                            <input type="number" class="form-control" name="folioEmisor" value="<?php echo $contrato['folio_emisor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="libroEmisor" class="form-label">Libro:</label>
                            <input type="number" class="form-control" name="libroEmisor" value="<?php echo $contrato['libro_emisor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccionEmisor" class="form-label">Dirección del Emisor:</label>
                            <input type="text" class="form-control" name="direccionEmisor" value="<?php echo $contrato['direccion_emisor']; ?>" required>
                        </div>
                    </div>

                    <!-- Datos del Distribuidor -->
                    <h4 class="mb-3">Datos del Distribuidor</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombreDistribuidor" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombreDistribuidor" value="<?php echo $contrato['nombre_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edadDistribuidor" class="form-label">Edad:</label>
                            <input type="number" class="form-control" name="edadDistribuidor" value="<?php echo $contrato['edad_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dpiDistribuidor" class="form-label">DPI:</label>
                            <input type="text" class="form-control" name="dpiDistribuidor" value="<?php echo $contrato['dpi_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departamentoDistribuidor" class="form-label">Departamento de Emisión:</label>
                            <input type="text" class="form-control" name="departamentoDistribuidor" value="<?php echo $contrato['departamento_emision_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="municipioDistribuidor" class="form-label">Municipio de Emisión:</label>
                            <input type="text" class="form-control" name="municipioDistribuidor" value="<?php echo $contrato['municipio_emision_distribuidor']; ?>" required>
                        </div>
                    </div>

                    <!-- Información Legal del Distribuidor -->
                    <h5 class="mb-3">Información Legal del Distribuidor</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="representanteDistribuidor" class="form-label">Propietario o Representante Legal:</label>
                            <input type="text" class="form-control" name="representanteDistribuidor" value="<?php echo $contrato['representante_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entidadDistribuidor" class="form-label">Entidad:</label>
                            <input type="text" class="form-control" name="entidadDistribuidor" value="<?php echo $contrato['entidad_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="acreditaDistribuidor" class="form-label">Acredita:</label>
                            <input type="text" class="form-control" name="acreditaDistribuidor" value="<?php echo $contrato['acredita_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notarioDistribuidor" class="form-label">Notario:</label>
                            <input type="text" class="form-control" name="notarioDistribuidor" value="<?php echo $contrato['notario_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaAcreditaDistribuidor" class="form-label">Fecha Acreditación Distribuidor:</label>
                            <input type="date" class="form-control" name="fechaAcreditaDistribuidor" value="<?php echo $contrato['fecha_acredita_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="registroMercantilDistribuidor" class="form-label">No. Registro Mercantil:</label>
                            <input type="number" class="form-control" name="registroMercantilDistribuidor" value="<?php echo $contrato['registro_mercantil_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="folioDistribuidor" class="form-label">Folio:</label>
                            <input type="number" class="form-control" name="folioDistribuidor" value="<?php echo $contrato['folio_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="libroDistribuidor" class="form-label">Libro:</label>
                            <input type="number" class="form-control" name="libroDistribuidor" value="<?php echo $contrato['libro_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="actividadEconomica" class="form-label">Actividad Económica:</label>
                            <input type="text" class="form-control" name="actividadEconomica" value="<?php echo $contrato['actividad_economica']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nitDistribuidor" class="form-label">NIT del Distribuidor:</label>
                            <input type="text" class="form-control" name="nitDistribuidor" value="<?php echo $contrato['nit_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaVigencia" class="form-label">Fecha de Vigencia:</label>
                            <input type="date" class="form-control" name="fechaVigencia" value="<?php echo $contrato['fecha_vigencia']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccionDistribuidor" class="form-label">Dirección del Distribuidor:</label>
                            <input type="text" class="form-control" name="direccionDistribuidor" value="<?php echo $contrato['direccion_distribuidor']; ?>" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-100 mt-4" onclick="guardarCambiosContrato()">Guardar Cambios</button>
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
<script>
    function guardarCambiosContrato() {
        const formData = new FormData(document.getElementById('editFormC'));

        $.ajax({
            url: '../Backend/editC.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire(
                        'Éxito',
                        response.message,
                        'success'
                    ).then(() => {
                        $('#contenido-principal').html(''); // Vacía el formulario de edición
                        //location.reload(); // Recarga la página para ver los cambios
                    });
                } else {
                    Swal.fire(
                        'Error',
                        response.message,
                        'error'
                    );
                }
            },
            error: function() {
                Swal.fire(
                    'Error',
                    'Hubo un problema al actualizar el contrato.',
                    'error'
                );
            }
        });
    }
</script>
