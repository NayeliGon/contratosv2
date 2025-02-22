<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato B</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Contrato de Distribución</h2>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="../Backend/procesar_contratoB.php">
                    <!-- Datos del Emisor -->
                    <h4 class="mb-3">Datos del Emisor</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombreEmisor" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreEmisor" name="nombreEmisor" placeholder="Ingresa el nombre" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edadEmisor" class="form-label">Edad:</label>
                            <input type="number" class="form-control" id="edadEmisor" name="edadEmisor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dpiEmisor" class="form-label">DPI:</label>
                            <input type="text" class="form-control" id="dpiEmisor" name="dpiEmisor" placeholder="Ingresa el DPI" required>
                        </div>
                    </div>

                    <!-- Datos del Distribuidor -->
                    <h4 class="mb-3">Datos del Distribuidor</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombreDistribuidor" class="form-label">Nombre del Distribuidor:</label>
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
                            <label for="domicilioDistribuidor" class="form-label">Domicilio:</label>
                            <input type="text" class="form-control" id="domicilioDistribuidor" name="domicilioDistribuidor" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="municipio" class="form-label">Municipio:</label>
                            <input type="text" class="form-control" id="municipio" name="municipio" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="departamento" class="form-label">Departamento:</label>
                            <input type="text" class="form-control" id="departamento" name="departamento" required>
                        </div>
                    </div>

                    <!-- Información Legal -->
                    <h4 class="mb-3">Información Legal</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="representante" class="form-label">Propietario o Representante Legal:</label>
                            <select class="form-select" id="representante" name="representante" required>
                                <option value="Propietario">Propietario</option>
                                <option value="Representante">Representante Legal</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entidad" class="form-label">Entidad:</label>
                            <input type="text" class="form-control" id="entidad" name="entidad" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tipoDocumento" class="form-label">Patente o Acta Notarial:</label>
                            <select class="form-select" id="tipoDocumento" name="tipoDocumento" required>
                                <option value="Patente">Patente de Comercio</option>
                                <option value="Acta">Acta Notarial</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notario" class="form-label">Notario:</label>
                            <input type="text" class="form-control" id="notario" name="notario" required>
                        </div>
                    </div>

                    <!-- Información de Registro -->
                    <h4 class="mb-3">Información de Registro</h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="registroMercantil" class="form-label">Número de Registro Mercantil:</label>
                            <input type="number" class="form-control" id="registroMercantil" name="registroMercantil" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="folio" class="form-label">Folio:</label>
                            <input type="number" class="form-control" id="folio" name="folio" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="libro" class="form-label">Libro:</label>
                            <input type="number" class="form-control" id="libro" name="libro" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nit" class="form-label">NIT:</label>
                            <input type="text" class="form-control" id="nit" name="nit" required>
                        </div>
                    </div>

                    <!-- Vigencia -->
                    <h4 class="mb-3">Vigencia</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required onchange="calcularVigencia()">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaFin" class="form-label">Fecha de Finalización:</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" readonly>
                        </div>
                    </div>

                    <!-- Dirección de la Distribuidora -->
                    <div class="mb-3">
                        <label for="direccionDistribuidora" class="form-label">Dirección de la Distribuidora:</label>
                        <input type="text" class="form-control" id="direccionDistribuidora" name="direccionDistribuidora" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">Crear Contrato</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para calcular vigencia -->
    <script>
        function calcularVigencia() {
            const fechaInicio = document.getElementById('fechaInicio').value;
            const fechaFin = document.getElementById('fechaFin');

            if (fechaInicio) {
                const inicio = new Date(fechaInicio);
                const fin = new Date(inicio);
                fin.setFullYear(inicio.getFullYear() + 1); // Añadir 1 año

                fechaFin.value = fin.toISOString().split('T')[0]; // Formato YYYY-MM-DD
            }
        }
    </script>
</body>
</html>
