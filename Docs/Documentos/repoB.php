<?php
require('../fpdf186/fpdf.php');
require('conexion_bd.php'); // Conexión a la base de datos

class PDF extends FPDF
{
    function Header()
    {
        $path = realpath(__DIR__ . '/ContratoBC.jpeg');
        if (!$path) {
            die('Error: Imagen de fondo no encontrada.');
        }
        $this->Image($path, 0, 0, $this->GetPageWidth(), $this->GetPageHeight());

        $this->SetY(15);
        $this->SetFont('Times', 'B', 12);
        $this->SetTextColor(0, 0, 128);
        $this->Cell(0, 10, utf8_decode(''), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 8);
        $this->SetTextColor(128, 128, 128);
        $this->Cell(0, 10, '' . $this->PageNo(), 0, 0, 'C');
    }

    function AddSection($content)
    {
        $this->SetFont('Times', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 8, utf8_decode($content), 0, 'J');

        $this->Ln(8);
    }
}

// Obtener la fecha actual
$dia_actual = date('d');
$mes_actual = date('F');
$año_actual = date('Y');

// Validación del ID del contrato
if (isset($_GET['id_contrato']) && is_numeric($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];

    $sql = "SELECT * FROM contrato_b WHERE id_contrato = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id_contrato]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $pdf = new PDF();
        $pdf->AddPage();

        // Variables dinámicas del contrato B
        $nombre_emisor = $data['nombre_emisor'] ?? 'No definido';
        $edad_emisor = ucfirst(num2letras($data['edad_emisor'] ?? 0));
        $dpi_emisor = num2letrasDPI($data['dpi_emisor'] ?? '0000000000000');
        $nombre_distribuidor = $data['nombre_distribuidor'] ?? 'No definido';
        $edad_distribuidor = ucfirst(num2letras($data['edad_distribuidor'] ?? 0));
        $domicilio_distribuidor = $data['domicilio_distribuidor'] ?? 'No definido';
        $dpi_distribuidor = num2letrasDPI($data['dpi_distribuidor'] ?? '0000000000000');
        $municipio = $data['municipio'] ?? 'No definido';
        $departamento = $data['departamento'] ?? 'No definido';
        $representante_legal = $data['representante_legal'] ?? 'No definido';
        $entidad = $data['entidad'] ?? 'No definido';
        $tipo_documento = $data['tipo_documento'] ?? 'No definido';
        $notario = $data['notario'] ?? 'No definido';
        $registro_mercantil = num2letras($data['registro_mercantil'] ?? 0);
        $folio = num2letras($data['folio'] ?? 0);
        $libro = num2letras($data['libro'] ?? 0);
        $nit = $data['nit'] ?? 'No definido';
        $fecha_inicio = fechaALetras($data['fecha_inicio'] ?? '');
        $fecha_fin = fechaALetras($data['fecha_fin'] ?? '');
        $direccion_distribuidora = $data['direccion_distribuidora'] ?? 'No definida';

        // Contenido de la sección "Entre nosotros"
        $entreNosotros = "

    Entre nosotros:       
            a) $nombre_emisor, de $edad_emisor años, casado, empresario, guatemalteco, de este domicilio, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) " . num2letrasDPI($data['dpi_emisor']) . " ({$data['dpi_emisor']}) extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de Cobán, del departamento de Alta Verapaz, quien comparece en su calidad de ADMINISTRADOR ÚNICO Y REPRESENTANTE LEGAL de la entidad CORPOSISTEMAS, SOCIEDAD ANONIMA, en lo sucesivo CORPOSISTEMAS, calidad que acredita con el Acta Notarial de su nombramiento autorizada en esta ciudad el día tres de julio del dos mil veinte por el Notario MANUEL ANTONIO LÓPEZ OLIVA, el cual se encuentra debidamente inscrito en el Registro Mercantil General de la República bajo el número de Registro seiscientos mil doscientos dos (600202) folio doscientos quince (215) del Libro setecientos cincuenta y uno (751) de Auxiliares de Comercio;
            b) $nombre_distribuidor, de $edad_distribuidor años, domiciliado en $domicilio_distribuidor, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) " . num2letrasDPI($data['dpi_distribuidor']) . " ({$data['dpi_distribuidor']}) extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de $municipio, del departamento de $departamento, quien comparece en su calidad de PROPIETARIO O REPRESENTANTE LEGAL de la entidad $entidad, (en adelante indistintamente denominado como 'EL CONTRATANTE'), calidad que acredita con patente de comercio o acta notarial de nombramiento autorizada en esta ciudad el día $dia_actual del mes de $mes_actual del año $año_actual por el notario $notario, el cual se encuentra inscrito en el Registro Mercantil General de la República de Guatemala, bajo el número de registro " . num2letras($data['registro_mercantil']) . " ({$data['registro_mercantil']}), folio " . num2letras($data['folio']) . " ({$data['folio']}), libro " . num2letras($data['libro']) . " ({$data['libro']}) de Auxiliares de Comercio.
