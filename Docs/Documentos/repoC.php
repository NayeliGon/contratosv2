<?php
require('../fpdf186/fpdf.php');
require('conexion_bd.php'); // Conexión a la base de datos

class PDF extends FPDF
{
    function Header()
    {
        // Ruta de la imagen de fondo
        $path = realpath(__DIR__ . '/ContratoBC.jpeg');
        if (!$path) {
            die('Error: Imagen de fondo no encontrada.');
        }

        // Insertar imagen de fondo que cubra toda la página
        $this->Image($path, 0, 0, $this->GetPageWidth(), $this->GetPageHeight());

        // Posicionar el título
        $this->SetY(15);
        $this->SetFont('Times', 'B', 12);
        $this->SetTextColor(0, 0, 128);
        $this->Cell(0, 10, utf8_decode('CONTRATO DE PRESTACIÓN DE SERVICIOS -FEL-'), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        // Posicionar el pie de página a 15mm del final
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 8);
        $this->SetTextColor(128, 128, 128);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function AddSection($title, $content)
    {
        // Título en negrita
        $this->SetFont('Times', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, utf8_decode($title), 0, 1, 'L');
        $this->Ln(2);

        // Contenido con ciertas partes en negrita
        $this->SetFont('Times', '', 10);
        $this->MultiCell(0, 8, utf8_decode($content), 0, 'J');
        $this->Ln(8);
    }

    function WriteTextWithBold($text, $boldSections = [])
    {
        $this->SetFont('Times', '', 12);
        $this->SetTextColor(0, 0, 0);

        foreach ($boldSections as $bold) {
            $parts = explode($bold, $text, 2);
            $this->Write(8, utf8_decode($parts[0]));  // Texto normal
            $this->SetFont('Times', 'B', 12);
            $this->Write(8, utf8_decode($bold));  // Texto en negrita
            $this->SetFont('Times', '', 12);
            $text = $parts[1] ?? '';
        }
        // Escribir el resto del texto si quedó algo
        if (!empty($text)) {
            $this->Write(8, utf8_decode($text));
        }
    }
}

// Crear instancia del PDF y establecer márgenes personalizados (25.4 mm)
$pdf = new PDF();
$pdf->SetMargins(25.4, 25.4, 25.4);  // Margen de 25.4 mm (2.54 cm) en izquierda, arriba y derecha
$pdf->SetAutoPageBreak(true, 25.4);   // Margen de 25.4 mm (2.54 cm) abajo
$pdf->AddPage();

// Variables estaticas 
$Corpo_nombre = 'ERIK LEONEL PAZ CHÉN';
$Corpor_edad = 'cuarenta y ocho años';
$Dpi_corpo = '1636 88699 1608';
$Muni_corpo = 'Cobán';
$Dep_corpo = 'Alta Verapaz';

// Texto con secciones en negrita
$entreNosotros = "

        Entre Nosotros      
                    a) $Corpo_nombre, de $Corpor_edad, casado, empresario, guatemalteco, de este domicilio, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) un mil seiscientos treinta y seis, ochenta y ocho mil seiscientos noventa y nueve, un mil seiscientos ocho ($Dpi_corpo) extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de $Muni_corpo, del departamento de $Dep_corpo, quien comparece en su calidad de ADMINISTRADOR ÚNICO Y REPRESENTANTE LEGAL de la entidad CORPOSISTEMAS, SOCIEDAD ANONIMA, en lo sucesivo CORPOSISTEMAS calidad que acredita con el Acta Notarial de su nombramiento autorizada en esta ciudad el día tres de julio del dos mil veinte por el Notario MANUEL ANTONIO LÓPEZ OLIVA, el cual se encuentra debidamente inscrito en el Registro Mercantil General de la República bajo el número de Registro seiscientos mil doscientos dos (600202) folio doscientos quince (215) del Libro setecientos cincuenta y uno (751) de Auxiliares de Comercio.";

