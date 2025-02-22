<?php
require('../fpdf186/fpdf.php');
require('conexion_bd.php'); // Conexión a la base de datos

class PDF extends FPDF
{
    function Header()
    {
        $path = realpath(__DIR__ . '/ContratoA.jpeg');
        if (!$path) {
            die('Error: Imagen de fondo no encontrada.');
        }
        $this->Image($path, 0, 0, $this->GetPageWidth(), $this->GetPageHeight());
        $this->SetY(10);
        $this->SetFont('Times', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'CONTRATO DE PRESTACION DE SERVICIOS -FEL-', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    function AddSection($title, $content)
    {
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 10, utf8_decode($title), 0, 1);
        $this->SetFont('Arial', '', 8);
        $this->MultiCell(0, 10, utf8_decode($content));
        $this->Ln(5);
    }
}

if (isset($_GET['id_contrato']) && is_numeric($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];

    $sql = "SELECT * FROM contratos_a WHERE id_contrato = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id_contrato]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $pdf = new PDF();
        $pdf->AddPage();

        // Variables dinámicas asignadas correctamente
        $nombre_emisor = $data['nombre_emisor'];
        $edad_emisor = ucfirst(num2letras($data['edad_emisor']));
        $dpi_emisor = $data['dpi_emisor'];
        $nombre_receptor = $data['nombre_receptor'];
        $edad_receptor = ucfirst(num2letras($data['edad_receptor']));
        $dpi_receptor = $data['dpi_receptor'];
        $departamento_emision = $data['departamento_emision'];
        $municipio_emision = $data['municipio_emision'];
        $nombre_contratante = $data['nombre_contratante'];
        $fecha_patente = fechaALetras($data['fecha_patente']);
        $numero_inscripcion = num2letras($data['numero_inscripcion']);
        $folio_registro = num2letras($data['folio_registro']);
        $libro_registro = $data['libro_registro'];
        $actividad_economica = $data['actividad_economica'];
        $nit = $data['nit'];
        $tarifa_mensual = num2letras($data['tarifa_mensual']);
        $rango_documentos = $data['rango_documentos']; // Asignar rango_documentos correctamente
        $cobro_unico = num2letras($data['cobro_unico']);
        $fecha_validez = fechaALetras($data['fecha_validez']);
        $direccion_contratante = $data['direccion_contratante'];
        $fecha_creacion = fechaALetras($data['fecha_creacion']);
        
        $intro = "
                                Entre nosotros:
                                    a) $nombre_emisor, de " . ucfirst(num2letras($edad_emisor)) . " años, casado, empresario, guatemalteco, de este domicilio, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) " .
            num2letrasCui($data['dpi_emisor']) . " (" . chunk_split($data['dpi_emisor'], 4, ' ') . "), extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de Cobán, 
                        del departamento de Alta Verapaz, quien comparece en su calidad de ADMINISTRADOR ÚNICO Y REPRESENTANTE LEGAL de la entidad 
                        CORPOSISTEMAS, SOCIEDAD ANÓNIMA, en lo sucesivo CORPOSISTEMAS, calidad que acredita con el Acta Notarial de su nombramiento autorizada en esta ciudad el día " . fechaALetras('2023-07-17') . " por el Notario MANUEL ANTONIO LÓPEZ OLIVA, 
                        el cual se encuentra debidamente inscrito en el Registro Mercantil General de la República bajo el número de Registro " . ucfirst(num2letras(706124)) . " (706124), folio " . ucfirst(num2letras(215)) . " (215) del Libro " .
                                ucfirst(num2letras(819)) . " (819) de Auxiliares de Comercio.
                        b) $nombre_receptor, de " . ucfirst(num2letras($edad_receptor)) . " años, de este domicilio, quien se identifica con Documento Personal de Identificación (DPI) con Código Único de Identificación (CUI) " .
                                num2letrasCui($data['dpi_receptor']) . " (" . chunk_split($data['dpi_receptor'], 4, ' ') . "), extendido por el Registro Nacional de las Personas de la República de Guatemala, en el municipio de $municipio_emision, 
                        del departamento de $departamento_emision, quien comparece en su calidad de PROPIETARIO de la entidad '$nombre_contratante', en adelante denominada como 'EL CONTRATANTE'. 
                        Esta calidad la acredita con la patente de comercio autorizada en esta ciudad el día " . fechaALetras($data['fecha_patente']) . ", la cual se encuentra inscrita en el Registro Mercantil General de la 
                        República bajo el número de Registro " . ucfirst(num2letras($data['numero_inscripcion'])) . " (" . $data['numero_inscripcion'] . "), folio " . ucfirst(num2letras($data['folio_registro'])) .
                                " (" . $data['folio_registro'] . ") del Libro " . ucfirst(num2letras($data['libro_registro'])) . " (" . $data['libro_registro'] . ") de Empresas Mercantiles.
                        En conjunto y para los efectos de este contrato conocidos ambos como “LAS PARTES”.

