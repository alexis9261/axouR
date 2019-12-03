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
  <!-- Inicio de codigo. !-->
  <div class="pb-5" style="min-height:100vh; background: #ddd">
    <div class="container p-3">
      <h1 id="letrap" class="text-primary  text-center letrap">
        Políticas de devoluciones
      </h1>
      <hr class="my-4">
    </div>
    <div class="container p-3 vista">
      <div id="topic" class="container">
        <p id="res">
          <b><?php echo $nombrePagina;?> C.A.</b> Se reserva el derecho de modificar dichas políticas de devoluciones, en el momento que lo considere necesario. Las modificaciones de dichas políticas serán publicadas y/o divulgadas a través de correo y redes sociales.
          <br><br>
          Es deber del usuario mantenerse informado de nuestras políticas de devoluciones a la hora de realizar una compra en nuestro sitio web.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          INFORMACION GENERAL
        </h1>
        <p id="res">
          <?php echo $nombrePagina;?> C.A. No Acepta devoluciones por parte de los usuarios a menos que haya recibido un artículo con defectos de fabrica o que el producto recibido no sea el correcto.
          <br><br>
          De igual manera, <?php echo $nombrePagina;?> C. A. Hará todo el esfuerzo por brindar información precisa, exacta y detallada de todos los artículos y/o servicios  que se muestran en www.suministrosmavic.com . Es su deber revisar detalladamente cada imagen e información suministrada en nuestro sitio web, para evitar así posibles confusiones.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          PRODUCTO INCORRECTO O DEFECTUOSO
        </h1>
        <p id="res">

          En el caso de que a usted, se le haya enviado un pedido incorrecto o un producto defectuoso, por favor notificarlo inmediatamente vía e-mail a nuestro equipo de atención al cliente suministrosmavic@gmail.com  con la llave digital de la compra y nombre del artículo incorrecto o defectuoso.
          <br><br>
          Los productos defectuoso o incorrectos deberán ser devueltos a nuestras oficinas, para corroborar el defecto de fábrica o el error al enviar el artículo.   una vez recibamos la prueba y corroboramos que se te fue enviado un artículo defectuoso o incorrecto,  Nosotros enviaremos el producto correcto.
          <br><br>
          Los costes de envío son reembolsables única y exclusivamente para estos casos donde nosotros cometimos el error.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          REMBOLSO DE DINERO
        </h1>
        <p id="res">
          Los reembolsos sólo son aplicables en los casos donde la mercancía cuenta con defectos de fabrica y/o el producto enviado a sido incorrecto.
          <br><br>
          Recibirá el reembolso en un plazo de 14 días naturales a partir de que:
          <br><br>
          Hayamos recibido el pedido devuelto en nuestros almacenes; o nos comuniques tu decisión de revocar el contrato de compra. En ese plazo de 14 días (a) deberás enviarnos una prueba de que has devuelto tu pedido o (b) recibiremos tu pedido online en nuestros almacenes.
          <br><br>
          Una vez hayas entregado el paquete al servicio de mensajería, tardará entre 3 - 5 días laborables en llegar a nuestro almacén. Cuando recibamos los productos devueltos, nos colocaremos en contacto contigo para realizar el rembolso si así lo deseas.
        </p>
      </div>
    </div>
  </div>
  <!--Fin  de codigo. !-->
  <!--Pie de Pagina !-->
  <?php include '../common/footer.php';?>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
