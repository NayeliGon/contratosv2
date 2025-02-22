<div class="card">
    <div class="card-header text-center">
        <h2>Contrato de Prestación de Servicios - FEL</h2>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="../Backend/procesar_contratoA.php">
            <!-- Datos del Emisor -->
            <h4 class="mb-3">Datos del Emisor</h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="nombreEmisor" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombreEmisor" name="nombreEmisor" placeholder="Ingresa el nombre del emisor" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="edadEmisor" class="form-label">Edad:</label>
                    <input type="number" class="form-control" id="edadEmisor" name="edadEmisor" placeholder="Ingresa la edad del emisor" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="dpiEmisor" class="form-label">DPI:</label>
                    <input type="text" class="form-control" id="dpiEmisor" name="dpiEmisor" placeholder="Ingresa el DPI del emisor" required>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Datos del Receptor -->
            <h4 class="mb-3">Datos del Receptor</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombreReceptor" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombreReceptor" name="nombreReceptor" placeholder="Ingresa el nombre del receptor" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="edadReceptor" class="form-label">Edad:</label>
                    <input type="number" class="form-control" id="edadReceptor" name="edadReceptor" placeholder="Ingresa la edad" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="dpiReceptor" class="form-label">DPI:</label>
                    <input type="text" class="form-control" id="dpiReceptor" name="dpiReceptor" placeholder="Ingresa el DPI" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="domicilioReceptor" class="form-label">Domicilio:</label>
                    <input type="text" class="form-control" id="domicilioReceptor" name="domicilioReceptor" placeholder="Ingresa el domicilio" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="departamentoEmision" class="form-label">Departamento de Emisión:</label>
                    <input type="text" class="form-control" id="departamentoEmision" name="departamentoEmision" placeholder="Ingresa el departamento" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="municipioEmision" class="form-label">Municipio de Emisión:</label>
                    <input type="text" class="form-control" id="municipioEmision" name="municipioEmision" placeholder="Ingresa el municipio" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nombreContratante" class="form-label">Nombre del Contratante:</label>
                    <input type="text" class="form-control" id="nombreContratante" name="nombreContratante" placeholder="Ingresa el nombre del contratante" required>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Patente de Comercio -->
            <h4 class="mb-3">Patente de Comercio</h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="fechaPatente" class="form-label">Fecha de Autorización:</label>
                    <input type="date" class="form-control" id="fechaPatente" name="fechaPatente" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="numeroInscripcion" class="form-label">Número de Inscripción:</label>
                    <input type="text" class="form-control" id="numeroInscripcion" name="numeroInscripcion" placeholder="Número de inscripción" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="folioRegistro" class="form-label">Folio:</label>
                    <input type="text" class="form-control" id="folioRegistro" name="folioRegistro" placeholder="Folio del registro" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="libroRegistro" class="form-label">Libro:</label>
                    <input type="text" class="form-control" id="libroRegistro" name="libroRegistro" placeholder="Libro del registro" required>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Información Económica -->
            <h4 class="mb-3">Información Económica</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="actividadEconomica" class="form-label">Actividad Económica:</label>
                    <input type="text" class="form-control" id="actividadEconomica" name="actividadEconomica" placeholder="Actividad económica detallada" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="nit" class="form-label">NIT:</label>
                    <input type="text" class="form-control" id="nit" name="nit" placeholder="Ingresa el NIT" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="tarifaMensual" class="form-label">Tarifa Mensual:</label>
                    <input type="number" class="form-control" id="tarifaMensual" name="tarifaMensual" placeholder="Tarifa mensual al certificador" required>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Información del Contrato -->
            <h4 class="mb-3">Información del Contrato</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cobroUnico" class="form-label">Cobro Único:</label>
                    <input type="number" class="form-control" id="cobroUnico" name="cobroUnico" placeholder="Cobro único" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fechaValidez" class="form-label">Fecha de Validez:</label>
                    <input type="date" class="form-control" id="fechaValidez" name="fechaValidez" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="rango_documentos" class="form-label">Rango del Contratante:</label>
                    <input type="text" class="form-control" id="rango_documentos" name="rango_documentos" placeholder="Ingresa el rango del contratante" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="direccionContratante" class="form-label">Dirección del Contratante:</label>
                    <input type="text" class="form-control" id="direccionContratante" name="direccionContratante" placeholder="Ingresa la dirección del contratante" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">Crear Contrato</button>
        </form>
    </div>
</div>