Hemos convenido celebrar un CONTRATO DE PRESTACIÓN DE SERVICIOS DE EMISIÓN, TRANSMISIÓN, CERTIFICACIÓN Y CONSERVACIÓN DE DOCUMENTOS TRIBUTARIOS ELECTRÓNICOS. Con base en las siguientes cláusulas:

";

        $clausula_primera = "
PRIMERA: El representante legal de la entidad CORPOSISTEMAS, SOCIEDAD ANÓNIMA, declara:

a) Que su representada es una entidad mercantil organizada, autorizada y reconocida de conformidad con las leyes de la República de Guatemala, cuya actividad, entre otras, consiste en la prestación de servicios de transformación, firmado electrónico, resguardo y consulta de documentos tributarios electrónicos, de conformidad con la normativa legal vigente en este país.
";

        $clausula_segunda = "
SEGUNDA: Por su parte, $nombre_contratante declara:

a) Que su representada es una entidad mercantil, organizada, autorizada y reconocida de conformidad con las leyes de Guatemala, que se dedica, con capitales y personal propio, a: $actividad_economica.
";
        $clausula_tercera = "
TERCERA: Obligaciones que adquiere el prestador de los servicios. Como consecuencia de este convenio, “CORPOSISTEMAS” adquiere las siguientes obligaciones:

a) Prestar los servicios que se le requieren “con recursos” y “personal propio”.

b) El personal que utilice para la prestación de estos servicios deberá estar vinculado con “CORPOSISTEMAS” mediante un contrato o relación de trabajo; en consecuencia, CORPOSISTEMAS será el único responsable de cumplir con todas y cada una de las obligaciones laborales que la legislación guatemalteca le impone, tanto a la celebración del contrato, a las obligaciones que deriven durante su vigencia, como a las obligaciones que surjan por la terminación de tales contratos de trabajo.

c) Prestar los servicios de conformidad con los requerimientos, especificaciones y calidad requeridos por $nombre_contratante, así como cumplir con la obligación de confidencialidad respecto de la información que le sea proporcionada por $nombre_contratante, de acuerdo con lo establecido en este contrato.

d) Y, en general, cumplir el cometido o fin para el que es contratado, es decir, la prestación de los servicios para el funcionamiento de la factura electrónica.

e) CORPOSISTEMAS se obliga a entregar todos los DTE a la SAT.

f) CORPOSISTEMAS reconoce que los DTE con firma electrónica de emisión válida y certificados son irrefutables para fines legales, judiciales y tributarios respecto de los datos firmados.

g) CORPOSISTEMAS y el EMISOR suscriben el presente contrato del Régimen de Factura Electrónica en Línea y aceptan los requisitos y criterios de seguridad de la información establecidos por la SAT y sus futuras actualizaciones.

h) CORPOSISTEMAS mantendrá habilitadas las distintas vías de comunicación para atender los casos reportados por el EMISOR, en el horario de 8:00 a 12:00 y de 14:00 a 18:00 de lunes a viernes, y los días sábado de 8:00 a 12:00 hrs. La atención en horarios extraordinarios estará sujeta a un costo adicional al acordado en el presente contrato.

i) CORPOSISTEMAS se compromete a no divulgar a terceros no autorizados ni a utilizar para fines distintos al Régimen de Factura Electrónica en Línea la información del EMISOR a la que tenga acceso por la prestación del servicio.