// Validación del ID del contrato
if (isset($_GET['id_contrato']) && is_numeric($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];

    // Consulta para obtener los datos del contrato
    $sql = "SELECT `id_contrato`, `edad_corpo`, `nombre_emisor`, `edad_emisor`, `dpi_emisor`, `departamento_emision_emisor`, `municipio_emision_emisor`, `representante_emisor`, `entidad_emisor`, `acredita_emisor`, `notario_emisor`, `fecha_acredita_emisor`, `registro_mercantil_emisor`, `folio_emisor`, `libro_emisor`, `nombre_distribuidor`, `edad_distribuidor`, `dpi_distribuidor`, `departamento_emision_distribuidor`, `municipio_emision_distribuidor`, `representante_distribuidor`, `entidad_distribuidor`, `acredita_distribuidor`, `notario_distribuidor`, `fecha_acredita_distribuidor`, `registro_mercantil_distribuidor`, `folio_distribuidor`, `libro_distribuidor`, `actividad_economica`, `nit_emisor`, `nit_distribuidor`, `fecha_vigencia`, `fecha_creacion`, `fecha_actualizacion` FROM `contrato_c` WHERE id_contrato = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id_contrato]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        // Configurar localización en español
        setlocale(LC_TIME, 'es_ES.UTF-8');

        // Variables dinámicas del contrato C
        $nombre_emisor = $data['nombre_emisor'] ?? 'No definido';
        $direccion_emisor = $data['direccion_emisor'] ?? 'Dirección no definida'; // Dirección del emisor
        $edad_emisor = ucfirst(num2letras($data['edad_emisor'] ?? 0));
        $dpi_emisor_letras = num2letrasDPI($data['dpi_emisor'] ?? '0000000000000');
        $dpi_emisor_num = $data['dpi_emisor'] ?? '0000000000000';
        $municipio_emision_emisor = $data['municipio_emision_emisor'] ?? 'No definido';
        $departamento_emision_emisor = $data['departamento_emision_emisor'] ?? 'No definido';
        $entidad_emisor = $data['entidad_emisor'] ?? 'No definido';
        $notario_emisor = $data['notario_emisor'] ?? 'No definido';
        $registro_mercantil_emisor_letras = num2letras($data['registro_mercantil_emisor'] ?? 0);
        $registro_mercantil_emisor_num = $data['registro_mercantil_emisor'] ?? 0;
        $folio_emisor_letras = num2letras($data['folio_emisor'] ?? 0);
        $folio_emisor_num = $data['folio_emisor'] ?? 0;
        $libro_emisor_letras = num2letras($data['libro_emisor'] ?? 0);
        $libro_emisor_num = $data['libro_emisor'] ?? 0;
        $fecha_acredita_emisor = fechaALetras($data['fecha_acredita_emisor'] ?? '');

        $nombre_distribuidor = $data['nombre_distribuidor'] ?? 'No definido';
        $direccion_distribuidor = $data['direccion_distribuidor'] ?? 'Dirección no definida'; // Dirección del distribuidor
        $edad_distribuidor = ucfirst(num2letras($data['edad_distribuidor'] ?? 0));
        $dpi_distribuidor_letras = num2letrasDPI($data['dpi_distribuidor'] ?? '0000000000000');
        $dpi_distribuidor_num = $data['dpi_distribuidor'] ?? '0000000000000';
        $municipio_emision_distribuidor = $data['municipio_emision_distribuidor'] ?? 'No definido';
        $departamento_emision_distribuidor = $data['departamento_emision_distribuidor'] ?? 'No definido';
        $entidad_distribuidor = $data['entidad_distribuidor'] ?? 'No definido';
        $notario_distribuidor = $data['notario_distribuidor'] ?? 'No definido';
        $registro_mercantil_distribuidor_letras = num2letras($data['registro_mercantil_distribuidor'] ?? 0);
        $registro_mercantil_distribuidor_num = $data['registro_mercantil_distribuidor'] ?? 0;
        $folio_distribuidor_letras = num2letras($data['folio_distribuidor'] ?? 0);
        $folio_distribuidor_num = $data['folio_distribuidor'] ?? 0;
        $libro_distribuidor_letras = num2letras($data['libro_distribuidor'] ?? 0);
        $libro_distribuidor_num = $data['libro_distribuidor'] ?? 0;
        $fecha_acredita_distribuidor = fechaALetras($data['fecha_acredita_distribuidor'] ?? '');
        $actividad_economica = $data['actividad_economica'] ?? 'Actividad económica no definida';

        // Extraer la fecha de inicio de vigencia desde la base de datos
        $fecha_vigencia_inicio = $data['fecha_vigencia'] ?? '2021-05-01'; // Valor por defecto de ejemplo
        $fecha_vigencia_inicio_texto = fechaALetras($fecha_vigencia_inicio);

        // Calcular la fecha de fin sumando un año
        $fecha_vigencia_fin = date('Y-m-d', strtotime($fecha_vigencia_inicio . ' +1 year'));
        $fecha_vigencia_fin_texto = fechaALetras($fecha_vigencia_fin);


        // Sección B del contrato
        $entreNosotrosBC = "
          b) $nombre_emisor, de $edad_emisor años, de este domicilio, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) $dpi_emisor_letras ($dpi_emisor_num), extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de $municipio_emision_emisor, del departamento de $departamento_emision_emisor, quien comparece en su calidad de PROPIETARIO O REPRESENTANTE LEGAL de la entidad $entidad_emisor., (en adelante indistintamente denominado como 'EL CONTRATANTE' o 'EL EMISOR') calidad que acredita con patente de comercio o acta notarial de nombramiento autorizada en esta ciudad el $fecha_acredita_emisor por el notario $notario_emisor, el cual se encuentra inscrito en el Registro Mercantil General de la República de Guatemala, bajo el número de registro $registro_mercantil_emisor_letras ($registro_mercantil_emisor_num), folio $folio_emisor_letras ($folio_emisor_num), libro $libro_emisor_letras ($libro_emisor_num) de Auxiliares de Comercio.