En conjunto y para los efectos de este contrato conocidos ambos como 'LAS PARTES'.";

         $entreNosotros2 = "Hemos convenido celebrar un CONTRATO DE PRESTACIÓN DE SERVICIOS DE EMISIÓN, TRANSMISIÓN, CERTIFICACIÓN Y CONSERVACIÓN DE DOCUMENTOS TRIBUTARIOS ELECTRÓNICOS. Con base en las siguientes cláusulas:";  
                                
                                
            // Sección Primera y Segunda del contrato
        $seccionPrimera = " El representante legal de la entidad CORPOSISTEMAS, SOCIEDAD ANONIMA, declara:";
        $seccionPrimeraA = "a) Que su representada es una entidad mercantil organizada, autorizada y reconocida de conformidad con las leyes de la República de Guatemala, cuya actividad, entre otras, consiste en la prestación de servicios de transformación, firmado electrónico, resguardo y consulta de documentos tributarios electrónicos de conformidad con la normativa legal vigente en este país.";

        $seccionSegunda = "SEGUNDA: Por su parte, $nombre_distribuidor, declara:";
        $seccionSegundaA = "a) Que su representada es una Entidad Mercantil, organizada, autorizada y reconocida de conformidad con las leyes de Guatemala, que se dedica, con capitales y personal propio a: (Objeto según Patente de Comercio o Patente de Sociedad).";
        // Sección Tercera del contrato

$seccionTercera ="


TERCERA: Obligaciones que adquiere el prestador de los servicios. Como consecuencia de este convenio CORPOSISTEMAS adquiere las siguientes obligaciones:";
$seccionTerceraA = "a) Prestar los servicios que se le requieren con recursos y personal propio;";
$seccionTerceraB = "b) El personal que utilice para la prestación de estos servicios deberá estar vinculado con CORPOSISTEMAS mediante un contrato o relación de trabajo; en consecuencia, CORPOSISTEMAS será el único responsable de cumplir con todas y cada una de las obligaciones laborales que la legislación guatemalteca le impone, tanto a la celebración del contrato, a las obligaciones que deriven durante su vigencia, como a las obligaciones que deriven por la terminación de tales contratos de trabajo.";
$seccionTerceraC = "c) Prestar los servicios de conformidad a los requerimientos, especificaciones y calidad requeridos por $nombre_distribuidor, así como cumplir con la obligación de confidencialidad respecto de la información que le sea proporcionada por $nombre_distribuidor, de conformidad con lo que para el efecto establece el presente contrato.";
$seccionTerceraD = "d) Y, en general, cumplir el cometido o fin para el que es contratado, esto es: La prestación de los servicios para el funcionamiento de la factura electrónica.";
$seccionTerceraE = "e) CORPOSISTEMAS se obliga a entregar todos los DTE a la SAT.";
$seccionTerceraF = "f) CORPOSISTEMAS reconoce que los DTE con firma electrónica de emisión válida y certificados son irrefutables para fines legales, judiciales y tributarios respecto de los datos firmados.";
$seccionTerceraG = "g) CORPOSISTEMAS y el CONTRATANTE suscriben el presente contrato del Régimen de Factura Electrónica en Línea, aceptan los requisitos y criterios de seguridad de la información establecidos por la SAT y sus futuras actualizaciones.";
$seccionTerceraH = "h) CORPOSISTEMAS mantendrá habilitada las distintas vías de comunicación para atender los casos reportados por el CONTRATANTE, en el horario de 8:00 a 12:00 y 14:00 a 18:00 de lunes a viernes y los días sábado de 8:00 a 12:00 hrs. La atención en horarios extraordinarios estará sujeta a un costo adicional al acordado en el presente contrato.";
$seccionTerceraI = "i) CORPOSISTEMAS se compromete a no divulgar a terceros no autorizados ni a utilizar para fines distintos al Régimen de Factura Electrónica en Línea la información del CONTRATANTE a la que tenga acceso por la prestación del servicio.";
$seccionTerceraJ = "j) CORPOSISTEMAS es responsable por los servicios de Factura Electrónica en Línea que presta a sus clientes y releva expresamente a la SAT de cualquier obligación que resulte del incumplimiento de los contratos suscritos con los mismos; y cualquier acción u omisión que cause perjuicio al CONTRATANTE y que pueda derivar en responsabilidad civil y penal.";

