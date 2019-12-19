<?php
session_start();
include '../common/conexion.php';
include '../common/datosGenerales.php';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
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
    width: 60%;
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
        Políticas de privacidad
      </h1>
      <hr class="my-4">
    </div>
    <div class ="container p-3 vista">
      <div id="topic" class="container">
        <p id="res">
          El presente Política de Privacidad establece los términos en que <?php echo $nombrePagina;?> C.A. usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta empresa está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.
          <br><br>
          <?php echo $nombrePagina;?> C.A. Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          INFORMACION QUE ES RECOGIDA
        </h1>
        <p id="res">
          Nuestro sitio web podrá recoger información personal por ejemplo: Nombre, información de contacto como su dirección de correo electrónica, número de teléfono e información demográfica. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.
          <br><br>
          <?php echo $nombrePagina;?> C.A. asegura que cualquier información personal que usted provea durante los procesos de registro y compra, mantendrá un carácter confidencial y sólo será utilizada con el propósito de procesar su orden y brindarle el mejor servicio. <?php echo $nombrePagina;?> C.A. garantiza que su información personal cargada en nuestro portal no será facilitada a cualquier organización externa o terceras partes.
          <br><br>
          Tenga en cuenta que datos bancarios, información de tarjetas de crédito / débito, o cualquier información personal referida a sus pagos, jamás serán solicitadas por nuestra plataforma www.rouxa.com.ve. Esta tarea de cobranza del pago de sus pedidos será procesada mediante un tercero “Mercadopago”, se recomienda leer términos y condiciones de dicha plataforma para concretar los pagos de forma correcta.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          USO DE LA INFORMACION RECOGIDA
        </h1>
        <p id="res">
          Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de las compras de productos y/o Servicios, de pedidos, y de facturación. Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento. <?php echo $nombrePagina;?> C.A. está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          COOKIES
        </h1>
        <p id="res">
          Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.
          <br><br>
          www.rouxa.com.ve, emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente, visitas a una web .
          <br><br>
          Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          ENLACES A TERCEROS
        </h1>
        <p id="res">
          Este sitio web pudiera contener enlaces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          CONTROL DE SU INFORMACION PERSONAL
        </h1>
        <p id="res">
          En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web. Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico. En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento. Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.
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
