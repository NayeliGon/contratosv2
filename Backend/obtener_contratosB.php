<?php
include 'conexion_bd.php';

if (isset($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];
    $query = "SELECT * FROM contrato_b WHERE id_contrato = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_contrato]);
    $contrato = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($contrato) {
        ?>
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <h5>Editar Contrato B - Distribuidor</h5>
            </div>
            <div class="card-body">
                <form id="editFormB">
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

                    <!-- Datos del Distribuidor -->
                    <h4 class="mb-3">Datos del Distribuidor</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_distribuidor" class="form-label">Nombre del Distribuidor:</label>
                            <input type="text" class="form-control" name="nombre_distribuidor" value="<?php echo $contrato['nombre_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edad_distribuidor" class="form-label">Edad:</label>
                            <input type="number" class="form-control" name="edad_distribuidor" value="<?php echo $contrato['edad_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dpi_distribuidor" class="form-label">DPI:</label>
                            <input type="text" class="form-control" name="dpi_distribuidor" value="<?php echo $contrato['dpi_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="domicilio_distribuidor" class="form-label">Domicilio:</label>
                            <input type="text" class="form-control" name="domicilio_distribuidor" value="<?php echo $contrato['domicilio_distribuidor']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="municipio" class="form-label">Municipio:</label>
                            <input type="text" class="form-control" name="municipio" value="<?php echo $contrato['municipio']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="departamento" class="form-label">Departamento:</label>
                            <input type="text" class="form-control" name="departamento" value="<?php echo $contrato['departamento']; ?>" required>
                        </div>
                    </div>

                    <!-- Información Legal -->
                    <h4 class="mb-3">Información Legal</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="representante_legal" class="form-label">Propietario o Representante Legal:</label>
                            <input type="text" class="form-control" name="representante_legal" value="<?php echo $contrato['representante_legal']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entidad" class="form-label">Entidad:</label>
                            <input type="text" class="form-control" name="entidad" value="<?php echo $contrato['entidad']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tipo_documento" class="form-label">Tipo de Documento:</label>
                            <input type="text" class="form-control" name="tipo_documento" value="<?php echo $contrato['tipo_documento']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notario" class="form-label">Notario:</label>
                            <input type="text" class="form-control" name="notario" value="<?php echo $contrato['notario']; ?>" required>
                        </div>
                    </div>

                    <!-- Información de Registro -->
                    <h4 class="mb-3">Información de Registro</h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="registro_mercantil" class="form-label">Número de Registro Mercantil:</label>
                            <input type="number" class="form-control" name="registro_mercantil" value="<?php echo $contrato['registro_mercantil']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="folio" class="form-label">Folio:</label>
                            <input type="number" class="form-control" name="folio" value="<?php echo $contrato['folio']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="libro" class="form-label">Libro:</label>
                            <input type="number" class="form-control" name="libro" value="<?php echo $contrato['libro']; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nit" class="form-label">NIT:</label>
                            <input type="text" class="form-control" name="nit" value="<?php echo $contrato['nit']; ?>" required>
                        </div>
                    </div>

                    <!-- Vigencia -->
                    <h4 class="mb-3">Vigencia</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $contrato['fecha_inicio']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Finalización:</label>
                            <input type="date" class="form-control" name="fecha_fin" value="<?php echo $contrato['fecha_fin']; ?>" required>
                        </div>
                    </div>

                    <!-- Dirección de la Distribuidora -->
                    <div class="mb-3">
                        <label for="direccion_distribuidora" class="form-label">Dirección de la Distribuidora:</label>
                        <input type="text" class="form-control" name="direccion_distribuidora" value="<?php echo $contrato['direccion_distribuidora']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">Guardar Cambios</button>
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
