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
  <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
  <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Tienda Virtual de Ropa, <?php echo $nombrePagina;?>."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <link rel="stylesheet" href="../css/new.css">
  <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <title><?php echo $nombrePagina;?></title>
</head>
<body>
  <?php include '../common/menu.php';include '../common/2domenu.php';?>
  <div class="container mb-0">
    <div class="row bg-light py-3 px-3" style="border-radius:5px;">
      <h3 class="lead"><strong>Mi Cuenta</strong></h3>
    </div>
    <div class="row bg-light my-3 py-2">
      <div class="col-auto mb-3">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Nombre</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $nombre;?>" readonly>
        </div>
      </div>
      <div class="col-auto mb-3">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Apellido</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $apellido;?>" readonly>
        </div>
      </div>
      <div class="col-auto mb-3">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Documento Identidad</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $identidad;?>" readonly>
        </div>
      </div>
      <div class="col-12 col-sm-4 mb-3">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Correo</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $email_user;?>" readonly>
        </div>
      </div>
      <div class="col-auto mb-3">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Teléfono de contacto</span>
          </div>
          <?php if(isset($telefono) && !empty($telefono)){ ?>
            <input type="text" class="form-control" value="<?php echo $telefono;?>">
          <?php }else{ ?>
            <input type="text" class="form-control">
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="row bg-light my-3 py-2 justify-content-center">
      <button class="btn btn-primary px-5" type="submit">Actualizar mis datos</button>
    </div>
    <hr>
    <div class="row mb-3">
      <h6 class="lead text-muted">Cambiar mi clave</h6>
    </div>
    <div class="row mb-4">
      <div class="col-auto mb-3">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Nueva clave</span>
          </div>
          <input type="password" class="form-control">
        </div>
      </div>
      <div class="col-auto mb-3">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Repite la nueva clave</span>
          </div>
          <input type="password" class="form-control">
        </div>
      </div>
      <div class="col-auto mb-3">
        <button class="btn btn-primary px-5" type="submit">Cambiar</button>
      </div>
    </div>
  </div>
    <?php include '../common/footer.php';?>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
