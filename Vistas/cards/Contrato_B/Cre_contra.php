<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato Distribuidor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="">
            <div class="card-header text-center">
                <h2>Contrato con Distribuidores</h2>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="../Backend/procesar_contratoB.php">
                    <!-- Datos del Emisor -->
                    <h4 class="mb-3">Representante de Corposistemas</h4>
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
                            <label for="domicilioDistribuidor" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="domicilioDistribuidor" name="domicilioDistribuidor" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="departamentoEmision" class="form-label">Departamento</label>
                            <select class="form-control" id="departamentoEmision" name="departamentoEmision" required></select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="municipioEmision" class="form-label">Municipio</label>
                            <select class="form-control" id="municipioEmision" name="municipioEmision" required></select>
                        </div>

<script>
    const departamentos = {
        "Alta Verapaz": ["Cobán", "San Pedro Carchá", "San Juan Chamelco", "Tactic", "Tucurú", "Panzós", "Senahú", "Santa Catalina La Tinta", "Tamahú", "San Cristóbal Verapaz", "Santa Cruz Verapaz", "Chisec", "Fray Bartolomé de las Casas", "Raxruhá", "Lanquín"],
        "Baja Verapaz": ["Salamá", "Cubulco", "Granados", "Purulhá", "Rabinal", "San Jerónimo", "San Miguel Chicaj"],
        "Chimaltenango": ["Chimaltenango", "San José Poaquil", "San Martín Jilotepeque", "San Juan Comalapa", "San Pedro Yepocapa", "Santa Apolonia", "Tecpán Guatemala", "Patzún", "Pochuta", "Patzicía", "Santa Cruz Balanyá", "Acatenango", "San Andrés Itzapa", "Zaragoza", "El Tejar"],
        "Chiquimula": ["Chiquimula", "Camotán", "Concepción Las Minas", "Esquipulas", "Ipala", "Jocotán", "Olopa", "Quezaltepeque", "San Jacinto", "San José La Arada"],
        "El Progreso": ["Guastatoya", "El Jícaro", "Morazán", "San Agustín Acasaguastlán", "San Cristóbal Acasaguastlán", "Sanarate", "Sansare"],
        "Escuintla": ["Escuintla", "Guanagazapa", "Iztapa", "La Democracia", "La Gomera", "Masagua", "Nueva Concepción", "Palín", "San José", "San Vicente Pacaya", "Santa Lucía Cotzumalguapa", "Sipacate", "Tiquisate"],
        "Guatemala": ["Guatemala", "Mixco", "Villa Nueva", "Villa Canales", "San Miguel Petapa", "Chinautla", "Amatitlán", "San José Pinula", "San Pedro Ayampuc", "San Juan Sacatepéquez", "San Raymundo", "Chuarrancho", "Fraijanes", "Palencia", "San José del Golfo", "Santa Catarina Pinula"],
        "Huehuetenango": ["Huehuetenango", "Aguacatán", "Chiantla", "Colotenango", "Concepción Huista", "Cuilco", "Jacaltenango", "La Democracia", "La Libertad", "Malacatancito", "Nentón", "San Antonio Huista", "San Gaspar Ixchil", "San Juan Atitán", "San Mateo Ixtatán", "San Miguel Acatán", "San Pedro Necta", "San Rafael La Independencia", "San Rafael Petzal", "San Sebastián Coatán", "San Sebastián Huehuetenango", "Santa Ana Huista", "Santa Bárbara", "Santa Cruz Barillas", "Santa Eulalia", "Santiago Chimaltenango", "Soloma", "Tectitán", "Todos Santos Cuchumatán", "Unión Cantinil"],
        "Izabal": ["Puerto Barrios", "El Estor", "Livingston", "Los Amates", "Morales"],
        "Jalapa": ["Jalapa", "Mataquescuintla", "Monjas", "San Carlos Alzatate", "San Luis Jilotepeque", "San Manuel Chaparrón", "San Pedro Pinula"],
        "Jutiapa": ["Jutiapa", "Agua Blanca", "Asunción Mita", "Atescatempa", "Comapa", "Conguaco", "El Adelanto", "El Progreso", "Jalpatagua", "Jerez", "Moyuta", "Pasaco", "Quesada", "San José Acatempa", "Santa Catarina Mita", "Yupiltepeque", "Zapotitlán"],
        "Quetzaltenango": ["Quetzaltenango", "Almolonga", "Cabricán", "Cajolá", "Cantel", "Coatepeque", "Colomba", "Concepción Chiquirichapa", "El Palmar", "Flores Costa Cuca", "Génova", "Huitán", "La Esperanza", "Olintepeque", "Ostuncalco", "Palestina de Los Altos", "Salcajá", "San Carlos Sija", "San Francisco La Unión", "San Juan Ostuncalco", "San Martín Sacatepéquez", "San Mateo", "San Miguel Sigüilá", "Sibilia", "Zunil"],
        "Quiché": ["Santa Cruz del Quiché", "Canillá", "Chajul", "Chicamán", "Chiché", "Chichicastenango", "Chinique", "Cunén", "Ixcán", "Joyabaj", "Nebaj", "Pachalum", "Patzité", "Sacapulas", "San Andrés Sajcabajá", "San Antonio Ilotenango", "San Bartolomé Jocotenango", "San Juan Cotzal", "San Pedro Jocopilas", "Uspantán", "Zacualpa"],
        "Retalhuleu": ["Retalhuleu", "Champerico", "El Asintal", "Nuevo San Carlos", "San Andrés Villa Seca", "San Felipe", "San Martín Zapotitlán", "San Sebastián", "Santa Cruz Muluá"],
        "Sacatepéquez": ["Antigua Guatemala", "Ciudad Vieja", "Jocotenango", "Magdalena Milpas Altas", "Pastores", "San Antonio Aguas Calientes", "San Bartolomé Milpas Altas", "San Lucas Sacatepéquez", "San Miguel Dueñas", "Santa Catarina Barahona", "Santa Lucía Milpas Altas", "Santa María de Jesús", "Santiago Sacatepéquez", "Santo Domingo Xenacoj", "Sumpango"],
        "San Marcos": ["San Marcos", "Ayutla", "Catarina", "Comitancillo", "Concepción Tutuapa", "El Quetzal", "El Rodeo", "El Tumbador", "Ixchiguán", "La Reforma", "Malacatán", "Nuevo Progreso", "Ocós", "Pajapita", "Río Blanco", "San Antonio Sacatepéquez", "San Cristóbal Cucho", "San José El Rodeo", "San Lorenzo", "San Miguel Ixtahuacán", "San Pablo", "San Pedro Sacatepéquez", "San Rafael Pie de la Cuesta", "Sibinal", "Sipacapa", "Tacaná", "Tajumulco", "Tejutla"],
    };

    const departamentoSelect = document.getElementById("departamentoEmision");
    const municipioSelect = document.getElementById("municipioEmision");

    for (let departamento in departamentos) {
        let option = new Option(departamento, departamento);
        departamentoSelect.add(option);
    }

    function actualizarMunicipios() {
        municipioSelect.innerHTML = "";
        departamentos[departamentoSelect.value].forEach(municipio => {
            municipioSelect.add(new Option(municipio, municipio));
        });
    }

    departamentoSelect.addEventListener("change", actualizarMunicipios);

    departamentoSelect.value = "Alta Verapaz";
    actualizarMunicipios();
    municipioSelect.value = "Cobán";
</script>
                          <!-- Dirección de la Distribuidora 
                                <div class="mb-3">
                                    <label for="direccionDistribuidora" class="form-label">Dirección distribuidor</label>
                                    <input type="text" class="form-control" id="direccionDistribuidora" name="direccionDistribuidora" required>
                                </div>-->
                    </div>

                    <!-- Información Legal -->
                    <h4 class="mb-3">Información de Registro</h4>
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
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="registroMercantil" class="form-label">No. de Registro Mercantil:</label>
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
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" required onchange="calcularVigencia()">
                        </div>
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