";

        // Sección C del contrato
        $entreNosotrosBC .= "
        
        c) $nombre_distribuidor, de $edad_distribuidor años, de este domicilio, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) $dpi_distribuidor_letras ($dpi_distribuidor_num), extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de $municipio_emision_distribuidor, del departamento de $departamento_emision_distribuidor, quien comparece en su calidad de PROPIETARIO O REPRESENTANTE LEGAL de la entidad $entidad_distribuidor., (en adelante indistintamente denominado como 'EL DISTRIBUIDOR') calidad que acredita con patente de comercio o acta notarial de nombramiento autorizada en esta ciudad el $fecha_acredita_distribuidor por el notario $notario_distribuidor, el cual se encuentra inscrito en el Registro Mercantil General de la República de Guatemala, bajo el número de registro $registro_mercantil_distribuidor_letras ($registro_mercantil_distribuidor_num), folio $folio_distribuidor_letras ($folio_distribuidor_num), libro $libro_distribuidor_letras ($libro_distribuidor_num) de Auxiliares de Comercio.

        Por tanto, EL CONTRATANTE Y CORPOSISTEMAS. Hemos convenido celebrar un CONTRATO DE PRESTACIÓN DE SERVICIOS DE EMISIÓN, TRANSMISIÓN, CERTIFICACIÓN Y CONSERVACIÓN DE DOCUMENTOS TRIBUTARIOS ELECTRÓNICOS. Con base en las siguientes cláusulas:
";
        $antecedentes = "
ANTECEDENTES: De la distribución de los servicios
a) Que las entidades CORPOSISTEMAS y $nombre_distribuidor (en adelante EL DISTRIBUIDOR) han constituido previamente un acuerdo para la distribución de los servicios de emisión, transmisión, certificación y conservación de documentos tributarios electrónicos (en adelante LOS SERVICIOS) que CORPOSISTEMAS presta como certificador autorizado ante la Superintendencia de Administración Tributaria -SAT-.
b) Que, en virtud de dicho acuerdo, EL DISTRIBUIDOR ha convenido con EL CONTRATANTE la prestación de LOS SERVICIOS a través de CORPOSISTEMAS. Sin embargo, en cumplimiento a lo establecido por acuerdos y leyes de la materia, CORPOSISTEMAS y EL CONTRATANTE celebran el presente contrato del Régimen de Factura Electrónica en Línea para establecer la relación entre Certificador y Emisor.
c) Que la obligación de la celebración del contrato que materialice la relación existente entre EL DISTRIBUIDOR y EL CONTRATANTE es a cargo del DISTRIBUIDOR y completamente independiente y ajena a CORPOSISTEMAS.
d) Que las obligaciones de CORPOSISTEMAS frente a EL CONTRATANTE son única y exclusivamente las acordadas en el presente contrato y que bajo ningún motivo deberá entenderse que dichas obligaciones se extienden a lo que en contrato aparte acuerden EL DISTRIBUIDOR y EL CONTRATANTE.
e) Que, la contraprestación por los servicios de emisión, transmisión, certificación y conservación de documentos tributarios electrónicos que CORPOSISTEMAS preste a EL CONTRATANTE deberán ser cancelados directamente por EL DISTRIBUIDOR a CORPOSISTEMAS, en base a lo acordado en el acuerdo de distribución existente entre la entidad $nombre_distribuidor, en su calidad de distribuidor del servicio y CORPOSISTEMAS, SOCIEDAD ANÓNIMA en su calidad de Certificador. Por consiguiente, EL DISTRIBUIDOR se declara único obligado frente a CORPOSISTEMAS por el pago de los servicios que esta última preste a EL CONTRATANTE en base a lo establecido en el presente contrato.
EL DISTRIBUIDOR, EL CONTRATANTE Y CORPOSISTEMAS aceptan y reconocen expresamente lo establecido en las presentes cláusulas:
";
        $primera = "
PRIMERA: El representante legal de la entidad CORPOSISTEMAS, SOCIEDAD ANONIMA, declara:
a) Que su representada es una entidad mercantil organizada, autorizada y reconocida de conformidad con las leyes de la República de Guatemala, cuya actividad, entre otras, consiste en la prestación de servicios de transformación, firmado electrónico, resguardo y consulta de documentos tributarios electrónicos de conformidad con la normativa legal vigente en este país.
";

        // Sección SEGUNDA del contrato
        $segunda = "
