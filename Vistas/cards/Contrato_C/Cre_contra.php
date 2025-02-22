<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato C - Clientes con Distribuidores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Contrato C - Clientes con Distribuidores</h2>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="../Backend/procesar_contratoC.php">
                    <!-- Datos del Emisor -->
                    <h4 class="mb-3">Datos del Emisor</h4>
                    <div class="col-md-3 mb-3">
                        <label for="edadCorpo" class="form-label">Edad:</label>
                        <input type="number" class="form-control" id="edadCorpo" name="edadCorpo" required>
                    </div>
                    <h4 class="mb-3">Datos del Emisor</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombreEmisor" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreEmisor" name="nombreEmisor" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edadEmisor" class="form-label">Edad:</label>
                            <input type="number" class="form-control" id="edadEmisor" name="edadEmisor" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dpiEmisor" class="form-label">DPI:</label>
                            <input type="text" class="form-control" id="dpiEmisor" name="dpiEmisor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departamentoEmisor" class="form-label">Departamento de Emisión:</label>
                            <input type="text" class="form-control" id="departamentoEmisor" name="departamentoEmisor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="municipioEmisor" class="form-label">Municipio de Emisión:</label>
                            <input type="text" class="form-control" id="municipioEmisor" name="municipioEmisor" required>
                        </div>
                    </div>

                    <!-- Información Legal del Emisor -->
                    <h5 class="mb-3">Información Legal del Emisor</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="representanteEmisor" class="form-label">Propietario o Representante Legal:</label>
                            <select class="form-select" id="representanteEmisor" name="representanteEmisor" required>
                                <option value="Propietario">Propietario</option>
                                <option value="Representante">Representante Legal</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entidadEmisor" class="form-label">Entidad:</label>
                            <input type="text" class="form-control" id="entidadEmisor" name="entidadEmisor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="acreditaEmisor" class="form-label">Acredita:</label>
                            <select class="form-select" id="acreditaEmisor" name="acreditaEmisor" required>
                                <option value="Patente">Patente de Comercio</option>
                                <option value="Acta">Acta Notarial de Nombramiento</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notarioEmisor" class="form-label">Notario:</label>
                            <input type="text" class="form-control" id="notarioEmisor" name="notarioEmisor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaAcreditaEmisor" class="form-label">Fecha Acreditación Emisor:</label>
                            <input type="date" class="form-control" id="fechaAcreditaEmisor" name="fechaAcreditaEmisor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="registroMercantilEmisor" class="form-label">No. Registro Mercantil:</label>
                            <input type="number" class="form-control" id="registroMercantilEmisor" name="registroMercantilEmisor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="folioEmisor" class="form-label">Folio:</label>
                            <input type="number" class="form-control" id="folioEmisor" name="folioEmisor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="libroEmisor" class="form-label">Libro:</label>
                            <input type="number" class="form-control" id="libroEmisor" name="libroEmisor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccionEmisor" class="form-label">Dirección del Emisor:</label>
                            <input type="text" class="form-control" id="direccionEmisor" name="direccionEmisor" required>
                        </div>
                    </div>

                    <!-- Datos del Distribuidor -->
                    <h4 class="mb-3">Datos del Distribuidor</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombreDistribuidor" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreDistribuidor" name="nombreDistribuidor" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edadDistribuidor" class="form-label">Edad:</label>
                            <input type="number" class="form-control" id="edadDistribuidor" name="edadDistribuidor" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dpiDistribuidor" class="form-label">DPI:</label>
                            <input type="text" class="form-control" id="dpiDistribuidor" name="dpiDistribuidor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departamentoDistribuidor" class="form-label">Departamento de Emisión:</label>
                            <input type="text" class="form-control" id="departamentoDistribuidor" name="departamentoDistribuidor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="municipioDistribuidor" class="form-label">Municipio de Emisión:</label>
                            <input type="text" class="form-control" id="municipioDistribuidor" name="municipioDistribuidor" required>
                        </div>
                    </div>

                    <!-- Información Legal del Distribuidor -->
                    <h5 class="mb-3">Información Legal del Distribuidor</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="representanteDistribuidor" class="form-label">Propietario o Representante Legal:</label>
                            <select class="form-select" id="representanteDistribuidor" name="representanteDistribuidor" required>
                                <option value="Propietario">Propietario</option>
                                <option value="Representante">Representante Legal</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entidadDistribuidor" class="form-label">Entidad:</label>
                            <input type="text" class="form-control" id="entidadDistribuidor" name="entidadDistribuidor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="acreditaDistribuidor" class="form-label">Acredita:</label>
                            <select class="form-select" id="acreditaDistribuidor" name="acreditaDistribuidor" required>
                                <option value="Patente">Patente de Comercio</option>
                                <option value="Acta">Acta Notarial de Nombramiento</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notarioDistribuidor" class="form-label">Notario:</label>
                            <input type="text" class="form-control" id="notarioDistribuidor" name="notarioDistribuidor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaAcreditaDistribuidor" class="form-label">Fecha Acreditación Distribuidor:</label>
                            <input type="date" class="form-control" id="fechaAcreditaDistribuidor" name="fechaAcreditaDistribuidor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="registroMercantilDistribuidor" class="form-label">No. Registro Mercantil:</label>
                            <input type="number" class="form-control" id="registroMercantilDistribuidor" name="registroMercantilDistribuidor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="folioDistribuidor" class="form-label">Folio:</label>
                            <input type="number" class="form-control" id="folioDistribuidor" name="folioDistribuidor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="libroDistribuidor" class="form-label">Libro:</label>
                            <input type="number" class="form-control" id="libroDistribuidor" name="libroDistribuidor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="actividadEconomica" class="form-label">Actividad Económica:</label>
                            <input type="text" class="form-control" id="actividadEconomica" name="actividadEconomica" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nitDistribuidor" class="form-label">NIT del Distribuidor:</label>
                            <input type="text" class="form-control" id="nitDistribuidor" name="nitDistribuidor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaVigencia" class="form-label">Fecha de Vigencia:</label>
                            <input type="date" class="form-control" id="fechaVigencia" name="fechaVigencia" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccionDistribuidor" class="form-label">Dirección del Distribuidor:</label>
                            <input type="text" class="form-control" id="direccionDistribuidor" name="direccionDistribuidor" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4">Crear Contrato</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>