// Sección Cuarta del contrato
$seccionCuarta = "




CUARTA: De las obligaciones DEL CONTRATANTE, como solicitante de los servicios, adquiere las siguientes obligaciones:";
$seccionCuartaA ="a) Pagar, a favor de CORPOSISTEMAS, sin necesidad de cobro o requerimiento alguno, la suma de dinero que más adelante se conviene; en un plazo no mayor a quince (15) días calendarios contados desde la fecha de recepción de la factura, en concepto del servicio prestado para los Clientes de la cartera de $nombre_distribuidor.";

$seccionCuartaB ="b) Proporcionar y cumplir en lo que le corresponda con todos los lineamientos, especificaciones y autorizaciones necesarias para la prestación de los servicios; que incluye, pero no se limita a proporcionar la documentación e información que más adelante se detalla y se define como 'Información Confidencial' para los propósitos de este contrato";

$seccionCuartaC="c) Habilitarse como emisor de Documentos Tributarios Electrónicos DTE desde la Agencia Virtual de SAT.";

$seccionCuartaD ="d) En general, facilitar al prestador de los servicios el cumplimiento de las obligaciones que adquiere en este instrumento.";
$seccionCuartaE="e) La entidad contratante deberá respetar y acatar las disposiciones legales contenidas en:";
$seccionCuartaE1="a) Declaración Universal de los Derechos Humanos (1947).
b) El Pacto Internacional de los Derechos Civiles y Políticos (1966).
c) El Pacto Internacional de Derechos Económicos, Sociales y Culturales (1966).
d) La Declaración de la Organización Mundial del Trabajo a los Principios y Derechos Fundamentales en el Trabajo (1998). La entidad contratante deberá regirse por dicha normativa al respecto de las disposiciones fundamentales que establecen dichos cuerpos legales. Por lo que se entiende que respetará los ejes esénciales que hacen referencia a la discriminación, el trabajo infantil y trabajo forzoso en el desempeño de los servicios que se les proveen. En esa virtud, la entidad contratante se obliga aplicar dichas disposiciones como consecuencia de la ejecución del presente convenio y el incumplimiento de las mismas, será causa de terminación de la relación comercial que por este documento se conviene.";
$seccionCuartaF ="f) Acepta y autoriza que CORPOSISTEMAS entregue a la SAT la información de los DTE.";
$seccionCuartaG ="g) Aceptación de las disposiciones del Régimen de Factura Electrónica en Línea. El CONTRATANTE se sujeta a las condiciones de emisión de los DTE establecidas por la SAT, incluyendo los requisitos técnicos, la impresión, el almacenamiento y el uso de firmas electrónicas avanzadas, garantizando así su autenticidad, integridad, validez y no repudio.";
$seccionCuartaH ="h) Cada DTE que el CONTRATANTE emita y entregue a CORPOSISTEMAS incluirá una firma electrónica de emisión para garantizar su autenticidad, integridad, validez y aceptación.";
$seccionCuartaI ="



i) El CONTRATANTE reconoce que los DTE con firma electrónica de emisión válida y certificados son irrefutables para fines legales, judiciales y tributarios respecto de los datos firmados.";
$seccionCuartaJ ="j) El CONTRATANTE y CORPOSISTEMAS suscriben el presente contrato del Régimen de Factura Electrónica en Línea, aceptando los requisitos y criterios de seguridad de la información establecidos por la SAT y sus futuras actualizaciones.";
$seccionCuartaK ="k) CORPOSISTEMAS tendrá a disposición del CONTRATANTE formatos estándar gratuitos dentro del portal de facturación que cumplen con los requisitos legales.";
$seccionCuartaL ="l) Si el CONTRATANTE decide elaborar su propio diseño de la representación gráfica de los documentos electrónicos emitidos, será responsable de que estos cumplan con los requisitos legales. El diseño deberá ser previamente autorizado por CORPOSISTEMAS y el CONTRATANTE cubrirá cualquier costo adicional por el soporte técnico requerido para realizar dicho diseño.";
$seccionCuartaM ="m) Conservación de los DTE por el CONTRATANTE: El emisor debe conservar los archivos en formato XML de los DTE certificados mientras no haya transcurrido el plazo de prescripción establecido en el Código Tributario, según lo dispuesto en el Artículo 21 del Acuerdo de Directorio Número 13-2018.";