SEGUNDA: Por su parte, $nombre_emisor, declara:
a) Que su representada es una Entidad Mercantil, organizada, autorizada y reconocida de conformidad con las leyes de Guatemala, que se dedica, con capitales y personal propio a: $actividad_economica (Objeto según Patente de Comercio o Patente de Sociedad).
";
        // TERCERA: Obligaciones del prestador de servicios
        $tercera = "
    TERCERA: Obligaciones que adquiere el prestador de los servicios. Como consecuencia de este convenio CORPOSISTEMAS adquiere las siguientes obligaciones:
    a) Prestar los servicios que se le requieren con recursos y personal propio;
    b) El personal que utilice para la prestación de estos servicios deberá estar vinculado con CORPOSISTEMAS mediante un contrato o relación de trabajo; en consecuencia, CORPOSISTEMAS, será el único responsable de cumplir con todas y cada una de las obligaciones laborales que la legislación guatemalteca le impone, tanto a la celebración del contrato, a las obligaciones que deriven durante su vigencia, como a las obligaciones que deriven por la terminación de tales contratos de trabajo.
    c) Prestar los Servicios de conformidad a los requerimientos, especificaciones y calidad requeridos por $nombre_emisor, así como cumplir con la obligación de confidencialidad respecto de la información que le sea proporcionada por $nombre_emisor, de conformidad con lo que para el efecto establece el presente contrato.
    d) Y, en general, cumplir el cometido o fin para el que es contratado, esto es: La prestación de los servicios para el funcionamiento de la factura electrónica.
    e) CORPOSISTEMAS se obliga a entregar todos los DTE a la SAT.
    f) CORPOSISTEMAS reconoce que los DTE con firma electrónica de emisión válida y certificados son irrefutables para fines legales, judiciales y tributarios respecto de los datos firmados.
    g) CORPOSISTEMAS y el EMISOR suscriben el presente contrato del Régimen de Factura Electrónica en Línea, aceptan los requisitos y criterios de seguridad de la información establecidos por la SAT y sus futuras actualizaciones.
    h) CORPOSISTEMAS mantendrá habilitada las distintas vías de comunicación para atender los casos reportados por el EMISOR, en el horario de 8:00 a 12:00 y 14:00 a 18:00 de lunes a viernes y los días sábado de 8:00 a 12:00 hrs., la atención en horarios extraordinarios estará sujeto a un costo adicional al acordado en el presente contrato.
    i) CORPOSISTEMAS se compromete a no divulgar a terceros no autorizados ni a utilizar para fines distintos al Régimen de Factura Electrónica en Línea, la información del EMISOR a que tenga acceso por la prestación del servicio.
    j) CORPOSISTEMAS es responsable por los servicios de Factura Electrónica en Línea que presta a sus clientes y releva expresamente a la SAT de cualquier obligación que resulte del incumplimiento de los contratos suscritos con los mismos; y cualquier acción u omisión que cause perjuicio al EMISOR y que pueda derivar en responsabilidad civil y penal.
";
        // Sección CUARTA del contrato
        $cuarta_seccion = "
CUARTA: De las obligaciones DEL CONTRATANTE, como solicitante de los servicios, adquiere las siguientes obligaciones:
a) Proporcionar y cumplir en lo que le corresponda con todos los lineamientos, especificaciones y autorizaciones necesarias para la prestación de los servicios; que incluye, pero no se limita a proporcionar la documentación e información que más adelante se detalla y se define como 'Información Confidencial' para los propósitos de este contrato.
b) Habilitarse como emisor de Documentos Tributarios Electrónicos DTE desde la Agencia Virtual de SAT.
c) En general, facilitar al prestador de los servicios el cumplimiento de las obligaciones que adquiere en este instrumento.
d) La entidad contratante deberá respetar y acatar las disposiciones legales contenidas en:
    - Declaración Universal de los Derechos Humanos (1947);
    - El Pacto Internacional de los Derechos Civiles y Políticos (1966); 
    - El Pacto Internacional de Derechos Económicos, Sociales y Culturales (1966);
    - La Declaración de la Organización Mundial del Trabajo a los Principios y Derechos Fundamentales en el Trabajo (1998).
