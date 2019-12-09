<?php
session_start();
//if(!isset($_POST['monto'])){header('Location: ../index.php');}
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
//mensaje de $msn_cuentas
$msn_cuentas="";
//if(isset($_SESSION['monto'])){$monto=$_SESSION['monto'];}
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
  $monto=$estado=$_POST['monto'];
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
        <h2 style="font-family: 'Playfair Display', serif;">¡Felicidades por tu Compra!</h2>
      </div>
      <div class="col-auto ml-auto align-self-end">
        <small class="text-muted">Puedes ver los detalles de tu compra en <a href="../perfil/compras.php">Mis compras</a> </small>
      </div>
    </div>
  </div>
  <div class="container mb-0">
    <div class="row mt-3">
      <h3 class="lead">
        Puedes realizar una transferencia nuestras cuentas bancarias
      </h3>
    </div>
    <div class="row bg-light my-3 py-2">
      <h5 class="col-sm-4 text-muted"><b>Banesco</b></h5>
      <h6 class="col-sm-4"><b>N°</b> 0134 0464 03 4641026277</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <h5 class="col-sm-4 text-muted"><b>Banco Mercantil</b></h5>
      <h6 class="col-sm-4"><b>N°</b>0105 0283 7512 83148412</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <h5 class="col-sm-4 text-muted"><b>Banco Provincial</b></h5>
      <h6 class="col-sm-4"><b>N°</b> 0108 0558 9901 00043593</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <h5 class="col-sm-4 text-muted"><b>Banco del Tesoro</b></h5>
      <h6 class="col-sm-4"><b>N°</b> 0163 0217 1121 73013146</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <hr class="col-sm-11">
      <h6 class="col-sm-6 text-center"><b>Titular: </b>Alpargata Skate, C.A.</h6>
      <h6 class="col-sm-6 text-center"><b>RIF: </b>J-XXXXXXX</h6>
    </div>
    <div class="row bg-light my-3 py-2">
      <h5 class="col-sm-12 text-dark text-center"><b>Monto a cancelar:</b> <?php echo number_format($monto*round($dolar),2,',','.');?> Bs </h5>
    </div>
  </div>
  <div class="container mb-4">
    <div class="row">
      <div class="col-auto mb-2">
        <h3 class="lead"><strong>Registrar pago - </strong> <small class="text-muted">Luego de <strong> venticuatro (24) Horas </strong> se cancela tu pedido en caso de no recibir un <i>Reporte de pago</i>.</small></h3>
      </div>
    </div>
    <div class="row my-3">
      <div class="input-group mb-2 col-sm-4">
        <div class="input-group-prepend">
          <span class="input-group-text" data-toggle="tooltip" title="Desde donde realizaste la trasnferencia">Banco emisor</span>
        </div>
        <select class="custom-select input_datos" name="banco_e" id="banco-e">
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
        <select class="custom-select input_datos" name="municipio" id="banco-r">
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
        <input class="form-control input_datos" type="number" step="1" name="banco_e" id="monto" placeholder="Inserte el Monto Transferido" maxlength="255"/>
      </div>
    </div>
    <div class="row">
      <div class="input-group col-sm-6 mb-2">
        <div class="input-group-prepend">
          <span class="input-group-text">Fecha de transacción</span>
        </div>
        <input class="form-control" type="date" id="fechapago"/>
      </div>
      <div class="input-group mb-2 col-sm-6">
        <div class="input-group-prepend">
          <span class="input-group-text" data-toggle="tooltip" title="Referencia de la trasnferencia">Referencia</span>
        </div>
        <input class="form-control input_datos" type="text" name="banco_e" id="referencia" placeholder="Inserte la Referencia de la Transacción" maxlength="255"/>
      </div>
    </div>
    <div class="row">
      <input type="hidden" id="g-recaptcha-response">
      <div class="input-group-append mt-3 col-12 justify-content-center">
        <button class="btn btn-outline-secondary" type="submit" id="reporte">Registrar pago</button>
      </div>
    </div>
  </div>
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
