<?php
session_start();
include '../common/conexion.php';
include '../common/datosGenerales.php';
?>
<!doctype html>
<html lang="es">
<meta charset="utf-8">
<head>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="desciption" content="<?php echo $nombrePagina;?>, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
  <meta name="keywords" content="<?php echo $nombrePagina;?>, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Tienda Virtual de Ropa, <?php echo $nombrePagina;?>."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <link rel="stylesheet" href="../css/new.css">
  <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?php echo $nombrePagina;?></title>
  <style>
  .vista{
    width: 50%;
    background:#fff;
  }
  @media screen and (max-width:600px){
    .vista{
      width: 95%;
    }
  }
  #letrap{
    font-size: 30px;
  }
  #preg{
    font-size: 20px;
    cursor: pointer;
  }
  #res{
    font-size: 15px;
    text-align: justify;
    display: block;
  }
</style>
</head>
<body>
  <?php include '../common/menu.php'; include '../common/2domenu.php'; ?>
  <div class="pb-5" style="min-height:100vh; background: #ddd">
    <div class="container p-3">
      <h1 id="letrap" class="text-primary  text-center letrap">
        Términos y condiciones
      </h1>
      <hr class="my-4">
    </div>
    <div class ="container p-3 vista">
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          INFORMACIÓN GENERAL
        </h1>
        <p id="res">
          Se expone que: <b><?php echo $nombrePagina;?> C.A.</b>, Rif J-411161314  es el Titular del sitio web <i>www.rouxa.com.ve</i> <br>
          <i>www.rouxa.com.ve</i> es operado por <b><?php echo $nombrePagina;?> C.A.</b>, Rif J-XXXXXXXXXX. En todo el sitio, los términos “nosotros”, “nos” y “nuestro” se refieren a <b><?php echo $nombrePagina;?> C.A.</b>
          <br><br>
          <b><?php echo $nombrePagina;?> C.A.</b> ofrece el sitio web <i>www.rouxa.com.ve</i> , incluyendo toda la información, herramientas y servicios disponibles en este sitio, el usuario, está condicionado a la aceptación de todos los términos, condiciones, políticas y notificaciones aquí establecidos.
          <br><br>
          <i>www.rouxa.com.ve</i> ha sido construida para dar a conocer los productos y/o servicios ofrecidos por <b><?php echo $nombrePagina;?> C.A.</b>, consistentes en la puesta a disposición de un servicio de compra online de productos de oficina, impresoras, toners y demas articulos.
          <br><br>
          Al visitar nuestro sitio y/o comprar algo de nosotros, participas en nuestro “Servicio” y aceptas los siguientes términos y condiciones (“Términos de Servicio”, “Términos”), incluídos todos los términos y condiciones adicionales y las políticas a las que se hace referencia en el presente documento y/o disponible a través de hipervínculos. Estas Condiciones de Servicio se aplican a todos los usuarios  del sitio, incluyendo sin limitación a usuarios que sean navegadores, proveedores, clientes, comerciantes, y/o colaboradores de contenido.
          <br><br>
          Por favor, lee estos Términos de Servicio cuidadosamente antes de acceder o utilizar nuestro sitio web. Al acceder o utilizar cualquier parte del sitio, estás aceptando los Términos de Servicio. Si no estás de acuerdo con todos los términos y condiciones de este acuerdo, entonces no deberías acceder a la página web o usar cualquiera de los servicios. Si las Términos de Servicio son considerados una oferta, la aceptación está expresamente limitada a estos Términos de Servicio.
          <br><br>
          Cualquier función nueva o herramienta que se añadan a la tienda actual, tambien estarán sujetas a los Términos de Servicio. Puedes revisar la versión actualizada de los Términos de Servicio, en cualquier momento en esta página. Nos reservamos el derecho de actualizar, cambiar o reemplazar cualquier parte de los Términos de Servicio mediante la publicación de actualizaciones y/o cambios en nuestro sitio web. Es tu responsabilidad chequear esta página periódicamente para verificar cambios. Tu uso contínuo o el acceso al sitio web después de la publicación de cualquier cambio constituye la aceptación de dichos cambios.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 1 - TÉRMINOS DE LA TIENDA EN LÍNEA
        </h1>
        <p id="res">
          Al utilizar este sitio, declaras que tienes al menos la mayoría de edad en tu estado o provincia de residencia, o que tienes la mayoría de edad en tu estado o provincia de residencia y que nos has dado tu consentimiento para permitir que cualquiera de tus dependientes menores use este sitio.
          <br><br>
          No puedes usar nuestros productos con ningún propósito ilegal o no autorizado tampoco puedes, en el uso del Servicio, violar cualquier ley en tu jurisdicción (incluyendo pero no limitado a las leyes de derecho de autor).
          <br><br>
          No debes transmitir gusanos, virus o cualquier código de naturaleza destructiva.
          <br><br>
          El incumplimiento o violación de cualquiera de estos Términos darán lugar al cese inmediato de tus Servicios.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 2 - CONDICIONES GENERALES
        </h1>
        <p id="res">
          Nos reservamos el derecho de rechazar la prestación de servicio a cualquier persona, por cualquier motivo y en cualquier momento.
          <br><br>
          Entiendes que tu contenido (sin incluir la información de tu tarjeta de crédito), puede ser transferida sin encriptar e involucrar (a) transmisiones a través de varias redes; y (b) cambios para ajustarse o adaptarse a los requisitos técnicos de conexión de redes o dispositivos.
          <br><br>
          Estás de acuerdo con no reproducir, duplicar, copiar, vender, revender o explotar cualquier parte del Servicio, USP del Servicio, o acceso al Servicio o cualquier contacto en el sitio web a través del cual se presta el servicio, sin el expreso permiso por escrito de nuestra parte.
          <br><br>
          Los títulos utilizados en este acuerdo se incluyen solo por conveniencia y no limita o afecta a estos Términos.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 3 - PROPIEDAD INTELECTUAL E INDUSTRIAL
        </h1>
        <p id="res">
          <?php echo $nombrePagina;?> CA es la titular de todos los derechos de propiedad intelectual de la página www.rouxa.com.ve así como de su código fuente, diseño, estructuras de navegación y los distintos elementos en ellas contenidos en la misma. Corresponden también a <?php echo $nombrePagina;?> CA el ejercicio exclusivo de los derechos de explotación de los mismos en cualquier forma y, en especial, los derechos de reproducción, distribución, comunicación pública y transformación.
          <br><br>
          El presente sitio web,  las páginas que comprende y la información o elementos contenidos en las mismas, incluyen textos, documentos, fotografías, dibujos, representaciones gráficas, programas informáticos, así como logotipos, marcas, nombres comerciales, u otros signos distintivos, protegidos por derechos de propiedad intelectual.
          <br><br>
          La autorización al Usuario para el acceso a la web no supone renuncia, transmisión, licencia o cesión total ni parcial sobre derechos de propiedad intelectual o industrial por parte de <?php echo $nombrePagina;?> C.A.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 4 - EXACTITUD, EXHAUSTIVIDAD Y ACTUALIDAD DE LA INFORMACIÓN
        </h1>
        <p id="res">
          No nos hacemos responsables si la información disponible en este sitio no es exacta, completa o actual.  El material en este sitio es provisto sólo para información general y no debe confiarse en ella o utilizarse como la única base para la toma de decisiones sin consultar primeramente, información más precisa, completa u oportuna.  Cualquier dependencia en el material de este sitio es bajo su propio riesgo.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 5 - MODIFICACIONES AL SERVICIO Y PRECIOS
        </h1>
        <p id="res">
          Los precios de nuestros productos están sujetos a cambio sin aviso.
          <br><br>
          Nos reservamos el derecho de modificar o discontinuar el Servicio (o cualquier parte del contenido) en cualquier momento sin aviso previo.
          <br><br>
          No seremos responsables ante ti o alguna tercera parte por cualquier modificación, cambio de precio, suspensión o discontinuidad del Servicio.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 6 - PRODUCTOS O SERVICIOS
        </h1>
        <p id="res">
          Ciertos productos o servicios pueden estar disponibles exclusivamente en línea a través del sitio web. Estos productos o servicios pueden tener cantidades limitadas y estar sujetas a devolución o cambio de acuerdo a nuestra política de devolución solamente.
          <br><br>
          Hemos hecho el esfuerzo de mostrar los colores y las imágenes de nuestros productos, en la tienda, con la mayor precisión de colores posible.  No podemos garantizar que el monitor de tu computadora muestre los colores de manera exacta.
          <br><br>
          Nos reservamos el derecho, pero no estamos obligados, para limitar las ventas de nuestros productos o servicios a cualquier persona, región geográfica o jurisdicción.  Podemos ejercer este derecho basados en cada caso.  Nos reservamos el derecho de limitar las cantidades de los productos o servicios que ofrecemos.  Todas las descripciones de productos o precios de los productos están sujetos a cambios en cualquier momento sin previo aviso, a nuestra sola discreción.  Nos reservamos el derecho de discontinuar cualquier producto en cualquier momento.  Cualquier oferta de producto o servicio hecho en este sitio es nulo donde esté prohibido.
          <br><br>
          No garantizamos que la calidad de los productos, servicios, información u otro material comprado u obtenido por ti  cumpla con tus expectativas, o que cualquier error en el Servicio será corregido.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 7 - MÉTODOS DE PAGO
        </h1>
        <p id="res">
          <?php echo $nombrePagina;?> C.A. ofrece como metodos de pago las transferencias bancarias.
          <br><br>
          Si usted presenta dificultades al realizar proceso de pago, por favor proceda a comunicarse con nuestro equipo de atención al cliente.
          <br><br>
          En el caso de que usted sospeche que su orden ha sido duplicada, por favor contacte inmediatamente a nuestro equipo de atención al cliente a través de Whatsapp +58 412 743 78 60 ,para proceder a investigar el problema y proceder a reversar el pago antes que el pedido sea procesado. Cualquier orden duplicada que haya sido enviada antes de que <?php echo $nombrePagina;?> C.A  haya sido notificada, será reversada una vez que los productos hayan sido devueltos a nuestra dirección, y posteriormente verificados.
          <br><br>
          La moneda disponible para realizar pagos en www.rouxa.com.ve es el Bolívar (Bs), Moneda oficial de Venezuela.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 8 - FACTURACIÓN
        </h1>
        <p id="res">
          El usuario que realiza un compra “Cliente” tiene la posibilidad de abonar el importe de sus pedidos, con una Transaferencia bancarias.
          <br><br>
          El cliente deberá suministrar sus datos personales y dirección de residencia con la finalidad de emitir una factura fiscal por la compra efectuada, cumpliendo así con los requisitos exigidos por el SENIAT.
          <br><br>
          En caso de haberse facturado cargos que no hubiesen correspondido, deberá comunicarse con nuestro equipo de Atención al Cliente para resolver dicha cuestión.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          SECCIÓN 9 - EXACTITUD DE FACTURACIÓN E INFORMACIÓN DE CUENTA
        </h1>
        <p id="res">
          Nos reservamos el derecho de rechazar cualquier pedido que realice con nosotros. Podemos, a nuestra discreción, limitar o cancelar las cantidades compradas por persona, por hogar o por pedido. Estas restricciones pueden incluir pedidos realizados por o bajo la misma cuenta de cliente, la misma tarjeta de crédito, y/o pedidos que utilizan la misma facturación y/o dirección de envío.
          <br><br>
          En el caso de que hagamos un cambio o cancelemos una orden, podemos intentar notificarte poniéndonos en contacto vía correo electrónico y/o dirección de facturación / número de teléfono proporcionado en el momento que se hizo pedido. Nos reservamos el derecho de limitar o prohibir las órdenes que, a nuestro juicio, parecen ser colocado por los concesionarios, revendedores o distribuidores.
          <br><br>
          Te comprometes a proporcionar información actual, completa y precisa de la compra de productos y/o servicios en nuestra tienda.  No nos hacemos responsable de errores información proporcionados por tu parte. Mas sin embargo, trataremos de ayudarte rápidamente con la corrección de errores y así poder completar tu compra.
          <br><br>
          Para más detalles, por favor revisa nuestra Política de Devoluciones.
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 10 - HERRAMIENTAS OPCIONALES
          </h1>
          <p id="res">
            Es posible que te proporcionamos acceso a herramientas de terceros a los cuales no monitoreamos y sobre los que no tenemos control ni entrada. Mercado pago es uno de ellos  y es que se encarga de la cobranza de tu compra.
            <br><br>
            Reconoces y aceptas que proporcionamos acceso a este tipo de herramientas "tal cual" y "según disponibilidad" sin garantías, representaciones o condiciones de ningún tipo y sin ningún respaldo.  No tendremos responsabilidad alguna derivada de o relacionada con tu uso de herramientas proporcionadas por terceras partes.
            <br><br>
            Cualquier uso que hagas de las herramientas opcionales que se ofrecen a través del sitio bajo tu propio riesgo y discreción y debes asegurarte de estar familiarizado y aprobar los términos bajo los cuales estas herramientas son proporcionadas por el o los proveedores de terceros.
            También es posible que, en el futuro, te ofrezcamos nuevos servicios y/o características a través del sitio web (incluyendo el lanzamiento de nuevas herramientas y recursos).  Estas nuevas características y/o servicios también estarán sujetos a estos Términos de Servicio.
            <br><br>
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 11 - ENLACES DE TERCERAS PARTES
          </h1>
          <p id="res">
            Cierto contenido, productos y servicios disponibles vía nuestro Servicio puede incluir material de terceras partes.
            <br><br>
            Enlaces de terceras partes en este sitio pueden direccionarte a sitios web de terceras partes que no están afiliadas con nosotros.  No nos responsabilizamos  de examinar o evaluar el contenido o exactitud y no garantizamos ni tendremos ninguna obligación o responsabilidad por cualquier material de terceros o siitos web, o de cualquier material, productos o servicios de terceros.
            <br><br>
            No nos hacemos responsables de cualquier daño o daños relacionados con la adquisición o utilización de bienes, servicios, recursos, contenidos, o cualquier otra transacción realizadas en conexión con sitios web de terceros.  Por favor revisa cuidadosamente las políticas y prácticas de terceros y asegúrate de entenderlas antes de participar en cualquier transacción.  Quejas, reclamos, inquietudes o preguntas con respecto a productos de terceros deben ser dirigidas a la tercera parte.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 12 - COMENTARIOS DE USUARIO, CAPTACIÓN Y OTROS ENVÍOS
          </h1>
          <p id="res">
            Si, a pedido nuestro, envías ciertas presentaciones específicas (por ejemplo la participación en concursos) o sin un pedido de nuestra parte envías ideas creativas, sugerencias, proposiciones, planes, u otros materiales, ya sea en línea, por email, por correo postal, o de otra manera (colectivamente, 'comentarios'), aceptas que podamos, en cualquier momento, sin restricción, editar, copiar, publicar, distribuír, traducir o utilizar por cualquier medio comentarios que nos hayas enviado. No tenemos ni tendremos ninguna obligación (1) de mantener ningún comentario confidencialmente; (2) de pagar compensación por comentarios; o (3) de responder a comentarios.
            <br><br>
            Nosotros podemos, pero no tenemos obligación de, monitorear, editar o remover contenido que consideremos sea ilegítimo, ofensivo, amenazante, calumnioso, difamatorio, pornográfico, obsceno u objetable o viole la propiedad intelectual de cualquiera de las partes o los Términos de Servicio.
            Aceptas que tus comentarios no violarán los derechos de terceras partes, incluyendo derechos de autor, marca, privacidad, personalidad u otro derechos personal o de propiedad. Asimismo, aceptas que tus comentarios no contienen material difamatorio o ilegal, abusivo u obsceno, o contienen virus informáticos u otro malware que pudiera, de alguna manera, afectar el funcionamiento del Servicio o de cualquier sitio web relacionado.  No puedes utilizar una dirección de correo electrónico falsa, usar otra identidad que no sea legítima, o engañar a terceras partes o a nosotros en cuanto al origen de tus comentarios.  Tu eres el único responsable por los comentarios que haces y su precisión.  No nos hacemos responsables y no asumimos ninguna obligación con respecto a los comentarios publicados por ti o cualquier tercer parte.
            <br><br>
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 13 - INFORMACIÓN PERSONAL
          </h1>
          <p id="res">
            Tu presentación de información personal a través del sitio se rige por nuestra Política de Privacidad. Para ver nuestra Política de Privacidad.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 14 - ERRORES, INEXACTITUDES Y OMISIONES
          </h1>
          <p id="res">
            De vez en cuando puede haber información en nuestro sitio o en el Servicio que contiene errores tipográficos, inexactitudes u omisiones que puedan estar relacionadas con las descripciones de productos, precios, promociones, ofertas, gastos de envío del producto, el tiempo de tránsito y la disponibilidad. Nos reservamos el derecho de corregir los errores, inexactitudes u omisiones y de cambiar o actualizar la información o cancelar pedidos si alguna información en el Servicio o en cualquier sitio web relacionado es inexacta en cualquier momento sin previo aviso (incluso después de que hayas enviado tu orden) .
            No asumimos ninguna obligación de actualizar, corregir o aclarar la información en el Servicio o en cualquier sitio web relacionado, incluyendo, sin limitación, la información de precios, excepto cuando sea requerido por la ley. Ninguna especificación actualizada o fecha de actualización aplicada en el Servicio o en cualquier sitio web relacionado, debe ser tomada para indicar que toda la información en el Servicio o en cualquier sitio web relacionado ha sido modificado o actualizado.
            <br><br>
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 15 - USOS PROHIBIDOS
          </h1>
          <p id="res">
            En adición a otras prohibiciones como se establece en los Términos de Servicio, se prohibe el uso del sitio o su contenido: (a) para ningún propósito ilegal; (b) para pedirle a otros que realicen o participen en actos ilícitos; (c) para violar cualquier regulación, reglas, leyes internacionales, federales,nacionales,  provinciales o estatales, u ordenanzas locales; (d) para infringir o violar el derecho de propiedad intelectual nuestro o de terceras partes; (e) para acosar, abusar, insultar, dañar, difamar, calumniar, desprestigiar, intimidar o discriminar por razones de género, orientación sexual, religión, etnia, raza, edad, nacionalidad o discapacidad; (f) para presentar información falsa o engañosa; (g) para cargar o transmitir virus o cualquier otro tipo de código malicioso que sea o pueda ser utilizado en cualquier forma que pueda comprometer la funcionalidad o el funcionamiento del Servicio o de cualquier sitio web relacionado, otros sitios o Internet; (h) para recopilar o rastrear información personal de otros; (i) para generar spam, phish, pharm, pretext, spider, crawl, or scrape; (j) para cualquier propósito obsceno o inmoral; o (k) para interferir con o burlar los elementos de seguridad del Servicio o cualquier sitio web relacionado¿ otros sitios o Internet. Nos reservamos el derecho de suspender el uso del Servicio o de cualquier sitio web relacionado por violar cualquiera de los ítems de los usos prohibidos.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 16 - EXCLUSIÓN DE GARANTÍAS; LIMITACIÓN DE RESPONSABILIDAD
          </h1>
          <p id="res">
            No garantizamos ni aseguramos que el uso de nuestro servicio será ininterrumpido, puntual, seguro o libre de errores.
            <br><br>
            No garantizamos que los resultados que se puedan obtener del uso del servicio serán exactos o confiables.
            <br><br>
            Aceptas que de vez en cuando podemos quitar el servicio por períodos de tiempo indefinidos o cancelar el servicio en cualquier momento sin previo aviso.
            <br><br>
            Aceptas expresamente que el uso de, o la posibilidad de utilizar, el servicio es bajo tu propio riesgo.  El servicio y todos los productos y servicios proporcionados a través del servicio son (salvo lo expresamente manifestado por nosotros) proporcionados "tal cual" y "según esté disponible" para su uso, sin ningún tipo de representación, garantías o condiciones de ningún tipo, ya sea expresa o implícita, incluídas todas las garantías o condiciones implícitas de comercialización, calidad comercializable, la aptitud para un propósito particular, durabilidad, título y no infracción.
            <br><br>
            En ningún caso <?php echo $nombrePagina;?> CA, nuestros directores, funcionarios, empleados, afiliados, agentes, contratistas, internos, proveedores, prestadores de servicios o licenciantes serán responsables por cualquier daño, pérdida, reclamo, o daños directos, indirectos, incidentales, punitivos, especiales o consecuentes de cualquier tipo, incluyendo, sin limitación, pérdida de beneficios, pérdida de ingresos, pérdida de ahorros, pérdida de datos, costos de reemplazo, o cualquier daño similar, ya sea basado en contrato, agravio (incluyendo negligencia), responsabilidad estricta o de otra manera, como consecuencia del uso de cualquiera de los servicios o productos adquiridos mediante el servicio, o por cualquier otro reclamo relacionado de alguna manera con el uso del servicio o cualquier producto, incluyendo pero no limitado, a cualquier error u omisión en cualquier contenido, o cualquier pérdida o daño de cualquier tipo incurridos como resultados de la utilización del servicio o cualquier contenido (o producto) publicado, transmitido, o que se pongan a disposición a través del servicio, incluso si se avisa de su posibilidad.  Debido a que algunos estados o jurisdicciones no permiten la exclusión o la limitación de responsabilidad por daños consecuenciales o incidentales, en tales estados o jurisdicciones, nuestra responsabilidad se limitará en la medida máxima permitida por la ley.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 17 - INDEMNIZACIÓN
          </h1>
          <p id="res">
            Aceptas indemnizar, defender y mantener indemne <?php echo $nombrePagina;?> CA y nuestras matrices, subsidiarias, afiliados, socios, funcionarios, directores, agentes, contratistas, concesionarios, proveedores de servicios, subcontratistas, proveedores, internos y empleados, de cualquier reclamo o demanda, incluyendo honorarios razonables de abogados, hechos por cualquier tercero a causa o como resultado de tu incumplimiento de las Condiciones de Servicio o de los documentos que incorporan como referencia, o la violación de cualquier ley o de los derechos de un tercero.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 18 - DIVISIBILIDAD
          </h1>
          <p id="res">
            En el caso de que se determine que cualquier disposición de estas Condiciones de Servicio sea ilegal, nula o inejecutable, dicha disposición será, no obstante, efectiva a obtener la máxima medida permitida por la ley aplicable, y la parte no exigible se considerará separada de estos Términos de Servicio, dicha determinación no afectará la validez de aplicabilidad de las demás disposiciones restantes.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 19 - RESCISIÓN
          </h1>
          <p id="res">
            Las obligaciones y responsabilidades de las partes que hayan incurrido con anterioridad a la fecha de terminación sobrevivirán a la terminación de este acuerdo a todos los efectos.
            <br><br>
            Estas Condiciones de servicio son efectivos a menos que y hasta que sea terminado por ti o nosotros. Puedes terminar estos Términos de Servicio en cualquier momento por avisarnos que ya no deseas utilizar nuestros servicios, o cuando dejes de usar nuestro sitio.
            <br><br>
            Si a nuestro juicio, fallas, o se sospecha que haz fallado, en el cumplimiento de cualquier término o disposición de estas Condiciones de Servicio, tambien podemos terminar este acuerdo en cualquier momento sin previo aviso, y seguirás siendo responsable de todos los montos adeudados hasta incluída la fecha de terminación; y/o en consecuencia podemos negarte el acceso a nuestros servicios (o cualquier parte del mismo).
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 20 - ACUERDO COMPLETO
          </h1>
          <p id="res">
            Nuestra falla para ejercer o hacer valer cualquier derecho o disposiciôn de estas Condiciones de Servicio no constituirá una renuncia a tal derecho o disposición.
            <br><br>
            Estas Condiciones del servicio y las políticas o reglas de operación publicadas por nosotros en este sitio o con respecto al servicio constituyen el acuerdo completo y el entendimiento entre tu y nosotros y rigen el uso del Servicio y reemplaza cualquier acuerdo, comunicaciones y propuestas anteriores o contemporáneas, ya sea oral o escrita, entre tu y nosotros (incluyendo, pero no limitado a, cualquier versión previa de los Términos de Servicio).
            <br><br>
            Cualquier ambigüedad en la interpretación de estas Condiciones del servicio no se interpretarán en contra del grupo de redacción.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 21 - LEY
          </h1>
          <p id="res">
            Estas Condiciones del servicio y cualquier acuerdos aparte en el que te proporcionamos  servicios se regirán e interpretarán en conformidad con las leyes vigentes de la República Bolivariana Venezuela.
            <br><br>
            Cualquier controversia derivada del presente acuerdo, su existencia, validez, interpretación, alcance o cumplimiento, será sometida a las leyes aplicables y a los Tribunales competentes de la República Bolivariana de Venezuela y los procedimientos se llevarán a cabo en idioma castellano.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 22 - CAMBIOS EN LOS TÉRMINOS DE SERVICIO
          </h1>
          <p id="res">
            Puedes revisar la versión más actualizada de los Términos de Servicio en cualquier momento en esta página.
            <br><br>
            Nos reservamos el derecho, a nuestra sola discreción, de actualizar, modificar o reemplazar cualquier parte de estas Condiciones del servicio mediante la publicación de las actualizaciones y los cambios en nuestro sitio web. Es tu responsabilidad revisar nuestro sitio web periódicamente para verificar los cambios. El uso contínuo de o el acceso a nuestro sitio Web o el Servicio después de la publicación de cualquier cambio en estas Condiciones de servicio implica la aceptación de dichos cambios.
          </p>
          <hr>
        </div>
        <div id="topic" class="container">
          <h1 id="preg" class="text-center">
            SECCIÓN 23 - INFORMACIÓN DE CONTACTO
          </h1>
          <p id="res">
            Preguntas acerca de los Términos de Servicio deben ser enviadas al Whatsapp +58 412 743 78 60
          </p>
        </div>
      </div>
    </div>
    <?php include '../common/footer.php';?>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