La entidad contratante deberá regirse por dicha normativa al respecto de las disposiciones fundamentales que establecen dichos cuerpos legales. Por lo que se entiende que respetará los ejes esenciales que hacen referencia a la discriminación, el trabajo infantil y trabajo forzoso en el desempeño de los servicios que se les proveen. En esa virtud, la entidad contratante se obliga a aplicar dichas disposiciones como consecuencia de la ejecución del presente convenio y el incumplimiento de las mismas, será causa de terminación de la relación comercial que por este documento se conviene.
e) Acepta y autoriza que CORPOSISTEMAS entregue a la SAT la información de los DTE.
f) Aceptación de las disposiciones del Régimen de Factura Electrónica en Línea, el EMISOR se sujeta a las condiciones de emisión de los DTE establecidas por la SAT, incluyendo los requisitos técnicos, la impresión, el almacenamiento y el uso de firmas electrónicas avanzadas como forma de identificación del EMISOR y CERTIFICADOR, lo que garantiza su autenticidad, integridad, validez y no repudio de los DTE.
g) Cada DTE que el EMISOR emita y entregue a CORPOSISTEMAS incluirá una firma electrónica de emisión, a efecto de garantizar la autenticidad, integridad, validez y aceptación de parte del EMISOR.
h) El EMISOR reconoce que los DTE con firma electrónica de emisión válida y certificados son irrefutables para fines legales, judiciales y tributarios respecto de los datos firmados.
i) El EMISOR y CORPOSISTEMAS suscriben el presente contrato del Régimen de Factura Electrónica en Línea, aceptan los requisitos y criterios de seguridad de la información establecidos por la SAT y sus futuras actualizaciones.
j) CORPOSISTEMAS tendrá a disposición del EMISOR formatos estándar gratuitos dentro del portal de facturación que cumplen con los requisitos legales.
k) EL EMISOR que decida elaborar su propio diseño de la representación gráfica de los documentos electrónicos que emita, será responsable de velar porque estos cumplan con los requisitos legales, previa autorización y aprobación de CORPOSISTEMAS. Así mismo cubrir los costos que ello requiera para elaborar dicho diseño.
l) Conservación de los DTE por EL EMISOR: El emisor debe conservar los archivos en formato XML de los DTE certificados mientras no haya transcurrido el plazo de prescripción que establece el Código Tributario, según lo establece el Artículo 21 del Acuerdo de Directorio Numero 13-2018.
";

        // Sección QUINTA del contrato
        $quinta_seccion = "
QUINTA: De los servicios. Los servicios que se obliga ejecutar CORPOSISTEMAS, S.A. son todos aquellos relacionados con la transformación según esquema global de funcionamiento autorizado por la Superintendencia de Administración Tributaria –SAT-, resguardo por el tiempo que exige la legislación tributaria vigente y consulta de documentos tributarios electrónicos.
Como complemento de lo anterior, CORPOSISTEMAS prestará los servicios específicos siguientes:
        - Servicio de consulta desde el portal web.
        - Envío de documentos tributarios electrónicos a través de correo electrónico. CORPOSISTEMAS no se responsabiliza por la recepción del correo electrónico del destinatario.
        - Servicio opcional de resguardo de DTE (Documento Tributario Electrónico) por un periodo mayor a lo establecido en el Código Tributario. Este es un servicio excepcional que deberá ser solicitado por el contratante a CORPOSISTEMAS, por medio escrito y estará sujeto a un costo adicional.
El Contratante reconoce que CORPOSISTEMAS no cambia ni controla la información contenida en los documentos tributarios electrónicos, por lo que es el Contratante el único responsable de los datos, los cálculos en ellos contenidos y la calidad de la información que se envía a CORPOSISTEMAS.
";
        $suspension_servicio = "
Suspensión del servicio por incumplimiento: La falta del pago del servicio por parte del DISTRIBUIDOR durante quince (15) días calendario contados a partir de la fecha en que el pago debió realizarse dará derecho a CORPOSISTEMAS para suspender el servicio objeto de este contrato, sin necesidad de aviso previo ni declaración judicial alguna a EL CONTRATANTE o a EL DISTRIBUIDOR, sin prejuicio del derecho de CORPOSISTEMAS de cobrar lo adecuado por la vía legal correspondiente.
EL CONTRATANTE reconoce que libera de responsabilidad de cualquier naturaleza a CORPOSISTEMAS en caso haya realizado el pago a EL DISTRIBUIDOR en tiempo, forma y modo acordado entre ambos, pero este último no se haya hecho efectivo a CORPOSISTEMAS por parte del DISTRIBUIDOR; por consiguiente, se compromete a realizar toda reclamación de cualquier naturaleza directamente a EL DISTRIBUIDOR.
Por su parte, CORPOSISTEMAS reanudará el servicio únicamente si EL DISTRIBUIDOR ha efectuado los pagos atrasados y los correspondientes a los cargos que se hubieren generado por el atraso, independientemente si dicho incumplimiento es imputable al DISTRIBUIDOR o a EL CONTRATANTE.
EL DISTRIBUIDOR y EL CONTRATANTE, aceptan y reconocen expresamente lo establecido en la presente cláusula.
";
        $contraprestacion = "