j) CORPOSISTEMAS es responsable por los servicios de Factura Electrónica en Línea que presta a sus clientes y releva expresamente a la SAT de cualquier obligación que resulte del incumplimiento de los contratos suscritos con los mismos. Asimismo, cualquier acción u omisión que cause perjuicio al EMISOR podrá derivar en responsabilidad civil y penal.
";
        $clausula_cuarta = "
CUARTA: De las obligaciones DEL CONTRATANTE, como solicitante de los servicios, adquiere las siguientes obligaciones:
a) Pagar, a favor de CORPOSISTEMAS, sin necesidad de cobro o requerimiento alguno, la suma de dinero que más adelante se conviene, en un plazo no mayor a quince (15) días 
calendarios contados desde la fecha de recepción de la factura, en concepto del servicio prestado.
b) Proporcionar y cumplir en lo que le corresponda con todos los lineamientos, especificaciones y autorizaciones necesarias para la prestación de los servicios; lo que incluye, pero no se limita, a proporcionar la documentación e información que más adelante se detalla y se define como “Información Confidencial” para los propósitos de este contrato.
c) Habilitarse como emisor de Documentos Tributarios Electrónicos (DTE) desde la Agencia Virtual de SAT.
d) En general, facilitar al prestador de los servicios el cumplimiento de las obligaciones que adquiere en este instrumento.
e) La entidad contratante deberá respetar y acatar las disposiciones legales contenidas en:
  1. Declaración Universal de los Derechos Humanos (1947).
  2. El Pacto Internacional de los Derechos Civiles y Políticos (1966).
  3. El Pacto Internacional de Derechos Económicos, Sociales y Culturales (1966).
  4. La Declaración de la Organización Mundial del Trabajo a los Principios y Derechos Fundamentales en el Trabajo (1998).
La entidad contratante deberá regirse por dicha normativa al respecto de las disposiciones fundamentales que establecen dichos cuerpos legales, comprometiéndose a respetar los principios esenciales relacionados con la discriminación, el trabajo infantil y el trabajo forzoso en el desempeño de los servicios prestados. El incumplimiento de estas disposiciones será motivo de terminación inmediata de la relación comercial establecida en este contrato.
f) Aceptar y autorizar que CORPOSISTEMAS entregue a la SAT la información de los DTE.
g) Aceptación de las disposiciones del Régimen de Factura Electrónica en Línea: El EMISOR se compromete a cumplir las condiciones de emisión de los DTE establecidas por la SAT, lo que incluye requisitos técnicos, impresión, almacenamiento y el uso de firmas electrónicas avanzadas como método de identificación del EMISOR y CERTIFICADOR, garantizando así su autenticidad, integridad, validez y no repudio de los DTE.
h) Cada DTE que el EMISOR emita y entregue a CORPOSISTEMAS incluirá una firma electrónica válida, a efecto de garantizar su autenticidad, integridad, validez y aceptación por parte del EMISOR.
i) El EMISOR reconoce que los DTE con firma electrónica de emisión válida y certificados son irrefutables para fines legales, judiciales y tributarios respecto de los datos firmados.
j) El EMISOR y CORPOSISTEMAS suscriben este contrato bajo las condiciones del Régimen de Factura Electrónica en Línea y aceptan los requisitos y criterios de seguridad de la información establecidos por la SAT, incluyendo cualquier futura actualización.
k) CORPOSISTEMAS pondrá a disposición del EMISOR formatos estándar gratuitos dentro del portal de facturación que cumplan con los requisitos legales.
l) Si el EMISOR decide elaborar su propio diseño de la representación gráfica de los documentos electrónicos, será responsable de garantizar que cumpla con los requisitos legales, previa autorización de CORPOSISTEMAS. Además, asumirá los costos asociados a la creación de dicho diseño.
m) El EMISOR deberá conservar los archivos en formato XML de los DTE certificados durante el plazo de prescripción establecido por el Código Tributario, según lo establece el Artículo 21 del Acuerdo de Directorio Número 13-2018.
";

        $clausula_quinta = "