// Sección Quinta del contrato
$seccionQuinta = "QUINTA: De los servicios. Los servicios que se obliga ejecutar CORPOSISTEMAS, S.A. son todos aquellos relacionados con la transformación según esquema global de funcionamiento autorizado por la Superintendencia de Administración Tributaria –SAT, resguardo por el tiempo que exige la legislación tributaria vigente y consulta de documentos tributarios electrónicos.
Como complemento de lo anterior, CORPOSISTEMAS prestará los servicios específicos siguientes:";
$seccionQuinta1 = "- Servicio de consulta desde el portal web
- Envío de documentos tributarios electrónicos a través de correo electrónico, CORPOSISTEMAS no se responsabiliza por la recepción del correo electrónico del destinatario.
- Servicio opcional de resguardo de DTE (Documento Tributario Electrónico) por un periodo mayor a lo establecido en el Código Tributario. Este es un servicio excepcional que deberá ser solicitado por el contratante a CORPOSISTEMAS, por medio escrito y estará sujeto a un costo adicional.

El CONTRATANTE reconoce que CORPOSISTEMAS no cambia ni controla la información contenida en los documentos tributarios electrónicos, por lo que es el Contratante el único responsable de los datos, los cálculos en ellos contenidos y la calidad de la información que se envía a CORPOSISTEMAS.

Suspensión del servicio por incumplimiento: La falta del pago del servicio por parte DEL CONTRANTANTE durante quince (15) días calendario contados a partir de la fecha en que el pago debió realizarse dará derecho a CORPOSISTEMAS para suspender el servicio objeto de este contrato, sin necesidad de aviso previo ni declaración judicial alguna, lo que EL CONTRATANTE acepta expresamente, CORPOSISTEMAS reanudara el servicio únicamente si EL CONTRATANTE ha efectuado los pagos atrasados y los correspondientes cargos que se hubieren generado por el atraso.";



$seccionSexta = "

SEXTA: Exoneración de responsabilidad: La creación y custodia de los documentos tributarios electrónicos detallada en la cláusula anterior, no implica que CORPOSISTEMAS será responsable del cumplimiento de las obligaciones tributarias formales que le corresponden única y exclusivamente al CONTRATANTE. En virtud de lo anterior, el CONTRATANTE no podrá, ni judicial ni extrajudicialmente, exigir o reclamar a CORPOSISTEMAS, por algún incumplimiento fiscal en el que incurra EL CONTRATANTE ante la Superintendencia de Administración Tributaria (SAT). Tampoco será responsable por perdidas indirectas, daños, perjuicios o indemnizaciones.

CORPOSISTEMAS no es responsable por la entrega de los correos electrónicos a los destinatarios del CONTRATANTE y se exime de cualquier responsabilidad civil y penal que resulte del incumplimiento por la entrega de los mismos.

En ningún caso CORPOSISTEMAS será responsable por los daños o pérdidas sufridas por el Contratante como consecuencia de interrupciones en el servicio cuando sea consecuencia de caso fortuito o fuerza mayor.
";

$seccionSeptima = "
SÉPTIMA: Contraprestación. LAS PARTES convienen que, como contraprestación por los Servicios prestados, 'EL CONTRATANTE' pagará a CORPOSISTEMAS cada Documento Tributario Electrónico, el cual será utilizado por los clientes de $nombre_distribuidor, quien se identifica con (NIT: $nit), de acuerdo al rango de facturación por consumo, según la siguiente tabla:
";

$seccionSeptima2 = "
Y, que será cancelada de la siguiente forma: Dentro de los primeros quince (15) días calendario contados a partir de la recepción de la factura, esta contraprestación es variable y puede ser modificada por CORPOSISTEMAS al finalizar el periodo de este contrato, previa notificación al CONTRATANTE.

Mora: EL CONTRATANTE está enterado que en caso su estado de cuenta entre en mora, deberá pagar a CORPOSISTEMAS el 3% mensual por concepto de interés por mora.

