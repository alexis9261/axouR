<?php
session_start();
//if(!isset($_POST['monto'])){header('Location: ../index.php');}
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
//mensaje de $msn_cuentas
$msn_cuentas="";
//require ('../common/mercadopago.php');
//$mp=new MP('1153047962046613', 'i3RGdgCvJXrKT1ceMNOHs4YLNHdgZ9Mj');
if(isset($_POST['direccion'])){
  $direccion=str_replace("'","",$_POST['direccion']);
  $postal=$_POST['postal'];
  if(isset($_POST['encomienda_aux'],$_POST['estado_aux'],$_POST['municipio_aux'])){
    $estado=$_POST['estado_aux'];
    $municipio=$_POST['municipio_aux'];
    $encomienda=$_POST['encomienda_aux'];
  }else{
    $estado=$_POST['estado'];
    $municipio=$_POST['municipio'];
    $encomienda=$_POST['encomienda'];
  }
  $monto=$_POST['monto'];
  if(isset($_POST['isfacture'])){
    $razon=$_POST['razon-social'];
    $identidad=$_POST['type-identidad'].'-'.$_POST['doc-identidad'];
    $dir_fiscal=$_POST['dir-fiscal'];
    //veo si ya hay direccion fiscal registrada
    $sql="SELECT RIFCI FROM usuarios WHERE CORREO='$email_user';";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        $rif=$row['RIFCI'];
      }
    }
    if(empty($rif)){
      //Se agregan estos datos a los datos del usuario
      $sql="UPDATE usuarios SET RAZONSOCIAL='$razon',RIFCI='$identidad',DIRFISCAL='$dir_fiscal' WHERE CORREO='$email_user';";
      if($conn->query($sql)===TRUE){}
    }
  }else{$razon='';$identidad='';$dir_fiscal='';}
  include 'comprar.php';
  //Enviar mail
  /*$cliente_mail=$_SESSION['nombre-cliente'];
  $destino=$_SESSION['email-cliente'];
  $titulo="Compra en Rouxa";
  $contenido = '<html>
  <head>
  <title>Rouxa</title>
  </head>
  <body>
  <h1>Compra en rouxa</h1>
  <p style="color:black">Un saludo cordial '.$cliente_mail.',
  <br>Agradecemos tu compra realizada en nuestra tienda virtual Rouxa, Recuerda que puedes hacerles seguimiento a traves del siguiente ID.
  <br>Que tengas un Feliz Dia.
  </p>
  <h4> IDCOMPRA: '.$Llave.'</h4>
</body>
</html>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Rouxa <Rouxavzla@gmail.com>" . "\r\n";
mail($destino, $titulo, $contenido, $headers);
*/
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
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <title><?php echo $nombrePagina;?></title>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
</head>
<body>
  <?php include '../common/menu.php';include '../common/2domenu.php';?>
  <div class="container mb-2">
    <div class="row align-items-center">
      <div class="col-auto text-center">
        <img src="../admin/img/<?php echo $imageLogo;?>" width="40px" height="auto">
      </div>
      <div class="col-auto text-center">
        <h2 style="font-family:'Playfair Display',serif;">¡Felicidades por tu Compra!</h2>
      </div>
      <div class="col-auto ml-auto align-self-end">
        <small class="text-muted">Puedes ver los detalles de tu compra en <a href="../perfil/compras.php">Mis compras</a> </small>
      </div>
    </div>
  </div>
  <div class="container mb-0">
    <div class="row bg-light my-3 py-2 align-items-center">
      <h5 class="col-auto text-dark text-center"><b>Monto a cancelar:</b> <?php echo number_format($monto*round($dolar),2,',','.');?> Bs </h5>
      <button class="btn btn-link col-auto ml-auto" type="button" data-toggle="modal" data-target="#cuentas_bancarias" id="button_modal_cuentas">Ver cuentas bancarias</button>
    </div>
  </div>
  <div class="container mb-5">
    <div class="row">
      <div class="col-auto mb-2">
        <h3 class="lead"><strong>Reportar pago - </strong> <small class="text-muted">Luego de <strong> venticuatro (24) Horas </strong> se cancela tu pedido en caso de no recibir un <i>Reporte de pago</i>.</small></h3>
      </div>
    </div>
    <form action="procesar_pago.php" method="post">
      <div class="row">
        <label class="col-auto"><input type="radio" value="transferencia" name='medio_pago[]' checked><span class="checkmark"> Transferencia</span>
        </label>
        <label class="col-auto"><input type="radio" value="transferencia" name='medio_pago[]'><span class="checkmark"> Pago Móvil</span>
        </label>
        <label class="col-auto"><input type="radio" value="transferencia" name='medio_pago[]'><span class="checkmark"> Otro Medio</span>
        </label>
      </div>
      <div class="row my-3">
        <div class="input-group mb-2 col-sm-4">
          <div class="input-group-prepend">
            <span class="input-group-text" data-toggle="tooltip" title="Desde donde realizaste la trasnferencia">Banco emisor</span>
          </div>
          <select class="custom-select input_datos" name="banco_e">
            <option value="Banesco">Banesco</option>
            <option value="Mercantil">Mercantil</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Tesoro">Del Tesoro</option>
            <option value="Provincial">Provincial</option>
            <option value="100% Banco">100% Banco</option>
            <option value="Bancaribe">Bancaribe</option>
            <option value="Banco Activo">Banco Activo</option>
            <option value="Bicentenario">Bicentenario</option>
            <option value="BNC">Banco Nacional de Credito</option>
            <option value="Venezolano de Crédito">Venezolano de Crédito</option>
            <option value="BOD">BOD</option>
            <option value="Fondo Común">Fondo Común</option>
            <option value="Banplus">Banplus</option>
            <option value="Exterior">Banco Exterior</option>
            <option value="Caroní">Caroní</option>
            <option value="Banco Plaza">Banco Plaza</option>
            <option value="Del Sur">Del Sur</option>
            <option value="Bancrecer">Bancrecer</option>
          </select>
        </div>
        <div class="input-group mb-2 col-sm-4">
          <div class="input-group-prepend">
            <span class="input-group-text" data-toggle="tooltip" title="Hacia donde realizaste la trasnferencia">Banco receptor</span>
          </div>
          <select class="custom-select input_datos" name="banco_r">
            <option value="Banesco">Banesco</option>
            <option value="Mercantil">Mercantil</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Tesoro">Del Tesoro</option>
          </select>
        </div>
        <div class="input-group flex-nowrap mb-2 col-sm-4">
          <div class="input-group-prepend">
            <span class="input-group-text" data-toggle="tooltip" title="Lo que transferite">Monto</span>
          </div>
          <input class="form-control input_datos text-dark" type="number" step="1" name="monto" placeholder="Inserte el Monto Transferido" maxlength="255"/>
        </div>
      </div>
      <div class="row">
        <div class="input-group col-sm-6 mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text">Fecha de transacción</span>
          </div>
          <input class="form-control text-dark" type="date" name="fechapago" required/>
        </div>
        <div class="input-group mb-2 col-sm-6">
          <div class="input-group-prepend">
            <span class="input-group-text" data-toggle="tooltip" title="Referencia de la trasnferencia">Referencia</span>
          </div>
          <input class="form-control input_datos text-dark" type="text" name="referencia" placeholder="Inserte la Referencia de la Transacción" maxlength="255" required/>
        </div>
      </div>
      <input type="hidden" name="id_pedido" value="<?php echo $id_pedido;?>">
      <div class="row justify-content-center mt-4">
        <div class="col-auto">
          <button class="btn btn-primary px-5 mr-3" type="submit">Registrar pago</button>
        </div>
        <div class="col-auto">
          <button class="btn btn-danger px-5" type="button" data-toggle="modal" data-target="#pagar_luego">Pagar después</button>
        </div>
      </div>
    </form>
  </div>
  <!-- Modal pagar despues -->
  <div class="modal" id="pagar_luego" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Recuerda que tienes <b>24 Horas </b> para registrar el pago.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <a href="../index.php">Continuar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal ver cuentas -->
  <div class="modal" id="cuentas_bancarias" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuestras cuentas bancarias</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row align-items-center">
              <h6 class="col-12 text_bancarias lead"><b>Bancos</b></h6>
              <span class="col-auto"><img src="../imagen/banesco.jpg" class="img_bancos" style="max-width:20px;border-radius:50%;"><b>Banesco</b></span>
              <span class="col-auto text_pago_movil lead"> <b>N° 0134-0464-03-4641026277</b></span>
            </div>
            <div class="row mt-2">
              <h6 class="col-auto text_pago_movil lead"><b class="text-muted">Titular: </b>Alpargata Skate, C.A.</h6>
              <h6 class="col-auto text_pago_movil lead"><b class="text-muted">Cuenta: </b>Corriente</h6>
              <h6 class="col-auto text_pago_movil lead">J-405852089</h6>
            </div>
            <div class="row mt-2 align-items-center">
              <span class="col-auto"><img src="../imagen/mercantil.jpg" class="img_bancos" style="max-width:20px;border-radius:50%;"> <b> Mercantil</b></span>
              <span class="col-auto text_pago_movil lead"><b>N° 0105-0283-7512-8314-8412</b></span>
            </div>
            <div class="row mt-2">
              <h6 class="col-auto text_pago_movil lead"><b class="text-muted">Titular: </b>Alpargata Skate, C.A.</h6>
              <h6 class="col-auto text_pago_movil lead"><b class="text-muted">Cuenta: </b>Corriente</h6>
              <h6 class="col-auto text_pago_movil lead">J-405852089</h6>
            </div>
            <hr>
            <div class="row">
              <h6 class="col-12 text_bancarias lead"><b>Pago Móvil</b></h6>
              <h6 class="col-auto text_pago_movil lead"><b class="text-muted">Banco: </b> <b> Banesco</b></h6>
              <h6 class="col-auto text_pago_movil lead"><b class="text-muted">Telefono: </b> <b> 0412 4038648</b></h6>
              <h6 class="col-auto text_pago_movil lead"><b class="text-muted">Documento Identidad: </b> <b> J 405852089</b></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $("#button_modal_cuentas").click();
    });
  </script>
    <?php
    /**
    Mercadopago
    **/
    /*
    if (isset($_POST['nombre-cliente'])){
      $doc=$_SESSION['type-identidad-cliente'].'-'.$_SESSION['doc-identidad-cliente'];
      $id_mp=md5($Llave.$doc); //id registrado en el inventario
      $cliente_mp=$_POST['nombre-cliente'];
    }
    if (!empty($monto) and isset($_POST['nombre-cliente']) and isset($_POST['email-cliente'])){
      $preference_data = array(
      "items" => array(
      array(
      "title" => "Carrito de compras en Rouxa - $cliente_mp",
      "quantity" => 1,
      "currency_id" => "VEF", // Available currencies at: https://api.mercadopago.com/currencies
      "unit_price" =>  $monto
      )
      ),
      "payer" => array(
      "name"=>$_POST['nombre-cliente'],
      "email"=>$_POST['email-cliente'],
      ),
      "back_urls"=> array(
      "success"=> "https://www.rouxa.com.ve/back_MP.php?back=1&id=$id_mp",
      "pending"=> "https://www.rouxa.com.ve/back_MP.php?back=2&id=$id_mp",
      "failure"=> "https://www.rouxa.com.ve/back_MP.php?back=3&id=$id_mp"
      ),
      "notification_url"=> "https://www.rouxa.com.ve/receptor/",
      "external_reference"=>"$id_mp"
      );
      $preference = $mp->create_preference($preference_data);
      ?>
      <div class="continer mb-3">
        <div class="row justify-content-around">
          <a href="<?php echo $preference['response']['init_point']; ?>" id="boton-mercadopago" class="btn btn-outline-success btn-lg  col-4">Pagar</a>
        </div>
        <div class="row justify-content-around my-2">
          <small>Si desea cancelar la Compra presione: <a href="index.php?reset=" id="boton-mercadopago" class="text-muted">Vaciar Carrito</a></small>
        </div>
      </div>
      <?php
    }

    */
    ?>
    <?php include '../common/footer.php';?>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