QUINTA: De los servicios.
Los servicios que se obliga ejecutar CORPOSISTEMAS, S.A. son todos aquellos relacionados con la transformación según esquema global de funcionamiento autorizado por la Superintendencia de Administración Tributaria –SAT–, el resguardo por el tiempo que exige la legislación tributaria vigente y la consulta de documentos tributarios electrónicos.
Como complemento de lo anterior, CORPOSISTEMAS prestará los siguientes servicios específicos:
• Servicio de consulta desde el portal web.
• Envío de documentos tributarios electrónicos a través de correo electrónico. CORPOSISTEMAS no se responsabiliza por la recepción del correo electrónico por parte del destinatario.
• Servicio opcional de resguardo de DTE (Documento Tributario Electrónico) por un período mayor al establecido en el Código Tributario. Este servicio deberá ser solicitado expresamente por el contratante mediante solicitud escrita y estará sujeto a un costo adicional.
El Contratante reconoce que CORPOSISTEMAS no cambia ni controla la información contenida en los documentos tributarios electrónicos, por lo que es el Contratante el único responsable de los datos, cálculos y la calidad de la información enviada a CORPOSISTEMAS.
Suspensión del servicio por incumplimiento:
La falta de pago del servicio por parte del CONTRATANTE durante treinta (30) días calendario contados a partir de la fecha en que el pago debió realizarse dará derecho a CORPOSISTEMAS para suspender el servicio objeto de este contrato, sin necesidad de aviso previo ni declaración judicial alguna, lo que el CONTRATANTE acepta expresamente. CORPOSISTEMAS reanudará el servicio únicamente si el CONTRATANTE ha efectuado los pagos atrasados y los cargos adicionales generados por el atraso.
";
        $clausula_sexta = "
SEXTA: Exoneración de responsabilidad.

La creación y custodia de los documentos tributarios electrónicos detallada en la cláusula anterior no implica que CORPOSISTEMAS será responsable del cumplimiento de las obligaciones tributarias formales que le corresponden única y exclusivamente al CONTRATANTE. En virtud de lo anterior, el CONTRATANTE no podrá, ni judicial ni extrajudicialmente, exigir o reclamar a CORPOSISTEMAS por algún incumplimiento fiscal en el que incurra ante la Superintendencia de Administración Tributaria (SAT). Tampoco será responsable por pérdidas indirectas, daños, perjuicios o indemnizaciones.

Asimismo, CORPOSISTEMAS no se hace responsable de la entrega efectiva de los correos electrónicos a los destinatarios del EMISOR y se exime de cualquier responsabilidad civil y penal que resulte del incumplimiento de dicha entrega.

En ningún caso CORPOSISTEMAS será responsable por los daños o pérdidas sufridas por el CONTRATANTE como consecuencia de interrupciones en el servicio, siempre que estas se deban a caso fortuito o fuerza mayor.
";

        $total_anual = $rango_documentos * 12;

        $clausula_septima = "
SÉPTIMA: Contraprestación.
LAS PARTES convienen que, como contraprestación por los servicios prestados, “EL CONTRATANTE” pagará a CORPOSISTEMAS cada Documento Tributario Electrónico utilizado por $nombre_contratante, quien se identifica con NIT: $nit.
Por la prestación de los servicios contratados, el EMISOR deberá pagar una tarifa mensual al CERTIFICADOR, lo que le dará derecho a la emisión, administración, reportes y almacenamiento de cada documento pagado. Esta tarifa mensual asciende a la cantidad de " . ucfirst(num2letras($tarifa_mensual)) . " EXACTOS (Q.$tarifa_mensual), por un rango mensual de $rango_documentos documentos, lo equivalente a " . ucfirst(num2letras($total_anual)) . " ($total_anual) Documentos Tributarios Electrónicos al año, los cuales son acumulables únicamente dentro del año calendario.
Cualquier Documento Tributario Electrónico adicional a la cantidad antes indicada, emitido en un año calendario, tendrá un costo equivalente al valor unitario acordado por cada Documento Tributario Electrónico adicional, incluyendo el Impuesto al Valor Agregado (IVA). Los precios indicados se aplicarán por cada registro electrónico emitido en el sistema del CERTIFICADOR después de la fecha de entrada en operación del sistema. Si el gobierno decretare un cambio en el Impuesto al Valor Agregado (IVA) y/o decrete algún nuevo impuesto que afecte directamente la facturación del servicio, la tarifa establecida se verá modificada en la misma proporción.
El pago será realizado de la siguiente forma: dentro de los primeros quince (15) días calendario contados a partir de la recepción de la factura. Esta contraprestación es variable y puede ser modificada por CORPOSISTEMAS al finalizar el período de este contrato, previa notificación al CONTRATANTE.
**Mora:** EL CLIENTE reconoce que, en caso de mora, deberá pagar a CORPOSISTEMAS un interés del 3% mensual sobre el monto adeudado.
CORPOSISTEMAS, por única vez, cobrará a $nombre_contratante la suma de " . ucfirst(num2letras($cobro_unico)) . " (Q.$cobro_unico), cantidad que incluye el Impuesto al Valor Agregado, por concepto de Integración e Implementación del servicio contratado. Este monto será facturado al inicio del proceso de integración y deberá ser pagado por “EL CONTRATANTE” en un solo pago.
";
        $clausula_octava = "