CORPOSISTEMAS por única vez cobrará a $nombre_distribuidor, DOSCIENTOS QUETZALES (Q 200.00), dicha cantidad incluye el Impuesto al Valor Agregado, por concepto de Integración e Implementación del servicio contratado con el portal de facturación. Dicho monto será facturado por CORPOSISTEMAS a 'EL CONTRATANTE' al inicio del proceso de Integración, y será pagado por 'EL CONTRATANTE' en un solo pago.

CORPOSISTEMAS por única vez cobrará a $nombre_distribuidor, DOSCIENTOS CINCUENTA QUETZALES (Q 250.00), en dado caso requieran el uso de cualesquiera de las aplicaciones móviles con las que CORPOSISTEMAS cuenta, además de una mensualidad adicional del espacio en la nube que dicha aplicación requiere. Estos costos incluyen el Impuesto al Valor Agregado. Dicho monto será facturado por CORPOSISTEMAS a 'EL CONTRATANTE' al inicio del proceso de Integración, y será pagado por 'EL CONTRATANTE'.
";
$seccionOctava = "


OCTAVA: Confidencialidad. CORPOSISTEMAS tendrá acceso a cierta Información Confidencial (como adelante será definida) de la otra parte, por lo que ambas partes han convenido en celebrar un acuerdo de Confidencialidad, con el objeto de proteger tal Información Confidencial, de acuerdo a las estipulaciones siguientes:
a) Definición. El término 'Información Confidencial' se refiere a toda y cualquier propiedad intelectual, información del negocio, información confidencial y cualquier otra información proporcionada por '$nombre_distribuidor'. La Información Confidencial incluye, sin que esta descripción se considere limitativa, lo siguiente:";
$seccionOctava0 = "a) Definición. El término 'Información Confidencial' se refiere a toda y cualquier propiedad intelectual, información del negocio, información confidencial y cualquier otra información proporcionada por '$nombre_distribuidor'. La Información Confidencial incluye, sin que esta descripción se considere limitativa, lo siguiente:";
$seccionOctava1 = "(i) Información de mercadotecnia ('marketing') y sus métodos, incluyendo los datos de mercadotecnia, investigaciones, técnicas de ventas, y los nombres, direcciones, números de teléfono y facsímile, y las operaciones, hábitos de compra y prácticas de los clientes, clientes potenciales, distribuidores y representantes.
(ii) Información concerniente a trabajadores de 'LAS PARTES', incluyendo los términos y condiciones de empleo y resultados de evaluaciones.
(iii) Información concerniente a métodos de compra y proveedores, incluyendo los nombres y cualquier otra forma de identificación de vendedores, suministradores y proveedores, costos de materiales, y los precios en que dichos materiales, productos o servicios son o han sido obtenidos o vendidos.
(iv) Información financiera, incluyendo estados financieros interinos y auditados, planes, proyectos, reportes y cualquier otra información financiera que no deba hacerse pública.
(v) Documentación sobre procesos importantes de la entidad $nombre_distribuidor, manuales de procedimientos, políticas contables, organigrama, etc., y cualquier otra información de carácter confidencial y que así sea marcada o que sea propiedad de 'LAS PARTES', concerniente a procesos, productos o servicios.
";

$seccionOctava3 = "b) Objeto. Ambas partes convienen mutuamente en mantener toda Información Confidencial en estricta confidencialidad. La parte Receptora no debe, directa o indirectamente, usar, copiar, transferir o revelar Información Confidencial de la otra parte o de terceros, salvo que fuere expresamente autorizado por la gerencia de 'LAS PARTES'. La parte Receptora acuerda proteger la confidencialidad y tomar todas las medidas tendientes a prevenir la filtración de Información Confidencial a personas o entidades no autorizadas. En caso de que la parte Receptora llegare a tener conocimiento de cualquier revelación, filtración o uso inapropiado de Información Confidencial de parte de cualquier persona individual o jurídica, deberá hacerlo saber por escrito a 'EL CONTRATANTE' o CORPOSISTEMAS, según sea el caso.
c) Plazo. Las partes están obligadas a mantener dicha información en forma confidencial durante todo el plazo del presente contrato, y por cuatro años adicionales posteriores al vencimiento o terminación del plazo.
d) No aplicación. Las Partes acuerdan que no estará sujeta a los términos y condiciones del presente acuerdo de confidencialidad: ";

$seccionOctava4 = "(i) Toda información que estaba ya en posesión de CORPOSISTEMAS o le era conocida sin tener la obligación de darle el tratamiento de confidencial, anteriormente a recibirla.
(ii) Toda información que haya sido desarrollada de manera independiente por CORPOSISTEMAS sin infringir lo establecido en el presente acuerdo de confidencialidad.
(iii) La información que sea o se convierta en información de dominio público, siempre y cuando lo anterior no se derive de actos ilegales.
(iv) La que sea requerida por autoridad competente en ejercicio de sus funciones o por requerimiento legal.";