SÉPTIMA: Contraprestación.
La contraprestación por los servicios prestados, será obligación de EL DISTRIBUIDOR, de conformidad con lo establecido en los Antecedentes del presente contrato. De esta cuenta, el monto, tiempo, modo y forma de pago de los mismos constituyen un acuerdo exclusivo entre EL DISTRIBUIDOR y CORPOSISTEMAS.
Por consiguiente, EL DISTRIBUIDOR expresamente se obliga al pago de los servicios prestados por CORPOSISTEMAS a EL CONTRATANTE y reconoce que CORPOSISTEMAS bajo ninguna circunstancia se encuentra obligada a realizar gestiones de cobro a EL CONTRATANTE.
El incumplimiento de esta obligación de pago adquirida y reconocida por EL DISTRIBUIDOR, constituye causa suficiente para (a entera discreción de CORPOSISTEMAS):
a) Suspender parcialmente el servicio hasta el pago efectivo de los mismos, incluyendo gastos generados por dicha suspensión;
b) Terminar anticipadamente el presente contrato. Para ambos supuestos CORPOSISTEMAS podrá proceder sin necesidad de declaración previa ni responsabilidad de cualquier naturaleza y así lo reconocen conjuntamente EL DISTRIBUIDOR y EL CONTRATANTE.
";
        // Sección OCTAVA: Confidencialidad
        $confidencialidad = "
OCTAVA: Confidencialidad.
CORPOSISTEMAS tendrá acceso a cierta Información Confidencial (como adelante será definida) de la otra parte, por lo que ambas partes han convenido en celebrar un acuerdo de Confidencialidad, con el objeto de proteger tal Información Confidencial, de acuerdo a las estipulaciones siguientes:
a) Definición. El término 'Información Confidencial' se refiere a toda y cualquier propiedad intelectual, información del negocio, información confidencial y cualquier otra información proporcionada por 'EL CONTRATANTE'. La Información Confidencial incluye, sin que esta descripción se considere limitativa, lo siguiente:
        (i) Información de mercadotecnia ('marketing') y sus métodos, incluyendo los datos de mercadotecnia, investigaciones, técnicas de ventas, y los nombres, direcciones, números de teléfono y facsímile, y las operaciones, hábitos de compra y prácticas de los clientes, clientes potenciales, distribuidores y representantes;
        (ii) Información concerniente a trabajadores de 'LAS PARTES', incluyendo los términos y condiciones de empleo y resultados de evaluaciones;
        (iii) Información concerniente a métodos de compra y proveedores, incluyendo los nombres y cualquier otra forma de identificación de vendedores, suministradores y proveedores, costos de materiales, y los precios en que dichos materiales, productos o servicios son o han sido obtenidos o vendidos;
        (iv) Información financiera, incluyendo estados financieros interinos y auditados, planes, proyectos, reportes y cualquier otra información financiera que no deba hacerse pública;
        (v) Documentación sobre procesos importantes de la entidad $nombre_emisor, manuales de procedimientos, políticas contables, organigrama, etc. y, Cualquier otra información de carácter confidencial y que así sea marcada o que sea propiedad de 'LAS PARTES', concerniente a procesos, productos o servicios.
b) Objeto. Ambas partes convienen mutuamente en mantener toda Información Confidencial en estricta confidencialidad. La parte Receptora no debe, directa o indirectamente, usar, copiar, transferir o revelar Información Confidencial de la otra parte o de terceros, únicamente si fuere expresamente autorizado por la gerencia de 'LAS PARTES'. La parte Receptora acuerda proteger la confidencialidad, y tomar todas las medidas tendientes a prevenir la filtración de Información Confidencial a personas o entidades no autorizadas. En caso de que la parte Receptora llegare a tener conocimiento de cualquier revelación, filtración o uso inapropiado de Información Confidencial de parte de cualquier persona individual o jurídica, deberá hacerlo saber por escrito a 'EL CONTRATANTE' o CORPOSISTEMAS, según sea el caso.
c) Plazo. Las partes están obligadas a mantener dicha información en forma confidencial durante todo el plazo del presente contrato, y por cuatro años adicionales posteriores al vencimiento o terminación del plazo.
d) No aplicación. Las Partes acuerdan que no estará sujeta a los términos y condiciones del presente acuerdo de confidencialidad:
        (i) Toda información que estaba ya en posesión de CORPOSISTEMAS o le era conocida sin tener la obligación de darle el tratamiento de confidencial, anteriormente a recibirla;
        (ii) Toda información que haya sido desarrollada de manera independiente por CORPOSISTEMAS sin infringir lo establecido en el presente acuerdo de confidencialidad;
        (iii) La información que sea o se convierta en información de dominio público, siempre y cuando lo anterior no se derive de actos ilegales;
        (iv) La que sea requerida por autoridad competente en ejercicio de sus funciones o por requerimiento legal.