OCTAVA: Confidencialidad.
CORPOSISTEMAS tendrá acceso a cierta Información Confidencial (como adelante será definida) de la otra parte, por lo que ambas partes han convenido en celebrar un acuerdo de Confidencialidad, con el objeto de proteger tal Información Confidencial, de acuerdo a las estipulaciones siguientes:
**a) Definición:**  
El término 'Información Confidencial' se refiere a toda y cualquier propiedad intelectual, información del negocio, información confidencial y cualquier otra información proporcionada por '$nombre_contratante'. La Información Confidencial incluye, sin que esta descripción se considere limitativa, lo siguiente:  
(i) Información de mercadotecnia ('marketing') y sus métodos, incluyendo los datos de mercadotecnia, investigaciones, técnicas de ventas, y los nombres, direcciones, números de teléfono y facsímile, y las operaciones, hábitos de compra y prácticas de los clientes, clientes potenciales, distribuidores y representantes.  
(ii) Información concerniente a trabajadores de 'LAS PARTES', incluyendo los términos y condiciones de empleo y resultados de evaluaciones.  
(iii) Información concerniente a métodos de compra y proveedores, incluyendo los nombres y cualquier otra forma de identificación de vendedores, suministradores y proveedores, costos de materiales, y los precios en que dichos materiales, productos o servicios son o han sido obtenidos o vendidos.  
(iv) Información financiera, incluyendo estados financieros interinos y auditados, planes, proyectos, reportes y cualquier otra información financiera que no deba hacerse pública.  
(v) Documentación sobre procesos importantes de la entidad '$nombre_contratante', manuales de procedimientos, políticas contables, organigrama, etc., y cualquier otra información de carácter confidencial que así sea marcada o que sea propiedad de 'LAS PARTES', concerniente a procesos, productos o servicios.

**b) Objeto:**  
Ambas partes convienen mutuamente en mantener toda Información Confidencial en estricta confidencialidad. La parte Receptora no debe, directa o indirectamente, usar, copiar, transferir o revelar Información Confidencial de la otra parte o de terceros, a menos que fuere expresamente autorizado por la gerencia de 'LAS PARTES'. La parte Receptora acuerda proteger la confidencialidad, y tomar todas las medidas tendientes a prevenir la filtración de Información Confidencial a personas o entidades no autorizadas. En caso de que la parte Receptora llegare a tener conocimiento de cualquier revelación, filtración o uso inapropiado de Información Confidencial de parte de cualquier persona individual o jurídica, deberá notificarlo por escrito a '$nombre_contratante' o CORPOSISTEMAS, según sea el caso.

**c) Plazo:**  
Las partes están obligadas a mantener dicha información en forma confidencial durante todo el plazo del presente contrato y por cuatro años adicionales posteriores al vencimiento o terminación del plazo.