$seccionNovena = "NOVENA: Propiedad intelectual. EL CONTRATANTE reconoce que todos los elementos que constituyen el sistema proporcionado por CORPOSISTEMAS para la conversión a Documentos Tributarios Electrónicos no le son transferidos en propiedad. 
Quedan reservados todos los derechos de autor y propiedad intelectual de la plataforma de software, documentación y cualquier otro elemento que le proporcione CORPOSISTEMAS al CONTRATANTE para su uso, sin que este pase a ser propiedad del CONTRATANTE. 
La violación a las disposiciones de este párrafo otorga a CORPOSISTEMAS el derecho a dar por terminado el contrato y obliga al CONTRATANTE a responder por daños y perjuicios ocasionados al dueño del sistema y a CORPOSISTEMAS.
";
$dia_actual = date('D');
$mes_actual = date('F');
$año_actual = date('Y');
$año_siguiente = $año_actual + 1;

$seccionDecima = "DÉCIMA: VIGENCIA. El presente contrato se suscribe por un plazo de un año, contado a partir del 01 de $mes_actual del $año_actual al 01 de $mes_actual del $año_siguiente. 
En caso de no existir notificación alguna por parte del CONTRATANTE, el contrato se renovará de forma automática una vez finalizada la vigencia del mismo y por periodos anuales.
";
// Décima Primera: Terminación
$seccionDecimaPrimera = "DÉCIMA PRIMERA: Terminación. La terminación del presente contrato podrá ocurrir en cualquier momento y antes de la finalización del plazo fijado, por voluntad de cualquiera de LAS PARTES, cumpliendo con las disposiciones siguientes:";

$seccionDecimaPrimera1 = "- Dar aviso de prescindir el servicio con anticipación de treinta (30) días calendario.
- EL CONTRATANTE debe realizar el pago de los meses que se encuentren pendientes para la finalización del plazo fijado (un año) del presente contrato y deberá estar al día de cualquier pago pendiente.
- EL CONTRATANTE deberá pagar por almacenamiento obligatorio de 48 meses, conforme a la normativa de la Superintendencia de Administración Tributaria (SAT), a razón de Q.0.0020 por documento mensual. Si el plazo de resguardo se amplía por requerimiento de la SAT, este monto se aplicará hasta el fin del nuevo plazo. Si no se realiza el pago mensual correspondiente, CORPOSISTEMAS podrá dar por terminado el contrato sin necesidad de declaración judicial o responsabilidad alguna.
";


// Décima Segunda: Naturaleza de la relación y resolución de controversias
$seccionDecimaSegunda = "DÉCIMA SEGUNDA: Naturaleza de la relación y resolución de controversias. La relación entre las partes es de carácter mercantil. Cualquier reclamación que surja entre LAS PARTES, relacionada con las obligaciones aquí contraídas, deberá ser resuelta de forma directa y amistosa. Si, tras treinta (30) días, no se alcanza un acuerdo, ambas partes renuncian al fuero de su domicilio y se someten expresamente a los tribunales del departamento de Alta Verapaz, Guatemala.";


// Décima Tercera: Disposiciones finales
$seccionDecimaTercera = "DÉCIMA TERCERA: Disposiciones finales.";
$seccionDecimaTercera1 = "(i) Ley Aplicable. Para la ejecución e interpretación de este contrato aplicarán las leyes de la República de Guatemala.
(ii) Acuerdo Completo. Este contrato constituye y expresa el único acuerdo entre LAS PARTES. Cualesquiera discusiones, promesas o entendimientos previos han sido sustituidos por este acuerdo y no son aplicables.
(iii) Modificaciones. Cualquier modificación, cambio, prórroga o terminación de este contrato será válida únicamente si se documenta por escrito y es suscrita por CORPOSISTEMAS y EL CONTRATANTE.
(iv) Divisibilidad. Si alguna disposición del contrato es inválida o ilegal, se tendrá por no puesta, pero la validez del resto del contrato no se verá afectada.
(v) Notificaciones. Toda comunicación deberá ser por escrito, enviada por medios electrónicos o entregada personalmente:
                -CORPOSISTEMAS, S.A.:2ª. Calle 7-57, Zona 4, Cobán, Alta Verapaz.
                -$nombre_distribuidor: $domicilio_distribuidor, $municipio, $departamento.
