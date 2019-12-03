<?php
session_start();
session_unset();
session_destroy();
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
  <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Tienda Virtual de Ropa, Rouxa."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <link rel="stylesheet" href="../css/style-main.css">
  <link rel="stylesheet" href="../css/new.css">
  <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <title><?php echo $nombrePagina;?></title>
</head>
<body class="bg-ligth">
  <?php include '../common/menu.php'; ?>
  <?php include '../common/2domenu.php'; ?>
  <nav class="navbar navbar-expand-md py-5 my-5">
    <div class="container mb-5 pb-5">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title" style="font-family: 'Playfair Display', serif;">¡Hazle seguimiento a tu compra!</h3>
          <h6 class="card-subtitle lead">
            Si deseas conocer el estatus de tu pedido ( Procesado, empaquetado, o Enviado) o ya sea que buscas el número de Guia del envio, Presiona <a href="seguimiento.php">Aqui</a>
          </h6>
          <hr>
          <h3  class="card-title" style="font-family: 'Playfair Display', serif;">¡Reporta un Pago!</h3>
          <h6 class="card-subtitle lead">Si has realizado un pago por Transferencia bancaria u otro medio de pago externo que requiera ser verificado por nuestro departamento de Finanzas, Presiona <a href="Reporte.php">Aqui</a> </h6>
        </div>
      </div>
    </div>
  </nav>
  <?php include '../common/footer.php';?>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