**d) No aplicación:**  
Las Partes acuerdan que no estará sujeta a los términos y condiciones del presente acuerdo de confidencialidad:  
(i) Toda información que estaba ya en posesión de CORPOSISTEMAS o le era conocida sin tener la obligación de darle tratamiento confidencial, anteriormente a recibirla.  
(ii) Toda información que haya sido desarrollada de manera independiente por CORPOSISTEMAS sin infringir lo establecido en el presente acuerdo de confidencialidad.  
(iii) La información que sea o se convierta en información de dominio público, siempre y cuando lo anterior no se derive de actos ilegales.  
(iv) La que sea requerida por autoridad competente en ejercicio de sus funciones o por requerimiento legal.
";
        $clausula_novena = "
NOVENA: Propiedad intelectual.

EL CONTRATANTE reconoce que todos los elementos que constituyen el sistema proporcionado por CORPOSISTEMAS para la conversión a Documentos Tributarios Electrónicos no le son transferidos en propiedad. Quedan reservados todos los derechos de autor y propiedad intelectual de la plataforma de software, documentación y cualquier otro elemento que CORPOSISTEMAS proporcione al CONTRATANTE para su uso. Estos elementos no constituyen propiedad del CONTRATANTE. La violación de las disposiciones de este párrafo otorga a CORPOSISTEMAS el derecho a dar por terminado el contrato, y obliga al CONTRATANTE a responder por los daños y perjuicios ocasionados al dueño del sistema y a CORPOSISTEMAS.
";
        // Calcular la fecha de un año después de la fecha de validez
        $fecha_validez_obj = DateTime::createFromFormat('Y-m-d', $data['fecha_validez']);
        $fecha_fin_obj = $fecha_validez_obj->modify('+1 year');

        // Convertir las fechas a letras
        $fecha_validez_letras = fechaALetras($data['fecha_validez']);
        $fecha_fin_letras = fechaALetras($fecha_fin_obj->format('Y-m-d'));

        $clausula_decima = "
DÉCIMA: Vigencia.

El presente contrato se suscribe por un plazo de un año, contado a partir del **$fecha_validez_letras** al **$fecha_fin_letras**. En caso de no existir notificación alguna por parte del CONTRATANTE, el contrato se renovará de forma automática una vez finalizada la vigencia del mismo y por periodos anuales.
";
        $clausula_decima_primera = "
DÉCIMA PRIMERA: Terminación.

La terminación del presente contrato podrá ocurrir en cualquier momento y antes de la finalización del plazo fijado, por voluntad de cualquiera de LAS PARTES, cumpliendo con las siguientes disposiciones:

• Dar aviso de prescindir del servicio con anticipación de treinta (30) días calendario.

• EL CONTRATANTE deberá realizar el pago de los meses que se encuentren pendientes para completar el plazo fijado de un año del presente contrato y estar al día con cualquier pago pendiente.

• Además, EL CONTRATANTE deberá pagar por almacenamiento de los Documentos Tributarios Electrónicos (DTE) por un periodo obligatorio de 48 meses, conforme lo establece la Superintendencia de Administración Tributaria (SAT), a un costo de Q.0.0020 por documento mensual. Este periodo de resguardo comenzará desde la fecha de emisión del documento. Si por requerimiento de la SAT el plazo de resguardo se extendiera, el costo se trasladará hasta la finalización del nuevo plazo.

• En caso de que EL CONTRATANTE no cumpla con el pago mensual correspondiente, CORPOSISTEMAS podrá dar por terminado el contrato sin necesidad de declaración judicial ni responsabilidad alguna.
";
        $clausula_decima_segunda = "
DÉCIMA SEGUNDA: Naturaleza de la relación y resolución de controversias.

La relación que se establece entre las partes es de carácter mercantil. Cualquier reclamación que surja entre LAS PARTES, basada únicamente en las obligaciones asumidas en el presente contrato, deberá resolverse de forma directa y amistosa. 

Si después de treinta (30) días CORPOSISTEMAS y EL CONTRATANTE no logran resolver la controversia, ambas partes renuncian expresamente al fuero de su domicilio y acuerdan someterse a la jurisdicción de los tribunales del departamento de Alta Verapaz, Guatemala.
";
$clausula_decima_tercera = "
DÉCIMA TERCERA: Disposiciones Finales.

(i) **Ley Aplicable:** Para la ejecución e interpretación de este Contrato, aplicarán las leyes de la República de Guatemala.