(vi) Renuncia. Ningún incumplimiento podrá ser desestimado sin el consentimiento por escrito de la parte afectada. La renuncia a un incumplimiento no implica renuncia a futuros incumplimientos.";
$seccionDecimaTercera2 = "Leído lo anterior, las partes ratifican y firman en la Ciudad de Cobán, Alta Verapaz, $dia_actual día  de $mes_actual del $año_actual.
";

$firma = "
F:________________________________          F:________________________________
";

$doyfe = "En la Ciudad de Cobán, Alta Verapaz, el día 00 de (mes) del año dos mil veintidós, como Notario, DOY FE: que las firmas que anteceden son AUTENTICAS, por haber sido consignadas en mi presencia el día de hoy por los Señores: a) ERIK LEONEL PAZ CHÉN, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación número  (CUI) un mil seiscientos treinta y seis, ochenta y ocho mil seiscientos noventa y nueve, un mil un mil seiscientos ocho (1636 88699 1608) extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de Cobán, del departamento de Alta Verapaz, b) (NOMBRE DEL DISTRIBUIDOR), quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) _________________________________________ (0000 00000 0000) extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de _________________s, del departamento de _______________. Las cuales calzan CONTRATO Y ACUERDO DE CONFIDENCIALIDAD DE PRESTACION DE SERVICIOS DE FACTURACIÓN ELECTRÓNICA EN LINEA. Los signatarios firman nuevamente con el infrascrito notario. Que de todo lo relacionado anteriormente.
DOY FE.
"; 

$firma2 = "
F:________________________________          F:________________________________
";

$pdf->SetLeftMargin(45); 
$pdf->SetRightMargin(20); 
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(0, 6, utf8_decode($entreNosotros), 0, 'J'); 
$pdf->Ln(2); 

$pdf->SetLeftMargin(35);
$pdf->SetX(35);

// Definir el texto
$entreNosotros2 = "Hemos convenido celebrar un ";
$textoNegrita = "CONTRATO DE PRESTACIÓN DE SERVICIOS DE EMISIÓN, TRANSMISIÓN, CERTIFICACIÓN Y CONSERVACIÓN DE DOCUMENTOS TRIBUTARIOS ELECTRÓNICOS.";
$restoTexto = " Con base en las siguientes cláusulas:";

// Escribir texto normal antes de la negrita (sin saltos de línea)
$pdf->SetFont('Times', '', 10);
$pdf->Write(6, utf8_decode($entreNosotros2));

// Escribir el texto en negrita (sin saltos de línea)
$pdf->SetFont('Times', 'B', 10);
$pdf->Write(6, utf8_decode($textoNegrita));

// Volver a texto normal
$pdf->SetFont('Times', '', 10);
$pdf->Write(6, utf8_decode($restoTexto));

// Salto de línea para el siguiente contenido
$pdf->Ln(5);


$pdf->Ln(2); 

$pdf->SetLeftMargin(30);
$pdf->SetX(30);
$pdf->SetFont('Times', 'B', 10);
$pdf->Write(6, utf8_decode("PRIMERA:"));
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(0, 6, utf8_decode($seccionPrimera), 0, 'J'); 
$pdf->Ln(2); 
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionPrimeraA), 0, 'J'); 
$pdf->Ln(2); 

$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionSegunda), 0, 'J'); 
$pdf->Ln(2); 
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionSegundaA), 0, 'J'); 
$pdf->Ln(2);

$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionTercera), 0, 'J'); 
$pdf->Ln(2); 
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraA), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraB), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraC), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraD), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraE), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraF), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraG), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraH), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraI), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionTerceraJ), 0, 'J'); 
$pdf->Ln(5);


$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionCuarta), 0, 'J'); 
$pdf->Ln(2); 
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaA), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaB), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaC), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaD), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaE), 0, 'J'); 
$pdf->Ln(1);
$pdf->SetLeftMargin(48);
$pdf->SetX(48); 
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaE1), 0, 'J'); 
$pdf->Ln(1);
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaF), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaG), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaH), 0, 'J'); 
$pdf->Ln(5);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaI), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaJ), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaK), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaL), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionCuartaM), 0, 'J'); 
$pdf->Ln(1);




