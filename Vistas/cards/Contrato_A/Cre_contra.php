
<div class="">
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
            <input type="text" class="form-control" id="nombreEmisor" name="nombreEmisor" value="<?php echo $representante['nombre']; ?>" readonly>
        </div>
        <div class="col-md-4 mb-3">
            <label for="edadEmisor" class="form-label">Edad:</label>
            <input type="number" class="form-control" id="edadEmisor" name="edadEmisor" value="" readonly>
        </div>
        <div class="col-md-4 mb-3">
            <label for="dpiEmisor" class="form-label">DPI:</label>
            <input type="text" class="form-control" id="dpiEmisor" name="dpiEmisor" value="<?php echo $representante['dpi']; ?>" readonly>
        </div>
            </div>

            <div class="divider"></div>

            <!-- Datos del Receptor -->
            <h4 class="mb-3">Datos del CLiente</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombreReceptor" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombreReceptor" name="nombreReceptor" placeholder="Nombre del Representante Legal" required>
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
                    <label for="domicilioReceptor" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" id="domicilioReceptor" name="domicilioReceptor" placeholder="Ingresa el domicilio" required>
                </div>
                <!--
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
</script>-->

                <div class="col-md-6 mb-3">
                    <label for="nombreContratante" class="form-label">Nombre Entidad</label>
                    <input type="text" class="form-control" id="nombreContratante" name="nombreContratante" placeholder="Ingresa el nombre del contratante" required>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Patente de Comercio -->
            <h4 class="mb-3">Registro Mercantil</h4>
            <div class="row">
                 <!-- <div class="col-md-4 mb-3">
                    <label for="fechaPatente" class="form-label">Fecha de Autorización:</label>
                    <input type="date" class="form-control" id="fechaPatente" name="fechaPatente" required>
                </div>-->
                <div class="col-md-4 mb-3">
                    <label for="numeroInscripcion" class="form-label">Número de Registro</label>
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
                <div class="col-md-3 mb-3">
                    <label for="rango_documentos" class="form-label">Rango del Contratante:</label>
                    <input type="text" class="form-control" id="rango_documentos" name="rango_documentos" placeholder="Ingresa el rango del contratante" required>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Información del Contrato -->
            <h4 class="mb-3">Información del Contrato</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cobroUnico" class="form-label">Implementación</label>
                    <input type="number" class="form-control" id="cobroUnico" name="cobroUnico" placeholder="Cobro único" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fechaValidez" class="form-label">Fecha de Validez:</label>
                    <input type="date" class="form-control" id="fechaValidez" name="fechaValidez" required>
                </div>

                <!--<div class="col-md-6 mb-3">
                    <label for="direccionContratante" class="form-label">Dirección del Contratante:</label>
                    <input type="text" class="form-control" id="direccionContratante" name="direccionContratante" placeholder="Ingresa la dirección del contratante" required>
                </div>-->
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">Crear Contrato</button>
        </form>
    </div>
</div>

<script>
    function calcularEdad(fechaNacimiento) {
        if (!fechaNacimiento) return "";
        let fechaNac = new Date(fechaNacimiento);
        let hoy = new Date();
        let edad = hoy.getFullYear() - fechaNac.getFullYear();
        let mes = hoy.getMonth() - fechaNac.getMonth();
        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
            edad--;
        }
        return edad;
    }

    document.addEventListener("DOMContentLoaded", function () {
        let fechaNacimiento = "<?php echo $representante['fecha_nacimiento']; ?>";
        document.getElementById("edadEmisor").value = calcularEdad(fechaNacimiento);
    });
</script>
