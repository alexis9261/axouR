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
  <div class="pb-5" style="min-height:100vh; background: #ddd">
    <div class="container p-3">
      <h1 id="letrap" class="text-primary  text-center letrap">
        Politicas de Envios
      </h1>
      <hr class="my-4">
    </div>
    <div class ="container p-3 vista">
      <div id="topic" class="container">
        <p id="res">
          <?php echo $nombrePagina;?> C.A. Se reserva el derecho de modificar dichas politicas de envios, en el momento que lo considere necesario. Las modificaciones de dichas políticas serán publicadas y/o divulgadas a través de correo y redes sociales.
          <br><br>
          Es deber del usuario mantenerse informado de nuestras politicas de envios a la hora de realizar una compra en nuestro sitio web.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          DESTINO DE ENVIOS
        </h1>
        <p id="res">
          <?php echo $nombrePagina;?> C.A. realiza envíos dentro de todo el territorio nacional de venezuela, a través de las empresas de paquetes y/o encomienda.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          TIEMPOS DE PROCESAMIENTO
        </h1>
        <p id="res">
          Los envios los realizamos de 24 a 48 Horas a partir de que se confirme en nuestras cuentas el pago del pedido. Una  vez confirmado el pago, nuestra plataforma cambiará el estatus de su pedido a “Pagado/Por enviar”. Dicho estatus podrá verlo mediante la herramienta de seguimiento ofrecida.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          ENVIOS DENTRO DEL TERRITORIO NACIONAL
        </h1>
        <p id="res">
          Los envíos son realizados de Lunes a Viernes a las 3:00 PM. Sin Excepción. Todos los envíos son realizados con cobro en destino, si desea otro medio de envio, consulte con nosotros.
          <br><br>
          El tiempo que tarda en llegar los pedidos a sus manos dependerá de la empresa de encomiendas, del lugar de destino, y de la fecha en la cual se realiza el envío (feriados, fin de semana). En promedio tarda de 4 a 7 días en llegar.
          Tenga en cuenta que las empresas de encomienda puede incurrir en retrasos por distintos motivos, No nos hacemos responsables de dichos retrasos.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          ENVIOS FUERA DEL TERRITORIO NACIONAL
        </h1>
        <p id="res">
          Por los momentos no ofrecemos nuestros servicios fuera de la República Bolivariana de Venezuela. Sin embargo, si desea que realizar una compra aca en Venezuela y enviar el pedido fuera de nuestras fronteras le recomendamos escribirnos a nuestro correo de atención al cliente.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          COSTOS DEL ENVIO
        </h1>
        <p id="res">
          Los costos de los envíos son valores que son generados por las empresas de paquetes y/o encomienda, por lo cual no podemos proporcionarlos nosotros. Los costos dependen del lugar de destino, el peso, y si el paquete será asegurado o no.
        </p>
        <hr>
      </div>
      <div id="topic" class="container">
        <h1 id="preg" class="text-center">
          INFORMACION ADICIONAL
        </h1>
        <p id="res">
          Si tiene problemas a la hora de completar los campos solicitados de envíos, puede escribirnos a nuestro correo de atención al cliente.
          <br><br>
          <?php echo $nombrePagina;?> C.A. no se hace responsable de cualquier extravío o elemento faltante en el caso donde por error u omisión la empresa de  encomiendas y/o paquetes  realiza cambio en los datos de información  del envío, tales como dirección, cédula o nombre del receptor,  teléfono.  Adicionalmente, <?php echo $nombrePagina;?> C.A.  no se hace responsable de paquetes perdidos, dañados o retrasados en tránsito.
          <br><br>
          Si el cliente comete un error en la dirección de envío durante el proceso de compra, la empresa se reserva el derecho de cobrar los costes de reenvío del pedido. Los costes de envío de los pedidos no son reembolsables.
        </p>
      </div>
    </div>
  </div>
  <!--Pie de Pagina !-->
  <?php include '../common/footer.php';?>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