$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionQuinta), 0, 'J'); 
$pdf->Ln(0.5); 
$pdf->SetLeftMargin(35);
$pdf->SetX(35); 
$pdf->MultiCell(0, 6, utf8_decode($seccionQuinta1), 0, 'J'); 
$pdf->Ln(1);


$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionSexta), 0, 'J'); 
$pdf->Ln(1);
$pdf->MultiCell(0, 6, utf8_decode($seccionSeptima), 0, 'J'); 
$pdf->Ln(1);

$pdf->SetMargins(15, 10, 15);
$pdf->SetX(55);
$pdf->SetFont('Times', '', 8);

// Encabezado de la tabla
$pdf->SetFillColor(169, 169, 169); // Gris
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(120, 7, 'TABLA DE PRECIOS', 1, 1, 'C', true);
$pdf->SetX(55);

// Títulos de columnas
$pdf->SetFillColor(200, 0, 0); // Rojo
$pdf->Cell(40, 7, 'RANGO', 1, 0, 'C', true);
$pdf->Cell(40, 7, 'PRECIO UNITARIO', 1, 0, 'C', true);
$pdf->Cell(40, 7, 'PRECIO MENSUAL', 1, 1, 'C', true);
$pdf->SetX(55);

// Contenido de la tabla
$pdf->SetFont('Times', '', 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(40, 7, 'POR CONSUMO', 1, 0, 'C');
$pdf->Cell(40, 7, 'Q. 0.20', 1, 0, 'C');
$pdf->Cell(40, 7, 'SEGUN CONSUMO', 1, 1, 'C');


$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(0, 6, utf8_decode($seccionSeptima2), 0, 'J'); 
$pdf->Ln(1);


$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionOctava), 0, 'J'); 
$pdf->Ln(1); 
$pdf->SetLeftMargin(40);
$pdf->SetX(40); 
$pdf->MultiCell(0, 6, utf8_decode($seccionOctava0), 0, 'J'); 
$pdf->Ln(1);
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionOctava1), 0, 'J'); 
$pdf->Ln(1);

$pdf->SetLeftMargin(40);
$pdf->SetX(40); 
$pdf->MultiCell(0, 6, utf8_decode($seccionOctava3), 0, 'J'); 
$pdf->Ln(2); 
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionOctava4), 0, 'J'); 
$pdf->Ln(1);


$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionNovena), 0, 'J'); 
$pdf->Ln(2); 
$pdf->MultiCell(0, 6, utf8_decode($seccionDecima), 0, 'J'); 
$pdf->Ln(2); 
$pdf->MultiCell(0, 6, utf8_decode($seccionDecimaPrimera), 0, 'J'); 
$pdf->Ln(1);
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionDecimaPrimera1), 0, 'J'); 
$pdf->Ln(1);

$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionDecimaSegunda), 0, 'J'); 
$pdf->Ln(2); 
$pdf->MultiCell(0, 6, utf8_decode($seccionDecimaTercera), 0, 'J'); 
$pdf->Ln(1); 
$pdf->SetLeftMargin(45);
$pdf->SetX(45); 
$pdf->MultiCell(0, 6, utf8_decode($seccionDecimaTercera1), 0, 'J'); 
$pdf->Ln(1);

$pdf->SetLeftMargin(30);
$pdf->SetX(30); 
$pdf->MultiCell(0, 6, utf8_decode($seccionDecimaTercera2), 0, 'J'); 
$pdf->Ln(2); 
$pdf->MultiCell(0, 6, utf8_decode($firma), 0, 'C'); 
$pdf->Ln(2); 

        ob_end_clean(); // Limpiar cualquier salida previa
        $pdf->Output('I', 'Contrato_B.pdf');
    } else {
        echo "Contrato no encontrado.";
    }
} else {
    echo "ID del contrato no proporcionado o no válido.";
}

// Funciones auxiliares
function num2letras($num)
{
    $unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    $decenas = ['', 'diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];

    if ($num < 10) return $unidades[$num];
    if ($num < 100) {
        $unidad = $num % 10;
        $decena = intdiv($num, 10);
        return $unidad ? $decenas[$decena] . ' y ' . $unidades[$unidad] : $decenas[$decena];
    }
    return (string)$num;
}

function num2letrasDPI($dpi)
{
    $partes = str_split($dpi, 4);
    return implode(' ', array_map('num2letras', $partes));
}

function fechaALetras($fecha)
{
    setlocale(LC_TIME, 'es_ES.UTF-8');
    return strftime('%d de %B de %Y', strtotime($fecha));
}