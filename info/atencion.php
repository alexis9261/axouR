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
    <meta name="desciption" content="Tienda virtual de Suministros Mavic C.A. empresa de ventas de equipos de oficina. Impresoras.">
    <meta name="keywords" content="<?php echo $nombrePagina;?>">
    <meta name="author" content="Eutuxia, C.A.">
    <meta name="application-name" content="<?php echo $nombrePagina;?>."/>
    <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
    <link rel="stylesheet" href="../css/new.css">
    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo $nombrePagina;?></title>
  </head>
  <body>
    <?php include '../common/menu.php';include '../common/2domenu.php';?>
    <div class="jumbotron mb-0">
      <h1 class="display-4">Atención cercana</h1>
      <p class="lead">Si quieres un canal de comunicacion rápido, eficaz y preciso.
        <br>
        Estaremos atentos a tus dudas, opiniones y preguntas que desees realizarnos.</p>
        <p>Si deseas contactarnos pulsa <i><a href="https://hangouts.google.com/group/GIpcKg7aQhnHT3IL2">Aqui</a></i>.</p>
      <hr class="my-4">
      <p>Ten en cuenta que deberás tener una cuenta de correo Gmail para comunicarte con nosotros.
        Si no tienes una cuenta de Gmail, ve a este <a href="https://accounts.google.com/signup/v2/webcreateaccount?service=mail&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ltmpl=default&flowName=GlifWebSignIn&flowEntry=SignUp" target="_blank">enlace</a> y podrás crear una cuenta de Gmail.</p>
    </div>
    <?php include '../common/footer.php';?>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  </body>
</html>
