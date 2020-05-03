<?php
session_start();
include '../common/conexion.php';
//nombre y logo pagina
$sql="SELECT * from `configuracion`";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if ($row['ATRIBUTO']=="nombrePagina") {
      $nombrePagina=$row['VALOR'];
    }else if ($row['ATRIBUTO']=="imageLogo") {
      $imageLogo=$row['VALOR'];
    }
  }
}
 ?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
    <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
    <meta name="author" content="Eutuxia, C.A.">
    <meta name="application-name" content="Tienda Virtual de Ropa, <?php echo $nombrePagina;?>."/>
    <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
    <link rel="stylesheet" href="../css/new.css">
    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo $nombrePagina;?></title>
  </head>
  <body>
    <?php include '../common/menu.php'; include '../common/2domenu.php'; ?>
    <div class="jumbotron mb-0">
      <h1 class="display-4">¡Contáctanos!</h1>
      <p class="lead">Puedes contactarnos en nuestras redes sociales. Si deseas consultar alguna duda con nosotros, puedes contactarnos a traves de nuestro servicio de <i><a href="atencion.php">Atención personal</a></i>.</p>
      <hr class="my-4">
      <p>También puedes ver la sección de <a href="../faq/index.php">preguntas frecuentes</a> donde puedes ver respuestas a posibles inquietudes que podrías tener.</p>
    </div>
<?php include '../common/footer.php';?>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
