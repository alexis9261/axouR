<?php
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
    <link rel="stylesheet" href="../css/new.css">
    <link href="../css/simpleToastMessage.css" rel="stylesheet">
    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../js/simpleToastMessage.js"></script>
    <title><?php echo $nombrePagina;?></title>
  <script>
    $(document).ready(function(){
      $("#reporte").click(function(){
        var id=$("#key").val();
        var bncr=$("#banco-r").val();
        var bnce=$("#banco-e").val();
        var monto=$("#monto").val();
        var moneda=$("#moneda").val();
        var referencia=$("#referencia").val();
        var fecha=$("#fechapago").val();
        var ident=$("#type-identidad-cliente").val()+'-'+$("#doc-identidad-cliente").val();
        var acceso="<?php echo md5('Venezuela Libre'); ?>";
        $.post("procesar_pago.php",
        {
          idcompra:id,
          bancoe: bnce,
          bancor:bncr,
          monto:monto,
          moneda:moneda,
          referencia:referencia,
          fecha:fecha,
          docid:ident,
          pass:acceso,
        } , function(data, status){
          if(data==0){
            successToastAuto("Pago Almacenado Exitosamente");
            $('input[type="text"]').val('');
            $('input[type="number"]').val('');
            $('input[type="date"]').val('');
          }else if(data=='-1'){
            errorToastAuto("Ha ocurrido un Error");
          }else if(data=='-2'){
            errorToastAuto("Falta la llave digital");
          }else if(data=='-3'){
              errorToastAuto("Llave digital o cedula incorrecto");
          }else if(data=='-4'){
            defaultToastAuto("Faltan datos de Pago");
          }else{
            errorToastAuto("Error Fatal, Intentelo Nuevamente");
          }
   //alert("Data: " + data + "\nStatus: " + status);
  // defaultToastAuto("Default toast");
  // successToastAuto("Success toast");
  // errorToastAuto("Error toast");
        });
      });
    });
    </script>
  </head>
  <body>
    <?php include '../common/menu.php'; include '../common/2domenu.php'; ?>
   <div class="container mt-4">
    <h1 style="font-family: 'Playfair Display', serif;">¡Reporta un Pago!</h1>
    <p class="lead">Inserta tu <a href="../info/index.php?id=5" target="_blank">llave digital</a> de compra en el campo que se muestra abajo junto con tu cedula y los datos de pago. Y podrás Reportar el pago de tu compra. <b>Recuerda realizar el pago por el monto exacto de la compra.</b></p>
    <hr class="my-4">
  </div>
    <div class="container">
      <div class="row my-3">
          <div class="input-group col-sm-6 mb-2">
            <select id="type-identidad-cliente" style="border: 1px solid #ddd; width:20%; border-radius: 4px 0 0 4px;">
              <option value="V" selected>V</option>
              <option value="E">E</option>
              <option value="P">Passaporte</option>
            </select>
            <input type="text" placeholder="Documento de identidad del cliente [Ej: 20184765]" id="doc-identidad-cliente" maxlength="30" class="form-control" required>
          </div>
          <div class="input-group col-sm-6 mb-2">
            <input type="text" class="form-control" placeholder="Inserte su Llave digital del pedido" aria-label="Inserte su Llave digital" aria-describedby="basic-addon2"  id="key" maxlength="32"/>
          </div>
          <div class="input-group col-sm-12 mb-2">
            <h3 class="text-muted">Datos del Pago</h3>
          </div>
          <div class="input-group col-sm-6 mb-2">
            <input type="text" class="form-control" placeholder="Banco donde realizó la transferencia (Tu Banco)" aria-label="Inserte su Llave digital" aria-describedby="basic-addon2"  id="banco-e" maxlength="32"/>
          </div>
          <div class="input-group col-sm-6 mb-2">
            <input type="text" class="form-control" placeholder="Banco a donde realizó la transferencia (Nuestro Banco)" aria-label="Inserte su Llave digital" aria-describedby="basic-addon2"  id="banco-r" maxlength="32"/>
          </div>
          <div class="input-group col-sm-6 mb-2">
            <input type="number" step="0.01" class="form-control" placeholder="Inserte el Monto Transferido" aria-label="Inserte su Llave digital" aria-describedby="basic-addon2"  id="monto" maxlength="32"/>
            <select id="moneda" style="border: 1px solid #ddd; width:20%; border-radius: 0 4px  4px 0;">
              <option value="Bs" selected>Bolivares</option>
            </select>
          </div>
          <div class="input-group col-sm-6 mb-2">
            <input type="text" class="form-control" placeholder="Inserte la Referencia de la Transacción" aria-label="Inserte la Referencia de la Transacción" aria-describedby="basic-addon2"  id="referencia" maxlength="32"/>
          </div>
          <div class="input-group col-sm-12 mb-2">
            <label  class="input-group-text"  for="fecha">Fecha de transacción</label>
            <input type="date" class="form-control" tooltip="Fecha de la transacción" aria-label="Inserte la Referencia de la Transacción" aria-describedby="basic-addon2"  id="fechapago"/>
          </div>
          <!--  <div class="g-recaptcha col" data-sitekey="6LezMGIUAAAAAK7US9I7C9wD2OV9Hufqb8V5whVY"></div>
        -->
        <input type="hidden" id="g-recaptcha-response">
        <div class="input-group-append mt-3 col-12 justify-content-center">
          <button  id="reporte" type="submit" class="btn btn-outline-secondary">Reportar pago</button>
        </div>
      </div>
      <div class="row pb-4 justify-content-center pt-3">
        <a class="btn btn-outline-primary px-5" href="index.php">Volver</a>
      </div>
    </div>
    <?php include '../common/footer.php';?>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php $conn->close(); ?>