(ii) **Acuerdo Completo:** Las PARTES reconocen mutuamente que este Contrato constituye y expresa el único acuerdo entre ellas en relación a los asuntos aquí referidos. Cualesquiera discusiones, promesas, representaciones y entendimientos previos han sido sustituidos en su totalidad por el presente acuerdo y, por lo tanto, son inaplicables.

(iii) **Modificaciones:** Cualquier acuerdo de modificación, cambio, prórroga o terminación que acuerden las PARTES al presente Contrato, sea total o parcial, será válido en tanto el mismo sea documentado por escrito y suscrito por CORPOSISTEMAS y por EL CONTRATANTE.

(iv) **Divisibilidad:** Si alguna disposición de este Contrato resultare inválida o ilegal, se tendrá por no puesta, pero la legalidad y validez del resto del Contrato no se verá afectada o limitada por dicha omisión.

(v) **Notificaciones:** Toda notificación y cualesquiera otras comunicaciones que puedan o deban realizarse de conformidad con este Contrato deberán hacerse por escrito, enviadas por medios electrónicos o entregadas personalmente y se tendrán por entregadas en el momento en que las mismas sean recibidas, salvo disposición en contrario:

    • **CORPOSISTEMAS, S.A.:** 2ª. Calle 7-57, Zona 4, Cobán, Alta Verapaz.
    • **$nombre_contratante:** $direccion_contratante.

(vi) **Renuncia:** Ningún incumplimiento de este Contrato podrá ser desestimado de no ser por escrito por la Parte que pueda desestimarlo. La desestimación y renuncia de cualquiera de las PARTES, o el hecho de no reclamar el incumplimiento de cualquier cláusula de este Contrato, no será entendido como la renuncia a cualquier reclamo por incumplimiento subsiguiente.

Leído lo anterior estamos conformes, ratificamos y firmamos en la Ciudad de Cobán, Alta Verapaz, el " . fechaALetras($fecha_creacion) . ".
";

        $pdf->AddSection('', $intro);
        $pdf->AddSection('Cláusula Primera', $clausula_primera);
        $pdf->AddSection('Cláusula Segunda', $clausula_segunda);
        $pdf->AddSection('Cláusula Tercera', $clausula_tercera);
        $pdf->AddSection('Cláusula Cuarta', $clausula_cuarta);
        $pdf->AddSection('Cláusula Quinta', $clausula_quinta);
        $pdf->AddSection('Cláusula Sexta', $clausula_sexta);
        $pdf->AddSection('Cláusula Séptima', $clausula_septima);
        $pdf->AddSection('Cláusula Octava', $clausula_octava);
        $pdf->AddSection('Cláusula Novena', $clausula_novena);
        $pdf->AddSection('Cláusula Décima', $clausula_decima);
        $pdf->AddSection('Cláusula Décima Primera', $clausula_decima_primera);
        $pdf->AddSection('Cláusula Décima Segunda', $clausula_decima_segunda);
        $pdf->AddSection('Cláusula Décima Tercera', $clausula_decima_tercera);
        $pdf->Output('I', 'Contrato.pdf');
    } else {
        echo "Contrato no encontrado.";
    }
} else {
    echo "ID del contrato no proporcionado o no válido.";
}

function num2letras($num)
{
    $unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    $decenas = ['', 'diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
    $centenas = ['', 'cien', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

    if ($num < 10) {
        return $unidades[$num];
    } elseif ($num < 100) {
        $unidad = $num % 10;
        $decena = (int)($num / 10);
        return $unidad ? $decenas[$decena] . ' y ' . $unidades[$unidad] : $decenas[$decena];
    } elseif ($num < 1000) {
        $centena = (int)($num / 100);
        $resto = $num % 100;
        return $resto ? $centenas[$centena] . ' ' . num2letras($resto) : $centenas[$centena];
    }
    return (string)$num;
}

function num2letrasCui($cui)
{
    $partes = str_split($cui, 4);
    $resultado = [];
    foreach ($partes as $parte) {
        $resultado[] = num2letras((int) $parte);
    }
    return implode(', ', $resultado);
}

function fechaALetras($fecha)
{
    setlocale(LC_TIME, 'es_ES.UTF-8');
    return strftime('%d de %B de %Y', strtotime($fecha));
}