";

        $propiedadIntelectual = "
NOVENA: Propiedad intelectual.

EL CONTRATANTE reconoce que todos los elementos que constituyen el sistema proporcionado por CORPOSISTEMAS para la conversión a Documentos Tributarios Electrónicos no le es transferido en propiedad. Quedan reservados todos los derechos de autor y propiedad intelectual de la plataforma de software, documentación y cualquier otro elemento que le proporcione CORPOSISTEMAS al CONTRATANTE para su uso, no es propiedad del CONTRATANTE. La violación a las disposiciones de este párrafo otorga a CORPOSISTEMAS el derecho a dar por terminado el contrato y obligan al CONTRATANTE a responder por daños y perjuicios ocasionados al dueño del sistema y a CORPOSISTEMAS.
";

        // Sección DÉCIMA: Vigencia
        $vigencia = "
DÉCIMA: Vigencia.

El presente contrato se suscribe por un plazo de un año, contado a partir del $fecha_vigencia_inicio_texto al $fecha_vigencia_fin_texto. En caso de no existir notificación alguna por parte del CONTRATANTE, el contrato se renovará de forma automática, una vez finalizada la vigencia del mismo y por periodos anuales.
";

        // Sección DÉCIMA PRIMERA: Terminación
        $terminacion = "
DÉCIMA PRIMERA: Terminación.

La terminación del presente contrato podrá ocurrir en cualquier momento y antes de la terminación del plazo fijado, por voluntad de cualquiera de LAS PARTES, dando un aviso en ese sentido con treinta (30) días calendario de anticipación. La única obligación que adquiere el CONTRATANTE es pagar por el almacenamiento por obligatoriedad de la Superintendencia de Administración Tributaria (SAT) de 48 meses por los documentos que se certificaron a un valor de Q.0.0020 por documento mensual, tomando en cuenta que el plazo de resguardo empieza a partir de la fecha de emisión del documento. Si por requerimiento de la Superintendencia de Administración Tributaria (SAT) el plazo de resguardo se ampliara, este monto se trasladará hasta la finalización de dicho plazo, además deberá cancelar cualquier factura que a esa fecha estuviere pendiente de pago por el CONTRATANTE.

Asimismo, CORPOSISTEMAS podrá terminar anticipadamente el presente contrato sin necesidad de declaración previa ni responsabilidad de cualquier naturaleza por falta de pago de conformidad con lo establecido en la cláusula séptima del presente contrato.
";
        $decima_segunda = "
DÉCIMA SEGUNDA: Naturaleza de la relación y resolución de controversias.

La relación que se establece entre las partes es de carácter mercantil y cualquier reclamación que surja una en contra de la otra, en base únicamente a las obligaciones contraídas en el presente contrato, deberá ser resuelta en forma directa y amistosa. En el caso que después de treinta (30) días CORPOSISTEMAS y EL CONTRATANTE no se pongan de acuerdo en resolver la misma, ambas partes renuncian desde ya al fuero de su domicilio y se someten expresamente a los tribunales del departamento de Alta Verapaz, Guatemala.
";
        $disposiciones_finales = "
DÉCIMA TERCERA: Disposiciones finales.

(i) Ley Aplicable. Para la ejecución e interpretación de este Contrato, aplicarán las leyes de la República de Guatemala.
(ii) Acuerdo Completo: Las PARTES reconocen mutuamente que este Contrato constituye y expresa el único acuerdo entre ellos en relación a los asuntos aquí referidos. Cualesquiera discusiones, promesas, representaciones y entendimientos previos han sido sustituidos en su totalidad por el presente acuerdo y por lo tanto son inaplicables.
(iii) Modificaciones: Cualquier acuerdo de modificación, cambio, prórroga o terminación que acuerden las PARTES al presente Contrato, sea total o parcial, será válido en tanto el mismo sea documentado por escrito y suscrito por CORPOSISTEMAS y por EL CONTRATANTE.
(iv) Divisibilidad: Si alguna disposición de este Contrato resultare inválida o ilegal se tendrá por no puesta, pero la legalidad y validez del resto del Contrato no se verá afectada o limitada por dicha omisión.
(v) Notificaciones: Toda notificación y cualesquiera otras comunicaciones que puedan o deban realizarse de conformidad con este Contrato, deberán hacerse por escrito, enviadas por medios electrónicos o entregadas personalmente y se tendrán por entregadas en el momento en que las mismas sean recibidas, salvo disposición en contrario:

- CORPOSISTEMAS, S.A.: 2ª. Calle 7-57, Zona 4, Cobán, Alta Verapaz.
- $nombre_emisor: $direccion_emisor.
- $nombre_distribuidor: $direccion_distribuidor.

(vi) Renuncia: Ningún incumplimiento de este Contrato podrá ser desestimado de no ser por escrito por la Parte que pueda desestimarlo. La desestimación y renuncia de cualquiera de las Partes, o el hecho de no reclamar el incumplimiento de cualquier cláusula de este Contrato, no será entendido como la renuncia a cualquier reclamo por incumplimiento subsiguiente.

Leído lo anterior estamos conformes, ratificamos y firmamos en la Ciudad de Cobán, Alta Verapaz, el día $fecha_vigencia_inicio_texto.
";








        // Crear instancia del PDF y establecer márgenes personalizados (25.4 mm = 2.54 cm)
        $pdf = new PDF();
        $pdf->SetMargins(25.4, 25.4, 30.4);  // Margen de 2.54 cm en izquierda, arriba y derecha
        $pdf->SetAutoPageBreak(true, 25.4);   // Margen de 2.54 cm abajo
        $pdf->AddPage();

        // Establecer el tamaño de fuente a 10 y justificar el texto
        $pdf->SetFont('Times', '', 10);

        // Agregar la primera sección (A) al PDF
        $pdf->MultiCell(0, 8, utf8_decode($entreNosotros), 0, 'J');

        // Agregar la segunda sección (B y C) al PDF
        $pdf->MultiCell(0, 8, utf8_decode($entreNosotrosBC), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($antecedentes), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($primera), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($segunda), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($tercera), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($cuarta_seccion), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($quinta_seccion), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($suspension_servicio), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($contraprestacion), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($confidencialidad), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($propiedadIntelectual), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($vigencia), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($terminacion), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($decima_segunda), 0, 'J');
        $pdf->MultiCell(0, 8, utf8_decode($disposiciones_finales), 0, 'J');
        // Generar y mostrar el PDF
        $pdf->Output('I', 'Contrato_FEL_SeccionBC.pdf');
    } else {
        echo "Contrato no encontrado.";
    }
} else {
    echo "ID del contrato no proporcionado o no válido.";
}

// Secciones en negrita
$boldSections = [
    'ERIK LEONEL PAZ CHÉN',
    'ADMINISTRADOR ÚNICO Y REPRESENTANTE LEGAL',
    'CORPOSISTEMAS, SOCIEDAD ANONIMA'
];

// Añadir el contenido de la sección con negritas
$pdf->WriteTextWithBold($entreNosotros, $boldSections);

// Generar el PDF
$pdf->Output('I', 'Contrato_FEL_Entre_Nosotros.pdf');
// Función para convertir números en letras
function num2letras($num)
{
    $unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
    $decenas = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
    $centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

    if ($num == 0) {
        return 'cero';
    }

    if ($num == 100) {
        return 'cien';
    }

    if ($num < 20) {
        return $unidades[$num];
    }

    if ($num < 100) {
        $decena = intdiv($num, 10);
        $unidad = $num % 10;
        return $unidad ? $decenas[$decena] . ' y ' . $unidades[$unidad] : $decenas[$decena];
    }

    if ($num < 1000) {
        $centena = intdiv($num, 100);
        $resto = $num % 100;
        return $centenas[$centena] . ' ' . num2letras($resto);
    }

    if ($num < 1000000) {
        $miles = intdiv($num, 1000);
        $resto = $num % 1000;
        if ($miles == 1) {
            return 'mil ' . num2letras($resto);
        }
        return num2letras($miles) . ' mil ' . num2letras($resto);
    }

    if ($num < 1000000000) {
        $millones = intdiv($num, 1000000);
        $resto = $num % 1000000;
        if ($millones == 1) {
            return 'un millón ' . num2letras($resto);
        }
        return num2letras($millones) . ' millones ' . num2letras($resto);
    }

    return 'Número demasiado grande para convertir';
}

// Función para convertir DPI a letras
function num2letrasDPI($dpi)
{
    $partes = str_split($dpi, 4);  // Dividir el DPI en bloques de 4 dígitos
    $letras = [];

    foreach ($partes as $parte) {
        $letras[] = num2letras(intval($parte));  // Convertir cada parte a letras
    }

    return implode(' ', $letras);  // Unir las partes convertidas con espacios
}

// Función para convertir fechas a letras
function fechaALetras($fecha)
{
    setlocale(LC_TIME, 'es_ES.UTF-8');  // Configurar localización en español
    return strftime('%d de %B de %Y', strtotime($fecha));  // Formato: 1 de enero de 2023
}
